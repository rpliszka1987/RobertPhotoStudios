<?php
$post_nav_class      = ' post-nav-has-no-prev-next';
$postnavigation_prev = blacksilver_get_option_data( 'postnavigation_prev' );
$postnavigation_next = blacksilver_get_option_data( 'postnavigation_next' );
$prev_post           = get_previous_post();
$next_post           = get_next_post();
if ( empty( $prev_post ) ) {
	$post_nav_class = ' post-nav-has-no-prev';
}
if ( empty( $next_post ) ) {
	$post_nav_class = ' post-nav-has-no-next';
}
?>
<div class="post-thumbnail-navigation<?php echo esc_attr( $post_nav_class ); ?>">
<?php
if ( ! empty( $prev_post ) ) :
	?>
		<div class="post-thumbnail-navigation-outer post-thumbnail-navigation-outer-left">
			<div class="post-nav-thumbnail post-nav-thumbnail-left">
				<a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>">
					<?php echo get_the_post_thumbnail( $prev_post->ID, 'thumbnail' ); ?>
				</a>
			</div>
			<div class="post-thumbnail-navigation-inner post-thumbnail-navigation-inner-left">
				<a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>">
					<div class="post-thumbnail-nav post-thumbnail-nav-prev">
						<span class="post-thumbnail-desc">
							<?php
							echo wp_kses( $postnavigation_prev, blacksilver_get_allowed_tags() );
							?>
						</span>
						<span class="post-thumbnail-nav-link">
						<?php
						echo esc_html( $prev_post->post_title );
						?>
						</span>
					</div>
				</a>
			</div>
		</div>
	<?php
endif;
if ( ! empty( $next_post ) ) :
	?>
		<div class="post-thumbnail-navigation-outer post-thumbnail-navigation-outer-right">
			<div class="post-thumbnail-navigation-inner post-thumbnail-navigation-right">
				<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
					<div class="post-thumbnail-nav post-thumbnail-nav-next">
						<span class="post-thumbnail-desc">
							<?php
							echo wp_kses( $postnavigation_next, blacksilver_get_allowed_tags() );
							?>
						</span>
						<span class="post-thumbnail-nav-link">
						<?php
						echo esc_html( $next_post->post_title );
						?>
						</span>
					</div>
				</a>
			</div>
			<div class="post-nav-thumbnail post-nav-thumbnail-right">
				<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
					<?php echo get_the_post_thumbnail( $next_post->ID, 'thumbnail' ); ?>
				</a>
			</div>
		</div>
	<?php
endif;
?>
</div>
