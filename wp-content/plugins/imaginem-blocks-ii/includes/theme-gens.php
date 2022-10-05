<?php
function themecore_featured_image_link( $the_image_id ) {
	if ( ! isset( $the_image_id ) ) {
		$the_image_id = get_the_id();
	}
	$image_id  = get_post_thumbnail_id( $the_image_id, 'full' );
	$image_url = wp_get_attachment_image_src( $image_id, 'full' );
	if ( isset( $image_url[0] ) ) {
		$image_url = $image_url[0];
	}
	return $image_url;
}
function themecore_rev_slider_selectors() {
	$mtheme_revslides=array();
	$mtheme_revslides['mtheme-none-selected'] = 'Not Selected';
	if(function_exists('rev_slider_shortcode')) {

		$query_sliders = array();
		if ( class_exists( 'RevSlider' ) ) {
			$slider = new RevSlider();
			$objSliders = $slider->get_sliders();

			if(isSet($objSliders)) {
				foreach($objSliders as $sliders) {
					$mtheme_revslides[$sliders->alias] = $sliders->alias;
				}
			}
		}
	}
	return $mtheme_revslides;
}
function themecore_generate_menulist () {
	$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
	$menu_select=false;
	if ( isSet($menus) ) {
		$menu_select = array();
		$menu_select['default'] = esc_html__('Default Menu','themecore');

		foreach ( $menus as $menu ) {
			$menu_select[$menu->term_id] = $menu->name;
		}
	}
	return $menu_select;
}
function themecore_get_elementor_data($post_id,$field_id) {

	$got_data = false;

	if ( themecore_page_is_built_with_elementor( $post_id ) ) {
		$elementor_page_settings = get_post_meta( $post_id, '_elementor_page_settings', true );
		if ( isSet($elementor_page_settings[ $field_id ]) ) {
			$got_data = $elementor_page_settings[ $field_id ];
		}
	}

	return $got_data;

}
function themecore_get_pagestyle( $post_id ) {
  $got_pagestyle = get_post_meta( $post_id, 'pagemeta_pagestyle', true );

  switch ($got_pagestyle) {
  	case 'rightsidebar':
  		$pagestyle = 'rightsidebar';
  		break;
  	case 'leftsidebar':
  		$pagestyle = 'leftsidebar';
  		break;
  	case 'nosidebar':
  		$pagestyle = 'nosidebar';
  		break;
  	case 'edge-to-edge':
  		$pagestyle = 'edge-to-edge';
  		break;
  	
  	default:
  		$pagestyle = 'rightsidebar';

  		if ( themecore_page_is_built_with_elementor( $post_id ) ) {
  			$pagestyle = 'edge-to-edge';
  		}
  		
  		break;
  }
  return $pagestyle;
}
function themecore_has_password($id) {
	$checking_for_password = get_post($id);
	if(!empty($checking_for_password->post_password)){
		return true;
	}
	return false;
}
function themecore_get_select_target_options($type) {
    $list_options = array();
    
    switch($type){
		case 'post':
			$the_list = get_posts('orderby=title&numberposts=-1&order=ASC');
			foreach($the_list as $key => $list) {
				$list_options[$list->ID] = $list->post_title;
			}
			break;
		case 'page':
			$the_list = get_pages('title_li=&orderby=name');
			foreach($the_list as $key => $list) {
				$list_options[$list->ID] = $list->post_title;
			}
			break;
		case 'category':
			$the_list = get_categories('orderby=name&hide_empty=0');
			foreach($the_list as $key => $list) {
				$list_options[$list->term_id] = $list->name;
			}
			break;
		case 'backgroundslideshow_choices':
			$list_options = array(
				'options_slideshow'=>esc_html__('Customizer Set Slideshow Images','blacksilver'),
				'image_attachments'=>esc_html__('Slideshow using Image Attachments','blacksilver'),
				'none'=>esc_html__('none','blacksilver')
				);
			break;
		case 'portfolio_category':
			$the_list = get_categories('taxonomy=types&title_li=');
			foreach($the_list as $key => $list) {
				$list_options[$list->slug] = $list->name;
			}
			array_unshift($list_options, "All the items");
			break;
		case 'client_names':
			// Pull all the Featured into an array
			$featured_pages = get_posts('post_type=clients&orderby=title&numberposts=-1&order=ASC');
			$list_options['none'] = "Not Selected";
			if ($featured_pages) {
				foreach($featured_pages as $key => $list) {
					$list_options[$list->ID] = $list->post_title;
				}
			} else {
				$list_options[0]="Clients not found.";
			}
			break;
		case 'fullscreen_slideshow_posts':
			// Pull all the Featured into an array
			$featured_pages = get_posts('post_type=fullscreen&orderby=title&numberposts=-1&order=ASC');
			$list_options['none'] = "Not Selected";
			if ($featured_pages) {
				foreach($featured_pages as $key => $list) {
					$custom = get_post_custom($list->ID);
					if ( isSet($custom[ "pagemeta_fullscreen_type"][0]) ) { 
						$slideshow_type=$custom[ "pagemeta_fullscreen_type"][0]; 
					} else {
						$slideshow_type="";
					}
					if ( $slideshow_type != "video" && $slideshow_type<>"" && $slideshow_type != "photowall" && $slideshow_type != "revslider" ) {
						$list_options[$list->ID] = $list->post_title;
					}
				}
			} else {
				$list_options[0]="Featured pages not found.";
			}
			break;
		case 'fullscreen_video_bg':
			// Pull all the Featured into an array
			$featured_pages = get_posts('post_type=fullscreen&orderby=title&numberposts=-1&order=ASC');
			$list_options['none'] = "Not Selected";
			if ($featured_pages) {
				foreach($featured_pages as $key => $list) {
					$custom = get_post_custom($list->ID);
					if ( isSet($custom[ "pagemeta_fullscreen_type"][0]) ) { 
						$slideshow_type=$custom[ "pagemeta_fullscreen_type"][0]; 
					} else {
						$slideshow_type="";
					}
					if ($slideshow_type == "video") {
						if ( isSet($custom[ "pagemeta_html5_mp4"][0]) || isSet($custom[ "pagemeta_youtubevideo"][0]) ) {
							$list_options[$list->ID] = $list->post_title;
						}
					}
				}
			} else {
				$list_options[0]="Featured pages not found.";
			}
			break;
		case 'fullscreen_posts':
			// Pull all the Featured into an array
			$featured_pages = get_posts('post_type=fullscreen&orderby=title&numberposts=-1&order=ASC');
			$list_options['none'] = "Not Selected";
			if ($featured_pages) {
				foreach($featured_pages as $key => $list) {
					$custom = get_post_custom($list->ID);
					if ( isset($custom[ "pagemeta_fullscreen_type"][0]) ) { 
						$slideshow_type=$custom[ "pagemeta_fullscreen_type"][0]; 
					} else {
						$slideshow_type="";
					}
					$list_options[$list->ID] = $list->post_title;
				}
			} else {
				$list_options[0]="Featured pages not found.";
			}
			break;
	}
	
	return $list_options;
}
function themecore_country_list($output_type="select",$selected=""){
	$countries = array
	(
		'none' => "Choose Country",
		'AF' => 'Afghanistan',
		'AX' => 'Aland Islands',
		'AL' => 'Albania',
		'DZ' => 'Algeria',
		'AS' => 'American Samoa',
		'AD' => 'Andorra',
		'AO' => 'Angola',
		'AI' => 'Anguilla',
		'AQ' => 'Antarctica',
		'AG' => 'Antigua And Barbuda',
		'AR' => 'Argentina',
		'AM' => 'Armenia',
		'AW' => 'Aruba',
		'AU' => 'Australia',
		'AT' => 'Austria',
		'AZ' => 'Azerbaijan',
		'BS' => 'Bahamas',
		'BH' => 'Bahrain',
		'BD' => 'Bangladesh',
		'BB' => 'Barbados',
		'BY' => 'Belarus',
		'BE' => 'Belgium',
		'BZ' => 'Belize',
		'BJ' => 'Benin',
		'BM' => 'Bermuda',
		'BT' => 'Bhutan',
		'BO' => 'Bolivia',
		'BA' => 'Bosnia And Herzegovina',
		'BW' => 'Botswana',
		'BV' => 'Bouvet Island',
		'BR' => 'Brazil',
		'IO' => 'British Indian Ocean Territory',
		'BN' => 'Brunei Darussalam',
		'BG' => 'Bulgaria',
		'BF' => 'Burkina Faso',
		'BI' => 'Burundi',
		'KH' => 'Cambodia',
		'CM' => 'Cameroon',
		'CA' => 'Canada',
		'CV' => 'Cape Verde',
		'KY' => 'Cayman Islands',
		'CF' => 'Central African Republic',
		'TD' => 'Chad',
		'CL' => 'Chile',
		'CN' => 'China',
		'CX' => 'Christmas Island',
		'CC' => 'Cocos (Keeling) Islands',
		'CO' => 'Colombia',
		'KM' => 'Comoros',
		'CG' => 'Congo',
		'CD' => 'Congo, Democratic Republic',
		'CK' => 'Cook Islands',
		'CR' => 'Costa Rica',
		'CI' => 'Cote D\'Ivoire',
		'HR' => 'Croatia',
		'CU' => 'Cuba',
		'CY' => 'Cyprus',
		'CZ' => 'Czech Republic',
		'DK' => 'Denmark',
		'DJ' => 'Djibouti',
		'DM' => 'Dominica',
		'DO' => 'Dominican Republic',
		'EC' => 'Ecuador',
		'EG' => 'Egypt',
		'SV' => 'El Salvador',
		'GQ' => 'Equatorial Guinea',
		'ER' => 'Eritrea',
		'EE' => 'Estonia',
		'ET' => 'Ethiopia',
		'FK' => 'Falkland Islands (Malvinas)',
		'FO' => 'Faroe Islands',
		'FJ' => 'Fiji',
		'FI' => 'Finland',
		'FR' => 'France',
		'GF' => 'French Guiana',
		'PF' => 'French Polynesia',
		'TF' => 'French Southern Territories',
		'GA' => 'Gabon',
		'GM' => 'Gambia',
		'GE' => 'Georgia',
		'DE' => 'Germany',
		'GH' => 'Ghana',
		'GI' => 'Gibraltar',
		'GR' => 'Greece',
		'GL' => 'Greenland',
		'GD' => 'Grenada',
		'GP' => 'Guadeloupe',
		'GU' => 'Guam',
		'GT' => 'Guatemala',
		'GG' => 'Guernsey',
		'GN' => 'Guinea',
		'GW' => 'Guinea-Bissau',
		'GY' => 'Guyana',
		'HT' => 'Haiti',
		'HM' => 'Heard Island & Mcdonald Islands',
		'VA' => 'Holy See (Vatican City State)',
		'HN' => 'Honduras',
		'HK' => 'Hong Kong',
		'HU' => 'Hungary',
		'IS' => 'Iceland',
		'IN' => 'India',
		'ID' => 'Indonesia',
		'IR' => 'Iran, Islamic Republic Of',
		'IQ' => 'Iraq',
		'IE' => 'Ireland',
		'IM' => 'Isle Of Man',
		'IL' => 'Israel',
		'IT' => 'Italy',
		'JM' => 'Jamaica',
		'JP' => 'Japan',
		'JE' => 'Jersey',
		'JO' => 'Jordan',
		'KZ' => 'Kazakhstan',
		'KE' => 'Kenya',
		'KI' => 'Kiribati',
		'KR' => 'Korea',
		'KW' => 'Kuwait',
		'KG' => 'Kyrgyzstan',
		'LA' => 'Lao People\'s Democratic Republic',
		'LV' => 'Latvia',
		'LB' => 'Lebanon',
		'LS' => 'Lesotho',
		'LR' => 'Liberia',
		'LY' => 'Libyan Arab Jamahiriya',
		'LI' => 'Liechtenstein',
		'LT' => 'Lithuania',
		'LU' => 'Luxembourg',
		'MO' => 'Macao',
		'MK' => 'Macedonia',
		'MG' => 'Madagascar',
		'MW' => 'Malawi',
		'MY' => 'Malaysia',
		'MV' => 'Maldives',
		'ML' => 'Mali',
		'MT' => 'Malta',
		'MH' => 'Marshall Islands',
		'MQ' => 'Martinique',
		'MR' => 'Mauritania',
		'MU' => 'Mauritius',
		'YT' => 'Mayotte',
		'MX' => 'Mexico',
		'FM' => 'Micronesia, Federated States Of',
		'MD' => 'Moldova',
		'MC' => 'Monaco',
		'MN' => 'Mongolia',
		'ME' => 'Montenegro',
		'MS' => 'Montserrat',
		'MA' => 'Morocco',
		'MZ' => 'Mozambique',
		'MM' => 'Myanmar',
		'NA' => 'Namibia',
		'NR' => 'Nauru',
		'NP' => 'Nepal',
		'NL' => 'Netherlands',
		'AN' => 'Netherlands Antilles',
		'NC' => 'New Caledonia',
		'NZ' => 'New Zealand',
		'NI' => 'Nicaragua',
		'NE' => 'Niger',
		'NG' => 'Nigeria',
		'NU' => 'Niue',
		'NF' => 'Norfolk Island',
		'MP' => 'Northern Mariana Islands',
		'NO' => 'Norway',
		'OM' => 'Oman',
		'PK' => 'Pakistan',
		'PW' => 'Palau',
		'PS' => 'Palestinian Territory, Occupied',
		'PA' => 'Panama',
		'PG' => 'Papua New Guinea',
		'PY' => 'Paraguay',
		'PE' => 'Peru',
		'PH' => 'Philippines',
		'PN' => 'Pitcairn',
		'PL' => 'Poland',
		'PT' => 'Portugal',
		'PR' => 'Puerto Rico',
		'QA' => 'Qatar',
		'RE' => 'Reunion',
		'RO' => 'Romania',
		'RU' => 'Russian Federation',
		'RW' => 'Rwanda',
		'BL' => 'Saint Barthelemy',
		'SH' => 'Saint Helena',
		'KN' => 'Saint Kitts And Nevis',
		'LC' => 'Saint Lucia',
		'MF' => 'Saint Martin',
		'PM' => 'Saint Pierre And Miquelon',
		'VC' => 'Saint Vincent And Grenadines',
		'WS' => 'Samoa',
		'SM' => 'San Marino',
		'ST' => 'Sao Tome And Principe',
		'SA' => 'Saudi Arabia',
		'SN' => 'Senegal',
		'RS' => 'Serbia',
		'SC' => 'Seychelles',
		'SL' => 'Sierra Leone',
		'SG' => 'Singapore',
		'SK' => 'Slovakia',
		'SI' => 'Slovenia',
		'SB' => 'Solomon Islands',
		'SO' => 'Somalia',
		'ZA' => 'South Africa',
		'GS' => 'South Georgia And Sandwich Isl.',
		'ES' => 'Spain',
		'LK' => 'Sri Lanka',
		'SD' => 'Sudan',
		'SR' => 'Suriname',
		'SJ' => 'Svalbard And Jan Mayen',
		'SZ' => 'Swaziland',
		'SE' => 'Sweden',
		'CH' => 'Switzerland',
		'SY' => 'Syrian Arab Republic',
		'TW' => 'Taiwan',
		'TJ' => 'Tajikistan',
		'TZ' => 'Tanzania',
		'TH' => 'Thailand',
		'TL' => 'Timor-Leste',
		'TG' => 'Togo',
		'TK' => 'Tokelau',
		'TO' => 'Tonga',
		'TT' => 'Trinidad And Tobago',
		'TN' => 'Tunisia',
		'TR' => 'Turkey',
		'TM' => 'Turkmenistan',
		'TC' => 'Turks And Caicos Islands',
		'TV' => 'Tuvalu',
		'UG' => 'Uganda',
		'UA' => 'Ukraine',
		'AE' => 'United Arab Emirates',
		'GB' => 'United Kingdom',
		'US' => 'United States',
		'UM' => 'United States Outlying Islands',
		'UY' => 'Uruguay',
		'UZ' => 'Uzbekistan',
		'VU' => 'Vanuatu',
		'VE' => 'Venezuela',
		'VN' => 'Viet Nam',
		'VG' => 'Virgin Islands, British',
		'VI' => 'Virgin Islands, U.S.',
		'WF' => 'Wallis And Futuna',
		'EH' => 'Western Sahara',
		'YE' => 'Yemen',
		'ZM' => 'Zambia',
		'ZW' => 'Zimbabwe',
	);
	$country_list = false;
	if ($output_type=="select") {
		$country_list="";
		foreach ($countries as $key => $option) {
		    if ($selected==$key) {
		    	$country_selected='selected="selected"';
		    } else {
		    	$country_selected="";
		    }
			$country_list .= '<option value="'. esc_attr($key) .'" '.$country_selected.'>'. esc_attr($option) . '</option>';
		}
	}
	if ($output_type=="display") {
		if (array_key_exists($selected,$countries)) {
			$country_list = $countries[$selected];
		}
	}
	return $country_list;
}
function themecore_get_image_id_from_url($image_url) {
	$attachment = attachment_url_to_postid($image_url);
	if ( $attachment ) {
    	return $attachment;
	} else {
		return false;
	}
}
function themecore_get_custom_attachments( $page_id ) {
	$filter_image_ids = false;
	$the_image_ids = get_post_meta( $page_id , '_mtheme_image_ids');
	if ($the_image_ids) {
		$filter_image_ids = explode(',', $the_image_ids[0]);
		return $filter_image_ids;
	}
}
function themecore_page_is_built_with_elementor( $post_id ) {
  $status = get_post_meta( $post_id, '_elementor_edit_mode', true );
  return $status;
}
function themecore_get_max_sidebars() {
    $max_sidebars = 50;
    return $max_sidebars;
}
function themecore_get_option_data( $name, $default = false ) {
	
	$opt_value=get_theme_mod( $name );
	if ( isset( $opt_value ) && $opt_value<>"" ) {
		return $opt_value;
	}
	return $default;
}
?>