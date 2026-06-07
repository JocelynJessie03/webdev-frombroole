<style>
    #virtual-pet {
        position: fixed;
        bottom: 0;
        left: 0;
        cursor: grab;
        user-select: none;
        z-index: 999999;
        transform-origin: center bottom;
        touch-action: none;
        will-change: transform;
    }
    #virtual-pet:active {
        cursor: grabbing;
    }
    
    .cat-svg {
        display: block;
        width: 60px;
        height: 50px;
        filter: drop-shadow(0 4px 6px rgba(0,0,0,0.2));
    }

    /* Animation defined */
    @keyframes walk-leg-1 {
        0% { transform: rotate(-20deg); }
        100% { transform: rotate(20deg); }
    }
    @keyframes walk-leg-2 {
        0% { transform: rotate(20deg); }
        100% { transform: rotate(-20deg); }
    }
    @keyframes tail-wag {
        0% { transform: rotate(-5deg); }
        100% { transform: rotate(15deg); }
    }
    @keyframes tail-falling {
        0% { transform: rotate(-30deg); }
        100% { transform: rotate(-30deg); }
    }
    @keyframes legs-falling {
        0% { transform: rotate(10deg); }
        100% { transform: rotate(10deg); }
    }

    /* Base States */
    .cat-tail {
        transform-origin: 15px 25px;
        transition: transform 0.3s;
    }
    .cat-leg {
        transition: transform 0.3s;
    }

    /* Idle State */
    .pet-idle .cat-tail {
        animation: tail-wag 1.5s infinite alternate ease-in-out;
    }

    /* Walking State */
    .pet-walking .cat-leg-1 {
        animation: walk-leg-1 0.4s infinite alternate ease-in-out;
    }
    .pet-walking .cat-leg-2 {
        animation: walk-leg-2 0.4s infinite alternate ease-in-out;
    }
    .pet-walking .cat-tail {
        animation: tail-wag 0.8s infinite alternate ease-in-out;
    }

    /* Falling / Dragged State */
    .pet-falling .cat-tail, .pet-dragged .cat-tail {
        animation: tail-falling 0.1s forwards;
    }
    .pet-falling .cat-leg, .pet-dragged .cat-leg {
        animation: legs-falling 0.1s forwards;
    }
    
    [data-theme="dark"] .cat-color-main { fill: #E8E0D8; stroke: #E8E0D8; }
    [data-theme="dark"] .cat-color-back { stroke: #B5AFA8; }
    [data-theme="dark"] .cat-color-eye { fill: #1A1714; }

    [data-theme="light"] .cat-color-main { fill: #3D3833; stroke: #3D3833; }
    [data-theme="light"] .cat-color-back { stroke: #2C2623; }
    [data-theme="light"] .cat-color-eye { fill: #F5C842; }
</style>

<div id="virtual-pet" class="pet-idle">
    <svg class="cat-svg" viewBox="0 0 60 50">
        <!-- Tail -->
        <path class="cat-tail cat-color-main" d="M 15 25 Q 5 25 5 10" fill="none" stroke-width="5" stroke-linecap="round" />
        
        <!-- Legs (Back) -->
        <line class="cat-leg cat-leg-2 cat-color-back" x1="20" y1="30" x2="20" y2="45" stroke-width="4.5" stroke-linecap="round" style="transform-origin: 20px 30px;" />
        <line class="cat-leg cat-leg-1 cat-color-back" x1="36" y1="30" x2="36" y2="45" stroke-width="4.5" stroke-linecap="round" style="transform-origin: 36px 30px;" />
        
        <!-- Body -->
        <rect class="cat-color-main" x="15" y="20" width="28" height="16" rx="8" />
        
        <!-- Head -->
        <circle class="cat-color-main" cx="43" cy="20" r="10" />
        
        <!-- Ears -->
        <polygon class="cat-color-main" points="36,14 36,4 42,11" />
        <polygon class="cat-color-main" points="44,11 50,4 50,14" />
        
        <!-- Eyes -->
        <circle class="cat-color-eye" cx="45" cy="18" r="1.5" />
        <circle class="cat-color-eye" cx="49" cy="18" r="1.5" />

        <!-- Legs (Front) -->
        <line class="cat-leg cat-leg-1 cat-color-main" x1="16" y1="30" x2="16" y2="45" stroke-width="5" stroke-linecap="round" style="transform-origin: 16px 30px;" />
        <line class="cat-leg cat-leg-2 cat-color-main" x1="40" y1="30" x2="40" y2="45" stroke-width="5" stroke-linecap="round" style="transform-origin: 40px 30px;" />
    </svg>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const pet = document.getElementById('virtual-pet');
    if (!pet) return;

    let x = window.innerWidth / 2;
    let y = 0; // 0 means bottom of screen
    let vx = 0;
    let vy = 0;
    
    let isDragging = false;
    let lastMouseX = 0;
    let lastMouseY = 0;
    
    let state = 'idle'; // idle, walking, dragged, falling
    let walkDirection = 1; // 1 for right, -1 for left
    let walkTimer = 0;

    // Physics constants
    const GRAVITY = 0.8;
    const BOUNCE = 0.5;
    const FRICTION = 0.85;
    const WALK_SPEED = 0.6; // Much slower walking speed

    function setState(newState) {
        if (state === newState) return;
        pet.classList.remove('pet-idle', 'pet-walking', 'pet-dragged', 'pet-falling');
        pet.classList.add('pet-' + newState);
        state = newState;
    }

    function updateTransform(extraRotate = 0) {
        let scaleX = walkDirection;
        pet.style.transform = `translate(${x}px, ${-y}px) scaleX(${scaleX}) rotate(${extraRotate}deg)`;
    }

    function gameLoop() {
        if (!isDragging) {
            // Apply Gravity
            if (y > 0 || vy !== 0) {
                vy -= GRAVITY;
                y += vy;
                x += vx;

                // Floor collision
                if (y <= 0) {
                    y = 0;
                    if (Math.abs(vy) > 2) {
                        vy = -vy * BOUNCE;
                        vx *= FRICTION;
                    } else {
                        vy = 0;
                        vx *= FRICTION;
                        if (Math.abs(vx) < 0.5) vx = 0;
                        if (state === 'falling') {
                            setState('idle');
                            walkTimer = Math.random() * 100 + 50;
                        }
                    }
                }

                // Wall collision
                let petWidth = pet.offsetWidth || 60;
                if (x < 0) {
                    x = 0;
                    vx = -vx * BOUNCE;
                } else if (x > window.innerWidth - petWidth) {
                    x = window.innerWidth - petWidth;
                    vx = -vx * BOUNCE;
                }
                
                updateTransform();
            } else {
                // Ground logic (AI)
                if (state === 'idle') {
                    walkTimer--;
                    if (walkTimer <= 0) {
                        setState('walking');
                        walkDirection = Math.random() > 0.5 ? 1 : -1;
                        walkTimer = Math.random() * 300 + 150; // walks longer
                    }
                    updateTransform();
                } else if (state === 'walking') {
                    walkTimer--;
                    x += WALK_SPEED * walkDirection;

                    let petWidth = pet.offsetWidth || 60;
                    if (x < 0) {
                        x = 0;
                        walkDirection = 1;
                    } else if (x > window.innerWidth - petWidth) {
                        x = window.innerWidth - petWidth;
                        walkDirection = -1;
                    }

                    if (walkTimer <= 0) {
                        setState('idle');
                        walkTimer = Math.random() * 100 + 100; // longer idle
                    }
                    
                    updateTransform(Math.sin(walkTimer * 0.1) * 2); // very subtle wobble
                } else {
                    updateTransform();
                }
            }
        } else {
            updateTransform();
        }
        
        requestAnimationFrame(gameLoop);
    }

    // Interaction Events
    function startDrag(clientX, clientY) {
        isDragging = true;
        setState('dragged');
        
        lastMouseX = clientX;
        lastMouseY = clientY;
        
        vx = 0;
        vy = 0;
    }

    function drag(clientX, clientY) {
        if (!isDragging) return;
        
        let dx = clientX - lastMouseX;
        let dy = clientY - lastMouseY;
        
        x += dx;
        y -= dy;

        if (y < 0) y = 0;

        // Calculate velocity for throwing
        vx = dx * 0.6;
        vy = -dy * 0.6;

        lastMouseX = clientX;
        lastMouseY = clientY;
    }

    function endDrag() {
        if (!isDragging) return;
        isDragging = false;
        setState('falling');
    }

    pet.addEventListener('mousedown', (e) => {
        startDrag(e.clientX, e.clientY);
        e.preventDefault();
    });

    window.addEventListener('mousemove', (e) => {
        drag(e.clientX, e.clientY);
    });

    window.addEventListener('mouseup', () => {
        endDrag();
    });

    // Touch support
    pet.addEventListener('touchstart', (e) => {
        let touch = e.touches[0];
        startDrag(touch.clientX, touch.clientY);
        e.preventDefault();
    }, {passive: false});

    window.addEventListener('touchmove', (e) => {
        if(isDragging) {
            let touch = e.touches[0];
            drag(touch.clientX, touch.clientY);
        }
    }, {passive: false});

    window.addEventListener('touchend', () => {
        endDrag();
    });
    
    // Click / Tap interaction (Jump)
    pet.addEventListener('click', () => {
        if (y <= 5 && !isDragging) {
            vy = 12;
            vx = (Math.random() - 0.5) * 8;
            setState('falling');
        }
    });

    // Start loop
    requestAnimationFrame(gameLoop);
});
</script>
<?php /**PATH D:\Herd\webdev-frombroole\resources\views/components/pet.blade.php ENDPATH**/ ?>