<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="scroll-smooth overflow-x-clip">
<head>
    <script>
    (function(){ document.documentElement.setAttribute('data-theme', localStorage.getItem('frombroole_theme') || 'light'); })();
    </script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="<?php echo e(asset('images/logo_from_broole.png')); ?>">

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    
    <script>
        window.isLoggedIn = <?php echo json_encode(auth()->check(), 15, 512) ?>;

        // Global Auth Interceptor (Capture Phase)
        document.addEventListener('click', function(e) {
            const link = e.target.closest('.requires-auth');
            if (link && !window.isLoggedIn) {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
                const modal = document.getElementById('globalLoginModal');
                if (modal) modal.classList.add('show');
            }
        }, true);
    </script>
    
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <style>
    :root {
        --bg-base: #F8F5F2; --bg-nav: #F5F4EE; --bg-card: #FFFFFF;
        --bg-subtle: rgba(61,56,51,0.05); --text-primary: #3D3833;
        --text-muted: rgba(61,56,51,.70); --border-light: rgba(224,222,215,.40);
        --border-subtle: rgba(61,56,51,.05); --brand: #9E1111; --brand-deep: #8C1717;
        --topbar-bg: #9E1111; --input-bg: #FFFFFF;
        --bg-card-hover: #F9F7F5;
        --text-heading: #2C2623;
        --text-body: #655F5A;
        --text-subtle: #7A6E68;
        --text-faint: #A89080;
        --shadow-card: 0 8px 32px rgba(0,0,0,0.06);
    }
    [data-theme="dark"] {
        --bg-base: #1A1714; --bg-nav: #211E1A; --bg-card: #2A2520;
        --bg-subtle: rgba(255,255,255,.04); --text-primary: #F0EDE8;
        --text-muted: rgba(240,237,232,.55); --border-light: rgba(255,255,255,.08);
        --border-subtle: rgba(255,255,255,.06); --brand: #E03333; --brand-deep: #C82222;
        --topbar-bg: #7A0D0D; --input-bg: #2A2520;
        --bg-card-hover: #332E28;
        --text-heading: #F0EDE8;
        --text-body: #B5AFA8;
        --text-subtle: #9A928A;
        --text-faint: #7A736D;
        --shadow-card: 0 8px 32px rgba(0,0,0,0.3);

        /* Unified CSS Variable Overrides for all pages (Shop, Cart, Tasks, Profile, History, Contact, About) */
        --charcoal: #F0EDE8 !important;
        --cream: #1A1714 !important;
        --cream-dark: #211E1A !important;
        --crimson: #E03333 !important;
        --crimson-dark: #C82222 !important;
        --muted: #B5AFA8 !important;
        --muted-light: #7A736D !important;
        --border: rgba(255,255,255,.08) !important;
        --border-hover: rgba(255,255,255,.15) !important;
        --white: #2A2520 !important;
        --green: #4ade80 !important;
        --red-bg: rgba(239,68,68,.08) !important;
        
        --cream2: #211E1A !important;
        --cream3: #2A2520 !important;
        --text: #F0EDE8 !important;
        
        --bg: #1A1714 !important;
        --card-bg: #2A2520 !important;
        
        --text-primary: #F0EDE8 !important;
        --text-muted: rgba(240,237,232,.55) !important;
        --brand: #E03333 !important;
        --brand-light: rgba(224,51,51,.10) !important;
        --brand-mid: rgba(224,51,51,.22) !important;
        --brand-glow: rgba(224,51,51,.35) !important;
    }

    /* ═══════════════════════════════════════════════════
       GLOBAL DARK MODE OVERRIDES
       Catches all hardcoded Tailwind color classes
       used across customer pages
    ═══════════════════════════════════════════════════ */

    /* --- Dark Mode Toggle Icons --- */
    .dm-icon-sun { display: none; color: #9ca3af; }
    .group:hover .dm-icon-sun { color: #facc15 !important; }
    .dm-icon-moon { display: block; color: #6b7280; }
    .group:hover .dm-icon-moon { color: #8C1717 !important; }
    [data-theme="dark"] .dm-icon-moon { display: none !important; }
    [data-theme="dark"] .dm-icon-sun { display: block !important; }

    /* --- Universal Theme Transition --- */
    html.theme-animating *, html.theme-animating *::before, html.theme-animating *::after {
        transition: background-color .4s ease, border-color .4s ease, color .4s ease, fill .4s ease, stroke .4s ease !important;
    }
    [data-theme="dark"] body {
        background: var(--bg-base) !important;
        color: var(--text-primary) !important;
    }

    /* --- Header / Nav --- */
    header { background: var(--bg-nav) !important; border-color: var(--border-light) !important; }


    [data-theme="dark"] .bg-\[\#F8F5F2\],
    [data-theme="dark"] .bg-\[\#F5F2EE\],
    [data-theme="dark"] .bg-\[\#EFECE7\] {
        background: var(--bg-base) !important;
    }
    [data-theme="dark"] .bg-\[\#F5F4EE\],
    [data-theme="dark"] .bg-\[\#F5F4EE\]\/95 {
        background: var(--bg-nav) !important;
    }
    [data-theme="dark"] .bg-\[\#FDFAF7\] {
        background: var(--bg-nav) !important;
    }
    [data-theme="dark"] .bg-white,
    [data-theme="dark"] .bg-white\/70,
    [data-theme="dark"] .bg-white\/80,
    [data-theme="dark"] .bg-white\/90 {
        background: var(--bg-card) !important;
    }
    [data-theme="dark"] .bg-\[\#FFFDFB\],
    [data-theme="dark"] .bg-\[\#FFF8F4\],
    [data-theme="dark"] .bg-\[\#FFF8EE\],
    [data-theme="dark"] .bg-\[\#FFF8F0\],
    [data-theme="dark"] .bg-\[\#FFFCF7\],
    [data-theme="dark"] .bg-\[\#F6EEE8\],
    [data-theme="dark"] .bg-\[\#F3F1EC\],
    [data-theme="dark"] .bg-\[\#FAF9F5\],
    [data-theme="dark"] .bg-\[\#FFF1F1\] {
        background: var(--bg-card) !important;
    }
    [data-theme="dark"] .bg-\[\#3D3833\]\/5 {
        background: var(--bg-subtle) !important;
    }
    [data-theme="dark"] .bg-\[\#9E1111\] {
        background: var(--topbar-bg) !important;
    }
    [data-theme="dark"] .bg-gray-50 {
        background: rgba(255,255,255,.03) !important;
    }
    [data-theme="dark"] .bg-gray-100 {
        background: rgba(255,255,255,.05) !important;
    }
    [data-theme="dark"] .bg-yellow-100 {
        background: rgba(245,200,66,.15) !important;
    }
    [data-theme="dark"] .bg-orange-100 {
        background: rgba(251,146,60,.12) !important;
    }
    [data-theme="dark"] .bg-green-50 {
        background: rgba(34,197,94,.08) !important;
    }
    [data-theme="dark"] .bg-red-50 {
        background: rgba(239,68,68,.1) !important;
    }

    /* --- Hero / gradient sections --- */
    [data-theme="dark"] .bg-gradient-to-r.from-\[\#F7ECEB\],
    [data-theme="dark"] section[class*="bg-gradient-to-r"][class*="from-[#F7ECEB]"] {
        background: linear-gradient(to right, #1E1A17, #221F1B, #1E1B18) !important;
    }
    [data-theme="dark"] .bg-gradient-to-br.from-\[\#FFFDFB\],
    [data-theme="dark"] div[class*="bg-gradient-to-br"][class*="from-[#FFFDFB]"] {
        background: linear-gradient(to bottom right, #2A2520, #262220, #231F1C) !important;
    }
    [data-theme="dark"] .bg-gradient-to-br.from-\[\#FFF8EE\],
    [data-theme="dark"] div[class*="bg-gradient-to-br"][class*="from-[#FFF8EE]"] {
        background: linear-gradient(to bottom right, #2A2520, #262220) !important;
    }

    /* --- Text colors --- */
    [data-theme="dark"] .text-\[\#8C1717\] {
        color: var(--crimson) !important;
    }
    [data-theme="dark"] .text-\[\#3D3833\] {
        color: var(--text-primary) !important;
    }

    /* --- Login Modal --- */
    .login-modal-overlay {
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0,0,0,0.5);
        backdrop-filter: blur(4px);
        z-index: 99999;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s ease;
    }
    .login-modal-overlay.show {
        opacity: 1;
        pointer-events: auto;
    }
    .login-modal {
        background: var(--bg-card, #FFFFFF);
        padding: 35px 30px;
        border-radius: 24px;
        width: 90%;
        max-width: 400px;
        text-align: center;
        transform: translateY(20px);
        transition: transform 0.3s ease;
        box-shadow: 0 20px 40px rgba(0,0,0,0.2);
    }
    .login-modal-overlay.show .login-modal {
        transform: translateY(0);
    }
    .login-modal__icon {
        font-size: 3rem;
        margin-bottom: 15px;
    }
    .login-modal__title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--text-primary, #2C2623);
        margin-bottom: 12px;
    }
    .login-modal__text {
        font-size: 14px;
        color: var(--text-muted, #655F5A);
        margin-bottom: 25px;
        line-height: 1.6;
    }
    .login-modal__actions {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    .login-modal__btn-login {
        background: var(--brand, #8C1717);
        color: #fff;
        padding: 14px;
        border-radius: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: 0.2s;
        font-size: 15px;
    }
    .login-modal__btn-login:hover {
        background: #6A1111;
    }
    .login-modal__btn-shop {
        background: transparent;
        color: var(--text-muted, #655F5A);
        padding: 14px;
        border-radius: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: 0.2s;
        border: 1px solid var(--border-color, rgba(140, 23, 23, 0.10));
        font-size: 15px;
    }
    .login-modal__btn-shop:hover {
        background: var(--bg-card-hover, #EDE8E2);
        color: var(--text-primary, #2C2623);
    }
    [data-theme="dark"] .text-\[\#3D3833\]\/70 {
        color: var(--text-muted) !important;
    }
    [data-theme="dark"] .text-\[\#3D3833\]\/10 {
        color: rgba(240,237,232,.10) !important;
    }
    [data-theme="dark"] .text-\[\#2C2623\] {
        color: var(--text-heading) !important;
    }
    [data-theme="dark"] .text-\[\#655F5A\] {
        color: var(--text-body) !important;
    }
    [data-theme="dark"] .text-\[\#7A6E68\] {
        color: var(--text-subtle) !important;
    }
    [data-theme="dark"] .text-\[\#A89080\] {
        color: var(--text-faint) !important;
    }
    [data-theme="dark"] .text-\[\#6E675F\] {
        color: var(--text-body) !important;
    }
    [data-theme="dark"] .text-\[\#7A736D\] {
        color: var(--text-subtle) !important;
    }
    [data-theme="dark"] .text-black {
        color: var(--text-primary) !important;
    }
    [data-theme="dark"] .text-gray-400 {
        color: rgba(240,237,232,.35) !important;
    }
    [data-theme="dark"] .text-gray-500 {
        color: rgba(240,237,232,.45) !important;
    }
    [data-theme="dark"] .text-gray-600 {
        color: rgba(240,237,232,.55) !important;
    }
    [data-theme="dark"] .text-gray-700 {
        color: rgba(240,237,232,.65) !important;
    }
    [data-theme="dark"] .text-gray-800 {
        color: rgba(240,237,232,.75) !important;
    }
    [data-theme="dark"] .text-yellow-700 {
        color: #F5C842 !important;
    }
    [data-theme="dark"] .text-orange-700 {
        color: #FB923C !important;
    }

    /* --- Border colors --- */
    [data-theme="dark"] .border-\[\#E0DED7\]\/40 {
        border-color: var(--border-light) !important;
    }
    [data-theme="dark"] .border-\[\#3D3833\]\/5,
    [data-theme="dark"] .border-\[\#3D3833\]\/10 {
        border-color: var(--border-subtle) !important;
    }
    [data-theme="dark"] .border-\[\#8C1717\]\/10,
    [data-theme="dark"] .border-\[\#8C1717\]\/15 {
        border-color: rgba(224,51,51,.12) !important;
    }
    [data-theme="dark"] .border-\[\#E5E0DA\] {
        border-color: var(--border-light) !important;
    }
    [data-theme="dark"] .border-\[\#B88A44\]\/10 {
        border-color: rgba(184,138,68,.15) !important;
    }
    [data-theme="dark"] .border-\[\#D4AF37\]\/20 {
        border-color: rgba(212,175,55,.15) !important;
    }
    [data-theme="dark"] .border-t,
    [data-theme="dark"] .border-b,
    [data-theme="dark"] .border {
        border-color: var(--border-light) !important;
    }
    [data-theme="dark"] .divide-y > * + * {
        border-color: var(--border-light) !important;
    }

    /* --- Navbar specific elements --- */
    [data-theme="dark"] .bg-\[\#8C1717\]\/15 {
        background: rgba(224,51,51,.10) !important;
    }
    [data-theme="dark"] #nav-cart-btn {
        background: var(--bg-card) !important;
        border-color: var(--border-light) !important;
        color: var(--text-subtle) !important;
    }
    [data-theme="dark"] #nav-cart-badge {
        box-shadow: 0 0 0 2px var(--bg-nav) !important;
    }
    /* Account dropdown button */
    [data-theme="dark"] button[class*="border-\[\#3D3833\]\/10"][class*="bg-white"] {
        background: var(--bg-card) !important;
        border-color: var(--border-light) !important;
        color: var(--text-subtle) !important;
    }
    /* Dropdown panel */
    [data-theme="dark"] div[class*="border-\[\#E5E0DA\]"][class*="bg-white"] {
        background: var(--bg-card) !important;
        border-color: var(--border-light) !important;
    }
    [data-theme="dark"] .hover\:bg-gray-100:hover {
        background: rgba(255,255,255,.06) !important;
    }
    [data-theme="dark"] .hover\:bg-red-50:hover {
        background: rgba(239,68,68,.08) !important;
    }
    /* Mobile menu */
    [data-theme="dark"] div[class*="bg-\[\#FDFAF7\]"] {
        background: var(--bg-nav) !important;
    }
    [data-theme="dark"] .bg-\[\#FDFAF7\] {
        background: var(--bg-nav) !important;
    }

    /* --- Ring colors --- */
    [data-theme="dark"] .ring-white {
        --tw-ring-color: var(--bg-nav) !important;
    }

    /* --- Input / Form elements --- */
    [data-theme="dark"] input,
    [data-theme="dark"] textarea,
    [data-theme="dark"] select {
        background: var(--input-bg) !important;
        color: var(--text-primary) !important;
        border-color: var(--border-light) !important;
    }

    /* --- Widget/popup overlays --- */
    [data-theme="dark"] [x-show="openWidget"] {
        background: var(--bg-card) !important;
        border-color: var(--border-light) !important;
    }
    [data-theme="dark"] [x-show="open"] {
        background: var(--bg-card) !important;
        border-color: var(--border-light) !important;
    }

    /* --- Shadows --- */
    [data-theme="dark"] .shadow-sm,
    [data-theme="dark"] .shadow-md,
    [data-theme="dark"] .shadow-lg,
    [data-theme="dark"] .shadow-xl {
        --tw-shadow-color: rgba(0,0,0,.3) !important;
    }

    /* --- "Why Choose Us" cards & similar white cards --- */
    [data-theme="dark"] div[class*="bg-white"][class*="rounded-\[36px\]"] {
        background: var(--bg-card) !important;
        border-color: var(--border-light) !important;
    }

    /* --- About section gradient box --- */
    [data-theme="dark"] div[class*="from-\[\#FFFDFB\]"][class*="via-\[\#FFF8F4\]"] {
        background: linear-gradient(to bottom right, #2A2520, #262220, #231F1C) !important;
    }

    /* --- Stats cards in About --- */
    [data-theme="dark"] div[class*="bg-white\/80"][class*="backdrop-blur"] {
        background: rgba(42,37,32,.8) !important;
        border-color: rgba(224,51,51,.1) !important;
    }

    /* --- Cart page custom CSS overrides --- */
    [data-theme="dark"] .cart-header {
        background: transparent !important;
    }
    [data-theme="dark"] .order-summary {
        background: var(--bg-card) !important;
        border-color: var(--border-light) !important;
    }
    [data-theme="dark"] .cart-item {
        background: var(--bg-card) !important;
        border-color: var(--border-light) !important;
    }
    [data-theme="dark"] .item-img-wrap {
        background: rgba(255,255,255,.04) !important;
        border-color: rgba(255,255,255,.06) !important;
    }
    [data-theme="dark"] .summary-header {
        border-color: var(--border-light) !important;
    }
    [data-theme="dark"] .summary-divider {
        background: var(--border-light) !important;
    }
    [data-theme="dark"] .trust-badges {
        border-color: var(--border-light) !important;
    }
    [data-theme="dark"] .trust-badge-icon {
        background: rgba(255,255,255,.05) !important;
    }
    [data-theme="dark"] .notes-textarea {
        background: var(--input-bg) !important;
        border-color: var(--border-light) !important;
        color: var(--text-primary) !important;
    }
    [data-theme="dark"] .promo-input {
        background: var(--input-bg) !important;
        border-color: var(--border-light) !important;
        color: var(--text-primary) !important;
    }
    [data-theme="dark"] .points-management-box,
    [data-theme="dark"] div[style*="background: #f6f3f1"] {
        background: rgba(255,255,255,.04) !important;
    }
    [data-theme="dark"] .toast-inner {
        background: #2A2520 !important;
        color: var(--text-primary) !important;
    }
    [data-theme="dark"] .btn-clear-cart {
        border-color: var(--border-light) !important;
        color: var(--text-muted) !important;
    }
    [data-theme="dark"] .empty-cart {
        color: var(--text-primary) !important;
    }

    /* --- Shop page product cards --- */
    [data-theme="dark"] .bg-\[\#F9F5F0\],
    [data-theme="dark"] .bg-\[\#FAF7F4\],
    [data-theme="dark"] .bg-\[\#FCFAF8\] {
        background: var(--bg-card) !important;
    }

    /* --- Transaction History --- */
    [data-theme="dark"] .bg-\[\#faf8f5\],
    [data-theme="dark"] .bg-\[\#FAF8F5\] {
        background: var(--bg-base) !important;
    }
    [data-theme="dark"] details {
        background: var(--bg-card) !important;
    }
    [data-theme="dark"] .order-body {
        background: var(--bg-base) !important;
    }
    [data-theme="dark"] .step-node.active {
        background: var(--bg-card) !important;
    }
    [data-theme="dark"] .step-node.inactive {
        background: var(--bg-base) !important;
    }
    [data-theme="dark"] tr {
        border-color: var(--border-light) !important;
    }
    [data-theme="dark"] th {
        background: rgba(255,255,255,.03) !important;
        color: var(--text-muted) !important;
        border-color: var(--border-light) !important;
    }
    [data-theme="dark"] td {
        color: var(--text-primary) !important;
        border-color: var(--border-light) !important;
    }

    /* --- Tasks page --- */
    [data-theme="dark"] .bg-\[\#FEF3C7\] {
        background: rgba(245,200,66,.1) !important;
    }

    /* --- Contact page & About Page --- */
    [data-theme="dark"] .bg-\[\#fdf8f4\],
    [data-theme="dark"] .bg-\[\#FDF8F4\] {
        background: var(--bg-base) !important;
    }
    [data-theme="dark"] .ct-ticker,
    [data-theme="dark"] .ct-socials,
    [data-theme="dark"] .fb-ticker {
        background: #1A0E08 !important; /* Keep it dark */
    }
    [data-theme="dark"] .fb-hero {
        background: radial-gradient(circle at center, #1E1A17 0%, #1A1714 60%, #110E0C 100%) !important;
    }
    [data-theme="dark"] .fb-badge--tl,
    [data-theme="dark"] .fb-badge--br {
        background: var(--bg-card) !important;
        color: var(--text-primary) !important;
        border-color: var(--border-light) !important;
    }
    [data-theme="dark"] .fb-btn--outline {
        background: var(--bg-card) !important;
        color: var(--text-primary) !important;
        border-color: var(--border-light) !important;
    }
    [data-theme="dark"] .fb-btn--outline:hover {
        background: var(--bg-base) !important;
    }
    [data-theme="dark"] .fb-crack__play {
        background: rgba(255,255,255, 0.05) !important;
    }
    [data-theme="dark"] .fb-sellers,
    [data-theme="dark"] .fb-why {
        background: var(--bg-base) !important;
    }
    [data-theme="dark"] .fb-scard {
        background: var(--bg-card) !important;
        border-color: var(--border-light) !important;
    }
    [data-theme="dark"] .fb-sellers__big,
    [data-theme="dark"] .fb-why__big,
    [data-theme="dark"] .fb-team__big,
    [data-theme="dark"] .fb-tcard__name {
        color: var(--text-primary) !important;
    }
    [data-theme="dark"] .fb-team {
        background: var(--bg-base) !important;
        border-color: var(--border-light) !important;
    }
    [data-theme="dark"] .fb-tcard__img-wrap {
        border-color: var(--bg-card) !important;
    }

    /* ─── CUSTOM CURSOR ─── */
    @media (pointer: fine) {
        body {
            cursor: none;
        }
        a, button, input, textarea, select, details, summary {
            cursor: none !important;
        }
        #custom-cursor-dot {
            position: fixed;
            top: 0;
            left: 0;
            width: 8px;
            height: 8px;
            background-color: var(--brand);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            pointer-events: none;
            z-index: 999999;
            transition: width 0.2s ease-out, height 0.2s ease-out, background-color 0.2s ease-out, border 0.2s ease-out;
            box-sizing: border-box;
        }
        [data-theme="dark"] #custom-cursor-dot {
            background-color: var(--brand);
        }

        /* CURSOR HOVER STATE */
        body.cursor-hover #custom-cursor-dot {
            width: 28px;
            height: 28px;
            background-color: transparent !important;
            border: none;
            border-radius: 0;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23D4AF37' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cline x1='17' y1='17' x2='7' y2='7'/%3E%3Cpolyline points='17 7 7 7 7 17'/%3E%3C/svg%3E");
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
        }
        [data-theme="dark"] body.cursor-hover #custom-cursor-dot {
            border: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23F5C842' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cline x1='17' y1='17' x2='7' y2='7'/%3E%3Cpolyline points='17 7 7 7 7 17'/%3E%3C/svg%3E");
        }
        #custom-cursor-glow {
            display: block;
            position: fixed;
            top: 0;
            left: 0;
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(140, 23, 23, 0.15) 0%, transparent 65%);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            pointer-events: none;
            z-index: 999998;
            mix-blend-mode: multiply;
        }
        [data-theme="dark"] #custom-cursor-glow {
            background: radial-gradient(circle, rgba(224, 51, 51, 0.12) 0%, transparent 65%);
            mix-blend-mode: screen;
        }
        .cursor-particle {
            position: fixed;
            pointer-events: none;
            z-index: 999997;
            opacity: 0.7;
            color: var(--brand);
            font-size: 14px;
            animation: particleFade 0.8s ease-out forwards;
        }
        .cursor-particle::after {
            content: "❤";
        }
        .heart-pop {
            position: fixed;
            pointer-events: none;
            z-index: 999999;
            color: var(--brand);
            font-size: 18px;
            animation: particleFade 1s cubic-bezier(0.25, 1, 0.5, 1) forwards;
        }
        .heart-pop::after {
            content: "❤";
        }
        @keyframes particleFade {
            0% { transform: translate(-50%, -50%) scale(1); opacity: 0.8; }
            100% { transform: translate(calc(-50% + var(--tx)), calc(-50% + var(--ty))) scale(0); opacity: 0; }
        }

    }

    /* --- Custom Navbar Underline --- */
    .nav-link-underline {
        position: absolute;
        bottom: 4px;
        left: 16px;
        right: 16px;
        height: 1.5px;
        background-color: #8C1717;
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.3s ease;
    }
    .group:hover .nav-link-underline {
        transform: scaleX(1);
    }
    .is-active .nav-link-underline {
        transform: scaleX(1);
    }

    /* --- Animated Falling Orbs Background --- */
    .bg-animation-container {
        position: fixed;
        inset: 0;
        z-index: 0;
        overflow: hidden;
        pointer-events: none;
    }
    .falling-orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(2px); /* sharp edges */
        border: 1.5px solid currentColor;
        opacity: 0.95;
        animation: fallDown linear forwards;
        box-shadow: inset 0 0 15px rgba(0, 0, 0, 0.05), 0 0 10px currentColor;
    }
    [data-theme="dark"] .falling-orb {
        border: 1.5px solid currentColor;
        box-shadow: inset 0 0 20px rgba(255, 255, 255, 0.1), 0 0 15px currentColor;
    }
    @keyframes fallDown {
        0% { transform: translateY(-200px) scale(1); opacity: 0; }
        10% { opacity: 0.6; }
        90% { opacity: 0.6; }
        100% { transform: translateY(calc(100vh + 200px)) scale(1.2); opacity: 0; }
    }

    /* --- Profile edit page --- */
    [data-theme="dark"] .bg-\[\#f5f0eb\],
    [data-theme="dark"] .bg-\[\#F5F0EB\] {
        background: var(--bg-base) !important;
    }

    /* --- Footer overrides (already mostly dark, just ensure consistency) --- */
    [data-theme="dark"] .fb-footer__pre {
        background: #0D0806 !important;
    }
    [data-theme="dark"] .fb-footer {
        background: #0D0806 !important;
    }

    /* --- Misc utility overrides --- */
    [data-theme="dark"] .text-white\/90 { color: rgba(240,237,232,.9) !important; }
    [data-theme="dark"] hr { border-color: var(--border-light) !important; }
    [data-theme="dark"] .placeholder\:text-gray-400::placeholder { color: rgba(240,237,232,.3) !important; }

    /* --- Custom Scrollbar (Global) --- */
    ::-webkit-scrollbar { width: 8px; }
    ::-webkit-scrollbar-track { background: var(--bg-base); }
    ::-webkit-scrollbar-thumb { background: rgba(0,0,0,.15); border-radius: 4px; }
    ::-webkit-scrollbar-thumb:hover { background: rgba(0,0,0,.25); }

    [data-theme="dark"] ::-webkit-scrollbar-track { background: var(--bg-base); }
    [data-theme="dark"] ::-webkit-scrollbar-thumb { background: rgba(255,255,255,.12); border-radius: 4px; }
    [data-theme="dark"] ::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,.2); }

    /* --- AlpineJS Cloak --- */
    [x-cloak] { display: none !important; }

    /* --- All pages: inline style color overrides (for style="" attributes) --- */
    [data-theme="dark"] [style*="background: #f6f3f1"],
    [data-theme="dark"] [style*="background:#f6f3f1"],
    [data-theme="dark"] [style*="background: #F6F3F1"],
    [data-theme="dark"] [style*="background:#F6F3F1"] {
        background: rgba(255,255,255,.04) !important;
    }
    [data-theme="dark"] [style*="background: #fff"],
    [data-theme="dark"] [style*="background:#fff"],
    [data-theme="dark"] [style*="background: #FFF"] {
        background: var(--bg-card) !important;
    }
    [data-theme="dark"] [style*="color: #2d2a29"],
    [data-theme="dark"] [style*="color:#2d2a29"],
    [data-theme="dark"] [style*="color: #8b8580"],
    [data-theme="dark"] [style*="color:#8b8580"] {
        color: var(--text-primary) !important;
    }
    [data-theme="dark"] [style*="color: #7b0000"],
    [data-theme="dark"] [style*="color:#7b0000"] {
        color: #E03333 !important;
    }
    [data-theme="dark"] [style*="border-color: #e5e7eb"],
    [data-theme="dark"] [style*="border: 1px solid #e5e7eb"] {
        border-color: var(--border-light) !important;
    }

    /* ═══════════════════════════════════════════════════
       PAGE-SPECIFIC DARK MODE: SHOP PAGE
       Overrides CSS custom properties defined in shop.blade.php
    ═══════════════════════════════════════════════════ */
    [data-theme="dark"] .shop-page {
        --cream: #1A1714 !important;
        --cream-dark: #141210 !important;
        --charcoal: #F0EDE8 !important;
        --muted: #B5AFA8 !important;
        --muted-light: #7A736D !important;
        --white: #2A2520 !important;
        --border: rgba(255,255,255,.08) !important;
        --border-hover: rgba(255,255,255,.15) !important;
        --shadow-card: 0 2px 12px rgba(0,0,0,.25) !important;
        --shadow-hover: 0 24px 56px rgba(0,0,0,.35), 0 8px 20px rgba(0,0,0,.2) !important;
        background: transparent !important;
    }
    [data-theme="dark"] .shop-hero {
        background: transparent !important;
    }
    [data-theme="dark"] .shop-hero::before,
    [data-theme="dark"] .shop-hero::after {
        border-color: rgba(224,51,51,.06) !important;
    }
    [data-theme="dark"] .product-card {
        background: var(--bg-card) !important;
        border-color: rgba(255,255,255,.06) !important;
    }
    [data-theme="dark"] .card-image-wrap {
        background: rgba(255,255,255,.03) !important;
    }
    [data-theme="dark"] .filter-btn.is-inactive {
        background: var(--bg-card) !important;
        color: var(--text-muted) !important;
        border-color: rgba(255,255,255,.08) !important;
    }
    [data-theme="dark"] .filter-btn.is-inactive:hover {
        background: rgba(224,51,51,.08) !important;
        border-color: rgba(224,51,51,.15) !important;
    }
    [data-theme="dark"] .sugar-select {
        background: var(--input-bg) !important;
        border-color: rgba(255,255,255,.08) !important;
        color: var(--text-muted) !important;
    }
    [data-theme="dark"] .badge-soldout {
        background: rgba(42,37,32,.92) !important;
        border-color: rgba(220,38,38,.3) !important;
    }
    [data-theme="dark"] .divider-line {
        background: rgba(255,255,255,.06) !important;
    }
    [data-theme="dark"] .card-footer {
        border-color: rgba(255,255,255,.06) !important;
    }
    [data-theme="dark"] .btn-add.unavailable {
        background: rgba(255,255,255,.05) !important;
    }
    /* Shop search input */
    [data-theme="dark"] #searchInput {
        background: var(--input-bg) !important;
        border-color: rgba(255,255,255,.08) !important;
        color: var(--text-primary) !important;
    }

    /* ═══════════════════════════════════════════════════
       PAGE-SPECIFIC DARK MODE: ABOUT PAGE
    ═══════════════════════════════════════════════════ */
    [data-theme="dark"] .about-section {
        background: #0D0606 !important;
    }
    [data-theme="dark"] .about-card {
        background: linear-gradient(135deg, #151010, #1B1111, #140B0B) !important;
    }

    /* ═══════════════════════════════════════════════════
       PAGE-SPECIFIC DARK MODE: CONTACT PAGE
    ═══════════════════════════════════════════════════ */
    [data-theme="dark"] .contact-page,
    [data-theme="dark"] div[class*="contact"] {
        color: var(--text-primary) !important;
    }

    /* ═══════════════════════════════════════════════════
       PAGE-SPECIFIC DARK MODE: TASKS PAGE
    ═══════════════════════════════════════════════════ */
    [data-theme="dark"] .task-card,
    [data-theme="dark"] div[class*="task-card"] {
        background: var(--bg-card) !important;
        border-color: var(--border-light) !important;
    }

    /* ═══════════════════════════════════════════════════
       PAGE-SPECIFIC DARK MODE: TRANSACTION HISTORY
    ═══════════════════════════════════════════════════ */
    [data-theme="dark"] table {
        border-color: var(--border-light) !important;
    }
    [data-theme="dark"] thead {
        background: rgba(255,255,255,.03) !important;
    }
    [data-theme="dark"] tbody tr:hover {
        background: rgba(255,255,255,.03) !important;
    }

    /* ═══════════════════════════════════════════════════
       PAGE-SPECIFIC DARK MODE: PROFILE EDIT
    ═══════════════════════════════════════════════════ */
    [data-theme="dark"] .profile-card,
    [data-theme="dark"] div[class*="profile"] {
        color: var(--text-primary) !important;
    }

    /* ═══════════════════════════════════════════════════
       AI CHAT WIDGET DARK MODE
    ═══════════════════════════════════════════════════ */
    [data-theme="dark"] #ai-chat-popup {
        background: var(--bg-card) !important;
        border-color: var(--border-light) !important;
    }
    [data-theme="dark"] #ai-chat-messages {
        background: var(--bg-base) !important;
    }
    [data-theme="dark"] .ai-msg-user {
        background: var(--topbar-bg) !important;
    }
    [data-theme="dark"] .ai-msg-bot {
        background: rgba(255,255,255,.05) !important;
        color: var(--text-primary) !important;
    }
    /* AI Chat — specific Tailwind overrides */
    [data-theme="dark"] .bg-\[\#FAF8F5\] {
        background: var(--bg-base) !important;
    }
    [data-theme="dark"] .bg-\[\#F5F1EC\] {
        background: rgba(255,255,255,.05) !important;
    }
    [data-theme="dark"] .hover\:bg-\[\#EEE7E0\]:hover {
        background: rgba(255,255,255,.08) !important;
    }
    [data-theme="dark"] .text-\[\#5F5B57\] {
        color: var(--text-body) !important;
    }
    [data-theme="dark"] .text-\[\#2F2A26\] {
        color: var(--text-heading) !important;
    }
    [data-theme="dark"] .text-\[\#A79C91\] {
        color: var(--text-faint) !important;
    }
    [data-theme="dark"] .border-\[\#F0ECE8\],
    [data-theme="dark"] .border-\[\#EFE9E4\] {
        border-color: var(--border-light) !important;
    }
    /* AI Chat bubble: bot message */
    [data-theme="dark"] div[class*="bg-white"][class*="border-\[\#EFE9E4\]"] {
        background: var(--bg-card) !important;
        border-color: var(--border-light) !important;
        color: var(--text-primary) !important;
    }
    /* AI Chat input bar */
    [data-theme="dark"] div[class*="bg-\[\#F5F1EC\]"][class*="rounded-full"] {
        background: rgba(255,255,255,.06) !important;
    }

    /* ── NAV CART BUTTON ── */
    #nav-cart-btn {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 10px;
        border: 1px solid rgba(61,56,51,0.10);
        background: white;
        color: #7A6E68;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s ease;
        flex-shrink: 0;
    }
    #nav-cart-btn:hover {
        border-color: rgba(140,23,23,0.30);
        color: #8C1717;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(140,23,23,0.10);
    }

    /* Badge */
    #nav-cart-badge {
        position: absolute;
        top: -6px;
        right: -6px;
        min-width: 20px;
        height: 20px;
        padding: 0 5px;
        border-radius: 999px;
        background: #8C1717;
        color: #fff;
        font-size: 10px;
        font-weight: 700;
        display: none;           /* hidden until items are added */
        align-items: center;
        justify-content: center;
        line-height: 1;
        ring-width: 2px;
        box-shadow: 0 0 0 2px #FDFAF7;
        pointer-events: none;
    }
    [data-theme="dark"] #nav-cart-badge {
        box-shadow: 0 0 0 2px #211E1A;
    }

    @keyframes navBadgeBump {
        0%   { transform: scale(1); }
        50%  { transform: scale(1.40); }
        100% { transform: scale(1); }
    }

    /* ── TOGGLE BUTTON ── */
    #dm-toggle {
        position: fixed;
        bottom: 90px;
        right: 22px;
        z-index: 9999;
        cursor: grab;
        user-select: none;
        touch-action: none;
    }
    #dm-toggle:active { cursor: grabbing; }
    #dm-toggle-btn {
        width: 58px; height: 58px;
        border-radius: 50%;
        border: none;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer;
        transition: transform .2s, box-shadow .4s, background .4s;
        position: relative;
        overflow: visible;
    }
    #dm-toggle-btn:hover { transform: scale(1.10); }
    #dm-toggle-btn:active { transform: scale(.93); }

    /* Light mode = red glow */
    [data-theme="light"] #dm-toggle-btn {
        background: #FFFFFF;
        box-shadow:
        0 0 0 2px rgba(158,17,17,.22),
        0 0 18px 6px rgba(158,17,17,.28),
        0 0 42px 14px rgba(158,17,17,.11),
        0 4px 16px rgba(0,0,0,.12);
    }
    [data-theme="light"] #dm-toggle-btn:hover {
        box-shadow:
        0 0 0 2.5px rgba(158,17,17,.38),
        0 0 28px 10px rgba(158,17,17,.44),
        0 0 62px 22px rgba(158,17,17,.17),
        0 6px 20px rgba(0,0,0,.15);
    }

    /* Dark mode = gold glow */
    [data-theme="dark"] #dm-toggle-btn {
        background: #2A2520;
        box-shadow:
        0 0 0 2px rgba(245,200,66,.28),
        0 0 18px 6px rgba(245,200,66,.34),
        0 0 42px 14px rgba(245,200,66,.13),
        0 4px 16px rgba(0,0,0,.35);
    }
    [data-theme="dark"] #dm-toggle-btn:hover {
        box-shadow:
        0 0 0 2.5px rgba(245,200,66,.48),
        0 0 28px 10px rgba(245,200,66,.54),
        0 0 62px 22px rgba(245,200,66,.21),
        0 6px 20px rgba(0,0,0,.45);
    }

    /* Icon swap */
    .dm-icon { position: absolute; width: 28px; height: 28px; transition: opacity .3s, transform .3s; }
    [data-theme="light"] .dm-icon-moon { opacity: 1; transform: rotate(0deg) scale(1); }
    [data-theme="light"] .dm-icon-sun  { opacity: 0; transform: rotate(90deg) scale(.5); }
    [data-theme="dark"]  .dm-icon-moon { opacity: 0; transform: rotate(-90deg) scale(.5); }
    [data-theme="dark"]  .dm-icon-sun  { opacity: 1; transform: rotate(0deg) scale(1); }

    /* Tooltip */
    #dm-toggle::after {
        content: attr(data-tip);
        position: absolute; right: 68px; top: 50%; transform: translateY(-50%);
        padding: 5px 12px; border-radius: 20px;
        font-size: 11px; font-weight: 700; letter-spacing: .1em; text-transform: uppercase;
        white-space: nowrap; pointer-events: none;
        opacity: 0; transition: opacity .2s;
        background: var(--bg-card); color: var(--brand);
        box-shadow: 0 2px 12px rgba(0,0,0,.15);
    }
    #dm-toggle:hover::after { opacity: 1; }
    
    /* ── MOBILE NAVBAR HIDE ── */
    @media (max-width: 639px) {
        .hide-on-mobile { display: none !important; }
        .show-on-mobile-only { display: block !important; }
    }
    @media (min-width: 640px) {
        .show-on-mobile-only { display: none !important; }
    }
    </style>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700&family=Montserrat:wght@400;500;600&family=Outfit:wght@300;400;500;600;700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

    <?php echo $__env->yieldPushContent('styles'); ?>

    <!-- Midtrans Snap Payment Gateway -->
    <?php if(config('midtrans.is_production')): ?>
        <script src="https://app.midtrans.com/snap/snap.js" data-client-key="<?php echo e(config('midtrans.client_key')); ?>"></script>
    <?php else: ?>
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo e(config('midtrans.client_key')); ?>"></script>
    <?php endif; ?>

    <title>From Broole</title>
</head>

<body class="bg-[#F8F5F2] font-sans antialiased text-[#3D3833] overflow-x-clip w-full relative">

    <!-- Global Modal Peringatan Login -->
    <div class="login-modal-overlay" id="globalLoginModal" onclick="if(event.target===this) closeGlobalLoginModal()">
        <div class="login-modal">
            <div class="login-modal__icon">🔒</div>
            <h3 class="login-modal__title">Login Required</h3>
            <p class="login-modal__text">Please log in to your account first to access this feature.</p>
            <div class="login-modal__actions">
                <a href="/login" class="login-modal__btn-login">Log In Now</a>
                <button type="button" onclick="closeGlobalLoginModal()" class="login-modal__btn-shop w-full">Cancel</button>
            </div>
        </div>
    </div>


<div class="bg-animation-container" id="fireworks-bg"></div>

<div
    x-data="{ activeTab: 'home', mobileOpen: false }"
    class="min-h-screen relative z-10"
>

    
    <header class="sticky top-0 z-50">

        
        <div class="relative overflow-hidden bg-[#8C1717] py-2.5 text-center">
            <div
                class="pointer-events-none absolute inset-0"
                style="background:repeating-linear-gradient(90deg,transparent,transparent 60px,rgba(255,255,255,0.04) 60px,rgba(255,255,255,0.04) 61px)"
            ></div>
            <p class="relative z-10 font-['Montserrat'] text-[9px] font-semibold uppercase tracking-[0.4em] text-white/90">
                ✦ &nbsp; Hi Broolers! &nbsp;·&nbsp; Earn Points with Every Purchase &nbsp;·&nbsp; Redeem Exclusive Rewards &nbsp;✦
            </p>
        </div>

        
        <div class="border-b border-[#8C1717]/10 bg-[#FDFAF7]">
            <div class="flex h-20 items-center justify-between px-4 lg:px-6">

                
                <a href="/" class="flex flex-shrink-0 items-center gap-3.5 no-underline">
                    <div class="flex h-[46px] w-[46px] flex-shrink-0 items-center justify-center rounded-full bg-[#8C1717]">
                        <img
                            src="<?php echo e(asset('home_assets/logo.png')); ?>"
                            alt="From Broole logo"
                            class="h-12 w-auto object-contain"
                        />
                    </div>
                    <div>
                        <span class="block font-['Cormorant_Garamond'] text-[21px] font-bold leading-none tracking-[0.06em] text-[#8C1717]">
                            From Broole
                        </span>
                        <span class="mt-0.5 block font-['Montserrat'] text-[8px] font-medium uppercase tracking-[0.35em] text-[#A89080]">
                            Artisan Desserts
                        </span>
                    </div>
                </a>

                
                <nav class="hidden flex-1 items-center justify-center gap-1 lg:flex">

                    <a
                        href="<?php echo e(route('customer.home')); ?>"
                        class="group relative rounded-md px-4 py-2 font-['Montserrat'] text-[10px] font-semibold uppercase tracking-[0.25em] transition-colors
                        <?php echo e(Route::is('customer.home') ? 'text-[#8C1717] is-active' : 'text-[#7A6E68] hover:text-[#8C1717]'); ?>"
                    >
                        Home
                        <span class="nav-link-underline"></span>
                    </a>

                    <div class="h-3.5 w-px bg-[#8C1717]/15"></div>

                    <a
                        href="<?php echo e(route('customer.shop')); ?>"
                        class="group relative rounded-md px-4 py-2 font-['Montserrat'] text-[10px] font-semibold uppercase tracking-[0.25em] transition-colors
                        <?php echo e(Route::is('customer.shop') ? 'text-[#8C1717] is-active' : 'text-[#7A6E68] hover:text-[#8C1717]'); ?>"
                    >
                        Shop
                        <span class="nav-link-underline"></span>
                    </a>

                    <div class="h-3.5 w-px bg-[#8C1717]/15"></div>

                    <a
                        href="<?php echo e(route('customer.history')); ?>"
                        class="group relative rounded-md px-4 py-2 font-['Montserrat'] text-[10px] font-semibold uppercase tracking-[0.25em] transition-colors requires-auth
                        <?php echo e(Route::is('customer.history') ? 'text-[#8C1717] is-active' : 'text-[#7A6E68] hover:text-[#8C1717]'); ?>"
                    >
                        Transaction History
                        <span class="nav-link-underline"></span>
                    </a>

                    <div class="h-3.5 w-px bg-[#8C1717]/15"></div>

                    <a
                       href="<?php echo e(route('customer.contact')); ?>"
                        class="group relative rounded-md px-4 py-2 font-['Montserrat'] text-[10px] font-semibold uppercase tracking-[0.25em] transition-colors
                        <?php echo e(Route::is('customer.contact') ? 'text-[#8C1717] is-active' : 'text-[#7A6E68] hover:text-[#8C1717]'); ?>"
                    >
                        Contact
                        <span class="nav-link-underline"></span>
                    </a>

                    <div class="h-3.5 w-px bg-[#8C1717]/15"></div>

                    <a
                        href="<?php echo e(route('customer.about')); ?>"
                        class="group relative rounded-md px-4 py-2 font-['Montserrat'] text-[10px] font-semibold uppercase tracking-[0.25em] transition-colors
                        <?php echo e(Route::is('customer.about') ? 'text-[#8C1717] is-active' : 'text-[#7A6E68] hover:text-[#8C1717]'); ?>"
                    >
                        About
                        <span class="nav-link-underline"></span>
                    </a>

                </nav>

                
                <div class="flex flex-shrink-0 items-center gap-2.5">

                    
                    <div
                        class="relative"
                        x-data="{
                            openWidget:false,
                            widgetTasks:[],
                            fetchTasks(){
                                if (!window.isLoggedIn) return;
                                fetch('<?php echo e(route('customer.tasks.widget')); ?>')
                                    .then(res => res.json())
                                    .then(data => this.widgetTasks = data)
                            }
                        }"
                        @mouseenter="openWidget=true;fetchTasks()"
                        @mouseleave="openWidget=false"
                    >

                        <a
                        href="<?php echo e(route('customer.tasks.index')); ?>"
                        class="
                        requires-auth
                        relative
                        flex h-11 w-11
                        items-center justify-center
                        rounded-xl
                        border border-[#8C1717]/10
                        bg-white
                        text-[#7A6E68]
                        shadow-sm
                        transition-all duration-300
                        hover:-translate-y-1
                        hover:shadow-lg
                        hover:border-[#8C1717]/30
                        hover:text-[#8C1717]
                        "
                    >

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"
                            />
                        </svg>

                        <?php if(auth()->guard()->check()): ?>
                            <span
                                class="
                                absolute
                                -top-1
                                -right-1
                                flex
                                h-5
                                w-5
                                items-center
                                justify-center
                                rounded-full
                                bg-[#8C1717]
                                text-white
                                text-[10px]
                                font-bold
                                ring-2
                                ring-white
                                "
                            >
                                !
                            </span>
                        <?php endif; ?>

                        </a>

                        <div
                            x-show="openWidget"
                            x-cloak
                            x-transition
                            class="absolute right-0 top-12 w-72 bg-white rounded-2xl shadow-xl border p-4 z-50"
                        >

                            <h4 class="text-xs font-bold uppercase tracking-wider text-[#8C1717] mb-3">
                                Available Tier Tasks
                            </h4>

                            <div class="space-y-2 max-h-60 overflow-y-auto">

                                <div x-show="widgetTasks.length === 0" class="text-center text-xs text-gray-500 py-4">
                                    There is no task available
                                </div>

                                <template x-for="item in widgetTasks" :key="item.id">

                                    <div
                                        class="p-2 border rounded-xl flex justify-between items-center text-xs"
                                        :class="item.unlocked ? 'bg-white' : 'bg-gray-50 opacity-60'"
                                    >

                                        <div>
                                            <p class="font-semibold" x-text="item.title"></p>

                                            <span
                                                class="px-2 py-1 rounded text-[9px] uppercase font-bold"
                                                x-text="item.required_tier"
                                            ></span>
                                        </div>

                                        <div>
                                            <span x-show="item.claimed" class="text-green-600 font-bold">
                                                ✓ Claimed
                                            </span>

                                            <span x-show="!item.claimed && item.unlocked" class="text-[#8C1717] font-bold">
                                                Available
                                            </span>

                                            <span x-show="!item.unlocked" class="text-gray-400">
                                                🔒 Locked
                                            </span>
                                        </div>

                                    </div>

                                </template>

                            </div>

                            <a
                                href="<?php echo e(route('customer.tasks.index')); ?>"
                                class="block mt-3 text-center text-[10px] uppercase tracking-wider font-bold text-[#8C1717] requires-auth"
                            >
                                View All Tasks
                            </a>

                        </div>

                    </div>

                    
                    <button
                        onclick="dmToggle()"
                        class="group hidden sm:flex h-10 w-10 items-center justify-center rounded-[10px] border border-[#3D3833]/10 bg-white text-[#7A6E68] transition-all duration-200 hover:-translate-y-px hover:border-[#8C1717]/30 hover:shadow-[0_4px_12px_rgba(140,23,23,0.1)]"
                        aria-label="Toggle dark/light mode"
                        title="Toggle Dark Mode"
                    >
                        <!-- Moon (light mode) -->
                        <svg class="dm-icon-moon w-5 h-5 transition-colors" viewBox="0 0 24 24" fill="none">
                            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"
                                  fill="currentColor" stroke="currentColor" stroke-width="1.5"
                                  stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>

                        <!-- Sun (dark mode) -->
                        <svg class="dm-icon-sun w-5 h-5 transition-colors" viewBox="0 0 24 24" fill="none">
                            <circle cx="12" cy="12" r="5" fill="currentColor" stroke="currentColor" stroke-width="1.5"/>
                            <line x1="12" y1="1"  x2="12" y2="4"  stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <line x1="12" y1="20" x2="12" y2="23" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <line x1="1"  y1="12" x2="4"  y2="12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <line x1="20" y1="12" x2="23" y2="12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <line x1="4.22"  y1="4.22"  x2="6.34"  y2="6.34"  stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <line x1="17.66" y1="17.66" x2="19.78" y2="19.78" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <line x1="4.22"  y1="19.78" x2="6.34"  y2="17.66" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <line x1="17.66" y1="6.34"  x2="19.78" y2="4.22"  stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </button>

                    
                    <a href="/cart" id="nav-cart-btn" aria-label="View cart">
                        
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 110 1.5.75.75 0 010-1.5zm12.75 0a.75.75 0 110 1.5.75.75 0 010-1.5z"/>
                        </svg>
                        
                        <span id="nav-cart-badge">0</span>
                    </a>

                    
                    <div x-data="{ open:false }" @mouseenter="open=true" @mouseleave="open=false" class="relative hide-on-mobile">

                        <a
                            href="<?php echo e(auth()->check() ? route('profile.edit') : '/login'); ?>"
                            class="flex h-10 w-10 items-center justify-center rounded-[10px] border border-[#3D3833]/10 bg-white text-[#7A6E68] transition-all duration-200 hover:-translate-y-px hover:border-[#8C1717]/30 hover:text-[#8C1717] hover:shadow-[0_4px_12px_rgba(140,23,23,0.1)]"
                        >
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2M12 11a4 4 0 100-8 4 4 0 000 8z"/>
                            </svg>
                        </a>

                        <div
                            x-show="open"
                            x-cloak
                            x-transition
                            class="absolute right-0 mt-3 w-72 sm:w-80 overflow-hidden rounded-2xl border border-[#E5E0DA] bg-white shadow-xl z-50"
                        >

                            <?php if(auth()->guard()->check()): ?>

                                <div class="p-5 flex items-center gap-4">

                                    <div
                                        class="
                                        w-14 h-14
                                        rounded-full
                                        bg-gradient-to-br
                                        from-[#8C1717]
                                        to-[#B12828]
                                        text-white
                                        flex items-center justify-center
                                        flex-shrink-0
                                        text-lg font-bold
                                        shadow-md
                                        overflow-hidden
                                        "
                                    >
                                       <img
                                            src="<?php echo e(auth()->user()->avatar ? asset('Avatar/' . auth()->user()->avatar) : 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&background=8C1717&color=fff'); ?>"
                                            class="w-full h-full object-cover"
                                        >
                                    </div>

                                    <?php
                                    $cust = \App\Models\Customer::where(
                                        'email',
                                        auth()->user()->email
                                    )->first();
                                    ?>

                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2">
                                            <h3 class="font-bold text-lg text-[#2C2623] leading-tight truncate">
                                                <?php echo e(auth()->user()->name); ?>

                                            </h3>
                                            <span class="px-2 py-0.5 rounded-full bg-yellow-100 text-yellow-700 text-[10px] uppercase font-bold flex-shrink-0">
                                                <?php echo e($cust?->tier ?? 'Bronze'); ?>

                                            </span>
                                        </div>

                                        <div class="flex items-center gap-1 mt-1">
                                            <span class="text-[#8C1717] text-sm">✨</span>
                                            <span class="font-bold text-[#8C1717] text-sm">
                                                <?php echo e(number_format($cust?->member_points ?? 0)); ?>

                                            </span>
                                            <span class="text-[10px] text-gray-400 font-semibold uppercase tracking-wider flex-shrink-0">pts</span>
                                        </div>

                                        <p class="text-xs text-gray-500 mt-1 truncate">
                                            <?php echo e(auth()->user()->email); ?>

                                        </p>
                                    </div>

                                </div>

                                <div class="border-t"></div>

                                <div class="p-2">

                                    <a
                                        href="<?php echo e(route('profile.edit')); ?>"
                                        class="block px-4 py-3 rounded-xl hover:bg-gray-100"
                                    >
                                        Edit Profile
                                    </a>

                                    <form method="POST" action="<?php echo e(route('logout')); ?>" onsubmit="clearCustomerLocalStorage()">
                                        <?php echo csrf_field(); ?>

                                        <button
                                            type="submit"
                                            class="w-full text-left px-4 py-3 rounded-xl hover:bg-red-50 text-red-600"
                                        >
                                            Logout
                                        </button>
                                    </form>

                                </div>

                            <?php else: ?>

                                <div class="p-5">
                                    <h3 class="font-bold text-lg">
                                        Welcome Guest
                                    </h3>

                                    <p class="text-sm text-gray-500 mt-1">
                                        Sign in to access your dessert rewards
                                    </p>

                                    <div class="mt-5 space-y-3">

                                        <a
                                            href="/login"
                                            class="block w-full text-center bg-[#8C1717] text-white py-3 rounded-xl font-semibold"
                                        >
                                            Login
                                        </a>

                                        <a
                                            href="/register"
                                            class="block w-full text-center bg-[#F3F1EC] py-3 rounded-xl font-semibold"
                                        >
                                            Register
                                        </a>

                                    </div>
                                </div>

                            <?php endif; ?>

                        </div>

                    </div>

                    
                    <button
                        @click="mobileOpen = !mobileOpen"
                        class="flex h-10 w-10 items-center justify-center rounded-[10px] border border-[#3D3833]/10 bg-white text-[#7A6E68] transition-all duration-200 hover:border-[#8C1717]/30 hover:text-[#8C1717] lg:hidden"
                        aria-label="Toggle menu"
                    >
                        <svg x-show="!mobileOpen" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M3 12h18M3 6h18M3 18h18"/>
                        </svg>
                        <svg x-show="mobileOpen" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M18 6L6 18M6 6l12 12"/>
                        </svg>
                    </button>

                </div>
            </div>

            
            
            <div
                x-show="mobileOpen"
                x-transition:enter="transition duration-200 ease-out"
                x-transition:enter-start="-translate-y-2 opacity-0"
                x-transition:enter-end="translate-y-0 opacity-100"
                x-transition:leave="transition duration-150 ease-in"
                x-transition:leave-start="translate-y-0 opacity-100"
                x-transition:leave-end="-translate-y-2 opacity-0"
                class="border-t border-[#8C1717]/10 bg-[#FDFAF7] px-6 py-5 lg:hidden"
            >

                <div
                    x-show="mobileOpen"
                    x-transition
                    class="absolute left-0 top-full w-full bg-[#FDFAF7] shadow-xl z-[999] lg:hidden"
                >

                    <div class="flex flex-col p-6 gap-5">

                        <a href="<?php echo e(route('customer.home')); ?>" class="font-semibold text-[#7A6E68]">
                            Home
                        </a>

                        <a href="<?php echo e(route('customer.about')); ?>" class="font-semibold text-[#7A6E68]">
                            About
                        </a>

                        <a href="<?php echo e(route('customer.shop')); ?>" class="font-semibold text-[#7A6E68]">
                            Shop
                        </a>

                        <a href="<?php echo e(route('customer.tasks.index')); ?>" class="font-semibold text-[#7A6E68] requires-auth">
                            Coupons
                        </a>

                        <a href="<?php echo e(route('customer.history')); ?>" class="font-semibold text-[#7A6E68] requires-auth">
                            Transaction History
                        </a>

                        <a href="<?php echo e(route('customer.contact')); ?>" class="font-semibold text-[#7A6E68]">
                            Contact
                        </a>

                        <button onclick="dmToggle()" class="font-semibold text-[#7A6E68] text-left flex items-center gap-2 group">
                            <!-- Moon -->
                            <svg class="dm-icon-moon w-5 h-5 transition-colors" viewBox="0 0 24 24" fill="none">
                                <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" fill="currentColor" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <!-- Sun -->
                            <svg class="dm-icon-sun w-5 h-5 transition-colors" viewBox="0 0 24 24" fill="none">
                                <circle cx="12" cy="12" r="5" fill="currentColor" stroke="currentColor" stroke-width="1.5"/>
                                <line x1="12" y1="1"  x2="12" y2="4"  stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                <line x1="12" y1="20" x2="12" y2="23" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                <line x1="1"  y1="12" x2="4"  y2="12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                <line x1="20" y1="12" x2="23" y2="12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                <line x1="4.22"  y1="4.22"  x2="6.34"  y2="6.34"  stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                <line x1="17.66" y1="17.66" x2="19.78" y2="19.78" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                <line x1="4.22"  y1="19.78" x2="6.34"  y2="17.66" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                <line x1="17.66" y1="6.34"  x2="19.78" y2="4.22"  stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                            <span class="group-hover:text-[#8C1717] transition-colors">Toggle Dark Mode</span>
                        </button>

                        
                        <a href="/cart" class="font-semibold text-[#8C1717] flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 110 1.5.75.75 0 010-1.5zm12.75 0a.75.75 0 110 1.5.75.75 0 010-1.5z"/>
                            </svg>
                            Cart
                        </a>

                        <div class="h-px w-full bg-[#8C1717]/10 my-1 show-on-mobile-only"></div>
                        
                        <?php if(auth()->guard()->check()): ?>
                            <a href="<?php echo e(route('profile.edit')); ?>" class="font-semibold text-[#7A6E68] show-on-mobile-only">
                                Profile (<?php echo e(auth()->user()->name); ?>)
                            </a>
                            <form method="POST" action="<?php echo e(route('logout')); ?>" onsubmit="clearCustomerLocalStorage()" class="show-on-mobile-only">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="font-semibold text-red-600 text-left w-full">
                                    Logout
                                </button>
                            </form>
                        <?php else: ?>
                            <a href="/login" class="font-semibold text-[#8C1717] show-on-mobile-only">
                                Login / Register
                            </a>
                        <?php endif; ?>

                    </div>

                </div>
                
            </div>
        </div>

    </header>

    
    <main>

        <?php echo $__env->yieldContent('content'); ?>

    </main>

</div>


<script>
(function () {
    function initNavCartBadge() {
        var cart  = JSON.parse(localStorage.getItem('customer_cart') || '[]');
        var total = cart.reduce(function(s, i){ return s + i.qty; }, 0);
        var badge = document.getElementById('nav-cart-badge');
        if (!badge) return;
        badge.textContent = total;
        badge.style.display = total > 0 ? 'flex' : 'none';
    }
    // Run immediately so the badge shows before any JS-heavy page loads
    initNavCartBadge();
    // Also expose it globally so shop.blade.php can call it after addToCart
    window.syncNavCartBadge = initNavCartBadge;
})();
</script>

<?php echo $__env->make('customer.partials.ai-chat', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<script>
function clearCustomerLocalStorage() {
    var keysToRemove = [
        'customer_cart',
        'checkout_payload',
        'available_points',
        'user_member_points',
        'last_customer_id'
    ];
    keysToRemove.forEach(function(key){ localStorage.removeItem(key); });
    console.log('Customer localStorage cleared on logout');
    return true;
}
</script>

    <script>
    // Toggle
    function dmToggle() {
        var html = document.documentElement;
        var next = html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
        
        html.classList.add('theme-animating');
        
        html.setAttribute('data-theme', next);
        localStorage.setItem('frombroole_theme', next);
        
        setTimeout(function() {
            html.classList.remove('theme-animating');
        }, 450);
    }
    </script>

    <!-- CUSTOM CURSOR ELEMENTS -->
    <div id="custom-cursor-dot"></div>
    <div id="custom-cursor-glow"></div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        // --- BACKGROUND FALLING ORBS ---
        const fwContainer = document.getElementById('fireworks-bg');
        if (fwContainer) {
            function createFallingOrb() {
                const orb = document.createElement('div');
                orb.className = 'falling-orb';
                
                const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
                const colors = isDark 
                    ? ['rgba(224, 51, 51, 0.3)', 'rgba(245, 200, 66, 0.25)', 'rgba(255, 255, 255, 0.15)']
                    : ['rgba(140, 23, 23, 0.65)', 'rgba(212, 175, 55, 0.6)', 'rgba(168, 144, 128, 0.5)'];
                
                orb.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                orb.style.color = orb.style.backgroundColor; // so box-shadow currentColor works
                
                const size = Math.random() * 80 + 40; // 40px to 120px (slightly smaller since they are sharp now)
                const x = Math.random() * window.innerWidth;
                const duration = Math.random() * 15 + 12; // 12s to 27s
                
                orb.style.width = size + 'px';
                orb.style.height = size + 'px';
                orb.style.left = x + 'px';
                orb.style.animationDuration = duration + 's';
                
                fwContainer.appendChild(orb);
                
                setTimeout(() => orb.remove(), duration * 1000);
            }

            // Spawn orbs periodically
            setInterval(() => {
                if(!document.hidden) createFallingOrb();
            }, 1200);
            
            // Spawn a few initial orbs immediately
            for(let i=0; i<4; i++) {
                setTimeout(createFallingOrb, i * 400);
            }
        }

        // --- CUSTOM CURSOR & PARTICLES ---
        if (window.matchMedia("(pointer: fine)").matches) {
            const dot = document.getElementById('custom-cursor-dot');
            const glow = document.getElementById('custom-cursor-glow');

            let mouseX = 0, mouseY = 0;
            let lastParticleTime = 0;

            document.addEventListener('mousemove', (e) => {
                mouseX = e.clientX;
                mouseY = e.clientY;
                
                // Instantly move the dot and glow
                dot.style.transform = `translate(calc(${mouseX}px - 50%), calc(${mouseY}px - 50%))`;
                glow.style.transform = `translate(calc(${mouseX}px - 50%), calc(${mouseY}px - 50%))`;

                // Create trailing dot effect
                const now = Date.now();
                if (now - lastParticleTime > 10) {
                    createParticle(mouseX, mouseY, 'cursor-particle');
                    lastParticleTime = now;
                }
            });
            
            // On Click: spawn Heart particles!
            document.addEventListener('mousedown', (e) => {
                const heartsCount = Math.floor(Math.random() * 8) + 12; // 12 to 19 hearts
                for(let i=0; i<heartsCount; i++) {
                    createParticle(e.clientX, e.clientY, 'heart-pop');
                }
            });

            function createParticle(x, y, className) {
                const particle = document.createElement('div');
                particle.className = className;
                particle.style.left = x + 'px';
                particle.style.top = y + 'px';
                
                // Random drift
                const angle = Math.random() * Math.PI * 2;
                const distance = className === 'heart-pop' 
                    ? Math.random() * 60 + 20  // click hearts explode further
                    : Math.random() * 25 + 10; // trailing hearts drift slightly
                    
                const tx = Math.cos(angle) * distance;
                const ty = Math.sin(angle) * distance + (className === 'heart-pop' ? 30 : 10);
                
                particle.style.setProperty('--tx', tx + 'px');
                particle.style.setProperty('--ty', ty + 'px');
                
                document.body.appendChild(particle);
                
                // Animate and remove
                setTimeout(() => {
                    particle.remove();
                }, 1000);
            }

            // Add hover effect for interactive elements
            const interactives = document.querySelectorAll('a, button, input, textarea, select, details, summary, .cursor-pointer');
            interactives.forEach(el => {
                el.addEventListener('mouseenter', () => document.body.classList.add('cursor-hover'));
                el.addEventListener('mouseleave', () => document.body.classList.remove('cursor-hover'));
            });
        }
    });
    
    // Global Auth Interceptor dipindah ke <head>
    
    function closeGlobalLoginModal() {
        document.getElementById('globalLoginModal').classList.remove('show');
    }
    </script>
    <?php echo $__env->make('components.pet', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
</html><?php /**PATH D:\Herd\webdev-frombroole\resources\views/layouts/app.blade.php ENDPATH**/ ?>