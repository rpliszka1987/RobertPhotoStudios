<?php
/*
*  Page
*/
?>
<?php get_header(); ?>
<?php
$dont_show_page  = false;
$proofing_status = '';
$custom          = get_post_custom( get_the_id() );
if ( isset( $custom['pagemeta_client_names'][0] ) ) {
	$client_id = $custom['pagemeta_client_names'][0];
}
if ( isset( $custom['pagemeta_proofing_status'][0] ) ) {
	$proofing_status = $custom['pagemeta_proofing_status'][0];
}

if ( isset( $client_id ) && post_password_required( $client_id ) ) {
	$dont_show_page = true;
}
if ( 'inactive' === $proofing_status ) {
	$dont_show_page = true;
}
if ( class_exists( '\Elementor\Plugin' ) ) {
	if ( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
		$dont_show_page = false;
	}
}

if ( $dont_show_page ) {
	blacksilver_display_client_password( $client_id, $client_title = true, $desc = true, $eventdetails = false, $proofing_id = false, $pagetitle = false );
} else {
	$twocolumn_class  = '';
	$floatside        = '';
	$mtheme_pagestyle = 'nosidebar';

	$mtheme_pagestyle = blacksilver_get_pagestyle( get_the_id() );
	if ( ! isset( $mtheme_pagestyle ) || '' === $mtheme_pagestyle || empty( $mtheme_pagestyle ) ) {
		$mtheme_pagestyle = 'nosidebar';
	}
	$sidebar_present = false;
	if ( 'nosidebar' === $mtheme_pagestyle ) {
		$floatside = '';
	}
	if ( 'rightsidebar' === $mtheme_pagestyle ) {
		$floatside       = 'float-left';
		$sidebar_present = true;
	}
	if ( 'leftsidebar' === $mtheme_pagestyle ) {
		$floatside       = 'float-right';
		$sidebar_present = true;
	}
	if ( 'edge-to-edge' === $mtheme_pagestyle ) {
		$floatside        = '';
		$mtheme_pagestyle = 'nosidebar';
	}
	if ( $sidebar_present ) {
		$twocolumn_class = 'two-column';
	}
	?>
	<div class="page-contents-wrap <?php echo esc_attr( $floatside ); ?> <?php echo esc_attr( $twocolumn_class ); ?>">
	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-page-wrapper entry-content clearfix">
				<?php
					the_content();
				?>
				</div>
				<?php
				if ( comments_open() ) {
					echo '<div class="commentform-wrap-page">';
					comments_template();
					echo '</div>';
				}
				?>
			</div><!-- .entry-content -->
			<?php
		endwhile;
	endif;
	?>
	</div>
	<?php
	if ( $sidebar_present ) {
		get_sidebar();
	}
}
get_footer();
?>
