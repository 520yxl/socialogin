<?php
session_start();
header("Content-Type: text/html;charset=utf-8");
include_once('../../../../wp-load.php');

//接口地址
$api_url = get_option('socialogin_appurl');
$api_id = get_option('socialogin_appid');
$api_key = get_option('socialogin_appkey');

if(isset($_GET['type']) && isset($_GET['code'])){
    //https://socialogin.520yxl.cn/connect.php?act=login&appid={你的appid}&appkey={你的appkey}&type={登录方式}&redirect_uri={返回地址}
    $result = socialogin_get_url($api_url."connect.php?act=callback&appid=".$api_id."&appkey=".$api_key."&type=".$_GET['type']."&code=".$_GET['code']);
    $result = trim($result, "\xEF\xBB\xBF");
    $resultArray = json_decode($result,true);
    if($resultArray['code'] == '0'){
        $socialogin_uri = get_option('erphplogin_url')?get_option('erphplogin_url'):home_url();
        if(isset($_SESSION['socialogin_uri']) && $_SESSION['socialogin_uri']){
            $socialogin_uri = $_SESSION['socialogin_uri'];
        }
        $socialogin_uid = $resultArray['social_uid'];
        $photo = $resultArray['faceimg'];
        $nickname = $resultArray['nickname'];

        if($socialogin_uid && $resultArray['access_token']){
	        if($_GET['type'] == 'qq'){
	        	$user_ID = $wpdb->get_var("SELECT ID FROM $wpdb->users WHERE qqid='".esc_sql($socialogin_uid)."'");

	        	if(is_user_logged_in()){
	        		if($user_ID){
	                    wp_die("此QQ已被其他账号绑定过了，请先解绑！");
	                }else{
	                	global $current_user;
	                    $wpdb->query("UPDATE $wpdb->users SET qqid = '".esc_sql($socialogin_uid)."' WHERE ID = ".$current_user->ID);
	    				add_user_meta($current_user->ID, 'avatar', $photo);
	    				add_user_meta($current_user->ID, 'photo', $photo);
	    				wp_redirect($socialogin_uri);
	    				exit;
	                }
	        	}else{
					if ($user_ID) {
						wp_set_auth_cookie($user_ID,true,is_ssl());
						wp_signon( array(), is_ssl() );
    					do_action('wp_login', get_user_by('id',$user_ID)->user_login);
						wp_redirect($socialogin_uri);
						exit;
					}else{
						$a= microtime()*1000000;
						$pass = wp_create_nonce(rand(10,1000));
						$login_name = "qq_".wp_create_nonce($a);
						$userdata=array(
						  'user_login' => $login_name,
						  'user_email' => $login_name.'@520yxl.cn',
						  'display_name' => $nickname,
						  'nickname' => $nickname,
						  'first_name' => $nickname,
						  'user_pass' => $pass
						);
						$user_id = wp_insert_user( $userdata );
						if ( is_wp_error( $user_id ) ) {
							echo $user_id->get_error_message();
						}else{
							$ff = $wpdb->query("UPDATE $wpdb->users SET qqid = '".esc_sql($socialogin_uid)."' WHERE ID = $user_id");
							if ($ff) {
								update_user_meta($user_id, 'avatar', $photo);
								update_user_meta($user_id, 'photo', $photo);
								wp_set_auth_cookie($user_id,true,is_ssl());
								wp_signon( array(), is_ssl() );
    							do_action('wp_login', get_user_by('id',$user_id)->user_login);
								wp_redirect($socialogin_uri);
							}          
						}
						exit;
					}
				}
	        }elseif($_GET['type'] == 'sina'){
	        	$user_ID = $wpdb->get_var("SELECT ID FROM $wpdb->users WHERE sinaid='".esc_sql($socialogin_uid)."'");

	        	if(is_user_logged_in()){
	        		if($user_ID){
	                    wp_die("此微博已被其他账号绑定过了，请先解绑！");
	                }else{
	                	global $current_user;
	                    $wpdb->query("UPDATE $wpdb->users SET sinaid = '".esc_sql($socialogin_uid)."' WHERE ID = ".$current_user->ID);
	    				add_user_meta($current_user->ID, 'avatar', $photo);
	    				add_user_meta($current_user->ID, 'photo', $photo);
	    				wp_redirect($socialogin_uri);
	    				exit;
	                }
	        	}else{
					if ($user_ID) {
						wp_set_auth_cookie($user_ID,true,is_ssl());
						wp_signon( array(), is_ssl() );
    					do_action('wp_login', get_user_by('id',$user_ID)->user_login);
						wp_redirect($socialogin_uri);
						exit;
					}else{
						$a= microtime()*1000000;
						$pass = wp_create_nonce(rand(10,1000));
						$login_name = "weibo_".wp_create_nonce($a);
						$userdata=array(
						  'user_login' => $login_name,
						  'user_email' => $login_name.'@520yxl.cn',
						  'display_name' => $nickname,
						  'first_name' => $nickname,
						  'nickname' => $nickname,
						  'user_pass' => $pass
						);
						$user_id = wp_insert_user( $userdata );
						if ( is_wp_error( $user_id ) ) {
							echo $user_id->get_error_message();
						}else{
							$ff = $wpdb->query("UPDATE $wpdb->users SET sinaid = '".esc_sql($socialogin_uid)."' WHERE ID = $user_id");
							if ($ff) {
								update_user_meta($user_id, 'avatar', $photo);
								update_user_meta($user_id, 'photo', $photo);
								wp_set_auth_cookie($user_id,true,is_ssl());
								wp_signon( array(), is_ssl() );
    							do_action('wp_login', get_user_by('id',$user_id)->user_login);
								wp_redirect($socialogin_uri);
							}          
						}
						exit;
					}
				}
	        }elseif($_GET['type'] == 'wx'){
	        	$user_ID = $wpdb->get_var("SELECT ID FROM $wpdb->users WHERE sinaid='".esc_sql($socialogin_uid)."'");

	        	if(is_user_logged_in()){
	        		if($user_ID){
	                    wp_die("此微信已被其他账号绑定过了，请先解绑！");
	                }else{
	                	global $current_user;
	                    $wpdb->query("UPDATE $wpdb->users SET weixinid = '".esc_sql($socialogin_uid)."' WHERE ID = ".$current_user->ID);
	    				add_user_meta($current_user->ID, 'avatar', $photo);
	    				add_user_meta($current_user->ID, 'photo', $photo);
	    				wp_redirect($socialogin_uri);
	    				exit;
	                }
	        	}else{
					if ($user_ID) {
						wp_set_auth_cookie($user_ID,true,is_ssl());
						wp_signon( array(), is_ssl() );
    					do_action('wp_login', get_user_by('id',$user_ID)->user_login);
						wp_redirect($socialogin_uri);
						exit;
					}else{
						$a= microtime()*1000000;
						$pass = wp_create_nonce(rand(10,1000));
						$login_name = "weixin_".wp_create_nonce($a);
						$userdata=array(
						  'user_login' => $login_name,
						  'user_email' => $login_name.'@520yxl.cn',
						  'display_name' => $nickname,
						  'first_name' => $nickname,
						  'nickname' => $nickname,
						  'user_pass' => $pass
						);
						$user_id = wp_insert_user( $userdata );
						if ( is_wp_error( $user_id ) ) {
							echo $user_id->get_error_message();
						}else{
							$ff = $wpdb->query("UPDATE $wpdb->users SET weixinid = '".esc_sql($socialogin_uid)."' WHERE ID = $user_id");
							if ($ff) {
								update_user_meta($user_id, 'avatar', $photo);
								update_user_meta($user_id, 'photo', $photo);
								wp_set_auth_cookie($user_id,true,is_ssl());
								wp_signon( array(), is_ssl() );
    							do_action('wp_login', get_user_by('id',$user_id)->user_login);
								wp_redirect($socialogin_uri);
							}          
						}
						exit;
					}
				}
	        }
	    }
        exit;
    }elseif($resultArray['code'] == '2'){
        //未完成登录
        wp_die($resultArray['msg']);
    }else{
        wp_die($resultArray['msg']);
    }
}else{
	if($_GET['type'] == 'qq' && !get_option('erphplogin_socialogin_qq')){
		wp_die("抱歉，QQ登录并未开启！");
	}
	if($_GET['type'] == 'sina' && !get_option('erphplogin_socialogin_wb')){
		wp_die("抱歉，微博登录并未开启！");
	}
    if($_GET['type'] == 'wx' && !get_option('erphplogin_socialogin_weixin')){
		wp_die("抱歉，微信登录并未开启！");
	}
    if(isset($_GET['erphploginurl'])){
        $_SESSION['socialogin_uri'] = $_GET['erphploginurl'];
    }
    $result = socialogin_get_url($api_url."connect.php?act=login&appid=".$api_id."&appkey=".$api_key."&type=".$_GET['type']."&redirect_uri=".constant("socialogin").'auth/socialogin.php');
    $result = trim($result, "\xEF\xBB\xBF");
    $resultArray = json_decode($result,true);
    if($resultArray['code'] == '0'){
        wp_redirect($resultArray['url']);
    }else{
        wp_die($resultArray['msg']);
    }
}