@extends('layouts.app')

@section('content')

<div class="fb">

{{-- ============================================================ HERO --}}
<section class="fb-hero" id="fb-hero">
    <div class="fb-grain"></div>

    {{-- Vertical side label --}}
    <div class="fb-hero__vert">
        <span class="fb-hero__vert-line"></span>
        <span>Since 2022</span>
        <span class="fb-hero__vert-line"></span>
        <span>Surabaya</span>
        <span class="fb-hero__vert-line"></span>
    </div>

    {{-- BIG LAGUNITAS-STYLE TITLE --}}
    <div class="fb-hero__title-area">
        <div class="fb-title">
            {{-- Row 1: Crafted --}}
            <span class="fb-title__main">Crafted</span>
            {{-- Row 2: WI [broole] TH --}}
            <div class="fb-title__mid-row">
                <span class="fb-title__ghost">WI</span>
                <span class="fb-title__ghost fb-title__ghost--r">TH</span>
            </div>
            {{-- Row 3: Burnt Sugar. --}}
            <span class="fb-title__main">Burnt Sugar.</span>
        </div>
    </div>

    {{-- PARALLAX BROOLE (sits inside the WI_TH gap) --}}
    <div class="fb-hero__broole" id="fb-broole">
        <img src="{{ asset('home_assets/fb_broole.png') }}" alt="Signature Crème Brûlée">
    </div>

    {{-- Floating badges --}}
    <div class="fb-badge fb-badge--tl">
        <span class="fb-badge__dot"></span>Halal Certified
    </div>
    <div class="fb-badge fb-badge--br">
        <span>★</span> 5.0 Rating
    </div>

    {{-- Bottom strip: about + buttons --}}
    <div class="fb-hero__bottom">
        <div class="fb-hero__bottom-left">
            <p class="fb-hero__eyebrow">
                <span class="fb-hero__eyebrow-dash"></span>About From Broole
                <span class="fb-hero__eyebrow-dash"></span>
            </p>
            <p class="fb-hero__desc">
                We transform the humble crème brûlée into a modern artisan
                experience — one caramelized crust at a time.
            </p>
        </div>
       <div class="fb-hero__actions">

   

    <a href="{{ route('customer.shop') }}" class="fb-btn fb-btn--outline">
        See Menu
    </a>

</div>
    
</section>

{{-- ============================================================ TICKER --}}
<div class="fb-ticker">
    <div class="fb-ticker__track">
        @php $items = ['Crème Brûlée','Artisan Cheesecake','Craft Drinks','100% Halal','Handcrafted Daily','Premium Ingredients','Burnt Sugar','Fresh Made']; @endphp
        @foreach(array_merge($items,$items) as $item)
        <span class="fb-ticker__item"><span class="fb-ticker__star">✦</span>{{ $item }}</span>
        @endforeach
    </div>
</div>

{{-- ============================================================ CRACK / VIDEO SECTION --}}
<section class="fb-crack" id="story">
    <div class="fb-crack__left" data-sr>
        <div class="fb-crack__plus">✦</div>
        <p class="fb-eyebrow"><span class="fb-edash"></span>Signature Experience</p>
        <h2 class="fb-crack__big">The<br>Perfect<br><em>Crack.</em></h2>
        <p class="fb-crack__sub">One tap. One crack.<br>The sound of handcrafted perfection.</p>
        
    </div>
    <div class="fb-crack__right" data-sr-d>

    <video
        class="fb-crack__video"
        autoplay
        muted
        loop
        playsinline
    >
        <source src="{{ asset('home_assets/crack-video.MP4') }}" type="video/mp4">
    </video>

   

</div>
</section>

{{-- ============================================================ PROCESS --}}
<section class="fb-process">
    <div class="fb-process__vert">
        <span class="fb-vert-line"></span>Our Process<span class="fb-vert-line"></span>
    </div>
    <div class="fb-process__inner">
        <p class="fb-eyebrow" style="margin-bottom:2.5rem;">
            <span class="fb-edash"></span>How We Make It<span class="fb-edash"></span>
        </p>
        <div class="fb-process__steps">
            <div class="fb-pstep" data-sr>
                <div class="fb-pstep__head">
                    <span class="fb-pstep__num">01</span>
                    <span class="fb-pstep__arrow">→</span>
                </div>
                <div class="fb-pstep__label">Premium<br>Custard</div>
                <div class="fb-pstep__img"><img src="{{ asset('home_assets/custard.png') }}" alt="Premium Custard"></div>
            </div>
            <div class="fb-pstep" data-sr-d>
                <div class="fb-pstep__head">
                    <span class="fb-pstep__num">02</span>
                    <span class="fb-pstep__arrow">→</span>
                </div>
                <div class="fb-pstep__label">Torched<br>Sugar</div>
                <div class="fb-pstep__img"><img src="{{ asset('home_assets/torched.jpeg') }}" alt="Torched Sugar"></div>
            </div>
            <div class="fb-pstep" data-sr-d>
                <div class="fb-pstep__head">
                    <span class="fb-pstep__num">03</span>
                    <span class="fb-pstep__arrow">→</span>
                </div>
                <div class="fb-pstep__label">Signature<br>Toppings</div>
                <div class="fb-pstep__img"><img src="{{ asset('home_assets/step3.png') }}" alt="Signature Toppings"></div>
            </div>
            <div class="fb-pstep" data-sr-d2>
                <div class="fb-pstep__head">
                    <span class="fb-pstep__num">04</span>
                </div>
                <div class="fb-pstep__label">Ready To<br>Enjoy</div>
                <div class="fb-pstep__img"><img src="{{ asset('home_assets/step4.png') }}" alt="Ready to Enjoy"></div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================ BEST SELLERS --}}
<section class="fb-sellers" id="menu">
    <div class="fb-sellers__left" data-sr>
        <div class="fb-sellers__plus">✦</div>
        <h2 class="fb-sellers__big">Best<br><em>Sellers</em></h2>
        <p class="fb-body">We don't take shortcuts. We choose quality, we craft with passion, and we serve with heart.</p>
        <a href="{{ route('customer.shop') }}" class="fb-viewall"><span class="fb-viewall__line"></span>View All Menu →</a>
    </div>
    
    <div class="fb-sellers__grid">
        @foreach($bestSellers as $index => $item)
        <div class="fb-scard" 
            @if($index === 0) data-sr 
            @elseif($index === 1) data-sr-d 
            @else data-sr-d2 
            @endif
        >
            <div class="fb-scard__img-wrap">
                <img src="{{ asset('products/' . $item->pro_image) }}" alt="{{ $item->pro_name }}">
            </div>
            <div class="fb-scard__body">
                <p class="fb-scard__name">{{ $item->pro_name }}</p>
                
                {{-- TOTAL SOLD Menggantikan Bintang --}}
                <p class="fb-scard__stars">
                    🔥 <span class="fb-scard__ct" style="color: #E6C07B; font-weight: 600;">{{ number_format($item->total_sold, 0, ',', '.') }} Sold</span>
                </p>
                
                <a href="{{ route('customer.shop', ['category' => $item->category_id]) }}" class="fb-scard__order">Order Now →</a>
            </div>
        </div>
        @endforeach
    </div>
</section>

{{-- ============================================================ WHY BROOLE --}}

<section class="fb-why">

    <!-- LEFT -->
    <div class="fb-why__intro">
        <h2 class="fb-why__big">
            Why<br><em>Broole?</em>
        </h2>

        <p class="fb-body">
            We don't take shortcuts.
            We choose quality, we craft with passion,
            and we serve with heart.
        </p>
    </div>

    <!-- CENTER -->
    <div class="fb-why__photo">
        <img src="{{ asset('home_assets/why.png') }}" alt="">
    </div>

    <!-- RIGHT -->
    <div class="fb-why__features">

        <div class="fb-wfeat">
            <div class="fb-wfeat__title">Premium Ingredients</div>
            <div class="fb-wfeat__sub">
                We use only the finest quality ingredients.
            </div>
        </div>

        <div class="fb-wfeat">
            <div class="fb-wfeat__title">Handcrafted Daily</div>
            <div class="fb-wfeat__sub">
                Made in small batches with passion.
            </div>
        </div>

        <div class="fb-wfeat">
            <div class="fb-wfeat__title">Halal Certified</div>
            <div class="fb-wfeat__sub">
                100% Halal for your peace of mind.
            </div>
        </div>

        <div class="fb-wfeat">
            <div class="fb-wfeat__title">Signature Burnt Sugar</div>
            <div class="fb-wfeat__sub">
                Our classic caramelized crust.
            </div>
        </div>

        <div class="fb-wfeat">
            <div class="fb-wfeat__title">5.0 Customer Rating</div>
            <div class="fb-wfeat__sub">
                Loved by thousands of happy customers.
            </div>
        </div>

    </div>
</section>

{{-- ============================================================ TEAM --}}
<section class="fb-team" id="team">
    <div class="fb-team__header" data-sr>
        <p class="fb-eyebrow"><span class="fb-edash"></span>Our Artisans<span class="fb-edash"></span></p>
        <h2 class="fb-team__big">Meet The <em>Team</em></h2>
        <p class="fb-body" style="max-width: 600px; margin: 0 auto;">
            We are a small team of four, passionate about bringing you the finest artisan dessert experience. Every crème brûlée is crafted with our dedication.
        </p>
    </div>
    
    <div class="fb-team__grid">
        <div class="fb-tcard" data-sr>
            <div class="fb-tcard__img-wrap">
                <img src="https://ui-avatars.com/api/?name=Steven&background=8F1717&color=fff&size=200&bold=true" alt="Steven">
            </div>
            <h3 class="fb-tcard__name">Steven</h3>
            <p class="fb-tcard__role">Co-Founder</p>
        </div>
        <div class="fb-tcard" data-sr-d>
            <div class="fb-tcard__img-wrap">
                <img src="https://ui-avatars.com/api/?name=Venny&background=8F1717&color=fff&size=200&bold=true" alt="Venny">
            </div>
            <h3 class="fb-tcard__name">Venny</h3>
            <p class="fb-tcard__role">Head Baker</p>
        </div>
        <div class="fb-tcard" data-sr-d2>
            <div class="fb-tcard__img-wrap">
                <img src="https://ui-avatars.com/api/?name=Eveline&background=8F1717&color=fff&size=200&bold=true" alt="Eveline">
            </div>
            <h3 class="fb-tcard__name">Eveline</h3>
            <p class="fb-tcard__role">Pastry Chef</p>
        </div>
        <div class="fb-tcard" data-sr-d3>
            <div class="fb-tcard__img-wrap">
                <img src="https://ui-avatars.com/api/?name=Jessie&background=8F1717&color=fff&size=200&bold=true" alt="Jessie">
            </div>
            <h3 class="fb-tcard__name">Jessie</h3>
            <p class="fb-tcard__role">Quality Control</p>
        </div>
    </div>
</section>

{{-- ============================================================ GALLERY --}}
<div class="fb-gallery">
    <div class="fb-gallery__vert">
        <span class="fb-vert-line"></span>Gallery<span class="fb-vert-line"></span>
    </div>
    <div class="fb-gallery__strip">
        <div class="fb-gallery__item"><img src="{{ asset('home_assets/step4.png') }}" alt=""></div>
        <div class="fb-gallery__item"><img src="{{ asset('home_assets/maskot.png') }}" alt=""></div>
        <div class="fb-gallery__item"><img src="{{ asset('home_assets/step3.png') }}" alt=""></div>
        <div class="fb-gallery__item"><img src="{{ asset('products/drink2.png') }}" alt=""></div>
        <div class="fb-gallery__item"><img src="{{ asset('home_assets/fb_cake.png') }}" alt=""></div>
    </div>
</div>

{{-- ============================================================ TESTIMONIAL --}}
<section class="fb-testi">
    <div class="fb-testi__grain"></div>
    <div class="fb-testi__inner">
        <div class="fb-testi__left" data-sr>
            <div class="fb-testi__quote-mark">"</div>
            <h2 class="fb-testi__text" id="fb-testi-text">
                The Best Crème Brûlée<br>In <em>Surabaya.</em>
            </h2>
            <div class="fb-testi__stars">★★★★★</div>
            <div class="fb-testi__author" id="fb-testi-author">— Veronica, Surabaya</div>
            <div class="fb-testi__nav">
                <button class="fb-testi__nav-btn" id="fb-prev">←</button>
                <button class="fb-testi__nav-btn" id="fb-next">→</button>
            </div>
        </div>
        <div class="fb-testi__right" data-sr-d>
            <div class="fb-testi__img-wrap">
                <img src="{{ asset('home_assets/fb_broole.png') }}" alt="Crème Brûlée">
                <div class="fb-testi__badge">
                    <svg class="fb-testi__badge-ring" viewBox="0 0 100 100">
                        <defs><path id="circle" d="M 50,50 m -37,0 a 37,37 0 1,1 74,0 a 37,37 0 1,1 -74,0"/></defs>
                        <text font-size="11.5" font-family="Outfit,sans-serif" font-weight="600" fill="#1A0E08" letter-spacing="2">
                            <textPath href="#circle">✦ HANDCRAFTED WITH PASSION ✦ </textPath>
                        </text>
                    </svg>
                    <span class="fb-testi__badge-star">✦</span>
                </div>
            </div>
        </div>
    </div>
</section>

</div>{{-- /.fb --}}


{{-- ============================================================ STYLES --}}
<style>
@import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Outfit:wght@300;400;500;600;700;900&display=swap');

/* ─── TOKENS ─────────────────────────────────── */
:root {
    --red:      #B81C1C;
    --red-deep: #6B0F1A;
    --red-mid:  #8C1717;
    --cream:    #FAF3E8;
    --cream2:   #F2E8D4;
    --cream3:   #EDE0CC;
    --gold:     #C9A84C;
    --gold-lt:  #F2D6A2;
    --text:     #1A0E08;
    --muted:    #7A6A58;
    --white:    #FFFCF7;
    --serif:    'Cormorant Garamond', Georgia, serif;
    --sans:     'Outfit', sans-serif;
}

@keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}

.fb *, .fb *::before, .fb *::after { box-sizing: border-box; }
.fb img { display: block; max-width: 100%; }
.fb a   { text-decoration: none; color: inherit; }

/* ─── GRAIN ──────────────────────────────────── */
.fb-grain {
    position: absolute; inset: 0; pointer-events: none; z-index: 1; opacity: .036;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
    background-size: 200px;
}

/* ─── TOPBAR ──────────────────────────────────── */
.fb-topbar {
    background: var(--red-deep);
    display: flex; align-items: center; justify-content: center; gap: 3rem;
    padding: .4rem 2rem;
    font-family: var(--sans); font-size: .58rem; font-weight: 500;
    letter-spacing: .18em; text-transform: uppercase;
    color: rgba(255,255,255,.65);
}

/* ─── NAV ─────────────────────────────────────── */
.fb-nav {
    background: var(--white);
    border-bottom: 1px solid rgba(28,18,8,.07);
    display: flex; align-items: center; justify-content: space-between;
    padding: .85rem 3rem;
    position: sticky; top: 0; z-index: 200;
}
.fb-nav__brand       { display: flex; flex-direction: column; line-height: 1.1; }
.fb-nav__brand-name  { font-family: var(--serif); font-size: 1rem; font-weight: 700; color: var(--red); letter-spacing: .02em; }
.fb-nav__brand-sub   { font-family: var(--sans); font-size: .46rem; font-weight: 500; letter-spacing: .24em; text-transform: uppercase; color: var(--muted); }
.fb-nav__links       { display: flex; gap: 1.5rem; align-items: center; }
.fb-nav__link        { font-family: var(--sans); font-size: .58rem; font-weight: 600; letter-spacing: .16em; text-transform: uppercase; color: var(--muted); padding: .2rem 0; border-bottom: 1.5px solid transparent; transition: .2s; }
.fb-nav__link:hover,
.fb-nav__link--active{ color: var(--red); border-bottom-color: var(--red); }
.fb-nav__sep         { color: rgba(28,18,8,.14); font-size: .7rem; }
.fb-nav__icons       { display: flex; gap: .6rem; }
.fb-nav__icon-btn    { width: 30px; height: 30px; border-radius: 50%; border: 1.5px solid rgba(28,18,8,.13); background: transparent; color: var(--muted); cursor: pointer; display: flex; align-items: center; justify-content: center; transition: .2s; }
.fb-nav__icon-btn:hover        { border-color: var(--red); color: var(--red); }
.fb-nav__icon-btn--active      { background: var(--red-deep); border-color: var(--red-deep); color: #fff; }

/* ─── HERO ─────────────────────────────────────── */
/* ==========================================================
   HERO V2 - BROOLE LUXURY
========================================================== */

.fb-hero{
    position:relative;
    height:920px;
    overflow:hidden;

    background:
    radial-gradient(
        circle at center,
        #fdfbf8 0%,
        #f8f3ec 60%,
        #efe7df 100%
    );
}

/* =========================
   SIDE LABEL
========================= */

.fb-hero__vert{
    position:absolute;
    left:45px;
    top:50%;
    transform:translateY(-50%);

    writing-mode:vertical-rl;

    display:flex;
    gap:24px;

    font-size:13px;
    font-weight:600;
    letter-spacing:.35em;

    color:#a21a1a;

    z-index:20;
}

.fb-hero__vert-line{
    width:1px;
    height:55px;
    background:#c66;
}

/* =========================
   CENTER AREA
========================= */

.fb-hero__title-area{
    height:100%;
    display:flex;
    justify-content:center;
    align-items:center;

    text-align:center;

    position:relative;
    z-index:5;

    padding-bottom:120px;
}

.fb-title{
    width:100%;
    max-width:1700px;
    position:relative;
    opacity: 0;
    animation: fadeUp 0.7s 0.1s ease forwards;
}

/* =========================
   CRAFTED
========================= */

.fb-title__main{
    display:block;

    font-family:var(--serif);

    font-size:clamp(130px,14vw,260px);

    font-weight:500;

    line-height:.82;

    color:#a10d0d;

    letter-spacing:-0.04em;
}

.fb-title__main:last-child{
    margin-top:-10px;
}

/* =========================
   WI TH
========================= */

.fb-title__mid-row{
    height:340px;
    position:relative;
}

.fb-title__ghost{
    position:absolute;
    top:50%;
    transform:translateY(-50%);

    font-family:var(--serif);

    font-size:clamp(180px,20vw,360px);

    font-weight:500;

    line-height:1;

    color:rgba(161,13,13,.13);

    letter-spacing:-0.04em;
}

.fb-title__ghost:first-child{
    left:10%;
}

.fb-title__ghost--r{
    right:10%;
}

/* =========================
   BROOLE
========================= */

.fb-hero__broole{
    position:absolute;

    left:50%;
    top:50%;

    transform:translate(-50%,-50%);

    width:650px;

    z-index:15;
}

.fb-hero__broole img{
    width:100%;

    filter:
    drop-shadow(0 40px 50px rgba(0,0,0,.12))
    drop-shadow(0 15px 90px rgba(0,0,0,.15));
}

/* =========================
   BADGES
========================= */

.fb-badge{
    position:absolute;
    z-index:30;

    padding:14px 26px;

    border-radius:999px;

    font-size:14px;
    font-weight:600;
}

.fb-badge--tl{
    top:170px;
    left:110px;

    background:#fff;
    color:#222;

    border:none;
}

.fb-badge--br{
    right:120px;
    bottom:250px;

    background:#d6b14a;
    color:#111;
}

.fb-badge__dot{
    width:8px;
    height:8px;
    border-radius:50%;
    background:#38d86d;
}

/* =========================
   BOTTOM
========================= */

.fb-hero__bottom{
    position:absolute;

    left:0;
    right:0;
    bottom:50px;

    padding:0 80px;

    display:flex;
    justify-content:space-between;
    align-items:flex-end;

    z-index:30;
    opacity: 0;
    animation: fadeUp 0.7s 0.3s ease forwards;
}

.fb-hero__bottom-left{
    width:420px;
}

.fb-hero__eyebrow{
    font-size:13px;
    font-weight:700;
    letter-spacing:.25em;

    color:#a21a1a;

    margin-bottom:18px;
}

.fb-hero__eyebrow-dash{
    width:40px;
    background:#b88d3c;
}

.fb-hero__desc{
    font-size:18px;
    line-height:1.8;

    color:#565656;
}

/* =========================
   BUTTONS
========================= */
.fb-hero__actions{
    display:flex;
    gap:12px;
    align-items:center;
}

.fb-btn{
    height:68px;
    min-width:220px;

    display:flex;
    justify-content:center;
    align-items:center;

    font-family:var(--sans);
    font-size:13px;
    font-weight:700;

    letter-spacing:.22em;
    text-transform:uppercase;

    transition:.3s;
}

.fb-btn--dark{
    background:#990f12;
    color:white;
      width:170px;
    height:54px;

    padding:0;

    font-size:11px;
    font-weight:600;
    letter-spacing:.22em;
}

.fb-btn--dark:hover{
    transform:translateY(-3px);
}

.fb-btn--outline{
    background:white;
    color:#2d2d2d;

    border:1px solid #d8d0c8;
      width:170px;
    height:54px;

    padding:0;

    font-size:11px;
    font-weight:600;
    letter-spacing:.22em;
}

.fb-btn--outline:hover{
    background:#faf8f5;
}


/* =========================
   RESPONSIVE
========================= */

@media(max-width:1400px){

    .fb-title__main{
        font-size:170px;
    }

    .fb-title__ghost{
        font-size:250px;
    }

    .fb-hero__broole{
        width:500px;
    }
}

/* ─── TICKER ───────────────────────────────────── */
.fb-ticker { background: var(--text); overflow: hidden; padding: .65rem 0; }
.fb-ticker__track { display: flex; white-space: nowrap; animation: fb-tick 30s linear infinite; }
.fb-ticker__item {
    display: inline-flex; align-items: center; gap: .9rem; padding: 0 1.8rem;
    font-family: var(--sans); font-size: .62rem; font-weight: 500;
    letter-spacing: .16em; text-transform: uppercase; color: rgba(255,255,255,.36);
}
.fb-ticker__star { color: var(--gold); font-size: .52rem; }
@keyframes fb-tick { 0%{transform:translateX(0)} 100%{transform:translateX(-50%)} }

/* ─── SHARED ───────────────────────────────────── */
.fb-eyebrow {
    display: flex; align-items: center; gap: .7rem;
    font-family: var(--sans); font-size: .6rem; font-weight: 600;
    letter-spacing: .2em; text-transform: uppercase; color: var(--muted); margin-bottom: .8rem;
}
.fb-edash { flex: 0 0 20px; height: 1.5px; background: var(--gold); }
.fb-body  { font-family: var(--sans); font-size: .86rem; font-weight: 300; color: var(--muted); line-height: 1.9; margin-bottom: .9rem; }

/* Vertical label (gallery / process) */
.fb-vert-line { display: inline-block; width: 1px; height: 36px; background: rgba(28,18,8,.14); vertical-align: middle; margin: 0 .5rem; }

/* ─── CRACK SECTION ────────────────────────────── */
.fb-crack { display: grid; grid-template-columns: 1fr 1fr; min-height: 55vh; }
.fb-crack__left {
    background: var(--white);
    display: flex; flex-direction: column; justify-content: center;
    padding: 5rem 4rem; position: relative;
}
.fb-crack__plus { font-size: 1.2rem; color: var(--gold); margin-bottom: 1rem; }
.fb-crack__big {
    font-family: var(--serif); font-weight: 700;
    font-size: clamp(3.2rem, 5.5vw, 5.5rem); line-height: .86;
    text-transform: uppercase; color: var(--text); margin: .8rem 0 1.5rem;
}
.fb-crack__big em { color: var(--red); font-style: normal; }
.fb-crack__sub { font-family: var(--sans); font-size: .8rem; font-weight: 300; color: var(--muted); line-height: 1.85; margin-bottom: 2rem; }
.fb-watch-btn {
    display: inline-flex; align-items: center; gap: .9rem;
    font-family: var(--sans); font-size: .66rem; font-weight: 600;
    letter-spacing: .14em; text-transform: uppercase; color: var(--text); cursor: pointer;
    text-decoration: none;
}
.fb-watch-btn__circle {
    width: 36px; height: 36px; border-radius: 50%;
    border: 1.5px solid rgba(28,18,8,.2);
    display: flex; align-items: center; justify-content: center; font-size: .75rem;
    transition: .2s; flex-shrink: 0;
}
.fb-watch-btn:hover .fb-watch-btn__circle { background: var(--red); border-color: var(--red); color: #fff; }

.fb-crack__right{
    position:relative;
    overflow:hidden;
    min-height:600px;
}

.fb-crack__video{
    width:100%;
    height:100%;
    object-fit:cover;
    display:block;
}

.fb-crack__overlay{
    position:absolute;
    inset:0;

    display:flex;
    justify-content:center;
    align-items:center;

    pointer-events:none;
}

.fb-crack__play{
    width:80px;
    height:80px;
    border-radius:50%;
    border:2px solid rgba(255,255,255,.5);

    background:rgba(255,255,255,.15);
    backdrop-filter:blur(10px);

    color:white;
    font-size:1.5rem;

    pointer-events:auto;
    cursor:pointer;

    transition:.3s;
}

.fb-crack__play:hover{
    transform:scale(1.1);
}
.fb-crack__play-icon { color: #fff; font-size: 1.4rem; margin-left: 4px; }
@keyframes fb-pp { 0%,100%{box-shadow:0 0 0 0 rgba(255,255,255,.18)} 50%{box-shadow:0 0 0 14px rgba(255,255,255,0)} }

/* ─── PROCESS ──────────────────────────────────── */
.fb-process { background: var(--cream2); position: relative; padding: 4.5rem 5rem; }
.fb-process__vert {
    position: absolute; left: 1.8rem; top: 50%; transform: translateY(-50%);
    writing-mode: vertical-rl;
    font-family: var(--sans); font-size: .5rem; font-weight: 600;
    letter-spacing: .22em; text-transform: uppercase; color: rgba(28,18,8,.24);
    display: flex; align-items: center; gap: 0;
}
.fb-process__inner { max-width: 1150px; margin: 0 auto; }
.fb-process__steps{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:40px;
    align-items:start;
}

.fb-pstep{
    display:flex;
    flex-direction:column;
    height:100%;
}

.fb-pstep__head{
    display:flex;
    align-items:center;
    gap:.6rem;
    margin-bottom:12px;
}

.fb-pstep__label{
    font-family:var(--sans);
    font-size:.75rem;
    font-weight:700;
    letter-spacing:.12em;
    text-transform:uppercase;
    color:var(--text);
    line-height:1.5;

    /* INI YANG BIKIN SEJAJAR */
    min-height:70px;

    margin-bottom:16px;
}

.fb-pstep__img{
    width:100%;
    aspect-ratio:4/3;
    border-radius:14px;
    overflow:hidden;
    background:var(--cream3);
}

.fb-pstep__img img{
    width:100%;
    height:100%;
    object-fit:cover;
}
.fb-pstep__img img { width: 100%; height: 100%; object-fit: cover; transition: .4s; }
.fb-pstep:hover .fb-pstep__img img { transform: scale(1.04); }

/* ───────────────── BEST SELLERS ───────────────── */

.fb-sellers{
    background:#F8F3EC;
    display:grid;
    grid-template-columns:300px 1fr;
    gap:30px;
    padding:60px 50px;
    border-top:1px solid rgba(0,0,0,.06);
}


.fb-sellers__big{
    font-family:var(--serif);
    font-size:95px;
    line-height:.85;
    font-weight:500;
    color:#8F1717;
    margin-bottom:20px;
}

.fb-sellers__grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:20px;
}

.fb-scard{
    background:#fff;
    border:1px solid #ECE5DD;
    border-radius:14px;
    padding:20px;
    transition:.35s;
}

.fb-scard:hover{
    transform:translateY(-6px);
    box-shadow:0 20px 40px rgba(0,0,0,.08);
}

.fb-scard__img-wrap{
    height:260px;
    display:flex;
    justify-content:center;
    align-items:center;
    margin-bottom:20px;
    overflow:hidden;
}

.fb-scard__img-wrap img{
    object-fit:contain;
    transition:.4s;
}

/* ukuran per produk */
.fb-scard:nth-child(1) img{
    width:95%;
}

.fb-scard:nth-child(2) img{
    width:88%;
}

.fb-scard:nth-child(3) img{
    width:75%;
}

.fb-scard:hover img{
    transform:scale(1.05);
}

.fb-scard__name{
    font-family:var(--sans);
    font-size:14px;
    font-weight:700;
    letter-spacing:.14em;
    text-transform:uppercase;
    color:#8F1717;
    margin-bottom:10px;
}

.fb-scard__stars{
    color:#C9A84C;
    font-size:12px;
    margin-bottom:15px;
}

.fb-scard__order{
    font-family:var(--sans);
    font-size:12px;
    font-weight:700;
    letter-spacing:.15em;
    text-transform:uppercase;
    color:#8F1717;
}

/* ─── WHY BROOLE ───────────────────────────────── */
.fb-why{
    display:grid;
    grid-template-columns: 0.9fr 1fr 1fr;
    align-items:center;

    background:#faf5ee;

    border-top:1px solid rgba(0,0,0,.06);
    border-bottom:1px solid rgba(0,0,0,.06);
}
.fb-why__intro{
    padding:60px;
}

.fb-why__big{
    font-family:var(--serif);
    font-size:80px;
    line-height:.9;
    font-weight:500;
    color:#111;
    margin-bottom:25px;
}

.fb-why__big em{
    color:#9e1f1f;
    font-style:normal;
}
.fb-why__photo{
    height:100%;
}

.fb-why__photo img{
    width:100%;
    height:100%;
    object-fit:cover;
    display:block;
}
.fb-why__features{
    padding:50px;
    display:flex;
    flex-direction:column;
    gap:22px;
}
.fb-wfeat{
    display:flex;
    flex-direction:column;
    gap:4px;
}

.fb-wfeat__title{
    font-size:13px;
    font-weight:700;
    letter-spacing:.12em;
    text-transform:uppercase;
    color:#8F1717;
}

.fb-wfeat__sub{
    font-size:14px;
    color:#7b6c5d;
    line-height:1.6;
}



/* ─── TEAM ─────────────────────────────────────── */
.fb-team {
    padding: 80px 50px;
    background: #faf5ee;
    border-bottom: 1px solid rgba(0,0,0,.06);
    text-align: center;
}
.fb-team__header {
    margin-bottom: 60px;
    display: flex;
    flex-direction: column;
    align-items: center;
}
.fb-team__big {
    font-family: var(--serif);
    font-size: 75px;
    line-height: .9;
    font-weight: 500;
    color: #111;
    margin-bottom: 20px;
}
.fb-team__big em {
    color: #9e1f1f;
    font-style: normal;
}
.fb-team__grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 30px;
    max-width: 1100px;
    margin: 0 auto;
}
.fb-tcard {
    display: flex;
    flex-direction: column;
    align-items: center;
}
.fb-tcard__img-wrap {
    width: 180px;
    height: 180px;
    border-radius: 50%;
    overflow: hidden;
    margin-bottom: 20px;
    border: 3px solid #FAF3E8;
    box-shadow: 0 10px 30px rgba(0,0,0,.08);
    transition: transform .4s ease;
}
.fb-tcard:hover .fb-tcard__img-wrap {
    transform: translateY(-8px) scale(1.03);
    box-shadow: 0 15px 40px rgba(143,23,23,.15);
}
.fb-tcard__img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.fb-tcard__name {
    font-family: var(--serif);
    font-size: 28px;
    font-weight: 700;
    color: #111;
    margin-bottom: 4px;
}
.fb-tcard__role {
    font-family: var(--sans);
    font-size: 13px;
    font-weight: 600;
    letter-spacing: .12em;
    text-transform: uppercase;
    color: #8F1717;
}

/* ─── GALLERY ──────────────────────────────────── */
.fb-gallery { position: relative; overflow: hidden; background: var(--cream2); }
.fb-gallery__vert {
    position: absolute; left: 1.8rem; top: 50%; transform: translateY(-50%);
    writing-mode: vertical-rl;
    font-family: var(--sans); font-size: .5rem; font-weight: 600;
    letter-spacing: .22em; text-transform: uppercase; color: rgba(28,18,8,.25); z-index: 2;
    display: flex; align-items: center; gap: 0;
}
.fb-gallery__strip { display: flex; gap: 3px; height: 200px; }
.fb-gallery__item  { flex: 1; overflow: hidden; min-width: 0; }
.fb-gallery__item img { width: 100%; height: 100%; object-fit: cover; transition: .5s; }
.fb-gallery__item:hover img { transform: scale(1.07); }

/* ─── TESTIMONIAL ──────────────────────────────── */
.fb-testi {
    background: linear-gradient(135deg, var(--red-deep) 0%, var(--red-mid) 100%);
    padding: 5rem; position: relative; overflow: hidden;
}
.fb-testi__grain {
    position: absolute; inset: 0; pointer-events: none; z-index: 1; opacity: .04;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
    background-size: 200px;
}
.fb-testi__inner {
    max-width: 1100px; margin: 0 auto;
    display: grid; grid-template-columns: 1fr auto; gap: 4rem; align-items: center;
    position: relative; z-index: 2;
}
.fb-testi__quote-mark {
    font-family: var(--serif); font-size: 5.5rem; font-weight: 700;
    color: rgba(255,255,255,.12); line-height: .7; margin-bottom: 1rem;
}
.fb-testi__text {
    font-family: var(--serif);
    font-size: clamp(2rem, 4vw, 3.5rem); font-weight: 300; color: #fff;
    line-height: .96; text-transform: uppercase; margin-bottom: 1.3rem;
    letter-spacing: -.01em;
}
.fb-testi__text em { font-style: italic; color: var(--gold-lt); }
.fb-testi__stars  { color: var(--gold); font-size: .9rem; margin-bottom: .4rem; letter-spacing: .05em; }
.fb-testi__author { font-family: var(--sans); font-size: .68rem; font-weight: 500; letter-spacing: .14em; text-transform: uppercase; color: rgba(255,255,255,.45); }
.fb-testi__nav    { display: flex; gap: .7rem; margin-top: 2rem; }
.fb-testi__nav-btn {
    width: 38px; height: 38px; border-radius: 50%;
    border: 1.5px solid rgba(255,255,255,.22); background: transparent; color: #fff;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; font-size: 1rem; transition: .2s;
}
.fb-testi__nav-btn:hover { background: rgba(255,255,255,.12); }

/* Right side: circular photo + rotating badge */
.fb-testi__right  { position: relative; flex-shrink: 0; }
.fb-testi__img-wrap {
    width: 260px; height: 260px; border-radius: 50%; overflow: hidden;
    border: 3px solid rgba(255,255,255,.12); position: relative;
}
.fb-testi__img-wrap img { width: 100%; height: 100%; object-fit: cover; }

/* ==========================================
   MOBILE RESPONSIVE
========================================== */
@media (max-width: 768px){

    /* HERO */
    .fb-hero{
        height:auto;
        min-height:100vh;
        padding:80px 20px 40px;
    }

    .fb-hero__vert{
        display:none;
    }

    .fb-hero__title-area{
        padding-bottom:0;
        align-items:flex-start;
    }

    .fb-title__main{
        font-size:60px;
        line-height:.9;
    }

    .fb-title__mid-row{
        height:140px;
    }

    .fb-title__ghost{
        font-size:90px;
    }

    .fb-title__ghost:first-child{
        left:0;
    }

    .fb-title__ghost--r{
        right:0;
    }

    .fb-hero__broole{
        width:260px;
        top:45%;
    }

    .fb-badge--tl{
        top:90px;
        left:15px;
        font-size:11px;
        padding:10px 16px;
    }

    .fb-badge--br{
        right:15px;
        bottom:180px;
        font-size:11px;
        padding:10px 16px;
    }

    .fb-hero__bottom{
        position:relative;
        bottom:auto;
        padding:0;
        margin-top:80px;

        flex-direction:column;
        gap:25px;
        align-items:flex-start;
    }

    .fb-hero__bottom-left{
        width:100%;
    }

    .fb-hero__desc{
        font-size:15px;
    }

    .fb-hero__actions{
        width:100%;
        flex-direction:column;
    }

    .fb-btn{
        width:100%;
    }

    /* CRACK */
    .fb-crack{
        grid-template-columns:1fr;
    }

    .fb-crack__left{
        padding:50px 25px;
    }

    .fb-crack__right{
        min-height:300px;
    }

    /* PROCESS */
    .fb-process{
        padding:60px 20px;
    }

    .fb-process__vert{
        display:none;
    }

    .fb-process__steps{
        grid-template-columns:1fr;
        gap:25px;
    }

    /* BEST SELLER */
    .fb-sellers{
        grid-template-columns:1fr;
        padding:50px 20px;
    }

    .fb-sellers__big{
        font-size:55px;
    }

    .fb-sellers__grid{
        grid-template-columns:1fr;
    }

    /* WHY BROOLE */
    .fb-why{
        grid-template-columns:1fr;
    }

    .fb-why__intro{
        padding:40px 25px;
    }

    .fb-why__big{
        font-size:55px;
    }

    .fb-why__photo{
        height:350px;
    }

    .fb-why__features{
        padding:40px 25px;
    }

    /* TEAM */
    .fb-team { padding: 60px 20px; }
    .fb-team__big { font-size: 50px; }
    .fb-team__grid { grid-template-columns: repeat(2, 1fr); gap: 40px 20px; }
    .fb-tcard__img-wrap { width: 130px; height: 130px; }

    /* GALLERY */
    .fb-gallery__vert{
        display:none;
    }

    .fb-gallery__strip{
        overflow-x:auto;
        height:180px;
    }

    .fb-gallery__item{
        min-width:220px;
    }

    /* TESTIMONIAL */
    .fb-testi{
        padding:60px 20px;
    }

    .fb-testi__inner{
        grid-template-columns:1fr;
        text-align:center;
    }

    .fb-testi__nav{
        justify-content:center;
    }

    .fb-testi__img-wrap{
        width:220px;
        height:220px;
        margin:auto;
    }
}

/* Rotating text badge */
.fb-testi__badge {
    position: absolute; bottom: -16px; right: -16px;
    width: 100px; height: 100px;
    display: flex; align-items: center; justify-content: center;
}
.fb-testi__badge-ring {
    position: absolute; inset: 0; width: 100%; height: 100%;
    animation: fb-br 12s linear infinite;
    background: var(--gold); border-radius: 50%;
}
.fb-testi__badge-star {
    position: relative; z-index: 1;
    font-size: 1.2rem; color: var(--text);
}
@keyframes fb-br { 0%{transform:rotate(0deg)} 100%{transform:rotate(360deg)} }

/* ─── SCROLL REVEAL ──────────────────────────────── */
[data-sr]    { opacity: 0; transform: translateY(28px); transition: opacity .7s ease, transform .7s ease; }
[data-sr-d]  { opacity: 0; transform: translateY(28px); transition: opacity .7s ease .18s, transform .7s ease .18s; }
[data-sr-d2] { opacity: 0; transform: translateY(28px); transition: opacity .7s ease .34s, transform .7s ease .34s; }
[data-sr-d3] { opacity: 0; transform: translateY(28px); transition: opacity .7s ease .5s, transform .7s ease .5s; }
[data-sr].vis, [data-sr-d].vis, [data-sr-d2].vis, [data-sr-d3].vis { opacity: 1; transform: translateY(0); }
</style>


{{-- ============================================================ SCRIPTS --}}
<script>
document.addEventListener('DOMContentLoaded', () => {

    /* ══════════════════════════════════════════════
       PARALLAX BROOLE
       — Gambar bergerak ke bawah seiring scroll hero
       — Sesuai video: mulai center, turun pelan,
         dan sedikit fade sebelum keluar viewport
    ══════════════════════════════════════════════ */
    const broole = document.getElementById('fb-broole');
    const hero   = document.getElementById('fb-hero');

    function parallax() {
        const s  = window.scrollY;
        const hH = hero.offsetHeight;
        /* p = 0 at hero top, 1 at hero bottom */
        const p  = Math.min(Math.max(s / hH, 0), 1);

        /* Move DOWN: max 220px at p=1 */
        const shiftY = p * 220;
        /* Subtle shrink */
        const sc     = 1 - p * 0.06;
        /* Fade out: starts at p=0.55, gone by p=1 */
        const op     = Math.max(1 - (p - 0.3) / 0.7, 0);

        broole.style.transform = `translate(-50%, calc(-50% + ${shiftY}px)) scale(${sc})`;
        broole.style.opacity   = op;
    }

    window.addEventListener('scroll', parallax, { passive: true });
    parallax();

    /* ══════════════════════════════════════════════
       SCROLL REVEAL
    ══════════════════════════════════════════════ */
    const io = new IntersectionObserver(entries => {
        entries.forEach(e => {
            if (e.isIntersecting) { e.target.classList.add('vis'); io.unobserve(e.target); }
        });
    }, { threshold: 0.1 });
    document.querySelectorAll('[data-sr],[data-sr-d],[data-sr-d2],[data-sr-d3]').forEach(el => io.observe(el));

    /* ══════════════════════════════════════════════
       TESTIMONIAL SLIDER
    ══════════════════════════════════════════════ */
    const slides = [
        { text: 'The Best Crème Brûlée<br>In <em>Surabaya.</em>', author: '— Veronica, Surabaya' },
        { text: 'Perfectly Torched,<br><em>Every Time.</em>',      author: '— Rizky, Surabaya'    },
        { text: 'My Favorite Dessert<br><em>In The City.</em>',    author: '— Ayu, Surabaya'      },
    ];
    let idx = 0;
    const tText   = document.getElementById('fb-testi-text');
    const tAuthor = document.getElementById('fb-testi-author');

    function showSlide(i) {
        tText.style.opacity = 0;
        tAuthor.style.opacity = 0;
        setTimeout(() => {
            tText.innerHTML     = slides[i].text;
            tAuthor.textContent = slides[i].author;
            tText.style.opacity = 1;
            tAuthor.style.opacity = 1;
        }, 220);
    }
    tText.style.transition   = 'opacity .22s';
    tAuthor.style.transition = 'opacity .22s';

    document.getElementById('fb-next').addEventListener('click', () => { idx = (idx + 1) % slides.length; showSlide(idx); });
    document.getElementById('fb-prev').addEventListener('click', () => { idx = (idx - 1 + slides.length) % slides.length; showSlide(idx); });

});
</script>

@include('layouts.footer')

@endsection