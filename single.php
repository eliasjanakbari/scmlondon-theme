<?php
/**
 * scmlondon new — single Post template.
 */
get_header(); ?>

<main class="main">
    <div class="container">
        <article class="card" style="padding:36px;">
            <?php while ( have_posts() ) : the_post(); ?>
                <div class="card-meta" style="margin-bottom:14px;">
                    <span class="card-date"><?php echo esc_html( get_the_date() ); ?></span>
                    <?php
                    $cats = get_the_category();
                    if ( ! empty( $cats ) ) {
                        printf( '<span class="card-cat">%s</span>', esc_html( $cats[0]->name ) );
                    }
                    ?>
                </div>
                <h1 class="section-label"><?php the_title(); ?></h1>
                <?php if ( has_post_thumbnail() ) : ?>
                    <div style="margin: 0 0 24px; border-radius:8px; overflow:hidden;">
                        <?php the_post_thumbnail( 'large' ); ?>
                    </div>
                <?php endif; ?>
                <div class="entry-content" style="font-size:0.95rem;color:var(--text-mid);line-height:1.7;">
                    <?php the_content(); ?>
                </div>
                <?php wp_link_pages(); ?>
            <?php endwhile; ?>
        </article>
    </div>
</main>

<?php get_footer(); ?>
