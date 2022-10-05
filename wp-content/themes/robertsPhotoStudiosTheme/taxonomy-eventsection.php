<?php
get_header();
?>
<?php
$event_achivelisting = blacksilver_get_option_data( 'event_achivelisting' );
$portfolio_perpage   = '6';
$count               = 0;
$columns             = $event_achivelisting;
$tagterm             = get_queried_object();
if ( ! isset( $tagterm->slug ) ) {
	$worktype = '';
} else {
	$worktype = $tagterm->slug;
}
?>
<div class="entry-content fullwidth-column clearfix">
<?php
$format = blacksilver_get_option_data( 'portfolio_archive_format' );
echo do_shortcode( '[gridcreate grid_post_type="events" grid_tax_type="eventsection" boxtitle="false" worktype_slugs="' . $worktype . '" format="' . $format . '" type="default" limit="-1" pagination="true" columns="' . $columns . '" title="true" desc="true"]' );
?>
</div>
<?php
get_footer();
?>
