<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;

if (!function_exists('issueRachiSession')) {
    function issueRachiSession(User $user, ?string $previousToken = null): string {
        try {
            if ($previousToken && preg_match('/^[a-f0-9]{64}$/', $previousToken)) {
                DB::table('worker_sessions')
                    ->where('token_hash', hash('sha256', $previousToken))
                    ->delete();
            }
            $token = bin2hex(random_bytes(32));
            $hash = hash('sha256', $token);
            DB::table('worker_sessions')->insert([
                'token_hash' => $hash,
                'user_id' => $user->id,
                'expires_at' => now()->addHours(12),
                'created_at' => now(),
            ]);
            return $token;
        } catch (\Throwable $e) {
            return bin2hex(random_bytes(32));
        }
    }
}

if (!function_exists('formatPublicUser')) {
    function formatPublicUser(User $user): array {
        $isAdm = $user->isAdmin();
        $hasActive = $isAdm || ($user->customer?->enrollments()->where('status', 'active')->exists() ?? false);
        $canAluno = $isAdm || $hasActive;

        return [
            'id' => $user->id,
            'name' => $user->name,
            'nome' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone ?? '',
            'role' => $user->role?->name ?? ($isAdm ? 'Super Administrador' : 'Cliente'),
            'role_slug' => $user->role?->slug ?? ($isAdm ? 'super_admin' : 'customer'),
            'tipo' => $isAdm ? 'admin' : ($canAluno ? 'aluno' : ($user->isEmployee() ? 'funcionario' : 'cliente')),
            'empresa' => $user->customer?->company_name ?? ($isAdm ? 'RACHI S.A.' : 'Conta Particular'),
            'has_matricula' => $hasActive,
            'has_active_enrollment' => $hasActive,
            'can_admin' => $isAdm,
            'can_aluno' => $canAluno,
            'can_customer' => true,
        ];
    }
}

if (!function_exists('formatAdminUserRecord')) {
    function formatAdminUserRecord($u) {
        $roleSlug = $u->role?->slug ?? 'customer';
        $roleMap = [
            'super_admin' => [
                'tipo' => 'Admin Master',
                'tc' => 'bg-blue-100 text-blue-700 dark:bg-blue-500/20 dark:text-blue-300',
                'mod' => ['Todos os Módulos'],
                'av' => 'bg-gradient-to-br from-blue-600 to-indigo-700'
            ],
            'admin' => [
                'tipo' => 'Administrador',
                'tc' => 'bg-blue-100 text-blue-700 dark:bg-blue-500/20 dark:text-blue-300',
                'mod' => ['Loja', 'Academy', 'Print', 'Human Capital'],
                'av' => 'bg-gradient-to-br from-blue-500 to-cyan-600'
            ],
            'manager' => [
                'tipo' => 'Gestor de Unidade',
                'tc' => 'bg-cyan-100 text-cyan-700 dark:bg-cyan-500/20 dark:text-cyan-300',
                'mod' => ['Loja', 'Print'],
                'av' => 'bg-gradient-to-br from-teal-500 to-cyan-600'
            ],
            'employee' => [
                'tipo' => 'Funcionário',
                'tc' => 'bg-purple-100 text-purple-700 dark:bg-purple-500/20 dark:text-purple-300',
                'mod' => ['Gráfica', 'Loja'],
                'av' => 'bg-gradient-to-br from-purple-600 to-violet-700'
            ],
            'rh_specialist' => [
                'tipo' => 'Especialista RH',
                'tc' => 'bg-amber-100 text-amber-800 dark:bg-orange-500/20 dark:text-orange-300',
                'mod' => ['Human Capital'],
                'av' => 'bg-gradient-to-br from-orange-600 to-amber-700'
            ],
            'instructor' => [
                'tipo' => 'Instrutora Academy',
                'tc' => 'bg-indigo-100 text-indigo-700 dark:bg-indigo-500/20 dark:text-indigo-300',
                'mod' => ['Academy'],
                'av' => 'bg-gradient-to-br from-indigo-600 to-blue-700'
            ],
            'student' => [
                'tipo' => 'Aluno / Cliente',
                'tc' => 'bg-slate-100 text-slate-700 dark:bg-slate-500/20 dark:text-slate-300',
                'mod' => ['Academy'],
                'av' => 'bg-gradient-to-br from-slate-600 to-slate-700'
            ],
            'customer' => [
                'tipo' => 'Cliente',
                'tc' => 'bg-slate-100 text-slate-700 dark:bg-slate-500/20 dark:text-slate-300',
                'mod' => ['Loja', 'Print'],
                'av' => 'bg-gradient-to-br from-slate-500 to-gray-600'
            ],
            'attendant' => [
                'tipo' => 'Atendente',
                'tc' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-300',
                'mod' => ['Loja', 'Print'],
                'av' => 'bg-gradient-to-br from-emerald-600 to-teal-700'
            ],
        ];

        $cfg = $roleMap[$roleSlug] ?? [
            'tipo' => $u->role?->name ?? 'Utilizador',
            'tc' => 'bg-slate-100 text-slate-700 dark:bg-slate-500/20 dark:text-slate-300',
            'mod' => ['Geral'],
            'av' => 'bg-gradient-to-br from-slate-600 to-slate-700'
        ];

        $parts = explode(' ', trim($u->name ?? 'Utilizador'));
        $ini = count($parts) >= 2
            ? mb_strtoupper(mb_substr($parts[0], 0, 1) . mb_substr(end($parts), 0, 1))
            : mb_strtoupper(mb_substr($u->name ?? 'US', 0, 2));

        $isDeleted = !is_null($u->deleted_at);

        $statusStr = strtolower($u->status ?? 'active');
        $isBlocked = in_array($statusStr, ['blocked', 'bloqueado', 'suspended']);
        $isInactive = in_array($statusStr, ['inactive', 'inativo']);

        $statusLabel = 'Ativo';
        $statusKey = 'ativo';
        if ($isDeleted) {
            $statusLabel = 'Eliminado';
            $statusKey = 'deleted';
        } elseif ($isBlocked) {
            $statusLabel = 'Bloqueado';
            $statusKey = 'cancel';
        } elseif ($isInactive) {
            $statusLabel = 'Inativo';
            $statusKey = 'wait';
        }

        $phone = $u->phone ?? $u->customer?->phone ?? $u->employee?->phone ?? '';

        return [
            'id' => $u->id,
            'name' => $u->name,
            'nome' => $u->name,
            'email' => $u->email,
            'phone' => $phone,
            'telefone' => $phone,
            'tipo' => $cfg['tipo'],
            'role' => $cfg['tipo'],
            'role_id' => $u->role_id,
            'role_slug' => $roleSlug,
            'tc' => $cfg['tc'],
            'status' => $statusLabel,
            'statusLabel' => $statusLabel,
            'raw_status' => $isDeleted ? 'deleted' : ($u->status ?? 'active'),
            'sk' => $statusKey,
            'is_deleted' => $isDeleted,
            'deleted_at' => $isDeleted ? $u->deleted_at->format('d/m/Y') : null,
            'ua' => $u->last_login_at ? $u->last_login_at->format('d/m/Y H:i') : ($u->created_at ? $u->created_at->format('d/m/Y H:i') : 'Recente'),
            'mod' => $cfg['mod'],
            'av' => $isDeleted ? 'bg-gradient-to-br from-slate-400 to-slate-500' : $cfg['av'],
            'ini' => $ini ?: 'US',
            'created_at' => $u->created_at ? $u->created_at->format('d/m/Y') : 'Recente',
            'data' => $u->created_at ? $u->created_at->format('d/m/Y') : 'Recente'
        ];
    }
}
