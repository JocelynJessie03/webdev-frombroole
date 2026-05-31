<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Manage Profile</title>
</head>

<body class="bg-[#F8F5F2] text-[#2C2623]">

<div class="min-h-screen">

    {{-- NAVBAR --}}
    <header class="sticky top-0 z-50 bg-[#F5F4EE]/95 backdrop-blur-md border-b border-[#E0DED7]/40">

        <div class="w-full bg-[#9E1111] text-[#FAF9F5] text-[10px] tracking-[0.25em] font-black uppercase text-center py-1.5 px-4">
            ✨ SWEETNESS REDEFINED • EARN 10 PTS ON SIGNATURE DESSERT CUPS WITH FROM BROOLE ✨
        </div>

        <div class="h-[64px] px-6 lg:px-12 flex items-center justify-between">

            <a
                href="/customer"
                class="flex items-center gap-3"
            >

                <div class="w-10 h-10 rounded-xl bg-[#9E1111] flex items-center justify-center text-white shadow-md">
                    ✨
                </div>

                <span class="text-[15px] tracking-[0.28em] font-black uppercase text-[#8C1717]">
                    From Broole
                </span>

            </a>

            <div class="flex items-center gap-4">

                <button class="w-11 h-11 rounded-2xl bg-[#3D3833]/5 border border-[#3D3833]/5 flex items-center justify-center">
                    🛒
                </button>

                <img
                    src="https://i.pravatar.cc/100"
                    class="w-10 h-10 rounded-full border border-[#3D3833]/10 object-cover"
                >

                <span class="text-[10px] px-3 py-1 rounded-full bg-[#9E1111]/10 text-[#9E1111] font-black uppercase tracking-wider">
                    2100 pts
                </span>

            </div>

        </div>

    </header>


    {{-- CONTENT --}}
    <section class="max-w-6xl mx-auto px-6 lg:px-10 py-12">

        {{-- TOP --}}
        <div>

            <div class="flex items-center gap-3 text-[10px] uppercase tracking-[0.2em] font-black">

                <span class="bg-[#F2E9E7] text-[#9E1111] px-3 py-1 rounded-full">
                    Member Hub
                </span>

                <span class="text-[#D2A574]">
                    ✦
                </span>

                <span class="text-[#D67C00]">
                    Grand Valrhona Sovereign
                </span>

            </div>

            <h1 class="text-5xl lg:text-6xl font-black tracking-[-0.05em] mt-6">
                Manage Profile
            </h1>

            <p class="text-[#655F5A] mt-5 leading-relaxed max-w-2xl">
                Customize your From Broole gourmet identity, select bespoke member avatars,
                and check status points.
            </p>

        </div>

        <div class="border-t border-[#E5E0DA] mt-10 pt-10">

            <div class="grid grid-cols-1 lg:grid-cols-[0.8fr_1.2fr] gap-8">

                {{-- LEFT --}}
                <div class="space-y-6">

                    {{-- MEMBER CARD --}}
                    <div class="relative overflow-hidden rounded-[36px] p-8 text-white bg-gradient-to-br from-[#700014] via-[#B00020] to-[#4D342E] shadow-[0_30px_60px_rgba(140,23,23,0.35)]">

                        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(255,255,255,0.15),transparent_40%)]"></div>

                        <div class="relative z-10">

                            <span class="text-[10px] uppercase tracking-[0.2em] font-black text-white/70">
                                Loyalty Member Tier
                            </span>

                            <h2 class="text-4xl font-black leading-[0.95] mt-4">
                                Grand Valrhona
                                <br>
                                Sovereign
                            </h2>

                            <div class="mt-12">

                                <span class="text-[10px] uppercase tracking-widest text-white/70 font-black">
                                    Accumulated Points
                                </span>

                                <div class="flex items-end gap-2 mt-3">

                                    <span class="text-6xl font-black leading-none">
                                        2100
                                    </span>

                                    <span class="font-black mb-2">
                                        PTS
                                    </span>

                                </div>

                            </div>

                            <div class="mt-10">

                                <div class="flex items-center justify-between text-[10px] uppercase tracking-wider font-black">

                                    <span>
                                        Progress to next tier
                                    </span>

                                    <span>
                                        Zenith Level
                                    </span>

                                </div>

                                <div class="h-2 rounded-full bg-white/20 mt-3 overflow-hidden">

                                    <div class="h-full w-full bg-white rounded-full"></div>

                                </div>

                                <p class="text-[10px] text-white/70 mt-4">
                                    You have reached peak membership luxury.
                                </p>

                            </div>

                        </div>

                    </div>

                    {{-- PRIVILEGES --}}
                    <div class="bg-[#F1EEEA] border border-[#E5E0DA] rounded-[28px] p-6">

                        <h3 class="font-black uppercase tracking-wide text-sm">
                            ✨ Tier Privileges
                        </h3>

                        <p class="text-sm text-[#655F5A] leading-relaxed mt-5">
                            The absolute zenith of fine dessert appreciation.
                            You hold the royal scepter of our pastry kitchen.
                        </p>

                        <div class="border-t border-[#DDD7D1] mt-6 pt-5">

                            <div class="flex items-center gap-2 text-[#9E1111] text-xs font-black uppercase tracking-wide">

                                <span>
                                    ⊚
                                </span>

                                <span>
                                    Verified VIP Member
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- RIGHT --}}
                <div class="bg-[#F1EEEA] border border-[#E5E0DA] rounded-[36px] p-8">

                    <form class="space-y-8">

                        {{-- NAME --}}
                        <div>

                            <label class="text-[10px] uppercase tracking-[0.15em] font-black text-[#9B938B]">
                                Full Name / Display Name
                            </label>

                            <div class="mt-3 relative">

                                <input
                                    type="text"
                                    value="Sweet Guest"
                                    class="w-full h-14 rounded-2xl border border-[#D9D4CE] bg-[#F7F5F2] px-5 font-bold outline-none"
                                >

                            </div>

                        </div>

                        {{-- PHONE --}}
                        <div>

                            <label class="text-[10px] uppercase tracking-[0.15em] font-black text-[#9B938B]">
                                Phone Number
                            </label>

                            <div class="mt-3">

                                <input
                                    type="text"
                                    value="08123456789"
                                    class="w-full h-14 rounded-2xl border border-[#D9D4CE] bg-[#F7F5F2] px-5 font-bold outline-none"
                                >

                            </div>

                        </div>

                        {{-- EMAIL --}}
                        <div>

                            <div class="flex items-center justify-between">

                                <label class="text-[10px] uppercase tracking-[0.15em] font-black text-[#9B938B]">
                                    Email Account
                                </label>

                                <span class="text-[9px] uppercase font-black bg-[#E8E2DD] px-3 py-1 rounded-full text-[#9B938B]">
                                    Non-Modifiable
                                </span>

                            </div>

                            <div class="mt-3">

                                <input
                                    type="email"
                                    value="guest@fromblade.com"
                                    disabled
                                    class="w-full h-14 rounded-2xl border border-[#D9D4CE] bg-[#F7F5F2] px-5 font-bold outline-none opacity-60"
                                >

                            </div>

                        </div>

                        {{-- AVATAR --}}
                        <div>

                            <label class="text-[10px] uppercase tracking-[0.15em] font-black text-[#9B938B]">
                                📸 Bespoke Member Avatar
                            </label>

                            <div class="flex mt-5 bg-[#E8E3DE] rounded-2xl p-1">

                                <button
                                    type="button"
                                    class="flex-1 h-10 rounded-xl bg-white text-[#9E1111] text-[10px] font-black uppercase tracking-wider shadow-sm"
                                >
                                    Preset Avatars
                                </button>

                                <button
                                    type="button"
                                    class="flex-1 h-10 rounded-xl text-[#7B736D] text-[10px] font-black uppercase tracking-wider"
                                >
                                    Custom Avatar URL
                                </button>

                            </div>

                            {{-- AVATARS --}}
                            <div class="flex flex-wrap gap-3 mt-5">

                                @for($i=0;$i<5;$i++)

                                <button
                                    type="button"
                                    class="w-16 h-16 rounded-2xl border border-[#D9D4CE] bg-[#F7F5F2] hover:border-[#9E1111] transition"
                                >

                                </button>

                                @endfor

                            </div>

                        </div>

                        {{-- SAVE --}}
                        <button
                            class="w-full h-16 rounded-2xl bg-[#9E1111] text-white font-black uppercase tracking-[0.3em] shadow-[0_20px_40px_rgba(140,23,23,0.25)] hover:scale-[1.01] transition"
                        >
                            Save Profile
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </section>

</div>

</body>
</html>