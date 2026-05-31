<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Verify OTP | From Broolé</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700;800;900&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen bg-[#f7f2f1] flex items-center justify-center p-4 overflow-hidden">

<div class="w-full max-w-md bg-white rounded-[2.5rem] shadow-[0_30px_60px_-15px_rgba(107,13,13,0.15)] p-8 md:p-10">

    <!-- BACK -->
    <div class="mb-6">

        <a
            href="/forgot-password"
            class="flex items-center gap-2 text-gray-400 hover:text-[#8d1010] transition-all font-bold text-sm"
        >
            ← Back
        </a>

    </div>

    <!-- HEADER -->
    <div class="text-center mb-8">

        <div class="w-20 h-20 bg-[#8d1010]/10 rounded-full flex items-center justify-center mx-auto mb-5">

            <img
                src="{{ asset('images/logo_from_broole.png') }}"
                class="w-14 h-14 object-contain"
            >
        </div>

        <h1 class="text-4xl font-black text-[#2a1111] tracking-tight mb-3">
            Verify Reset Code
        </h1>

        <p class="text-gray-500 font-medium leading-relaxed">
            Enter the 6-digit verification code sent to your email
        </p>
    </div>

    <!-- ERROR -->
    @if ($errors->any())

    <div
        id="errorModal"
        class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50"
    >

        <div class="bg-white w-[90%] max-w-md rounded-[2rem] p-8 shadow-2xl text-center">

            <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-5">

                <span class="text-4xl">
                    ⚠️
                </span>

            </div>

            <h2 class="text-3xl font-black text-[#2a1111] mb-3">
                Oops!
            </h2>

            <p class="text-gray-500 font-medium mb-6 leading-relaxed">
                {{ $errors->first() }}
            </p>

            <button
                onclick="document.getElementById('errorModal').style.display='none'"
                class="bg-[#8d1010] hover:bg-[#741010] transition-all text-white px-8 py-3 rounded-2xl font-black"
            >
                Try Again
            </button>

        </div>

    </div>

    @endif

    <!-- FORM -->
    <form method="POST" action="/verify-reset-otp" class="space-y-5">
        @csrf

        <div>

            <label class="block text-[10px] uppercase tracking-[0.25em] text-gray-500 font-black mb-3">
                Verification Code
            </label>

            <input
                type="text"
                name="otp"
                maxlength="6"
                placeholder="000000"
                required
                class="w-full px-6 py-5 bg-[#f5f3f3] border border-[#f0e6e6] rounded-3xl text-center text-3xl tracking-[0.45em] font-black text-[#2a1111] outline-none focus:bg-white focus:ring-4 focus:ring-[#8d1010]/10 transition-all"
            >
        </div>

        <button
            type="submit"
            class="w-full py-4 bg-[#a30808] hover:bg-[#870707] transition-all text-white rounded-2xl font-black text-lg shadow-[0_20px_40px_-15px_rgba(163,8,8,0.45)]"
        >
            Verify Code
        </button>

    </form>

    <!-- RESEND -->
    <div class="mt-6 text-sm font-bold flex justify-end">

        <button
            id="resendBtn"
            disabled
            class="text-gray-400 cursor-not-allowed transition-all"
        >
            Resend OTP in <span id="timer">180</span>s
        </button>

    </div>

</div>

<script>

    let timeLeft = 60;

    const resendBtn = document.getElementById('resendBtn');

    function startCountdown() {

        resendBtn.innerHTML =
            `Resend OTP in <span id="timer">${timeLeft}</span>s`;

        const countdown = setInterval(() => {

            timeLeft--;

            document.getElementById('timer').innerText = timeLeft;

            if (timeLeft <= 0) {

                clearInterval(countdown);

                resendBtn.disabled = false;

                resendBtn.innerHTML = 'Resend OTP';

                resendBtn.classList.remove(
                    'text-gray-400',
                    'cursor-not-allowed'
                );

                resendBtn.classList.add(
                    'text-[#8d1010]',
                    'hover:underline'
                );

                resendBtn.onclick = async () => {

                    const response = await fetch('/resend-reset-otp', {

                        method: 'POST',

                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        }

                    });

                    const data = await response.json();

                    if (data.success) {

                        const toast =
                            document.getElementById('successToast');

                        toast.classList.remove('hidden');

                        setTimeout(() => {

                            toast.classList.add('hidden');

                        }, 2500);

                        timeLeft = 60;

                        resendBtn.disabled = true;

                        resendBtn.classList.remove(
                            'text-[#8d1010]',
                            'hover:underline'
                        );

                        resendBtn.classList.add(
                            'text-gray-400',
                            'cursor-not-allowed'
                        );

                        startCountdown();
                    }
                };
            }

        }, 1000);
    }

    startCountdown();

</script>

<div
    id="successToast"
    class="hidden fixed top-6 right-6 bg-[#8d1010] text-white px-6 py-4 rounded-2xl shadow-2xl z-50 font-bold"
>
    OTP resent successfully ✨
</div>

</body>
</html>