{{-- resources/views/customer/shop.blade.php --}}
@extends('layouts.app')

@section('content')
@push('styles')
<style>
:root {
    --cream:       #F8F5F2;
    --cream-dark:  #EDE8E2;
    --crimson:     #8C1717;
    --crimson-dark:#6A1111;
    --crimson-deep:#4A0D0D;
    --charcoal:    #2C2623;
    --muted:       #655F5A;
    --muted-light: #9C948E;
    --white:       #FFFFFF;
    --border:      rgba(140, 23, 23, 0.10);
    --border-hover:rgba(140, 23, 23, 0.22);
    --shadow-card: 0 2px 12px rgba(44, 38, 35, 0.06);
    --shadow-hover: 0 24px 56px rgba(140, 23, 23, 0.13), 0 8px 20px rgba(44, 38, 35, 0.06);
    --shadow-btn:  0 6px 20px rgba(140, 23, 23, 0.35);
    --radius-card: 28px;
    --radius-img:  20px;
    --radius-pill: 999px;
    --font-display: 'Cormorant Garamond', Georgia, serif;
    --font-body:    'DM Sans', sans-serif;
    --transition:   all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
}

/* ─── DARK MODE ─── */
[data-theme="dark"] .shop-page {
    --cream:       #1A1614;
    --cream-dark:  #141210;
    --crimson:     #D4403A;
    --crimson-dark:#B02E28;
    --crimson-deep:#8A1F1A;
    --charcoal:    #E8E0D8;
    --muted:       #9C948E;
    --muted-light: #706860;
    --white:       #1E1A17;
    --border:      rgba(212, 64, 58, 0.12);
    --border-hover:rgba(212, 64, 58, 0.25);
    --shadow-card: 0 2px 12px rgba(0, 0, 0, 0.2);
    --shadow-hover: 0 24px 56px rgba(212, 64, 58, 0.1), 0 8px 20px rgba(0, 0, 0, 0.15);
    --shadow-btn:  0 6px 20px rgba(212, 64, 58, 0.3);
}
[data-theme="dark"] .shop-page .card-image-wrap {
    background: #252120;
}
[data-theme="dark"] .shop-page .card-image-wrap::before {
    background-image: radial-gradient(circle, rgba(212,64,58,0.06) 1px, transparent 1px);
}
[data-theme="dark"] .shop-page .sugar-select {
    background: #252120;
    border-color: rgba(212, 64, 58, 0.12);
    color: #9C948E;
}
[data-theme="dark"] .shop-page .sugar-select:focus,
[data-theme="dark"] .shop-page .sugar-select:hover {
    color: #E8E0D8;
}
[data-theme="dark"] .shop-page .badge-soldout {
    background: rgba(30,26,23,0.92);
    border-color: rgba(220,38,38,0.4);
    color: #EF4444;
}
[data-theme="dark"] .shop-page .toast-inner {
    background: #E8E0D8;
    color: #1A1614;
}
[data-theme="dark"] .shop-page .btn-add.unavailable {
    background: #252120;
    color: #706860;
}
[data-theme="dark"] .shop-page .filter-btn.is-inactive {
    background: #1E1A17;
    color: #9C948E;
    border-color: rgba(212, 64, 58, 0.12);
}
[data-theme="dark"] .shop-page .filter-btn.is-inactive:hover {
    background: rgba(212,64,58,0.08);
    color: #D4403A;
}

/* Dark mode overrides for elements with hardcoded colors */
[data-theme="dark"] .shop-page .shop-hero::before {
    border-color: rgba(212, 64, 58, 0.08);
}
[data-theme="dark"] .shop-page .shop-hero::after {
    border-color: rgba(212, 64, 58, 0.1);
}
[data-theme="dark"] .shop-page .card-image-wrap::after {
    background: radial-gradient(ellipse at center, transparent 40%, rgba(212,64,58,0.06) 100%);
}
[data-theme="dark"] .shop-page .hero-divider {
    background: rgba(212, 64, 58, 0.15);
}
[data-theme="dark"] .shop-page .scroll-line {
    background: linear-gradient(to bottom, #D4403A, transparent);
}
[data-theme="dark"] .shop-page .section-divider .divider-line {
    background: rgba(212, 64, 58, 0.12);
}
[data-theme="dark"] .shop-page input[type="text"],
[data-theme="dark"] .shop-page input[type="search"] {
    background: #252120 !important;
    border-color: rgba(212, 64, 58, 0.12) !important;
    color: #E8E0D8 !important;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1) !important;
}
[data-theme="dark"] .shop-page input::placeholder {
    color: #706860 !important;
}


*, *::before, *::after { box-sizing: border-box; }
.shop-page {
    background: transparent;
    min-height: 100vh;
    font-family: var(--font-body);
    overflow-x: hidden;
}

.shop-hero {
    position: relative;
    padding: 3.5rem 2rem 2.5rem;
    text-align: center;
    overflow: hidden;
}

.shop-hero::before {
    content: '';
    position: absolute;
    top: -120px; left: 50%;
    transform: translateX(-50%);
    width: 700px; height: 700px;
    border-radius: 50%;
    border: 1px solid rgba(140, 23, 23, 0.07);
    pointer-events: none;
}
.shop-hero::after {
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
    font-size: clamp(3rem, 8vw, 5.5rem);
    font-weight: 800;
    color: var(--charcoal);
    line-height: 1.05;
    letter-spacing: -0.01em;
    margin-bottom: 1.5rem;
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
    max-width: 480px;
    margin: 0 auto 2.5rem;
    opacity: 0;
    animation: fadeUp 0.7s 0.3s ease forwards;
}

/* Stats row */
.hero-stats {
    display: flex;
    justify-content: center;
    gap: 2.5rem;
    margin-top: 2.5rem;
    opacity: 0;
    animation: fadeUp 0.7s 0.4s ease forwards;
}
.hero-stat {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 3px;
}
.hero-stat-num {
    font-family: var(--font-display);
    font-size: 2rem;
    font-weight: 700;
    color: var(--charcoal);
    line-height: 1;
}
.hero-stat-label {
    font-size: 10px;
    font-weight: 500;
    color: var(--muted-light);
    letter-spacing: 0.15em;
    text-transform: uppercase;
}
.hero-divider {
    width: 1px; height: 40px;
    background: var(--border);
    margin-top: 4px;
}

/* Scroll hint */
.scroll-hint {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 6px;
    margin-top: 3rem;
    opacity: 0;
    animation: fadeUp 0.7s 0.55s ease forwards;
}
.scroll-hint span {
    font-size: 9px;
    letter-spacing: 0.25em;
    text-transform: uppercase;
    color: var(--muted-light);
    font-weight: 500;
}
.scroll-line {
    width: 1px; height: 40px;
    background: linear-gradient(to bottom, var(--crimson), transparent);
    animation: scrollPulse 1.8s ease-in-out infinite;
}

.shop-body {
    max-width: 1360px;
    margin: 0 auto;
    padding: 0 2rem 5rem;
}
.filter-section {
    margin-bottom: 3rem;
    opacity: 0;
    animation: fadeUp 0.6s 0.5s ease forwards;
}

.filter-label {
    text-align: center;
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 0.3em;
    text-transform: uppercase;
    color: var(--muted-light);
    margin-bottom: 1rem;
}

.filter-bar {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px;
}

.filter-btn {
    position: relative;
    padding: 10px 24px;
    border-radius: var(--radius-pill);
    font-family: var(--font-body);
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    text-decoration: none;
    cursor: pointer;
    transition: var(--transition);
    overflow: hidden;
    border: 1px solid var(--border);
}
.filter-btn.is-active {
    background: var(--crimson);
    color: var(--white);
    border-color: var(--crimson);
    box-shadow: var(--shadow-btn);
}
.filter-btn.is-inactive {
    background: var(--white);
    color: var(--muted);
}
.filter-btn.is-inactive:hover {
    background: rgba(140,23,23,0.05);
    color: var(--crimson);
    border-color: var(--border-hover);
}

.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 24px;
}

.product-card {
    background: var(--white);
    border-radius: var(--radius-card);
    border: 1px solid var(--border);
    padding: 20px;
    display: flex;
    flex-direction: column;
    position: relative;
    transition: all 0.3s ease;
    box-shadow: inset 0 0 0 0 var(--crimson), var(--shadow-card);
    opacity: 0;
    animation: cardIn 0.5s ease forwards;
}
.product-card:hover {
    transform: translateY(-6px);
    box-shadow: inset 4px 0 0 0 var(--crimson), var(--shadow-hover);
    border-color: var(--border-hover);
}
.product-card.is-soldout {
    opacity: 0.7;
    filter: grayscale(15%);
}
.product-card.is-soldout:hover {
    transform: none;
    box-shadow: var(--shadow-card);
}

.product-card:nth-child(1)  { animation-delay: 0.10s; }
.product-card:nth-child(2)  { animation-delay: 0.16s; }
.product-card:nth-child(3)  { animation-delay: 0.22s; }
.product-card:nth-child(4)  { animation-delay: 0.28s; }
.product-card:nth-child(5)  { animation-delay: 0.34s; }
.product-card:nth-child(6)  { animation-delay: 0.40s; }
.product-card:nth-child(7)  { animation-delay: 0.46s; }
.product-card:nth-child(8)  { animation-delay: 0.52s; }

.product-card:nth-child(8)  { animation-delay: 0.52s; }

.card-image-wrap {
    position: relative;
    height: 220px;
    background: var(--cream);
    border-radius: var(--radius-img);
    overflow: hidden;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.card-image-wrap::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image: radial-gradient(circle, rgba(140,23,23,0.04) 1px, transparent 1px);
    background-size: 18px 18px;
    pointer-events: none;
    z-index: 0;
}

.card-image-wrap::after {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse at center, transparent 40%, rgba(140,23,23,0.07) 100%);
    opacity: 0;
    transition: opacity 0.4s ease;
    pointer-events: none;
    z-index: 1;
}
.product-card:hover .card-image-wrap::after { opacity: 1; }

.card-image-wrap img {
    width: 155px;
    height: 155px;
    object-fit: cover;
    position: relative;
    z-index: 2;
    transition: transform 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
    filter: drop-shadow(0 12px 20px rgba(44,38,35,0.12));
}
.product-card:hover .card-image-wrap img {
    transform: scale(1.09) translateY(-4px);
}

.card-no-image {
    color: var(--muted-light);
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.1em;
    position: relative;
    z-index: 2;
}

.badge-soldout {
    position: absolute;
    top: 14px; right: 14px;
    z-index: 10;
    background: rgba(255,255,255,0.92);
    border: 1px solid rgba(220,38,38,0.3);
    color: #B91C1C;
    font-size: 9px;
    font-weight: 700;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    padding: 5px 12px;
    border-radius: var(--radius-pill);
    backdrop-filter: blur(4px);
}

.badge-new {
    position: absolute;
    top: 14px; left: 14px;
    z-index: 10;
    background: var(--crimson);
    color: var(--white);
    font-size: 9px;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    padding: 5px 12px;
    border-radius: var(--radius-pill);
}

.card-body { flex: 1; display: flex; flex-direction: column; }

.card-category {
    font-size: 9px;
    font-weight: 700;
    letter-spacing: 0.25em;
    text-transform: uppercase;
    color: var(--crimson);
    margin-bottom: 6px;
    display: flex;
    align-items: center;
    gap: 6px;
}
.card-category::after {
    content: '';
    flex: 1;
    height: 1px;
    background: var(--border);
}

.card-name {
    font-family: var(--font-display);
    font-size: 1.55rem;
    font-weight: 700;
    color: var(--charcoal);
    line-height: 1.15;
    margin-bottom: 8px;
    letter-spacing: -0.01em;
}

.card-desc {
    font-size: 12.5px;
    font-weight: 300;
    color: var(--muted);
    line-height: 1.75;
    margin-bottom: 14px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    flex-shrink: 0;
}

.sugar-wrap {
    position: relative;
    margin-bottom: 14px;
}
.sugar-wrap::after {
    content: '▾';
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--crimson);
    font-size: 12px;
    pointer-events: none;
}
.sugar-select {
    width: 100%;
    appearance: none;
    -webkit-appearance: none;
    background: var(--cream);
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 9px 32px 9px 14px;
    font-family: var(--font-body);
    font-size: 11px;
    font-weight: 500;
    color: var(--muted);
    cursor: pointer;
    outline: none;
    transition: border-color 0.2s ease;
}
.sugar-select:focus,
.sugar-select:hover {
    border-color: var(--border-hover);
    color: var(--charcoal);
}

.card-footer {
    margin-top: auto;
    padding-top: 16px;
    border-top: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
}

.card-price {
    font-family: var(--font-display);
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--charcoal);
    line-height: 1;
    letter-spacing: -0.02em;
}
.card-price-label {
    display: block;
    font-family: var(--font-body);
    font-size: 9px;
    font-weight: 500;
    letter-spacing: 0.1em;
    color: var(--muted-light);
    text-transform: uppercase;
    margin-bottom: 2px;
}

.btn-add {
    width: 46px;
    height: 46px;
    border-radius: 50%;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: var(--transition);
    flex-shrink: 0;
    position: relative;
    overflow: hidden;
}
.btn-add.available {
    background: var(--crimson);
    color: var(--white);
    box-shadow: 0 4px 14px rgba(140,23,23,0.30);
}
.btn-add.available::after {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(255,255,255,0.15);
    opacity: 0;
    transition: opacity 0.2s;
}
.btn-add.available:hover {
    background: var(--crimson-dark);
    box-shadow: 0 8px 24px rgba(140,23,23,0.40);
    transform: scale(1.08) rotate(90deg);
}
.btn-add.available:active {
    transform: scale(0.95);
}
.btn-add.unavailable {
    background: var(--cream-dark);
    color: var(--muted-light);
    cursor: not-allowed;
}
.btn-add svg { pointer-events: none; }

.empty-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 5rem 2rem;
}
.empty-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
    opacity: 0.3;
}
.empty-title {
    font-family: var(--font-display);
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--charcoal);
    margin-bottom: 0.5rem;
    opacity: 0.5;
}
.empty-sub {
    font-size: 13px;
    color: var(--muted-light);
}

/* ── TOAST ── */
.toast-wrap {
    position: fixed;
    bottom: 32px;
    left: 50%;
    transform: translateX(-50%) translateY(24px);
    z-index: 99999;
    pointer-events: none;
    opacity: 0;
    transition: all 0.35s cubic-bezier(0.34, 1.4, 0.64, 1);
}
.toast-wrap.show {
    opacity: 1;
    transform: translateX(-50%) translateY(0);
}
.toast-inner {
    background: var(--charcoal);
    color: var(--white);
    border-radius: var(--radius-pill);
    padding: 12px 22px;
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 13px;
    font-weight: 500;
    white-space: nowrap;
    box-shadow: 0 8px 32px rgba(44,38,35,0.25);
}
.toast-dot {
    width: 7px; height: 7px;
    border-radius: 50%;
    background: #4ade80;
    flex-shrink: 0;
}

.section-divider {
    display: flex;
    align-items: center;
    gap: 16px;
    margin: 0 0 3rem;
    padding: 0 2rem;
    max-width: 1360px;
    margin-left: auto;
    margin-right: auto;
}
.divider-line { flex: 1; height: 1px; background: var(--border); }
.divider-label {
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 0.3em;
    text-transform: uppercase;
    color: var(--muted-light);
    white-space: nowrap;
}

@keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}

@keyframes cardIn {
    from { opacity: 0; transform: translateY(28px) scale(0.97); }
    to   { opacity: 1; transform: translateY(0) scale(1); }
}

@keyframes scrollPulse {
    0%, 100% { transform: scaleY(1); opacity: 1; }
    50%       { transform: scaleY(0.5); opacity: 0.3; }
}

@keyframes bump {
    0%   { transform: scale(1); }
    50%  { transform: scale(1.3); }
    100% { transform: scale(1); }
}
@media (max-width: 640px) {
    .shop-hero { padding: 2.5rem 1.5rem 1.5rem; }
    .hero-stats { gap: 1.5rem; }
    .hero-stat-num { font-size: 1.6rem; }
    .shop-body { padding: 0 1.25rem 4rem; }
    .product-grid { grid-template-columns: 1fr 1fr; gap: 14px; }
    .product-card { padding: 14px; }
    .card-image-wrap { height: 165px; }
    .card-name { font-size: 1.25rem; }
    .filter-btn { padding: 8px 16px; font-size: 10px; }
    .scroll-hint { display: none; }
}
@media (max-width: 420px) {
    .product-grid { grid-template-columns: 1fr; }
}
/* Sort dropdown */
.sort-section {
    display: flex;
    justify-content: center;
    margin-bottom: 2rem;
    opacity: 0;
    animation: fadeUp 0.6s 0.55s ease forwards;
}
.sort-wrap {
    position: relative;
    display: flex;
    align-items: center;
    flex-shrink: 0;
}
.sort-wrap .sort-icon {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 13px;
    pointer-events: none;
    z-index: 2;
}

.sort-select {
    appearance: none;
    -webkit-appearance: none;
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-pill);
    padding: 10px 32px 10px 34px;
    font-family: var(--font-body);
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.08em;
    color: var(--muted);
    cursor: pointer;
    outline: none;
    transition: var(--transition);
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath d='M0 0l5 6 5-6z' fill='%23655F5A'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 12px center;
    background-size: 10px 6px;
    white-space: nowrap;
}
.sort-select:hover, .sort-select:focus {
    border-color: var(--border-hover);
    color: var(--charcoal);
}
[data-theme="dark"] .shop-page .sort-select {
    background-color: #252120 !important;
    border-color: rgba(212, 64, 58, 0.12) !important;
    color: #E8E0D8 !important;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath d='M0 0l5 6 5-6z' fill='%23E8E0D8'/%3E%3C/svg%3E") !important;
    background-repeat: no-repeat !important;
    background-position: right 12px center !important;
    background-size: 10px 6px !important;
}
[data-theme="dark"] .shop-page .sort-select:hover,
[data-theme="dark"] .shop-page .sort-select:focus {
    color: #E8E0D8;
}

/* Pagination */
.pagination-wrap {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 6px;
    margin-top: 3rem;
    padding: 2rem 0;
}
.pagination-wrap a,
.pagination-wrap span {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 42px;
    height: 42px;
    padding: 0 14px;
    border-radius: var(--radius-pill);
    font-family: var(--font-body);
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 0.05em;
    text-decoration: none;
    transition: var(--transition);
    border: 1px solid var(--border);
}
.pagination-wrap a {
    background: var(--white);
    color: var(--muted);
}
.pagination-wrap a:hover {
    background: var(--crimson);
    color: #fff;
    border-color: var(--crimson);
    box-shadow: var(--shadow-btn);
    transform: translateY(-2px);
}
.pagination-wrap span.current-page {
    background: var(--crimson);
    color: #fff;
    border-color: var(--crimson);
    box-shadow: var(--shadow-btn);
}
.pagination-wrap span.dots {
    border: none;
    color: var(--muted-light);
    min-width: auto;
    padding: 0 4px;
}
.pagination-info {
    text-align: center;
    margin-top: 1rem;
    font-size: 12px;
    color: var(--muted-light);
    letter-spacing: 0.05em;
}
[data-theme="dark"] .shop-page .pagination-wrap a {
    background: #1E1A17;
    color: #9C948E;
    border-color: rgba(212, 64, 58, 0.12);
}
[data-theme="dark"] .shop-page .pagination-wrap a:hover {
    background: #D4403A;
    color: #fff;
    border-color: #D4403A;
}
[data-theme="dark"] .shop-page .pagination-wrap span.current-page {
    background: #D4403A;
    border-color: #D4403A;
}
</style>
@endpush

{{-- TOAST --}}
<div class="toast-wrap" id="toast">
    <div class="toast-inner">
        <div class="toast-dot"></div>
        <span id="toast-msg">Added to cart</span>
    </div>
</div>

<div class="shop-page">
    
    {{-- HERO --}}
    <section class="shop-hero">
        <div class="hero-inner">
            <span class="hero-eyebrow">Taste The Perfection</span>
            <h1 class="hero-title">Our <em>Artisan</em><br>Collection</h1>
            <p class="hero-desc">Discover our meticulously crafted desserts and beverages, made from the finest ingredients to redefine your sweetness experience.</p>

            <div class="hero-stats">
                <div class="hero-stat">
                    <span class="hero-stat-num">{{ $products->total() }}</span>
                    <span class="hero-stat-label">Items</span>
                </div>
                <div class="hero-divider"></div>
                <div class="hero-stat">
                    <span class="hero-stat-num">{{ $categories->count() }}</span>
                    <span class="hero-stat-label">Categories</span>
                </div>
                <div class="hero-divider"></div>
                <div class="hero-stat">
                    <span class="hero-stat-num">Daily</span>
                    <span class="hero-stat-label">Fresh Made</span>
                </div>
            </div>
        </div>
    </section>

    {{-- SHOP BODY --}}
    <div class="shop-body" id="shop-dynamic-content">

        {{-- CATEGORY FILTER --}}
        <div class="filter-section">
            <div class="filter-bar">
                <a href="{{ route('customer.shop') }}"
                   class="filter-btn {{ !request('category') ? 'is-active' : 'is-inactive' }}">
                    All Items
                </a>
                @foreach($categories as $category)
                <a href="{{ route('customer.shop', ['category' => $category->id]) }}"
                   class="filter-btn {{ request('category') == $category->id ? 'is-active' : 'is-inactive' }}">
                    {{ $category->category_name }}
                </a>
                @endforeach
            </div>
        </div>

        {{-- SEARCH BAR + SORT --}}
        <div class="search-section" style="max-width: 640px; margin: 0 auto 32px auto; padding: 0 16px;">
            <form onsubmit="event.preventDefault();" style="display: flex; gap: 10px; align-items: center;">
                <div style="position: relative; flex: 1;">
                    <input
                        type="text"
                        id="searchInput"
                        placeholder="Search our artisan treats..."
                        style="width: 100%; padding: 12px 40px 12px 16px; border: 1px solid #e5e7eb; border-radius: 30px; outline: none; font-size: 0.95rem; box-shadow: 0 2px 4px rgba(0,0,0,0.02); transition: all 0.2s;"
                        onfocus="this.style.borderColor='#111'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.05)'"
                        onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='0 2px 4px rgba(0,0,0,0.02)'"
                    >
                    <a href="#"
                    id="clearSearchBtn"
                    style="position: absolute; right: 14px; top: 50%; transform: translateY(-50%); color: #9ca3af; text-decoration: none; font-size: 0.9rem; font-weight: bold; display: none;">
                        ✕
                    </a>
                </div>

                {{-- SORT --}}
                <div class="sort-wrap">
                    <span class="sort-icon">⇅</span>
                    <select class="sort-select" id="sortSelect" onchange="window.location.href=this.value">
                        <option value="{{ route('customer.shop', array_merge(request()->except('sort', 'page'), ['sort' => 'latest'])) }}" {{ ($sort ?? 'latest') === 'latest' ? 'selected' : '' }}>Latest</option>
                        <option value="{{ route('customer.shop', array_merge(request()->except('sort', 'page'), ['sort' => 'price_low'])) }}" {{ ($sort ?? '') === 'price_low' ? 'selected' : '' }}>Low Price</option>
                        <option value="{{ route('customer.shop', array_merge(request()->except('sort', 'page'), ['sort' => 'price_high'])) }}" {{ ($sort ?? '') === 'price_high' ? 'selected' : '' }}>High Price</option>
                        <option value="{{ route('customer.shop', array_merge(request()->except('sort', 'page'), ['sort' => 'name_asc'])) }}" {{ ($sort ?? '') === 'name_asc' ? 'selected' : '' }}>A — Z</option>
                        <option value="{{ route('customer.shop', array_merge(request()->except('sort', 'page'), ['sort' => 'name_desc'])) }}" {{ ($sort ?? '') === 'name_desc' ? 'selected' : '' }}>Z — A</option>
                    </select>
                </div>
            </form>
        </div>

        {{-- RESULTS LABEL --}}
        <div class="section-divider">
            <div class="divider-line"></div>
            <span class="divider-label">
                {{ $products->total() }} {{ $products->total() == 1 ? 'item' : 'items' }} available · Page {{ $products->currentPage() }} of {{ $products->lastPage() }}
            </span>
            <div class="divider-line"></div>
        </div>

        {{-- PRODUCT GRID --}}
        <div class="product-grid">
            @forelse($products as $product)
                @php
                    $isDrink = (stripos($product->category->category_name ?? '', 'drink') !== false
                             || stripos($product->category->category_name ?? '', 'minuman') !== false);
                    $isSoldOut = $product->calculated_stock <= 0;
                @endphp

                <div class="product-card {{ $isSoldOut ? 'is-soldout' : '' }}" style="display: flex; flex-direction: column; height: 100%;">

                    {{-- Image Area --}}
                    <div class="card-image-wrap">
                        @if($isSoldOut)
                            <div class="badge-soldout">Sold Out</div>
                        @endif

                        @if($product->pro_image)
                            <img
                                src="{{ asset('products/' . rawurlencode($product->pro_image)) }}"
                                alt="{{ $product->pro_name }}"
                                loading="lazy"
                            >
                        @else
                            <span class="card-no-image">No Image</span>
                        @endif
                    </div>

                    {{-- Card Body --}}
                    <div class="card-body" style="display: flex; flex-direction: column; flex-grow: 1;">

                        <span class="card-category">
                            {{ $product->category->category_name ?? 'Uncategorized' }}
                        </span>

                        <h3 class="card-name">{{ $product->pro_name }}</h3>

                        <p class="card-desc" style="flex-grow: 1;">
                            {{ $product->pro_description ?? 'No description available for this item.' }}
                        </p>

                        <div class="sugar-container-layout" style="margin-top: auto; min-height: 45px; display: flex; align-items: center;">
                            @if($isDrink && !$isSoldOut)
                                <div class="sugar-wrap" style="width: 100%;">
                                    <select
                                        id="sugar-{{ $product->id }}"
                                        class="sugar-select"
                                        aria-label="Sugar level for {{ $product->pro_name }}"
                                    >
                                        <option value="100">Normal Sugar (100%)</option>
                                        <option value="50">Less Sugar (50%)</option>
                                        <option value="0">No Sugar (0%)</option>
                                    </select>
                                </div>
                            @endif
                        </div>

                        {{-- Footer: Price + Add Button --}}
                        <div class="card-footer">
                            <div>
                                <span class="card-price-label">Price</span>
                                <span class="card-price">
                                    Rp {{ number_format($product->pro_price, 0, ',', '.') }}
                                </span>
                            </div>

                            <button
                                type="button"
                                class="btn-add {{ !$isSoldOut ? 'available' : 'unavailable' }}"
                                {{ $isSoldOut ? 'disabled' : '' }}
                                onclick="addToCart({{ $product->id }}, '{{ addslashes($product->pro_name) }}', {{ $product->pro_price }}, {{ $product->calculated_stock }}, {{ $isDrink ? 'true' : 'false' }}, '{{ $product->pro_image }}')"
                                aria-label="Add {{ $product->pro_name }} to cart"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

            @empty
                <div class="empty-state">
                    <div class="empty-icon">🍰</div>
                    <div class="empty-title">Nothing here yet</div>
                    <p class="empty-sub">No products found in this category.</p>
                </div>
            @endforelse
        </div>

        {{-- PAGINATION --}}
        @if($products->hasPages())
        <nav class="pagination-wrap">
            {{-- Previous --}}
            @if($products->onFirstPage())
                <span class="dots" style="opacity:0.4">← Prev</span>
            @else
                <a href="{{ $products->previousPageUrl() }}">← Prev</a>
            @endif

            {{-- Page Numbers --}}
            @php
                $current = $products->currentPage();
                $last = $products->lastPage();
                $start = max(1, $current - 2);
                $end = min($last, $current + 2);
            @endphp

            @if($start > 1)
                <a href="{{ $products->url(1) }}">1</a>
                @if($start > 2)
                    <span class="dots">…</span>
                @endif
            @endif

            @for($i = $start; $i <= $end; $i++)
                @if($i == $current)
                    <span class="current-page">{{ $i }}</span>
                @else
                    <a href="{{ $products->url($i) }}">{{ $i }}</a>
                @endif
            @endfor

            @if($end < $last)
                @if($end < $last - 1)
                    <span class="dots">…</span>
                @endif
                <a href="{{ $products->url($last) }}">{{ $last }}</a>
            @endif

            {{-- Next --}}
            @if($products->hasMorePages())
                <a href="{{ $products->nextPageUrl() }}">Next →</a>
            @else
                <span class="dots" style="opacity:0.4">Next →</span>
            @endif
        </nav>
        <div class="pagination-info">
            Showing {{ $products->firstItem() }}–{{ $products->lastItem() }} of {{ $products->total() }} products
        </div>
        @endif
    </div>
</div>

<script>
(function () {
    'use strict';
    let customerCart = JSON.parse(localStorage.getItem('customer_cart') || '[]');
    const toastEl   = document.getElementById('toast');
    const toastMsg  = document.getElementById('toast-msg');
    let toastTimer  = null;

    // Sync navbar cart badge on page load
    syncNavCartBadge();

    // ── Real-time Search ──
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const clearBtn    = document.getElementById('clearSearchBtn');
        const dividerLabel = document.querySelector('.divider-label');

        function applyCustomerProductFilters() {
            let filter = searchInput.value.toLowerCase().trim();
            let cards  = document.querySelectorAll('.product-card');
            let visibleCount = 0;

            if (clearBtn) {
                clearBtn.style.display = filter.length > 0 ? 'block' : 'none';
            }

            cards.forEach(card => {
                let productName  = card.querySelector('.card-name')?.textContent.toLowerCase() || "";
                let categoryName = card.querySelector('.card-category')?.textContent.toLowerCase() || "";
                let description  = card.querySelector('.card-desc')?.textContent.toLowerCase() || "";

                if (productName.includes(filter) || categoryName.includes(filter) || description.includes(filter)) {
                    card.style.display = "";
                    visibleCount++;
                } else {
                    card.style.display = "none";
                }
            });

            if (dividerLabel) {
                dividerLabel.textContent = visibleCount + (visibleCount === 1 ? ' item' : ' items') + ' available';
            }
        }

        if (searchInput) {
            searchInput.addEventListener('input', applyCustomerProductFilters);
        }

        if (clearBtn) {
            clearBtn.addEventListener('click', function(e) {
                e.preventDefault();
                searchInput.value = '';
                applyCustomerProductFilters();
                searchInput.focus();
            });
        }

        // AJAX Category Filtering
        document.body.addEventListener('click', function(e) {
            const btn = e.target.closest('.filter-btn');
            if (btn) {
                e.preventDefault();
                const url = btn.getAttribute('href');
                
                // Visual feedback
                const grid = document.querySelector('.product-grid');
                if (grid) grid.style.opacity = '0.5';

                fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                    .then(res => res.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, "text/html");
                        
                        const newContent = doc.getElementById('shop-dynamic-content');
                        const oldContent = document.getElementById('shop-dynamic-content');
                        
                        if (newContent && oldContent) {
                            oldContent.innerHTML = newContent.innerHTML;
                        }
                        
                        // Update Hero stats (number of items)
                        const newHeroStats = doc.querySelector('.hero-stats');
                        const oldHeroStats = document.querySelector('.hero-stats');
                        if (newHeroStats && oldHeroStats) {
                            oldHeroStats.innerHTML = newHeroStats.innerHTML;
                        }
                        
                        // Update URL
                        window.history.pushState({}, '', url);

                        // Rebind search events
                        const newSearchInput = document.getElementById('searchInput');
                        if (newSearchInput) {
                            newSearchInput.addEventListener('input', applyCustomerProductFilters);
                        }
                        const newClearBtn = document.getElementById('clearSearchBtn');
                        if (newClearBtn) {
                            newClearBtn.addEventListener('click', function(ev) {
                                ev.preventDefault();
                                newSearchInput.value = '';
                                applyCustomerProductFilters();
                                newSearchInput.focus();
                            });
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        window.location.href = url;
                    });
            }
        });
    });

    // ── Cart Logic ──
    window.addToCart = function (id, name, price, maxStock, isDrink, proImage) {
        if (maxStock <= 0) {
            showToast('⚠ ' + name + ' is out of stock.', false);
            return;
        }

        let sugarLevel = '100';
        if (isDrink) {
            const sel = document.getElementById('sugar-' + id);
            if (sel) sugarLevel = sel.value;
        }

        const cartId   = id + '-' + sugarLevel;
        const existing = customerCart.find(i => i.cartId === cartId);

        if (existing) {
            if (existing.qty >= maxStock) {
                showToast('Only ' + maxStock + ' units available for ' + name + '.', false);
                return;
            }
            existing.qty++;
        } else {
            customerCart.push({
                cartId, id, name, price, maxStock,
                sugarLevel, isDrink, proImage, qty: 1,
            });
        }

        localStorage.setItem('customer_cart', JSON.stringify(customerCart));
        syncNavCartBadge();

        const label = isDrink ? name + ' (sugar ' + sugarLevel + '%)' : name;
        showToast(label + ' added to cart ✓');
    };

    // Push the total qty count to the navbar cart badge
    function syncNavCartBadge() {
        const totalQty = customerCart.reduce((s, i) => s + i.qty, 0);
        const badge = document.getElementById('nav-cart-badge');
        if (!badge) return;

        badge.textContent = totalQty;
        badge.style.display = totalQty > 0 ? 'flex' : 'none';

        // Bump animation
        badge.style.animation = 'none';
        badge.offsetHeight; // reflow
        badge.style.animation = 'navBadgeBump 0.35s cubic-bezier(0.34,1.56,0.64,1)';
    }

    function showToast(msg, success = true) {
        const dot = toastEl.querySelector('.toast-dot');
        if (dot) dot.style.background = success ? '#4ade80' : '#f87171';
        toastMsg.textContent = msg;
        toastEl.classList.add('show');
        clearTimeout(toastTimer);
        toastTimer = setTimeout(() => toastEl.classList.remove('show'), 2800);
    }

}());
</script>

<script>
    // ── 3D Tilt Effect for Product Cards ──
    document.addEventListener('DOMContentLoaded', function() {
        document.body.addEventListener('mousemove', function(e) {
            const card = e.target.closest('.product-card');
            if (card) {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                
                // Fixed math so the card tilts TOWARDS the mouse
                const rotateX = ((y - centerY) / centerY) * 15; 
                const rotateY = ((x - centerX) / centerX) * -15;
                
                card.style.transform = `perspective(1000px) translateY(-6px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.02, 1.02, 1.02)`;
                card.style.transformStyle = 'preserve-3d';
                card.style.transition = 'transform 0.1s ease-out, box-shadow 0.2s ease, border-color 0.2s ease';
                card.style.zIndex = '10';

                // Reverse the tilt for the image so it stays visually flat but pops out in 3D!
                const imgWrap = card.querySelector('.card-image-wrap');
                if (imgWrap) {
                    imgWrap.style.transform = `translateZ(50px) rotateX(${-rotateX}deg) rotateY(${-rotateY}deg)`;
                    imgWrap.style.transition = 'transform 0.1s ease-out';
                }
            }
        });

        document.body.addEventListener('mouseout', function(e) {
            const card = e.target.closest('.product-card');
            if (card && !card.contains(e.relatedTarget)) {
                // Reset card transform
                card.style.transform = '';
                card.style.transition = 'transform 0.2s ease-out, box-shadow 0.2s ease, border-color 0.2s ease';
                card.style.zIndex = '';
                
                const imgWrap = card.querySelector('.card-image-wrap');
                if (imgWrap) {
                    imgWrap.style.transform = '';
                    imgWrap.style.transition = 'transform 0.2s ease-out';
                }
            }
        });
    });
</script>
@include('layouts.footer')
@endsection