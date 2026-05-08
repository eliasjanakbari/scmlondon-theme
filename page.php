<?php
/**
 * scmlondon new — single Page template.
 */
get_header(); ?>

<main class="main">
    <div class="container">
        <article class="card" style="padding:36px;">
            <?php while ( have_posts() ) : the_post(); ?>
                <h1 class="section-label"><?php the_title(); ?></h1>
                <div class="entry-content" style="font-size:0.95rem;color:var(--text-mid);line-height:1.7;">
                    <?php the_content(); ?>
                </div>
                <?php wp_link_pages(); ?>
            <?php endwhile; ?>
        </article>
    </div>
</main>

<?php get_footer(); ?>
