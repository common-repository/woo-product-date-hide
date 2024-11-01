<?php

/*
  Plugin Name: Woocommerce Product Date hide
  Plugin URI: https://faisal.com.np/woocommerce-product-date-hide/
  Description: Hides product published date from woocomerce product pages frontend.
  Tags: woocommerce date hide, woocommerce product date
  Author: Faisal Adil
  Author URI: https://faisal.com.np
  Donate link: https://faisal.com.np/donate
  Contributors: hotplugin
  Requires at least: 4.1
  Tested up to: 4.9
  Stable tag: 20180319
  Version: 1.0
  Requires PHP: 5.2
  License: GPL v2 or later
 */
if (!defined('ABSPATH'))
    die();

function wcpdh_init_plugin_check() {
    if (!wcpdh_is_woocommerce_activated()) {
        deactivate_plugins(__FILE__);
        $msg = __('This plugin requires <a href="http://wordpress.org/extend/plugins/woocommerce/">WooCommerce</a>  plugin to be active!', 'woocommerce');
        die($msg);
    }
}

function wcpdh_hide_date() {
    if (!is_admin() && is_woocommerce()) {
        $hide_css = ".product .post-date{display:none!important;}";
        echo "<style>" . $hide_css . "</style>";
        add_filter('the_date', '__return_false');
    }
}

add_action('wp_head', 'wcpdh_hide_date');

function wcpdh_is_woocommerce_activated() {
    if (is_plugin_active('woocommerce/woocommerce.php')) {
        return true;
    } else {
        return false;
    }
}

register_activation_hook(__FILE__, 'wcpdh_init_plugin_check');
