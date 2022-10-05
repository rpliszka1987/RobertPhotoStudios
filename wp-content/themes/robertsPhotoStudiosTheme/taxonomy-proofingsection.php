<?php
get_header();
$columns        = blacksilver_get_option_data( 'proofing_achivelisting' );
$count          = 0;
$proofing_term = get_queried_object();
if ( ! isset( $proofing_term->slug ) ) {
	$worktype = '';
} else {
	$worktype = $proofing_term->slug;
}
?>
<div class="entry-content fullwidth-column clearfix">
<?php
$format  = blacksilver_get_option_data( 'proofing_archive_format' );
$columns = blacksilver_get_option_data( 'proofing_achivelisting' );
echo '<div class="detect-isotope">';
$shortcode = '[proofingarchive boxthumbnail_link="direct" category_display="yes" effect="default" type="no-filter" style="classic" like=no columns="'.$columns.'" format="'.$format.'" worktype_slugs="'.$worktype.'" title="true" pagination="true" limit="-1"] ';
echo do_shortcode( $shortcode );
echo '</div>';
?>
</div>
<?php
get_footer();
