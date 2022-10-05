<?php
/*
*  Events Page
*/
?>
<?php get_header(); ?>
<?php
if ( post_password_required() ) {
	echo '<div class="entry-content" id="password-protected">';
		blacksilver_display_password_form_action();
	echo '</div>';
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
			</div><!-- .entry-content -->
			<?php
		endwhile;
	endif;
	?>
	<?php
	if ( ! post_password_required() ) {
		if ( blacksilver_get_option_data( 'event_comments' ) ) {
			if ( comments_open() ) {
				comments_template();
			}
		}
	}
	?>
	</div>
	<?php
	if ( $sidebar_present ) {
		get_sidebar();
	}
}
get_footer();
?>
