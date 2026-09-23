<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Customer;
use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $superAdminRole = Role::where('slug', 'super_admin')->first();
        $employeeRole = Role::where('slug', 'employee')->first();
        $customerRole = Role::where('slug', 'customer')->first();

        // 1. Super Admin
        $admin = User::updateOrCreate(
            ['email' => 'admin@rachi.ao'],
            [
                'name' => 'Super Administrador RACHI',
                'password' => Hash::make(env('ADMIN_DEFAULT_PASSWORD', 'Rachi@2026!')),
                'phone' => '+244 923 000 000',
                'role_id' => $superAdminRole?->id,
                'business_unit_id' => null,
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );

        // 2. Funcionário Técnico (RACHI Tec)
        $techEmployee = User::updateOrCreate(
            ['email' => 'tecnico@rachi.ao'],
            [
                'name' => 'Casimiro Gundja',
                'password' => Hash::make('RachiTec@2026'),
                'phone' => '+244 923 111 222',
                'role_id' => $employeeRole?->id,
                'business_unit_id' => 1, // TEC
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );

        Employee::updateOrCreate(
            ['user_id' => $techEmployee->id],
            [
                'employee_code' => 'EMP-TEC-001',
                'position' => 'Engenheiro de Sistemas & Suporte',
                'department' => 'Tecnologia da Informação',
                'business_unit_id' => 1,
                'hire_date' => '2024-01-15',
                'status' => 'active',
            ]
        );

        // 3. Cliente Demo (Empresarial)
        $demoCustomer = User::updateOrCreate(
            ['email' => 'cliente@empresa.ao'],
            [
                'name' => 'Inov Quimua Consultoria',
                'password' => Hash::make('Cliente@2026'),
                'phone' => '+244 912 345 678',
                'role_id' => $customerRole?->id,
                'business_unit_id' => null,
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );

        Customer::updateOrCreate(
            ['user_id' => $demoCustomer->id],
            [
                'type' => 'company',
                'document' => '5412345678',
                'company_name' => 'Inov Quimua Consultoria Lda',
                'trade_name' => 'Inov Quimua',
                'phone' => '+244 912 345 678',
                'whatsapp' => '+244 912 345 678',
                'status' => 'active',
            ]
        );

        // 4. Casimiro Gundja (Admin Master oficial)
        User::updateOrCreate(
            ['email' => 'casimirogundja@outlook.com'],
            [
                'name' => 'Casimiro Gundja',
                'password' => Hash::make('Admin@2026'),
                'phone' => '+244 923 000 000',
                'role_id' => $superAdminRole?->id,
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );

        // 5. Especialista RH
        $rhRole = Role::where('slug', 'rh_specialist')->first();
        User::updateOrCreate(
            ['email' => 'joao@rachi.ao'],
            [
                'name' => 'João Silva',
                'password' => Hash::make('123456'),
                'phone' => '+244 923 000 015',
                'role_id' => $rhRole?->id ?? $employeeRole?->id,
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );

        // 6. Instrutora Academy
        $instrRole = Role::where('slug', 'instructor')->first();
        User::updateOrCreate(
            ['email' => 'ana@rachi.ao'],
            [
                'name' => 'Ana Lima',
                'password' => Hash::make('123456'),
                'phone' => '+244 923 000 040',
                'role_id' => $instrRole?->id ?? $employeeRole?->id,
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );

        // 7. Aluno Pedro Alves
        $studentRole = Role::where('slug', 'student')->first();
        User::updateOrCreate(
            ['email' => 'pedro@email.com'],
            [
                'name' => 'Pedro Alves',
                'password' => Hash::make('123456'),
                'phone' => '+244 923 000 050',
                'role_id' => $studentRole?->id ?? $customerRole?->id,
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );
    }
}
