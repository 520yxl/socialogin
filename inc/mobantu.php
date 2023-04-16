<?php 
function socialogin_install(){
	global $wpdb;
	$var = $wpdb->query("SELECT qqid FROM $wpdb->users");
	if(!$var){
		$wpdb->query("ALTER TABLE $wpdb->users ADD qqid varchar(100)");
	}
	
	$var1 = $wpdb->query("SELECT sinaid FROM $wpdb->users");
	if(!$var1){
	 $wpdb->query("ALTER TABLE $wpdb->users ADD sinaid varchar(100)");
	}
	$var2 = $wpdb->query("SELECT baiduid FROM $wpdb->users");
	if(!$var2){
	 $wpdb->query("ALTER TABLE $wpdb->users ADD baiduid varchar(100)");
	}
}

function socialogin_get_url($url) {
    $ch = curl_init ();
    curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, TRUE );
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt ( $ch, CURLOPT_URL, $url );
    $result = curl_exec ( $ch );
    curl_close ( $ch );
    return $result;
}

add_filter('login_form', 'socialoginFormButton');
function socialoginFormButton(){
	$erphplogin_socialogin_qq  = get_option('erphplogin_socialogin_qq');
	$erphplogin_socialogin_wb  = get_option('erphplogin_socialogin_wb');
	$erphplogin_socialogin_weixin  = get_option('erphplogin_socialogin_weixin');
    echo '<p id="erphplogin-box" class="erphplogin-box">';
    echo '<link rel="stylesheet" href="'.constant("socialogin").'static/socialogin.css">';
    if($erphplogin_socialogin_weixin) echo '<a href="'.constant("socialogin").'auth/socialogin.php?act=login&type=wx&erphploginurl='.get_option('erphplogin_url').'" title="微信快速登录" rel="nofollow" class="erphplogin-weixin-a"><i class="erphploginfont erphplogin-weixin"></i></a>';
    if($erphplogin_socialogin_qq) echo '<a href="'.constant("socialogin").'auth/socialogin.php?act=login&type=qq&erphploginurl='.get_option('erphplogin_url').'" title="QQ快速登录" rel="nofollow" class="erphplogin-qq-a"><i class="erphploginfont erphplogin-qq"></i></a>';
    if($erphplogin_socialogin_wb) echo '<a href="'.constant("socialogin").'auth/socialogin.php?act=login&type=sina&erphploginurl='.get_option('erphplogin_url').'" title="微博快速登录" rel="nofollow" class="erphplogin-weibo-a"><i class="erphploginfont erphplogin-weibo"></i></a>';
    echo '</p>';
?>
<?php
}

function get_socialogin(){
	$erphp = '';
	if(!is_user_logged_in()){
		$erphplogin_socialogin_qq  = get_option('erphplogin_socialogin_qq');
		$erphplogin_socialogin_wb  = get_option('erphplogin_socialogin_wb');
    	$erphplogin_socialogin_weixin  = get_option('erphplogin_socialogin_weixin');
    $erphp .= '<p id="erphplogin-box" class="erphplogin-box">';
    $erphp .= '<link rel="stylesheet" href="'.constant("socialogin").'static/socialogin.css">';
    if($erphplogin_socialogin_weixin) echo '<a href="'.constant("socialogin").'auth/socialogin.php?act=login&type=wx&erphploginurl='.get_option('erphplogin_url').'" title="微信快速登录" rel="nofollow" class="erphplogin-weixin-a"><i class="erphploginfont erphplogin-weixin"></i></a>';
    if($erphplogin_socialogin_qq) $erphp .= '<a href="'.constant("socialogin").'auth/socialogin.php?act=login&type=qq&erphploginurl='.get_option('erphplogin_url').'" title="QQ快速登录" rel="nofollow" class="erphplogin-qq-a"><i class="erphploginfont erphplogin-qq"></i></a>';
    if($erphplogin_socialogin_wb) $erphp .= '<a href="'.constant("socialogin").'auth/socialogin.php?act=login&type=sina&erphploginurl='.get_option('erphplogin_url').'" title="微博快速登录" rel="nofollow" class="erphplogin-weibo-a"><i class="erphploginfont erphplogin-weibo"></i></a>';
    $erphp .= '</p>';
	}
	return $erphp;
}

