<?php
function themecore_events_metadata() {
	$mtheme_imagepath =  plugin_dir_url( __FILE__ ) . 'assets/images/';

	$mtheme_sidebar_options = themecore_generate_sidebarlist('events');

	// Pull all the Featured into an array
	$bg_slideshow_pages = get_posts('post_type=fullscreen&orderby=title&numberposts=-1&order=ASC');

	if ($bg_slideshow_pages) {
		$options_bgslideshow['none'] = "Not Selected";
		foreach($bg_slideshow_pages as $key => $list) {
			$custom = get_post_custom($list->ID);
			if ( isset($custom["fullscreen_type"][0]) ) { 
				$slideshow_type=$custom["fullscreen_type"][0]; 
			} else {
			$slideshow_type="";
			}
			if ($slideshow_type<>"Fullscreen-Video") {
				$options_bgslideshow[$list->ID] = $list->post_title;
			}
		}
	} else {
		$options_bgslideshow[0]="Featured pages not found.";
	}

	$events_box = array(
		'id' => 'eventsmeta-box',
		'title' => esc_html__('Events Metabox','themecore'),
		'page' => 'page',
		'context' => 'normal',
		'priority' => 'core',
		'fields' => array(
			array(
				'name' => esc_html__('Event Settings','themecore'),
				'id' => 'pagemeta_events_section_id',
				'type' => 'break',
				'sectiontitle' => esc_html__('Events Settings','themecore'),
				'std' => ''
			),
			array(
				'name' => esc_html__('Event Options','themecore'),
				'id' => 'pagemeta_sep_page_options',
				'type' => 'seperator',
				),
			array(
				'name' => esc_html__('Gallery description text','themecore'),
				'id' => 'pagemeta_thumbnail_desc',
				'heading' => 'subhead',
				'type' => 'textarea',
				'desc' => esc_html__('Description text to displayed with evernts gallery thumbnail','themecore'),
				'std' => ''
			),
			array(
				'name' => esc_html__('Event Status','themecore'),
				'id' => 'pagemeta_event_notice',
				'class' => 'event_notice',
				'type' => 'select',
				'desc' => esc_html__('Event Status','themecore'),
				'options' => array(
					'active'    => esc_attr__('Active','themecore'),
					'inactive'  => esc_attr__('Hide from Listings','themecore'),
					'postponed' => esc_attr__('Display as Postponed','themecore'),
					'cancelled' => esc_attr__('Display as Cancelled','themecore'),
					'fullevent' => esc_attr__('Event is Full','themecore'),
					'pastevent' => esc_attr__('Past Event','themecore')
					),
			),
			array(
				'name' => esc_html__('Event Date','themecore'),
				'id' => 'pagemeta_event_startdate',
				'type' => 'datepicker',
				'class' => 'textsmall',
				'heading' => 'subhead',
				'desc' => esc_html__('Start date','themecore'),
				'std' => ''
			),
			array(
				'name' => 'End Date',
				'id' => 'pagemeta_event_enddate',
				'type' => 'datepicker',
				'class' => 'textsmall',
				'heading' => 'subhead',
				'desc' => esc_html__('End date','themecore'),
				'std' => ''
			),
			array(
				'name' => esc_html__('Display date in Events Grid','themecore'),
				'id' => 'pagemeta_event_dategrid',
				'class' => 'event_notice',
				'type' => 'select',
				'desc' => esc_html__('Display date in Events Grid','themecore'),
				'options' => array(
					'show'    => esc_attr__('Show','themecore'),
					'disable'  => esc_attr__('Disable','themecore'),
					),
			),
			array(
				'name' => esc_html__('Venue','themecore'),
				'id' => 'pagemeta_event_venue_name',
				'type' => 'text',
				'heading' => 'subhead',
				'desc' => esc_html__('Venue Name','themecore'),
				'std' => ''
			),
			array(
				'name' => '',
				'id' => 'pagemeta_event_venue_street',
				'type' => 'text',
				'heading' => 'subhead',
				'desc' => esc_html__('Street','themecore'),
				'std' => ''
			),
			array(
				'name' => '',
				'id' => 'pagemeta_event_venue_state',
				'type' => 'text',
				'class' => 'textsmall',
				'heading' => 'subhead',
				'desc' => esc_html__('State','themecore'),
				'std' => ''
			),
			array(
				'name' => '',
				'id' => 'pagemeta_event_venue_postal',
				'type' => 'text',
				'class' => 'textsmall',
				'heading' => 'subhead',
				'desc' => esc_html__('Zip/Postal Code','themecore'),
				'std' => ''
			),
			array(
				'name' => '',
				'id' => 'pagemeta_event_venue_country',
				'type' => 'country',
				'heading' => 'subhead',
				'desc' => esc_html__('Event country','themecore'),
				'std' => ''
			),
			array(
				'name' => '',
				'id' => 'pagemeta_event_venue_phone',
				'type' => 'text',
				'class' => 'textsmall',
				'heading' => 'subhead',
				'desc' => esc_html__('Phone','themecore'),
				'std' => ''
			),
			array(
				'name' => '',
				'id' => 'pagemeta_event_venue_website',
				'type' => 'text',
				'class' => 'textsmall',
				'heading' => 'subhead',
				'desc' => esc_html__('Website','themecore'),
				'std' => ''
			),
			array(
				'name' => '',
				'id' => 'pagemeta_event_venue_currency',
				'type' => 'text',
				'class' => 'textsmall',
				'heading' => 'subhead',
				'desc' => esc_html__('Cost Currency Symbol','themecore'),
				'std' => ''
			),
			array(
				'name' => '',
				'id' => 'pagemeta_event_venue_cost',
				'type' => 'text',
				'class' => 'textsmall',
				'heading' => 'subhead',
				'desc' => esc_html__('Cost Value','themecore'),
				'std' => ''
			),
			array(
				'name' => esc_html__('Page Settings','themecore'),
				'id' => 'pagemeta_page_section_id',
				'type' => 'break',
				'sectiontitle' => esc_html__('Page Settings','themecore'),
				'std' => ''
				),
			array(
				'name' => esc_html__('Page Style','themecore'),
				'id' => 'pagemeta_pagestyle',
				'type' => 'image',
				'std' => 'rightsidebar',
				'desc' => esc_html__('Note: Edge to Edge for Elementor Pagebuilder Layout','themecore'),
				'options' => array(
					'rightsidebar' => $mtheme_imagepath . 'page-right-sidebar.png',
					'leftsidebar' => $mtheme_imagepath . 'page-left-sidebar.png',
					'nosidebar' => $mtheme_imagepath . 'page-no-sidebar.png',
					'edge-to-edge' => $mtheme_imagepath . 'page-edge-to-edge.png')
				),
			array(
				'name' => esc_html__('Choice of Sidebar','themecore'),
				'id' => 'pagemeta_sidebar_choice',
				'type' => 'select',
				'desc' => esc_html__('For Sidebar Active Pages and Posts','themecore'),
				'options' => $mtheme_sidebar_options
				),
			array(
				'name' => esc_html__('Page Settings','themecore'),
				'id' => 'pagemeta_page_title_seperator',
				'type' => 'seperator',
				),
			array(
				'name' => esc_html__('Header Type','themecore'),
				'id' => 'pagemeta_header_type',
				'class' => 'condition-without-compact-style',
				'type' => 'select',
				'std' => 'enable',
				'desc' => esc_html__('Header Type for Horizontal menu','themecore'),
				'options' => array(
					'auto'            => esc_attr__('Default','themecore'),
					'inverse'         => esc_attr__('Inverse Opaque','themecore'),
					'overlay'         => esc_attr__('Overlay','themecore'),
					'inverse-overlay' => esc_attr__('Inverse Overlay','themecore'),
					)
				),
			array(
				'name' => esc_html__('Switch Menu','themecore'),
				'id' => 'pagemeta_menu_choice',
				'type' => 'select',
				'desc' => esc_html__('Select a different menu for this page','themecore'),
				'options' => themecore_generate_menulist()
				),
			array(
				'name' => esc_html__('Page Title','themecore'),
				'id' => 'pagemeta_page_title',
				'type' => 'select',
				'desc' => esc_html__('Page Title','themecore'),
				'std' => 'default',
				'options' => array(
					'default' => esc_attr__('Default','themecore'),
					'show' => esc_attr__('Show','themecore'),
					'hide' => esc_attr__('Hide','themecore')
					)
				),
			array(
				'name' => esc_html__('Instagram Footer','themecore'),
				'id' => 'pagemeta_instagram_footer',
				'type' => 'select',
				'std' => 'enable',
				'desc' => esc_html__('Enable / Disable Instagram Footer','themecore'),
				'options' => array(
					'enable' => esc_attr__('Enable','themecore'),
					'disable' => esc_attr__('Disable','themecore')
				)
			),
			array(
				'name' => esc_html__('Footer','themecore'),
				'id' => 'pagemeta_general_footer',
				'type' => 'select',
				'std' => 'enable',
				'desc' => esc_html__('Enable / Disable Footer','themecore'),
				'options' => array(
					'enable' => esc_attr__('Enable','themecore'),
					'disable' => esc_attr__('Disable','themecore')
					)
				),
			array(
				'name' => esc_html__('Page Background','themecore'),
				'id' => 'pagemeta_background_section_id',
				'type' => 'break',
				'sectiontitle' => esc_html__('Page Background','themecore'),
				'std' => ''
				),
			array(
				'name' => esc_html__('Page Background','themecore'),
				'id' => 'pagemeta_sep-page_backgrounds',
				'type' => 'seperator',
				),
			array(
				'name' => esc_html__('Page Color','themecore'),
				'id' => 'pagemeta_pagebackground_color',
				'type' => 'color',
				'desc' => esc_html__('Page color','themecore'),
				'std' => ''
				),
		)
	);
	return $events_box;
}
/*
* Meta options for Events post type
*/
function themecore_eventsitem_metaoptions(){
	$events_box = themecore_events_metadata();
	themecore_generate_metaboxes($events_box,get_the_id());
}
?>