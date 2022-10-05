<?php
class Imaginem_Event_Posts {

    function __construct() 
    {	
        add_action('init', array( $this, 'init'));
        add_action('admin_init', array( $this, 'sort_admin_init'));

        add_filter("manage_edit-events_columns", array( $this, 'events_edit_columns'));
		add_filter('manage_posts_custom_column' , array( $this, 'events_custom_columns'));

		add_action('admin_menu', array( $this, 'mtheme_enable_event_sort') );
		add_action('wp_ajax_event_sort', array( $this, 'mtheme_save_event_order'));

		if( is_admin() ) {
			if ( isSet($_GET["page"]) ) {
				if ( $_GET["page"] == "class-imaginem-event-posts.php" ) {
					add_filter( 'posts_orderby', array( $this, 'mtheme_events_orderby'));
				}
			}
		}
	}


	function mtheme_events_orderby($orderby){
		global $wpdb;
		$orderby = "{$wpdb->posts}.menu_order, {$wpdb->posts}.post_date DESC";
		return($orderby);
	} 
	/* ************************************
	* Ajax Sort for Portfolio
	*************************************** */

	function mtheme_enable_event_sort() {
	    add_submenu_page('edit.php?post_type=events', 'Sort Events', 'Sort Event Items', 'edit_posts', basename(__FILE__), array( $this, 'mtheme_sort_event'));
	}

	 
	/**
	 * Display Sort admin
	 *
	 * @return void
	 * @author Soul
	 **/
	function mtheme_sort_event() {
		$portfolio = new WP_Query('post_type=events&posts_per_page=-1&orderby=menu_order&order=ASC');
	?>
		<div class="wrap">
		<h2>Sort Events<img src="<?php echo home_url(); ?>/wp-admin/images/loading.gif" id="loading-animation" /></h2>
		<div class="description">
		Drag and Drop the slides to order them
		</div>
		<ul id="portfolio-list">
		<?php while ( $portfolio->have_posts() ) : $portfolio->the_post(); ?>
			<li id="<?php the_id(); ?>">
			<div>
			<?php 
			$image_url=wp_get_attachment_thumb_url( get_post_thumbnail_id() );
			$custom = get_post_custom(get_the_ID());
			
			?>
			<?php if ($image_url) { echo '<img class="mtheme_admin_sort_image" src="'.$image_url.'" width="30px" height="30px" alt="" />'; } ?>
			<span class="mtheme_admin_sort_title"><?php the_title(); ?></span>
			</div>

			</li>
		<?php endwhile; ?>
		</div><!-- End div#wrap //-->
	 
	<?php
	}
	function mtheme_save_event_order() {
		global $wpdb; // WordPress database class
	 
		$order = explode(',', $_POST['order']);
		$counter = 0;
	 
		foreach ($order as $sort_id) {
			$wpdb->update($wpdb->posts, array( 'menu_order' => $counter ), array( 'ID' => $sort_id) );
			$counter++;
		}
		die(1);
	}

	// Kbase lister
	function events_edit_columns($columns){
	    $new_columns = array(
	        "mevent_section" => __('Section','mthemelocal'),
	        "event_image" => __('Image','mthemelocal')
	    );
	 
	    return array_merge($columns, $new_columns);
	}
	function events_custom_columns($columns) {
		global $post;
	    $custom = get_post_custom();
		$image_url=wp_get_attachment_thumb_url( get_post_thumbnail_id( $post->ID ) );
		
		$full_image_id = get_post_thumbnail_id(($post->ID), 'fullimage'); 
		$full_image_url = wp_get_attachment_image_src($full_image_id,'fullimage');
		if ( isset( $full_image_url[0] ) ) {
			$full_image_url = $full_image_url[0];
		}

	    switch ($columns)
	    {
	        case "event_image":
				if ( iSset($image_url) && $image_url<>"") {
	            	echo '<a class="thickbox" href="'.$full_image_url.'"><img src="'.$image_url.'" width="60px" height="60px" alt="featured" /></a>';
				}
	            break;
	        case "mevent_section":
	            echo get_the_term_list( get_the_id(), 'eventsection', '', ', ','' );
	            break;
	    } 
	}
	/*
	* kbase Admin columns
	*/
	
	/**
	 * Registers TinyMCE rich editor buttons
	 *
	 * @return	void
	 */
	function init()
	{
		/*
		* Register Featured Post Manager
		*/
		//add_action('init', 'mtheme_featured_register');
		//add_action('init', 'mtheme_kbase_register');//Always use a shortname like "mtheme_" not to see any 404 errors
		/*
		* Register kbase Post Manager
		*/

	    $mtheme_events_slug="events";
	    if (function_exists('blacksilver_get_option_data')) {
	    	$mtheme_events_slug = blacksilver_get_option_data('events_permalink_slug');
		}
	    if ( $mtheme_events_slug=="" || !isSet($mtheme_events_slug) ) {
	        $mtheme_events_slug="events";
	    }
	    $args = array(
            'labels' => array(
                'name' => 'Events',
                'menu_name' => 'Events',
                'singular_name' => 'Event',
                'all_items' => 'All Events'
            ),
	        'singular_label' => __('Event','mthemelocal'),
	        'public' => true,
	        'publicly_queryable' => true,
	        'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
	        'capability_type' => 'post',
	        'hierarchical' => false,
	        'has_archive' =>true,
			'menu_position' => 6,
	    	'menu_icon' => plugin_dir_url( __FILE__ ) . 'images/events.png',
	        'rewrite' => array('slug' => $mtheme_events_slug),//Use a slug like "work" or "project" that shouldnt be same with your page name
	        'supports' => array('title', 'author','excerpt','editor', 'comments', 'thumbnail','revisions')//Boxes will be shown in the panel
	       );
	 
	    register_post_type( 'events' , $args );
		/*
		* Add Taxonomy for kbase 'Type'
		*/
	    register_taxonomy( 'eventsection', array( 'events' ),
	        array(
	            'labels' => array(
	                'name' => 'Sections',
	                'menu_name' => 'Sections',
	                'singular_name' => 'Section',
	                'all_items' => 'All Sections'
	            ),
	            'public' => true,
	            'hierarchical' => true,
	            'show_ui' => true,
	            'rewrite' => array( 'slug' => 'events-section', 'hierarchical' => true, 'with_front' => false ),
	        )
	    );

	}
	/**
	 * Enqueue Scripts and Styles
	 *
	 * @return	void
	 */
	function sort_admin_init()
	{
		if( is_admin() ) {
			// Load only if in a Post or Page Manager	
			if ('edit.php' == basename($_SERVER['PHP_SELF'])) {
				wp_enqueue_script('jquery-ui-sortable');
				wp_enqueue_script('thickbox');
				wp_enqueue_style('thickbox');
				wp_enqueue_style( 'mtheme-portfolio-sorter-CSS',  plugin_dir_url( __FILE__ ) . '/css/style.css', false, '1.0', 'all' );
				if ( isSet($_GET["page"]) ) {
					if ( $_GET["page"] == "class-imaginem-event-posts.php" ) {
						wp_enqueue_script("post-sorter-JS", plugin_dir_url( __FILE__ ) . "js/post-sorter.js", array( 'jquery' ), "1.0");
					}
				}
			}
		}
	}
    
}
$mtheme_kbase_post_type = new Imaginem_Event_Posts();
?>