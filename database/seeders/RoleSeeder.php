<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'Super Administrador', 'slug' => 'super_admin', 'description' => 'Acesso irrestrito a todo o sistema e configurações'],
            ['name' => 'Administrador', 'slug' => 'admin', 'description' => 'Gestão geral da plataforma e relatórios'],
            ['name' => 'Gestor de Unidade', 'slug' => 'manager', 'description' => 'Gestão operacional de uma unidade de negócio'],
            ['name' => 'Funcionário / Técnico', 'slug' => 'employee', 'description' => 'Atendimento, execução de serviços e pedidos'],
            ['name' => 'Atendente', 'slug' => 'attendant', 'description' => 'Triagem e primeiro contato com clientes'],
            ['name' => 'Cliente', 'slug' => 'customer', 'description' => 'Acesso ao portal de autoatendimento e pedidos'],
            ['name' => 'Aluno', 'slug' => 'student', 'description' => 'Acesso aos cursos da RACHI Academy'],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(['slug' => $role['slug']], $role);
        }
    }
}
