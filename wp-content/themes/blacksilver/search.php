<?php
/*
*  Search Page
*/get_header();
$pagestyle = '';
if ( is_active_sidebar( 'default_sidebar' ) ) {
	$pagestyle = 'float-left two-column';
}
if ( have_posts() ) :
	?>
	<div class="contents-wrap <?php echo esc_attr( $pagestyle ); ?>">
		<?php
		get_template_part( 'loop', 'search' );
		?>
	</div>
	<?php get_sidebar(); ?>
	<?php else : ?>
	<div class="page-contents-wrap">
		<div class="entry-wrapper lower-padding">
		<div class="entry-spaced-wrapper">
			<div class="entry-content mtheme-search-no-results">
				<h4><?php esc_html_e( 'Nothing Found', 'blacksilver' ); ?></h4>
				<p><?php esc_html_e( 'Sorry, but nothing matched your search criteria. Please try again with different keywords.', 'blacksilver' ); ?></p>
				<?php get_search_form(); ?>
			</div><!-- .entry-content -->
		</div>
		</div>
	</div>
<?php endif;
get_footer();
?>
