<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // Utilizadores
            ['name' => 'Visualizar Utilizadores', 'slug' => 'users.view', 'group' => 'users'],
            ['name' => 'Criar Utilizadores', 'slug' => 'users.create', 'group' => 'users'],
            ['name' => 'Editar Utilizadores', 'slug' => 'users.update', 'group' => 'users'],
            ['name' => 'Eliminar Utilizadores', 'slug' => 'users.delete', 'group' => 'users'],

            // Clientes
            ['name' => 'Visualizar Clientes', 'slug' => 'customers.view', 'group' => 'customers'],
            ['name' => 'Criar Clientes', 'slug' => 'customers.create', 'group' => 'customers'],
            ['name' => 'Editar Clientes', 'slug' => 'customers.update', 'group' => 'customers'],

            // Produtos e Stock
            ['name' => 'Visualizar Produtos', 'slug' => 'products.view', 'group' => 'products'],
            ['name' => 'Criar Produtos', 'slug' => 'products.create', 'group' => 'products'],
            ['name' => 'Editar Produtos', 'slug' => 'products.update', 'group' => 'products'],
            ['name' => 'Eliminar Produtos', 'slug' => 'products.delete', 'group' => 'products'],
            ['name' => 'Visualizar Stock', 'slug' => 'stock.view', 'group' => 'stock'],
            ['name' => 'Gerir Stock', 'slug' => 'stock.manage', 'group' => 'stock'],

            // Serviços
            ['name' => 'Visualizar Serviços', 'slug' => 'services.view', 'group' => 'services'],
            ['name' => 'Criar Serviços', 'slug' => 'services.create', 'group' => 'services'],
            ['name' => 'Editar Serviços', 'slug' => 'services.update', 'group' => 'services'],
            ['name' => 'Eliminar Serviços', 'slug' => 'services.delete', 'group' => 'services'],

            // Solicitações
            ['name' => 'Visualizar Solicitações', 'slug' => 'requests.view', 'group' => 'requests'],
            ['name' => 'Criar Solicitações', 'slug' => 'requests.create', 'group' => 'requests'],
            ['name' => 'Atualizar Solicitações', 'slug' => 'requests.update', 'group' => 'requests'],
            ['name' => 'Assumir Solicitações', 'slug' => 'requests.assign', 'group' => 'requests'],
            ['name' => 'Finalizar Solicitações', 'slug' => 'requests.close', 'group' => 'requests'],

            // Pedidos
            ['name' => 'Visualizar Pedidos', 'slug' => 'orders.view', 'group' => 'orders'],
            ['name' => 'Criar Pedidos', 'slug' => 'orders.create', 'group' => 'orders'],
            ['name' => 'Atualizar Pedidos', 'slug' => 'orders.update', 'group' => 'orders'],
            ['name' => 'Cancelar Pedidos', 'slug' => 'orders.cancel', 'group' => 'orders'],

            // Cursos
            ['name' => 'Visualizar Cursos', 'slug' => 'courses.view', 'group' => 'courses'],
            ['name' => 'Criar Cursos', 'slug' => 'courses.create', 'group' => 'courses'],
            ['name' => 'Editar Cursos', 'slug' => 'courses.update', 'group' => 'courses'],
            ['name' => 'Eliminar Cursos', 'slug' => 'courses.delete', 'group' => 'courses'],

            // Relatórios
            ['name' => 'Visualizar Relatórios', 'slug' => 'reports.view', 'group' => 'reports'],
        ];

        foreach ($permissions as $perm) {
            Permission::updateOrCreate(['slug' => $perm['slug']], $perm);
        }

        // Atribuir permissões ao Administrador
        $adminRole = Role::where('slug', 'admin')->first();
        if ($adminRole) {
            $adminRole->permissions()->sync(Permission::all());
        }

        // Atribuir permissões a Funcionários
        $employeeRole = Role::where('slug', 'employee')->first();
        if ($employeeRole) {
            $employeePermissions = Permission::whereIn('group', ['products', 'stock', 'services', 'requests', 'orders'])->get();
            $employeeRole->permissions()->sync($employeePermissions);
        }
    }
}
