<?php
if ( true === blacksilver_get_option_data( 'hcontrolbar_enable' ) ) {
	?>
	<div class="slideshow-controls-wrap">
		<div id="controls-wrapper" class="load-item slideshow-control-item">
			<div id="controls">
				<!--Navigation-->
				<?php
				if ( true === blacksilver_get_option_data( 'hplaybutton_enable' ) ) {
					?>
					<a id="play-button" class="super-nav-item"><i id="pauseplay" class="ion-ios-pause"></i></a>
					<?php
				}
				?>
				<!--Arrow Navigation-->
				<?php
				if ( true === blacksilver_get_option_data( 'hnavigation_enable' ) ) {
					?>
					<a id="prevslide" class="prevnext-nav load-item super-nav-item"><i class="ion-ios-arrow-thin-left"></i></a>
					<a id="nextslide" class="prevnext-nav load-item super-nav-item"><i class="ion-ios-arrow-thin-right"></i></a>
					<?php
				}
				?>
			</div>
		</div>
	</div>
	<?php
}
?>
<!--Control Bar-->
<!--Time Bar-->
<?php
if ( true === blacksilver_get_option_data( 'hprogressbar_enable' ) ) {
	?>
	<div id="progress-back" class="load-item">
		<div id="progress-bar"></div>
	</div>
	<?php
}
