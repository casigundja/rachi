<?php

use App\Http\Controllers\Public\BusinessUnitController;
use App\Models\{BusinessUnit, Customer, Role, ServiceRequest, ServiceRequestStatusHistory, User};
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Support\Facades\{Artisan, DB, Hash};

final class CapitalRequestTest extends TestCase
{
    public function createApplication()
    {
        $app = require __DIR__ . '/../bootstrap/app.php';
        $app->make(Kernel::class)->bootstrap();
        return $app;
    }

    protected function setUp(): void
    {
        parent::setUp();
        config(['database.default' => 'sqlite', 'database.connections.sqlite.database' => ':memory:', 'session.driver' => 'array', 'cache.default' => 'array']);
        DB::purge('sqlite');
        Artisan::call('migrate', ['--force' => true]);
        Artisan::call('db:seed', ['--class' => 'Database\\Seeders\\RoleSeeder', '--force' => true]);
        Artisan::call('db:seed', ['--class' => 'Database\\Seeders\\BusinessUnitSeeder', '--force' => true]);
        BusinessUnit::where('slug', 'capital')->update(['id' => 14]);
        Role::where('slug', 'customer')->update(['id' => 16]);
    }

    private function payload(): array
    {
        return ['nome' => 'Cliente Capital', 'telefone' => '+244 900 000 002', 'email' => 'capital@example.test', 'empresa' => 'Organização Teste', 'servico' => 'Consultoria Human Capital', 'plano' => 'Plano empresarial', 'detalhes' => 'Equipa de 20 colaboradores. Prazo: novembro.'];
    }

    private function admin(): User
    {
        return User::create(['name' => 'Admin teste', 'email' => 'admin@example.test', 'password' => Hash::make('test-password'), 'role_id' => Role::where('slug', 'admin')->value('id'), 'status' => 'active']);
    }

    public function test_main_page_and_six_services_save_and_appear_in_capital_admin(): void
    {
        $this->get('/capital')->assertOk()->assertSee('rachiCapitalForm()', false)->assertSee('@submit.prevent="submitForm()"', false);
        $this->postJson('/api/capital/solicitar-cotacao', $this->payload())->assertOk()->assertJsonPath('success', true);
        foreach (BusinessUnitController::getCapitalServices() as $service) {
            $this->get('/capital/servicos/' . $service['slug'])->assertOk()->assertSee('/capital-requests.js', false);
            $this->postJson('/api/capital/solicitar-cotacao', $this->payload() + ['service_slug' => $service['slug']])->assertOk()->assertJsonPath('success', true);
            $this->assertStringContainsString($service['title'], ServiceRequest::latest('id')->first()->description);
        }
        $this->assertSame(7, ServiceRequest::count());
        $this->assertSame(7, ServiceRequestStatusHistory::count());
        $this->assertSame(1, Customer::count());
        foreach (ServiceRequest::all() as $request) {
            $this->assertSame(14, $request->business_unit_id);
            $this->assertSame(16, $request->customer->user->role_id);
            foreach (['Cliente Capital', '+244 900 000 002', 'capital@example.test', 'Organização Teste', 'Plano empresarial', '20 colaboradores'] as $value) $this->assertStringContainsString($value, $request->description);
        }
        $this->actingAs($this->admin())->getJson('/admin/capital/requests')->assertOk()->assertJsonCount(7, 'requests');
        $this->getJson('/admin/print/requests')->assertOk()->assertJsonCount(0, 'requests');
        $this->get('/admin-dashboard')->assertOk()->assertSee('RACHI Human Capital — Solicitações')->assertSee(ServiceRequest::latest('id')->first()->protocol);
    }

    public function test_phone_only_submissions_preserve_optional_email_and_reuse_contact(): void
    {
        $data = $this->payload();
        unset($data['email'], $data['empresa'], $data['plano'], $data['detalhes']);
        $first = $this->postJson('/capital/solicitar-cotacao', $data)->assertOk()->json('protocol');
        $second = $this->postJson('/api/capital/solicitar-cotacao', $data)->assertOk()->json('protocol');
        $this->assertNotSame($first, $second);
        $this->assertSame(1, Customer::count());
        $this->assertStringNotContainsString('@contact.rachi.invalid', ServiceRequest::first()->description);
    }

    public function test_invalid_input_does_not_save_and_admin_endpoint_is_private(): void
    {
        $this->postJson('/api/capital/solicitar-cotacao', ['servico' => 'Teste'])->assertUnprocessable();
        $this->postJson('/api/capital/solicitar-cotacao', array_replace($this->payload(), ['telefone' => 'abc']))->assertUnprocessable();
        $this->postJson('/api/capital/solicitar-cotacao', $this->payload() + ['service_slug' => 'servico-inexistente'])->assertUnprocessable();
        $this->assertSame(0, ServiceRequest::count());
        $this->assertSame(0, User::count());
        $this->getJson('/admin/capital/requests')->assertUnauthorized();
    }

    public function test_admin_filling_another_clients_form_does_not_own_the_request(): void
    {
        $admin = $this->admin();
        $this->actingAs($admin)->postJson('/api/capital/solicitar-cotacao', $this->payload())->assertOk();
        $this->assertNotSame($admin->id, ServiceRequest::first()->customer->user_id);
    }

    public function test_write_failure_rolls_back_contact_and_request(): void
    {
        ServiceRequestStatusHistory::creating(function () { throw new RuntimeException('Simulated write failure'); });
        $this->withoutExceptionHandling();
        try {
            $this->postJson('/api/capital/solicitar-cotacao', $this->payload());
            $this->fail('Expected write failure.');
        } catch (RuntimeException $error) {
            $this->assertSame('Simulated write failure', $error->getMessage());
        } finally {
            ServiceRequestStatusHistory::flushEventListeners();
        }
        $this->assertSame(0, ServiceRequest::count());
        $this->assertSame(0, Customer::count());
        $this->assertSame(0, User::count());
    }
}
