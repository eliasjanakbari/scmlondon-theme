<?php
/**
 * scmlondon new — generic fallback (archives, blog index, search, etc.).
 * Used whenever a more specific template (front-page, page, single, etc.) doesn't apply.
 */
get_header(); ?>

<main class="main">
    <div class="container">
        <section>
            <?php if ( have_posts() ) : ?>
                <h2 class="section-label"><?php
                    if ( is_search() ) {
                        printf( esc_html__( 'Výsledky vyhľadávania: %s', 'scmlondon-new' ), '<em>' . esc_html( get_search_query() ) . '</em>' );
                    } elseif ( is_category() || is_tag() || is_archive() ) {
                        echo esc_html( get_the_archive_title() );
                    } else {
                        esc_html_e( 'Najnovšie príspevky', 'scmlondon-new' );
                    }
                ?></h2>

                <div class="news-grid">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <article class="card">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <a class="card-img" href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'medium_large' ); ?>
                                </a>
                            <?php endif; ?>
                            <div class="card-body">
                                <div class="card-meta">
                                    <span class="card-date"><?php echo esc_html( get_the_date() ); ?></span>
                                    <?php
                                    $cats = get_the_category();
                                    if ( ! empty( $cats ) ) {
                                        printf( '<span class="card-cat">%s</span>', esc_html( $cats[0]->name ) );
                                    }
                                    ?>
                                </div>
                                <h3><a href="<?php the_permalink(); ?>" style="color:inherit;"><?php the_title(); ?></a></h3>
                                <p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 28 ) ); ?></p>
                                <a href="<?php the_permalink(); ?>" class="card-link"><?php esc_html_e( 'Čítať viac →', 'scmlondon-new' ); ?></a>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <div class="news-more">
                    <?php the_posts_pagination( array( 'mid_size' => 1 ) ); ?>
                </div>

            <?php else : ?>
                <h2 class="section-label"><?php esc_html_e( 'Nič sa nenašlo', 'scmlondon-new' ); ?></h2>
                <p><?php esc_html_e( 'Skúste vyhľadať niečo iné.', 'scmlondon-new' ); ?></p>
                <?php get_search_form(); ?>
            <?php endif; ?>
        </section>
    </div>
</main>

<?php get_footer(); ?>
