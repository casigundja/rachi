<?php

use App\Models\{BusinessUnit, Customer, Role, ServiceRequest, ServiceRequestStatusHistory, User};
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Support\Facades\{Artisan, DB, Hash};

final class PrintQuoteTest extends TestCase
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
        BusinessUnit::where('slug', 'print')->update(['id' => 9]);
        Role::where('slug', 'customer')->update(['id' => 16]);
    }

    private function admin(): User
    {
        return User::create(['name' => 'Admin teste', 'email' => 'admin@example.test', 'password' => Hash::make('test-password'), 'role_id' => Role::where('slug', 'admin')->value('id'), 'status' => 'active']);
    }

    private function payload(string $product): array
    {
        return ['name' => 'Cliente de Teste', 'email' => 'print@example.test', 'phone' => '+244 900 000 001', 'empresa' => 'Empresa Teste', 'produto' => $product, 'quantidade' => '100 unidades', 'prazo' => 'urgente', 'message' => 'Impressão com logotipo e acabamento mate.'];
    }

    public function test_catalogue_and_all_services_save_and_appear_in_print_admin(): void
    {
        $products = ['Catálogo Print', 'documentos-institucionais', 'materiais-promocionais', 'producao-grafica-corporativa', 'grafica-eventos'];
        foreach ($products as $product) {
            $this->postJson('/print/solicitar-cotacao', $this->payload($product) + ['linha' => 'Linha ' . $product, 'service_slug' => $product])
                ->assertOk()->assertJsonPath('success', true);
        }
        $this->assertSame(5, ServiceRequest::count());
        $this->assertSame(5, ServiceRequestStatusHistory::count());
        $this->assertSame(1, Customer::count());
        foreach (ServiceRequest::all() as $request) {
            $this->assertSame(9, $request->business_unit_id);
            $this->assertSame('urgent', $request->priority);
            $this->assertStringContainsString('100 unidades', $request->description);
            $this->assertStringContainsString('print@example.test', $request->description);
            $this->assertStringContainsString('acabamento mate', $request->description);
            $this->assertStringContainsString('Linha ' . $products[$request->id - 1], $request->description);
            $this->assertSame(16, $request->customer->user->role_id);
        }
        $this->actingAs($this->admin())->getJson('/admin/print/requests')->assertOk()->assertJsonCount(5, 'requests');
        $this->get('/admin-dashboard')->assertOk()->assertSee('Solicitações de Cotação')->assertSee(ServiceRequest::latest('id')->first()->protocol);
    }

    public function test_optional_fields_and_protocol_after_soft_delete(): void
    {
        $data = $this->payload('Cartões');
        unset($data['prazo'], $data['empresa'], $data['quantidade'], $data['message']);
        $first = $this->postJson('/api/print/solicitar-cotacao', $data)->assertOk()->json('protocol');
        ServiceRequest::first()->delete();
        $second = $this->postJson('/print/solicitar-cotacao', $data)->assertOk()->json('protocol');
        $this->assertNotSame($first, $second);
        $this->assertSame(2, ServiceRequest::withTrashed()->count());
    }

    public function test_all_print_pages_render_the_single_submission_flow(): void
    {
        foreach (['/print', '/print/servicos/documentos-institucionais', '/print/servicos/materiais-promocionais', '/print/servicos/producao-grafica-corporativa', '/print/servicos/grafica-eventos'] as $path) {
            $this->get($path)->assertOk()
                ->assertSee('@submit.prevent="submitQuote()"', false)
                ->assertSee("fetch('/print/solicitar-cotacao'", false)
                ->assertDontSee('onsubmit="return window.rachiSubmitQuoteForm(event)"', false);
        }
    }

    public function test_staff_session_does_not_own_a_different_clients_quote(): void
    {
        $admin = $this->admin();
        $this->actingAs($admin)->postJson('/print/solicitar-cotacao', $this->payload('Brindes'))->assertOk();
        $this->assertNotSame($admin->id, ServiceRequest::first()->customer->user_id);
        $this->assertSame('print@example.test', ServiceRequest::first()->customer->user->email);
    }

    public function test_invalid_submission_does_not_create_records_and_admin_list_is_private(): void
    {
        $this->postJson('/print/solicitar-cotacao', ['produto' => 'Teste'])->assertUnprocessable();
        $this->assertSame(0, ServiceRequest::count());
        $this->assertSame(0, Customer::count());
        $this->getJson('/admin/print/requests')->assertUnauthorized();
    }

    public function test_failure_to_write_history_rolls_back_entire_submission(): void
    {
        ServiceRequestStatusHistory::creating(function () { throw new RuntimeException('Simulated write failure'); });
        $this->withoutExceptionHandling();
        try {
            $this->postJson('/print/solicitar-cotacao', $this->payload('Teste rollback'));
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
