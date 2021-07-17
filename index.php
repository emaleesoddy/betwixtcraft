<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if ( is_home() || is_front_page() ) : ?>
        <title>betwixtcraft</title>
        <meta name="title" content="betwixtcraft" />
       	<?php elseif ( is_page() ) : ?>
        <title><?php the_title_attribute(); ?> &mdash; betwixtcraft</title>
        <meta name="title" content="<?php the_title_attribute(); ?> &mdash; betwixtcraft" />
  	<?php elseif ( is_single() ) : ?>
        <title><?php the_title_attribute(); ?> &mdash; betwixtcraft</title>
        <meta name="title" content="<?php the_title_attribute(); ?> &mdash; betwixtcraft" />
        <meta name="description" content="<?php echo wp_strip_all_tags( get_the_excerpt(), true ); ?>" />
		<?php foreach((get_the_tags()) as $tag) {
			$keywords[] = strtolower($tag->name);
		}
		foreach((get_the_category()) as $category) {
			$keywords[] = strtolower($category->cat_name);
		} ?>
        <meta name="keywords" content="<?php echo implode(", ", array_unique($keywords)); ?>" />
	<?php elseif (is_archive()) : ?>

		<?php if ( is_tag() ) : ?>

            <title>#<?php echo single_tag_title(); ?> &mdash; betwixtcraft</title>
            <meta name="title" content="#<?php echo single_tag_title(); ?>  &mdash; emaleesoddy.com" />
            <meta name="description" content="<?php echo tag_description(); ?>" />
            <meta name="keywords" content="<?php echo single_tag_title(); ?> " />

		<?php else : ?>

            <title>topic: <?php echo single_cat_title(); ?> &mdash; betwixtcraft</title>
            <meta name="title" content="topic: <?php echo single_cat_title(); ?>  &mdash; emaleesoddy.com" />
            <meta name="description" content="<?php echo category_description(); ?>" />
            <meta name="keywords" content="<?php echo single_cat_title(); ?> " />

		<?php endif; ?>
	<?php endif; ?>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <header id="header">
        <div class="container">
            <h1><a href="/">betwixt<b>craft</b></a></h1>

			<?php if ( has_nav_menu( 'primary-menu' ) ) wp_nav_menu( array( 'theme_location' => 'primary-menu' ) ); ?>

        </div>
    </header>

    <div id="content">
        <div class="container">

	        <?php if ( is_home() || is_archive() ) : ?><div id="article"><?php endif; ?>

		    <?php if ( is_home() ) : ?>
            
		    <?php elseif (is_archive()) : ?>

			    <?php if ( is_tag() ) : ?>

                    <p>currently viewing posts tagged with: <strong><?php echo single_tag_title(); ?></strong></p>
				    <?php if(tag_description() !="") : ?>
                        <p><?php echo tag_description(); ?></p>
				    <?php endif; ?>

			    <?php else : ?>

                    <p>currently viewing: <strong><?php echo single_cat_title(); ?></strong></p>
				    <?php if(category_description() !="") : ?>
                        <p><?php echo category_description(); ?></p>
				    <?php endif; ?>

			    <?php endif; ?>

		    <?php endif; ?>

	        <?php if ( is_home() || is_archive() ) : ?><div class="excerpt-container"><?php endif; ?>


                <?php if ( have_posts() )  :

		    while ( have_posts() ) : the_post(); ?>

		    <?php
		    $thumb_id = get_post_thumbnail_id();
		    $thumb_url_array_lg = wp_get_attachment_image_src($thumb_id, 'large', true);
		    $thumb_url_array_full = wp_get_attachment_image_src($thumb_id, 'full', true);
		    $thumb_url_lg = $thumb_url_array_lg[0];
		    $thumb_url_full = $thumb_url_array_full[0];
		    ?>

		    <?php if ( is_home() || is_archive() ) : ?>

                <div class="excerpt" style="<?php if (has_post_thumbnail()) : ?>background-image:url('<?php echo $thumb_url_lg; ?>');<?php endif; ?>">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                        <div class="overlay"></div>
                        <div class="meta">
                            <h2><?php the_title_attribute(); ?></h2>
                            <span><?php the_time( get_option( 'date_format' ) ); ?></span>
                        </div>
                    </a>
                </div>

		    <?php else : ?>

            <div <?php post_class( 'post' ); ?>></div>

		    <?php if ( get_post_type() == 'post' || has_post_thumbnail() ) : ?>
                <div class="featured-image" style="<?php if (has_post_thumbnail()) : ?>background-image:url('<?php echo $thumb_url_full; ?>');<?php endif; ?>">
                    <div class="overlay"></div>
                    <div class="container">
                        <div class="title">
                            <h1><?php the_title_attribute(); ?></h1>
                        </div>
                    </div>
                    </a>
                </div>
		    <? endif; ?>

            <article id="article">
	            <?php if ( get_post_type() == 'post' ) : ?>

                    <div class="meta"><?php the_time( get_option( 'date_format' ) ); ?> in <strong><?php the_category( ', ' ); ?></strong> &middot; <?php echo betwixt_readingtime(); ?> minute read</div>
	            <? endif; ?>

                <?php $last_modified_note = get_post_custom_values( 'last-modified-note' );
                if ($last_modified_note[0] != null && $last_modified_note[0] != '') : ?>
                    <div class="post-note"><em>last modified: <? echo get_the_modified_date( get_option( 'date_format' ) ) ?></em> &rarr; <? echo $last_modified_note[0]; ?></div>
                <? endif; ?>

	            <?php the_content(); ?>

            </article>

                    <div class="meta tags">
				        <?php
				        if( $tags = get_the_tags() ) {
					        foreach( $tags as $tag ) {
						        $sep = ( $tag === end( $tags ) ) ? '' : ' ';
						        echo '<a href="' . get_term_link( $tag, $tag->taxonomy ) . '">#' . $tag->name . '</a>' . $sep;
					        }
				        }
				        ?>
                    </div><!-- .content -->

		        <?php

		        if ( is_singular() ) wp_link_pages(); ?>

            </div><!-- .post -->

        <?php endif; ?>

	    <?php

	    endwhile;

	    else : ?>

            <div class="post">

                <p>there&rsquo;s nothing here.</p>

            </div><!-- .post -->

	    <?php endif; ?>

            <?php if ( is_home() || is_archive() ) : ?></div><?php endif; ?>


            <?php    if ( ( ! is_singular() ) && ( $wp_query->post_count >= get_option( 'posts_per_page' ) ) ) : ?>

            <div class="pagination">

			    <?php previous_posts_link( '&larr; ' . __( 'Newer posts', 'davis' ) ); ?>
			    <?php next_posts_link( __( 'Older posts', 'davis') . ' &rarr;' ); ?>

            </div><!-- .pagination -->

	    <?php endif; ?>

            <?php if ( is_home() || is_archive() ) : ?></div><?php endif; ?>


            </div>

    </div> <!-- #content -->


<footer id="footer">
    <div class="container">
        <div class="footer-padding">
            <div id="copy">&copy; 2019<?php if (date( 'Y' ) > 2019) { echo '&ndash;'.date( 'Y' ); }?></div><div id="footer-menu"><?php if ( has_nav_menu( 'footer-menu' ) ) wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?></div>
            <div id="social">
                <a href="http://instagram.com/betwixtcraft" class="svg"><i class="fab fa-instagram svg"></i></a>
                <a href="mailto:e@betwixtcraft.com" class="svg"><i class="fas fa-envelope svg"></i></a>
                <a class="blsdk-follow" href="https://www.bloglovin.com/blogs/betwixtcraft-21064181" target="_blank" data-blsdk-type="button" data-blsdk-counter="false">Follow</a><script>(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) return;js = d.createElement(s);js.id = id;js.src = "https://www.bloglovin.com/widget/js/loader.js?v=1";fjs.parentNode.insertBefore(js, fjs);}(document, "script", "bloglovin-sdk"))</script></div>
        </div>
        </div>
        </div>

</footer><!-- .site-footer -->



<?php wp_footer(); ?>

</body>
</html>