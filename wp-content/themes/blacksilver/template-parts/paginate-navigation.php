<div class="clearfix"></div>
<!-- ADD Custom Numbered Pagination code. -->
<?php
if ( isset( $additional_loop ) ) {
	blacksilver_pagination( $additional_loop->max_num_pages );
} else {
	blacksilver_pagination();
}