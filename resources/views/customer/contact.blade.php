@extends('layouts.app')

@section('title', 'Contact Us — From Broole')

@section('content')

<div class="ct">

{{-- ══════════════════════════════════════════
     HERO
══════════════════════════════════════════ --}}
<section class="ct-hero">

    {{-- Ghost text background --}}
    <div class="ct-hero__ghost ct-hero__ghost--say">Say</div>
    <div class="ct-hero__ghost ct-hero__ghost--hello">Hello</div>

    {{-- Decorative rings --}}
    <div class="ct-hero__ring"></div>
    <div class="ct-hero__ring2"></div>

    {{-- LEFT: copy --}}
    <div class="ct-hero__left">
        <div class="ct-eyebrow">
            <span class="ct-eyebrow__dash"></span>
            Get In Touch
        </div>
        <h1>Let's Talk<br><em>Crème Brûlée.</em></h1>
        <p class="ct-hero__desc">
            Have a question, special order, or just want to say hi?
            We'd love to hear from you. We reply within 24 hours.
        </p>
    </div>

    {{-- RIGHT: floating image --}}
    <div class="ct-hero__right">
        <div class="ct-hero__img-wrap">
            <img class="ct-hero__img"
                 src="{{ asset('home_assets/contact_us.png') }}"
                 alt="From Broole — Contact">
            <div class="ct-hero__pill">
                <span class="ct-hero__pill-dot"></span>
                Open 10:00 – 22:00
            </div>
            <div class="ct-hero__pill2">
                <i class="ti ti-star-filled"></i>
                5.0 Rating
            </div>
        </div>
    </div>

    {{-- Scroll cue --}}
    <div class="ct-scroll-cue">
        <div class="ct-scroll-cue__mouse">
            <div class="ct-scroll-cue__wheel"></div>
        </div>
        <span>Scroll</span>
    </div>

</section>

{{-- ══════════════════════════════════════════
     TICKER
══════════════════════════════════════════ --}}
<div class="ct-ticker">
    <div class="ct-ticker__track">
        @php $items = ['Contact Us','Say Hello','Custom Orders','Partnership','100% Halal','Reply in 24h','From Broole','Surabaya, ID']; @endphp
        @foreach(array_merge($items,$items) as $item)
            <span class="ct-ticker__item"><span class="ct-ticker__star">✦</span>{{ $item }}</span>
        @endforeach
    </div>
</div>

{{-- ══════════════════════════════════════════
     MAIN GRID — Form + Info
══════════════════════════════════════════ --}}
<section class="ct-main">

    {{-- ── FORM SIDE ── --}}
    <div class="ct-form-side" data-sr>

        <div class="ct-section-label">Send Us A Message</div>

        @if(session('success'))
            <div class="ct-alert ct-alert--success">
                <i class="ti ti-circle-check"></i>
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="ct-alert ct-alert--error">
                <i class="ti ti-alert-circle"></i>
                Please fix the errors below.
            </div>
        @endif
        <form id="contactForm">
            @csrf

            <div class="ct-row2">
                <div class="ct-field">
                    <label class="ct-label" for="first_name">First Name</label>
                    <input class="ct-input @error('first_name') ct-input--err @enderror"
                           type="text" id="first_name" name="first_name"
                           value="{{ old('first_name') }}" placeholder="Rizky">
                    @error('first_name')<span class="ct-ferr">{{ $message }}</span>@enderror
                </div>
                <div class="ct-field">
                    <label class="ct-label" for="last_name">Last Name</label>
                    <input class="ct-input @error('last_name') ct-input--err @enderror"
                           type="text" id="last_name" name="last_name"
                           value="{{ old('last_name') }}" placeholder="Pratama">
                    @error('last_name')<span class="ct-ferr">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="ct-field">
                <label class="ct-label" for="email">Email</label>
                <input class="ct-input @error('email') ct-input--err @enderror"
                       type="email" id="email" name="email"
                       value="{{ old('email') }}" placeholder="rizky@email.com">
                @error('email')<span class="ct-ferr">{{ $message }}</span>@enderror
            </div>

            <div class="ct-field">
                <label class="ct-label" for="subject">Subject</label>
                <select class="ct-input ct-select @error('subject') ct-input--err @enderror"
                        id="subject" name="subject">
                    <option value="" disabled {{ old('subject') ? '' : 'selected' }}>Choose a topic...</option>
                    <option value="General Inquiry"  {{ old('subject')=='General Inquiry'  ?'selected':'' }}>General Inquiry</option>
                    <option value="Bulk Order"       {{ old('subject')=='Bulk Order'       ?'selected':'' }}>Custom / Bulk Order</option>
                    <option value="Partnership"      {{ old('subject')=='Partnership'      ?'selected':'' }}>Partnership & Collaboration</option>
                    <option value="Feedback"         {{ old('subject')=='Feedback'         ?'selected':'' }}>Feedback & Complaints</option>
                    <option value="Other"            {{ old('subject')=='Other'            ?'selected':'' }}>Other</option>
                </select>
                @error('subject')<span class="ct-ferr">{{ $message }}</span>@enderror
            </div>

            <div class="ct-field">
                <label class="ct-label" for="message">Message</label>
                <textarea class="ct-input ct-textarea @error('message') ct-input--err @enderror"
                          id="message" name="message" rows="6"
                          placeholder="Tell us what's on your mind…">{{ old('message') }}</textarea>
                @error('message')<span class="ct-ferr">{{ $message }}</span>@enderror
            </div>

            <button type="button" class="ct-submit" id="ct-submit-btn">
                Send Message <span class="ct-submit__arrow">→</span>
            </button>

        </form>
    </div>

    {{-- ── INFO SIDE ── --}}
    <div class="ct-info-side" data-sr-d>

        <div class="ct-section-label">Contact Information</div>

        <div class="ct-icard" data-sr>
            <div class="ct-icard__icon"><i class="ti ti-map-pin"></i></div>
            <h3 class="ct-icard__title">Location</h3>
            <p class="ct-icard__val">Jl. Made No. 12, Surabaya</p>
            <p class="ct-icard__sub">East Java, Indonesia 60111</p>
        </div>
        <div class="ct-icard" data-sr-d>
            <div class="ct-icard__icon"><i class="ti ti-mail"></i></div>
            <h3 class="ct-icard__title">Email</h3>
            <p class="ct-icard__val">hello@frombroole.com</p>
            <p class="ct-icard__sub">Replies within 24 hours</p>
        </div>
        <div class="ct-icard" data-sr-d2>
            <div class="ct-icard__icon"><i class="ti ti-brand-whatsapp"></i></div>
            <h3 class="ct-icard__title">WhatsApp</h3>
            <p class="ct-icard__val">+62 899-930-0200</p>
            <p class="ct-icard__sub">Usually replies in under 1 hour</p>
        </div>
        <div class="ct-icard" data-sr-d3>
            <div class="ct-icard__icon"><i class="ti ti-clock"></i></div>
            <h3 class="ct-icard__title">Opening Hours</h3>
            <p class="ct-icard__val">Monday – Sunday</p>
            <p class="ct-icard__sub">10:00 – 22:00 WIB · No days off</p>
        </div>

        
    </div>

</section>

{{-- ══════════════════════════════════════════
     FAQ
══════════════════════════════════════════ --}}
<section class="ct-faq">
    <div class="ct-faq__head" data-sr>
        <div class="ct-faq__eyebrow">
            <span class="ct-faq__eyebrow-dash"></span>FAQ<span class="ct-faq__eyebrow-dash"></span>
        </div>
        <h2 class="ct-faq__title">Frequently Asked<br><em>Questions</em></h2>
        <p class="ct-faq__sub">Quick answers to things we get asked the most.</p>
    </div>

    @php
$faqs = [

[
'q' => 'How do I place an order?',
'a' => 'You can place your order directly through our website. Simply browse our desserts, add your favorites to the cart, and complete the checkout process.'
],

[
'q' => 'Do you have a physical store?',
'a' => 'Currently, From Broole operates exclusively online. This allows us to focus on crafting fresh desserts made to order and delivering them directly to our customers.'
],

[
'q' => 'Do you offer custom or bulk orders?',
'a' => 'Absolutely! We accept custom and bulk orders for birthdays, corporate events, weddings, and special occasions. We recommend contacting us at least 3 days in advance.'
],

[
'q' => 'How long does crème brûlée stay fresh?',
'a' => 'Our desserts are best enjoyed within 24–48 hours when stored in the refrigerator. For the best experience, consume them as soon as possible after delivery.'
],

[
'q' => 'What payment methods do you accept?',
'a' => 'We accept Bank Transfer, QRIS, GoPay, OVO, DANA, and other popular digital payment methods available during checkout.'
],

[
'q' => 'How long does delivery take?',
'a' => 'Delivery times depend on your location and order volume. Most orders within Surabaya are delivered on the same day or according to your selected schedule.'
],

[
'q' => 'Are your products halal?',
'a' => 'Yes. We carefully select halal ingredients and maintain strict preparation standards to ensure every dessert is suitable for our customers.'
],

[
'q' => 'How can I contact From Broole?',
'a' => 'You can reach us through the Contact Us page, WhatsApp, or our social media channels. We typically respond within a few hours during business hours.'
],

];
        @endphp
        @foreach($faqs as $index => $faq)
        <div class="ct-faq-item" data-faq data-sr{{ $index % 3 == 1 ? '-d' : ($index % 3 == 2 ? '-d2' : '') }}>
            <div class="ct-faq-item__q">
                {{ $faq['q'] }}
                <i class="ti ti-circle-plus ct-faq-item__icon"></i>
            </div>
            <div class="ct-faq-item__a">{{ $faq['a'] }}</div>
        </div>
        @endforeach
    </div>
</section>

{{-- ══════════════════════════════════════════
     SOCIALS STRIP
══════════════════════════════════════════ --}}
<div class="ct-socials">
    <div class="ct-socials__text">Follow our <em>sweet journey.</em></div>
    <div class="ct-socials__links">
        <a href="https://instagram.com/frombroole" target="_blank" class="ct-social-btn">
            <i class="ti ti-brand-instagram"></i> Instagram
        </a>
        <a href="https://wa.me/628999300200" target="_blank" class="ct-social-btn">
            <i class="ti ti-brand-whatsapp"></i> WhatsApp
        </a>
    </div>
</div>

</div>{{-- /.ct --}}

@include('layouts.footer')


@push('styles')
<style>/* ─── TOKENS ─── */
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

.ct *, .ct *::before, .ct *::after { box-sizing: border-box; }
.ct { font-family: var(--sans); background: var(--cream); }
.ct a { text-decoration: none; color: inherit; }
.ct img { display: block; max-width: 100%; }

/* ─── HERO ─── */
.ct-hero {
    position: relative; overflow: hidden;
    min-height: 84vh;
    display: flex; align-items: center; justify-content: space-between;
    padding: 0 8%;
    background: linear-gradient(135deg, #73000e 0%, #9b0a1e 38%, #b61021 65%, #80000e 100%);
}

/* Grain overlay */
.ct-hero::before {
    content: ''; position: absolute; inset: 0; z-index: 1; opacity: .04; pointer-events: none;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
    background-size: 200px;
}

/* Ghost typography */
.ct-hero__ghost {
    position: absolute; z-index: 1;
    font-family: var(--serif); font-weight: 700;
    color: rgba(255,255,255,.045); line-height: .8;
    pointer-events: none; user-select: none;
    font-size: clamp(200px,28vw,420px);
}
.ct-hero__ghost--say   { top: -60px;    left: -20px; }
.ct-hero__ghost--hello { bottom: -100px; left: -10px; }

/* Rings */
.ct-hero__ring  { position: absolute; top: -120px; right: 38%; width: 380px; height: 380px; border-radius: 50%; border: 1px solid rgba(255,255,255,.07); z-index: 1; pointer-events: none; }
.ct-hero__ring2 { position: absolute; top: -60px; right: calc(38% + 40px); width: 260px; height: 260px; border-radius: 50%; border: 1px solid rgba(201,168,76,.12); z-index: 1; pointer-events: none; }

.ct-hero__left  { position: relative; z-index: 2; width: 52%; }
.ct-hero__right { position: relative; z-index: 2; width: 42%; display: flex; align-items: center; justify-content: center; }

/* Eyebrow */
.ct-eyebrow {
    display: flex; align-items: center; gap: .8rem;
    font-family: var(--sans); font-size: .6rem; font-weight: 600;
    letter-spacing: .26em; text-transform: uppercase;
    color: rgba(255,255,255,.5); margin-bottom: 1.8rem;
}
.ct-eyebrow__dash { width: 28px; height: 1.5px; background: var(--gold); flex-shrink: 0; }

/* Title */
.ct-hero h1 {
    font-family: var(--serif);
    font-size: clamp(4.5rem, 8vw, 7.5rem);
    font-weight: 300; line-height: .88;
    color: #fff; letter-spacing: -.02em; margin-bottom: 2rem;
}
.ct-hero h1 em { font-style: italic; color: var(--gold-lt); }

/* Desc */
.ct-hero__desc {
    font-family: var(--sans); font-size: .88rem; font-weight: 300;
    color: rgba(255,255,255,.5); line-height: 1.9; max-width: 360px;
    border-left: 2px solid rgba(201,168,76,.3); padding-left: 1.2rem;
}

/* Floating image */
.ct-hero__img-wrap { position: relative; width: 100%; display: flex; align-items: center; justify-content: center; }
.ct-hero__left{
    width:40%;
    opacity: 0;
    animation: fadeUp 0.7s 0.1s ease forwards;
}

.ct-hero__right{
    width:60%;
    display:flex;
    justify-content:flex-end;
    align-items:center;
    opacity: 0;
    animation: fadeUp 0.7s 0.3s ease forwards;
}

.ct-hero__img{
    width:125%;
    max-width:850px;

    object-fit:contain;

    filter:
    drop-shadow(0 40px 80px rgba(0,0,0,.35));

    animation:ct-float 5s ease-in-out infinite;
}
@keyframes ct-float { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-14px)} }

/* Pill badges */
.ct-hero__pill {
    position: absolute; bottom: 18%; left: 0;
    background: rgba(255,255,255,.12); border: 1px solid rgba(255,255,255,.2);
    backdrop-filter: blur(10px);
    padding: .5rem 1.1rem; border-radius: 50px;
    font-family: var(--sans); font-size: .66rem; font-weight: 600; color: #fff;
    display: flex; align-items: center; gap: .5rem;
    animation: ct-bp 3.5s ease-in-out infinite;
}
.ct-hero__pill2 {
    position: absolute; top: 20%; right: 0;
    background: var(--gold); color: var(--text);
    padding: .5rem 1.1rem; border-radius: 50px;
    font-family: var(--sans); font-size: .66rem; font-weight: 600;
    display: flex; align-items: center; gap: .5rem;
    animation: ct-bp 3.5s ease-in-out infinite .7s;
}
.ct-hero__pill-dot { width: 7px; height: 7px; border-radius: 50%; background: #4ADE80; flex-shrink: 0; }
@keyframes ct-bp { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-5px)} }

/* Scroll cue */
.ct-scroll-cue {
    position: absolute; bottom: 2rem; left: 50%; transform: translateX(-50%);
    z-index: 3; display: flex; flex-direction: column; align-items: center; gap: .4rem;
    font-family: var(--sans); font-size: .52rem; font-weight: 500;
    letter-spacing: .15em; text-transform: uppercase; color: rgba(255,255,255,.28);
}
.ct-scroll-cue__mouse { width: 20px; height: 30px; border: 1.5px solid rgba(255,255,255,.2); border-radius: 10px; display: flex; justify-content: center; padding-top: 4px; }
.ct-scroll-cue__wheel { width: 3px; height: 6px; border-radius: 2px; background: rgba(255,255,255,.3); animation: ct-swh 1.5s ease-in-out infinite; }
@keyframes ct-swh { 0%{transform:translateY(0);opacity:1} 100%{transform:translateY(7px);opacity:0} }

/* ─── TICKER ─── */
.ct-ticker { background: var(--text); overflow: hidden; padding: .65rem 0; }
.ct-ticker__track { display: flex; white-space: nowrap; animation: ct-tick 30s linear infinite; }
.ct-ticker__item { display: inline-flex; align-items: center; gap: .9rem; padding: 0 1.8rem; font-family: var(--sans); font-size: .62rem; font-weight: 500; letter-spacing: .16em; text-transform: uppercase; color: rgba(255,255,255,.36); }
.ct-ticker__star { color: var(--gold); font-size: .52rem; }
@keyframes ct-tick { 0%{transform:translateX(0)} 100%{transform:translateX(-50%)} }

/* ─── SECTION LABEL ─── */
.ct-section-label {
    display: flex; align-items: center; gap: .6rem;
    font-family: var(--sans); font-size: .56rem; font-weight: 700;
    letter-spacing: .22em; text-transform: uppercase;
    color: var(--muted); margin-bottom: 2.5rem;
}
.ct-section-label::before { content: ''; display: block; width: 16px; height: 1.5px; background: var(--gold); flex-shrink: 0; }

/* ─── MAIN GRID ─── */
.ct-main { display: grid; grid-template-columns: 1fr 1fr; }

/* ─── FORM SIDE ─── */
.ct-form-side { background: var(--white); padding: 5rem 6%; display: flex; flex-direction: column; }
.ct-form-side form { display: flex; flex-direction: column; gap: 1.2rem; }
.ct-row2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
.ct-field { display: flex; flex-direction: column; gap: .4rem; }

/* ─── SCROLL REVEAL ─── */
[data-sr]    { opacity: 0; transform: translateY(28px); transition: opacity .7s ease, transform .7s ease; }
[data-sr-d]  { opacity: 0; transform: translateY(28px); transition: opacity .7s ease .18s, transform .7s ease .18s; }
[data-sr-d2] { opacity: 0; transform: translateY(28px); transition: opacity .7s ease .34s, transform .7s ease .34s; }
[data-sr-d3] { opacity: 0; transform: translateY(28px); transition: opacity .7s ease .50s, transform .7s ease .50s; }
[data-sr].vis, [data-sr-d].vis, [data-sr-d2].vis, [data-sr-d3].vis { opacity: 1; transform: translateY(0); }

.ct-label { font-family: var(--sans); font-size: .56rem; font-weight: 700; letter-spacing: .14em; text-transform: uppercase; color: var(--muted); }
.ct-input {
    font-family: var(--sans); font-size: .82rem; font-weight: 300;
    color: var(--text); background: var(--cream);
    border: 1.5px solid rgba(28,18,8,.08);
    padding: .8rem 1rem; outline: none; width: 100%;
    transition: border-color .2s, background .2s; appearance: none; border-radius: 0;
}
.ct-input:focus { border-color: var(--gold); background: #fff; }
.ct-input::placeholder { color: rgba(28,18,8,.25); }
.ct-input--err { border-color: var(--red) !important; }
.ct-textarea { resize: vertical; min-height: 140px; }
.ct-select {
    cursor: pointer;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24'%3E%3Cpath fill='none' stroke='%237A6A58' stroke-width='2' d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
    background-repeat: no-repeat; background-position: right 1rem center; padding-right: 2.5rem;
}
.ct-ferr { font-family: var(--sans); font-size: .65rem; color: var(--red); font-weight: 300; }
.ct-alert { display: flex; align-items: center; gap: .6rem; padding: .85rem 1.1rem; font-family: var(--sans); font-size: .78rem; font-weight: 300; margin-bottom: 1rem; }
.ct-alert--success { background: rgba(74,222,128,.1); color: #166534; border: 1px solid rgba(74,222,128,.3); }
.ct-alert--error   { background: rgba(184,28,28,.07); color: var(--red); border: 1px solid rgba(184,28,28,.2); }
.ct-submit {
    display: inline-flex; align-items: center; gap: .8rem;
    align-self: flex-start; margin-top: .5rem; padding: 1rem 2.6rem;
    font-family: var(--sans); font-size: .7rem; font-weight: 700;
    letter-spacing: .16em; text-transform: uppercase;
    background: var(--red-deep); color: #fff; border: none; cursor: pointer;
    transition: transform .2s, background .2s;
}
.ct-submit:hover { transform: translateY(-2px); background: #580d15; }
.ct-submit:disabled { opacity: .6; cursor: not-allowed; transform: none; }
.ct-submit__arrow { transition: transform .2s; }
.ct-submit:hover .ct-submit__arrow { transform: translateX(3px); }

/* ─── INFO SIDE ─── */
.ct-info-side { background: var(--cream2); padding: 5rem 6%; display: flex; flex-direction: column; }
.ct-icard {
    background: var(--white); padding: 1.5rem 1.8rem;
    border-left: 3px solid var(--gold); margin-bottom: 1.2rem;
    transition: transform .2s, box-shadow .2s; position: relative; overflow: hidden;
}
.ct-icard::before { content: ''; position: absolute; inset: 0; background: linear-gradient(135deg,rgba(201,168,76,.04),transparent 60%); }
.ct-icard:hover { transform: translateX(5px); box-shadow: 4px 0 20px rgba(107,15,26,.08); }
.ct-icard__icon { width: 38px; height: 38px; border-radius: 8px; background: rgba(184,28,28,.08); display: flex; align-items: center; justify-content: center; font-size: 1.1rem; color: var(--red); margin-bottom: .7rem; }
.ct-icard__title { font-family: var(--sans); font-size: .52rem; font-weight: 700; letter-spacing: .18em; text-transform: uppercase; color: var(--muted); margin-bottom: .35rem; }
.ct-icard__val { font-family: var(--serif); font-size: 1.1rem; font-weight: 600; color: var(--text); line-height: 1.3; }
.ct-icard__sub { font-family: var(--sans); font-size: .7rem; font-weight: 300; color: var(--muted); margin-top: .15rem; line-height: 1.6; }
.ct-map-ph { margin-top: 1rem; height: 160px; background: linear-gradient(135deg,var(--cream3),var(--cream2)); border: 1px solid rgba(28,18,8,.07); display: flex; align-items: center; justify-content: center; flex-direction: column; gap: .5rem; color: var(--muted); }
.ct-map-ph i { font-size: 1.8rem; color: var(--red); }
.ct-map-ph span { font-family: var(--sans); font-size: .66rem; font-weight: 600; letter-spacing: .12em; text-transform: uppercase; }

/* ─── FAQ ─── */
.ct-faq { background: var(--white); padding: 6rem 8%; }
.ct-faq__head { text-align: center; margin-bottom: 4rem; }
.ct-faq__eyebrow { display: flex; align-items: center; justify-content: center; gap: .6rem; font-family: var(--sans); font-size: .56rem; font-weight: 700; letter-spacing: .2em; text-transform: uppercase; color: var(--muted); margin-bottom: 1rem; }
.ct-faq__eyebrow-dash { width: 16px; height: 1.5px; background: var(--gold); flex-shrink: 0; }
.ct-faq__title { font-family: var(--serif); font-size: clamp(2.5rem,5vw,4rem); font-weight: 300; color: var(--text); margin: .5rem 0; line-height: .95; }
.ct-faq__title em { color: var(--red); font-style: italic; }
.ct-faq__sub { font-family: var(--sans); font-size: .82rem; font-weight: 300; color: var(--muted); margin-top: .8rem; }

.ct-faq__grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1px; background: rgba(28,18,8,.06); max-width: 1000px; margin: 0 auto; }
.ct-faq-item { background: var(--white); padding: 1.6rem 2rem; cursor: pointer; transition: background .2s; border-left: 3px solid transparent; }
.ct-faq-item:hover { background: var(--cream); }
.ct-faq-item.open { background: var(--cream); border-left-color: var(--gold); }
.ct-faq-item__q { font-family: var(--sans); font-size: .82rem; font-weight: 600; color: var(--text); display: flex; justify-content: space-between; align-items: flex-start; gap: .5rem; line-height: 1.5; }
.ct-faq-item__icon { color: var(--gold); font-size: 1.05rem; flex-shrink: 0; margin-top: 1px; transition: transform .25s; }
.ct-faq-item.open .ct-faq-item__icon { transform: rotate(45deg); }
.ct-faq-item__a { font-family: var(--sans); font-size: .75rem; font-weight: 300; color: var(--muted); line-height: 1.75; max-height: 0; overflow: hidden; transition: max-height .35s ease, margin-top .2s; }
.ct-faq-item.open .ct-faq-item__a { max-height: 200px; margin-top: .8rem; }

/* ─── SOCIALS ─── */
.ct-socials { background: var(--text); padding: 3.5rem 8%; display: flex; align-items: center; justify-content: space-between; gap: 2rem; position: relative; overflow: hidden; }
.ct-socials::before { content: '✦'; position: absolute; right: 25%; top: 50%; transform: translateY(-50%); font-size: 12rem; color: rgba(255,255,255,.03); font-family: var(--serif); pointer-events: none; }
.ct-socials__text { font-family: var(--serif); font-size: 2rem; font-weight: 300; color: #fff; line-height: 1; }
.ct-socials__text em { font-style: italic; color: var(--gold-lt); }
.ct-socials__links { display: flex; gap: .7rem; }
.ct-social-btn { display: inline-flex; align-items: center; gap: .5rem; padding: .65rem 1.4rem; font-family: var(--sans); font-size: .62rem; font-weight: 600; letter-spacing: .12em; text-transform: uppercase; border: 1.5px solid rgba(255,255,255,.12); color: rgba(255,255,255,.5); cursor: pointer; transition: border-color .2s, color .2s; }
.ct-social-btn:hover { border-color: var(--gold); color: var(--gold); }

/* ─── SCROLL REVEAL ─── */
[data-sr]   { opacity: 0; transform: translateY(26px); transition: opacity .7s ease, transform .7s ease; }
[data-sr-d] { opacity: 0; transform: translateY(26px); transition: opacity .7s ease .15s, transform .7s ease .15s; }
[data-sr].vis, [data-sr-d].vis { opacity: 1; transform: translateY(0); }

/* ─── RESPONSIVE ─── */
@media (max-width: 991px) {
    .ct-hero { flex-direction: column; justify-content: center; padding: 6rem 6%; text-align: center; min-height: auto; }
    .ct-hero__left,.ct-hero__right { width: 100%; }
    .ct-hero__right { margin-top: 3rem; }
    .ct-hero__ghost { display: none; }
    .ct-eyebrow { justify-content: center; }
    .ct-hero__desc { margin: 0 auto; }
    .ct-main { grid-template-columns: 1fr; }
    .ct-form-side,.ct-info-side { padding: 3rem 6%; }
    .ct-row2 { grid-template-columns: 1fr; }
    .ct-faq { padding: 3rem 6%; }
    .ct-faq__grid { grid-template-columns: 1fr; }
    .ct-socials { flex-direction: column; align-items: flex-start; padding: 2.5rem 6%; }
}
</style>
@endpush


{{-- ══════════════════════════════════════════
     SCRIPTS
══════════════════════════════════════════ --}}
<script>
document.addEventListener('DOMContentLoaded', () => {

    /* FAQ Accordion */
    document.querySelectorAll('[data-faq]').forEach(item => {
        item.addEventListener('click', () => {
            const isOpen = item.classList.contains('open');
            document.querySelectorAll('[data-faq]').forEach(i => i.classList.remove('open'));
            if (!isOpen) item.classList.add('open');
        });
    });

    /* Submit loading state */
    const form = document.querySelector('.ct-form-side form');
    const btn  = document.getElementById('ct-submit-btn');
    if (form && btn) {
        form.addEventListener('submit', () => {
            btn.disabled = true;
            btn.innerHTML = 'Sending… <span class="ct-submit__arrow">→</span>';
        });
    }

    /* Scroll reveal */
    const io = new IntersectionObserver(entries => {
        entries.forEach(e => {
            if (e.isIntersecting) { e.target.classList.add('vis'); io.unobserve(e.target); }
        });
    }, { threshold: 0.1 });
    document.querySelectorAll('[data-sr],[data-sr-d],[data-sr-d2],[data-sr-d3]').forEach(el => io.observe(el));

});

document.getElementById('ct-submit-btn').addEventListener('click', function() {

    const firstName = document.getElementById('first_name').value;
    const lastName  = document.getElementById('last_name').value;
    const email     = document.getElementById('email').value;
    const subject   = document.getElementById('subject').value;
    const message   = document.getElementById('message').value;

    const text =
`Halo From Broole, ${firstName} ${lastName} 
Email: ${email}
Subject: ${subject}

Pesan:
${message}`;

    const waUrl =
        `https://wa.me/628999300200?text=${encodeURIComponent(text)}`;

    window.open(waUrl, '_blank');
});
</script>

@endsection