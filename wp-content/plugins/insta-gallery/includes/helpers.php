<?php

include_once(QLIGG_PLUGIN_DIR . 'includes/models/Token.php');
include_once(QLIGG_PLUGIN_DIR . 'includes/models/Setting.php');

function qligg_sanitize_instagram_feed($feed) {

  global $qligg_api;

  // Removing @, # and trimming input
  // ---------------------------------------------------------------------

  $feed = sanitize_text_field($feed);

  $feed = trim($feed);
  $feed = str_replace('@', '', $feed);
  $feed = str_replace('#', '', $feed);
  $feed = str_replace($qligg_api->instagram_url, '', $feed);
  $feed = str_replace('/explore/tags/', '', $feed);
  $feed = str_replace('/', '', $feed);

  return $feed;
}

// Return user profile
// -----------------------------------------------------------------------------
function qligg_get_user_profile($user_id = null) {

  global $qligg_api;

  $settings_model = new QLIGG_Setting();
  $settings = $settings_model->get_settings();
  $token_model = new QLIGG_Token();
  $tokens = $token_model->get_tokens();

  $profile_info = array();

  $tk = "insta_gallery_user_profile"; // transient key

  $defaults = array(
      'id' => '',
      'user' => 'nousername',
      'name' => esc_html__('Something went wrong, remove this token', 'insta-gallery'),
      'picture' => 'http://2.gravatar.com/avatar/b642b4217b34b1e8d3bd915fc65c4452?s=96&d=mm&r=g',
      'link' => ''
  );

  if (empty($user_id) || !isset($tokens[$user_id])) {
    return $defaults;
  }

  if (QLIGG_DEVELOPER || false === ($profile_info = get_transient($tk))) {
    foreach ($tokens as $id => $access_token) {
      $profile_info[$id] = $qligg_api->get_user_profile($access_token);
    }
    set_transient($tk, $profile_info, absint($settings['insta_reset']) * HOUR_IN_SECONDS);
  }

  if (!isset($profile_info[$user_id])) {
    return $defaults;
  }

  return wp_parse_args(array(
      'id' => $profile_info[$user_id]['id'],
      'user' => "@{$profile_info[$user_id]['username']}",
      'name' => $profile_info[$user_id]['full_name'],
      'picture' => $profile_info[$user_id]['profile_picture'],
      'link' => "{$qligg_api->instagram_url}/{$profile_info[$user_id]['username']}"
          ), $defaults);
}

// Return tag info
// -----------------------------------------------------------------------------
function qligg_get_tag_profile($tag = null) {

  global $qligg_api;

  if (!$tag) {
    return;
  }

  $settings_model = new QLIGG_Setting();
  $settings = $settings_model->get_settings();

  $tk = "insta_gallery_tag_items_{$tag}_";

  // Get any existing copy of our transient data
  if (QLIGG_DEVELOPER || false === ($response = get_transient($tk))) {
    if ($response = $qligg_api->get_tag_items($tag)) {
      set_transient($tk, $response, absint($settings['insta_reset']) * HOUR_IN_SECONDS);
    }
  }

  $defaults = array(
      'id' => '',
      'user' => 'notag',
      'name' => esc_html__('Something went wrong, remove this this tag', 'insta-gallery'),
      'picture' => 'http://2.gravatar.com/avatar/b642b4217b34b1e8d3bd915fc65c4452?s=96&d=mm&r=g',
      'link' => ''
  );

  if (!isset($response['graphql']['hashtag'])) {
    return $defaults;
  }

  return wp_parse_args(array(
      'id' => $response['graphql']['hashtag']['id'],
      'user' => "#{$response['graphql']['hashtag']['name']}",
      'name' => sprintf(esc_html__('Tag #%s', 'insta-gallery'), $response['graphql']['hashtag']['name']),
      'picture' => $response['graphql']['hashtag']['profile_pic_url'],
      'link' => "{$qligg_api->instagram_url}/explore/tags/{$tag}"
          ), $defaults);
}

// Get user feed
// -----------------------------------------------------------------------------
function qligg_get_user_items($user_id = null, $limit = 12, $next_max_id = null, $max_id = null) {

  global $qligg_api;

  if (!$user_id) {
    $qligg_api->set_message(esc_html__('Please update Instagram User in the gallery settings tab.', 'insta-gallery'));
    return;
  }

  $token_model = new QLIGG_Token();
  $tokens = $token_model->get_tokens();

  if (empty($tokens[$user_id])) {
    $qligg_api->set_message(esc_html__('Please update Instagram Access Token in the account settings tab.', 'insta-gallery'));
    return;
  }

  $settings_model = new QLIGG_Setting();
  $settings = $settings_model->get_settings();

  $tk = "insta_gallery_user_items_{$user_id}_{$max_id}";

  // Get any existing copy of our transient data
  if (QLIGG_DEVELOPER || false === ($response = get_transient($tk))) {
    if ($response = $qligg_api->get_user_items($tokens[$user_id], $max_id)) {
      set_transient($tk, $response, absint($settings['insta_reset']) * HOUR_IN_SECONDS);
    }
  }

  if (!isset($response['data'])) {
    return;
  }

  if (count($feeds = $qligg_api->setup_user_item($response['data'], $next_max_id, $max_id)) >= $limit) {
    return $feeds;
  }

  if (!$next_max_id) {
    return $feeds;
  }

  if (!isset($response['pagination']['next_max_id'])) {
    return $feeds;
  }

  $max_id = $response['pagination']['next_max_id'];

  return array_merge($feeds, qligg_get_user_items($user_id, $limit, $next_max_id, $max_id));
}

// Get tag items
// -----------------------------------------------------------------------------
function qligg_get_tag_items($tag = null, $limit = 12, $next_max_id = null, $end_cursor = null) {

  global $qligg_api;

  $token_model = new QLIGG_Token();
  $tokens = $token_model->get_tokens();

  if (!$tag) {
    return;
  }

  $settings_model = new QLIGG_Setting();
  $settings = $settings_model->get_settings();

  $tk = "insta_gallery_tag_items_{$tag}_{$end_cursor}";

  // Get any existing copy of our transient data
  if (QLIGG_DEVELOPER || false === ($response = get_transient($tk))) {
    if ($response = $qligg_api->get_tag_items($tag, $end_cursor)) {
      set_transient($tk, $response, absint($settings['insta_reset']) * HOUR_IN_SECONDS);
    }
  }

  if (!isset($response['graphql']['hashtag']['edge_hashtag_to_media']['edges'])) {
    return;
  }

  if (count($feeds = $qligg_api->setup_tag_item($response['graphql']['hashtag']['edge_hashtag_to_media']['edges'], $next_max_id)) >= $limit) {
    return $feeds;
  }

  if (!isset($response['graphql']['hashtag']['edge_hashtag_to_media']['page_info']['end_cursor'])) {
    return $feeds;
  }

  $end_cursor = $response['graphql']['hashtag']['edge_hashtag_to_media']['page_info']['end_cursor'];

  return array_merge($feeds, qligg_get_tag_items($tag, $limit, $next_max_id, $end_cursor));
}
