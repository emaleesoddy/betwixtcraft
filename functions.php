<?php

/* NAVIGATION
------------------------------------------------ */

		register_nav_menu( 'primary-menu', __( 'Primary Menu', 'betwixtcraft' ) );
		register_nav_menu( 'footer-menu', __( 'Footer Menu', 'betwixtcraft' ) );

/* ARCHIVE PREFIXES
------------------------------------------------ */

	function betwixt_prefixes( $title ) {
		if ( is_category() ) {
			$title = single_cat_title( '', false );
		} else if ( is_tag() ) {
			$title = single_tag_title( '', false );
		}
		return $title;
	}

	add_filter( 'get_the_archive_title', 'prefix_archive_title' );

/* TIME TO READ
------------------------------------------------ */
function betwixt_readingtime(){
	ob_start();
	the_content();
	$content = ob_get_clean();
	$wordcount = sizeof(explode(" ", $content));
	return ceil($wordcount / 200);
}

/* FEATURED IMAGE
------------------------------------------------ */
add_theme_support( 'post-thumbnails' );

/* EDITOR
------------------------------------------------ */
function custom_admin_css() {
	echo '<style type="text/css">
.wp-block { max-width: 960px; }
.editor-styles-wrapper .mce-content-body p {
    margin-bottom: 1rem !important;
    line-height: 2rem; }
    .editor-block-list__block-edit {
    margin:1rem 0 !important;
    }
    .editor-block-list__layout .editor-block-list__block {
    padding-left:14px !important;
        padding-right:14px !important;

    }
</style>';
}
add_action('admin_head', 'custom_admin_css');

/* PERMALINKS
------------------------------------------------ */


?>
