<?php $__env->startSection('content'); ?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
    :root {
        --brand:        #7b0000;
        --brand-light:  rgba(123, 0, 0, 0.10);
        --brand-mid:    rgba(123, 0, 0, 0.22);
        --brand-glow:   rgba(123, 0, 0, 0.35);
        --bg:           #faf8f6;
        --card-bg:      #ffffff;
        --text-primary: #1a1210;
        --text-muted:   #7a7068;
        --border:       rgba(123, 0, 0, 0.08);
        --radius:       24px;
        --font-display: 'Playfair Display', Georgia, serif;
        --font-body:    'DM Sans', sans-serif;
    }

    .th-wrapper {
        font-family: var(--font-body);
        background: transparent;
        min-height: 100vh;
        padding: 3rem 1.25rem 5rem;
    }

    .th-inner {
        max-width: 780px;
        margin: 0 auto;
    }

    /* ── Page header ── */
    .th-header {
        position: relative;
        margin-bottom: 3.5rem;
        text-align: center;
    }

    /* Eyebrow: — FROM BROOLE REWARDS — */
    .th-header .eyebrow {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        font-family: var(--font-body);
        font-size: 10px;
        font-weight: 600;
        letter-spacing: 0.22em;
        text-transform: uppercase;
        color: var(--brand);
        margin-bottom: 1rem;
    }

    .th-header .eyebrow::before,
    .th-header .eyebrow::after {
        content: '';
        display: block;
        width: 36px;
        height: 1px;
        background: var(--brand);
        opacity: 0.5;
    }

    /* Big serif title */
    .th-header h2 {
        font-family: var(--font-display);
        font-size: clamp(36px, 7vw, 62px);
        font-weight: 900;
        color: var(--text-primary);
        line-height: 1.05;
        letter-spacing: -0.025em;
    }

    .th-header h2 em {
        font-style: italic;
        color: var(--brand);
        font-weight: 700;
    }

    /* Subtle circle behind title */
    .th-header .title-wrap {
        position: relative;
        display: inline-block;
    }

    .th-header .title-wrap::before {
        content: '';
        position: absolute;
        width: 320px;
        height: 320px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(123,0,0,0.05) 0%, transparent 70%);
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        pointer-events: none;
        z-index: 0;
    }

    .th-header h2 { position: relative; z-index: 1; }

    .th-header .subtitle {
        font-size: 14px;
        color: var(--text-muted);
        margin-top: 1rem;
        font-weight: 400;
        line-height: 1.6;
    }

    /* ── Empty state ── */
    .empty-state {
        background: var(--card-bg);
        border-radius: 32px;
        border: 1px solid var(--border);
        padding: 4rem 2rem;
        text-align: center;
    }

    .empty-icon {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: var(--brand-light);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        margin: 0 auto 1.5rem;
    }

    .empty-state h3 {
        font-family: var(--font-display);
        font-size: 28px;
        font-weight: 900;
        color: var(--brand);
        margin-bottom: 0.5rem;
    }

    .empty-state p {
        color: var(--text-muted);
        font-size: 14px;
        margin-bottom: 2rem;
    }

    .btn-brand {
        display: inline-block;
        background: var(--brand);
        color: #fff;
        padding: 0.75rem 2rem;
        border-radius: 99px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        letter-spacing: 0.02em;
        transition: box-shadow 0.25s, transform 0.2s;
    }

    .btn-brand:hover {
        box-shadow: 0 8px 32px var(--brand-glow);
        transform: translateY(-2px);
        color: #fff;
    }

    /* ── Order card ── */
    .order-card {
        position: relative;
        margin-bottom: 1.25rem;
    }

    /* Glow blob behind card */
    .order-card::before {
        content: '';
        position: absolute;
        inset: 12px 24px -12px;
        background: radial-gradient(ellipse at 50% 100%, var(--brand-glow), transparent 70%);
        border-radius: var(--radius);
        filter: blur(18px);
        opacity: 0;
        transition: opacity 0.4s;
        z-index: 0;
        pointer-events: none;
    }

    .order-card:has(details[open])::before,
    .order-card:hover::before {
        opacity: 1;
    }

    details {
        position: relative;
        z-index: 1;
        background: var(--card-bg);
        border-radius: var(--radius);
        border: 1px solid var(--border);
        overflow: hidden;
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    details:hover,
    details[open] {
        border-color: var(--brand-mid);
        box-shadow: 0 4px 40px rgba(123, 0, 0, 0.07);
    }

    /* ── Summary row ── */
    summary {
        list-style: none;
        cursor: pointer;
        padding: 1.5rem 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        user-select: none;
        -webkit-tap-highlight-color: transparent;
    }

    summary::-webkit-details-marker { display: none; }

    .order-meta .order-id {
        font-family: var(--font-display);
        font-size: 18px;
        font-weight: 700;
        color: var(--text-primary);
        letter-spacing: -0.01em;
    }

    .order-meta .order-date {
        font-size: 12px;
        color: var(--text-muted);
        margin-top: 3px;
    }

    .order-right {
        display: flex;
        align-items: center;
        gap: 1.25rem;
    }

    .order-price {
        font-family: var(--font-display);
        font-size: 22px;
        font-weight: 900;
        color: var(--brand);
        line-height: 1;
        letter-spacing: -0.01em;
    }

    /* ── Badges ── */
    .badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 99px;
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 0.04em;
        margin-top: 6px;
    }

    .badge-pending   { background: #fef9c3; color: #92400e; }
    .badge-preparing { background: #dbeafe; color: #1e3a8a; }
    .badge-complete  { background: #dcfce7; color: #14532d; }
    .badge-delivered { background: #f1f5f9; color: #334155; }

    /* Chevron */
    .chevron-icon {
        color: var(--brand);
        transition: transform 0.35s cubic-bezier(.4,0,.2,1);
        flex-shrink: 0;
        opacity: 0.7;
    }

    details[open] .chevron-icon {
        transform: rotate(180deg);
    }

    /* ── Expanded body ── */
    .order-body {
        border-top: 1px solid var(--border);
        background: #fdf9f8;
    }

    /* ── Progress section ── */
    .progress-section {
        padding: 2rem 2rem 1.75rem;
    }

    .section-label {
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 0.16em;
        text-transform: uppercase;
        color: var(--brand);
        opacity: 0.6;
        margin-bottom: 1.75rem;
    }

    /* ── Stepper ── */
    .stepper {
        display: flex;
        align-items: flex-start;
        position: relative;
    }

    .step {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
    }

    /* Connector line */
    .step-line {
        position: absolute;
        top: 22px;
        left: 50%;
        right: -50%;
        height: 2px;
        background: #e8e0dc;
        z-index: 0;
        overflow: hidden;
        border-radius: 2px;
    }

    .step:last-child .step-line { display: none; }

    .step-line-fill {
        height: 100%;
        width: 0%;
        background: linear-gradient(90deg, var(--brand), rgba(123,0,0,0.5));
        border-radius: 2px;
        transition: width 0.8s cubic-bezier(.4,0,.2,1);
    }

    .step-line-fill.active { width: 100%; }

    /* Node */
    .step-node {
        position: relative;
        z-index: 1;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #ddd;
        background: #fff;
        font-size: 18px;
        transition: all 0.4s;
        flex-shrink: 0;
    }

    .step-node.done {
        background: #16a34a;        /* hijau */
        border-color: #16a34a;
        color: #fff;
        box-shadow:
            0 0 0 6px rgba(22, 163, 74, 0.12),
            0 4px 20px rgba(22, 163, 74, 0.35);
    }

    .step-node.active {
        background: #fff;
        border-color: var(--brand);
        color: var(--brand);
        box-shadow:
            0 0 0 6px var(--brand-light),
            0 4px 16px rgba(123,0,0,0.18);
        animation: nodeGlow 2s ease-in-out infinite;
    }

    /* Floating emoji untuk step active */
    .float-emoji {
        position: absolute;
        font-size: 16px;
        pointer-events: none;
        z-index: 2;
        animation: floatBounce 3s ease-in-out infinite;
    }
    .float-emoji.cupcake { top: -18px; right: -14px; animation-delay: 0s; }
    .float-emoji.star1   { top: -10px; left: -16px; font-size: 12px; animation-delay: 0.6s; }
    .float-emoji.star2   { bottom: -12px; right: -20px; font-size: 10px; animation-delay: 1.1s; }
    .float-emoji.star3   { bottom: -6px; left: -12px; font-size: 14px; animation-delay: 1.7s; }

    @keyframes floatBounce {
        0%, 100% { transform: translateY(0) rotate(0deg); opacity: 0.85; }
        50%       { transform: translateY(-6px) rotate(8deg); opacity: 1; }
    }

    .step-node.inactive {
        color: #bbb;
        border-color: #e8e0dc;
    }

    @keyframes nodeGlow {
        0%, 100% {
            box-shadow: 0 0 0 6px var(--brand-light), 0 4px 16px rgba(123,0,0,0.15);
        }
        50% {
            box-shadow: 0 0 0 12px rgba(123,0,0,0.04), 0 4px 28px rgba(123,0,0,0.30);
        }
    }

    /* Halo rings for active step */
    .step-node.active::before,
    .step-node.active::after {
        content: '';
        position: absolute;
        inset: -6px;
        border-radius: 50%;
        border: 1.5px solid var(--brand);
        opacity: 0;
        animation: ripple 2s ease-out infinite;
    }

    .step-node.active::after {
        animation-delay: 0.7s;
    }

    @keyframes ripple {
        0%   { transform: scale(0.85); opacity: 0.5; }
        100% { transform: scale(1.5);  opacity: 0; }
    }

    .step-label {
        margin-top: 10px;
        font-size: 11px;
        font-weight: 600;
        color: var(--text-muted);
        text-align: center;
        line-height: 1.35;
        max-width: 80px;
    }

    .step-label.done { color: #16a34a; }
    .step-label.active { color: var(--brand); }

    /* ── Item breakdown ── */
    .items-section {
        padding: 0 2rem 2rem;
    }

    .items-section .section-label {
        margin-bottom: 1rem;
    }

    .item-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.875rem 0;
        border-bottom: 1px solid rgba(123,0,0,0.05);
    }

    .item-row:last-child { border-bottom: none; }

    .item-left {
        display: flex;
        align-items: center;
        gap: 12px;
        flex: 1;
    }

    .item-num {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: var(--brand-light);
        color: var(--brand);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .item-name {
        font-size: 13px;
        font-weight: 600;
        color: var(--text-primary);
    }

    .item-qty {
        font-size: 11px;
        color: var(--text-muted);
        margin-top: 2px;
    }

    .item-price {
        font-family: var(--font-display);
        font-size: 14px;
        font-weight: 700;
        color: var(--brand);
    }
    
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* ── Responsive ── */
    @media (max-width: 520px) {
        summary { padding: 1.25rem 1.25rem; }
        .progress-section, .items-section { padding-left: 1.25rem; padding-right: 1.25rem; }
        .order-price { font-size: 18px; }
        .step-node { width: 36px; height: 36px; font-size: 15px; }
    }
</style>

<div class="th-wrapper">
    <div class="th-inner" style="position: relative; z-index: 1;">

        
        <div class="th-header" style="opacity: 0; animation: fadeUp 0.7s 0.1s ease forwards;">
            <p class="eyebrow">Your From Broole Journey</p>
            <div class="title-wrap">
                <h2>Transaction <em>History</em></h2>
            </div>
            <p class="subtitle">Review status and details of your orders.</p>
        </div>

        
        <?php if($orders->isEmpty()): ?>
        <div class="empty-state" style="opacity: 0; animation: fadeUp 0.7s 0.3s ease forwards;">
            <div class="empty-icon">🧁</div>
            <h3>No Orders Yet</h3>
            <p>Looks like you haven't treated yourself yet.<br>Start exploring our handcrafted desserts 🍰</p>
            <a href="<?php echo e(route('customer.shop')); ?>" class="btn-brand">Explore Shop</a>
        </div>

        <?php else: ?>

        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <?php
            $badgeClass = match($order->status) {
                'Pending'   => 'badge-pending',
                'Preparing' => 'badge-preparing',
                'Complete'  => 'badge-complete',
                'Delivered' => 'badge-delivered',
                default     => 'badge-delivered',
            };

            /*
             * Step states: 2 = done (filled), 1 = active (pulsing), 0 = inactive
             * Steps: [0] Order received, [1] Processing order, [2] Order complete
             *
             * Pending   → step 0 active,  rest inactive
             * Preparing → step 0 done,    step 1 active, step 2 inactive
             * Complete  → step 0-1 done,  step 2 active (done)
             * Delivered → all done
             */
            $stepStates = match($order->status) {
                'Pending'   => [2, 1, 0],
                'Preparing' => [2, 2, 1],
                'Complete'  => [2, 2, 2],
                'Delivered' => [2, 2, 2],
                default     => [0, 0, 0],
            };

            $steps = [
                [
                    'label' => 'Order Received',
                    'svg'   => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/><path d="M9 12h6M9 16h4"/></svg>',
                ],
                [
                    'label' => 'Processing Order',
                    'svg'   => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/></svg>',
                ],
                [
                    'label' => 'Order Complete',
                    'svg'   => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="m9 12 2 2 4-4"/></svg>',
                ],
            ];
        ?>

        <div class="order-card" style="opacity: 0; animation: fadeUp 0.6s <?php echo e(0.2 + $loop->index * 0.1); ?>s ease forwards;">
            <details>

                <summary>
                    <div class="order-meta">
                        <div class="order-id">Order <?php echo e($order->order_id); ?></div>
                        <div class="order-date"><?php echo e($order->order_date?->format('d M Y • H:i')); ?></div>
                    </div>

                    <div class="order-right">
                        <div style="text-align:right;">
                            <div class="order-price">
                                Rp <?php echo e(number_format($order->total_price, 0, ',', '.')); ?>

                            </div>
                            <span class="badge <?php echo e($badgeClass); ?>"><?php echo e($order->status); ?></span>
                        </div>

                        <svg class="chevron-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"/>
                        </svg>
                    </div>
                </summary>

                <div class="order-body">

                    
                    <div class="progress-section">
                        <div class="section-label">Order Progress</div>

                        <div class="stepper">
                            <?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $state = $stepStates[$i];
                                $nodeClass  = $state === 2 ? 'done' : ($state === 1 ? 'active' : 'inactive');
                                $labelClass = $state === 2 ? 'done' : ($state === 1 ? 'active' : '');
                                $lineActive = $i < 2 && $stepStates[$i + 1] > 0;
                            ?>
                            <div class="step">
                                
                                <?php if(!$loop->last): ?>
                                <div class="step-line">
                                    <div class="step-line-fill <?php echo e($lineActive ? 'active' : ''); ?>"></div>
                                </div>
                                <?php endif; ?>

                                
                                <div class="step-node <?php echo e($nodeClass); ?>">
                                    <?php if($state === 2): ?>
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20 6 9 17 4 12"/>
                                        </svg>
                                    <?php else: ?>
                                        <?php echo $step['svg']; ?>

                                    <?php endif; ?>

                                    
                                    <?php if($state === 1): ?>
                                        <span class="float-emoji cupcake">🧁</span>
                                        <span class="float-emoji star1">⭐</span>
                                        <span class="float-emoji star2">✨</span>
                                        <span class="float-emoji star3">⭐</span>
                                    <?php endif; ?>
                                </div>

                                
                                <div class="step-label <?php echo e($labelClass); ?>">
                                    <?php echo e($step['label']); ?>

                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                    
                    <div class="items-section">
                        <div class="section-label">Item Breakdown</div>

                        <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item-row">
                            <div class="item-left">
                                <div class="item-num"><?php echo e($index + 1); ?></div>
                                <div>
                                    <div class="item-name">
                                        <?php echo e(optional($item->product)->pro_name ?? 'Deleted Product'); ?>

                                    </div>
                                    <div class="item-qty">Qty <?php echo e($item->quantity); ?></div>
                                </div>
                            </div>
                            <div class="item-price">
                                Rp <?php echo e(number_format($item->price_at_purchase * $item->quantity, 0, ',', '.')); ?>

                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                </div>
            </details>
        </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Herd\webdev-frombroole\resources\views/customer/transaction-history.blade.php ENDPATH**/ ?>