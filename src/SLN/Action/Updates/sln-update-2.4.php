<?php

global $wpdb;

$query = $wpdb->prepare("SELECT post_author FROM {$wpdb->prefix}posts WHERE post_type = %s", array(SLN_Plugin::POST_TYPE_BOOKING));
$users = $wpdb->get_col($query);
$users = array_unique($users);
foreach ($users as $userId) {
	$user = new WP_User($userId);
	if (array_search('administrator', $user->roles) === false && array_search('subscriber', $user->roles) !== false) {
		wp_update_user(array(
			'ID' => $userId,
			'role' => SLN_Plugin::USER_ROLE_CUSTOMER,
		));
	}
}
