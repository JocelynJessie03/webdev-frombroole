<?php $__env->startSection('content'); ?>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;0,800;1,400;1,600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
:root {
    --cream:        #F8F5F2;
    --cream-dark:   #EDE8E2;
    --crimson:      #8C1717;
    --crimson-dark: #6A1111;
    --charcoal:     #2C2623;
    --muted:        #655F5A;
    --muted-light:  #9C948E;
    --white:        #FFFFFF;
    --green:        #166534;
    --green-bg:     #dcfce7;
    --red-bg:       #fee2e2;
    --red-text:     #991b1b;
    --border:       rgba(140,23,23,0.10);
    --border-hover: rgba(140,23,23,0.22);
    --shadow-card:  0 2px 12px rgba(44,38,35,0.06);
    --shadow-hover: 0 20px 48px rgba(140,23,23,0.11), 0 6px 16px rgba(44,38,35,0.05);
    --shadow-btn:   0 6px 20px rgba(140,23,23,0.32);
    --radius-card:  28px;
    --radius-pill:  999px;
    --font-display: 'Cormorant Garamond', Georgia, serif;
    --font-body:    'DM Sans', sans-serif;
    --ease-spring:  cubic-bezier(0.34, 1.56, 0.64, 1);
    --ease-smooth:  cubic-bezier(0.25, 0.8, 0.25, 1);
    --transition:   all 0.38s var(--ease-smooth);
}

*, *::before, *::after { box-sizing: border-box; }

.cart-page {
    background: transparent;
    min-height: 100vh;
    font-family: var(--font-body);
    padding-bottom: 6rem;
}

.cart-header {
    padding: 5.5rem 2rem 3rem;
    text-align: center;
    position: relative;
    overflow: hidden;
}
.cart-header::before {
    content: '';
    position: absolute;
    top: -100px; left: 50%;
    transform: translateX(-50%);
    width: 600px; height: 600px;
    border-radius: 50%;
    border: 1px solid rgba(140,23,23,0.07);
    pointer-events: none;
}

.header-inner { position: relative; z-index: 1; }

.header-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    color: var(--crimson);
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 0.35em;
    text-transform: uppercase;
    margin-bottom: 1.2rem;
    opacity: 0;
    animation: fadeUp 0.6s 0.05s ease forwards;
}
.header-eyebrow::before,
.header-eyebrow::after {
    content: '';
    display: block;
    width: 28px; height: 1px;
    background: var(--crimson);
    opacity: 0.4;
}

.header-title {
    font-family: var(--font-display);
    font-size: clamp(2.6rem, 7vw, 4.5rem);
    font-weight: 800;
    color: var(--charcoal);
    line-height: 1.05;
    margin-bottom: 0.8rem;
    opacity: 0;
    animation: fadeUp 0.6s 0.12s ease forwards;
}
.header-title em {
    font-style: italic;
    color: var(--crimson);
}

.back-link {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    color: var(--muted);
    font-size: 12px;
    font-weight: 500;
    text-decoration: none;
    letter-spacing: 0.05em;
    transition: color 0.2s;
    margin-top: 1.2rem;
    opacity: 0;
    animation: fadeUp 0.6s 0.2s ease forwards;
}
.back-link:hover { color: var(--crimson); }
.back-link svg { transition: transform 0.25s var(--ease-spring); }
.back-link:hover svg { transform: translateX(-4px); }

.cart-layout {
    max-width: 1240px;
    margin: 0 auto;
    padding: 0 2rem;
    display: grid;
    grid-template-columns: 1fr 380px;
    gap: 28px;
    align-items: start;
}
@media (max-width: 960px) {
    .cart-layout { grid-template-columns: 1fr; }
    .order-summary { order: -1; }
}

.section-label {
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 1.4rem;
    opacity: 0;
    animation: fadeUp 0.6s 0.25s ease forwards;
}
.section-label-text {
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 0.28em;
    text-transform: uppercase;
    color: var(--muted-light);
    white-space: nowrap;
}
.section-label-line {
    flex: 1; height: 1px;
    background: var(--border);
}

.cart-items-col {
    opacity: 0;
    animation: fadeUp 0.6s 0.3s ease forwards;
}
.cart-item {
    background: var(--white);
    border-radius: var(--radius-card);
    border: 1px solid var(--border);
    padding: 18px 20px;
    display: flex;
    align-items: center;
    gap: 18px;
    margin-bottom: 14px;
    box-shadow: var(--shadow-card);
    transition: var(--transition);
    position: relative;
    overflow: hidden;
}
.cart-item:hover {
    box-shadow: var(--shadow-hover);
    border-color: var(--border-hover);
    transform: translateX(4px);
}
.cart-item::before {
    content: '';
    position: absolute;
    left: 0; top: 0;
    width: 3px; height: 100%;
    background: var(--crimson);
    border-radius: 3px 0 0 3px;
    opacity: 0;
    transition: opacity 0.3s;
}
.cart-item:hover::before { opacity: 1; }

.item-img-wrap {
    width: 86px; height: 86px;
    border-radius: 18px;
    background: var(--cream);
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    position: relative;
}
.item-img-wrap::after {
    content: '';
    position: absolute;
    inset: 0;
    background-image: radial-gradient(circle, rgba(140,23,23,0.04) 1px, transparent 1px);
    background-size: 14px 14px;
    pointer-events: none;
}
.item-img-wrap img {
    width: 68px; height: 68px;
    object-fit: cover;
    position: relative;
    z-index: 1;
    filter: drop-shadow(0 4px 8px rgba(44,38,35,0.10));
    transition: transform 0.35s var(--ease-spring);
}
.cart-item:hover .item-img-wrap img {
    transform: scale(1.07);
}
.item-img-placeholder {
    font-size: 2rem;
    position: relative; z-index: 1;
}

.item-info { flex: 1; min-width: 0; }

.item-category {
    font-size: 9px;
    font-weight: 700;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: var(--crimson);
    margin-bottom: 3px;
}
.item-name {
    font-family: var(--font-display);
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--charcoal);
    line-height: 1.2;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    margin-bottom: 4px;
}
.item-meta {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
}
.item-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    background: var(--cream);
    border: 1px solid var(--border);
    border-radius: var(--radius-pill);
    padding: 3px 10px;
    font-size: 10px;
    font-weight: 500;
    color: var(--muted);
}

.item-unit-price {
    font-size: 12px;
    font-weight: 400;
    color: var(--muted-light);
    margin-top: 5px;
}

/* Qty controls */
.item-controls {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 10px;
    flex-shrink: 0;
}
.item-subtotal {
    font-family: var(--font-display);
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--charcoal);
    text-align: right;
    line-height: 1;
}
.qty-row {
    display: flex;
    align-items: center;
    gap: 0;
    background: var(--cream);
    border-radius: var(--radius-pill);
    border: 1px solid var(--border);
    overflow: hidden;
}
.qty-btn {
    width: 32px; height: 32px;
    border: none;
    background: transparent;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--muted);
    transition: background 0.2s, color 0.2s;
    flex-shrink: 0;
}
.qty-btn:hover { background: var(--white); color: var(--crimson); }
.qty-btn:active { transform: scale(0.88); }
.qty-btn.minus:disabled { opacity: 0.3; cursor: not-allowed; }
.qty-num {
    min-width: 28px;
    text-align: center;
    font-size: 13px;
    font-weight: 600;
    color: var(--charcoal);
    padding: 0 2px;
    border-left: 1px solid var(--border);
    border-right: 1px solid var(--border);
}
.btn-remove {
    background: none;
    border: none;
    cursor: pointer;
    color: var(--muted-light);
    display: flex;
    align-items: center;
    padding: 3px;
    transition: color 0.2s, transform 0.2s;
    border-radius: 8px;
}
.btn-remove:hover { color: #dc2626; transform: scale(1.15); }

/* ── Empty Cart State ── */
.empty-cart {
    background: var(--white);
    border-radius: var(--radius-card);
    border: 1px dashed var(--border-hover);
    padding: 5rem 2rem;
    text-align: center;
}
.empty-cart-icon {
    font-size: 3.5rem;
    margin-bottom: 1.2rem;
    display: block;
    opacity: 0.3;
}
.empty-cart-title {
    font-family: var(--font-display);
    font-size: 2rem;
    font-weight: 700;
    color: var(--charcoal);
    opacity: 0.5;
    margin-bottom: 0.5rem;
}
.empty-cart-sub {
    font-size: 13px;
    color: var(--muted-light);
    margin-bottom: 1.8rem;
}
.btn-shop-now {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: var(--crimson);
    color: var(--white);
    text-decoration: none;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    padding: 12px 28px;
    border-radius: var(--radius-pill);
    box-shadow: var(--shadow-btn);
    transition: var(--transition);
}
.btn-shop-now:hover {
    background: var(--crimson-dark);
    transform: translateY(-2px);
    box-shadow: 0 10px 28px rgba(140,23,23,0.38);
}

.notes-section {
    margin-top: 18px;
    opacity: 0;
    animation: fadeUp 0.6s 0.4s ease forwards;
}
.notes-label {
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 0.22em;
    text-transform: uppercase;
    color: var(--muted-light);
    margin-bottom: 8px;
    display: block;
}
.notes-textarea {
    width: 100%;
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: 18px;
    padding: 14px 18px;
    font-family: var(--font-body);
    font-size: 13px;
    font-weight: 300;
    color: var(--charcoal);
    resize: none;
    outline: none;
    transition: border-color 0.2s;
    line-height: 1.7;
}
.notes-textarea::placeholder { color: var(--muted-light); }
.notes-textarea:focus { border-color: var(--border-hover); }

.order-summary {
    background: var(--white);
    border-radius: var(--radius-card);
    border: 1px solid var(--border);
    box-shadow: var(--shadow-card);
    overflow: hidden;
    position: sticky;
    top: 100px;
    opacity: 0;
    animation: fadeUp 0.6s 0.35s ease forwards;
}

.summary-header {
    padding: 24px 24px 0;
    border-bottom: 1px solid var(--border);
    padding-bottom: 20px;
}
.summary-title {
    font-family: var(--font-display);
    font-size: 1.7rem;
    font-weight: 700;
    color: var(--charcoal);
    margin-bottom: 2px;
}
.summary-subtitle {
    font-size: 11px;
    color: var(--muted-light);
    font-weight: 400;
}

.summary-body { padding: 20px 24px; }

.summary-lines { margin-bottom: 18px; }
.summary-line {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 7px 0;
    font-size: 13px;
    color: var(--muted);
    gap: 12px;
}
.summary-line-name {
    flex: 1;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    font-weight: 400;
}
.summary-line-qty {
    background: var(--cream);
    border-radius: var(--radius-pill);
    padding: 2px 8px;
    font-size: 11px;
    font-weight: 600;
    color: var(--muted-light);
    flex-shrink: 0;
}
.summary-line-price {
    font-weight: 500;
    color: var(--charcoal);
    flex-shrink: 0;
}

.summary-divider {
    height: 1px;
    background: var(--border);
    margin: 14px 0;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 5px 0;
    font-size: 13px;
}
.summary-row-label { color: var(--muted); font-weight: 400; }
.summary-row-value { color: var(--charcoal); font-weight: 500; }
.summary-row-value.free {
    color: var(--green);
    font-weight: 600;
}

.summary-total {
    display: flex;
    justify-content: space-between;
    align-items: baseline;
    padding: 16px 0 0;
    border-top: 1px solid var(--border);
    margin-top: 6px;
}
.summary-total-label {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: var(--muted);
}
.summary-total-value {
    font-family: var(--font-display);
    font-size: 2rem;
    font-weight: 800;
    color: var(--charcoal);
    line-height: 1;
}

.promo-row {
    margin: 18px 0 0;
    display: flex;
    gap: 8px;
}
.promo-input {
    flex: 1;
    background: var(--cream);
    border: 1px solid var(--border);
    border-radius: var(--radius-pill);
    padding: 10px 16px;
    font-family: var(--font-body);
    font-size: 12px;
    font-weight: 500;
    color: var(--charcoal);
    outline: none;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    transition: border-color 0.2s;
}
.promo-input::placeholder { text-transform: none; letter-spacing: 0; color: var(--muted-light); }
.promo-input:focus { border-color: var(--border-hover); }
.promo-apply-btn {
    background: var(--charcoal);
    color: var(--white);
    border: none;
    border-radius: var(--radius-pill);
    padding: 10px 18px;
    font-family: var(--font-body);
    font-size: 11px;
    font-weight: 600;
    cursor: pointer;
    letter-spacing: 0.08em;
    transition: background 0.2s;
    flex-shrink: 0;
}
.promo-apply-btn:hover { background: var(--crimson); }

.promo-feedback {
    font-size: 11px;
    font-weight: 500;
    margin-top: 7px;
    padding-left: 4px;
    min-height: 16px;
    transition: color 0.2s;
}
.promo-feedback.success { color: var(--green); }
.promo-feedback.error   { color: #dc2626; }

.btn-checkout {
    width: 100%;
    background: var(--crimson);
    color: var(--white);
    border: none;
    border-radius: var(--radius-pill);
    padding: 16px 28px;
    font-family: var(--font-body);
    font-size: 13px;
    font-weight: 600;
    letter-spacing: 0.08em;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    margin-top: 20px;
    box-shadow: var(--shadow-btn);
    transition: var(--transition);
    position: relative;
    overflow: hidden;
}
.btn-checkout::after {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(255,255,255,0);
    transition: background 0.2s;
}
.btn-checkout:hover {
    background: var(--crimson-dark);
    transform: translateY(-2px);
    box-shadow: 0 12px 32px rgba(140,23,23,0.38);
}
.btn-checkout:active { transform: translateY(0); }
.btn-checkout:disabled {
    background: var(--cream-dark);
    color: var(--muted-light);
    cursor: not-allowed;
    box-shadow: none;
    transform: none;
}

.btn-clear-cart {
    width: 100%;
    background: transparent;
    border: 1px solid var(--border);
    border-radius: var(--radius-pill);
    padding: 11px 20px;
    font-family: var(--font-body);
    font-size: 12px;
    font-weight: 500;
    color: var(--muted);
    cursor: pointer;
    transition: var(--transition);
    margin-top: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
}
.btn-clear-cart:hover {
    background: var(--red-bg);
    border-color: rgba(220,38,38,0.2);
    color: #dc2626;
}

.trust-badges {
    display: flex;
    justify-content: center;
    gap: 20px;
    padding: 18px 24px;
    border-top: 1px solid var(--border);
    flex-wrap: wrap;
}
.trust-badge {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 4px;
}
.trust-badge-icon {
    width: 32px; height: 32px;
    border-radius: 50%;
    background: var(--cream);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--crimson);
}
.trust-badge-label {
    font-size: 9px;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--muted-light);
    text-align: center;
    line-height: 1.3;
}

.toast-wrap {
    position: fixed;
    bottom: 32px; left: 50%;
    transform: translateX(-50%) translateY(24px);
    z-index: 99999;
    pointer-events: none;
    opacity: 0;
    transition: all 0.35s var(--ease-spring);
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
    box-shadow: 0 8px 32px rgba(44,38,35,0.22);
}
.toast-dot {
    width: 7px; height: 7px;
    border-radius: 50%;
    background: #4ade80;
    flex-shrink: 0;
}

@keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}
@keyframes itemRemove {
    to { opacity: 0; transform: translateX(24px) scale(0.96); max-height: 0; padding: 0; margin: 0; border-width: 0; }
}
@keyframes slideInLeft {
    from { opacity: 0; transform: translateX(-16px); }
    to   { opacity: 1; transform: translateX(0); }
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to   { transform: rotate(360deg); }
}

@keyframes fadeIn {
    from { opacity: 0; }
    to   { opacity: 1; }
}

@keyframes slideUp {
    from { opacity: 0; transform: translateY(24px) scale(0.96); }
    to   { opacity: 1; transform: translateY(0) scale(1); }
}

@media (max-width: 640px) {
    .cart-header { padding: 4rem 1.5rem 2rem; }
    .cart-layout { padding: 0 1.25rem; gap: 18px; }
    .cart-item { padding: 14px 16px; gap: 12px; }
    .item-img-wrap { width: 68px; height: 68px; border-radius: 14px; }
    .item-img-wrap img { width: 54px; height: 54px; }
    .item-subtotal { font-size: 1.1rem; }
}
</style>

<div class="toast-wrap" id="toast">
    <div class="toast-inner">
        <div class="toast-dot" id="toast-dot"></div>
        <span id="toast-msg">Done</span>
    </div>
</div>
<div class="cart-page">

    
    <section class="cart-header">
        <div class="header-inner">
            <span class="header-eyebrow">Your Selection</span>
            <h1 class="header-title">Your <em>Cart</em></h1>
            <a href="<?php echo e(route('customer.shop')); ?>" class="back-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
                </svg>
                Continue Shopping
            </a>
        </div>
    </section>

    
    <div class="cart-layout" id="cart-layout">

        
        <div>
            <div class="section-label">
                <div class="section-label-line"></div>
                <span class="section-label-text" id="item-count-label">0 items</span>
                <div class="section-label-line"></div>
            </div>

            <div class="cart-items-col" id="cart-items-container">
                
            </div>

            
            <div class="notes-section" id="notes-section" style="display:none">
                <label class="notes-label" for="order-notes">Special Instructions</label>
                <textarea
                    id="order-notes"
                    class="notes-textarea"
                    rows="3"
                    placeholder="Any requests? Allergen notes, gift wrapping, delivery preferences…"
                ></textarea>
            </div>
        </div>

        
        <div class="order-summary" id="order-summary">
            <div class="summary-header">
                <div class="summary-title">Order Summary</div>
                <div class="summary-subtitle" id="summary-item-count">0 items in cart</div>
            </div>

            <div class="summary-body">
                
                <div class="summary-lines" id="summary-lines"></div>

                <div class="summary-divider"></div>

                
                <div class="summary-row">
                    <span class="summary-row-label">Subtotal</span>
                    <span class="summary-row-value" id="subtotal-val">Rp 0</span>
                </div>
                <div class="summary-row" id="discount-row" style="display:none">
                    <span class="summary-row-label">Discount</span>
                    <span class="summary-row-value free" id="discount-val">— Rp 0</span>
                </div>
                <div class="summary-row">
                    <span class="summary-row-label">Tax 10%</span>
                    <span class="summary-row-value" id="tax-val">Rp 0</span>
                </div>

                
                <div class="summary-row" id="points-row" style="display:none">
                    <span class="summary-row-label" style="color: #7b0000; font-weight: 600;">Points Used</span>
                    <span class="summary-row-value free" id="points-val">— Rp 0</span>
                </div>

                
                <div class="summary-total">
                    <span class="summary-total-label">Total</span>
                    <span class="summary-total-value" id="total-val">Rp 0</span>
                </div>

                
                <div class="promo-row">
                    <input type="text" id="promo-input" class="promo-input" placeholder="Promo code" maxlength="20">
                    <button class="promo-apply-btn" onclick="applyPromo()">Apply</button>
                </div>
                <div class="promo-feedback" id="promo-feedback"></div>

                
                <div class="points-management-box" style="background: #f6f3f1; border-radius: 12px; padding: 14px; margin-bottom: 16px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                        <span style="font-size: 0.75rem; font-weight: bold; color: #8b8580; text-transform: uppercase; letter-spacing: 0.05em;">Available Points</span>
                        <?php
                            $userPoints = 0;
                            // Gunakan guard customer untuk pengecekan
                            if (auth('customer')->check()) {
                                $customerId = auth('customer')->id();

                                // Cari berdasarkan kolom 'id' utama, bukan 'customer_ID' 
                                // (kecuali kamu sudah set protected $primaryKey = 'customer_ID' di Model Customer)
                                $customer = DB::table('customers')->where('id', $customerId)->first();
                                
                                $userPoints = $customer ? (int)$customer->member_points : 0;
                            }
                        ?>
                        <span style="font-weight: 900; color: #7b0000;" id="available-points"><?php echo e($userPoints); ?> Pts</span>
                    </div>
                    <label style="display: block; font-size: 0.75rem; font-weight: bold; color: #8b8580; margin-bottom: 6px;">Use Points (1 Pts = Rp 1)</label>
                    <input type="number" id="input-points" min="0" max="<?php echo e($userPoints); ?>" value="0" oninput="calculateTotal()"
                        style="width: 100%; border: 1px solid #e5e7eb; border-radius: 8px; padding: 8px 12px; outline: none; text-align: right; font-weight: bold; font-size: 1.1rem; background: #fff; color: #2d2a29;"
                        onfocus="this.style.borderColor='#7b0000'" onblur="this.style.borderColor='#e5e7eb'">
                </div>

                
                <button class="btn-checkout" id="btn-checkout" onclick="proceedCheckout()" disabled>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/>
                    </svg>
                    Proceed to Checkout
                </button>

                
                <button class="btn-clear-cart" onclick="clearCart()" id="btn-clear">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                    </svg>
                    Clear Cart
                </button>
            </div>

            
            <div class="trust-badges">
                <div class="trust-badge">
                    <div class="trust-badge-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
                        </svg>
                    </div>
                    <span class="trust-badge-label">Secure<br>Order</span>
                </div>
                <div class="trust-badge">
                    <div class="trust-badge-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="trust-badge-label">Fresh<br>Daily</span>
                </div>
                <div class="trust-badge">
                    <div class="trust-badge-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/>
                        </svg>
                    </div>
                    <span class="trust-badge-label">Made with<br>Love</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
(function () {
    'use strict';

    let cart         = JSON.parse(localStorage.getItem('customer_cart') || '[]');
    let discount     = 0;
    let promoApplied = null;

    const PROMOS = {
        'SWEET10': 10,
        'ARTISAN15': 15,
        'WELCOME20': 20,
    };

    // Fetch member points real-time saat page dimuat
    fetchMemberPointsRealTime();
    renderCart();

    /**
     * Fetch member_points terbaru dari server (real-time)
     */
    function fetchMemberPointsRealTime() {
        const route = '<?php echo e(route("customer.cart.member-points")); ?>';
        console.log('[DEBUG] Fetching member points from:', route);
        
        fetch(route)
            .then(res => res.json())
            .then(data => {
                if (data.success && data.member_points !== undefined) {
                    const availablePointsEl = document.getElementById('available-points');
                    if (availablePointsEl) {
                        availablePointsEl.textContent = data.member_points + ' Pts';
                        
                        const inputPoints = document.getElementById('input-points');
                        if (inputPoints) {
                            inputPoints.max = data.member_points;
                            if (parseInt(inputPoints.value) > data.member_points) {
                                inputPoints.value = 0;
                            }
                        }
                        updateSummary();
                    }
                }
            })
            .catch(err => {
                console.error('[DEBUG] Error fetching member points:', err);
            });
    }

    function renderCart() {
        const container    = document.getElementById('cart-items-container');
        const notesSection = document.getElementById('notes-section');
        const btnCheckout  = document.getElementById('btn-checkout');
        const btnClear     = document.getElementById('btn-clear');

        if (!container) return;

        if (!cart.length) {
            container.innerHTML = `
                <div class="empty-cart">
                    <span class="empty-cart-icon">🛒</span>
                    <div class="empty-cart-title">Your cart is empty</div>
                    <p class="empty-cart-sub">Looks like you haven't added anything yet.</p>
                    <a href="<?php echo e(route('customer.shop')); ?>" class="btn-shop-now">
                        Browse Collection
                    </a>
                </div>`;
            if(notesSection) notesSection.style.display = 'none';
            if(btnCheckout) btnCheckout.disabled = true;
            if(btnClear) btnClear.style.display = 'none';
            
            const pointsInput = document.getElementById('input-points');
            if(pointsInput) pointsInput.value = 0;
            
            updateSummary();
            updateCountLabel();
            return;
        }

        container.innerHTML = cart.map((item, idx) => {
            const subtotal = item.price * item.qty;
            const sugarBadge = item.isDrink
                ? `<span class="item-badge">Sugar ${item.sugarLevel}%</span>`
                : '';
            return `
            <div class="cart-item" id="cart-item-${idx}">
                <div class="item-img-wrap">
                    ${item.proImage 
                        ? `<img src="/products/${encodeURIComponent(item.proImage)}" alt="${escHtml(item.name)}" style="width:68px;height:68px;object-fit:cover;border-radius:12px;">`
                        : '<span class="item-img-placeholder">🍰</span>'
                    }
                </div>
                <div class="item-info">
                    <div class="item-category">Artisan</div>
                    <div class="item-name">${escHtml(item.name)}</div>
                    <div class="item-meta">${sugarBadge}</div>
                    <div class="item-unit-price">Rp ${fmt(item.price)} / item</div>
                </div>
                <div class="item-controls">
                    <div class="item-subtotal">Rp ${fmt(subtotal)}</div>
                    <div class="qty-row">
                        <button class="qty-btn minus" onclick="changeQty(${idx}, -1)" ${item.qty <= 1 ? 'disabled' : ''}>—</button>
                        <span class="qty-num">${item.qty}</span>
                        <button class="qty-btn plus" onclick="changeQty(${idx}, 1)" ${item.qty >= item.maxStock ? 'disabled' : ''}>+</button>
                    </div>
                    <button class="btn-remove" onclick="removeItem(${idx})">Remove</button>
                </div>
            </div>`;
        }).join('');

        if(notesSection) notesSection.style.display = 'block';
        if(btnCheckout) btnCheckout.disabled = false;
        if(btnClear) btnClear.style.display = 'flex';
        updateSummary();
        updateCountLabel();
    }

    function updateSummary() {
        const subtotal = cart.reduce((s, i) => s + i.price * i.qty, 0);
        const discountAmt = Math.round(subtotal * discount / 100);
        const tax = Math.round((subtotal - discountAmt) * 0.1); 
        const totalBeforePoints = subtotal - discountAmt + tax;

        const availablePointsElement = document.getElementById('available-points');
        const availablePoints = availablePointsElement ? parseInt(availablePointsElement.textContent) || 0 : 0;
        const pointsInput = document.getElementById('input-points');
        let pointsToUse = pointsInput ? parseInt(pointsInput.value) || 0 : 0;

        if (pointsToUse < 0) pointsToUse = 0;
        if (pointsToUse > availablePoints) pointsToUse = availablePoints;
        if (pointsToUse > totalBeforePoints) pointsToUse = Math.floor(totalBeforePoints);

        if(pointsInput) pointsInput.value = pointsToUse;

        const grandTotal = totalBeforePoints - pointsToUse;
        const totalQty = cart.reduce((s, i) => s + i.qty, 0);

        const linesEl = document.getElementById('summary-lines');
        if (linesEl) {
            if (cart.length) {
                linesEl.innerHTML = cart.map(item =>
                    `<div class="summary-line">
                        <span class="summary-line-name">${escHtml(item.name)}</span>
                        <span class="summary-line-qty">×${item.qty}</span>
                        <span class="summary-line-price">Rp ${fmt(item.price * item.qty)}</span>
                    </div>`
                ).join('');
            } else {
                linesEl.innerHTML = '<div style="font-size:13px;text-align:center;padding:12px 0">No items yet</div>';
            }
        }

        if(document.getElementById('subtotal-val')) document.getElementById('subtotal-val').textContent = 'Rp ' + fmt(subtotal);
        if(document.getElementById('tax-val')) document.getElementById('tax-val').textContent = 'Rp ' + fmt(tax);
        if(document.getElementById('total-val')) document.getElementById('total-val').textContent = 'Rp ' + fmt(grandTotal);
        if(document.getElementById('summary-item-count')) document.getElementById('summary-item-count').textContent = totalQty + ' items';

        const discRow = document.getElementById('discount-row');
        if (discRow) discRow.style.display = discountAmt > 0 ? 'flex' : 'none';
        if (document.getElementById('discount-val')) document.getElementById('discount-val').textContent = '— Rp ' + fmt(discountAmt);

        const pointsRow = document.getElementById('points-row');
        if (pointsRow) pointsRow.style.display = pointsToUse > 0 ? 'flex' : 'none';
        if (document.getElementById('points-val')) document.getElementById('points-val').textContent = '— Rp ' + fmt(pointsToUse);
    }

    function updateCountLabel() {
        const total = cart.reduce((s, i) => s + i.qty, 0);
        const label = document.getElementById('item-count-label');
        if(label) label.textContent = total + ' items';
    }

    window.changeQty = function (idx, delta) {
        const item = cart[idx];
        if (!item) return;
        const newQty = item.qty + delta;
        if (newQty < 1) { removeItem(idx); return; }
        if (newQty > item.maxStock) {
            showToast('Max stock reached', false);
            return;
        }
        item.qty = newQty;
        save();
        renderCart();
    };

    window.removeItem = function (idx) {
        cart.splice(idx, 1);
        save();
        renderCart();
        showToast('Item removed', false);
    };

    window.clearCart = function () {
        if (!cart.length) return;
        if (!confirm('Remove all items from your cart?')) return;
        cart = [];
        promoApplied = null;
        discount = 0;
        if(document.getElementById('promo-input')) document.getElementById('promo-input').value = '';
        save();
        renderCart();
        showToast('Cart cleared');
    };

    window.applyPromo = function () {
        const code = document.getElementById('promo-input').value.trim().toUpperCase();
        const feedback = document.getElementById('promo-feedback');

        if (!code) return;

        if (PROMOS[code]) {
            discount     = PROMOS[code];
            promoApplied = code;
            if(feedback) feedback.textContent = '✓ ' + discount + '% discount applied!';
            updateSummary();
            showToast('Discount applied 🎉');
            return;
        }

        const csrf = '<?php echo e(csrf_token()); ?>';
        fetch('<?php echo e(route("customer.validate-coupon")); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrf,
            },
            body: JSON.stringify({ code: code }),
        })
        .then(res => res.json())
        .then(data => {
            if (data.valid && data.discount_value) {
                discount = data.discount_value;
                promoApplied = code;
                if(feedback) feedback.textContent = '✓ ' + discount + '% discount applied!';
                updateSummary();
                showToast('Discount applied 🎉');
            } else {
                discount = 0;
                promoApplied = null;
                if(feedback) feedback.textContent = '✗ Invalid coupon.';
                updateSummary();
            }
        });
    };

    // FIX: Fungsi ini sekarang langsung menembak widget Midtrans (Snap)
    window.proceedCheckout = async function () {
        if (!cart.length) return;
        const btn = document.getElementById('btn-checkout');
        const notes = document.getElementById('order-notes') ? document.getElementById('order-notes').value.trim() : '';
        const pointsUsed = document.getElementById('input-points') ? parseInt(document.getElementById('input-points').value) || 0 : 0;

        if(btn) btn.disabled = true;

        const payload = {
            items:       cart,
            notes:       notes,
            promo:       promoApplied,
            discount:    discount,
            points_used: pointsUsed 
        };

        try {
            const csrf = '<?php echo e(csrf_token()); ?>';
            const res  = await fetch('<?php echo e(route("customer.checkout")); ?>', {
                method:  'POST',
                headers: {
                    'Content-Type':  'application/json',
                    'Accept':        'application/json',
                    'X-CSRF-TOKEN':  csrf,
                },
                body: JSON.stringify(payload),
            });

            const data = await res.json();

            if (res.ok && data.success) {
                if (typeof snap === 'undefined') {
                    alert('Midtrans SDK belum termuat sempurna. Silakan refresh halaman.');
                    resetCheckoutBtn();
                    return;
                }

                // LANGSUNG MENAMPILKAN POPUP RESMI MIDTRANS SNAP
                snap.pay(data.snap_token, {
                    onSuccess: function (result) {
                        localStorage.removeItem('customer_cart');
                        const redirectTemplate = '<?php echo e(route("customer.payment.success", ":id")); ?>';
                        window.location.href = redirectTemplate.replace(':id', data.order_id);
                    },
                    onPending: function (result) {
                        alert('Pembayaran tertunda. Silakan cek menu tagihan Anda.');
                        resetCheckoutBtn();
                    },
                    onError: function (result) {
                        alert('Pembayaran gagal dilakukan.');
                        resetCheckoutBtn();
                    },
                    onClose: function () {
                        // Menangani jika user menutup popup Midtrans secara sengaja
                        resetCheckoutBtn();
                    }
                });

            } else {
                alert(data.errors ? data.errors.join('\n') : JSON.stringify(data));
                resetCheckoutBtn();
            }
        } catch (err) {
            console.error(err);
            resetCheckoutBtn();
        }
    };

    function resetCheckoutBtn() {
        const btn = document.getElementById('btn-checkout');
        if(btn) {
            btn.disabled = false;
            btn.innerHTML = `Proceed to Checkout`;
        }
    }

    function save() {
        localStorage.setItem('customer_cart', JSON.stringify(cart));
    }

    let toastTimer = null;
    function showToast(msg, success = true) {
        const wrap = document.getElementById('toast');
        const dot  = document.getElementById('toast-dot');
        const msgEl = document.getElementById('toast-msg');
        if(!wrap || !dot || !msgEl) return;
        
        dot.style.background  = success ? '#4ade80' : '#f87171';
        msgEl.textContent     = msg;
        wrap.classList.add('show');
        clearTimeout(toastTimer);
        toastTimer = setTimeout(() => wrap.classList.remove('show'), 2800);
    }

    function fmt(n) {
        return Math.round(n).toLocaleString('id-ID');
    }
    
    function escHtml(str) {
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;');
    }
    // Tambahkan event listener agar mendeteksi ketikan user secara real-time
    document.addEventListener('DOMContentLoaded', function() {
        const pointsInput = document.getElementById('input-points');
        
        if (pointsInput) {
            pointsInput.addEventListener('input', function() {
                const availablePointsElement = document.getElementById('available-points');
                const availablePoints = availablePointsElement ? parseInt(availablePointsElement.textContent) || 0 : 0;
                
                let val = parseInt(this.value) || 0;
                
                // Jika user ketik minus, balikan ke 0
                if (val < 0) val = 0;
                
                // Jika user ketik melebihi poin yang dia punya, otomatis kunci di batas maksimal
                if (val > availablePoints) {
                    val = availablePoints;
                }
                
                this.value = val;
                updateSummary(); // Jalankan ulang hitungan total belanja
            });
        }
    });
}());
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Herd\webdev-frombroole\resources\views/customer/cart.blade.php ENDPATH**/ ?>