@extends('layouts.app')

@section('content')

@php

$signatureDesserts = [

[
'name' => 'Broole',
'price' => 'Rp 45.000',
'image' => '/home_assets/fb_broole.png',
'tagline' => 'Crunchy Sophistication',
'desc' => 'Velvet layers of pure dark cacao fudge soil paired with fluffy white cheese creme.',
'ingredients' => [

[
'image' => '/home_assets/berry.png',
'class' => 'left-[2%] top-[2%] lg:left-[8%] lg:top-[4%]',
'size' => 'w-[115px] h-[115px]'
],

[
'image' => '/home_assets/berry.png',
'class' => 'right-[0%] top-[50%] lg:right-[3%] lg:top-[48%]',
'size' => 'w-[120px] h-[120px]'
]

]
],

[
'name' => 'Latte',
'price' => 'Rp 52.000',
'image' => '/home_assets/fb_drink.png',
'tagline' => 'Earthy Royalty',
'desc' => 'Ceremonial-grade Kyoto matcha powder whipped into decadent cream.',
'ingredients' => [

[
'image' => '/home_assets/coffee1.png',
'class' => 'left-[2%] top-[2%] lg:left-[8%] lg:top-[4%]',
'size' => 'w-[120px] h-[120px]'
],

[
'image' => '/home_assets/coffee1.png',
'class' => 'right-[2%] top-[65%] lg:right-[2%] lg:top-[52%]',
'size' => 'w-[110px] h-[110px]'
]

]
],

[
'name' => 'Cheesecake',
'price' => 'Rp 46.000',
'image' => '/home_assets/fb_cake.png',
'tagline' => 'Fudge Indulgence',
'desc' => 'Dense dark Belgian chocolate cocoa crumb with silky fudge ganache.',
'ingredients' => [

[
'image' => '/home_assets/oreo1.png',
'class' => 'left-[2%] top-[2%] lg:left-[8%] lg:top-[4%]',
'size' => 'w-[120px] h-[120px]'
],

[
'image' => '/home_assets/oreo1.png',
'class' => 'right-[2%] top-[65%] lg:right-[2%] lg:top-[52%]',
'size' => 'w-[110px] h-[110px]'
]

]
]

];


$masterpieces = [
[
'name' => 'Cheesecake',
'price' => 'Rp 49.000',
'image' => '/home_assets/cake.png',
'category' => 'Cheesecake',
'tagline' => 'Layered Delight',
'desc' => 'Silky cream cheese layered with lotus crumble and luxurious artisan textures.'
],

[
'name' => 'Broole',
'price' => 'Rp 45.000',
'image' => '/home_assets/broole.png',
'category' => 'Broole',
'tagline' => 'Creamy Luxury',
'desc' => 'Velvet layers of pure dark cacao fudge soil paired with fluffy white cheese creme.'
],


[
'name' => 'Craft Drinks',
'price' => 'Rp 52.000',
'image' => '/home_assets/craft_drink.png',
'category' => 'Drink',
'tagline' => 'Flavorful Goodness',
'desc' => 'Kyoto ceremonial matcha whipped into luxurious cream and elegant textures.'
]

];


@endphp


<div
x-data="{
currentSlide:0,
desserts: {{ Js::from($signatureDesserts) }}
}"
class="pb-20 bg-[#F8F5F2]"
>

{{-- ================= HERO ================= --}}
<section class="relative overflow-hidden bg-gradient-to-r from-[#F7ECEB] via-[#F5F2EE] to-[#EFECE7] text-[#3D3833] py-10 px-6 sm:px-10 lg:px-16 rounded-b-[48px] shadow-sm min-h-[980px] lg:min-h-[760px] flex items-center">

    {{-- BIG BG TEXT --}}
    <div class="absolute right-[5%] top-1/2 -translate-y-1/2 select-none pointer-events-none z-0">

        <h2
            x-text="desserts[currentSlide].name"
            class="hidden lg:block font-black tracking-[-0.08em] uppercase text-[#3D3833] leading-none text-[10rem] lg:text-[16rem] opacity-[0.03]"
        ></h2>

    </div>

    {{-- GLOW --}}
    <div class="absolute right-[18%] top-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-[#F6D8B8]/25 blur-3xl rounded-full z-0"></div>

    {{-- FLOATING INGREDIENTS --}}
    <template x-for="(ing,index) in desserts[currentSlide].ingredients" :key="index">

        <div
            class="absolute z-20 animate-bounce"
            :class="ing.class"
        >

            <img
                :src="ing.image"
                :class="ing.size"
                class="object-contain drop-shadow-[0_20px_30px_rgba(0,0,0,0.18)]"
            >

        </div>

    </template>

    {{-- CONTENT --}}
    <div class="max-w-7xl w-full mx-auto relative z-20 grid grid-cols-1 lg:grid-cols-[0.9fr_1.1fr] items-center gap-4 lg:gap-0">

        {{-- LEFT --}}
        <div class="relative z-30 max-w-[520px] pl-2 lg:pl-6">

            <div class="inline-flex items-center gap-2 bg-white/70 backdrop-blur-sm border border-[#8C1717]/10 px-5 py-2 rounded-full shadow-sm mb-8">

                <span class="text-[10px] uppercase tracking-[0.25em] font-black text-[#8C1717]">
                    Sweetness Redefined
                </span>

            </div>

            <h1 class="text-5xl lg:text-7xl font-black leading-[0.88] tracking-[-0.06em] text-[#2C2623]">
                From
                <br>
                Broole
            </h1>

            <h2 class="text-4xl lg:text-6xl font-black leading-[0.9] tracking-[-0.05em] text-[#8C1717] mt-5">
                Crafted Dessert
                <br>
                Experience
            </h2>

            <p class="text-[17px] leading-[1.8] text-[#655F5A] mt-7 max-w-[500px]">
                Handcrafted premium desserts layered with luxurious textures and elegant visual artistry.
            </p>

            <div class="flex items-center gap-4 mt-10">

                <div class="flex flex-wrap gap-5 mt-10">

    <a href="{{ route('customer.shop') }}"
       class="inline-flex items-center justify-center bg-[#8C1717] text-white px-8 py-4 rounded-full text-sm font-black uppercase tracking-[0.15em] shadow-[0_20px_40px_rgba(140,23,23,0.25)] hover:bg-[#751313] transition-all duration-300">
        Order Now
    </a>

    <a href="{{ route('customer.about') }}"
       class="inline-flex items-center justify-center bg-white/90 backdrop-blur-sm border border-[#3D3833]/10 text-[#3D3833] px-8 py-4 rounded-full text-sm font-black uppercase tracking-[0.15em] shadow-sm hover:bg-white transition-all duration-300">
        Discover More
    </a>

</div>

            </div>

        </div>

        {{-- RIGHT --}}
        <div class="relative flex items-center justify-center min-h-[500px] lg:min-h-[650px] pt-10 lg:pt-0">

            {{-- LEFT ARROW --}}
            <button
                @click="currentSlide = currentSlide === 0 ? desserts.length - 1 : currentSlide - 1"
                class="absolute left-[2%] lg:left-[-2%] top-1/2 -translate-y-1/2 z-40 w-14 h-14 rounded-full bg-white/90 backdrop-blur-sm border border-[#3D3833]/10 shadow-xl flex items-center justify-center"
            >
                ←
            </button>

            {{-- RIGHT ARROW --}}
            <button
                @click="currentSlide = currentSlide === desserts.length - 1 ? 0 : currentSlide + 1"
                class="absolute right-[2%] lg:right-[-2%] top-1/2 -translate-y-1/2 z-40 w-14 h-14 rounded-full bg-white/90 backdrop-blur-sm border border-[#3D3833]/10 shadow-xl flex items-center justify-center"
            >
                →
            </button>

            {{-- PRODUCT --}}
            <div class="relative z-30 flex flex-col items-center">

                <img
    :src="desserts[currentSlide].image"
    :alt="desserts[currentSlide].name"

    x-data="{ rotate: 0 }"

    @mousemove="
        rotate = (($event.offsetX / $event.target.offsetWidth) - 0.5) * 40
    "

    @mouseleave="
        rotate = 0
    "

    :style="`
        transform:
        perspective(1000px)
        rotateY(${rotate}deg);
    `"

    class="
    hero-product
    w-[260px]
    sm:w-[320px]
    lg:w-[600px]
    object-contain
    transition-all
    duration-300
    "

>

                {{-- INFO --}}
                <div class="relative lg:absolute lg:bottom-[1%] text-center max-w-[380px] mt-6 lg:mt-0">

                    <span
                        x-text="desserts[currentSlide].tagline"
                        class="font-black uppercase tracking-[0.3em] text-[#8C1717] text-xs"
                    ></span>

                    <p
                        x-text="desserts[currentSlide].desc"
                        class="text-[15px] text-[#655F5A] italic mt-4 leading-[1.8]"
                    ></p>

                </div>

            </div>

        </div>

    </div>

</section>


<section class="overflow-hidden bg-gradient-to-r from-[#6E0D12] via-[#8C1717] to-[#6E0D12] py-5">

    <div class="marquee">

        <div class="marquee-content">

            ✦ HANDCRAFTED DAILY

            ✦ PREMIUM INGREDIENTS

            ✦ SWEETNESS REDEFINED

            ✦ FROM BROOLE

            ✦ ARTISAN DESSERTS

            ✦ HANDCRAFTED DAILY

            ✦ PREMIUM INGREDIENTS

            ✦ SWEETNESS REDEFINED

            ✦ FROM BROOLE

            ✦ ARTISAN DESSERTS

        </div>

    </div>

</section>

{{-- ================= MASTERPIECE ================= --}}
<section class="max-w-[1800px] mx-auto px-10 mt-28">

    {{-- HEADER --}}
    <div class="text-center max-w-3xl mx-auto">

        <span class="text-[#8C1717] font-black text-[10px] uppercase tracking-[0.3em]">
            Our Signature Pillars
        </span>

        <h2 class="text-5xl lg:text-7xl font-black tracking-[-0.06em]  leading-[0.92] mt-10">

            From Broole Masterpiece

        </h2>

        <p class="text-[#655F5A] leading-[1.9] text-[15px] mt-7">
            Evolving from fine gourmet traditions to redefined luxury,
            explore the three elite product groups that form the cornerstone
            of Blade.
        </p>

    </div>


    {{-- CARDS --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8 mt-20">

        @foreach($masterpieces as $index => $item)

        <div
        class="group relative rounded-[30px] border transition-all duration-700 hover:-translate-y-3"

        :class="{
        'bg-[#241915] border-[#5B4337] hover:shadow-[0_35px_90px_rgba(36,25,21,0.55)]': {{ $index }} === 0,

        'bg-[#5A0C12] border-[#7A1A25] hover:shadow-[0_35px_90px_rgba(90,12,18,0.45)]': {{ $index }} === 1,

        'bg-[#A8874F] border-[#C8AE79] hover:shadow-[0_35px_90px_rgba(168,135,79,0.45)]': {{ $index }} === 2
        }"
        >

            {{-- TOP IMAGE --}}
            <div class="relative h-[290px] mx-5 mt-5 rounded-[24px] overflow-visible border border-white/10 bg-black/10 backdrop-blur-sm flex items-center justify-center px-8 py-8 group-hover:z-50 transition-all duration-700">

                {{-- CORNER DECOR --}}
                <div class="absolute left-5 top-5 text-[#EAD8D5] text-xl">
                    ✦
                </div>

                <div class="absolute right-5 top-5 text-[#C48B8B] text-xs">
                    ❈
                </div>

                <div class="absolute right-8 bottom-5 w-10 h-2 rounded-full bg-[#EFD9D7] rotate-[-20deg] opacity-60"></div>

                {{-- IMAGE --}}
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,rgba(255,255,255,0.14),transparent_70%)]"></div>

                <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/asfalt-light.png')]"></div>
                <img
                    src="{{ $item['image'] }}"
                    alt="{{ $item['name'] }}"
                    class="
                    relative z-20
                    object-contain
                    transition-all
                    duration-700
                    ease-out
                    group-hover:scale-110
                    group-hover:-translate-y-8

                    drop-shadow-[0_45px_55px_rgba(0,0,0,0.4)]

                    {{ $index === 0 ? 'w-[260px] lg:w-[320px]' : '' }}
                    {{ $index === 1 ? 'w-[250px] lg:w-[310px]' : '' }}
                    {{ $index === 2 ? 'w-[240px] lg:w-[300px]' : '' }}
                    "
                >

            </div>

            {{-- CONTENT --}}
            <div class="px-7 pt-6 pb-7">

                <span class="text-[10px] uppercase tracking-[0.25em] font-black text-[#E6C07B]">
                    {{ strtoupper($item['tagline']) }}
                </span>

                <h3 class="font-['Cormorant_Garamond'] text-[42px] leading-[0.9] font-bold text-[#F5EBDD] mt-5">

                    @if($index === 0)
                    Artisan Cheesecakes
                    @elseif($index === 1)
                    Broole Classics
                    @else
                    Craft Drinks
                    @endif

                </h3>

                <p class="text-[14px] leading-[1.9] text-white/75 mt-5">
                    {{ $item['desc'] }}
                </p>

                {{-- BUTTON --}}

                   <a
    href="@if($index === 0)
            {{ route('customer.shop', ['category' => 3]) }}
          @elseif($index === 1)
            {{ route('customer.shop', ['category' => 1]) }}
          @else
            {{ route('customer.shop', ['category' => 2]) }}
          @endif"
    class="mt-10 w-full h-16 rounded-[18px] border border-white/20 bg-white/5 backdrop-blur-sm hover:bg-white hover:text-[#2A211D] transition-all duration-500 text-[11px] uppercase tracking-[0.25em] font-black text-[#F5EBDD] flex items-center justify-center"
>

    @if($index === 0)
        Shop Artisan Cheesecakes
    @elseif($index === 1)
        Shop Broole Classics
    @else
        Shop Craft Drinks
    @endif

    →

</a>

            

            </div>

        </div>

        @endforeach

    </div>

</section>

{{-- ================= ABOUT ================= --}}

<section class="max-w-7xl mx-auto px-8 mt-32">

<div
class="
relative
overflow-hidden
rounded-[50px]
p-10
lg:p-20
bg-gradient-to-br
from-[#FFFDFB]
via-[#FFF8F4]
to-[#F6EEE8]
border
border-[#8C1717]/10
shadow-[0_30px_80px_rgba(140,23,23,0.08)]
grid
grid-cols-1
lg:grid-cols-2
gap-16
items-center
"
>
   

    {{-- LEFT --}}
    <div class="relative z-10">

        <span
        class="
        text-[#8C1717]
        font-black
        text-xs
        uppercase
        tracking-[0.35em]
        "
        >
            OUR STORY & CRAFT
        </span>

        <h2
        class="
        text-5xl
        lg:text-7xl
        font-black
        tracking-[-0.06em]
        text-[#2C2623]
        leading-[0.9]
        mt-5
        "
        >
            About <br>
            From Broole
        </h2>

        <p
        class="
        text-[#655F5A]
        text-lg
        leading-[2]
        mt-8
        max-w-xl
        "
        >
            Founded under the principle of Sweetness Redefined,
            From Broole is more than just a dessert brand.
            Every product is handcrafted with premium ingredients,
            artisan techniques, and attention to every detail.
        </p>

        <p
        class="
        text-[#655F5A]
        leading-[2]
        mt-5
        max-w-xl
        "
        >
            From creamy broole and artisan cheesecakes to refreshing
            beverages, every creation is designed to bring comfort,
            elegance, and memorable sweet moments.
        </p>

        {{-- STATS --}}
        <div class="grid grid-cols-3 gap-5 mt-12">

            <div
            class="
            bg-white/80
            backdrop-blur
            rounded-[24px]
            p-5
            border
            border-[#8C1717]/10
            shadow-sm
            hover:-translate-y-2
            hover:shadow-xl
            transition-all
            duration-500
            text-center
            "
            >
                <p class="text-3xl font-black text-[#8C1717]">
                    100%
                </p>

                <p class="text-[10px] uppercase tracking-[0.15em] font-bold text-[#655F5A] mt-2">
                    Premium Origin
                </p>
            </div>

            <div
            class="
            bg-white/80
            backdrop-blur
            rounded-[24px]
            p-5
            border
            border-[#8C1717]/10
            shadow-sm
            hover:-translate-y-2
            hover:shadow-xl
            transition-all
            duration-500
            text-center
            "
            >
                <p class="text-3xl font-black text-[#8C1717]">
                    Fresh
                </p>

                <p class="text-[10px] uppercase tracking-[0.15em] font-bold text-[#655F5A] mt-2">
                    Baked Daily
                </p>
            </div>

            <div
            class="
            bg-white/80
            backdrop-blur
            rounded-[24px]
            p-5
            border
            border-[#8C1717]/10
            shadow-sm
            hover:-translate-y-2
            hover:shadow-xl
            transition-all
            duration-500
            text-center
            "
            >
                <p class="text-3xl font-black text-[#8C1717]">
                    4.9★
                </p>

                <p class="text-[10px] uppercase tracking-[0.15em] font-bold text-[#655F5A] mt-2">
                    Customer Rating
                </p>
            </div>

        </div>

    </div>

    {{-- RIGHT --}}
    <div class="relative flex justify-center items-center">

        <div
        class="
        absolute
        w-[420px]
        h-[420px]
        bg-gradient-to-r
        from-[#FDE6D5]
        to-[#F8D9D9]
        rounded-full
        blur-[100px]
        opacity-70
        "
        ></div>

        <img
            src="{{ asset('home_assets/maskot.png') }}"
            alt="From Broole Mascot"
            class="
            relative
            z-10
            w-[420px]
            object-contain
            hover:scale-110
            transition-all
            duration-700
            drop-shadow-[0_40px_60px_rgba(0,0,0,0.18)]
            animate-[float_5s_ease-in-out_infinite]
            "
        >

    </div>

</div>
```

</section>

{{-- ================= WHY CHOOSE US ================= --}}
<section class="max-w-7xl mx-auto px-8 mt-28 pb-24">

    <div class="text-center mb-14">

        <span class="text-[#B88A44] font-black uppercase tracking-[0.35em] text-xs">
            WHY CHOOSE FROM BROOLE
        </span>

        <h2 class="text-5xl font-black tracking-[-0.05em] text-[#2C2623] mt-4">
            Crafted With Excellence
        </h2>

        <p class="text-[#7A736D] mt-5 max-w-2xl mx-auto leading-relaxed">
            Every dessert and beverage is handcrafted using premium ingredients,
            artisan techniques, and uncompromising quality standards.
        </p>

    </div>

    <div class="grid md:grid-cols-3 gap-8">

        {{-- CARD 1 --}}
<div class="group relative overflow-hidden bg-white rounded-[36px] p-10 border border-[#B88A44]/10 hover:-translate-y-3 transition duration-500 hover:shadow-[0_25px_60px_rgba(184,138,68,0.12)]">

    <img
    src="{{ asset('home_assets/hehe1.png') }}"
    alt="Pristine Hygiene"
    class="w-[320px] h-[280px] object-contain mx-auto"
/>


    <h3 class="mt-6 text-2xl font-black text-[#2C2623] text-center">
        Pristine Hygiene
    </h3>

    <p class="mt-4 text-[#6E675F] leading-relaxed text-center">
        Sterilized boutique kitchens following premium food safety standards.
    </p>

</div>



        {{-- CARD 2 --}}
        <div class="group relative overflow-hidden bg-gradient-to-br from-[#FFF8EE] to-[#FFFDFB] rounded-[36px] p-10 border border-[#D4AF37]/20 hover:-translate-y-3 transition duration-500 hover:shadow-[0_25px_60px_rgba(212,175,55,0.15)]">

          <img
    src="{{ asset('home_assets/hehe2.png') }}"
    alt="Artisan Standards"
    class="w-[280px] h-[280px] object-contain mx-auto"
/>
            <h3 class="mt-6 text-2xl font-black text-[#2C2623] text-center">
                Artisan Standards
            </h3>

            <p class="mt-4 text-[#6E675F] leading-relaxed text-center">
                Crafted in small batches with carefully selected ingredients.
            </p>

        </div>

        {{-- CARD 3 --}}
        <div class="group relative overflow-hidden bg-white rounded-[36px] p-10 border border-[#B88A44]/10 hover:-translate-y-3 transition duration-500 hover:shadow-[0_25px_60px_rgba(184,138,68,0.12)]">

         <img
    src="{{ asset('home_assets/hehe3.png') }}"
    alt="Fresh Delivery"
    class="w-[280px] h-[280px] object-contain mx-auto"
/>

            <h3 class="mt-6 text-2xl font-black text-[#2C2623] text-center">
                Fresh Delivery
            </h3>

            <p class="mt-4 text-[#6E675F] leading-relaxed text-center">
                Carefully packed and delivered to preserve freshness and texture.
            </p>

        </div>

    </div>

</section>
</div>


<style>

/* ─── ABOUT ─── */

.about-section{
    padding:120px 6vw;
    background:#0D0606;
}

.about-card{

    position:relative;

    overflow:hidden;

    max-width:1300px;

    margin:0 auto;

    background:
    linear-gradient(
        135deg,
        #151010 0%,
        #1B1111 50%,
        #140B0B 100%
    );

    border:1px solid rgba(140,23,23,.15);

    border-radius:40px;

    padding:80px;

    display:grid;

    grid-template-columns:1fr 1fr;

    gap:80px;

    align-items:center;

}

.about-watermark{

    position:absolute;

    right:-40px;

    bottom:-60px;

    font-size:220px;

    font-weight:900;

    line-height:1;

    color:#8C1717;

    opacity:.04;

    pointer-events:none;

    user-select:none;

}

.about-title{

    font-family:'Cormorant Garamond', serif;

    font-size:clamp(58px,6vw,90px);

    line-height:.9;

    color:#F0EAE4;

    margin-bottom:24px;

}

.about-title em{

    color:#8C1717;

    font-style:italic;

}

.about-p{

    color:#8A7A72;

    line-height:2;

    font-size:15px;

    max-width:520px;

    margin-bottom:50px;

}

.about-p strong{

    color:white;

}

.about-stats{

    display:grid;

    grid-template-columns:repeat(3,1fr);

    gap:16px;

}

.about-stat-card{

    background:rgba(255,255,255,.03);

    border:1px solid rgba(255,255,255,.05);

    border-radius:22px;

    padding:22px;

    text-align:center;

    transition:.4s;

}

.about-stat-card:hover{

    transform:translateY(-8px);

    border-color:rgba(140,23,23,.4);

    box-shadow:0 20px 40px rgba(140,23,23,.12);

}

.stat-val{

    display:block;

    font-size:32px;

    font-weight:800;

    color:#F0EAE4;

}

.stat-label{

    display:block;

    margin-top:8px;

    font-size:10px;

    text-transform:uppercase;

    letter-spacing:.2em;

    color:#8A7A72;

}

.about-right{

    position:relative;

    display:flex;

    justify-content:center;

    align-items:center;

}

.about-glow-big{

    position:absolute;

    width:500px;

    height:500px;

    border-radius:50%;

    background:rgba(140,23,23,.18);

    filter:blur(120px);

}

.about-mascot{

    position:relative;

    z-index:2;

    width:420px;

    object-fit:contain;

    filter:drop-shadow(0 40px 70px rgba(0,0,0,.5));

    animation:floatMain 6s ease-in-out infinite;

    transition:.5s;

}

.about-mascot:hover{

    transform:scale(1.08);

}

@media(max-width:1024px){

    .about-card{

        grid-template-columns:1fr;

        padding:50px;

    }

    .about-watermark{

        display:none;

    }

}

.hero-title {

    font-size: 100px;
    font-weight: 900;
    line-height: 0.92;
    letter-spacing: -5px;


}

/* DESCRIPTION */
.hero-desc {

    margin-top: 28px;

    font-size: 21px;
    line-height: 1.8;

    color: #777;

    max-width: 560px;

}

/* HERO PRODUCT */
.hero-product {

    width: 620px;

    position: relative;
    z-index: 20;

    animation:
        floatMain 5s ease-in-out infinite,
        zoomHero 4s ease-in-out infinite;

    transition: all .7s ease;

    cursor: pointer;

}

@keyframes zoomHero {

    0%{
        transform:scale(1);
    }

    50%{
        transform:scale(.96);
    }

    100%{
        transform:scale(1);
    }

}


/* PAS DIPENCET */
.hero-product:active {

    cursor: grabbing;

}



/* HOVER */
.hero-product:hover {

    transform:
        scale(1.12)
        translateY(-15px);

    filter:
        drop-shadow(0 50px 100px rgba(0,0,0,0.35));

}

.hero-product {

    will-change: transform;

}

/* SPIN EFFECT */
.hero-product.spin {

    animation:
        floatMain 5s ease-in-out infinite,
        spinCrazy 1.2s ease;

    transform: scale(1.18);

}



/* GLOW */
.product-glow {

    position: absolute;

    width: 720px;
    height: 720px;

    background:
        radial-gradient(circle,
        rgba(255,255,255,0.95) 0%,
        rgba(255,255,255,0.4) 35%,
        rgba(123,0,0,0.12) 65%,
        transparent 80%);

    border-radius: 999px;

    filter: blur(55px);

    animation: glowPulse 4s ease-in-out infinite;

    z-index: 1;

}

.brown-glow {

    background:
        radial-gradient(circle,
        rgba(255,255,255,0.95) 0%,
        rgba(255,255,255,0.4) 35%,
        rgba(75,30,30,0.12) 65%,
        transparent 80%);

}

.gold-glow {

    background:
    radial-gradient(
        circle,
        rgba(255,255,255,0.95) 0%,
        rgba(255,255,255,0.55) 30%,
        rgba(212,175,55,0.35) 30%,
        rgba(184,138,68,0.15) 40%,
        transparent 80%
    );

}



/* CIRCLES */
.circle-lg {

    position: absolute;

    width: 680px;
    height: 680px;

    border: 1px solid rgba(255,255,255,0.35);

    border-radius: 999px;

    z-index: 2;

}

.circle-sm {

    position: absolute;

    width: 540px;
    height: 540px;

    border: 1px solid rgba(255,255,255,0.25);

    border-radius: 999px;

    z-index: 2;

}



/* FLOATING IMAGES */
.floating-img {

    width: 140px;

    position: absolute;

    opacity: 0.15;

    z-index: 3;

    filter: blur(1px);

}



/* NAVBAR */
.glass-nav {

    display: flex;
    gap: 45px;

    padding: 18px 40px;

    border-radius: 999px;

    background: rgba(255,255,255,0.45);

    backdrop-filter: blur(18px);

    border: 1px solid rgba(255,255,255,0.4);

    box-shadow: 0 10px 30px rgba(0,0,0,0.05);

}

.glass-nav a {

    color: #666;

    font-weight: 600;

    transition: 0.3s;

}

.glass-nav a:hover {

    color: #7b0000;

}



/* BUTTONS */
.premium-btn,
.premium-btn-large,
.brown-btn,
.gold-btn {

    color: white;

    font-weight: bold;

    border-radius: 999px;

    transition: 0.4s;

}

.premium-btn {

    background: linear-gradient(to right, #7b0000, #a30000);

    padding: 16px 40px;

    box-shadow: 0 12px 35px rgba(123,0,0,0.25);

}

.premium-btn-large {

    background: linear-gradient(to right, #7b0000, #a30000);

    padding: 20px 50px;

    box-shadow: 0 18px 40px rgba(123,0,0,0.30);

}

.brown-btn {

    background: linear-gradient(to right, #4b1e1e, #6b2c2c);

    padding: 20px 50px;

}

.gold-btn {

    background:
    linear-gradient(
        135deg,
        #A67C3D,
        #D4AF37,
        #F2D57E
    );

    color:white;

    padding:20px 50px;

    box-shadow:
    0 15px 35px rgba(212,175,55,.35);

}

.premium-btn:hover,
.premium-btn-large:hover,
.brown-btn:hover,
.gold-btn:hover {

    transform: translateY(-5px);

}



/* GLASS BUTTON */
.glass-btn {

    border: 1px solid rgba(255,255,255,0.3);

    background: rgba(255,255,255,0.45);

    backdrop-filter: blur(12px);

    padding: 20px 40px;

    border-radius: 999px;

    font-weight: bold;

    color: #555;

    transition: 0.3s;

}

.glass-btn:hover {

    background: white;

    transform: translateY(-4px);

}



/* BADGE */
.badge-red,
.badge-brown,
.badge-gold {

    display: inline-block;

    padding: 10px 24px;

    border-radius: 999px;

    font-size: 13px;
    font-weight: bold;

    letter-spacing: 3px;

    margin-bottom: 28px;

}

.marquee {

    overflow: hidden;
    white-space: nowrap;
    position: relative;

}

.marquee-content {

    display: inline-flex;

    align-items: center;

    gap: 50px;

    color: white;

    font-size: 10px;

    font-weight: 700;

    letter-spacing: .25em;

    text-transform: uppercase;

    animation: marqueeMove 30s linear infinite;

}

@keyframes marqueeMove {

    from {
        transform: translateX(0%);
    }

    to {
        transform: translateX(-50%);
    }

}

.badge-red {

    background: rgba(123,0,0,0.08);

    color: #7b0000;

}

.badge-brown {

    background: rgba(75,30,30,0.08);

    color: #4b1e1e;

}


.badge-gold {

    background: rgba(212,175,55,.12);

    color:#B88A44;

}


/* FLOATING */
.floating {

    animation: float 4s ease-in-out infinite;

}

.floating2 {

    animation: float2 5s ease-in-out infinite;

}



/* ANIMATION */
@keyframes float {

    0%,100% {

        transform: translateY(0px);

    }

    50% {

        transform: translateY(-25px);

    }

}

@keyframes float2 {

    0%,100% {

        transform: translateY(0px);

    }

    50% {

        transform: translateY(25px);

    }

}

@keyframes floatMain {

    0%,100% {

        transform: translateY(0px);

    }

    50% {

        transform: translateY(-18px);

    }

}



/* SPIN */
@keyframes spinCrazy {

    0% {

        transform:
            rotateY(0deg)
            scale(1);

    }

    50% {

        transform:
            rotateY(180deg)
            scale(1.12);

    }

    100% {

        transform:
            rotateY(360deg)
            scale(1);

    }

}



/* GLOW */
@keyframes glowPulse {

    0%,100% {

        transform: scale(1);
        opacity: 0.9;

    }

    50% {

        transform: scale(1.06);
        opacity: 1;

    }

}



.hero-product{

    filter:
    drop-shadow(0 60px 70px rgba(0,0,0,.25));

    animation:
    floatRotate 6s ease-in-out infinite;

    transition:
    transform .7s ease,
    filter .7s ease;

    cursor:pointer;

    will-change:transform;

}

/* HOVER */
.hero-product:hover{

    transform:
    scale(0.92)
    rotate(-6deg);

    filter:
    drop-shadow(0 90px 120px rgba(0,0,0,.35));

}

/* FLOAT + ROTATE */
@keyframes floatRotate{

    0%{
        transform:
        translateY(0px)
        rotate(-2deg);
    }

    25%{
        transform:
        translateY(-15px)
        rotate(2deg);
    }

    50%{
        transform:
        translateY(-25px)
        rotate(0deg);
    }

    75%{
        transform:
        translateY(-15px)
        rotate(-2deg);
    }

    100%{
        transform:
        translateY(0px)
        rotate(-2deg);
    }

}
.hero-product{

    cursor: grab;

    filter:
    drop-shadow(0 50px 80px rgba(0,0,0,.25));

    transition:
    transform .2s ease,
    filter .3s ease;

}

.hero-product:hover{

    filter:
    drop-shadow(0 70px 120px rgba(0,0,0,.35));

}

.hero-product{

    animation:
    autoRotate 8s linear infinite;

}

@keyframes autoRotate{

    0%{
        transform:
        perspective(1000px)
        rotateY(-8deg);
    }

    50%{
        transform:
        perspective(1000px)
        rotateY(8deg);
    }

    100%{
        transform:
        perspective(1000px)
        rotateY(-8deg);
    }

}

</style>

@include('layouts.footer')
@endsection