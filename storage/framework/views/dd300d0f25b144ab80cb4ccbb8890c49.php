<?php $__env->startSection('content'); ?>

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
    background: var(--cream);
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

                
                <div class="summary-total">
                    <span class="summary-total-label">Total</span>
                    <span class="summary-total-value" id="total-val">Rp 0</span>
                </div>

                
                <div class="promo-row">
                    <input type="text" id="promo-input" class="promo-input" placeholder="Promo code" maxlength="20">
                    <button class="promo-apply-btn" onclick="applyPromo()">Apply</button>
                </div>
                <div class="promo-feedback" id="promo-feedback"></div>

                
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

    let cart        = JSON.parse(localStorage.getItem('customer_cart') || '[]');
    let discount    = 0;          // percentage (0–100)
    let promoApplied = null;

    const PROMOS = {
        'SWEET10': 10,
        'ARTISAN15': 15,
        'WELCOME20': 20,
    };

    renderCart();

    function renderCart() {
        const container  = document.getElementById('cart-items-container');
        const notesSection = document.getElementById('notes-section');
        const btnCheckout  = document.getElementById('btn-checkout');
        const btnClear     = document.getElementById('btn-clear');

        if (!cart.length) {
    
            container.innerHTML = `
                <div class="empty-cart">
                    <span class="empty-cart-icon">🛒</span>
                    <div class="empty-cart-title">Your cart is empty</div>
                    <p class="empty-cart-sub">Looks like you haven't added anything yet.</p>
                    <a href="<?php echo e(route('customer.shop')); ?>" class="btn-shop-now">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                        Browse Collection
                    </a>
                </div>`;
            notesSection.style.display = 'none';
            btnCheckout.disabled = true;
            btnClear.style.display = 'none';
            updateSummary();
            updateCountLabel();
            return;
        }

        
        container.innerHTML = cart.map((item, idx) => {
            const subtotal = item.price * item.qty;
            const sugarBadge = item.isDrink
                ? `<span class="item-badge">
                       <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23-.693L5 14.5m14.8.8l1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0112 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5"/></svg>
                       Sugar ${item.sugarLevel}%
                   </span>`
                : '';
            return `
            <div class="cart-item" id="cart-item-${idx}" style="animation: slideInLeft 0.4s ${idx * 0.07}s ease both;">
                <div class="item-img-wrap">
                    <span class="item-img-placeholder">🍰</span>
                </div>
                <div class="item-info">
                    <div class="item-category">Artisan</div>
                    <div class="item-name" title="${escHtml(item.name)}">${escHtml(item.name)}</div>
                    <div class="item-meta">
                        ${sugarBadge}
                    </div>
                    <div class="item-unit-price">Rp ${fmt(item.price)} / item</div>
                </div>
                <div class="item-controls">
                    <div class="item-subtotal">Rp ${fmt(subtotal)}</div>
                    <div class="qty-row">
                        <button class="qty-btn minus" onclick="changeQty(${idx}, -1)" ${item.qty <= 1 ? 'disabled' : ''} aria-label="Decrease quantity">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15"/></svg>
                        </button>
                        <span class="qty-num">${item.qty}</span>
                        <button class="qty-btn plus" onclick="changeQty(${idx}, 1)" ${item.qty >= item.maxStock ? 'disabled' : ''} aria-label="Increase quantity">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                        </button>
                    </div>
                    <button class="btn-remove" onclick="removeItem(${idx})" aria-label="Remove ${escHtml(item.name)}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                    </button>
                </div>
            </div>`;
        }).join('');

        notesSection.style.display = 'block';
        btnCheckout.disabled = false;
        btnClear.style.display = 'flex';
        updateSummary();
        updateCountLabel();
    }

    function updateSummary() {
        const subtotal = cart.reduce((s, i) => s + i.price * i.qty, 0);
        const discountAmt = Math.round(subtotal * discount / 100);
        const tax = Math.round(subtotal * 0.1); // 10% tax
        const total = subtotal - discountAmt + tax;
        const totalQty = cart.reduce((s, i) => s + i.qty, 0);

        const linesEl = document.getElementById('summary-lines');
        if (cart.length) {
            linesEl.innerHTML = cart.map(item =>
                `<div class="summary-line">
                    <span class="summary-line-name">${escHtml(item.name)}${item.isDrink ? ' ('+item.sugarLevel+'%)' : ''}</span>
                    <span class="summary-line-qty">×${item.qty}</span>
                    <span class="summary-line-price">Rp ${fmt(item.price * item.qty)}</span>
                </div>`
            ).join('');
        } else {
            linesEl.innerHTML = '<div style="font-size:13px;color:var(--muted-light);text-align:center;padding:12px 0">No items yet</div>';
        }

        document.getElementById('subtotal-val').textContent    = 'Rp ' + fmt(subtotal);
        document.getElementById('tax-val').textContent         = 'Rp ' + fmt(tax);
        document.getElementById('total-val').textContent       = 'Rp ' + fmt(total);
        document.getElementById('summary-item-count').textContent = totalQty + (totalQty === 1 ? ' item in cart' : ' items in cart');

        const discRow = document.getElementById('discount-row');
        if (discountAmt > 0) {
            discRow.style.display = 'flex';
            document.getElementById('discount-val').textContent = '— Rp ' + fmt(discountAmt);
        } else {
            discRow.style.display = 'none';
        }
    }

    function updateCountLabel() {
        const total = cart.reduce((s, i) => s + i.qty, 0);
        document.getElementById('item-count-label').textContent =
            total + (total === 1 ? ' item' : ' items');
    }

    window.changeQty = function (idx, delta) {
        const item = cart[idx];
        if (!item) return;
        const newQty = item.qty + delta;
        if (newQty < 1) { removeItem(idx); return; }
        if (newQty > item.maxStock) {
            showToast('Max stock reached for ' + item.name, false);
            return;
        }
        item.qty = newQty;
        save();
        renderCart();
    };

    window.removeItem = function (idx) {
        const el = document.getElementById('cart-item-' + idx);
        if (el) {
            el.style.transition = 'all 0.3s ease';
            el.style.opacity    = '0';
            el.style.transform  = 'translateX(20px) scale(0.97)';
            el.style.maxHeight  = el.offsetHeight + 'px';
            setTimeout(() => {
                el.style.maxHeight  = '0';
                el.style.padding    = '0';
                el.style.margin     = '0';
                el.style.border     = 'none';
                setTimeout(() => {
                    const name = cart[idx] ? cart[idx].name : 'Item';
                    cart.splice(idx, 1);
                    save();
                    renderCart();
                    showToast(name + ' removed', false);
                }, 200);
            }, 200);
        } else {
            cart.splice(idx, 1);
            save();
            renderCart();
        }
    };

    window.clearCart = function () {
        if (!cart.length) return;
        if (!confirm('Remove all items from your cart?')) return;
        cart = [];
        promoApplied = null;
        discount = 0;
        document.getElementById('promo-input').value = '';
        document.getElementById('promo-feedback').textContent = '';
        document.getElementById('promo-feedback').className = 'promo-feedback';
        save();
        renderCart();
        showToast('Cart cleared');
    };

    window.applyPromo = function () {
        const code = document.getElementById('promo-input').value.trim().toUpperCase();
        const feedback = document.getElementById('promo-feedback');

        if (!code) {
            feedback.textContent = 'Please enter a promo code.';
            feedback.className   = 'promo-feedback error';
            return;
        }

        // First check hardcoded promos
        if (PROMOS[code]) {
            discount     = PROMOS[code];
            promoApplied = code;
            feedback.textContent = '✓ ' + discount + '% discount applied!';
            feedback.className   = 'promo-feedback success';
            updateSummary();
            showToast(discount + '% discount applied 🎉');
            return;
        }

        // Check database coupons via AJAX
        const csrf = document.querySelector('meta[name="csrf-token"]')?.content ?? '';
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
                feedback.textContent = '✓ ' + discount + '% discount applied!';
                feedback.className   = 'promo-feedback success';
                updateSummary();
                showToast(discount + '% discount applied 🎉');
            } else {
                discount = 0;
                promoApplied = null;
                feedback.textContent = '✗ Invalid or expired coupon code.';
                feedback.className   = 'promo-feedback error';
                updateSummary();
            }
        })
        .catch(err => {
            discount = 0;
            promoApplied = null;
            feedback.textContent = '✗ Error validating coupon. Try again.';
            feedback.className   = 'promo-feedback error';
            updateSummary();
        });
    };
    window.proceedCheckout = async function () {
        if (!cart.length) return;
        const btn   = document.getElementById('btn-checkout');
        const notes = document.getElementById('order-notes').value.trim();
        btn.disabled     = true;
        btn.innerHTML    = `
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="animation:spin 0.8s linear infinite">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/>
            </svg>
            Processing…`;

        const payload = {
            items:    cart,
            notes:    notes,
            promo:    promoApplied,
            discount: discount,
        };

        try {
            const csrf = document.querySelector('meta[name="csrf-token"]')?.content ?? '';

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
                localStorage.removeItem('customer_cart');
                localStorage.removeItem('checkout_payload');
                showToast('Order placed! Redirecting…');
                setTimeout(() => {
                    window.location.href = data.redirect_url ?? '<?php echo e(route("customer.shop")); ?>';
                }, 1200);
            } else {
                const messages = data.errors ?? ['Something went wrong. Please try again.'];
                showErrorBanner(messages);
                resetCheckoutBtn();
            }

        } catch (err) {
            showErrorBanner(['Network error. Please check your connection and try again.']);
            resetCheckoutBtn();
        }
    };

    function resetCheckoutBtn() {
        const btn = document.getElementById('btn-checkout');
        btn.disabled  = false;
        btn.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/>
            </svg>
            Proceed to Checkout`;
    }

    function showErrorBanner(messages) {
        let banner = document.getElementById('checkout-error-banner');
        if (!banner) {
            banner = document.createElement('div');
            banner.id = 'checkout-error-banner';
            banner.style.cssText = `
                background: var(--red-bg);
                border: 1px solid rgba(220,38,38,0.25);
                border-radius: 16px;
                padding: 12px 16px;
                margin-top: 14px;
                font-size: 12px;
                color: var(--red-text);
                font-weight: 500;
                line-height: 1.6;
            `;
            document.getElementById('btn-checkout').insertAdjacentElement('afterend', banner);
        }
        banner.innerHTML = messages.map(m => `• ${m}`).join('<br>');
        banner.style.display = 'block';
        setTimeout(() => { if (banner) banner.style.display = 'none'; }, 6000);
    }

    function save() {
        localStorage.setItem('customer_cart', JSON.stringify(cart));
    }

    let toastTimer = null;
    function showToast(msg, success = true) {
        const wrap = document.getElementById('toast');
        const dot  = document.getElementById('toast-dot');
        const msgEl = document.getElementById('toast-msg');
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

}());
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Herd\webdev-frombroole\resources\views/customer/cart.blade.php ENDPATH**/ ?>