<?php

namespace App\Services;

use App\Models\User;
use App\Models\Customer;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerService
{
    /**
     * Cadastro completo de novo cliente (RN001, RN002).
     */
    public function register(array $data): Customer
    {
        return DB::transaction(function () use ($data) {
            $customerRole = Role::where('slug', 'customer')->first();

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'phone' => $data['phone'] ?? null,
                'role_id' => $customerRole?->id,
                'status' => 'active',
                'email_verified_at' => now(),
            ]);

            $customer = Customer::create([
                'user_id' => $user->id,
                'type' => $data['type'] ?? 'individual',
                'document' => $data['document'] ?? null,
                'company_name' => $data['company_name'] ?? null,
                'trade_name' => $data['trade_name'] ?? null,
                'birth_date' => $data['birth_date'] ?? null,
                'phone' => $data['phone'] ?? null,
                'whatsapp' => $data['whatsapp'] ?? null,
                'status' => 'active',
            ]);

            return $customer;
        });
    }
}
