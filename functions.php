<?php
/**
 * scmlondon new — theme functions.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function scmnew_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style' ) );

    // Match the legacy theme's menu locations so admins keep editing the same menus
    // in Appearance → Menus without reassigning anything.
    register_nav_menus( array(
        'header-pages' => __( 'Header Pages',     'scmlondon-new' ),
        'header-cats'  => __( 'Header Categories','scmlondon-new' ),
        'footer-cats'  => __( 'Footer Categories','scmlondon-new' ),
    ) );
}
add_action( 'after_setup_theme', 'scmnew_setup' );

function scmnew_enqueue() {
    wp_enqueue_style( 'scmnew-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', 'scmnew_enqueue' );

/**
 * Fallback nav used when no menu is assigned to `header-pages` yet,
 * so the theme is never broken on first activation.
 */
function scmnew_default_nav() {
    $items = array(
        'Domov'       => '/',
        'O nás'       => '#',
        'Bohoslužby'  => '#',
        'Sviatosti'   => '#',
        'Podujatia'   => '#',
        'Správy'      => '#',
        'Registrácia' => '#',
        'Kontakt'     => '#',
    );
    echo '<ul class="nav-links" id="navLinks">';
    foreach ( $items as $label => $url ) {
        printf( '<li><a href="%s">%s</a></li>', esc_url( $url ), esc_html( $label ) );
    }
    echo '</ul>';
}

/**
 * Render the header navigation as robustly as possible.
 *
 * Order of preference:
 *   1. The menu assigned to the `header-pages` location (the WP-standard way).
 *   2. A menu literally named/slugged "dobrodinci", resolved directly — used
 *      when the location assignment isn't taking effect for whatever reason.
 *   3. The built-in default list, so the nav is never empty.
 *
 * This makes the bar dynamic from Appearance → Menus while staying immune to a
 * missing/empty location assignment.
 */
function scmnew_header_nav() {
    $base = array(
        'container'   => false,
        'menu_class'  => 'nav-links',
        'menu_id'     => 'navLinks',
        'depth'       => 2,
        'fallback_cb' => false,
        'echo'        => false,
    );

    // 1. Try the assigned location.
    $nav = wp_nav_menu( array_merge( $base, array( 'theme_location' => 'header-pages' ) ) );

    // 2. Fall back to a menu found by name/slug (default: dobrodinci).
    if ( ! scmnew_nav_has_items( $nav ) ) {
        $wanted = apply_filters( 'scmnew_header_menu_name', 'dobrodinci' );
        $target = '';
        foreach ( wp_get_nav_menus() as $menu ) {
            if ( 0 === strcasecmp( $menu->name, $wanted ) || $menu->slug === sanitize_title( $wanted ) ) {
                $target = $menu->term_id;
                break;
            }
        }
        if ( $target ) {
            $nav = wp_nav_menu( array_merge( $base, array( 'menu' => $target ) ) );
        }
    }

    // 3. Match the legacy template: auto-list of Pages (minus the excluded set).
    if ( ! scmnew_nav_has_items( $nav ) ) {
        $nav = scmnew_legacy_pages_nav();
    }

    // 4. Output, or fall back to the built-in list so the bar is never empty.
    if ( scmnew_nav_has_items( $nav ) ) {
        echo $nav; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- already escaped by core.
    } else {
        scmnew_default_nav();
    }
}

/**
 * Re-creates the legacy theme's automatic page navigation: every published
 * Page except the historically-excluded set, in page order, with the old
 * page_id=14 → cat=28 redirect preserved. Returns the markup as a string.
 */
function scmnew_legacy_pages_nav() {
    $links = wp_list_pages( array(
        'echo'         => 0,
        'title_li'     => '',
        'sort_column'  => 'menu_order, post_title',
        'exclude_tree' => 18877,
        'exclude'      => '13039,10151,10152,10153,10158,10150,10156,10157,18886,18903',
    ) );

    if ( ! $links ) {
        return '';
    }

    // Legacy hack carried over from the old header: point the page_id=14 item
    // at category 28 instead of its own page.
    $links = str_replace( '/?page_id=14', '/?cat=28', $links );

    return '<ul class="nav-links" id="navLinks">' . $links . '</ul>';
}

/** True only when a wp_nav_menu() string actually contains list items. */
function scmnew_nav_has_items( $nav ) {
    return is_string( $nav ) && false !== strpos( $nav, '<li' );
}

/* ─────────────────────────────────────────────────────────────────────────
 * Front-page photo gallery — driven by the WordPress "Master Home Gallery".
 *
 * That gallery is a Robo Gallery (`rl_gallery`) post, default ID 34696. We read
 * Robo Gallery's curated selection list (the `_rl_images` meta), so the theme
 * shows exactly the images you've selected in the gallery editor — in that
 * order — and updates automatically as you add, remove, or reorder them.
 * Override the post ID with the `scm_master_gallery_id` filter if it changes.
 * ──────────────────────────────────────────────────────────────────────── */

/** Default ID of the "Master Home Gallery" rl_gallery post. */
function scm_master_gallery_id() {
    return (int) apply_filters( 'scm_master_gallery_id', 34696 );
}

/**
 * Ordered list of images in the master gallery.
 *
 * @param int $gallery_id Optional. Defaults to scm_master_gallery_id().
 * @return array[] Each item: [ 'id', 'full', 'thumb', 'alt' ]. Empty if none.
 */
function scm_get_master_gallery_images( $gallery_id = 0 ) {
    $gallery_id = $gallery_id ? (int) $gallery_id : scm_master_gallery_id();
    if ( ! $gallery_id ) {
        return array();
    }

    $cache_key = 'scm_gallery_v4_' . $gallery_id;
    $cached    = get_transient( $cache_key );
    if ( is_array( $cached ) ) {
        return $cached;
    }

    // Robo Gallery's curated selection — exactly the images chosen in the
    // gallery editor, in that order. Add more there and they appear here.
    $ids = array();
    $rl  = maybe_unserialize( get_post_meta( $gallery_id, '_rl_images', true ) );
    if ( is_array( $rl ) && ! empty( $rl['media']['attachments']['ids'] ) ) {
        $ids = array_map( 'intval', (array) $rl['media']['attachments']['ids'] );
        // Show newest-selected first: reverse the gallery's selection order.
        $ids = array_reverse( $ids );
    }

    $images = array();
    foreach ( $ids as $id ) {
        $full = wp_get_attachment_image_url( $id, 'large' );
        if ( ! $full ) {
            continue;
        }
        $thumb = wp_get_attachment_image_url( $id, 'medium_large' );
        $alt   = get_post_meta( $id, '_wp_attachment_image_alt', true );
        $images[] = array(
            'id'    => $id,
            'full'  => $full,
            'thumb' => $thumb ? $thumb : $full,
            'alt'   => $alt ? $alt : '',
        );
    }

    // Cache for a day; scm_flush_gallery_cache() busts it on gallery edits.
    set_transient( $cache_key, $images, DAY_IN_SECONDS );
    return $images;
}

/** Bust the cached gallery whenever its post is saved/deleted. */
function scm_flush_gallery_cache( $post_id ) {
    if ( (int) $post_id === scm_master_gallery_id() ) {
        delete_transient( 'scm_gallery_v4_' . (int) $post_id );
    }
}
add_action( 'save_post', 'scm_flush_gallery_cache' );
add_action( 'deleted_post', 'scm_flush_gallery_cache' );

/* ─────────────────────────────────────────────────────────────────────────
 * Front-page "Správy" (News) — driven by the "Pinned News" post tag.
 *
 * Any published post tagged "Pinned News" appears in the news section, newest
 * first. The latest becomes the large featured card; the rest fill the
 * slideshow. Tag an existing post and it shows up automatically.
 *
 * The tag is matched by slug, name, or term ID so it keeps working regardless
 * of how the tag was created (e.g. "Pinned News" → slug "pinned-news").
 * Override the lookup with the `scm_pinned_news_tag` filter if needed.
 * ──────────────────────────────────────────────────────────────────────── */

/** Resolve the "Pinned News" tag term, trying slug then name. Null if absent. */
function scm_pinned_news_term() {
    $wanted = apply_filters( 'scm_pinned_news_tag', 'Pinned News' );

    $term = get_term_by( 'slug', sanitize_title( $wanted ), 'post_tag' );
    if ( ! $term ) {
        $term = get_term_by( 'name', $wanted, 'post_tag' );
    }
    return $term ? $term : null;
}

/**
 * Published posts tagged "Pinned News", newest first.
 *
 * @param int $limit Max posts to return. Default 5 (1 featured + 4 slideshow).
 * @return WP_Post[] Empty if the tag is missing or has no posts.
 */
function scm_get_pinned_news( $limit = 5 ) {
    $term = scm_pinned_news_term();
    if ( ! $term ) {
        return array();
    }

    return get_posts( array(
        'post_type'        => 'post',
        'post_status'      => 'publish',
        'posts_per_page'   => (int) $limit,
        'tax_query'        => array( array(
            'taxonomy' => 'post_tag',
            'field'    => 'term_id',
            'terms'    => $term->term_id,
        ) ),
        'ignore_sticky_posts' => true,
    ) );
}

/**
 * Best image to represent a news post on the front page.
 *
 * Order of preference:
 *   1. The post's featured image.
 *   2. The first <img> embedded in the post content.
 *   3. A theme fallback so the card never breaks.
 *
 * @param WP_Post $post The post.
 * @return string Image URL.
 */
function scm_news_card_image( $post ) {
    $img = get_the_post_thumbnail_url( $post, 'large' );
    if ( $img ) {
        return $img;
    }

    // Pull the first image embedded in the post content.
    if ( preg_match( '/<img[^>]+src=["\']([^"\']+)["\']/i', $post->post_content, $m ) ) {
        return $m[1];
    }

    return get_template_directory_uri() . '/images/slide1.jpg';
}

/**
 * Render one news card's inner markup (image, meta, title, excerpt, link).
 *
 * @param WP_Post $post     The post to render.
 * @param string  $heading  Heading tag for the title ('h2' for featured, else 'h3').
 */
function scm_render_news_card( $post, $heading = 'h3' ) {
    $title = get_the_title( $post );
    $img   = scm_news_card_image( $post );

    $cats = get_the_category( $post->ID );
    $cat  = ! empty( $cats ) ? $cats[0]->name : '';

    $heading = in_array( $heading, array( 'h2', 'h3' ), true ) ? $heading : 'h3';
    ?>
    <div class="card-img">
        <img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $title ); ?>">
    </div>
    <div class="card-body">
        <div class="card-meta">
            <span class="card-date"><?php echo esc_html( get_the_date( 'j. F Y', $post ) ); ?></span>
            <?php if ( $cat ) : ?>
                <span class="card-cat"><?php echo esc_html( $cat ); ?></span>
            <?php endif; ?>
        </div>
        <<?php echo $heading; ?>><?php echo esc_html( $title ); ?></<?php echo $heading; ?>>
        <p><?php echo esc_html( get_the_excerpt( $post ) ); ?></p>
        <a href="<?php echo esc_url( get_permalink( $post ) ); ?>" class="card-link">Čítať viac →</a>
    </div>
    <?php
}
