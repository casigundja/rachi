<?php

use App\Models\{BusinessUnit, Course, CourseEnrollment, CourseLesson, CourseModule, Customer, Order, Product, Role, User};
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Support\Facades\{Artisan, DB, Hash};

final class CloudSyncTest extends TestCase
{
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';
        $app->make(Kernel::class)->bootstrap();
        return $app;
    }

    protected function setUp(): void
    {
        parent::setUp();
        config(['database.default'=>'sqlite','database.connections.sqlite.database'=>':memory:',
            'session.driver'=>'array','cache.default'=>'array']);
        DB::purge('sqlite');
        Artisan::call('migrate',['--force'=>true]);
        Artisan::call('db:seed',['--class'=>'Database\\Seeders\\RoleSeeder','--force'=>true]);
        Artisan::call('db:seed',['--class'=>'Database\\Seeders\\BusinessUnitSeeder','--force'=>true]);
    }

    private function account(string $role = 'customer'): User
    {
        return User::create(['name'=>'Teste local','email'=>uniqid('cloud-sync-').'@example.test',
            'password'=>Hash::make('Test-only-password-2026'),'role_id'=>Role::where('slug',$role)->firstOrFail()->id,'status'=>'active']);
    }

    private function courseFixture(): Course
    {
        return Course::create(['name'=>'Formação de teste','slug'=>'formacao-teste','description'=>'Programa de teste',
            'business_unit_id'=>BusinessUnit::where('slug','academy')->firstOrFail()->id,'status'=>'published','price'=>1000,'duration_hours'=>40,'level'=>'beginner']);
    }

    public function test_missing_cloud_pages_and_protected_redirects(): void
    {
        foreach (['/login','/registro','/academy/login','/academy/matricula','/carrinho','/checkout','/academy/cursos','/tec/servicos','/print/servicos','/capital/servicos','/tec/produtos'] as $url) {
            $this->get($url)->assertOk()->assertSee('csrf-token',false);
        }
        foreach (['/portal','/admin-dashboard','/admin/dashboard','/aluno-dashboard','/academy/dashboard'] as $url) $this->get($url)->assertRedirect('/login');
        $this->getJson('/api/orders')->assertUnauthorized();
    }

    public function test_catalog_and_course_page_use_current_database_records(): void
    {
        $course = $this->courseFixture();
        $this->getJson('/api/catalog')->assertOk()->assertJsonPath('courses.0.slug',$course->slug);
        $this->getJson('/api/courses/'.$course->slug)->assertOk()->assertJsonPath('course.name',$course->name);
        $this->get('/academy/cursos/'.$course->slug)->assertOk()->assertSee($course->name)->assertSee('name="_token"',false);
    }

    public function test_portal_request_and_order_ownership(): void
    {
        $owner = $this->account();
        $other = $this->account();
        $this->actingAs($owner)->get('/portal')->assertOk()->assertSee('portal-content',false);
        $response = $this->postJson('/solicitacoes/nova',['title'=>'Pedido local','description'=>'Descrição de teste','unit_id'=>BusinessUnit::first()->id,'priority'=>'normal']);
        $response->assertOk();
        $id = $response->json('request.id');
        $this->getJson('/api/requests/'.$id)->assertOk();
        $this->postJson('/solicitacoes/'.$id.'/mensagem',['message'=>'Mensagem de teste'])->assertOk();
        $this->actingAs($other)->getJson('/api/requests/'.$id)->assertForbidden();
        $this->getJson('/solicitacoes/conversas')->assertJsonCount(0,'requests');
        $this->getJson('/admin/users')->assertForbidden();
        $this->getJson('/api/stock')->assertForbidden();
    }

    public function test_course_enrollment_and_lesson_progress(): void
    {
        $user = $this->account();
        $course = $this->courseFixture();
        $module = $course->modules()->create(['title'=>'Módulo','status'=>'active','sort_order'=>1]);
        $lesson = $module->lessons()->create(['title'=>'Aula','content'=>'Conteúdo reservado','status'=>'active','sort_order'=>1]);
        $this->actingAs($user)->postJson('/academy/cursos/'.$course->slug.'/matricula',[])->assertOk();
        $this->getJson('/api/my/courses')->assertOk()->assertJsonPath('courses.0.enrollment_status','pending');
        $this->getJson('/api/lessons/'.$lesson->id)->assertForbidden();
        $enrollment = CourseEnrollment::firstOrFail();
        $enrollment->update(['status'=>'active']);
        $this->getJson('/api/lessons/'.$lesson->id)->assertOk()->assertJsonPath('lesson.content','Conteúdo reservado');
        $this->postJson('/api/lessons/'.$lesson->id.'/progress',['completed'=>true,'last_position'=>42])->assertOk();
        $this->getJson('/api/my/courses')->assertJsonPath('courses.0.completed_lessons',1);
        $this->postJson('/api/lessons/'.$lesson->id.'/progress',['completed'=>false,'last_position'=>5])->assertOk();
        $this->getJson('/api/my/courses')->assertJsonPath('courses.0.completed_lessons',1);
    }

    public function test_checkout_validates_stock_and_creates_real_order(): void
    {
        $user = $this->account();
        $product = Product::create(['name'=>'Produto teste','slug'=>'produto-teste','sku'=>'TEST-1','price'=>100,'cost_price'=>50,
            'stock_quantity'=>3,'minimum_stock'=>0,'business_unit_id'=>BusinessUnit::first()->id,'status'=>'active']);
        $this->actingAs($user)->postJson('/checkout',['items'=>[['product_id'=>$product->id,'quantity'=>4]]])->assertStatus(409);
        $this->assertSame(0,Order::count());
        $this->postJson('/checkout',['items'=>[['product_id'=>$product->id,'quantity'=>2]]])->assertOk();
        $this->assertSame(1,$product->fresh()->stock_quantity);
        $this->getJson('/api/orders')->assertJsonCount(1,'orders');
        $this->actingAs($this->account())->getJson('/api/orders')->assertJsonCount(0,'orders');
    }

    public function test_admin_api_and_contact_persistence(): void
    {
        $admin = $this->account('super_admin');
        $this->actingAs($admin);
        foreach (['/admin/users','/admin/data/employees','/admin/data/customers','/admin/data/products','/admin/data/services','/admin/data/courses','/admin/data/catalogcourses','/admin/data/contacts','/admin/data/audit','/admin/data/reports','/api/stock','/api/academy/enrollments'] as $url) {
            $this->getJson($url)->assertOk();
        }

        // Teste de contacto com campos em Português
        $this->postJson('/contacto', [
            'nome' => 'Manuel Gonçalves',
            'email' => 'manuel@empresa.ao',
            'telefone' => '+244 923 111 222',
            'unidade' => 'RACHI Tec',
            'mensagem' => 'Pedido de infraestrutura de rede'
        ])->assertOk()->assertJsonPath('success', true);

        $this->getJson('/admin/data/contacts')->assertJsonCount(1, 'items')
            ->assertJsonPath('items.0.name', 'Manuel Gonçalves')
            ->assertJsonPath('items.0.subject', 'RACHI Tec');
    }

    public function test_admin_user_management_lifecycle_and_audit(): void
    {
        $admin = $this->account('super_admin');
        $this->actingAs($admin);

        // 1. Listar utilizadores
        $res = $this->getJson('/admin/users')->assertOk()->assertJsonPath('success', true);
        $this->assertNotEmpty($res->json('users'));
        $this->assertArrayHasKey('tipo', $res->json('users.0'));
        $this->assertArrayHasKey('tc', $res->json('users.0'));
        $this->assertArrayHasKey('ini', $res->json('users.0'));

        // 2. Criar utilizador com campos em português
        $roleCustomer = Role::where('slug', 'customer')->firstOrFail();
        $createRes = $this->postJson('/admin/users', [
            'nome' => 'António Silva',
            'email' => 'antonio.silva@example.ao',
            'telefone' => '+244 912 345 678',
            'role_id' => $roleCustomer->id,
            'password' => 'SenhaSegura123',
        ])->assertOk()->assertJsonPath('success', true)->assertJsonPath('user.nome', 'António Silva');

        $userId = $createRes->json('user.id');
        $this->assertDatabaseHas('activity_logs', ['action' => 'user_created', 'model_id' => $userId]);

        // 3. Atualizar utilizador
        $this->postJson('/admin/users/' . $userId . '/update', [
            'nome' => 'António Silva Atualizado',
            'telefone' => '+244 923 999 888',
        ])->assertOk()->assertJsonPath('success', true)->assertJsonPath('user.nome', 'António Silva Atualizado');

        $this->assertDatabaseHas('activity_logs', ['action' => 'user_updated', 'model_id' => $userId]);

        // 4. Alternar status (bloquear / desbloquear)
        $this->postJson('/admin/users/' . $userId . '/toggle-status')
            ->assertOk()->assertJsonPath('success', true);
        $this->assertDatabaseHas('activity_logs', ['action' => 'status_changed', 'model_id' => $userId]);

        // 5. Redefinir palavra-passe
        $this->postJson('/admin/users/' . $userId . '/reset-password', [
            'password' => 'NovaSenhaRachi@2026'
        ])->assertOk()->assertJsonPath('success', true)->assertJsonPath('new_password', 'NovaSenhaRachi@2026');
        $this->assertDatabaseHas('activity_logs', ['action' => 'password_reset', 'model_id' => $userId]);

        // 6. Eliminar utilizador
        $this->postJson('/admin/users/' . $userId . '/delete')
            ->assertOk()->assertJsonPath('success', true)->assertJsonPath('deleted_id', $userId);
        $this->assertDatabaseHas('activity_logs', ['action' => 'user_deleted', 'model_id' => $userId]);
    }

    public function test_admin_academy_enrollments_and_request_aliases(): void
    {
        $admin = $this->account('super_admin');
        $this->actingAs($admin);
        $course = $this->courseFixture();

        // 1. Criar matrícula administrativa
        $enrollRes = $this->postJson('/admin/academy/enrollments/create', [
            'name' => 'Estudante Academy',
            'email' => 'estudante@academy.rachi.ao',
            'phone' => '+244 933 444 555',
            'course_id' => $course->id,
            'status' => 'pending',
        ])->assertOk()->assertJsonPath('success', true);

        $enrollmentId = $enrollRes->json('enrollment.id');
        $this->assertNotNull($enrollmentId);

        // 2. Listar matrículas
        $this->getJson('/admin/academy/enrollments')
            ->assertOk()->assertJsonPath('success', true)
            ->assertJsonPath('enrollments.0.id', $enrollmentId);

        // 3. Atualizar estado da matrícula
        $this->postJson('/admin/academy/enrollments/' . $enrollmentId . '/status', [
            'status' => 'active'
        ])->assertOk()->assertJsonPath('success', true)->assertJsonPath('enrollment.status', 'active');

        // 4. Testar aliases de solicitações
        $reqRes = $this->postJson('/solicitacoes/nova', [
            'title' => 'Dúvida do curso',
            'description' => 'Solicito informações sobre o cronograma',
            'unit_id' => $course->business_unit_id,
        ])->assertOk();

        $requestId = $reqRes->json('request.id');

        // Mensagem via alias /admin/solicitacoes/{id}/mensagem
        $this->postJson('/admin/solicitacoes/' . $requestId . '/mensagem', [
            'message' => 'O cronograma é de 4 semanas.'
        ])->assertOk()->assertJsonPath('success', true);

        // Mensagem via alias /cliente/solicitacoes/{id}/mensagem
        $this->postJson('/cliente/solicitacoes/' . $requestId . '/mensagem', [
            'message' => 'Obrigado pela confirmação!'
        ])->assertOk()->assertJsonPath('success', true);

        // Listar via /admin/solicitacoes/conversas
        $this->getJson('/admin/solicitacoes/conversas')
            ->assertOk()->assertJsonPath('success', true);

        // 5. Excluir matrícula
        $this->postJson('/admin/academy/enrollments/' . $enrollmentId . '/delete')
            ->assertOk()->assertJsonPath('success', true);
    }
}

