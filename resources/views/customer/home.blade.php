<<<<<<< HEAD
{{-- resources/views/customer/home.blade.php --}}

@php

$signatureDesserts = [

[
'name' => 'Broole',
'price' => 'Rp 45.000',
'image' => '/home/fb_broole.png',
'tagline' => 'Crunchy Sophistication',
'desc' => 'Velvet layers of pure dark cacao fudge soil paired with fluffy white cheese creme.',
'ingredients' => [

[
'image' => '/home/berry.png',
'class' => 'left-[2%] top-[10%] lg:left-[8%] lg:top-[14%]',
'size' => 'w-[115px] h-[115px]'
],

[
'image' => '/home/berry.png',
'class' => 'right-[0%] top-[50%] lg:right-[3%] lg:top-[48%]',
'size' => 'w-[120px] h-[120px]'
]

]
],

[
'name' => 'Latte',
'price' => 'Rp 52.000',
'image' => '/home/fb_drink.png',
'tagline' => 'Earthy Royalty',
'desc' => 'Ceremonial-grade Kyoto matcha powder whipped into decadent cream.',
'ingredients' => [

[
'image' => '/home/coffee1.png',
'class' => 'left-[2%] top-[8%] lg:left-[8%] lg:top-[12%]',
'size' => 'w-[120px] h-[120px]'
],

[
'image' => '/home/coffee1.png',
'class' => 'right-[0%] top-[58%] lg:right-[2%] lg:top-[45%]',
'size' => 'w-[110px] h-[110px]'
]

]
],

[
'name' => 'Cheesecake',
'price' => 'Rp 46.000',
'image' => '/home/fb_cake.png',
'tagline' => 'Fudge Indulgence',
'desc' => 'Dense dark Belgian chocolate cocoa crumb with silky fudge ganache.',
'ingredients' => [

[
'image' => '/home/oreo1.png',
'class' => 'right-[2%] top-[4%] lg:right-[6%] lg:top-[8%]',
'size' => 'w-[125px] h-[125px]'
],

[
'image' => '/home/oreo1.png',
'class' => 'left-[0%] top-[58%] lg:left-[3%] lg:top-[50%]',
'size' => 'w-[120px] h-[120px]'
]

]
]

];


$masterpieces = [
[
'name' => 'Cheesecake',
'price' => 'Rp 49.000',
'image' => '/home/cake.png',
'category' => 'Cheesecake',
'tagline' => 'Layered Delight',
'desc' => 'Silky cream cheese layered with lotus crumble and luxurious artisan textures.'
],

[
'name' => 'Broole',
'price' => 'Rp 45.000',
'image' => '/home/broole.png',
'category' => 'Broole',
'tagline' => 'Creamy Luxury',
'desc' => 'Velvet layers of pure dark cacao fudge soil paired with fluffy white cheese creme.'
],


[
'name' => 'Craft Drinks',
'price' => 'Rp 52.000',
'image' => '/home/craft_drink.png',
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

                <button class="bg-[#8C1717] text-white px-8 py-4 rounded-full text-sm font-black uppercase tracking-[0.15em] shadow-[0_20px_40px_rgba(140,23,23,0.25)]">
                    Order Now
                </button>

                <button class="bg-white/90 backdrop-blur-sm border border-[#3D3833]/10 text-[#3D3833] px-8 py-4 rounded-full text-sm font-black uppercase tracking-[0.15em] shadow-sm">
                    Discover More
                </button>

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
                    class="w-[260px] sm:w-[320px] lg:w-[600px] object-contain drop-shadow-[0_60px_70px_rgba(0,0,0,0.25)] animate-[float_5s_ease-in-out_infinite]"
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

                <h3 class="font-['Cormorant_Garamond'] text-[58px] leading-[0.9] font-bold text-[#F5EBDD] mt-5">

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
                <button
                    class="mt-10 w-full h-16 rounded-[18px] border border-white/20 bg-white/5 backdrop-blur-sm hover:bg-white hover:text-[#2A211D] transition-all duration-500 text-[11px] uppercase tracking-[0.25em] font-black text-[#F5EBDD]"
                >

                    @if($index === 0)
                    Shop Artisan Cheesecakes
                    @elseif($index === 1)
                    Shop Broole Classics
                    @else
                    Shop Craft Drinks
                    @endif

                    →

                </button>

            </div>

        </div>

        @endforeach

    </div>

</section>


{{-- ================= ABOUT ================= --}}
<section class="max-w-7xl mx-auto px-8 mt-28">

    <div class="bg-white rounded-[40px] p-8 lg:p-16 border border-[#8C1717]/5 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

        {{-- LEFT --}}
        <div>

            <span class="text-[#8C1717] font-bold text-xs uppercase tracking-widest">
                Our Story & Craft
            </span>

            <h2 class="text-4xl lg:text-5xl font-black text-[#2C2623] mt-4">
                About From Broole
            </h2>

            <p class="text-base text-[#655F5A] leading-relaxed mt-6">
                Founded under the principle of Sweetness Redefined,
                From Broole is more than just a sweet shop.
            </p>

            <p class="text-sm text-[#655F5A] leading-relaxed mt-5">
                Every slice and cream layer represents hours of testing,
                premium ingredients, and artisan dedication.
            </p>

            {{-- STATS --}}
            <div class="grid grid-cols-3 gap-4 pt-8 text-center">

                <div class="bg-[#F8F5F2] p-4 rounded-2xl">

                    <p class="text-2xl font-black text-[#8C1717]">
                        100%
                    </p>

                    <p class="text-[10px] uppercase font-bold text-[#655F5A] mt-1">
                        Premium Origin
                    </p>

                </div>

                <div class="bg-[#F8F5F2] p-4 rounded-2xl">

                    <p class="text-2xl font-black text-[#8C1717]">
                        Fresh
                    </p>

                    <p class="text-[10px] uppercase font-bold text-[#655F5A] mt-1">
                        Baked Daily
                    </p>

                </div>

                <div class="bg-[#F8F5F2] p-4 rounded-2xl">

                    <p class="text-2xl font-black text-[#8C1717]">
                        Friendly
                    </p>

                    <p class="text-[10px] uppercase font-bold text-[#655F5A] mt-1">
                        Artisan Care
                    </p>
=======
@extends('layouts.app')

@section('content')

<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
/>

<section class="relative h-screen overflow-hidden bg-[#f8f5f2]">

    {{-- BACKGROUND GLOW --}}
    <div class="absolute top-[-250px] left-[-250px] w-[700px] h-[700px] bg-[#7b0000]/15 rounded-full blur-[180px]"></div>

    <div class="absolute bottom-[-250px] right-[-250px] w-[700px] h-[700px] bg-[#355e3b]/15 rounded-full blur-[180px]"></div>



    {{-- NAVBAR --}}
    <nav class="absolute top-0 left-0 w-full z-50 px-16 py-8 flex justify-between items-center">

        {{-- LOGO --}}
        <div>

            <h1 class="text-5xl font-black text-[#7b0000] leading-none">
                From Broole
            </h1>

            <p class="tracking-[7px] text-gray-400 text-[11px] uppercase mt-2">
                Crafted Dessert Experience
            </p>

        </div>



        {{-- MENU --}}
        <div class="glass-nav">

            <a href="#">Home</a>
            <a href="#">Products</a>
            <a href="#">Gallery</a>
            <a href="#">Contact</a>

        </div>



        {{-- BUTTON --}}
        <button class="premium-btn">

            Order Now

        </button>

    </nav>



    {{-- SWIPER --}}
    <div class="swiper heroSwiper h-full">

        <div class="swiper-wrapper">



            {{-- ================================================= --}}
            {{-- SLIDE 1 --}}
            {{-- ================================================= --}}
            <div class="swiper-slide overflow-hidden">

                <div class="grid grid-cols-2 h-full items-center px-20 pt-20">

                    {{-- LEFT --}}
                    <div class="z-20">

                        <div class="badge-red">

                            PREMIUM SIGNATURE

                        </div>

                        <h1 class="hero-title text-[#7b0000]">

                            From <br> Broole

                        </h1>

                        <p class="hero-desc">

                            Premium handcrafted dessert and beverages
                            designed to create unforgettable sweet moments.

                        </p>



                        <div class="flex gap-5 mt-10">

                            <button class="premium-btn-large">

                                Shop Now

                            </button>

                            <button class="glass-btn">

                                Explore Menu

                            </button>

                        </div>

                    </div>



                    {{-- RIGHT --}}
                    <div class="relative flex justify-center items-center">

                        {{-- MASSIVE GLOW --}}
                        <div class="product-glow"></div>

                        {{-- CIRCLES --}}
                        <div class="circle-lg"></div>
                        <div class="circle-sm"></div>



                        {{-- FLOATING --}}
                        <img
                            src="{{ asset('products/broole2.png') }}"
                            class="floating-img top-10 left-0 floating"
                        >

                        <img
                            src="{{ asset('products/broole3.png') }}"
                            class="floating-img bottom-10 right-0 floating2"
                        >



                        {{-- MAIN PRODUCT --}}
                        <img
                            src="{{ asset('products/broole1.png') }}"
                            class="hero-product"
                        >

                    </div>

                </div>

            </div>



            {{-- ================================================= --}}
            {{-- SLIDE 2 --}}
            {{-- ================================================= --}}
            <div class="swiper-slide overflow-hidden">

                <div class="grid grid-cols-2 h-full items-center px-20 pt-20">

                    {{-- LEFT --}}
                    <div class="z-20">

                        <div class="badge-brown">

                            CHEESECAKE COLLECTION

                        </div>

                        <h1 class="hero-title text-[#4b1e1e]">

                            Premium <br> Cheesecake

                        </h1>

                        <p class="hero-desc">

                            Rich creamy cheesecake layered with luxurious
                            flavours and handcrafted perfection.

                        </p>



                        <div class="flex gap-5 mt-10">

                            <button class="brown-btn">

                                Buy Now

                            </button>

                            <button class="glass-btn">

                                View Menu

                            </button>

                        </div>

                    </div>



                    {{-- RIGHT --}}
                    <div class="relative flex justify-center items-center">

                        <div class="product-glow brown-glow"></div>

                        <div class="circle-lg"></div>
                        <div class="circle-sm"></div>



                        <img
                            src="{{ asset('products/cheesecake2.png') }}"
                            class="floating-img top-10 left-0 floating"
                        >

                        <img
                            src="{{ asset('products/cheesecake3.png') }}"
                            class="floating-img bottom-10 right-0 floating2"
                        >

                        <img
                            src="{{ asset('products/cheesecake1.png') }}"
                            class="hero-product"
                        >

                    </div>

                </div>

            </div>



            {{-- ================================================= --}}
            {{-- SLIDE 3 --}}
            {{-- ================================================= --}}
            <div class="swiper-slide overflow-hidden">

                <div class="grid grid-cols-2 h-full items-center px-20 pt-20">

                    {{-- LEFT --}}
                    <div class="z-20">

                        <div class="badge-green">

                            REFRESHING DRINKS

                        </div>

                        <h1 class="hero-title text-[#355e3b]">

                            Signature <br> Drinks

                        </h1>

                        <p class="hero-desc">

                            Fresh handcrafted beverages with silky texture
                            and refreshing premium flavours.

                        </p>



                        <div class="flex gap-5 mt-10">

                            <button class="green-btn">

                                Order Drink

                            </button>

                            <button class="glass-btn">

                                Discover More

                            </button>

                        </div>

                    </div>



                    {{-- RIGHT --}}
                    <div class="relative flex justify-center items-center">

                        <div class="product-glow green-glow"></div>

                        <div class="circle-lg"></div>
                        <div class="circle-sm"></div>



                        <img
                            src="{{ asset('products/drink2.png') }}"
                            class="floating-img top-10 left-0 floating"
                        >

                        <img
                            src="{{ asset('products/drink3.png') }}"
                            class="floating-img bottom-10 right-0 floating2"
                        >

                        <img
                            src="{{ asset('products/drink1.png') }}"
                            class="hero-product"
                        >

                    </div>
>>>>>>> 601b9a226ee644e3b6a752ce79160edcd95032bc

                </div>

            </div>

        </div>

<<<<<<< HEAD
        {{-- RIGHT --}}
        <div class="relative flex items-center justify-center px-6 py-4">

            <div class="absolute inset-x-0 w-80 h-80 bg-[#8C1717]/5 rounded-full blur-3xl"></div>

            <img
                src="/from_broole_mascot.png"
                class="relative z-10 w-[320px] object-contain drop-shadow-[0_40px_50px_rgba(0,0,0,0.2)] animate-[float_5s_ease-in-out_infinite]"
            >

        </div>
=======


        {{-- PAGINATION --}}
        <div class="swiper-pagination !bottom-8"></div>
>>>>>>> 601b9a226ee644e3b6a752ce79160edcd95032bc

    </div>

</section>


<<<<<<< HEAD
{{-- ================= SAFETY ================= --}}
<section class="max-w-7xl mx-auto px-8 mt-24 pb-24">

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white p-8 rounded-[32px] border border-[#8C1717]/5">

            <h3 class="text-xl font-black text-[#2C2623]">
                Pristine Hygiene
            </h3>

            <p class="text-sm text-[#655F5A] leading-relaxed mt-4">
                Sterilized boutique kitchens obeying global safety norms.
            </p>

        </div>

        <div class="bg-white p-8 rounded-[32px] border border-[#8C1717]/5">

            <h3 class="text-xl font-black text-[#2C2623]">
                Artisan Standards
            </h3>

            <p class="text-sm text-[#655F5A] leading-relaxed mt-4">
                No generic shortening or artificial fluff.
            </p>

        </div>

        <div class="bg-white p-8 rounded-[32px] border border-[#8C1717]/5">

            <h3 class="text-xl font-black text-[#2C2623]">
                Fresh Delivery
            </h3>

            <p class="text-sm text-[#655F5A] leading-relaxed mt-4">
                Orders packaged carefully to maintain luxurious texture.
            </p>

        </div>

    </div>

</section>

</div>
=======

<style>

/* TITLE */
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

    animation: floatMain 5s ease-in-out infinite;

    filter:
        drop-shadow(0 40px 80px rgba(0,0,0,0.28))
        drop-shadow(0 0 50px rgba(255,255,255,0.45));

    transition:
        transform 0.8s ease,
        filter 0.5s ease;

    cursor: grab;

    transform-style: preserve-3d;

}



/* PAS DIPENCET */
.hero-product:active {

    cursor: grabbing;

}



/* HOVER */
.hero-product:hover {

    transform:
        scale(1.05)
        rotate(-6deg);

}



/* SPIN EFFECT */
.hero-product.spin {

    animation:
        floatMain 5s ease-in-out infinite,
        spinCrazy 1.5s ease;

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

.green-glow {

    background:
        radial-gradient(circle,
        rgba(255,255,255,0.95) 0%,
        rgba(255,255,255,0.4) 35%,
        rgba(53,94,59,0.12) 65%,
        transparent 80%);

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
.green-btn {

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

.green-btn {

    background: linear-gradient(to right, #355e3b, #4f8a59);

    padding: 20px 50px;

}

.premium-btn:hover,
.premium-btn-large:hover,
.brown-btn:hover,
.green-btn:hover {

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
.badge-green {

    display: inline-block;

    padding: 10px 24px;

    border-radius: 999px;

    font-size: 13px;
    font-weight: bold;

    letter-spacing: 3px;

    margin-bottom: 28px;

}

.badge-red {

    background: rgba(123,0,0,0.08);

    color: #7b0000;

}

.badge-brown {

    background: rgba(75,30,30,0.08);

    color: #4b1e1e;

}

.badge-green {

    background: rgba(53,94,59,0.08);

    color: #355e3b;

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



/* PAGINATION */
.swiper-pagination-bullet {

    width: 12px;
    height: 12px;

    background: #7b0000;

    opacity: 0.3;

    transition: 0.4s;

}

.swiper-pagination-bullet-active {

    width: 40px;

    border-radius: 999px;

    opacity: 1;

}

</style>



<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>

new Swiper(".heroSwiper", {

    loop: true,

    speed: 1400,

    effect: "slide",

    autoplay: {

        delay: 3500,
        disableOnInteraction: false,

    },

    pagination: {

        el: ".swiper-pagination",
        clickable: true,

    },

});



const products = document.querySelectorAll('.hero-product');

products.forEach(product => {

    product.addEventListener('click', () => {

        product.classList.remove('spin');

        void product.offsetWidth;

        product.classList.add('spin');

    });

});

</script>

@endsection
>>>>>>> 601b9a226ee644e3b6a752ce79160edcd95032bc
