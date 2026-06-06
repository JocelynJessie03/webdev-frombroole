<?php $__env->startSection('content'); ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;0,800;1,400;1,600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

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

*, *::before, *::after { box-sizing: border-box; }
.shop-page {
    background: transparent;
    min-height: 100vh;
    font-family: var(--font-body);
    overflow-x: hidden;
}

.shop-hero {
    position: relative;
    padding: 6rem 2rem 4rem;
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
    .shop-hero { padding: 4.5rem 1.5rem 2.5rem; }
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
</style>


<div class="toast-wrap" id="toast">
    <div class="toast-inner">
        <div class="toast-dot"></div>
        <span id="toast-msg">Added to cart</span>
    </div>
</div>

<div class="shop-page">
    
    
    <section class="shop-hero">
        <div class="hero-inner">
            <span class="hero-eyebrow">Taste The Perfection</span>
            <h1 class="hero-title">Our <em>Artisan</em><br>Collection</h1>
            <p class="hero-desc">Discover our meticulously crafted desserts and beverages, made from the finest ingredients to redefine your sweetness experience.</p>

            <div class="hero-stats">
                <div class="hero-stat">
                    <span class="hero-stat-num"><?php echo e($products->count()); ?></span>
                    <span class="hero-stat-label">Items</span>
                </div>
                <div class="hero-divider"></div>
                <div class="hero-stat">
                    <span class="hero-stat-num"><?php echo e($categories->count()); ?></span>
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

    
    <div class="shop-body" id="shop-dynamic-content">

        
        <div class="filter-section">
            <div class="filter-bar">
                <a href="<?php echo e(route('customer.shop')); ?>"
                   class="filter-btn <?php echo e(!request('category') ? 'is-active' : 'is-inactive'); ?>">
                    All Items
                </a>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('customer.shop', ['category' => $category->id])); ?>"
                   class="filter-btn <?php echo e(request('category') == $category->id ? 'is-active' : 'is-inactive'); ?>">
                    <?php echo e($category->category_name); ?>

                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        
        <div class="search-section" style="max-width: 480px; margin: 0 auto 32px auto; padding: 0 16px;">
            <form onsubmit="event.preventDefault();" style="display: flex; gap: 8px; position: relative;">
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
            </form>
        </div>

        
        <div class="section-divider">
            <div class="divider-line"></div>
            <span class="divider-label">
                <?php echo e($products->count()); ?> <?php echo e($products->count() == 1 ? 'item' : 'items'); ?> available
            </span>
            <div class="divider-line"></div>
        </div>

        
        <div class="product-grid">
            <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $isDrink = (stripos($product->category->category_name ?? '', 'drink') !== false
                             || stripos($product->category->category_name ?? '', 'minuman') !== false);
                    $isSoldOut = $product->calculated_stock <= 0;
                ?>

                <div class="product-card <?php echo e($isSoldOut ? 'is-soldout' : ''); ?>" style="display: flex; flex-direction: column; height: 100%;">

                    
                    <div class="card-image-wrap">
                        <?php if($isSoldOut): ?>
                            <div class="badge-soldout">Sold Out</div>
                        <?php endif; ?>

                        <?php if($product->pro_image): ?>
                            <img
                                src="<?php echo e(asset('products/' . rawurlencode($product->pro_image))); ?>"
                                alt="<?php echo e($product->pro_name); ?>"
                                loading="lazy"
                            >
                        <?php else: ?>
                            <span class="card-no-image">No Image</span>
                        <?php endif; ?>
                    </div>

                    
                    <div class="card-body" style="display: flex; flex-direction: column; flex-grow: 1;">

                        <span class="card-category">
                            <?php echo e($product->category->category_name ?? 'Uncategorized'); ?>

                        </span>

                        <h3 class="card-name"><?php echo e($product->pro_name); ?></h3>

                        <p class="card-desc" style="flex-grow: 1;">
                            <?php echo e($product->pro_description ?? 'No description available for this item.'); ?>

                        </p>

                        <div class="sugar-container-layout" style="margin-top: auto; min-height: 45px; display: flex; align-items: center;">
                            <?php if($isDrink && !$isSoldOut): ?>
                                <div class="sugar-wrap" style="width: 100%;">
                                    <select
                                        id="sugar-<?php echo e($product->id); ?>"
                                        class="sugar-select"
                                        aria-label="Sugar level for <?php echo e($product->pro_name); ?>"
                                    >
                                        <option value="100">Normal Sugar (100%)</option>
                                        <option value="50">Less Sugar (50%)</option>
                                        <option value="0">No Sugar (0%)</option>
                                    </select>
                                </div>
                            <?php endif; ?>
                        </div>

                        
                        <div class="card-footer">
                            <div>
                                <span class="card-price-label">Price</span>
                                <span class="card-price">
                                    Rp <?php echo e(number_format($product->pro_price, 0, ',', '.')); ?>

                                </span>
                            </div>

                            <button
                                type="button"
                                class="btn-add <?php echo e(!$isSoldOut ? 'available' : 'unavailable'); ?>"
                                <?php echo e($isSoldOut ? 'disabled' : ''); ?>

                                onclick="addToCart(<?php echo e($product->id); ?>, '<?php echo e(addslashes($product->pro_name)); ?>', <?php echo e($product->pro_price); ?>, <?php echo e($product->calculated_stock); ?>, <?php echo e($isDrink ? 'true' : 'false'); ?>, '<?php echo e($product->pro_image); ?>')"
                                aria-label="Add <?php echo e($product->pro_name); ?> to cart"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="empty-state">
                    <div class="empty-icon">🍰</div>
                    <div class="empty-title">Nothing here yet</div>
                    <p class="empty-sub">No products found in this category.</p>
                </div>
            <?php endif; ?>
        </div>
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
                card.style.transition = 'transform 0.1s ease-out';
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
                card.style.transition = 'transform 0.5s ease-out';
                card.style.zIndex = '';
                
                const imgWrap = card.querySelector('.card-image-wrap');
                if (imgWrap) {
                    imgWrap.style.transform = '';
                    imgWrap.style.transition = 'transform 0.5s ease-out';
                }
            }
        });
    });
</script>

<?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Herd\webdev-frombroole\resources\views/customer/shop.blade.php ENDPATH**/ ?>