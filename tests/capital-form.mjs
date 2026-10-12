import test from 'node:test';
import assert from 'node:assert/strict';
import fs from 'node:fs';
import vm from 'node:vm';

function form(fetch) {
    const context = {window:{}, fetch};
    vm.runInNewContext(fs.readFileSync('public/capital-requests.js', 'utf8'), context);
    const state = context.window.rachiCapitalForm({servico:'Consultoria em recursos humanos', service_slug:'consultoria-recursos-humanos'});
    state.formData.nome = 'Cliente teste'; state.formData.telefone = '+244 900 000 002';
    state.formData.empresa = 'Organização'; state.formData.plano = 'Empresarial'; state.formData.detalhes = '20 colaboradores';
    return state;
}

test('only confirms after persistence and suppresses simultaneous submits', async () => {
    let finish, calls = 0, payload;
    const state = form((url, request) => {
        calls++; payload = JSON.parse(request.body);
        assert.equal(url, '/api/capital/solicitar-cotacao');
        return new Promise(resolve => { finish = resolve; });
    });
    const pending = state.submitForm();
    await state.submitForm();
    assert.equal(calls, 1); assert.equal(state.formSubmitted, false);
    finish({ok:true, json:async()=>({success:true, protocol:'SOL-2026-000001'})});
    await pending;
    assert.equal(state.formSubmitted, true); assert.equal(state.formProtocol, 'SOL-2026-000001');
    assert.equal(payload.service_slug, 'consultoria-recursos-humanos');
    assert.equal(payload.detalhes, '20 colaboradores');
    await state.submitForm(); assert.equal(calls, 1);
});

test('validation errors remain visible and allow retry', async () => {
    const state = form(async()=>({ok:false, json:async()=>({errors:{telefone:['Contacto inválido']}})}));
    await state.submitForm();
    assert.equal(state.formSubmitted, false); assert.equal(state.formSubmitting, false);
    assert.equal(state.formError, 'Contacto inválido');
});

test('network failure never reports a saved request', async () => {
    const state = form(async()=>{throw new Error('Offline');});
    await state.submitForm();
    assert.equal(state.formSubmitted, false); assert.equal(state.formProtocol, '');
    assert.match(state.formError, /servidor/);
});

test('a success without a protocol is not a persistence confirmation', async () => {
    const state = form(async()=>({ok:true, json:async()=>({success:true})}));
    await state.submitForm(); assert.equal(state.formSubmitted, false);
});
