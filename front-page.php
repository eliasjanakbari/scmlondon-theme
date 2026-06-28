<?php
/**
 * scmlondon new — front page template.
 * Hero, news/sidebar layout, gallery, recommendations, lightbox, event popup.
 * Content here is intentionally static for v1; it will be wired to WP queries
 * (news, bulletin, events, gallery) in subsequent passes.
 */
get_header();
$theme_uri = get_template_directory_uri();
?>

<!-- ── Hero Slideshow ────────────────────────────────────────── -->
<section class="hero" aria-label="Fotogaléria">
    <div class="hero-track" id="heroTrack">

        <div class="hero-slide">
            <img src="<?php echo esc_url( $theme_uri . '/images/slide1.jpg' ); ?>" alt="Komunita Slovenskej katolíckej misie v Londýne"
                 onerror="this.style.display='none'">
            <div class="hero-overlay"></div>
        </div>

        <div class="hero-slide">
            <img src="<?php echo esc_url( $theme_uri . '/images/slide2.jpg' ); ?>" alt="Sv. omša – Velehrad London"
                 onerror="this.style.display='none'">
            <div class="hero-overlay"></div>
        </div>

        <div class="hero-slide">
            <img src="<?php echo esc_url( $theme_uri . '/images/slide3.jpg' ); ?>" alt="Slovenská komunita v Londýne"
                 onerror="this.style.display='none'">
            <div class="hero-overlay"></div>
        </div>

    </div>

    <div class="hero-caption">
        <h1>Vitajte v Slovenskej katolíckej misii</h1>
        <p>Velehrad London · Spoločenstvo slovenských a českých katolíkov</p>
    </div>

    <button class="hero-arrow hero-prev" onclick="slideTo(cur - 1)" aria-label="Predchádzajúci">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="15 18 9 12 15 6"/>
        </svg>
    </button>
    <button class="hero-arrow hero-next" onclick="slideTo(cur + 1)" aria-label="Nasledujúci">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="9 18 15 12 9 6"/>
        </svg>
    </button>
    <div class="hero-dots" id="heroDots"></div>
</section>

<!-- ── Main Content ──────────────────────────────────────────── -->
<main class="main">
    <div class="container">
        <div class="layout">

            <!-- ── News ──────────────────────────────────── -->
            <section>
                <h2 class="section-label">Správy</h2>

                <div class="news-grid">

                    <?php
                    $pinned_news = scm_get_pinned_news( 5 );
                    $featured    = ! empty( $pinned_news ) ? array_shift( $pinned_news ) : null;
                    ?>

                    <?php if ( $featured ) : ?>
                    <!-- Featured -->
                    <article class="card featured">
                        <?php scm_render_news_card( $featured, 'h2' ); ?>
                    </article>
                    <?php endif; ?>

                    <?php if ( ! empty( $pinned_news ) ) : ?>
                    <div class="cards-slideshow-outer">
                        <div class="cards-overflow">
                                <div class="cards-track" id="cardsTrack">

                                    <?php foreach ( $pinned_news as $news_post ) : ?>
                                    <article class="card">
                                        <?php scm_render_news_card( $news_post, 'h3' ); ?>
                                    </article>
                                    <?php endforeach; ?>

                                </div>
                        </div>

                        <div class="cards-controls">
                            <button class="cards-arrow" id="cardsPrev" onclick="slideCards(-1)" aria-label="Predchádzajúce">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                            </button>
                            <div class="cards-dots" id="cardsDots"></div>
                            <button class="cards-arrow" id="cardsNext" onclick="slideCards(1)" aria-label="Nasledujúce">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                            </button>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- NEDEĽNÉ OZNAMY — full width, bottom row -->
                    <article class="card bulletin-card">
                        <div class="bulletin-header">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                                <polyline points="14 2 14 8 20 8"/>
                                <line x1="16" y1="13" x2="8" y2="13"/>
                                <line x1="16" y1="17" x2="8" y2="17"/>
                                <polyline points="10 9 9 9 8 9"/>
                            </svg>
                            <div class="bulletin-header-text">
                                <div class="title">Nedeľné oznamy</div>
                                <div class="sub">Farský bulletin · PDF</div>
                            </div>
                        </div>
                        <div class="bulletin-body">
                            <a href="oznamy/oznamy-2026-04-26.pdf" class="bulletin-latest" target="_blank" rel="noopener" title="Otvoriť bulletin 26. 4. 2026">
                                <div class="bulletin-latest-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                                        <polyline points="14 2 14 8 20 8"/>
                                    </svg>
                                </div>
                                <div class="bulletin-latest-info">
                                    <span class="bdate">26. apríla 2026</span>
                                    <span class="blabel">Najnovšie vydanie</span>
                                </div>
                                <div class="bulletin-dl-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/>
                                        <polyline points="7 10 12 15 17 10"/>
                                        <line x1="12" y1="15" x2="12" y2="3"/>
                                    </svg>
                                </div>
                            </a>

                            <div class="bulletin-prev-section">
                            <p class="bulletin-prev-label">Predchádzajúce vydania</p>
                            <div class="bulletin-prev-list">
                                <a href="oznamy/oznamy-2026-04-19.pdf" class="bulletin-prev-item" target="_blank" rel="noopener">
                                    <span class="bpdate">19. apríla 2026</span>
                                    <span class="bpdl">
                                        PDF
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                                    </span>
                                </a>
                                <a href="oznamy/oznamy-2026-04-12.pdf" class="bulletin-prev-item" target="_blank" rel="noopener">
                                    <span class="bpdate">12. apríla 2026</span>
                                    <span class="bpdl">
                                        PDF
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                                    </span>
                                </a>
                                <a href="oznamy/oznamy-2026-04-05.pdf" class="bulletin-prev-item" target="_blank" rel="noopener">
                                    <span class="bpdate">5. apríla 2026</span>
                                    <span class="bpdl">
                                        PDF
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                                    </span>
                                </a>
                            </div>
                            </div>
                        </div>
                    </article>

                </div>

            </section>

            <!-- ── Sidebar ────────────────────────────────── -->
            <aside class="sidebar">

                <div class="s-card">
                    <div class="s-card-head">
                        <h3>Kalendár podujatí</h3>
                    </div>
                    <div class="s-card-body">
                        <div class="cal-nav">
                            <button class="cal-nav-btn" onclick="changeMonth(-1)" aria-label="Predchádzajúci mesiac">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                            </button>
                            <span class="cal-month" id="calLabel"></span>
                            <button class="cal-nav-btn" onclick="changeMonth(1)" aria-label="Nasledujúci mesiac">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                            </button>
                        </div>
                        <table class="cal-table">
                            <thead>
                                <tr><th>Po</th><th>Ut</th><th>St</th><th>Št</th><th>Pi</th><th>So</th><th>Ne</th></tr>
                            </thead>
                            <tbody id="calBody"></tbody>
                        </table>
                        <div class="cal-legend" style="gap:10px;flex-wrap:wrap;">
                            <span style="display:flex;align-items:center;gap:4px;">
                                <div class="cal-legend-dot sunday"></div>
                                Nedeľná omša
                            </span>
                            <span style="display:flex;align-items:center;gap:4px;">
                                <div class="cal-legend-dot"></div>
                                Podujatia
                            </span>
                        </div>
                    </div>
                </div>

                <div class="s-card">
                    <div class="s-card-head">
                        <h3>Časy sv. omší</h3>
                    </div>
                    <div class="s-card-body">
                        <ul class="mass-list">
                            <li><span class="day">Nedeľa (SK)</span><span class="time">11:00</span></li>
                            <li><span class="day">Nedeľa (EN)</span><span class="time">09:30</span></li>
                            <li><span class="day">Streda</span><span class="time">19:00</span></li>
                            <li><span class="day">Sviatky</span><span class="time">podľa programu</span></li>
                        </ul>
                        <a href="#" class="btn-primary" style="margin-top:14px;">Celý program bohoslužieb</a>
                    </div>
                </div>

                <div class="s-card">
                    <div class="s-card-head">
                        <h3>Registrácia farníka</h3>
                    </div>
                    <div class="s-card-body">
                        <p style="font-size:0.84rem;color:var(--text-mid);margin-bottom:12px;line-height:1.55;">
                            Zaregistrujte sa ako člen SCM po príchode do UK. Registrácia je nevyhnutná pre prístup k sviatostiam a cirkevným dokumentom.
                        </p>
                        <a href="#" class="btn-primary">Zaregistrovať sa</a>
                    </div>
                </div>

            </aside>
        </div>

        <!-- ── Galéria fotografií ───────────────────────────── -->
        <?php
        /*
         * Pull images from the WordPress "Master Home Gallery" (Robo Gallery).
         * If it's empty/unavailable, fall back to the bundled theme images so
         * the section is never broken. The first image is the large "featured"
         * tile; the rest are paged 4-at-a-time in the grid on the right.
         */
        $gallery_images = function_exists( 'scm_get_master_gallery_images' ) ? scm_get_master_gallery_images() : array();

        if ( empty( $gallery_images ) ) {
            $gallery_images = array();
            for ( $g = 1; $g <= 7; $g++ ) {
                $url = $theme_uri . '/images/gallery' . $g . '.jpg';
                $gallery_images[] = array( 'full' => $url, 'thumb' => $url, 'alt' => 'SCM Galéria' );
            }
        }

        $featured     = $gallery_images[0];
        $rest         = array_slice( $gallery_images, 1 );
        $right_pages  = array_chunk( $rest, 4 );
        ?>
        <section class="gallery-section">
            <h2 class="section-label">Galéria fotografií</h2>

            <div class="gallery-grid">

                <div class="gallery-featured-wrap" onclick="openLightbox(0)">
                    <img src="<?php echo esc_url( $featured['full'] ); ?>" alt="<?php echo esc_attr( $featured['alt'] ? $featured['alt'] : 'SCM Galéria' ); ?>" onerror="this.style.display='none'">
                    <div class="gallery-expand-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="15 3 21 3 21 9"/><polyline points="9 21 3 21 3 15"/>
                            <line x1="21" y1="3" x2="14" y2="10"/><line x1="3" y1="21" x2="10" y2="14"/>
                        </svg>
                    </div>
                </div>

                <div class="gallery-right-wrap">
                    <div class="gallery-right-overflow">
                        <div class="gallery-right-inner" id="galleryRightInner">
                            <?php
                            $lb_index = 1; // featured tile is 0; right-grid tiles continue from 1
                            foreach ( $right_pages as $page ) :
                            ?>
                            <div class="gallery-right-page">
                                <?php foreach ( $page as $img ) : ?>
                                <div class="gallery-right-cell" onclick="openLightbox(<?php echo (int) $lb_index; ?>)"><img src="<?php echo esc_url( $img['thumb'] ); ?>" alt="<?php echo esc_attr( $img['alt'] ); ?>" loading="lazy" onerror="this.style.display='none'"></div>
                                <?php $lb_index++; endforeach; ?>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

            </div>

            <?php if ( count( $right_pages ) > 1 ) : ?>
            <div class="gallery-right-controls">
                <button class="gallery-nav-btn" id="galleryNavPrev" onclick="galleryRightNav(-1)" disabled aria-label="Predchádzajúce">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                </button>
                <div class="gallery-dots" id="galleryDots"></div>
                <button class="gallery-nav-btn" id="galleryNavNext" onclick="galleryRightNav(1)" aria-label="Nasledujúce">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                </button>
            </div>
            <?php endif; ?>
        </section>

        <!-- ── Odporúčame ──────────────────────────────────── -->
        <section class="odporucame-section">
            <h2 class="section-label">Odporúčame</h2>

            <div class="odporucame-cols">

                <div class="odporucame-card">
                    <div class="odporucame-app">
                        <img class="odporucame-app-icon" src="<?php echo esc_url( $theme_uri . '/images/DinDonDan.jpg' ); ?>" alt="DinDonDan">
                        <p class="odporucame-app-text">
                            Mobilná aplikácia s názvom <strong>„DinDonDan"</strong>
                            (<a href="https://play.google.com/store/apps/details?id=it.agesci.dindondanapp" target="_blank" rel="noopener">Android</a>,
                            <a href="https://apps.apple.com/it/app/dindondanapp/id1447418501" target="_blank" rel="noopener">iOS</a>)
                            obsahuje všetky kostoly Ríma s časmi omší (Messe) a otvorenia (Apertura).
                        </p>
                    </div>
                </div>

                <div class="odporucame-card">
                    <div class="odporucame-app">
                        <img class="odporucame-app-icon" src="<?php echo esc_url( $theme_uri . '/images/Missa.jpg' ); ?>" alt="Missa">
                        <p class="odporucame-app-text">
                            Mobilná aplikácia s názvom <strong>„Missa"</strong>
                            (<a href="https://play.google.com/store/apps/details?id=sk.tkkbs.missa" target="_blank" rel="noopener">Android</a>,
                            <a href="https://apps.apple.com/sk/app/missa/id1449574141" target="_blank" rel="noopener">iOS</a>)
                            obsahuje celý text sv. omše na daný deň v slovenčine. Dá sa použiť pri účasti na sv. omši v taliančine a v iných jazykoch. Sú v nej nielen liturgické čítania zo dňa, ale aj všetky texty sv. omše, vypísané zaradom.
                        </p>
                    </div>
                </div>

                <div class="odporucame-card">
                    <p class="odporucame-card-title">Podcast</p>
                    <a class="podcast-thumb"
                       href="https://www.youtube.com/watch?v=TaAwmuuJgwY"
                       target="_blank" rel="noopener" aria-label="Pozrieť podcast na YouTube">
                        <img src="https://img.youtube.com/vi/TaAwmuuJgwY/hqdefault.jpg" alt="SCM London Podcast">
                        <div class="podcast-play">
                            <svg viewBox="0 0 24 24"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                        </div>
                        <div class="podcast-label">
                            <svg viewBox="0 0 24 24" width="12" height="12" fill="#fff"><path d="M23 7s-.3-2-1.2-2.8c-1.1-1.2-2.4-1.2-3-1.3C16.6 2.8 12 2.8 12 2.8s-4.6 0-6.8.1c-.6.1-1.9.1-3 1.3C1.3 5 1 7 1 7S.7 9.1.7 11.2v2c0 2.1.3 4.2.3 4.2s.3 2 1.2 2.8c1.1 1.2 2.6 1.1 3.3 1.2C7.4 21.6 12 21.6 12 21.6s4.6 0 6.8-.2c.6-.1 1.9-.1 3-1.3.9-.8 1.2-2.8 1.2-2.8s.3-2.1.3-4.2v-2C23.3 9.1 23 7 23 7z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="#ff0000"/></svg>
                            Pozrieť na YouTube
                        </div>
                    </a>
                </div>

            </div>
        </section>

    </div>
</main>

<!-- ── Lightbox ──────────────────────────────────────────────── -->
<div class="lightbox" id="lightbox" onclick="if(event.target===this)closeLightbox()">
    <button class="lightbox-close" onclick="closeLightbox()" aria-label="Zavrieť">×</button>
    <button class="lightbox-btn lightbox-prev" onclick="lbNav(-1);event.stopPropagation()" aria-label="Predchádzajúca">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
    </button>
    <img class="lightbox-img" id="lightboxImg" src="" alt="Fotografia">
    <button class="lightbox-btn lightbox-next" onclick="lbNav(1);event.stopPropagation()" aria-label="Nasledujúca">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
    </button>
    <div class="lightbox-counter" id="lightboxCounter"></div>
</div>

<!-- ── Event Popup ───────────────────────────────────────────── -->
<div class="ev-popup" id="evPopup" role="dialog" aria-modal="true">
    <div class="ev-popup-head">
        <h4 id="evPopupDate"></h4>
        <button class="ev-popup-close" onclick="closePopup()" aria-label="Zavrieť">×</button>
    </div>
    <div class="ev-popup-body" id="evPopupBody"></div>
</div>

<?php get_footer(); ?>
