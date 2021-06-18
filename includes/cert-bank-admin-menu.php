<?php


function cert_bank_admin_menus() {
    add_submenu_page( 'tools.php', 'TVS Certificate Number Bank', 'TVS Certificate Number Bank', 'manage_options', 'tvs-certificate-number-bank', 'cert_bank_settings_page_markup' );
}
add_action('admin_menu', 'cert_bank_admin_menus');


function cert_bank_settings_page_markup() {

    include( MODALPLUGIN_DIR . 'templates/admin/cert-bank-settings-page.php');
}