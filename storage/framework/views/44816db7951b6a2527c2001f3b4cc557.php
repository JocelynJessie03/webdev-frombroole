<?php $__env->startSection('content'); ?>
<?php $__env->startPush('styles'); ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;0,800;1,400;1,600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
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
    --radius-img:   20px;
    --radius-pill:  999px;
    --font-display: 'Cormorant Garamond', Georgia, serif;
    --font-body:    'DM Sans', sans-serif;
    --transition:   all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
}

*, *::before, *::after { box-sizing: border-box; }
/* Tombol Copy */
.btn-copy {
    margin-top: 12px;
    padding: 6px 16px;
    border-radius: 8px;
    border: 1px solid rgba(22, 163, 74, 0.3);
    background: #F0FDF4;
    color: #15803D;
    font-family: var(--font-body);
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    cursor: pointer;
    transition: var(--transition);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
}
.btn-copy:hover {
    background: #DCFCE7;
    border-color: rgba(22, 163, 74, 0.6);
}
.tasks-page {
    background: transparent;
    min-height: 100vh;
    font-family: var(--font-body);
    overflow-x: hidden;
}

/* ── HERO ── */
.tasks-hero {
    position: relative;
    padding: 3.5rem 2rem 2.5rem;
    text-align: center;
    overflow: hidden;
}
.tasks-hero::before {
    content: '';
    position: absolute;
    top: -120px; left: 50%;
    transform: translateX(-50%);
    width: 700px; height: 700px;
    border-radius: 50%;
    border: 1px solid rgba(140, 23, 23, 0.07);
    pointer-events: none;
}
.tasks-hero::after {
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

/* Tier badge pill */
.tier-pill {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-pill);
    padding: 10px 24px;
    box-shadow: var(--shadow-card);
    opacity: 0;
    animation: fadeUp 0.7s 0.4s ease forwards;
}
.tier-pill-label {
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: var(--muted);
}
.tier-pill-badge {
    background: var(--charcoal);
    color: var(--cream);
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    padding: 5px 14px;
    border-radius: var(--radius-pill);
}
.tier-pill-sep {
    width: 1px; height: 18px;
    background: var(--border);
}
.tier-pill-pts {
    font-family: var(--font-display);
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--crimson);
    letter-spacing: -0.01em;
}
.tier-pill-pts-label {
    font-size: 10px;
    font-weight: 500;
    color: var(--muted-light);
    letter-spacing: 0.1em;
    text-transform: uppercase;
    margin-left: 2px;
}

/* ── ALERTS ── */
.alert-wrap {
    max-width: 1360px;
    margin: 0 auto;
    padding: 0 2rem;
    margin-bottom: 2rem;
}
.alert {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 20px;
    border-radius: 16px;
    font-size: 13px;
    font-weight: 600;
    text-align: left;
    margin-bottom: 10px;
}
.alert-success {
    background: #F0FDF4;
    border: 1px solid #BBF7D0;
    color: #166534;
}
.alert-error {
    background: #FEF2F2;
    border: 1px solid #FECACA;
    color: #991B1B;
}

/* ── BODY ── */
.tasks-body {
    max-width: 1360px;
    margin: 0 auto;
    padding: 0 2rem 6rem;
}

/* ── TIER SECTION ── */
.tier-section {
    margin-bottom: 3.5rem;
    opacity: 0;
    animation: fadeUp 0.6s ease forwards;
}
.tier-section:nth-child(1) { animation-delay: 0.15s; }
.tier-section:nth-child(2) { animation-delay: 0.25s; }
.tier-section:nth-child(3) { animation-delay: 0.35s; }

.tier-section-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--border);
    flex-wrap: wrap;
    gap: 12px;
}
.tier-section-left {
    display: flex;
    align-items: center;
    gap: 14px;
}
.tier-icon {
    width: 48px; height: 48px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    flex-shrink: 0;
}
.tier-icon.gold   { background: linear-gradient(135deg, #FEF3C7, #FDE68A); border: 1px solid #F59E0B22; }
.tier-icon.silver { background: linear-gradient(135deg, #F1F5F9, #E2E8F0); border: 1px solid #94A3B822; }
.tier-icon.bronze { background: linear-gradient(135deg, #FEF3E8, #FED7AA); border: 1px solid #EA580C22; }

.tier-section-title {
    font-family: var(--font-display);
    font-size: 1.9rem;
    font-weight: 800;
    color: var(--charcoal);
    line-height: 1;
    letter-spacing: -0.01em;
}
.tier-section-sub {
    font-size: 11px;
    font-weight: 500;
    color: var(--muted-light);
    letter-spacing: 0.15em;
    text-transform: uppercase;
    margin-top: 2px;
}

.tier-reward-badge {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-pill);
    padding: 8px 18px;
    display: flex;
    align-items: center;
    gap: 8px;
    box-shadow: var(--shadow-card);
}
.tier-reward-badge-label {
    font-size: 9px;
    font-weight: 600;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: var(--muted-light);
}
.tier-reward-badge-value {
    font-family: var(--font-display);
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--crimson);
    line-height: 1;
}

/* ── TASK GRID ── */
.task-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
}

.task-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-card);
    padding: 22px;
    display: flex;
    flex-direction: column;
    position: relative;
    overflow: hidden;
    transition: var(--transition);
    box-shadow: var(--shadow-card);
}
.task-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-hover);
    border-color: var(--border-hover);
}
.task-card.is-locked {
    opacity: 0.62;
    filter: grayscale(10%);
}
.task-card.is-locked:hover {
    transform: none;
    box-shadow: var(--shadow-card);
    border-color: var(--border);
}
.task-card.is-claimed {
    background: #F0FDF4;
    border-color: rgba(22, 163, 74, 0.2);
}
.task-card.is-claimed:hover {
    box-shadow: 0 20px 48px rgba(22, 163, 74, 0.10);
    border-color: rgba(22, 163, 74, 0.30);
}

/* Left accent bar */
.task-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0;
    width: 4px; height: 100%;
    border-radius: 4px 0 0 4px;
    opacity: 0;
    transition: opacity 0.3s ease;
}
.task-card:not(.is-locked):not(.is-claimed)::before { background: var(--crimson); }
.task-card.is-claimed::before { background: #16A34A; opacity: 1; }
.task-card:not(.is-locked):not(.is-claimed):hover::before { opacity: 1; }

/* ── TASK CARD HEADER ── */
.task-card-top {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 10px;
}
.task-card-title {
    font-family: var(--font-display);
    font-size: 1.45rem;
    font-weight: 700;
    color: var(--charcoal);
    line-height: 1.2;
    letter-spacing: -0.01em;
    flex: 1;
}
.task-pts-badge {
    background: var(--cream);
    border: 1px solid var(--border);
    border-radius: 10px;
    padding: 5px 10px;
    display: flex;
    flex-direction: column;
    align-items: center;
    flex-shrink: 0;
}
.task-pts-num {
    font-family: var(--font-display);
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--crimson);
    line-height: 1;
}
.task-pts-label {
    font-size: 8px;
    font-weight: 600;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: var(--muted-light);
}

.task-desc {
    font-size: 12.5px;
    font-weight: 300;
    color: var(--muted);
    line-height: 1.75;
    margin-bottom: 14px;
    flex-shrink: 0;
}

/* ── TAGS / BADGES ── */
.task-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    margin-bottom: 14px;
}
.task-tag {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 10px;
    font-weight: 600;
    padding: 4px 10px;
    border-radius: var(--radius-pill);
    letter-spacing: 0.05em;
}
.tag-general  { background: #EFF6FF; color: #1D4ED8; border: 1px solid #BFDBFE; }
.tag-specific { background: #F5F3FF; color: #6D28D9; border: 1px solid #DDD6FE; }
.tag-locked   { background: #FEF2F2; color: #991B1B; border: 1px solid #FECACA; }
.tag-met      { background: #F0FDF4; color: #15803D; border: 1px solid #BBF7D0; }

/* ── PRODUCTS LIST ── */
.task-products {
    background: #F5F3FF;
    border: 1px solid #DDD6FE;
    border-radius: 14px;
    padding: 12px 14px;
    margin-bottom: 14px;
}
.task-products-title {
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: #5B21B6;
    margin-bottom: 8px;
}
.task-product-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 5px 0;
    border-bottom: 1px solid rgba(109, 40, 217, 0.10);
}
.task-product-row:last-child { border-bottom: none; }
.task-product-name {
    font-size: 12px;
    font-weight: 500;
    color: #4C1D95;
}
.task-product-price {
    background: var(--white);
    border: 1px solid #DDD6FE;
    border-radius: 8px;
    padding: 3px 8px;
    font-size: 11px;
    font-weight: 700;
    color: #5B21B6;
    font-family: var(--font-display);
}

/* ── CARD FOOTER ── */
.task-card-footer {
    margin-top: auto;
    padding-top: 16px;
    border-top: 1px solid var(--border);
}
.task-footer-status {
    font-size: 11px;
    font-weight: 600;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 6px;
}
.status-locked   { color: #9E1111; }
.status-purchase { color: #92400E; }
.status-eligible { color: #15803D; }
.status-claimed  { color: #15803D; }

/* Claimed coupon display */
.coupon-display {
    background: var(--white);
    border: 1.5px dashed rgba(22, 163, 74, 0.4);
    border-radius: 12px;
    padding: 12px 16px;
    text-align: center;
}
.coupon-display-label {
    font-size: 9px;
    font-weight: 600;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: #15803D;
    margin-bottom: 6px;
}
.coupon-code {
    font-family: 'Courier New', monospace;
    font-size: 1.25rem;
    font-weight: 900;
    color: #166534;
    letter-spacing: 0.2em;
    user-select: all;
}

/* Buttons */
.btn-locked {
    width: 100%;
    padding: 12px;
    border-radius: 14px;
    border: none;
    background: var(--cream-dark);
    color: var(--muted-light);
    font-family: var(--font-body);
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    cursor: not-allowed;
    text-align: center;
}
.btn-purchase {
    width: 100%;
    padding: 12px;
    border-radius: 14px;
    border: 1px solid rgba(217, 119, 6, 0.3);
    background: #FFFBEB;
    color: #92400E;
    font-family: var(--font-body);
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    cursor: not-allowed;
    text-align: center;
}
.btn-claim {
    width: 100%;
    padding: 13px;
    border-radius: 14px;
    border: none;
    background: var(--crimson);
    color: var(--white);
    font-family: var(--font-body);
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    cursor: pointer;
    transition: var(--transition);
    box-shadow: var(--shadow-btn);
    text-align: center;
}
.btn-claim:hover {
    background: var(--crimson-dark);
    box-shadow: 0 8px 28px rgba(140, 23, 23, 0.40);
    transform: translateY(-1px);
}
.btn-claim:active { transform: scale(0.98); }

/* ── EMPTY STATE ── */
.task-empty {
    grid-column: 1 / -1;
    text-align: center;
    padding: 3rem;
}
.task-empty-icon {
    font-size: 2.5rem;
    opacity: 0.25;
    margin-bottom: 0.75rem;
}
.task-empty-text {
    font-family: var(--font-display);
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--charcoal);
    opacity: 0.35;
}

/* ── ANIMATIONS ── */
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ── RESPONSIVE ── */
@media (max-width: 640px) {
    .tasks-hero { padding: 2.5rem 1.5rem 1.5rem; }
    .tasks-body { padding: 0 1.25rem 4rem; }
    .task-grid { grid-template-columns: 1fr; gap: 14px; }
    .task-card { padding: 18px; border-radius: 20px; }
    .tier-section-header { flex-direction: column; align-items: flex-start; }
    .tier-pill { flex-wrap: wrap; justify-content: center; }
}
</style>
<?php $__env->stopPush(); ?>

<div class="tasks-page">

    
    <section class="tasks-hero">
        <div class="hero-inner">
            <span class="hero-eyebrow">From Broole Rewards</span>
            <h1 class="hero-title">Tier <em>Exclusive</em><br>Achievements</h1>
            <p class="hero-desc">Complete exclusive tasks based on your membership tier to earn discount vouchers and reward points.</p>

            <div class="tier-pill">
                <span class="tier-pill-label">Your Tier</span>
                <span class="tier-pill-badge"><?php echo e($customer->tier); ?></span>
                <div class="tier-pill-sep"></div>
                <div>
                    <span class="tier-pill-pts"><?php echo e(number_format($customer->member_points)); ?></span>
                    <span class="tier-pill-pts-label">pts</span>
                </div>
            </div>
        </div>
    </section>

    
    <?php if(session('success') || session('error')): ?>
    <div class="alert-wrap">
        <?php if(session('success')): ?>
        <div class="alert alert-success">
            <span>✨</span>
            <span><?php echo e(session('success')); ?></span>
        </div>
        <?php endif; ?>
        <?php if(session('error')): ?>
        <div class="alert alert-error">
            <span>🛑</span>
            <span><?php echo e(session('error')); ?></span>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    
    <div class="tasks-body">
        <?php $__currentLoopData = ['Bronze', 'Silver', 'Gold']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tierName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $discount = $tierName == 'Gold' ? '15%' : ($tierName == 'Silver' ? '10%' : '5%');
            $iconClass = strtolower($tierName);
            $icon = $tierName == 'Gold' ? '👑' : ($tierName == 'Silver' ? '🥈' : '🥉');
        ?>

        <div class="tier-section">
            <div class="tier-section-header">
                <div class="tier-section-left">
                    <div class="tier-icon <?php echo e($iconClass); ?>"><?php echo e($icon); ?></div>
                    <div>
                        <div class="tier-section-title"><?php echo e($tierName); ?> Tasks</div>
                        <div class="tier-section-sub"><?php echo e($tierName); ?> Membership Rewards</div>
                    </div>
                </div>
                <div class="tier-reward-badge">
                    <div class="tier-reward-badge-label">Coupon Reward</div>
                    <div class="tier-reward-badge-value"><?php echo e($discount); ?> OFF</div>
                </div>
            </div>

            <div class="task-grid">
                <?php $__empty_1 = true; $__currentLoopData = $grouped[$tierName]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $isLocked    = !$task['unlocked'];
                    $isClaimed   = $task['claimed'];
                    $hasPurchase = $task['has_purchases'];
                    $cardClass   = $isLocked ? 'is-locked' : ($isClaimed ? 'is-claimed' : '');
                ?>

                <div class="task-card <?php echo e($cardClass); ?>">

                    
                    <div class="task-card-top">
                        <h3 class="task-card-title"><?php echo e($task['title']); ?></h3>
                        <div class="task-pts-badge">
                            <span class="task-pts-num">+<?php echo e(number_format($task['points_reward'])); ?></span>
                            <span class="task-pts-label">Pts</span>
                        </div>
                    </div>

                    
                    <p class="task-desc"><?php echo e($task['description'] ?? 'No extra criteria provided.'); ?></p>

                    
                    <div class="task-tags">
                        <?php if($task['task_type'] === 'general'): ?>
                            <span class="task-tag tag-general">🎯 Any Product</span>
                        <?php else: ?>
                            <span class="task-tag tag-specific">📦 Specific Products</span>
                        <?php endif; ?>

                        <?php if(!$hasPurchase): ?>
                            <span class="task-tag tag-locked">🔒 Not purchased yet</span>
                        <?php else: ?>
                            <span class="task-tag tag-met">✓ Requirements met</span>
                        <?php endif; ?>

                        <?php if($task['task_type'] === 'product_specific' && isset($task['product_count']) && $task['product_count'] > 0): ?>
                            <span class="task-tag tag-specific"><?php echo e($task['product_count']); ?> products</span>
                        <?php endif; ?>
                    </div>

                    <?php if($task['task_type'] === 'product_specific' && !empty($task['products'])): ?>
                    <div class="task-products">
                        <div class="task-products-title">📦 Available Products</div>
                        <?php $__currentLoopData = $task['products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="task-product-row">
                            <span class="task-product-name"><?php echo e($product['name']); ?></span>
                            
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endif; ?>

                    
                    <div class="task-card-footer">
                        <?php if($isLocked && !$hasPurchase): ?>
                            <div class="task-footer-status status-locked">🔒 Locked — Buy products & reach <?php echo e($task['required_tier']); ?> Tier</div>
                            <div class="btn-locked">Locked</div>

                        <?php elseif($isLocked): ?>
                            <div class="task-footer-status status-locked">🔒 Requires <?php echo e($task['required_tier']); ?> Tier</div>
                            <div class="btn-locked">Locked</div>

                        <?php elseif(!$hasPurchase): ?>
                            <div class="task-footer-status status-purchase">⚠️ Purchase qualifying products to unlock</div>
                            <div class="btn-purchase">Complete Purchases First</div>

                        <?php elseif($isClaimed): ?>
                            <div class="task-footer-status status-claimed">✓ Claimed — Your discount code:</div>
                            <div class="coupon-display">
                                <div class="coupon-display-label">Discount Token</div>
                                <div class="coupon-code"><?php echo e($task['coupon_code']); ?></div>
                                <button type="button" class="btn-copy" onclick="copyCouponCode('<?php echo e($task['coupon_code']); ?>', this)">
                                    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                        <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                                    </svg>
                                    Copy Code
                                </button>
                            </div>

                        <?php else: ?>
                            <div class="task-footer-status status-eligible">✨ Unlocked &amp; eligible to claim</div>
                            <form action="<?php echo e(route('customer.tasks.claim', ['task' => $task['id']])); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn-claim">Claim Coupon</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="task-empty">
                    <div class="task-empty-icon">🏅</div>
                    <div class="task-empty-text">No tasks defined for this tier yet.</div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<script>
function copyCouponCode(code, buttonElement) {
    // 1. Fungsi untuk memberikan efek visual sukses
    function triggerSuccessEffects() {
        const originalContent = buttonElement.innerHTML;
        buttonElement.innerHTML = '✓ COPIED!';
        buttonElement.style.backgroundColor = '#166534'; // Hijau gelap
        buttonElement.style.color = '#FFFFFF'; // Teks putih
        
        setTimeout(() => {
            buttonElement.innerHTML = originalContent;
            buttonElement.style.backgroundColor = '';
            buttonElement.style.color = '';
        }, 2000);
    }

    // 2. Metode Alternatif (Jurus lama yang bekerja di HTTP / non-localhost)
    function fallbackCopyText(text) {
        const textArea = document.createElement("textarea");
        textArea.value = text;
        
        // Buat elemen tidak terlihat oleh pengguna
        textArea.style.top = "0";
        textArea.style.left = "0";
        textArea.style.position = "fixed";
        textArea.style.opacity = "0";
        
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        
        try {
            const successful = document.execCommand('copy');
            if (successful) {
                triggerSuccessEffects();
            } else {
                alert('Gagal menyalin kode.');
            }
        } catch (err) {
            console.error('Fallback Error: ', err);
            alert('Gagal menyalin kode. Silakan salin secara manual.');
        }
        
        document.body.removeChild(textArea);
    }

    // 3. Eksekusi Utama: Cek apakah browser mendukung Navigator Clipboard (Wajib HTTPS/Localhost)
    if (!navigator.clipboard) {
        // Jika tidak mendukung / berada di jaringan HTTP biasa, pakai metode alternatif
        fallbackCopyText(code);
        return;
    }
    
    // Jika mendukung (di localhost atau HTTPS), gunakan metode modern
    navigator.clipboard.writeText(code).then(() => {
        triggerSuccessEffects();
    }).catch(err => {
        // Jika metode modern gagal mendadak, lempar ke metode alternatif
        fallbackCopyText(code);
    });
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Herd\webdev-frombroole\resources\views/customer/tasks.blade.php ENDPATH**/ ?>