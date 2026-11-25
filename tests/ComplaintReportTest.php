<?php

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Support\Facades\{Artisan, DB};

final class ComplaintReportTest extends TestCase
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
        config([
            'database.default' => 'sqlite',
            'database.connections.sqlite.database' => ':memory:',
            'session.driver' => 'array',
            'cache.default' => 'array',
        ]);
        DB::purge('sqlite');
        Artisan::call('migrate', ['--force' => true]);
    }

    public function test_submit_valid_complaint_generates_protocol(): void
    {
        $payload = [
            'type' => 'reclamacao',
            'business_unit' => 'RACHI Tec',
            'category' => 'Suporte Técnico',
            'name' => 'Casimiro Gundja',
            'email' => 'casimiro@example.com',
            'phone' => '+244 923 000 111',
            'subject' => 'Atraso na configuração de servidor',
            'description' => 'A entrega do servidor corporativo excedeu o prazo acordado em dois dias.',
        ];

        $response = $this->postJson('/api/reclamacoes-denuncia', $payload);

        $response->assertOk()
            ->assertJsonPath('ok', true);

        $protocol = $response->json('protocol');
        $this->assertNotEmpty($protocol);
        $this->assertStringStartsWith('REC-', $protocol);

        $this->assertDatabaseHas('complaints_reports', [
            'protocol' => $protocol,
            'type' => 'reclamacao',
            'email' => 'casimiro@example.com',
            'status' => 'recebido',
        ]);
    }

    public function test_submit_anonymous_whistleblowing_report_without_identifying_data(): void
    {
        $payload = [
            'type' => 'denuncia',
            'is_anonymous' => true,
            'business_unit' => 'RACHI Print',
            'category' => 'Ética & Fraude',
            'subject' => 'Cobrança indevida por fora',
            'description' => 'Tentativa de cobrança de valor extra sem factura oficial emitida pela empresa.',
        ];

        $response = $this->postJson('/api/reclamacoes-denuncia', $payload);

        $response->assertOk()
            ->assertJsonPath('ok', true);

        $protocol = $response->json('protocol');
        $this->assertNotEmpty($protocol);
        $this->assertStringStartsWith('DEN-', $protocol);

        $this->assertDatabaseHas('complaints_reports', [
            'protocol' => $protocol,
            'type' => 'denuncia',
            'is_anonymous' => 1,
            'email' => null,
            'status' => 'recebido',
        ]);
    }

    public function test_consultar_protocolo_valido_e_invalido(): void
    {
        $payload = [
            'type' => 'reclamacao',
            'business_unit' => 'RACHI Academy',
            'category' => 'Certificação',
            'name' => 'Laurinita Santos',
            'email' => 'laurinita@example.com',
            'subject' => 'Emissão de certificado pendente',
            'description' => 'Concluí o curso de liderança executiva e aguardo emissão do QR Code.',
        ];

        $res = $this->postJson('/api/reclamacoes-denuncia', $payload)->assertOk();
        $protocol = $res->json('protocol');

        // Consulta válida
        $lookup = $this->getJson('/api/reclamacoes-denuncia/consultar?protocol=' . $protocol);
        $lookup->assertOk()
            ->assertJsonPath('ok', true)
            ->assertJsonPath('record.protocol', $protocol)
            ->assertJsonPath('record.status', 'recebido')
            ->assertJsonPath('record.type', 'reclamacao');

        // Consulta com protocolo inexistente
        $this->getJson('/api/reclamacoes-denuncia/consultar?protocol=REC-2026-99999')
            ->assertStatus(404)
            ->assertJsonPath('ok', false);
    }

    public function test_invalid_submission_fails_validation(): void
    {
        // Descrição muito curta (<10 chars) e sem unidade
        $this->postJson('/api/reclamacoes-denuncia', [
            'type' => 'reclamacao',
            'description' => 'Curto',
        ])->assertStatus(422);
    }
}
