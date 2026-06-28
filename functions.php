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
    // TEMP DIAGNOSTIC: print every menu (name | slug | item count) as an HTML
    // comment so we can see the real menu name. Remove once the nav works.
    $debug = "\n<!-- SCM MENU DEBUG\n";
    foreach ( wp_get_nav_menus() as $m ) {
        $debug .= sprintf( "menu: name=%s | slug=%s | id=%d | items=%d\n", $m->name, $m->slug, $m->term_id, (int) $m->count );
    }
    $locs = get_nav_menu_locations();
    $debug .= 'locations: ' . wp_json_encode( $locs ) . "\n";
    $debug .= "-->\n";
    echo $debug; // phpcs:ignore

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

    // 3. Output, or fall back to the built-in list.
    if ( scmnew_nav_has_items( $nav ) ) {
        echo $nav; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- wp_nav_menu output is already escaped.
    } else {
        scmnew_default_nav();
    }
}

/** True only when a wp_nav_menu() string actually contains list items. */
function scmnew_nav_has_items( $nav ) {
    return is_string( $nav ) && false !== strpos( $nav, '<li' );
}
