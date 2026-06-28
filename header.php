<?php
/**
 * scmlondon new — site header (head + top navigation).
 */
$theme_uri = get_template_directory_uri();
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Slovenská katolícka misia v Londýne – bohoslužby, podujatia, komunita slovenských a českých katolíkov v Londýne.">
    <meta name="keywords" content="London, Velehrad, Slovenská katolická misia, Londýn, slovak catholic mission, slovenska, katolicka, misia">
    <link rel="shortcut icon" href="<?php echo esc_url( $theme_uri . '/images/favicon.ico' ); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">

    <script>
        /* Stop Google Translate from auto-applying English on load.
           Google persists a `googtrans` cookie once you translate, then
           re-applies it on every later visit. Clear it before the widget
           initialises so the site always loads in the default language;
           it is only set again when the Translate button is clicked. */
        (function clearGoogTrans() {
            var host = location.hostname;
            var domains = ['', '.' + host, host];
            // also clear for the bare domain (e.g. .example.com)
            var bare = host.split('.').slice(-2).join('.');
            domains.push('.' + bare, bare);
            var paths = ['/', location.pathname];
            domains.forEach(function (d) {
                paths.forEach(function (p) {
                    var c = 'googtrans=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=' + p;
                    document.cookie = c + (d ? '; domain=' + d : '');
                });
            });
        })();

        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'sk',
                includedLanguages: 'en',
                autoDisplay: false
            }, 'google_translate_element');
        }
    </script>

    <style>
        /* ── Variables ─────────────────────────────────────── */
        :root {
            --navy:        #0d2b4e;
            --navy-dark:   #081d35;
            --navy-light:  #1a3a5c;
            --gold:        #c9a227;
            --gold-light:  #e8c84a;
            --gold-dark:   #a8841a;
            --white:       #ffffff;
            --off-white:   #f8f7f3;
            --light-gray:  #f0eff0;
            --border:      #e0dfd9;
            --text:        #1a1a1a;
            --text-mid:    #444444;
            --text-light:  #777777;
            --shadow-sm:   0 1px 4px rgba(0,0,0,0.08);
            --shadow-md:   0 4px 18px rgba(0,0,0,0.12);
            --shadow-lg:   0 10px 36px rgba(0,0,0,0.18);
            --ease:        0.3s ease;
            --font-body:   'Inter', system-ui, sans-serif;
            --font-head:   'Playfair Display', Georgia, serif;
            --max-w:       1200px;
            --nav-h:       70px;
        }

        /* ── Reset ─────────────────────────────────────────── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; -webkit-font-smoothing: antialiased; }
        body { font-family: var(--font-body); color: var(--text); background: var(--off-white); line-height: 1.6; top: 0 !important; overflow-x: hidden; }
        a { color: var(--navy); text-decoration: none; transition: color var(--ease); }
        a:hover { color: var(--gold-dark); }
        img { max-width: 100%; height: auto; display: block; }
        ul { list-style: none; }
        button { font-family: var(--font-body); cursor: pointer; border: none; background: none; }

        /* ── Utility ───────────────────────────────────────── */
        .container { width: 100%; max-width: var(--max-w); margin: 0 auto; padding: 0 24px; }

        .section-label {
            font-family: var(--font-head);
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--navy);
            display: inline-block;
            padding-bottom: 0.5rem;
            border-bottom: 3px solid var(--gold);
            margin-bottom: 1.5rem;
        }

        /* ── Navbar ────────────────────────────────────────── */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 1000;
            height: var(--nav-h);
            background: rgba(8, 29, 53, 0.97);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(201,162,39,0.25);
        }
        .navbar .container { display: flex; align-items: center; height: 100%; gap: 0; }

        /* Logo */
        .nav-logo {
            display: flex;
            align-items: center;
            gap: 11px;
            margin-right: auto;
            flex-shrink: 0;
            text-decoration: none;
        }
        .nav-logo img { height: 50px; width: auto; }
        .nav-logo-text .name {
            font-family: var(--font-head);
            font-size: 1rem;
            font-weight: 700;
            color: var(--white);
            line-height: 1.2;
            display: block;
        }
        .nav-logo-text .name em { color: var(--gold); font-style: normal; }
        .nav-logo-text .sub {
            font-size: 0.65rem;
            color: rgba(255,255,255,0.45);
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        /* Links */
        .nav-links { display: flex; align-items: center; gap: 2px; }
        .nav-links a {
            color: rgba(255,255,255,0.8);
            font-size: 0.78rem;
            font-weight: 500;
            letter-spacing: 0.045em;
            text-transform: uppercase;
            padding: 6px 9px;
            border-radius: 4px;
            transition: all var(--ease);
            white-space: nowrap;
        }
        .nav-links a:hover, .nav-links a.active,
        .nav-links li.current-menu-item > a,
        .nav-links li.current_page_item > a { color: var(--gold); background: rgba(201,162,39,0.1); }

        /* Dropdowns — works for both WP menus (.sub-menu/.menu-item-has-children)
           and the legacy page list (.children/.page_item_has_children). */
        .nav-links li { position: relative; }
        .nav-links .menu-item-has-children > a::after,
        .nav-links .page_item_has_children > a::after {
            content: ""; display: inline-block; margin-left: 6px;
            border: 4px solid transparent; border-top-color: currentColor;
            transform: translateY(2px); transition: transform var(--ease);
        }
        .nav-links .sub-menu,
        .nav-links .children {
            position: absolute; top: 100%; left: 0; min-width: 210px;
            background: var(--navy-dark); border-radius: 6px;
            box-shadow: 0 10px 28px rgba(0,0,0,0.28);
            padding: 6px; list-style: none; margin: 0;
            display: flex; flex-direction: column; gap: 2px;
            opacity: 0; visibility: hidden; transform: translateY(8px);
            transition: opacity var(--ease), transform var(--ease), visibility var(--ease);
            z-index: 1001;
        }
        .nav-links li:hover > .sub-menu,
        .nav-links li:hover > .children,
        .nav-links li:focus-within > .sub-menu,
        .nav-links li:focus-within > .children {
            opacity: 1; visibility: visible; transform: translateY(0);
        }
        .nav-links .menu-item-has-children:hover > a::after,
        .nav-links .page_item_has_children:hover > a::after { transform: translateY(2px) rotate(180deg); }
        .nav-links .sub-menu a,
        .nav-links .children a { display: block; text-transform: none; letter-spacing: 0; font-size: 0.8rem; }

        /* Translate button */
        .btn-translate {
            margin-left: 14px;
            display: flex;
            align-items: center;
            gap: 7px;
            background: var(--gold);
            color: var(--navy-dark);
            font-size: 0.78rem;
            font-weight: 700;
            padding: 7px 13px;
            border-radius: 5px;
            white-space: nowrap;
            transition: all var(--ease);
            flex-shrink: 0;
            letter-spacing: 0.03em;
        }
        .btn-translate:hover { background: var(--gold-light); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(201,162,39,0.35); }
        .btn-translate .uk-flag { width: 22px; height: 15px; border-radius: 2px; display: block; overflow: hidden; flex-shrink: 0; }

        /* Hamburger */
        .hamburger { display: none; flex-direction: column; gap: 5px; padding: 8px; margin-left: 8px; }
        .hamburger span { display: block; width: 22px; height: 2px; background: var(--white); border-radius: 2px; transition: all var(--ease); }

        /* Hide Google Translate toolbar */
        #google_translate_element { display: none; }
        .goog-te-banner-frame { display: none !important; }
        .skiptranslate { display: none !important; }

        /* ── Hero Slideshow ────────────────────────────────── */
        .hero {
            position: relative;
            height: 520px;
            overflow: hidden;
            background: var(--navy-dark);
        }
        .hero-track {
            display: flex;
            height: 100%;
            transition: transform 0.85s cubic-bezier(0.4,0,0.2,1);
        }
        .hero-slide {
            flex: 0 0 100%;
            width: 100%;
            height: 100%;
            position: relative;
        }
        .hero-slide img {
            width: 100%; height: 100%;
            object-fit: cover;
            opacity: 0.75;
        }
        .hero-slide:nth-child(1) { background: linear-gradient(135deg, #0d2b4e 0%, #1a3a5c 100%); }
        .hero-slide:nth-child(2) { background: linear-gradient(135deg, #1a3a5c 0%, #0a1e35 100%); }
        .hero-slide:nth-child(3) { background: linear-gradient(135deg, #0a1e35 0%, #1a3a5c 100%); }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(8,29,53,0.2) 0%, rgba(8,29,53,0.65) 100%);
        }
        .hero-caption {
            position: absolute;
            bottom: 70px; left: 0; right: 0;
            text-align: center;
            color: var(--white);
            padding: 0 24px;
        }
        .hero-caption h1 {
            font-family: var(--font-head);
            font-size: clamp(1.8rem, 4vw, 3.1rem);
            font-weight: 700;
            line-height: 1.2;
            text-shadow: 0 2px 16px rgba(0,0,0,0.55);
            margin-bottom: 0.5rem;
        }
        .hero-caption p {
            font-size: 1rem;
            opacity: 0.82;
            letter-spacing: 0.09em;
            text-transform: uppercase;
            text-shadow: 0 1px 6px rgba(0,0,0,0.4);
        }

        /* Arrows */
        .hero-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 44px; height: 44px;
            border-radius: 50%;
            background: rgba(255,255,255,0.14);
            border: 1px solid rgba(255,255,255,0.22);
            color: var(--white);
            display: flex; align-items: center; justify-content: center;
            transition: all var(--ease);
            backdrop-filter: blur(4px);
        }
        .hero-arrow:hover { background: rgba(255,255,255,0.28); }
        .hero-arrow svg { width: 18px; height: 18px; }
        .hero-prev { left: 20px; }
        .hero-next { right: 20px; }

        /* Dots */
        .hero-dots {
            position: absolute;
            bottom: 22px; left: 0; right: 0;
            display: flex; justify-content: center; gap: 7px;
        }
        .hero-dot {
            width: 8px; height: 8px;
            border-radius: 50%;
            background: rgba(255,255,255,0.38);
            border: 1px solid rgba(255,255,255,0.28);
            cursor: pointer;
            transition: all var(--ease);
        }
        .hero-dot.active { background: var(--gold); border-color: var(--gold); width: 24px; border-radius: 4px; }

        /* ── Main layout ───────────────────────────────────── */
        .main { padding: 52px 0 64px; background: #c3dcf8; }
        .layout { display: grid; grid-template-columns: 1fr 336px; gap: 40px; align-items: start; }
        .layout > * { min-width: 0; }

        /* ── News cards ────────────────────────────────────── */
        .news-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 22px; }
        .news-grid > * { min-width: 0; }

        .card {
            background: var(--white);
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
            transition: all var(--ease);
        }
        .card:hover { box-shadow: var(--shadow-md); transform: translateY(-2px); }

        .card.featured {
            grid-column: 1 / -1;
            display: flex;
            flex-direction: row;
        }
        .card.featured .card-img { width: 260px; flex-shrink: 0; height: auto; }
        .card.featured .card-body { padding: 26px; }
        .card.featured h2 { font-size: 1.375rem; }

        .card-img {
            height: 175px;
            overflow: hidden;
            background: var(--navy);
        }
        .card-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
        .card:hover .card-img img { transform: scale(1.04); }

        .card-img-ph {
            width: 100%; height: 100%;
            display: flex; align-items: center; justify-content: center;
            font-size: 2.25rem;
            background: linear-gradient(135deg, var(--navy-light), var(--navy-dark));
            color: rgba(255,255,255,0.25);
        }

        .card-body { padding: 16px; }
        .card-meta { display: flex; align-items: center; gap: 8px; margin-bottom: 8px; }
        .card-date { font-size: 0.73rem; color: var(--text-light); font-weight: 500; }
        .card-cat {
            font-size: 0.65rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.07em;
            color: var(--gold-dark);
            background: rgba(201,162,39,0.1);
            padding: 2px 7px; border-radius: 3px;
        }
        .card h2, .card h3 {
            font-family: var(--font-head);
            color: var(--navy);
            line-height: 1.3;
            margin-bottom: 7px;
        }
        .card h3 { font-size: 1rem; }
        .card p { font-size: 0.86rem; color: var(--text-mid); line-height: 1.55; }
        .card-link {
            display: inline-flex; align-items: center; gap: 4px;
            margin-top: 12px; font-size: 0.8rem;
            font-weight: 600; color: var(--navy);
            transition: gap var(--ease);
        }
        .card-link:hover { gap: 8px; color: var(--gold-dark); }

        .news-more { margin-top: 22px; text-align: right; }
        .btn-outline {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 9px 18px;
            border: 2px solid var(--navy);
            color: var(--navy);
            font-size: 0.86rem; font-weight: 600;
            border-radius: 5px;
            transition: all var(--ease);
        }
        .btn-outline:hover { background: var(--navy); color: var(--white); }

        /* ── Cards slideshow ───────────────────────────────────── */
        .cards-slideshow-outer { grid-column: 1 / -1; min-width: 0; width: 100%; }
        .cards-overflow { overflow: hidden; width: 100%; min-width: 0; }
        .cards-controls { display: flex; align-items: center; justify-content: center; gap: 10px; margin-top: 10px; }
        .cards-track {
            display: flex;
            gap: 18px;
            transition: transform 0.45s cubic-bezier(0.4,0,0.2,1);
        }
        .cards-track .card { flex: 0 0 calc(50% - 9px); min-width: 0; }
        .cards-arrow {
            width: 38px; height: 38px; flex-shrink: 0;
            border-radius: 50%;
            background: rgba(255,255,255,0.92);
            border: 1.5px solid rgba(13,43,78,0.2);
            color: var(--navy);
            display: flex; align-items: center; justify-content: center;
            box-shadow: var(--shadow-sm);
            transition: all var(--ease);
        }
        .cards-arrow:hover:not(:disabled) { background: var(--navy); color: var(--white); }
        .cards-arrow:disabled { opacity: 0.3; cursor: default; }
        .cards-arrow svg { width: 16px; height: 16px; }
        .cards-dots { display: flex; gap: 7px; }

        /* ── Sidebar ───────────────────────────────────────── */
        .sidebar { display: flex; flex-direction: column; gap: 26px; }

        .s-card {
            background: var(--white);
            border-radius: 8px;
            border: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }
        .s-card-head {
            background: var(--navy);
            padding: 12px 16px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .s-card-head h3 { font-family: var(--font-head); color: var(--white); font-size: 1rem; font-weight: 600; }
        .s-card-body { padding: 16px; }

        /* Calendar */
        .cal-nav { display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px; }
        .cal-nav-btn {
            padding: 4px 7px; border-radius: 4px;
            color: var(--navy); transition: background var(--ease);
        }
        .cal-nav-btn:hover { background: var(--light-gray); }
        .cal-nav-btn svg { width: 15px; height: 15px; display: block; }
        .cal-month { font-family: var(--font-head); font-weight: 700; font-size: 0.98rem; color: var(--navy); }

        .cal-table { width: 100%; border-collapse: separate; border-spacing: 2px; }
        .cal-table th {
            text-align: center;
            font-size: 0.65rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.06em;
            color: var(--text-light);
            padding: 3px 0 7px;
        }
        .cal-table td { text-align: center; padding: 0; }

        .cal-day {
            width: 34px; height: 34px;
            border-radius: 50%;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 0.8rem; color: var(--text);
            margin: 1px auto;
            transition: all var(--ease);
            cursor: default;
        }
        .cal-day.empty { color: transparent; }
        .cal-day.has-ev {
            background: rgba(201,162,39,0.14);
            color: var(--navy);
            font-weight: 700;
            border: 2px solid var(--gold);
            cursor: pointer;
            position: relative;
        }
        .cal-day.has-ev::after {
            content: '';
            position: absolute;
            bottom: 3px; left: 50%;
            transform: translateX(-50%);
            width: 4px; height: 4px;
            border-radius: 50%;
            background: var(--gold-dark);
        }
        .cal-day.has-ev:hover { background: var(--gold); color: var(--navy-dark); }

        .cal-legend {
            font-size: 0.72rem; color: var(--text-light);
            margin-top: 9px; text-align: center;
            display: flex; align-items: center; justify-content: center; gap: 5px;
        }
        .cal-legend-dot {
            width: 10px; height: 10px;
            border-radius: 50%;
            background: rgba(201,162,39,0.5);
            border: 2px solid var(--gold);
            flex-shrink: 0;
        }
        .cal-legend-dot.sunday {
            background: rgba(38,127,54,0.4);
            border-color: #267f36;
        }

        .cal-day.is-sunday {
            background: rgba(38,127,54,0.1);
            border: 1px solid rgba(38,127,54,0.45);
            color: #1a5c28;
            font-weight: 600;
        }
        .cal-day.is-sunday:hover:not(.today):not(.has-ev) {
            background: rgba(38,127,54,0.22);
        }
        .cal-day.is-sunday.has-ev {
            background: rgba(201,162,39,0.14);
            border: 2px solid var(--gold);
            color: var(--navy);
        }
        .cal-day.today { background: var(--navy); color: var(--white); border-color: var(--navy); font-weight: 700; }
        .cal-day.today.has-ev { background: var(--gold); color: var(--navy-dark); border-color: var(--gold-dark); }

        /* ── Bulletin card ─────────────────────────────────── */
        .card.bulletin-card { grid-column: 1 / -1; }

        .bulletin-header {
            background: var(--navy);
            padding: 16px;
            display: flex; align-items: center; gap: 10px;
        }
        .bulletin-header svg { width: 22px; height: 22px; color: rgba(255,255,255,0.75); flex-shrink: 0; }
        .bulletin-header-text .title {
            font-family: var(--font-head);
            color: #fff;
            font-size: 0.95rem;
            font-weight: 700;
            line-height: 1.2;
        }
        .bulletin-header-text .sub {
            font-size: 0.7rem;
            color: rgba(255,255,255,0.55);
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }
        .bulletin-body {
            padding: 14px;
            display: flex;
            flex-direction: row;
            align-items: stretch;
            gap: 20px;
        }

        .bulletin-latest {
            flex: 0 0 50%;
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(13,43,78,0.05);
            border: 2px solid var(--navy);
            border-radius: 6px;
            padding: 12px 13px;
            margin-bottom: 0;
            text-decoration: none;
            transition: all var(--ease);
        }
        .bulletin-latest:hover {
            background: var(--navy);
            transform: translateY(-1px);
            box-shadow: 0 3px 12px rgba(13,43,78,0.2);
        }
        .bulletin-latest:hover .bdate,
        .bulletin-latest:hover .blabel { color: #fff; }
        .bulletin-latest:hover .bulletin-dl-icon { color: var(--gold); }
        .bulletin-latest-icon {
            width: 36px; height: 36px; flex-shrink: 0;
            background: var(--navy);
            border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
            transition: background var(--ease);
        }
        .bulletin-latest:hover .bulletin-latest-icon { background: var(--navy-light); }
        .bulletin-latest-icon svg { width: 18px; height: 18px; color: #fff; }
        .bulletin-latest-info { flex: 1; }
        .bulletin-latest-info .bdate {
            font-weight: 700;
            font-size: 0.9rem;
            color: var(--navy);
            display: block;
            transition: color var(--ease);
        }
        .bulletin-latest-info .blabel {
            font-size: 0.7rem;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 600;
            transition: color var(--ease);
        }
        .bulletin-dl-icon { color: var(--navy); transition: color var(--ease); }
        .bulletin-dl-icon svg { width: 16px; height: 16px; }

        .bulletin-prev-section { flex: 0 0 calc(50% - 20px); display: flex; flex-direction: column; justify-content: center; }
        .bulletin-prev-label {
            font-size: 0.68rem;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 0.07em;
            font-weight: 700;
            margin-bottom: 4px;
        }
        .bulletin-prev-list { display: flex; flex-direction: column; gap: 1px; }
        .bulletin-prev-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 7px 8px;
            border-radius: 5px;
            text-decoration: none;
            transition: background var(--ease);
        }
        .bulletin-prev-item:hover { background: var(--light-gray); }
        .bulletin-prev-item .bpdate {
            font-size: 0.84rem;
            color: var(--navy);
            font-weight: 500;
        }
        .bulletin-prev-item .bpdl {
            font-size: 0.72rem;
            color: var(--navy);
            font-weight: 700;
            display: flex; align-items: center; gap: 3px;
            opacity: 0.6;
        }
        .bulletin-prev-item:hover .bpdl { opacity: 1; color: var(--gold-dark); }
        .bulletin-prev-item .bpdl svg { width: 12px; height: 12px; }

        /* Event popup */
        .ev-popup {
            display: none;
            position: fixed;
            z-index: 2000;
            width: 296px;
            background: var(--white);
            border-radius: 10px;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border);
            overflow: hidden;
        }
        .ev-popup.show { display: block; }
        .ev-popup-head {
            background: var(--navy);
            padding: 11px 14px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .ev-popup-head h4 { color: var(--white); font-family: var(--font-head); font-size: 0.93rem; }
        .ev-popup-close {
            color: rgba(255,255,255,0.65); font-size: 1.2rem;
            line-height: 1; padding: 0;
            transition: color var(--ease);
        }
        .ev-popup-close:hover { color: var(--white); }
        .ev-popup-body { padding: 12px 14px; max-height: 230px; overflow-y: auto; }
        .ev-item { padding: 9px 0; border-bottom: 1px solid var(--border); }
        .ev-item:last-child { border-bottom: none; }
        .ev-time { font-size: 0.72rem; font-weight: 700; color: var(--gold-dark); margin-bottom: 2px; }
        .ev-title { font-size: 0.86rem; font-weight: 600; color: var(--navy); }
        .ev-desc { font-size: 0.8rem; color: var(--text-mid); margin-top: 2px; }

        /* Mass times */
        .mass-list li {
            display: flex; justify-content: space-between; align-items: center;
            padding: 8px 0; border-bottom: 1px solid var(--border);
            font-size: 0.86rem; color: var(--text-mid);
        }
        .mass-list li:last-child { border-bottom: none; }
        .mass-list .day { font-weight: 600; color: var(--navy); }
        .mass-list .time { font-weight: 500; color: var(--gold-dark); }

        /* Buttons */
        .btn-primary {
            display: flex; align-items: center; justify-content: center;
            width: 100%; padding: 10px 16px;
            background: var(--navy); color: var(--white);
            font-size: 0.86rem; font-weight: 600;
            border-radius: 5px;
            transition: all var(--ease);
            text-decoration: none;
        }
        .btn-primary:hover { background: var(--navy-dark); color: var(--white); transform: translateY(-1px); }

        /* ── Odporúčame ────────────────────────────────────── */
        .odporucame-section { margin-top: 48px; }
        .odporucame-cols {
            display: flex;
            gap: 0;
            align-items: stretch;
            background: #fff;
            border-radius: 10px;
            padding: 20px 0;
            box-shadow: 0 1px 4px rgba(0,0,0,0.08);
        }
        .odporucame-card {
            flex: 1; min-width: 0;
            padding: 0 20px;
            border-right: 1px solid rgba(13,43,78,0.1);
            display: flex;
            flex-direction: column;
        }
        .odporucame-card:last-child { border-right: none; }
        .odporucame-card-title {
            font-family: var(--font-head);
            font-size: 1rem;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 12px;
        }
        .odporucame-app {
            display: flex;
            gap: 14px;
            align-items: flex-start;
        }
        .odporucame-app-icon {
            width: 60px; height: 60px;
            border-radius: 12px;
            object-fit: cover;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.12);
        }
        .odporucame-app-text { flex: 1; min-width: 0; font-size: 0.86rem; line-height: 1.6; color: var(--text); }
        .odporucame-app-text strong { color: var(--navy); }
        .odporucame-app-text a { color: var(--navy); font-weight: 600; text-decoration: underline; text-decoration-color: var(--gold); text-underline-offset: 2px; }
        .odporucame-app-text a:hover { color: var(--gold); }
        .podcast-thumb {
            display: block;
            position: relative;
            width: 100%;
            padding-bottom: 56.25%;
            border-radius: 8px;
            overflow: hidden;
            background: #000;
            text-decoration: none;
            flex: 1;
        }
        .podcast-thumb img {
            position: absolute;
            inset: 0;
            width: 100%; height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.4s ease, opacity 0.3s;
        }
        .podcast-thumb:hover img { transform: scale(1.03); opacity: 0.85; }
        .podcast-play {
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            width: 42px; height: 42px;
            background: rgba(255,0,0,0.88);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            transition: background 0.2s, transform 0.2s;
        }
        .podcast-thumb:hover .podcast-play { background: #ff0000; transform: translate(-50%, -50%) scale(1.08); }
        .podcast-play svg { width: 18px; height: 18px; fill: #fff; margin-left: 3px; }
        .podcast-label {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            padding: 20px 10px 8px;
            background: linear-gradient(transparent, rgba(0,0,0,0.65));
            color: #fff;
            font-size: 0.75rem;
            letter-spacing: 0.02em;
            display: flex; align-items: center; gap: 5px;
        }
        @media (max-width: 768px) {
            .odporucame-cols { flex-direction: column; padding: 0; }
            .odporucame-card { padding: 20px; border-right: none; border-bottom: 1px solid rgba(13,43,78,0.1); }
            .odporucame-card:last-child { border-bottom: none; }
        }

        /* ── Gallery ───────────────────────────────────────── */
        .gallery-section { margin-top: 48px; }
        .gallery-grid {
            display: flex;
            gap: 10px;
            align-items: stretch;
            margin-top: 1.5rem;
            height: 400px;
        }

        .gallery-featured-wrap {
            flex: 0 0 50%; min-width: 0;
            border-radius: 8px; overflow: hidden;
            cursor: pointer; position: relative;
            background: var(--navy-dark);
        }
        .gallery-featured-wrap img {
            width: 100%; height: 100%;
            object-fit: cover; display: block;
            transition: transform 0.45s ease;
        }
        .gallery-featured-wrap:hover img { transform: scale(1.03); }
        .gallery-featured-wrap::after {
            content: ''; position: absolute; inset: 0;
            background: transparent; transition: background 0.3s;
            pointer-events: none;
        }
        .gallery-featured-wrap:hover::after { background: rgba(8,29,53,0.1); }
        .gallery-expand-icon {
            position: absolute; bottom: 14px; right: 14px;
            width: 36px; height: 36px; border-radius: 6px;
            background: rgba(255,255,255,0.15); backdrop-filter: blur(4px);
            border: 1px solid rgba(255,255,255,0.25); color: #fff;
            display: flex; align-items: center; justify-content: center;
            opacity: 0; transition: opacity 0.3s; pointer-events: none;
        }
        .gallery-featured-wrap:hover .gallery-expand-icon { opacity: 1; }
        .gallery-expand-icon svg { width: 16px; height: 16px; }

        .gallery-right-wrap {
            flex: 1; min-width: 0;
        }
        .gallery-right-overflow {
            overflow: hidden;
            height: 100%;
        }
        .gallery-right-inner {
            display: flex;
            height: 100%;
            transition: transform 0.45s cubic-bezier(0.4,0,0.2,1);
        }
        .gallery-right-page {
            flex: 0 0 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 1fr 1fr;
            gap: 10px;
        }
        .gallery-right-cell {
            overflow: hidden; border-radius: 6px;
            cursor: pointer; position: relative;
            background: var(--navy-light);
        }
        .gallery-right-cell img {
            width: 100%; height: 100%; object-fit: cover;
            display: block; transition: transform 0.4s ease;
        }
        .gallery-right-cell:hover img { transform: scale(1.06); }
        .gallery-right-cell::after {
            content: ''; position: absolute; inset: 0;
            background: transparent; transition: background 0.3s; pointer-events: none;
        }
        .gallery-right-cell:hover::after { background: rgba(8,29,53,0.15); }

        .gallery-right-controls {
            display: flex; align-items: center; justify-content: center;
            gap: 10px; margin-top: 10px;
        }
        .gallery-dots { display: flex; gap: 7px; }
        .gallery-nav-btn {
            width: 32px; height: 32px; border-radius: 50%;
            background: rgba(255,255,255,0.92);
            border: 1.5px solid rgba(13,43,78,0.18);
            color: var(--navy);
            display: flex; align-items: center; justify-content: center;
            box-shadow: var(--shadow-sm); transition: all var(--ease);
            flex-shrink: 0;
        }
        .gallery-nav-btn:hover:not(:disabled) { background: var(--navy); color: #fff; }
        .gallery-nav-btn:disabled { opacity: 0.3; cursor: default; }
        .gallery-nav-btn svg { width: 13px; height: 13px; }

        /* Lightbox */
        .lightbox {
            display: none; position: fixed; inset: 0; z-index: 3000;
            background: rgba(0,0,0,0.93);
            align-items: center; justify-content: center;
        }
        .lightbox.open { display: flex; }
        .lightbox-img {
            max-width: 90vw; max-height: 88vh;
            border-radius: 4px; object-fit: contain;
            box-shadow: 0 20px 60px rgba(0,0,0,0.5);
            user-select: none;
        }
        .lightbox-close {
            position: absolute; top: 18px; right: 22px;
            color: rgba(255,255,255,0.65); font-size: 2rem; line-height: 1;
            transition: color 0.2s; padding: 4px 10px;
        }
        .lightbox-close:hover { color: #fff; }
        .lightbox-btn {
            position: absolute; top: 50%; transform: translateY(-50%);
            width: 46px; height: 46px; border-radius: 50%;
            background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.22);
            color: rgba(255,255,255,0.8);
            display: flex; align-items: center; justify-content: center;
            transition: all 0.2s;
        }
        .lightbox-btn:hover { background: rgba(255,255,255,0.22); color: #fff; }
        .lightbox-btn svg { width: 20px; height: 20px; }
        .lightbox-prev { left: 18px; }
        .lightbox-next { right: 18px; }
        .lightbox-counter {
            position: absolute; bottom: 18px; left: 50%; transform: translateX(-50%);
            color: rgba(255,255,255,0.45); font-size: 0.78rem; letter-spacing: 0.08em;
        }

        /* ── Footer ────────────────────────────────────────── */
        .footer { background: var(--navy-dark); color: rgba(255,255,255,0.7); padding: 52px 0 0; margin-top: 0; }
        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 48px;
            padding-bottom: 44px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .footer-brand { display: flex; align-items: center; gap: 10px; margin-bottom: 16px; }
        .footer-brand img { height: 52px; width: auto; opacity: 0.92; }
        .footer-brand-name { font-family: var(--font-head); font-size: 1rem; color: var(--white); line-height: 1.35; }
        .footer p { font-size: 0.82rem; line-height: 1.65; margin-bottom: 14px; max-width: 380px; }

        .footer-social { display: flex; gap: 9px; margin-top: 4px; }
        .footer-social a {
            width: 36px; height: 36px; border-radius: 50%;
            background: rgba(255,255,255,0.08);
            color: rgba(255,255,255,0.65);
            display: flex; align-items: center; justify-content: center;
            transition: all var(--ease);
        }
        .footer-social a:hover { background: var(--gold); color: var(--navy-dark); }
        .footer-social svg { width: 15px; height: 15px; }

        .footer-col h4 {
            color: var(--white); font-size: 0.8rem;
            font-weight: 700; text-transform: uppercase;
            letter-spacing: 0.09em; margin-bottom: 16px;
        }
        .footer-links { display: flex; flex-direction: column; gap: 8px; }
        .footer-links a { color: rgba(255,255,255,0.6); font-size: 0.86rem; transition: color var(--ease); }
        .footer-links a:hover { color: var(--gold-light); }

        .footer-contact-row {
            display: flex; gap: 10px; align-items: flex-start;
            font-size: 0.86rem; color: rgba(255,255,255,0.6); margin-bottom: 10px;
        }
        .footer-contact-row svg { width: 15px; height: 15px; flex-shrink: 0; margin-top: 3px; color: var(--gold); }

        .footer-bottom {
            padding: 18px 0;
            display: flex; align-items: center; justify-content: space-between;
            flex-wrap: wrap; gap: 10px;
        }
        .footer-bottom p { font-size: 0.73rem; color: rgba(255,255,255,0.35); }
        .footer-bottom-links { display: flex; gap: 16px; }
        .footer-bottom-links a { font-size: 0.73rem; color: rgba(255,255,255,0.35); transition: color var(--ease); }
        .footer-bottom-links a:hover { color: rgba(255,255,255,0.65); }

        /* ── Responsive ────────────────────────────────────── */
        @media (max-width: 1024px) {
            .layout { grid-template-columns: 1fr 300px; gap: 28px; }
        }
        @media (max-width: 768px) {
            :root { --nav-h: 60px; }
            .nav-links {
                display: none; position: absolute;
                top: var(--nav-h); left: 0; right: 0;
                background: var(--navy-dark); flex-direction: column;
                padding: 14px; gap: 3px;
                border-bottom: 1px solid rgba(201,162,39,0.2);
            }
            .nav-links.open { display: flex; }
            .nav-links a { padding: 10px 12px; font-size: 0.85rem; }
            /* Sub-menus stack inline on mobile, expanded by tap */
            .nav-links .sub-menu,
            .nav-links .children {
                position: static; opacity: 1; visibility: visible; transform: none;
                box-shadow: none; background: transparent; padding: 0 0 0 14px;
                display: none;
            }
            .nav-links .menu-item-has-children.open > .sub-menu,
            .nav-links .page_item_has_children.open > .children { display: flex; }
            .nav-links .menu-item-has-children > a::after,
            .nav-links .page_item_has_children > a::after { float: right; }
            .hamburger { display: flex; }
            .btn-translate { padding: 6px 10px; }
            .hero { height: 360px; }
            .layout { grid-template-columns: 1fr; }
            .news-grid { grid-template-columns: 1fr; }
            .card.featured { flex-direction: column; }
            .card.featured .card-img { width: 100%; height: 200px; }
            .cards-track .card { flex: 0 0 100%; }
            .bulletin-body { flex-direction: column; }
            .bulletin-latest { flex: none; }
            .bulletin-prev-section { flex: none; }
            .gallery-grid { flex-direction: column; height: auto; }
            .gallery-featured-wrap { flex: none; aspect-ratio: 16/9; }
            .gallery-right-wrap { flex: none; height: 360px; }
            .lightbox-btn { width: 38px; height: 38px; }
            .footer-grid { grid-template-columns: 1fr; gap: 32px; }
            .footer-bottom { flex-direction: column; text-align: center; }
        }
        @media (max-width: 480px) {
            .hero { height: 280px; }
            .hero-caption h1 { font-size: 1.5rem; }
            .hero-caption p { font-size: 0.82rem; }
        }
    </style>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<!-- Hidden Google Translate widget -->
<div id="google_translate_element"></div>

<!-- ── Navigation ───────────────────────────────────────────── -->
<nav class="navbar">
    <div class="container">

        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-logo">
            <img src="<?php echo esc_url( $theme_uri . '/images/scm_erb.png' ); ?>" alt="SCM erb" onerror="this.style.display='none'">
            <div class="nav-logo-text">
                <span class="name">Slovenská <em>katolícka</em> misia</span>
                <span class="sub">v Londýne · London</span>
            </div>
        </a>

        <?php scmnew_header_nav(); ?>

        <button class="btn-translate" id="btn-translate" data-lang="sk" onclick="toggleTranslate()" title="Translate entire site to English">
            <!-- UK flag — shown while site is in Slovak (click to go EN) -->
            <svg class="uk-flag flag-en" viewBox="0 0 60 30" xmlns="http://www.w3.org/2000/svg">
                <rect width="60" height="30" fill="#012169"/>
                <path d="M0,0 L60,30 M60,0 L0,30" stroke="#fff" stroke-width="6"/>
                <path d="M0,0 L60,30 M60,0 L0,30" stroke="#C8102E" stroke-width="4"/>
                <path d="M30,0 V30 M0,15 H60" stroke="#fff" stroke-width="10"/>
                <path d="M30,0 V30 M0,15 H60" stroke="#C8102E" stroke-width="6"/>
            </svg>
            <!-- SK flag — shown while site is in English (click to go back) -->
            <svg class="uk-flag flag-sk" viewBox="0 0 60 40" xmlns="http://www.w3.org/2000/svg" style="display:none">
                <rect width="60" height="40" fill="#fff"/>
                <rect width="60" height="13.33" y="13.33" fill="#0b4ea2"/>
                <rect width="60" height="13.34" y="26.66" fill="#ee1c25"/>
                <g transform="translate(8,8)">
                    <path d="M1,0 H17 V12 C17,20 9,25 9,25 C9,25 1,20 1,12 Z" fill="#ee1c25" stroke="#fff" stroke-width="1.5"/>
                    <path d="M8,4 H10 V7 H13.5 V9 H10 V11 H12.5 V13 H10 V19 H8 V13 H5.5 V11 H8 V9 H4.5 V7 H8 Z" fill="#fff"/>
                </g>
            </svg>
            <span class="lang-label">EN</span>
        </button>

        <button class="hamburger" id="hamburger" onclick="toggleNav()" aria-label="Menu">
            <span></span><span></span><span></span>
        </button>
    </div>
</nav>
