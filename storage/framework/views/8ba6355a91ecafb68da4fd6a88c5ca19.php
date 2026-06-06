<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>From Broolé</title>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700;800;900&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background: linear-gradient(-45deg, #F8F5F2, #fae6e6, #fff0f5, #f5e8df);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .animate-fade-in-up {
            opacity: 0;
            animation: fadeInUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
        }
        
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }
        .delay-500 { animation-delay: 0.5s; }

        @keyframes floating {
            0%   { transform: translateY(0px) rotate(0deg); }
            50%  { transform: translateY(-30px) rotate(8deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }
        .floating {
            animation: floating 7s ease-in-out infinite;
        }

        /* ── CARD WRAPPER ── */
        .login-card {
            width: 100%;
            max-width: 56rem;              /* max-w-4xl */
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 2.5rem;
            box-shadow: 0 40px 80px -20px rgba(107,13,13,0.15), inset 0 0 0 1px rgba(255,255,255,0.5);
            overflow: hidden;
            display: flex;
            flex-direction: row;           /* side-by-side on desktop */
            min-height: 750px;
            
            opacity: 0;
            animation: fadeInUp 1s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
        }

        /* ── LEFT PANEL ── */
        .login-left {
            width: 45%;
            flex-shrink: 0;
            background: #7a0d0d;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem;
            color: white;
        }

        /* ── RIGHT PANEL ── */
        .login-right {
            flex: 1;
            background: transparent;
            padding: 4rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow-y: auto;
        }

        /* ── MOBILE ── */
        @media (max-width: 767px) {
            body {
                padding: 0 !important;
                align-items: stretch !important;
                min-height: 100dvh;
            }

            .login-card {
                flex-direction: column;    /* stack on mobile */
                border-radius: 0;
                min-height: 100dvh;
                max-width: 100%;
                box-shadow: none;
            }

            .login-left {
                width: 100%;
                min-height: 340px;
                padding: 3rem 2rem 2.5rem;
                border-radius: 0 0 2.5rem 2.5rem;
            }

            /* shrink logo circle */
            .login-left .logo-circle {
                width: 7rem !important;
                height: 7rem !important;
                margin-bottom: 1.5rem !important;
            }

            .login-left h2 {
                font-size: 2rem !important;
                margin-bottom: 0.5rem !important;
            }

            .login-left p {
                font-size: 0.95rem !important;
            }

            .login-right {
                padding: 2.5rem 1.5rem 3rem;
                flex: unset;
            }

            .login-right h1 {
                font-size: 2.2rem !important;
            }

            /* hide bottom branding text on very small screens */
            .login-branding span {
                font-size: 0.6rem;
            }
        }

        /* ── TABLET (768px – 1023px) ── */
        @media (min-width: 768px) and (max-width: 1023px) {
            .login-card {
                min-height: 700px;
            }

            .login-left {
                width: 42%;
                padding: 2.5rem;
            }

            .login-right {
                padding: 2.5rem 3rem;
            }
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4 md:p-8 overflow-x-hidden relative">

<!-- Decorative Background Blobs -->
<div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-red-200 rounded-full mix-blend-multiply filter blur-[100px] opacity-70 animate-fade-in-up delay-200"></div>
<div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-yellow-200 rounded-full mix-blend-multiply filter blur-[100px] opacity-70 animate-fade-in-up delay-500"></div>

<div class="login-card z-10">

    
    <div class="login-left">

        <!-- Radial gradient overlay -->
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_rgba(255,255,255,0.15),transparent,rgba(0,0,0,0.2))]"></div>

        <!-- Floating food assets -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <img src="<?php echo e(asset('images/oreo_broole.png')); ?>"       class="absolute opacity-40 blur-[1px] w-[96px] top-[15%] left-[10%] floating" >
            <img src="<?php echo e(asset('images/strawberry_broole.png')); ?>" class="absolute opacity-40 blur-[1px] w-[80px] top-[10%] left-[85%] floating" style="animation-delay:1s">
            <img src="<?php echo e(asset('images/matcha_broole.png')); ?>"     class="absolute opacity-40 blur-[1px] w-[90px] top-[80%] left-[75%] floating" style="animation-delay:2s">
            <img src="<?php echo e(asset('images/toa.png')); ?>"               class="absolute opacity-40 blur-[1px] w-[50px] top-[75%] left-[20%] floating" style="animation-delay:1.5s">
            <img src="<?php echo e(asset('images/choco_broole.png')); ?>"      class="absolute opacity-40 blur-[1px] w-[70px] top-[60%] left-[5%]  floating" style="animation-delay:0.5s">
            <img src="<?php echo e(asset('images/letter.png')); ?>"            class="absolute opacity-40 blur-[1px] w-[80px] top-[50%] left-[90%] floating" style="animation-delay:3s">
            <img src="<?php echo e(asset('images/bow.png')); ?>"               class="absolute opacity-40 blur-[1px] w-[70px] top-[40%] left-[5%]  floating" style="animation-delay:2.5s">
        </div>

        <!-- Logo + text -->
        <div class="relative z-10 text-center">
            <div class="logo-circle w-40 h-40 bg-white rounded-full flex items-center justify-center mx-auto mb-10 shadow-2xl ring-[12px] ring-white/10">
                <img src="<?php echo e(asset('home_assets/logo.png')); ?>" class="w-full h-full object-contain p-3">
            </div>
            <h2 class="text-4xl font-black tracking-tight mb-4">From Broolé</h2>
            <p class="text-xl text-white/80 font-medium text-balance leading-relaxed">
                Indulge in our exquisite desserts,<br>crafted with love and the finest ingredients.
            </p>
        </div>

        <!-- Bottom branding -->
        <div class="login-branding absolute bottom-6 left-10 flex items-center gap-3">
            <div class="w-8 h-8 bg-white/20 rounded flex items-center justify-center p-1.5 backdrop-blur-sm">
                <img src="<?php echo e(asset('images/spork.png')); ?>" class="w-full h-full object-contain brightness-0 invert">
            </div>
            <span class="text-xs font-black uppercase tracking-[0.3em] opacity-50">From Broole to You</span>
        </div>
    </div>

    
    <div class="login-right">
        <div class="max-w-md mx-auto w-full">

            <!-- Heading -->
            <div class="mb-8 animate-fade-in-up delay-100">
                <h1 class="text-4xl md:text-5xl font-black text-[#2a1111] tracking-tighter mb-2 leading-tight">
                    Welcome Back
                </h1>
                <p class="text-base text-gray-500 font-medium">Continue your sweet journey</p>
            </div>

            <!-- Google -->
            <div class="mb-8 animate-fade-in-up delay-200">
                <a href="/auth/google"
                   class="w-full py-4 px-6 bg-white border border-[#f0eaea] rounded-2xl flex items-center justify-center gap-3 font-bold text-lg text-[#2a1111] hover:bg-[#faf7f7] transition-all hover:shadow-md hover:-translate-y-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 48 48">
                        <path fill="#FFC107" d="M43.611 20.083H42V20H24v8h11.303C33.659 32.657 29.249 36 24 36c-6.627 0-12-5.373-12-12s5.373-12 12-12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.27 4 24 4 12.955 4 4 12.955 4 24s8.955 20 20 20 20-8.955 20-20c0-1.341-.138-2.65-.389-3.917z"/>
                        <path fill="#FF3D00" d="M6.306 14.691l6.571 4.819C14.655 15.108 18.961 12 24 12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.27 4 24 4 16.318 4 9.656 8.337 6.306 14.691z"/>
                        <path fill="#4CAF50" d="M24 44c5.177 0 9.86-1.977 13.409-5.192l-6.19-5.238C29.211 35.091 26.715 36 24 36c-5.228 0-9.627-3.316-11.283-7.946l-6.522 5.025C9.505 39.556 16.227 44 24 44z"/>
                        <path fill="#1976D2" d="M43.611 20.083H42V20H24v8h11.303c-1.058 2.996-3.06 5.418-5.684 6.97l.003-.002 6.19 5.238C35.377 39.552 44 34 44 24c0-1.341-.138-2.65-.389-3.917z"/>
                    </svg>
                    Continue with Google
                </a>
            </div>

            <!-- Divider -->
            <div class="relative mb-8 animate-fade-in-up delay-300">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-[#ece4e4]"></div>
                </div>
                <div class="relative flex justify-center text-[10px] uppercase font-black tracking-[0.2em] text-gray-300">
                    <span class="bg-white/80 backdrop-blur-sm px-6 rounded-full">Or Manual sign in</span>
                </div>
            </div>

            <!-- Form -->
            <form method="POST" action="/login" class="space-y-6 animate-fade-in-up delay-400">
                <?php echo csrf_field(); ?>

                <!-- Email -->
                <div class="space-y-3">
                    <label class="text-xs font-black uppercase tracking-widest text-gray-500 ml-2 block">Email</label>
                    <input
                        type="text" name="email" value="<?php echo e(old('email')); ?>"
                        placeholder="name@email.com"
                        class="w-full px-6 py-4 bg-[#f5f3f3] rounded-2xl focus:bg-white focus:ring-4 focus:ring-[#7a0d0d]/5 outline-none transition-all text-base font-medium">
                </div>

                <!-- Password -->
                <div class="space-y-3">
                    <label class="text-xs font-black uppercase tracking-widest text-gray-500 block">Password</label>
                    <div class="relative">
                        <input
                            type="password" id="password" name="password"
                            placeholder="••••••••"
                            class="w-full px-5 py-4 pr-14 bg-[#f5f3f3] rounded-2xl outline-none focus:ring-4 focus:ring-[#7a0d0d]/10 transition-all">
                        <button
                            type="button" id="eyeIcon" onclick="togglePassword()"
                            class="absolute right-5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#8d1010] transition-all z-10">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="flex justify-end">
                        <a href="/forgot-password" class="text-sm font-bold text-gray-400 hover:text-[#8d1010] transition-all">
                            Forgot Password?
                        </a>
                    </div>
                </div>

                <!-- Submit -->
                <button type="submit"
                    class="w-full py-5 bg-[#8d1010] text-white rounded-2xl font-black text-lg shadow-2xl shadow-[#8d1010]/20 flex items-center justify-center gap-3 hover:bg-[#781010] transition-all mt-4">
                    <span>Sign In</span>
                    <span class="text-xl">→</span>
                </button>
            </form>

            <!-- Footer -->
            <p class="text-center mt-10 text-gray-500 text-sm font-medium animate-fade-in-up delay-500">
                Are You new here?
                <a href="/register" class="text-[#8d1010] font-black hover:underline underline-offset-4 decoration-2">
                    Create an account
                </a>
            </p>

        </div>
    </div>
</div>


<?php if($errors->any()): ?>
<div id="errorModal" class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50">
    <div class="bg-white w-[90%] max-w-md rounded-[2rem] p-8 shadow-2xl text-center">
        <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-5">
            <span class="text-4xl">⚠️</span>
        </div>
        <h2 class="text-3xl font-black text-[#2a1111] mb-3">Login Failed</h2>
        <p class="text-gray-500 font-medium mb-6 leading-relaxed"><?php echo e($errors->first()); ?></p>
        <button onclick="document.getElementById('errorModal').style.display='none'"
            class="bg-[#8d1010] hover:bg-[#741010] transition-all text-white px-8 py-3 rounded-2xl font-black">
            Try Again
        </button>
    </div>
</div>
<?php endif; ?>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.classList.remove('text-gray-400');
        eyeIcon.classList.add('text-[#8d1010]');
    } else {
        passwordInput.type = 'password';
        eyeIcon.classList.remove('text-[#8d1010]');
        eyeIcon.classList.add('text-gray-400');
    }
}
</script>

</body>
</html><?php /**PATH D:\Herd\webdev-frombroole\resources\views/login.blade.php ENDPATH**/ ?>