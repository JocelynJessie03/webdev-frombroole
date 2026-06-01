{{-- ============================================================
     From Broole — Footer
     Usage: @include('components.footer')
     atau taruh langsung di layouts/app.blade.php sebelum </body>
================================================================ --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
{{-- ── PRE-FOOTER STRIP ── --}}
<div class="fb-footer__pre">
    <p class="fb-footer__pre-text">
        <strong>From Broole</strong> — Sweetness handcrafted just for you. Visit us in Surabaya or order online.
    </p>
    <a href="{{ route('customer.shop') }}" class="fb-footer__pre-btn">Order Now →</a>
</div>

{{-- ── MAIN FOOTER ── --}}
<footer class="fb-footer">
    <div class="fb-footer__main">

        {{-- BRAND --}}
        <div class="fb-footer__brand">
            <div class="fb-footer__brand-name">From Broole</div>
            <div class="fb-footer__brand-sub">Artisan Desserts</div>
            <p class="fb-footer__brand-desc">
                We transform the humble crème brûlée into a modern artisan
                experience — one perfectly caramelized crust at a time.
            </p>
            <div class="fb-footer__socials">
                <a href="https://instagram.com/frombroole" target="_blank" class="fb-footer__social" aria-label="Instagram">
                    <i class="ti ti-brand-instagram" aria-hidden="true"></i>
                </a>
                <a href="https://tiktok.com/@frombroole" target="_blank" class="fb-footer__social" aria-label="TikTok">
                    <i class="ti ti-brand-tiktok" aria-hidden="true"></i>
                </a>
                <a href="https://wa.me/6281234567890" target="_blank" class="fb-footer__social" aria-label="WhatsApp">
                    <i class="ti ti-brand-whatsapp" aria-hidden="true"></i>
                </a>
                
            </div>
        </div>

        {{-- EXPLORE --}}
        <div class="fb-footer__col">
            <div class="fb-footer__col-title">Explore</div>
            <nav class="fb-footer__links">
                <a href="{{ route('customer.home') }}" class="fb-footer__link">Home</a>
                <a href="{{ route('customer.about') }}" class="fb-footer__link">About Us</a>
                <a href="{{ route('customer.shop') }}" class="fb-footer__link">Our Menu</a>
                <a href="{{ route('customer.transactions_history') }}" class="fb-footer__link">Transaction History</a>
                <a href="{{ route('customer.contact') }}" class="fb-footer__link">Contact</a>
            </nav>
        </div>
        

        {{-- MENU --}}
        <div class="fb-footer__col">
            <div class="fb-footer__col-title">Our Menu</div>
            <nav class="fb-footer__links">
                <a href="{{ route('customer.shop', ['category' => 1]) }}" class="fb-footer__link">Signature Broole</a>
                <a href="{{ route('customer.shop', ['category' => 3]) }}" class="fb-footer__link">Burnt Cheesecake</a>
                <a href="{{ route('customer.shop', ['category' => 2]) }}" class="fb-footer__link">Craft Drinks</a>
            </nav>
        </div>

        {{-- FIND US --}}
        <div class="fb-footer__col">
            <div class="fb-footer__col-title">Find Us</div>
            <div class="fb-footer__contact-item">
                <i class="ti ti-map-pin fb-footer__contact-icon" aria-hidden="true"></i>
                <span class="fb-footer__contact-text">Jl. Made No. 12,<br>Surabaya, East Java</span>
            </div>
            <div class="fb-footer__contact-item">
                <i class="ti ti-clock fb-footer__contact-icon" aria-hidden="true"></i>
                <span class="fb-footer__contact-text">Mon – Sun<br>10:00 – 22:00 WIB</span>
            </div>
            <div class="fb-footer__contact-item">
                <i class="ti ti-brand-whatsapp fb-footer__contact-icon" aria-hidden="true"></i>
                <span class="fb-footer__contact-text">+62 812-3456-7890</span>
            </div>
            <div class="fb-footer__contact-item">
                <i class="ti ti-mail fb-footer__contact-icon" aria-hidden="true"></i>
                <span class="fb-footer__contact-text">hello@frombroole.com</span>
            </div>
        </div>

        
       

    </div>{{-- /.fb-footer__main --}}

    {{-- BOTTOM BAR --}}
    <div class="fb-footer__bottom">
        <p class="fb-footer__copy">
            &copy; {{ date('Y') }} From Broole. Made with 🔥 in Surabaya.
        </p>
        <div class="fb-footer__bottom-links">
            <a href="#" class="fb-footer__bottom-link">Privacy Policy</a>
            <a href="#" class="fb-footer__bottom-link">Terms of Service</a>
            <a href="#" class="fb-footer__bottom-link">Refund Policy</a>
        </div>
        <div class="fb-footer__halal-badge">
            <div class="fb-footer__halal-dot">✓</div>
            100% Halal Certified
        </div>
    </div>

</footer>


{{-- ============================================================ STYLES ── --}}
<style>
/* ─── TOKENS (skip jika sudah ada di about.blade.php / app layout) ─── */
:root {
    --red: #B81C1C; --red-deep: #6B0F1A; --red-mid: #8C1717;
    --cream: #FAF3E8; --cream2: #F2E8D4;
    --gold: #C9A84C; --gold-lt: #F2D6A2;
    --text: #1A0E08; --muted: #7A6A58; --white: #FFFCF7;
    --serif: 'Cormorant Garamond', Georgia, serif;
    --sans: 'Outfit', sans-serif;
}

/* ─── PRE-FOOTER ─── */
.fb-footer__pre {
    background: var(--red-deep);
    display: flex; align-items: center; justify-content: space-between;
    padding: 1.4rem 5rem; gap: 2rem;
}
.fb-footer__pre-text {
    font-family: var(--sans); font-size: .72rem;
    font-weight: 300; letter-spacing: .06em; color: rgba(255,255,255,.7);
}
.fb-footer__pre-text strong { color: #fff; font-weight: 600; }
.fb-footer__pre-btn {
    display: inline-flex; align-items: center; gap: .5rem;
    padding: .65rem 1.8rem;
    font-family: var(--sans); font-size: .65rem; font-weight: 600;
    letter-spacing: .14em; text-transform: uppercase;
    background: var(--gold); color: var(--text);
    border: none; cursor: pointer; text-decoration: none; white-space: nowrap;
    transition: opacity .2s;
}
.fb-footer__pre-btn:hover { opacity: .85; }

/* ─── FOOTER MAIN ─── */
.fb-footer {
    font-family: var(--sans);
    background: var(--text);
    color: rgba(255,255,255,.55);
}
.fb-footer__main {
    padding: 4rem 5rem 3rem;
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr;
    gap: 3rem;
}

/* Brand column */
.fb-footer__brand-name {
    font-family: var(--serif); font-size: 1.6rem;
    font-weight: 700; color: #fff; line-height: 1; margin-bottom: .25rem;
}
.fb-footer__brand-sub {
    font-size: .5rem; font-weight: 500; letter-spacing: .22em;
    text-transform: uppercase; color: var(--gold); margin-bottom: 1.2rem;
}
.fb-footer__brand-desc {
    font-size: .78rem; font-weight: 300; line-height: 1.85;
    color: rgba(255,255,255,.45); margin-bottom: 1.4rem; max-width: 270px;
}
.fb-footer__socials { display: flex; gap: .6rem; }
.fb-footer__social {
    width: 34px; height: 34px; border-radius: 50%;
    border: 1px solid rgba(255,255,255,.12);
    display: flex; align-items: center; justify-content: center;
    font-size: .9rem; color: rgba(255,255,255,.5);
    text-decoration: none; cursor: pointer; transition: .2s;
}
.fb-footer__social:hover { border-color: var(--gold); color: var(--gold); }

/* Nav columns */
.fb-footer__col-title {
    font-size: .58rem; font-weight: 600; letter-spacing: .22em;
    text-transform: uppercase; color: rgba(255,255,255,.35);
    margin-bottom: 1.1rem;
}
.fb-footer__col-title::before {
    content: ''; display: block; width: 16px; height: 1.5px;
    background: var(--gold); margin-bottom: .55rem;
}
.fb-footer__links { display: flex; flex-direction: column; gap: .5rem; }
.fb-footer__link {
    font-size: .75rem; font-weight: 300;
    color: rgba(255,255,255,.48); text-decoration: none;
    transition: color .2s, padding-left .2s; cursor: pointer;
}
.fb-footer__link:hover { color: rgba(255,255,255,.9); padding-left: 3px; }

/* Contact column */
.fb-footer__contact-item {
    display: flex; align-items: flex-start;
    gap: .65rem; margin-bottom: .7rem;
}
.fb-footer__contact-icon {
    font-size: .9rem; margin-top: 1px;
    color: var(--gold); flex-shrink: 0;
}
.fb-footer__contact-text {
    font-size: .75rem; font-weight: 300;
    line-height: 1.6; color: rgba(255,255,255,.48);
}

/* Newsletter strip */
.fb-footer__newsletter {
    grid-column: 1 / -1;
    display: flex; align-items: center; justify-content: space-between;
    gap: 2rem; padding: 2rem 3rem;
    border-radius: 10px;
    background: rgba(255,255,255,.04);
    border: 1px solid rgba(255,255,255,.07);
}
.fb-footer__nl-title {
    font-family: var(--serif); font-size: 1.5rem;
    font-weight: 600; color: #fff; line-height: 1; margin-bottom: .35rem;
}
.fb-footer__nl-sub { font-size: .72rem; font-weight: 300; color: rgba(255,255,255,.4); }
.fb-footer__nl-form { display: flex; gap: .5rem; flex-shrink: 0; }
.fb-footer__nl-input {
    padding: .65rem 1.1rem; font-family: var(--sans); font-size: .72rem;
    background: rgba(255,255,255,.07);
    border: 1px solid rgba(255,255,255,.12);
    color: #fff; outline: none; width: 230px;
}
.fb-footer__nl-input::placeholder { color: rgba(255,255,255,.28); }
.fb-footer__nl-input:focus { border-color: rgba(201,168,76,.5); }
.fb-footer__nl-btn {
    padding: .65rem 1.4rem;
    font-family: var(--sans); font-size: .65rem; font-weight: 600;
    letter-spacing: .12em; text-transform: uppercase;
    background: var(--gold); color: var(--text);
    border: none; cursor: pointer; transition: opacity .2s; white-space: nowrap;
}
.fb-footer__nl-btn:hover { opacity: .85; }

/* Bottom bar */
.fb-footer__bottom {
    border-top: 1px solid rgba(255,255,255,.07);
    padding: 1.4rem 5rem;
    display: flex; align-items: center; justify-content: space-between;
}
.fb-footer__copy {
    font-size: .62rem; font-weight: 300; color: rgba(255,255,255,.28);
}
.fb-footer__bottom-links { display: flex; gap: 1.8rem; }
.fb-footer__bottom-link {
    font-size: .62rem; font-weight: 300;
    color: rgba(255,255,255,.28); text-decoration: none;
    cursor: pointer; transition: color .2s;
}
.fb-footer__bottom-link:hover { color: rgba(255,255,255,.6); }
.fb-footer__halal-badge {
    display: flex; align-items: center; gap: .5rem;
    font-size: .6rem; font-weight: 500;
    letter-spacing: .1em; text-transform: uppercase;
    color: rgba(255,255,255,.28);
}
.fb-footer__halal-dot {
    width: 22px; height: 22px; border-radius: 50%;
    border: 1.5px solid rgba(201,168,76,.4);
    display: flex; align-items: center; justify-content: center;
    font-size: .6rem; color: var(--gold);
}
</style>


{{-- ============================================================ SCRIPTS ── --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const btn   = document.getElementById('footer-subscribe-btn');
    const input = document.getElementById('footer-email');
    if (!btn || !input) return;

    btn.addEventListener('click', () => {
        const email = input.value.trim();
        if (!email || !email.includes('@')) {
            input.style.borderColor = 'rgba(184,28,28,.6)';
            input.focus();
            return;
        }
        input.style.borderColor = 'rgba(201,168,76,.5)';
        btn.textContent   = 'Subscribed ✓';
        btn.style.opacity = '.6';
        btn.disabled      = true;
        input.value       = '';
        // TODO: kirim ke backend — fetch('/newsletter/subscribe', { method: 'POST', body: JSON.stringify({ email }), headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content } })
    });
});
</script>