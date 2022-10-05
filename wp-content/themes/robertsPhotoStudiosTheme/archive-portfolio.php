<?php
get_header();
$columns        = blacksilver_get_option_data( 'portfolio_achivelisting' );
$count          = 0;
$portfolio_term = get_queried_object();
if ( ! isset( $portfolio_term->slug ) ) {
	$worktype = '';
} else {
	$worktype = $portfolio_term->slug;
}
?>
<div class="entry-content fullwidth-column portfolio-archive-grid-container clearfix">
<div class="lightgallery-detect-container">
<?php
$format = blacksilver_get_option_data( 'portfolio_archive_format' );
echo do_shortcode( '[portfoliogrid worktype_slugs="' . esc_attr( $worktype ) . '" boxtitle="false" format="' . esc_attr( $format ) . '" type="default" limit="-1" pagination="true" columns="' . esc_attr( $columns ) . '" title="true" desc="true"]' );
?>
</div>
</div>
<?php
get_footer();
