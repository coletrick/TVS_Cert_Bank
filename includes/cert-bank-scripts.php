<?php


function cert_bank_admin_enqueue_script() {
	wp_register_script( 'admin-page-js', MODALPLUGIN_URL . 'admin/js/cert-bank-admin-page.js', array ( 'jquery' ), '', true);
    wp_localize_script( 'admin-page-js', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ))); 
	
	wp_enqueue_script( 'admin-page-js' );
}

add_action( 'admin_enqueue_scripts', 'cert_bank_admin_enqueue_script', 100 );