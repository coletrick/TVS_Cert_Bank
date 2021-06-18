<?php

function cert_bank_frontend_enqueue_style() {
    wp_enqueue_style( 'cert-bank-frontend', plugins_url('tvs-certificate-number-bank/frontend/css/cert-bank-frontend.css'), false );
}
add_action( 'wp_enqueue_scripts', 'cert_bank_frontend_enqueue_style');
add_action( 'admin_enqueue_scripts', 'cert_bank_frontend_enqueue_style');