<?php
get_header();
?>
<?php
$event_achivelisting = blacksilver_get_option_data( 'event_achivelisting' );
$events_readmore     = blacksilver_get_option_data( 'events_readmore' );
$columns             = $event_achivelisting;

if ( empty( $columns ) ) {
	$columns = 3;
}
// Get which term is being querries and do shortcode with $term->slug
$event_term = get_queried_object();
if ( ! isset( $event_term->slug ) ) {
	$worktype = '';
} else {
	$worktype = $event_term->slug;
}
?>
<div class="entry-content fullwidth-column clearfix">
<?php
$format = blacksilver_get_option_data( 'events_archive_format' );
echo do_shortcode( '[gridcreate readmore_text="' . $events_readmore . '" grid_post_type="events" grid_tax_type="tagevents" boxtitle="false" worktype_slugs="' . esc_attr( $worktype ) . '" format="' . esc_attr( $format ) . '" type="default" limit="-1" pagination="true" columns="' . esc_attr( $columns ) . '" title="true" desc="true"]' );
?>
</div>
<?php get_footer(); ?>
