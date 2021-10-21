<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function debug($array = array())
{
    echo '<pre>';
    print_r($array);
    die;
}

function isAdmin() {
    $CI = & get_instance();
    $adminEmail = $CI->session->userdata('email');
    if (isset($adminEmail)) {
        return true;
    }
    return false;
}