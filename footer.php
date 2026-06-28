<?php
/**
 * scmlondon new — site footer + page scripts.
 */
$theme_uri = get_template_directory_uri();
?>
<!-- ── Footer ───────────────────────────────────────────────── -->
<footer class="footer">
    <div class="container">
        <div class="footer-grid">

            <div>
                <div class="footer-brand">
                    <img src="<?php echo esc_url( $theme_uri . '/images/scm_erb.png' ); ?>" alt="SCM erb" onerror="this.style.display='none'">
                    <span class="footer-brand-name">Slovenská katolícka<br>misia v Londýne</span>
                </div>
                <p>
                    Slovenská katolícka misia v Londýne (SCM) bola oficiálne založená Westminsterskou diecézou v roku 2010.
                    SCM je súčasťou diecézy Westminster registrovanou pod číslom charity: <strong style="color:rgba(255,255,255,0.8)">233699</strong>.
                </p>
                <div class="footer-social">
                    <a href="https://www.facebook.com/groups/1761853480726596/" target="_blank" rel="noopener" aria-label="Facebook">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
                    </a>
                </div>
            </div>

            <div class="footer-col">
                <h4>Kontakt</h4>
                <div class="footer-contact-row">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/>
                    </svg>
                    <span>14 Melior Street, SE1 3QP</span>
                </div>
                <div class="footer-contact-row">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                        <polyline points="22,6 12,13 2,6"/>
                    </svg>
                    <a href="mailto:info@scmlondon.org" style="color:rgba(255,255,255,0.6)">info@scmlondon.org</a>
                </div>
                <div style="margin-top:18px;">
                    <a href="mailto:info@scmlondon.org" class="btn-primary" style="width:auto;padding:8px 16px;font-size:0.8rem;">Napísať nám</a>
                </div>
            </div>

        </div>

        <div class="footer-bottom">
            <p>© <?php echo esc_html( date( 'Y' ) ); ?> Slovenská katolícka misia v Londýne. Diocese of Westminster, Charity No. 233699.</p>
            <div class="footer-bottom-links">
                <a href="https://rcdow.org.uk/privacy/" target="_blank" rel="noopener">Privacy &amp; Cookies</a>
                <a href="https://rcdow.org.uk/safeguarding/" target="_blank" rel="noopener">Safeguarding</a>
                <a href="<?php echo esc_url( wp_login_url() ); ?>">Prihlásenie</a>
            </div>
        </div>
    </div>
</footer>

<!-- Google Translate API -->
<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" async></script>

<script>
/* Theme URI for any JS that needs to reference theme assets. */
window.SCM_THEME_URI = <?php echo wp_json_encode( $theme_uri ); ?>;

/* ═══════════════════════════════════════
   SLIDESHOW
═══════════════════════════════════════ */
const track  = document.getElementById('heroTrack');
const dotsEl = document.getElementById('heroDots');
const SLIDES = document.querySelectorAll('.hero-slide');
let cur = 0, timer;

SLIDES.forEach((_, i) => {
    const d = document.createElement('button');
    d.className = 'hero-dot' + (i === 0 ? ' active' : '');
    d.setAttribute('aria-label', 'Snímka ' + (i + 1));
    d.onclick = () => slideTo(i);
    dotsEl.appendChild(d);
});

function slideTo(n) {
    cur = ((n % SLIDES.length) + SLIDES.length) % SLIDES.length;
    track.style.transform = 'translateX(-' + (cur * 100) + '%)';
    document.querySelectorAll('#heroDots .hero-dot').forEach((d, i) =>
        d.classList.toggle('active', i === cur));
    clearInterval(timer);
    timer = setInterval(() => slideTo(cur + 1), 5500);
}
slideTo(0);


/* ═══════════════════════════════════════
   CALENDAR
═══════════════════════════════════════ */
const SK_MONTHS = ['Január','Február','Marec','Apríl','Máj','Jún',
                   'Júl','August','September','Október','November','December'];

const EVENTS = {
    '2026-04-16': [{ time:'11:00', title:'Biela nedeľa – sv. omša', desc:'Velehrad, London' }],
    '2026-04-18': [
        { time:'10:00', title:'Stretnutie mládeže', desc:'Farská miestnosť' },
        { time:'19:00', title:'Biblický krúžok', desc:'Online' }
    ],
    '2026-04-20': [{ time:'11:00', title:'Nedeľná sv. omša', desc:'Velehrad, London' }],
    '2026-04-22': [{ time:'19:00', title:'Biblický krúžok', desc:'Online' }],
    '2026-04-25': [
        { time:'14:00', title:'Stretnutie rodín', desc:'Farská záhrada' },
        { time:'19:00', title:'Večeradlo', desc:'Velehrad' }
    ],
    '2026-04-27': [{ time:'11:00', title:'Nedeľná sv. omša', desc:'Velehrad, London' }],
    '2026-04-29': [{ time:'19:00', title:'Biblický krúžok', desc:'Online' }],
    '2026-05-03': [{ time:'11:00', title:'Nedeľná sv. omša', desc:'Velehrad' }],
    '2026-05-10': [{ time:'14:00', title:'Farský výlet', desc:'Miesto: TBD' }],
    '2026-05-17': [{ time:'11:00', title:'Nedeľná sv. omša + agapé', desc:'Velehrad' }],
};

const NOW = new Date();
let calY = NOW.getFullYear(), calM = NOW.getMonth();

function pad(n) { return String(n).padStart(2,'0'); }

function renderCal() {
    document.getElementById('calLabel').textContent = SK_MONTHS[calM] + ' ' + calY;
    const body = document.getElementById('calBody');
    body.innerHTML = '';

    const firstDow = (new Date(calY, calM, 1).getDay() + 6) % 7;
    const daysInM  = new Date(calY, calM + 1, 0).getDate();

    let cells = 0, row = document.createElement('tr');

    for (let i = 0; i < firstDow; i++) {
        row.appendChild(mkCell('', true));
        cells++;
    }

    for (let d = 1; d <= daysInM; d++) {
        const key      = calY + '-' + pad(calM + 1) + '-' + pad(d);
        const isToday  = calY === NOW.getFullYear() && calM === NOW.getMonth() && d === NOW.getDate();
        const hasEv    = !!EVENTS[key];
        const isSunday = new Date(calY, calM, d).getDay() === 0;

        let cls = 'cal-day';
        if (isSunday) cls += ' is-sunday';
        if (isToday)  cls += ' today';
        if (hasEv)    cls += ' has-ev';

        const td  = document.createElement('td');
        const div = document.createElement('div');
        div.className = cls;
        div.textContent = d;
        if (hasEv) {
            div.setAttribute('role', 'button');
            div.setAttribute('tabindex', '0');
            div.onclick = (e) => showPopup(key, d, e.currentTarget);
            div.onkeydown = (e) => { if (e.key === 'Enter') showPopup(key, d, e.currentTarget); };
        }
        td.appendChild(div);
        row.appendChild(td);
        cells++;

        if (cells % 7 === 0 && d < daysInM) {
            body.appendChild(row);
            row = document.createElement('tr');
        }
    }

    if (cells % 7 !== 0) {
        for (let i = 0, rem = 7 - (cells % 7); i < rem; i++) {
            row.appendChild(mkCell('', true));
        }
    }
    body.appendChild(row);
}

function mkCell(text, empty) {
    const td = document.createElement('td');
    const div = document.createElement('div');
    div.className = 'cal-day' + (empty ? ' empty' : '');
    div.textContent = text || '·';
    td.appendChild(div);
    return td;
}

function changeMonth(delta) {
    calM += delta;
    if (calM > 11) { calM = 0; calY++; }
    if (calM < 0)  { calM = 11; calY--; }
    renderCal();
    closePopup();
}

function showPopup(key, day, el) {
    const popup = document.getElementById('evPopup');
    const body  = document.getElementById('evPopupBody');
    document.getElementById('evPopupDate').textContent = day + '. ' + SK_MONTHS[calM] + ' ' + calY;

    body.innerHTML = (EVENTS[key] || []).map(e =>
        '<div class="ev-item">' +
        '<div class="ev-time">' + e.time + '</div>' +
        '<div class="ev-title">' + e.title + '</div>' +
        '<div class="ev-desc">' + e.desc + '</div>' +
        '</div>'
    ).join('');

    const r = el.getBoundingClientRect();
    const W = 296;
    let left = r.right + 10;
    let top  = r.top;

    if (left + W > window.innerWidth - 12) left = r.left - W - 10;
    if (top + 260 > window.innerHeight - 12) top = window.innerHeight - 272;

    popup.style.left = left + 'px';
    popup.style.top  = top  + 'px';
    popup.classList.add('show');
}

function closePopup() {
    document.getElementById('evPopup').classList.remove('show');
}

document.addEventListener('click', function(e) {
    const popup = document.getElementById('evPopup');
    if (popup.classList.contains('show') &&
        !popup.contains(e.target) &&
        !e.target.classList.contains('has-ev')) {
        closePopup();
    }
});

renderCal();


/* ═══════════════════════════════════════
   CARDS SLIDESHOW
═══════════════════════════════════════ */
let cardIdx = 0;
const TOTAL_CARDS = 4;

function getVisible() { return window.innerWidth <= 768 ? 1 : 2; }

function buildDots() {
    const count = TOTAL_CARDS - getVisible() + 1;
    const container = document.getElementById('cardsDots');
    if (!container) return;
    container.innerHTML = '';
    for (let i = 0; i < count; i++) {
        const btn = document.createElement('button');
        btn.className = 'hero-dot' + (i === cardIdx ? ' active' : '');
        btn.setAttribute('aria-label', 'Snímka ' + (i + 1));
        btn.onclick = () => gotoCard(i);
        container.appendChild(btn);
    }
}

function slideCards(delta) {
    const vis = getVisible();
    const cardsTrack = document.getElementById('cardsTrack');
    const firstCard = cardsTrack && cardsTrack.querySelector('.card');
    if (!cardsTrack || !firstCard) return;
    cardIdx = Math.max(0, Math.min(cardIdx + delta, TOTAL_CARDS - vis));
    const step = firstCard.offsetWidth + 18;
    cardsTrack.style.transform = 'translateX(-' + (cardIdx * step) + 'px)';
    const prev = document.getElementById('cardsPrev');
    const next = document.getElementById('cardsNext');
    if (prev) prev.disabled = cardIdx === 0;
    if (next) next.disabled = cardIdx >= TOTAL_CARDS - vis;
    document.querySelectorAll('#cardsDots .hero-dot').forEach((d, i) =>
        d.classList.toggle('active', i === cardIdx));
}

function gotoCard(n) { slideCards(n - cardIdx); }

window.addEventListener('resize', () => { cardIdx = 0; buildDots(); slideCards(0); });

buildDots();
slideCards(0);


/* ═══════════════════════════════════════
   MOBILE NAV
═══════════════════════════════════════ */
function toggleNav() {
    document.getElementById('navLinks').classList.toggle('open');
}

/* On mobile, tapping a menu item that has a sub-menu expands it
   instead of navigating straight away (first tap opens, link still
   reachable via its own entry). Desktop uses CSS hover, untouched. */
document.addEventListener('click', function (e) {
    if (window.innerWidth > 768) return;
    var link = e.target.closest('.nav-links .menu-item-has-children > a, .nav-links .page_item_has_children > a');
    if (!link) return;
    var li = link.parentElement;
    if (!li.classList.contains('open')) {
        e.preventDefault();
        li.classList.add('open');
    }
});


/* ═══════════════════════════════════════
   GALLERY
═══════════════════════════════════════ */
<?php
/*
 * Lightbox images come from the same WordPress "Master Home Gallery" source as
 * the front-page grid, in the same order (so openLightbox(i) lines up). Falls
 * back to the bundled theme images when the gallery is empty/unavailable.
 */
$lb_images = function_exists( 'scm_get_master_gallery_images' ) ? scm_get_master_gallery_images() : array();
$lb_urls   = array();
if ( ! empty( $lb_images ) ) {
    foreach ( $lb_images as $lb_img ) {
        $lb_urls[] = $lb_img['full'];
    }
} else {
    for ( $g = 1; $g <= 7; $g++ ) {
        $lb_urls[] = $theme_uri . '/images/gallery' . $g . '.jpg';
    }
}
?>
const GALLERY_IMGS = <?php echo wp_json_encode( $lb_urls ); ?>;

let galleryPageIdx = 0;

function getGalleryPageCount() {
    return document.querySelectorAll('.gallery-right-page').length;
}
function buildGalleryDots() {
    const count = getGalleryPageCount();
    const container = document.getElementById('galleryDots');
    if (!container) return;
    container.innerHTML = '';
    for (let i = 0; i < count; i++) {
        const btn = document.createElement('button');
        btn.className = 'hero-dot' + (i === galleryPageIdx ? ' active' : '');
        btn.setAttribute('aria-label', 'Strana ' + (i + 1));
        btn.onclick = () => galleryGoTo(i);
        container.appendChild(btn);
    }
}
function galleryGoTo(n) {
    const inner = document.getElementById('galleryRightInner');
    if (!inner) return;
    const total = getGalleryPageCount();
    galleryPageIdx = Math.max(0, Math.min(n, total - 1));
    const pageW = inner.parentElement.offsetWidth;
    inner.style.transform = 'translateX(-' + (galleryPageIdx * pageW) + 'px)';
    const prev = document.getElementById('galleryNavPrev');
    const next = document.getElementById('galleryNavNext');
    if (prev) prev.disabled = galleryPageIdx === 0;
    if (next) next.disabled = galleryPageIdx >= total - 1;
    document.querySelectorAll('#galleryDots .hero-dot').forEach((d, i) =>
        d.classList.toggle('active', i === galleryPageIdx));
}
function galleryRightNav(delta) { galleryGoTo(galleryPageIdx + delta); }
buildGalleryDots();
galleryGoTo(0);

/* Lightbox */
let lbIdx = 0;
function openLightbox(i) {
    lbIdx = i;
    updateLightbox();
    document.getElementById('lightbox').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeLightbox() {
    document.getElementById('lightbox').classList.remove('open');
    document.body.style.overflow = '';
}
function lbNav(delta) {
    lbIdx = ((lbIdx + delta) + GALLERY_IMGS.length) % GALLERY_IMGS.length;
    updateLightbox();
}
function updateLightbox() {
    document.getElementById('lightboxImg').src = GALLERY_IMGS[lbIdx];
    document.getElementById('lightboxCounter').textContent = (lbIdx + 1) + ' / ' + GALLERY_IMGS.length;
}
document.addEventListener('keydown', function(e) {
    if (!document.getElementById('lightbox').classList.contains('open')) return;
    if (e.key === 'Escape') closeLightbox();
    if (e.key === 'ArrowLeft') lbNav(-1);
    if (e.key === 'ArrowRight') lbNav(1);
});


/* ═══════════════════════════════════════
   GOOGLE TRANSLATE
═══════════════════════════════════════ */
function toggleTranslate() {
    const btn = document.getElementById('btn-translate');
    if (!btn) return;

    if (btn.dataset.lang === 'en') {
        // Currently English -> revert to the original Slovak.
        // The googtrans cookie is cleared on load, so reloading
        // brings the page back in its default language.
        location.reload();
        return;
    }

    // Default Slovak -> translate the whole site to English (live, no reload).
    const attempt = () => {
        const sel = document.querySelector('.goog-te-combo');
        if (sel) {
            sel.value = 'en';
            sel.dispatchEvent(new Event('change'));
        } else {
            setTimeout(attempt, 350);
        }
    };
    attempt();

    // Flip the button to its "SK / back to Slovak" state.
    btn.dataset.lang = 'en';
    btn.querySelector('.flag-en').style.display = 'none';
    btn.querySelector('.flag-sk').style.display = 'block';
    btn.querySelector('.lang-label').textContent = 'SK';
    btn.title = 'Zobraziť pôvodný jazyk (slovenčina)';
}
</script>

<?php wp_footer(); ?>
</body>
</html>
