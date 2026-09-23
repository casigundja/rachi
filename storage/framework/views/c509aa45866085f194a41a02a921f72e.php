<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sessão - RACHI</title>
    <link rel="icon" type="image/x-icon" href="https://hom.rachi.ao/assets/img/logo-rachi-light.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&display=swap" rel="stylesheet">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f1f4f9;
            background-image: 
                radial-gradient(at 15% 15%, rgba(0, 163, 224, 0.04) 0px, transparent 50%),
                radial-gradient(at 85% 85%, rgba(235, 167, 45, 0.04) 0px, transparent 50%);
        }
        .login-card {
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 20px 45px -10px rgba(7, 19, 38, 0.08), 0 0 0 1px rgba(7, 19, 38, 0.04);
        }
        .form-input {
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            color: #0f172a;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }
        .form-input:focus {
            outline: none;
            border-color: #071326;
            box-shadow: 0 0 0 3px rgba(7, 19, 38, 0.08);
        }
        .form-input::placeholder {
            color: #94a3b8;
            font-size: 0.92rem;
        }
        .btn-submit {
            background-color: #071326;
            transition: all 0.2s ease;
        }
        .btn-submit:hover {
            background-color: #0f2444;
            transform: translateY(-1px);
            box-shadow: 0 8px 20px -4px rgba(7, 19, 38, 0.3);
        }
        .btn-submit:active {
            transform: translateY(0);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 sm:p-6 text-[#0f172a]">

    <main class="w-full max-w-[460px]">
        <div class="login-card p-7 sm:p-10">
            <!-- Header Label -->
            <div class="text-[11px] sm:text-xs font-bold tracking-[0.2em] text-[#b5893a] uppercase mb-2">
                ACESSO RACHI
            </div>

            <!-- Heading -->
            <h1 class="text-2xl sm:text-[28px] font-bold text-[#071326] tracking-tight leading-tight mb-2.5">
                Iniciar sessão
            </h1>

            <!-- Subtitle -->
            <p class="text-[13px] sm:text-[13.5px] text-[#475569] leading-relaxed mb-6 font-normal">
                Todos os utilizadores acedem pelo mesmo login. Use o e-mail e a palavra-passe da sua conta RACHI.
            </p>

            <?php if($errors->any()): ?>
                <div class="mb-5 bg-red-50 border border-red-200 text-red-700 p-3.5 rounded-xl text-xs sm:text-sm">
                    <ul class="list-disc list-inside space-y-1">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if(session('status')): ?>
                <div class="mb-5 bg-emerald-50 border border-emerald-200 text-emerald-700 p-3.5 rounded-xl text-xs sm:text-sm">
                    <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?>

            <!-- Dica de Acesso Rápido -->
            <div class="mb-5 p-3 rounded-xl bg-slate-50 border border-slate-200/80 text-xs text-slate-600 flex items-center justify-between gap-2">
                <div>
                    <span class="font-bold text-[#071326] block">Acesso Administrador:</span>
                    <span class="text-slate-500 font-mono text-[11px]">admin@rachi.ao • admin123</span>
                </div>
                <button type="button" onclick="document.getElementById('email').value='admin@rachi.ao';document.getElementById('password').value='admin123';" class="px-2.5 py-1.5 bg-[#071326] text-white rounded-lg font-semibold hover:bg-slate-800 transition text-[11px] shrink-0">
                    Preencher
                </button>
            </div>

            <!-- Form -->
            <form method="POST" action="<?php echo e(route('login.post')); ?>" class="space-y-4">
                <?php echo csrf_field(); ?>
                <div>
                    <label for="email" class="block text-[13px] font-semibold text-[#071326] mb-1.5">
                        E-mail
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="<?php echo e(old('email')); ?>" 
                        placeholder="o.seu@email.com" 
                        required 
                        autofocus
                        class="w-full px-4 py-3 form-input"
                    >
                </div>

                <div>
                    <label for="password" class="block text-[13px] font-semibold text-[#071326] mb-1.5">
                        Palavra-passe
                    </label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="Introduza a sua palavra-passe" 
                        required 
                        class="w-full px-4 py-3 form-input"
                    >
                    <div class="mt-2 text-left">
                        <a href="#" class="text-xs text-[#1d4ed8] hover:underline font-medium">
                            Esqueceu a palavra-passe?
                        </a>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-3.5 px-6 btn-submit text-white font-bold text-xs sm:text-sm tracking-wider uppercase rounded-xl flex items-center justify-center gap-2">
                        <span>ENTRAR</span>
                        <span class="text-base leading-none">&rarr;</span>
                    </button>
                </div>
            </form>

            <!-- Footer Links -->
            <div class="mt-8 text-center space-y-4 text-xs sm:text-[13px]">
                <p class="text-[#475569]">
                    Ainda não tem conta? 
                    <a href="<?php echo e(route('register')); ?>" class="font-bold text-[#1d4ed8] hover:underline">
                        Criar conta
                    </a>
                </p>

                <p class="text-[#475569] leading-relaxed">
                    Recebeu o e-mail de activação? 
                    <a href="#" class="font-bold text-[#1d4ed8] hover:underline">
                        Activar conta e definir palavra-passe
                    </a>
                </p>

                <div class="pt-1">
                    <a href="<?php echo e(route('home')); ?>" class="inline-block font-bold text-[#1d4ed8] hover:underline">
                        Voltar à loja
                    </a>
                </div>
            </div>
        </div>
    </main>

</body>
</html>
<?php /**PATH C:\Users\casimiro.gundja\Documents\rachi\resources\views/auth/login.blade.php ENDPATH**/ ?>