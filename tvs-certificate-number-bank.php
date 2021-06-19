<?php

/**
 * @link              infini.systems
 * @since             1.0.0
 * @package           Tvs_Certs
 *
 * @wordpress-plugin
 * Plugin Name:       TVS Certificate Number Bank
 * Plugin URI:        infini.systems
 * Description:       Allows admins to drop in new certificate numbers.
 * Version:           2.2.0
 * Author:            Infini Systems - Andy Craven
 * Author URI:        infini.systems
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tvs-certs
 * Domain Path:       /languages
 */



// Don't allow this file to be accessed directly.
if ( ! defined( 'WPINC' ) ) {
	die();
}

require( WP_CONTENT_DIR . '/plugins/tvs-certificate-number-bank/includes/school_class.php' );


define( 'MODALPLUGIN_URL' ,plugin_dir_url( __FILE__) );
define( 'MODALPLUGIN_DIR' ,plugin_dir_path( __FILE__) );


include( plugin_dir_path(__FILE__) . 'includes/cert-bank-styles.php');
include( plugin_dir_path(__FILE__) . 'includes/cert-bank-admin-menu.php');
include( plugin_dir_path(__FILE__) . 'includes/cert-bank-scripts.php');




add_action('wp_ajax_bulk_add_certs', 'bulk_add_certs');
function bulk_add_certs() {
    
    $starting_num = (int)$_REQUEST['starting_num'];
    $ending_num = (int)$_REQUEST['ending_num'];
    $school_name = $_REQUEST['school_name'];
    $school = get_option( $school_name );
    $bulk_add_arr = [];
    $result = []; // Error array
    
    if ( !wp_verify_nonce( $_REQUEST['nonce'], 'bulk-add-nonce')) { // Verify the request came from the Plugin page (Security Check)
        $result['nonce_failed'] = true;
            wp_send_json($result);
    }
     
    //  delete_option( 'is_school_CP028' ); // Use this to delete a whole school from the database
     
     if (!get_option( $school_name )) {                 // If the school has not been added to the database yet this will add it.
         add_option( $school_name, $bulk_add_arr ); 
     }


     $duplicate_arr = [];
     for ($e = $starting_num; $e <= $ending_num; $e++) {
         array_push($duplicate_arr,$e);
     }


     for ($i = 0; $i < count($duplicate_arr); $i++) {
         for ($e = 0; $e < count($school); $e++) {
             if ($duplicate_arr[$i] === $school[$e]->cert_num) {
                $result['duplicate'] = true;
                $result['duplicate_num'] = $duplicate_arr[$i];
                $result['school_name'] = $school[$e]->cert_num;
                wp_send_json($result);
             }
         }
     }

     
     $bulk_add_arr = get_option( $school_name );
     if ($starting_num && $ending_num) {
         for ($x = $starting_num; $x <= $ending_num; $x++) {
             
             $bulk_add = new School;
             
             $bulk_add->set_cert_num($x);
             $bulk_add->set_school_name($school_name);
             
             array_push($bulk_add_arr,$bulk_add);
         }
     }
     
     if (!empty($bulk_add_arr)) {
         $updated_status = update_option( $school_name, $bulk_add_arr );

         if ($updated_status) {
            $result['type'] = $updated_status;
            $result['starting_num'] = $starting_num;
            $result['ending_num'] = $ending_num;
            $result['school_name'] = $school_name;
         }
         if (!$updated_status) {
             $result['type'] = $updated_status;
         }
     }

     $updated_school = get_option( $school_name );
     $counter = 0;
     for ($e = 0; $e < count($updated_school); $e++) {
        if ($updated_school[$e]->user_id === NULL) {
            $counter++;
        }
     }
    $result['certs_avail'] = $counter;

    wp_send_json($result);

 }
 
 
function user_email_search($user_id) {

    global $wpdb;
    $users = $wpdb->get_results( " SELECT * FROM wp_whulavkdfl_users " );

    for ( $e = 0; $e < count($users); $e++ ) {
        if ( (int)$users[$e]->ID === (int)$user_id ) {
            return $users[$e]->user_email;
        }
    }
}



add_action('wp_ajax_display_cert_nums', 'display_cert_nums');
function display_cert_nums() {

    $search_school_name = $_REQUEST['school_name'];
    $assigned_unassigned = $_REQUEST['assigned'];
    $school = get_option( $search_school_name );
    $result = [];
    
    
    if ( !wp_verify_nonce( $_REQUEST['nonce'], 'cert-display-nonce')) { // Verify the request came from the Plugin page (Security Check)
        $result['nonce_failed'] = true;
            wp_send_json($result);
    }


    for ( $x = 0; $x < count($school); $x++ ) {
        if ( $school[$x]->user_id != NULL && $assigned_unassigned === "assigned") {

            $assigned_certs_html .=	'<tr class="display-certs">
                                        <td>' . $school[$x]->school_name . '</td>
                                        <td>' . $school[$x]->cert_num . '</td>
                                        <td>' . user_email_search($school[$x]->user_id) .'</td>
                                    </tr>';
        }
        if ( $school[$x]->user_id === NULL && $assigned_unassigned === "unassigned") {

            $unassigned_certs_html .= '<tr class="display-certs">
                                        <td>' . $school[$x]->school_name . '</td>
                                        <td>' . $school[$x]->cert_num . '</td>
                                        <td>' . $school[$x]->user_id .'</td>
                                    </tr>';
        }
        if ( $assigned_unassigned === "all-certs") {

            $all_certs_html .= '<tr class="display-certs">
                                        <td>' . $school[$x]->school_name . '</td>
                                        <td>' . $school[$x]->cert_num . '</td>
                                        <td>' . user_email_search($school[$x]->user_id) .'</td>
                                    </tr>';
        }
    }

    if ( $assigned_unassigned === 'assigned' ) {
            $result['certs_display'] = $assigned_certs_html;
    }
    if ( $assigned_unassigned === 'unassigned' ) {
            $result['certs_display'] = $unassigned_certs_html;
    }
    if ( $assigned_unassigned === 'all-certs' ) {
            $result['certs_display'] = $all_certs_html;
    }

    wp_send_json($result);

}



add_action('wp_ajax_cert_num_search', 'cert_num_search');
function cert_num_search() {

    $cert_search_num = (int)$_REQUEST['search_num'];
    $cert_search_school_name = $_REQUEST['school_name'];
    $school = get_option( $cert_search_school_name );
    $result = [];

    if ( !wp_verify_nonce( $_REQUEST['nonce'], 'cert-search-nonce')) { // Verify the request came from the Plugin page (Security Check)
        $result['nonce_failed'] = true;
            wp_send_json($result);
    }

    for ( $x = 0; $x < count($school); $x++ ) {
        if ( $school[$x]->cert_num === $cert_search_num ) {
            $certs_html .=	'<tr class="delete-certs">
                                <td><input type="text" id="cert-delete-school" name="cert-delete-school" value="' . $school[$x]->school_name .'" readonly></td>
                                <td><input type="number" id="cert-delete-num" name="cert-delete-num" value="' . $school[$x]->cert_num .'" readonly></td>
                                <td>' . user_email_search($school[$x]->user_id) .'</td>
                                <td><input type="checkbox" id="cert-delete-checkbox" name="cert-delete-checkbox"></td>
                            </tr>';
        }     
    }

    if ( !$certs_html ) {
        $result['not_found'] = true;
        $result['cert_num'] = $cert_search_num;
        $result['school_name'] = $cert_search_school_name;
        wp_send_json($result);
    }
    
    if ( $certs_html ) {
        $result['not_found'] = false;
        $result['searched_certs'] = $certs_html;
        wp_send_json($result);
    }

}



add_action('wp_ajax_cert_num_delete', 'cert_num_delete');
function cert_num_delete() {

	$cert_delete_num = (int)$_REQUEST['cert_num'];
	$cert_delete_school = $_REQUEST['school_name'];
	$cert_delete_checkbox = $_REQUEST['checkbox'];
    $school = get_option( $cert_delete_school );
    $result = [];

    if ( !wp_verify_nonce( $_REQUEST['nonce'], 'cert-delete-nonce')) { // Verify the request came from the Plugin page (Security Check)
        $result['nonce_failed'] = true;
            wp_send_json($result);
    }

	for ( $x = 0; $x < count($school); $x++ ) {
		if ( $school[$x]->cert_num === $cert_delete_num && $cert_delete_checkbox === "on" ) {
			unset($school[$x]);
		}
	}

	$school = array_values($school);

	$cert_delete = update_option( $cert_delete_school, $school );

    if ($cert_delete) {
        $result['type'] = true;
        $result['cert_num'] = $cert_delete_num;
        $result['school_name'] = $cert_delete_school;
    }
    if (!$cert_delete) {
        $result['type'] = $cert_delete;

    }

    wp_send_json($result);

}


add_action('wp_ajax_remaining_certs', 'remaining_certs');
function remaining_certs() {

    $school_name = $_REQUEST['school_name'];
    $school = get_option( $school_name );
    $result = [];
    $counter = 0;

    if ( !wp_verify_nonce( $_REQUEST['nonce'], 'remaining-certs-nonce')) { // Verify the request came from the Plugin page (Security Check)
        $result['nonce_failed'] = true;
            wp_send_json($result);
    }

    for ($e = 0; $e < count($school); $e++) {
        if ($school[$e]->user_id === NULL) {
            $counter++;
        }
     }

    $result['school_name'] = $school_name;
    $result['remaining_certs'] = $counter;
    wp_send_json($result);

}






