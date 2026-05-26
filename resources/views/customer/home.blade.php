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

                </div>

            </div>

        </div>



        {{-- PAGINATION --}}
        <div class="swiper-pagination !bottom-8"></div>

    </div>

</section>



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