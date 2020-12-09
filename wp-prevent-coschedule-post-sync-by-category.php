<?php
/**
 * Plugin Name: WP Prevent CoSchedule Post Sync by Category
 * Description: Prevents a WordPress post with a specific category slug from syncing to CoSchedule
 * Plugin URI:  https://github.com/rveitch/wp-prevent-coschedule-post-sync-by-category
 * Author:      Ryan Veitch
 * Author URI:  ryanveitch.blog
 * License:     GPL v2 or later
 * Version:     1.0.0
 */

function coschedule_can_sync_post( $state, $post_id ) {
    $category_id_to_ignore = get_term_by('slug', 'accident-feed', 'category')->term_id;
    return ! in_array($category_id_to_ignore, wp_get_post_categories( $post_id ));
}
add_filter( 'tm_coschedule_save_post_callback_filter', 'coschedule_can_sync_post', 10, 2 );
add_filter( 'tm_coschedule_sync_post_callback_filter', 'coschedule_can_sync_post', 10, 2 );
