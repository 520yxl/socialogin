<?php 
/*
Plugin Name: Socialogin（修复版）
Plugin URI: https://www.520yxl.cn/post-1109.html
Description: 网站代理微信、QQ、微博登录，不用去官方申请登录接口
Version: 1.2.2
Author: 模板兔、云轩阁
Author URI: https://www.520yxl.cn
*/

global $wpdb;
define("socialogin",plugin_dir_url( __FILE__ ));

add_action('admin_menu', 'socialogin_menu');
function socialogin_menu() {
	if (function_exists('add_menu_page')) {
		add_menu_page('Socialogin', 'Socialogin', 'administrator', 'socialogin/inc/setting.php', '','dashicons-carrot');
	}
}

if(empty(get_option('erphplogin_url'))){
    add_option('socialogin_appurl', "https://socialogin.520yxl.cn/",'yes');
    add_option('erphplogin_url', get_home_url(),'yes');
}
function plugin_add_Socialogin_link ( $links ) {
    //https://hao.2ytw.com/wp-admin/admin.php?page=socialogin/inc/setting.php
     $Socialogin_link = '<a href="admin.php?page=socialogin/inc/setting.php">' . __ ( 'Settings' ) . '</a>' ;
     array_push ( $links , $Socialogin_link ) ;
         return $links ;
}
$plugin = plugin_basename ( __FILE__ ) ;
add_filter ( "plugin_action_links_$plugin" , 'plugin_add_Socialogin_link' ) ;
include('inc/mobantu.php');
register_activation_hook(__FILE__, 'socialogin_install');
