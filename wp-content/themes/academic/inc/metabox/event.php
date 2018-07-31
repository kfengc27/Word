<?php
/**
 * @package Theme Palace
 * @subpackage Academic 
 * @since 0.3
 * Enqueue admin scripts 
 */
function academic_enqueue_admin_scripts( $hook ) {
    if ( 'post.php' == $hook || 'post-new.php' == $hook ) {
        // Load date picker js
        wp_enqueue_script( 'jquery-ui-datepicker' );

        // Load time picker js
        wp_enqueue_script( 'jquery-timepicker', get_template_directory_uri() . '/assets/plugins/js/jquery-timepicker.min.js', array( 'jquery' ) );
        
        // Load admin custom js
        wp_enqueue_script( 'academic-admin-custom', get_template_directory_uri() . '/assets/js/admin-custom.min.js', array( 'jquery', 'jquery-ui-datepicker' ) );
        
        // Load simple date picker css
        wp_enqueue_style( 'jquery-ui', get_template_directory_uri() . '/assets/plugins/css/jquery-ui.min.css' );

        // Load time picker css
        wp_enqueue_style( 'jquery-timepicker-css', get_template_directory_uri() . '/assets/plugins/css/jquery-timepicker.min.css' );
    }
}
add_action( 'admin_enqueue_scripts', 'academic_enqueue_admin_scripts' );


/**
 * Outputs the content of the event meta options
 */
function academic_event_meta_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'academic_nonce' );
    $event_date      = get_post_meta( $post->ID, 'academic-event-date', true );
    $event_time_from = get_post_meta( $post->ID, 'academic-event-time-from', true );
    $event_time_to   = get_post_meta( $post->ID, 'academic-event-time-to', true );
    $event_location  = get_post_meta( $post->ID, 'academic-event-location', true );

    ?>

    <p>
        <strong><?php esc_html_e( 'Date', 'academic' );?></strong><br />
        <input type="text" value="<?php echo esc_attr( $event_date ); ?>" id="academic-event-date" name="academic-event-date"></p>
    </p>
    </p>
    <p>
        <strong><?php esc_html_e( 'Time', 'academic' );?></strong><br />
        <label><?php esc_html_e( 'From:', 'academic' );?></label>
        <input type="text" value="<?php echo esc_attr( $event_time_from ); ?>" id="academic-event-time-from" name="academic-event-time-from">
        <label><?php esc_html_e( 'To:', 'academic' );?></label>
        <input type="text" value="<?php echo esc_attr( $event_time_to ); ?>" id="academic-event-time-to" name="academic-event-time-to">
    </p>
    <p>
        <strong><?php esc_html_e( 'Location', 'academic' );?></strong><br />
        <textarea type="text" name="academic-event-location"><?php echo esc_textarea( $event_location ); ?></textarea>
    <?php
}

/**
 * Saves the sidebar position input
 */
function academic_event_meta_save( $post_id ) {

    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'academic_nonce' ] ) && wp_verify_nonce( sanitize_key( $_POST[ 'academic_nonce' ] ), basename( __FILE__ ) ) ) ? 'true' : 'false';

    // Exits script depending on save status
    if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
        return;
    }

    // Checks for input and sanitizes/saves if needed
    if( isset( $_POST[ 'academic-event-date' ] ) ) {
        update_post_meta( $post_id, 'academic-event-date', sanitize_text_field( wp_unslash( $_POST[ 'academic-event-date' ] ) ) );
    }

    // Checks for input and sanitizes/saves if needed
    if( isset( $_POST[ 'academic-event-time-from' ] ) ) {
        update_post_meta( $post_id, 'academic-event-time-from', sanitize_text_field( wp_unslash( $_POST[ 'academic-event-time-from' ] ) ) );
    }

    // Checks for input and sanitizes/saves if needed
    if( isset( $_POST[ 'academic-event-time-to' ] ) ) {
        update_post_meta( $post_id, 'academic-event-time-to', sanitize_text_field( wp_unslash( $_POST[ 'academic-event-time-to' ] ) ) );
    }

    // Checks for input and sanitizes/saves if needed
    if( isset( $_POST[ 'academic-event-location' ] ) ) {
        update_post_meta( $post_id, 'academic-event-location', sanitize_text_field( wp_unslash( $_POST[ 'academic-event-location' ] ) ) );
    }
}
add_action( 'save_post', 'academic_event_meta_save' );