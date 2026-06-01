{{-- resources/views/customer/profile.blade.php --}}
@extends('customer.layout')

@section('content')

{{-- ============================================================
     FONT IMPORTS
============================================================ --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;0,800;1,400;1,600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
/* ============================================================
   CSS CUSTOM PROPERTIES  (same as shop.blade.php)
============================================================ */
:root {
    --cream:        #F8F5F2;
    --cream-dark:   #EDE8E2;
    --crimson:      #8C1717;
    --crimson-dark: #6A1111;
    --crimson-deep: #4A0D0D;
    --charcoal:     #2C2623;
    --muted:        #655F5A;
    --muted-light:  #9C948E;
    --white:        #FFFFFF;
    --border:       rgba(140, 23, 23, 0.10);
    --border-hover: rgba(140, 23, 23, 0.22);
    --shadow-card:  0 2px 12px rgba(44, 38, 35, 0.06);
    --shadow-hover: 0 24px 56px rgba(140, 23, 23, 0.13), 0 8px 20px rgba(44, 38, 35, 0.06);
    --shadow-btn:   0 6px 20px rgba(140, 23, 23, 0.35);
    --radius-card:  28px;
    --radius-pill:  999px;
    --font-display: 'Cormorant Garamond', Georgia, serif;
    --font-body:    'DM Sans', sans-serif;
    --transition:   all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
}

/* ============================================================
   BASE
============================================================ */
*, *::before, *::after { box-sizing: border-box; }

.profile-page {
    background: var(--cream);
    min-height: 100vh;
    font-family: var(--font-body);
    overflow-x: hidden;
}

/* ============================================================
   HERO / HEADER  (mirrors shop hero pattern)
============================================================ */
.profile-hero {
    position: relative;
    padding: 5.5rem 2rem 3.5rem;
    text-align: center;
    overflow: hidden;
}

/* Decorative background rings */
.profile-hero::before {
    content: '';
    position: absolute;
    top: -120px; left: 50%;
    transform: translateX(-50%);
    width: 700px; height: 700px;
    border-radius: 50%;
    border: 1px solid rgba(140, 23, 23, 0.07);
    pointer-events: none;
}
.profile-hero::after {
    content: '';
    position: absolute;
    top: -60px; left: 50%;
    transform: translateX(-50%);
    width: 450px; height: 450px;
    border-radius: 50%;
    border: 1px solid rgba(140, 23, 23, 0.09);
    pointer-events: none;
}

.hero-inner { position: relative; z-index: 1; }

.hero-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    color: var(--crimson);
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 0.35em;
    text-transform: uppercase;
    margin-bottom: 1.4rem;
    opacity: 0;
    animation: fadeUp 0.7s 0.1s ease forwards;
}
.hero-eyebrow::before,
.hero-eyebrow::after {
    content: '';
    display: block;
    width: 32px; height: 1px;
    background: var(--crimson);
    opacity: 0.5;
}

.hero-title {
    font-family: var(--font-display);
    font-size: clamp(2.8rem, 7vw, 5rem);
    font-weight: 800;
    color: var(--charcoal);
    line-height: 1.05;
    letter-spacing: -0.01em;
    margin-bottom: 1rem;
    opacity: 0;
    animation: fadeUp 0.7s 0.2s ease forwards;
}
.hero-title em {
    font-style: italic;
    color: var(--crimson);
}

.hero-desc {
    color: var(--muted);
    font-size: 15px;
    font-weight: 300;
    line-height: 1.85;
    max-width: 440px;
    margin: 0 auto;
    opacity: 0;
    animation: fadeUp 0.7s 0.3s ease forwards;
}

/* ============================================================
   PROFILE BODY
============================================================ */
.profile-body {
    max-width: 1200px;
    margin: 0 auto;
    padding: 3rem 2rem 6rem;
}

/* Section divider (same as shop) */
.section-divider {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 2.5rem;
    opacity: 0;
    animation: fadeUp 0.6s 0.4s ease forwards;
}
.divider-line {
    flex: 1;
    height: 1px;
    background: var(--border);
}
.divider-label {
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 0.25em;
    text-transform: uppercase;
    color: var(--muted-light);
    white-space: nowrap;
}

/* ============================================================
   MAIN GRID
============================================================ */
.profile-grid {
    display: grid;
    grid-template-columns: 380px 1fr;
    gap: 28px;
    align-items: start;
}

@media (max-width: 960px) {
    .profile-grid {
        grid-template-columns: 1fr;
    }
}

/* ============================================================
   MEMBER CARD COLUMN
============================================================ */
.member-col {
    display: flex;
    flex-direction: column;
    gap: 20px;
    opacity: 0;
    animation: fadeUp 0.6s 0.45s ease forwards;
}

/* ── Loyalty Card ── */
.loyalty-card {
    position: relative;
    overflow: hidden;
    border-radius: var(--radius-card);
    padding: 2.2rem;
    color: var(--white);
    background: linear-gradient(135deg, #700014 0%, #B00020 55%, #4D342E 100%);
    box-shadow: 0 30px 60px rgba(140, 23, 23, 0.35), 0 8px 20px rgba(44, 38, 35, 0.12);
    transition: var(--transition);
}
.loyalty-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 40px 72px rgba(140, 23, 23, 0.40), 0 12px 28px rgba(44, 38, 35, 0.14);
}

/* Radial light overlay */
.loyalty-card::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at top right, rgba(255,255,255,0.14), transparent 50%);
    pointer-events: none;
}

/* Dot pattern texture */
.loyalty-card::after {
    content: '';
    position: absolute;
    inset: 0;
    background-image: radial-gradient(circle, rgba(255,255,255,0.06) 1px, transparent 1px);
    background-size: 22px 22px;
    pointer-events: none;
}

.loyalty-inner { position: relative; z-index: 2; }

.card-eyebrow {
    font-size: 9px;
    font-weight: 600;
    letter-spacing: 0.3em;
    text-transform: uppercase;
    color: rgba(255,255,255,0.65);
    display: flex;
    align-items: center;
    gap: 8px;
}
.card-eyebrow::after {
    content: '';
    flex: 1;
    height: 1px;
    background: rgba(255,255,255,0.2);
}

.card-tier {
    font-family: var(--font-display);
    font-size: 3rem;
    font-weight: 800;
    line-height: 1;
    margin-top: 1rem;
    letter-spacing: -0.02em;
}

.card-points-section {
    margin-top: 2.2rem;
}
.card-points-label {
    font-size: 9px;
    font-weight: 600;
    letter-spacing: 0.28em;
    text-transform: uppercase;
    color: rgba(255,255,255,0.6);
}
.card-points-value {
    display: flex;
    align-items: baseline;
    gap: 8px;
    margin-top: 0.5rem;
}
.card-points-num {
    font-family: var(--font-display);
    font-size: 4rem;
    font-weight: 800;
    line-height: 1;
    letter-spacing: -0.03em;
}
.card-points-unit {
    font-size: 13px;
    font-weight: 600;
    letter-spacing: 0.12em;
    opacity: 0.75;
    margin-bottom: 4px;
}

/* Progress bar */
.card-progress-section {
    margin-top: 2rem;
}
.card-progress-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 9px;
    font-weight: 600;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: rgba(255,255,255,0.6);
    margin-bottom: 0.7rem;
}
.card-progress-bar {
    height: 6px;
    border-radius: var(--radius-pill);
    background: rgba(255,255,255,0.18);
    overflow: hidden;
}
.card-progress-fill {
    height: 100%;
    background: linear-gradient(90deg, rgba(255,255,255,0.7), rgba(255,255,255,1));
    border-radius: var(--radius-pill);
    transition: width 1.2s cubic-bezier(0.25, 0.8, 0.25, 1);
}

/* ── Privileges Panel ── */
.privileges-panel {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-card);
    padding: 1.6rem 1.8rem;
    box-shadow: var(--shadow-card);
    transition: var(--transition);
}
.privileges-panel:hover {
    box-shadow: var(--shadow-hover);
    border-color: var(--border-hover);
}

.privileges-title {
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.22em;
    text-transform: uppercase;
    color: var(--charcoal);
    display: flex;
    align-items: center;
    gap: 8px;
}
.privileges-title::after {
    content: '';
    flex: 1;
    height: 1px;
    background: var(--border);
}

.privileges-desc {
    font-size: 13px;
    font-weight: 300;
    color: var(--muted);
    line-height: 1.8;
    margin-top: 1rem;
}

.privileges-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-top: 1.2rem;
    padding: 7px 14px;
    border-radius: var(--radius-pill);
    background: rgba(140, 23, 23, 0.07);
    border: 1px solid var(--border);
    font-size: 9px;
    font-weight: 700;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: var(--crimson);
}

/* ============================================================
   FORM COLUMN
============================================================ */
.form-col {
    opacity: 0;
    animation: fadeUp 0.6s 0.55s ease forwards;
}

.form-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-card);
    padding: 2.6rem;
    box-shadow: var(--shadow-card);
    position: relative;
    overflow: hidden;
}

/* Subtle stripe accent on form card (matches product-card hover accent) */
.form-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0;
    width: 4px; height: 100%;
    background: var(--crimson);
    border-radius: 4px 0 0 4px;
}

.form-header {
    margin-bottom: 2.2rem;
    padding-bottom: 1.6rem;
    border-bottom: 1px solid var(--border);
}

.form-header-eyebrow {
    font-size: 9px;
    font-weight: 600;
    letter-spacing: 0.3em;
    text-transform: uppercase;
    color: var(--crimson);
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 0.6rem;
}
.form-header-eyebrow::before {
    content: '';
    display: block;
    width: 20px; height: 1px;
    background: var(--crimson);
    opacity: 0.5;
}

.form-header-title {
    font-family: var(--font-display);
    font-size: 2rem;
    font-weight: 700;
    color: var(--charcoal);
    line-height: 1.15;
    letter-spacing: -0.01em;
}

/* ── Alert ── */
.alert-success {
    display: flex;
    align-items: center;
    gap: 10px;
    background: rgba(22, 163, 74, 0.08);
    border: 1px solid rgba(22, 163, 74, 0.25);
    color: #166534;
    padding: 14px 18px;
    border-radius: 16px;
    font-size: 13px;
    font-weight: 500;
    margin-bottom: 2rem;
    animation: fadeUp 0.4s ease forwards;
}
.alert-success::before {
    content: '✓';
    display: flex;
    align-items: center;
    justify-content: center;
    width: 22px; height: 22px;
    background: rgba(22, 163, 74, 0.15);
    border-radius: 50%;
    font-size: 11px;
    font-weight: 700;
    flex-shrink: 0;
}

/* ── Form Fields ── */
.form-fields {
    display: flex;
    flex-direction: column;
    gap: 1.8rem;
}

.field-group { display: flex; flex-direction: column; gap: 0.6rem; }

.field-label-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.field-label {
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 0.25em;
    text-transform: uppercase;
    color: var(--muted-light);
}

.field-badge {
    font-size: 9px;
    font-weight: 700;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: var(--muted-light);
    background: var(--cream-dark);
    padding: 4px 12px;
    border-radius: var(--radius-pill);
}

.field-input-wrap { position: relative; }

.field-input-wrap svg {
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--muted-light);
    pointer-events: none;
    transition: color 0.25s ease;
}

.field-input {
    width: 100%;
    height: 52px;
    border-radius: 16px;
    border: 1px solid var(--border);
    background: var(--cream);
    padding: 0 18px 0 46px;
    font-family: var(--font-body);
    font-size: 14px;
    font-weight: 500;
    color: var(--charcoal);
    outline: none;
    transition: var(--transition);
}
.field-input::placeholder { color: var(--muted-light); font-weight: 300; }
.field-input:focus {
    border-color: var(--border-hover);
    background: var(--white);
    box-shadow: 0 0 0 4px rgba(140, 23, 23, 0.06);
}
.field-input:focus + svg,
.field-input-wrap:focus-within svg {
    color: var(--crimson);
}
/* Icon inside wrap: re-order so input is first for focus-within to work on sibling */
.field-input-wrap .field-input { order: 1; }
.field-input-wrap svg { order: 2; }

/* Disabled field */
.field-input:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    background: var(--cream-dark);
}

.field-hint {
    font-size: 11px;
    font-weight: 300;
    color: var(--muted-light);
    padding-left: 4px;
}

/* ── Divider within form ── */
.form-divider {
    display: flex;
    align-items: center;
    gap: 12px;
    margin: 0.4rem 0;
}
.form-divider-line { flex: 1; height: 1px; background: var(--border); }
.form-divider-label {
    font-size: 9px;
    font-weight: 600;
    letter-spacing: 0.25em;
    text-transform: uppercase;
    color: var(--muted-light);
}

/* ── Submit Button ── */
.btn-submit {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    width: 100%;
    height: 56px;
    border-radius: 18px;
    border: none;
    background: var(--crimson);
    color: var(--white);
    font-family: var(--font-body);
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.3em;
    text-transform: uppercase;
    cursor: pointer;
    margin-top: 0.8rem;
    box-shadow: var(--shadow-btn);
    transition: var(--transition);
    position: relative;
    overflow: hidden;
}
.btn-submit::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(255,255,255,0.12) 0%, transparent 60%);
    pointer-events: none;
}
.btn-submit:hover {
    background: var(--crimson-dark);
    transform: translateY(-2px);
    box-shadow: 0 16px 40px rgba(140, 23, 23, 0.45);
}
.btn-submit:active {
    transform: translateY(0) scale(0.98);
}
.btn-submit svg {
    transition: transform 0.3s ease;
}
.btn-submit:hover svg {
    transform: translateX(3px);
}

/* ============================================================
   KEYFRAMES  (same as shop.blade.php)
============================================================ */
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(18px); }
    to   { opacity: 1; transform: translateY(0);    }
}

@keyframes cardIn {
    from { opacity: 0; transform: translateY(22px); }
    to   { opacity: 1; transform: translateY(0);    }
}

/* ============================================================
   RESPONSIVE
============================================================ */
@media (max-width: 640px) {
    .profile-body { padding: 2rem 1.2rem 4rem; }
    .form-card { padding: 1.8rem 1.4rem; }
    .loyalty-card { padding: 1.8rem; }
    .card-tier { font-size: 2.4rem; }
    .card-points-num { font-size: 3rem; }
}
</style>

{{-- ============================================================
     HTML
============================================================ --}}
<div class="profile-page">

    {{-- HERO --}}
    <section class="profile-hero">
        <div class="hero-inner">
            <div class="hero-eyebrow">
                Member Hub
                &nbsp;✦&nbsp;
                {{ $customer->tier ?? 'Bronze' }}
            </div>

            <h1 class="hero-title">
                Manage <em>Profile</em>
            </h1>

            <p class="hero-desc">
                Customize your From Broole gourmet identity and review your membership status.
            </p>
        </div>
    </section>

    {{-- PROFILE BODY --}}
    <div class="profile-body">

        {{-- Section label --}}
        <div class="section-divider">
            <div class="divider-line"></div>
            <span class="divider-label">Your Member Details</span>
            <div class="divider-line"></div>
        </div>

        {{-- MAIN GRID --}}
        <div class="profile-grid">

            {{-- ──────────────────────────────
                 LEFT: Member Card + Privileges
            ────────────────────────────── --}}
            <div class="member-col">

                {{-- Loyalty Card --}}
                <div class="loyalty-card">
                    <div class="loyalty-inner">
                        <div class="card-eyebrow">Loyalty Member Tier</div>

                        <div class="card-tier">{{ $customer->tier ?? 'Bronze' }}</div>

                        <div class="card-points-section">
                            <div class="card-points-label">Accumulated Points</div>
                            <div class="card-points-value">
                                <span class="card-points-num">{{ $customer->member_points ?? 0 }}</span>
                                <span class="card-points-unit">PTS</span>
                            </div>
                        </div>

                        <div class="card-progress-section">
                            <div class="card-progress-header">
                                <span>Progress to next tier</span>
                                <span>{{ $customer->progress_percentage ?? 0 }}%</span>
                            </div>
                            <div class="card-progress-bar">
                                <div class="card-progress-fill" style="width: {{ $customer->progress_percentage ?? 0 }}%;"></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Privileges Panel --}}
                <div class="privileges-panel">
                    <div class="privileges-title">
                        ✨ Tier Privileges
                    </div>
                    <p class="privileges-desc">
                        The absolute zenith of fine dessert appreciation. You hold the royal scepter of our pastry kitchen.
                    </p>
                    <div>
                        <span class="privileges-badge">
                            ⊚ &nbsp;Verified VIP Member
                        </span>
                    </div>
                </div>

            </div>

            {{-- ──────────────────────────────
                 RIGHT: Profile Form
            ────────────────────────────── --}}
            <div class="form-col">
                <div class="form-card">

                    {{-- Form Header --}}
                    <div class="form-header">
                        <div class="form-header-eyebrow">Account Settings</div>
                        <div class="form-header-title">Update Your Information</div>
                    </div>

                    {{-- Success Flash --}}
                    @if(session('success'))
                        <div class="alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Form --}}
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-fields">

                            {{-- Full Name --}}
                            <div class="field-group">
                                <div class="field-label-row">
                                    <label class="field-label" for="name">Full Name / Display Name</label>
                                </div>
                                <div class="field-input-wrap">
                                    <input
                                        type="text"
                                        id="name"
                                        name="name"
                                        value="{{ old('name', $user->name) }}"
                                        placeholder="Your display name"
                                        required
                                        class="field-input"
                                        autocomplete="name"
                                    >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                                    </svg>
                                </div>
                                <span class="field-hint">This name will appear on your member card and receipts.</span>
                            </div>

                            {{-- Phone --}}
                            <div class="field-group">
                                <div class="field-label-row">
                                    <label class="field-label" for="phone">Phone Number</label>
                                </div>
                                <div class="field-input-wrap">
                                    <input
                                        type="tel"
                                        id="phone"
                                        name="phone"
                                        value="{{ old('phone', $user->phone) }}"
                                        placeholder="+62 xxx xxxx xxxx"
                                        required
                                        class="field-input"
                                        autocomplete="tel"
                                    >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/>
                                    </svg>
                                </div>
                            </div>

                            {{-- Email (read-only) --}}
                            <div class="field-group">
                                <div class="field-label-row">
                                    <label class="field-label" for="email">Email Account</label>
                                    <span class="field-badge">Non-Modifiable</span>
                                </div>
                                <div class="field-input-wrap">
                                    <input
                                        type="email"
                                        id="email"
                                        value="{{ $user->email }}"
                                        disabled
                                        class="field-input"
                                    >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/>
                                    </svg>
                                </div>
                                <span class="field-hint">Contact support if you need to change your email address.</span>
                            </div>

                            {{-- Save Button --}}
                            <button type="submit" class="btn-submit">
                                Save Profile
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                                </svg>
                            </button>

                        </div>
                    </form>
                </div>
            </div>

        </div>{{-- /.profile-grid --}}
    </div>{{-- /.profile-body --}}
</div>{{-- /.profile-page --}}

@endsection