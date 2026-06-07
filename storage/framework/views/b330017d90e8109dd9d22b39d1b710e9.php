<style>
    .virtual-pet {
        position: fixed;
        bottom: 0;
        left: 0;
        cursor: grab;
        user-select: none;
        z-index: 999999;
        transform-origin: center bottom;
        touch-action: none;
        will-change: transform;
        width: 60px;
        height: 50px;
    }
    .virtual-pet:active {
        cursor: grabbing;
    }
    
    .pet-svg {
        display: block;
        width: 100%;
        height: 100%;
        filter: drop-shadow(0 4px 6px rgba(0,0,0,0.2));
    }

    /* Animation defined */
    @keyframes walk-leg-1 { 0% { transform: rotate(-20deg); } 100% { transform: rotate(20deg); } }
    @keyframes walk-leg-2 { 0% { transform: rotate(20deg); } 100% { transform: rotate(-20deg); } }
    
    @keyframes tail-wag-cat { 0% { transform: rotate(-5deg); } 100% { transform: rotate(15deg); } }
    @keyframes tail-wag-dog { 0% { transform: rotate(-15deg); } 100% { transform: rotate(25deg); } }
    
    @keyframes tail-falling { 0% { transform: rotate(-30deg); } 100% { transform: rotate(-30deg); } }
    @keyframes legs-falling { 0% { transform: rotate(10deg); } 100% { transform: rotate(10deg); } }
    
    @keyframes fight-wobble {
        0% { transform: rotate(-25deg) scale(1.1); filter: contrast(1.5); }
        50% { transform: rotate(25deg) scale(0.9); filter: contrast(0.5); }
        100% { transform: rotate(-25deg) scale(1.1); filter: contrast(1.5); }
    }

    /* Base States */
    .cat-tail { transform-origin: 15px 25px; transition: transform 0.3s; }
    .dog-tail { transform-origin: 12px 25px; transition: transform 0.3s; }
    .cat-leg, .dog-leg { transition: transform 0.3s; }

    /* Idle State */
    .pet-idle .cat-tail { animation: tail-wag-cat 1.5s infinite alternate ease-in-out; }
    .pet-idle .dog-tail { animation: tail-wag-dog 1s infinite alternate ease-in-out; }

    /* Walking State */
    .pet-walking .cat-leg-1, .pet-walking .dog-leg-1 { animation: walk-leg-1 0.4s infinite alternate ease-in-out; }
    .pet-walking .cat-leg-2, .pet-walking .dog-leg-2 { animation: walk-leg-2 0.4s infinite alternate ease-in-out; }
    .pet-walking .cat-tail { animation: tail-wag-cat 0.8s infinite alternate ease-in-out; }
    .pet-walking .dog-tail { animation: tail-wag-dog 0.3s infinite alternate ease-in-out; }

    /* Falling / Dragged State */
    .pet-falling .cat-tail, .pet-dragged .cat-tail, .pet-falling .dog-tail, .pet-dragged .dog-tail { animation: tail-falling 0.1s forwards; }
    .pet-falling .cat-leg, .pet-dragged .cat-leg, .pet-falling .dog-leg, .pet-dragged .dog-leg { animation: legs-falling 0.1s forwards; }
    
    /* Fighting State */
    .pet-fighting .pet-svg {
        animation: fight-wobble 0.15s infinite;
    }

    /* Colors */
    [data-theme="dark"] .cat-color-main { fill: #E8E0D8; stroke: #E8E0D8; }
    [data-theme="dark"] .cat-color-back { stroke: #B5AFA8; }
    [data-theme="dark"] .cat-color-eye { fill: #1A1714; }

    [data-theme="light"] .cat-color-main { fill: #3D3833; stroke: #3D3833; }
    [data-theme="light"] .cat-color-back { stroke: #2C2623; }
    [data-theme="light"] .cat-color-eye { fill: #F5C842; }

    [data-theme="dark"] .dog-color-main { fill: #D4A373; stroke: #D4A373; }
    [data-theme="dark"] .dog-color-back { fill: #FAEDCD; stroke: #FAEDCD; }
    [data-theme="dark"] .dog-color-eye { fill: #1A1714; }
    [data-theme="dark"] .dog-color-nose { fill: #1A1714; }

    [data-theme="light"] .dog-color-main { fill: #B07D46; stroke: #B07D46; }
    [data-theme="light"] .dog-color-back { fill: #8A5A2B; stroke: #8A5A2B; }
    [data-theme="light"] .dog-color-eye { fill: #FFF; }
    [data-theme="light"] .dog-color-nose { fill: #1A1714; }

    /* Fight Dust Cloud */
    .fight-dust {
        position: fixed;
        width: 100px;
        height: 100px;
        background: radial-gradient(circle, rgba(200,200,200,0.8) 20%, rgba(150,150,150,0.5) 50%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
        z-index: 999998;
        transform: translate(-50%, 50%); /* 50% Y because it's positioned from bottom */
        animation: dust-anim 0.4s infinite alternate;
    }
    [data-theme="dark"] .fight-dust {
        background: radial-gradient(circle, rgba(100,100,100,0.8) 20%, rgba(50,50,50,0.5) 50%, transparent 70%);
    }
    @keyframes dust-anim {
        0% { transform: translate(-50%, 50%) scale(0.8) rotate(0deg); opacity: 0.8; }
        100% { transform: translate(-50%, 50%) scale(1.3) rotate(45deg); opacity: 1; }
    }
    .dust-spark {
        position: absolute;
        font-size: 20px;
        animation: spark-fly 0.5s ease-out forwards;
    }
    @keyframes spark-fly {
        0% { transform: translate(0, 0) scale(1) rotate(0deg); opacity: 1; }
        100% { transform: translate(var(--tx), var(--ty)) scale(0) rotate(180deg); opacity: 0; }
    }
</style>

<!-- CAT -->
<div id="virtual-cat" class="virtual-pet pet-idle">
    <svg class="pet-svg" viewBox="0 0 60 50">
        <path class="cat-tail cat-color-main" d="M 15 25 Q 5 25 5 10" fill="none" stroke-width="5" stroke-linecap="round" />
        <line class="cat-leg cat-leg-2 cat-color-back" x1="20" y1="30" x2="20" y2="45" stroke-width="4.5" stroke-linecap="round" style="transform-origin: 20px 30px;" />
        <line class="cat-leg cat-leg-1 cat-color-back" x1="36" y1="30" x2="36" y2="45" stroke-width="4.5" stroke-linecap="round" style="transform-origin: 36px 30px;" />
        <rect class="cat-color-main" x="15" y="20" width="28" height="16" rx="8" />
        <circle class="cat-color-main" cx="43" cy="20" r="10" />
        <polygon class="cat-color-main" points="36,14 36,4 42,11" />
        <polygon class="cat-color-main" points="44,11 50,4 50,14" />
        <circle class="cat-color-eye" cx="45" cy="18" r="1.5" />
        <circle class="cat-color-eye" cx="49" cy="18" r="1.5" />
        <line class="cat-leg cat-leg-1 cat-color-main" x1="16" y1="30" x2="16" y2="45" stroke-width="5" stroke-linecap="round" style="transform-origin: 16px 30px;" />
        <line class="cat-leg cat-leg-2 cat-color-main" x1="40" y1="30" x2="40" y2="45" stroke-width="5" stroke-linecap="round" style="transform-origin: 40px 30px;" />
    </svg>
</div>

<!-- DOG -->
<div id="virtual-dog" class="virtual-pet pet-idle">
    <svg class="pet-svg" viewBox="0 0 65 50">
        <path class="dog-tail dog-color-main" d="M 12 25 Q 5 15 15 5" fill="none" stroke-width="5" stroke-linecap="round" />
        <line class="dog-leg dog-leg-2 dog-color-back" x1="18" y1="30" x2="18" y2="45" stroke-width="5" stroke-linecap="round" style="transform-origin: 18px 30px;" />
        <line class="dog-leg dog-leg-1 dog-color-back" x1="38" y1="30" x2="38" y2="45" stroke-width="5" stroke-linecap="round" style="transform-origin: 38px 30px;" />
        <rect class="dog-color-main" x="12" y="20" width="34" height="18" rx="9" />
        <circle class="dog-color-main" cx="46" cy="18" r="11" />
        <ellipse class="dog-color-main" cx="54" cy="22" rx="7" ry="5" />
        <circle class="dog-color-nose" cx="59" cy="20" r="2.5" /> 
        <path class="dog-color-back" d="M 42 10 Q 32 15 38 25 Q 46 20 42 10" />
        <circle class="dog-color-eye" cx="48" cy="15" r="1.5" />
        <line class="dog-leg dog-leg-1 dog-color-main" x1="14" y1="30" x2="14" y2="45" stroke-width="5.5" stroke-linecap="round" style="transform-origin: 14px 30px;" />
        <line class="dog-leg dog-leg-2 dog-color-main" x1="42" y1="30" x2="42" y2="45" stroke-width="5.5" stroke-linecap="round" style="transform-origin: 42px 30px;" />
    </svg>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    
    class Pet {
        constructor(id, startX) {
            this.el = document.getElementById(id);
            this.id = id;
            this.x = startX;
            this.y = 0;
            this.vx = 0;
            this.vy = 0;
            this.isDragging = false;
            this.lastMouseX = 0;
            this.lastMouseY = 0;
            this.state = 'idle';
            this.walkDirection = Math.random() > 0.5 ? 1 : -1;
            this.walkTimer = 0;
            this.fightTimer = 0;
            
            this.bindEvents();
        }

        setState(newState) {
            if (this.state === newState) return;
            this.el.classList.remove('pet-idle', 'pet-walking', 'pet-dragged', 'pet-falling', 'pet-fighting');
            this.el.classList.add('pet-' + newState);
            this.state = newState;
        }

        updateTransform(extraRotate = 0) {
            let scaleX = this.walkDirection;
            this.el.style.transform = `translate(${this.x}px, ${-this.y}px) scaleX(${scaleX}) rotate(${extraRotate}deg)`;
        }

        bindEvents() {
            this.el.addEventListener('mousedown', (e) => { this.startDrag(e.clientX, e.clientY); e.preventDefault(); });
            this.el.addEventListener('touchstart', (e) => { this.startDrag(e.touches[0].clientX, e.touches[0].clientY); e.preventDefault(); }, {passive: false});
            
            this.el.addEventListener('click', () => {
                if (this.y <= 5 && !this.isDragging && this.state !== 'fighting') {
                    this.vy = 12;
                    this.vx = (Math.random() - 0.5) * 8;
                    this.setState('falling');
                }
            });
        }

        startDrag(clientX, clientY) {
            if (this.state === 'fighting') return; // Can't drag while fighting
            this.isDragging = true;
            this.setState('dragged');
            this.lastMouseX = clientX;
            this.lastMouseY = clientY;
            this.vx = 0;
            this.vy = 0;
        }

        drag(clientX, clientY) {
            if (!this.isDragging) return;
            let dx = clientX - this.lastMouseX;
            let dy = clientY - this.lastMouseY;
            
            this.x += dx;
            this.y -= dy;
            if (this.y < 0) this.y = 0;

            this.vx = dx * 0.6;
            this.vy = -dy * 0.6;

            this.lastMouseX = clientX;
            this.lastMouseY = clientY;
        }

        endDrag() {
            if (!this.isDragging) return;
            this.isDragging = false;
            this.setState('falling');
        }
    }

    const cat = new Pet('virtual-cat', window.innerWidth * 0.3);
    const dog = new Pet('virtual-dog', window.innerWidth * 0.7);
    const pets = [cat, dog];
    
    let activeDragPet = null;

    window.addEventListener('mousemove', (e) => {
        if (cat.isDragging) cat.drag(e.clientX, e.clientY);
        if (dog.isDragging) dog.drag(e.clientX, e.clientY);
    });
    window.addEventListener('mouseup', () => {
        cat.endDrag();
        dog.endDrag();
    });
    window.addEventListener('touchmove', (e) => {
        if (cat.isDragging) cat.drag(e.touches[0].clientX, e.touches[0].clientY);
        if (dog.isDragging) dog.drag(e.touches[0].clientX, e.touches[0].clientY);
    }, {passive: false});
    window.addEventListener('touchend', () => {
        cat.endDrag();
        dog.endDrag();
    });

    const GRAVITY = 0.8;
    const BOUNCE = 0.5;
    const FRICTION = 0.85;
    const WALK_SPEED = 0.5;

    let fightCloud = null;

    function spawnDustCloud(cx, cy) {
        if (fightCloud) return;
        fightCloud = document.createElement('div');
        fightCloud.className = 'fight-dust';
        fightCloud.style.left = cx + 'px';
        fightCloud.style.bottom = cy + 'px';
        document.body.appendChild(fightCloud);

        // Spawn some cartoon sparks
        let sparks = ['💢', '🗯️', '💨', '💥'];
        for(let i=0; i<6; i++) {
            let spark = document.createElement('div');
            spark.className = 'dust-spark';
            spark.innerText = sparks[Math.floor(Math.random() * sparks.length)];
            spark.style.left = '50%';
            spark.style.top = '50%';
            
            let angle = Math.random() * Math.PI * 2;
            let dist = Math.random() * 80 + 40;
            spark.style.setProperty('--tx', (Math.cos(angle)*dist) + 'px');
            spark.style.setProperty('--ty', (Math.sin(angle)*dist) + 'px');
            
            fightCloud.appendChild(spark);
        }
    }

    function removeDustCloud() {
        if (fightCloud) {
            fightCloud.remove();
            fightCloud = null;
        }
    }

    function gameLoop() {
        // Collision Detection for Fighting
        if (cat.state !== 'fighting' && dog.state !== 'fighting' && !cat.isDragging && !dog.isDragging) {
            let dx = cat.x - dog.x;
            let dy = cat.y - dog.y;
            let dist = Math.sqrt(dx*dx + dy*dy);
            
            // If they touch
            if (dist < 40) {
                cat.setState('fighting');
                dog.setState('fighting');
                cat.fightTimer = 90; // 1.5 seconds of fighting
                dog.fightTimer = 90;
                
                // Adjust positions to overlap in the cloud
                let cx = (cat.x + dog.x) / 2;
                cat.x = cx - 10;
                dog.x = cx + 10;
                
                spawnDustCloud(cx, Math.max(cat.y, dog.y) + 25);
            }
        }

        pets.forEach(pet => {
            if (pet.state === 'fighting') {
                pet.fightTimer--;
                
                // Keep them tumbling around each other
                pet.x += (Math.random() - 0.5) * 10;
                pet.y += (Math.random() - 0.5) * 10;
                if (pet.y < 0) pet.y = 0;
                
                if (fightCloud) {
                    fightCloud.style.left = ((cat.x + dog.x)/2 + 30) + 'px';
                    fightCloud.style.bottom = ((cat.y + dog.y)/2) + 'px';
                }

                pet.updateTransform();

                if (pet.fightTimer <= 0) {
                    pet.setState('falling');
                    pet.vy = 15 + Math.random() * 5;
                    // Bounce away from each other
                    if (pet.id === 'virtual-cat') {
                        pet.vx = cat.x < dog.x ? -15 : 15;
                    } else {
                        pet.vx = dog.x < cat.x ? -15 : 15;
                    }
                    removeDustCloud();
                }
                return;
            }

            if (!pet.isDragging) {
                // Physics / Gravity
                if (pet.y > 0 || pet.vy !== 0) {
                    pet.vy -= GRAVITY;
                    pet.y += pet.vy;
                    pet.x += pet.vx;

                    if (pet.y <= 0) {
                        pet.y = 0;
                        if (Math.abs(pet.vy) > 2) {
                            pet.vy = -pet.vy * BOUNCE;
                            pet.vx *= FRICTION;
                        } else {
                            pet.vy = 0;
                            pet.vx *= FRICTION;
                            if (Math.abs(pet.vx) < 0.5) pet.vx = 0;
                            if (pet.state === 'falling') {
                                pet.setState('idle');
                                pet.walkTimer = Math.random() * 100 + 50;
                            }
                        }
                    }

                    // Wall bounce
                    let petWidth = 60;
                    if (pet.x < 0) {
                        pet.x = 0;
                        pet.vx = -pet.vx * BOUNCE;
                    } else if (pet.x > window.innerWidth - petWidth) {
                        pet.x = window.innerWidth - petWidth;
                        pet.vx = -pet.vx * BOUNCE;
                    }
                    
                    pet.updateTransform();
                } else {
                    // AI Logic on ground
                    if (pet.state === 'idle') {
                        pet.walkTimer--;
                        if (pet.walkTimer <= 0) {
                            pet.setState('walking');
                            // Move towards the other pet sometimes, or random
                            let otherPet = pet.id === 'virtual-cat' ? dog : cat;
                            if (Math.random() > 0.4) {
                                pet.walkDirection = otherPet.x > pet.x ? 1 : -1;
                            } else {
                                pet.walkDirection = Math.random() > 0.5 ? 1 : -1;
                            }
                            pet.walkTimer = Math.random() * 300 + 150;
                        }
                        pet.updateTransform();
                    } else if (pet.state === 'walking') {
                        pet.walkTimer--;
                        pet.x += WALK_SPEED * pet.walkDirection;

                        let petWidth = 60;
                        if (pet.x < 0) {
                            pet.x = 0;
                            pet.walkDirection = 1;
                        } else if (pet.x > window.innerWidth - petWidth) {
                            pet.x = window.innerWidth - petWidth;
                            pet.walkDirection = -1;
                        }

                        if (pet.walkTimer <= 0) {
                            pet.setState('idle');
                            pet.walkTimer = Math.random() * 100 + 100;
                        }
                        
                        pet.updateTransform(Math.sin(pet.walkTimer * 0.1) * 2);
                    } else {
                        pet.updateTransform();
                    }
                }
            } else {
                pet.updateTransform();
            }
        });
        
        requestAnimationFrame(gameLoop);
    }

    requestAnimationFrame(gameLoop);
});
</script>
<?php /**PATH D:\Herd\webdev-frombroole\resources\views/components/pet.blade.php ENDPATH**/ ?>