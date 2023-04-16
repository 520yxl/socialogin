<div class="wrap">
<?php 
if($_POST['Submit'] && current_user_can('administrator') && $_POST['Submit']=='保存设置')
{
	$erphplogin_url   = trim($_POST['erphplogin_url']);
	$erphplogin_socialogin_qq   = trim($_POST['erphplogin_socialogin_qq']);
	$erphplogin_socialogin_wb   = trim($_POST['erphplogin_socialogin_wb']);
	$erphplogin_socialogin_weixin   = trim($_POST['erphplogin_socialogin_weixin']);
	$socialogin_appid   = trim($_POST['socialogin_appid']);
	$socialogin_appkey   = trim($_POST['socialogin_appkey']);
	$socialogin_appurl   = trim($_POST['socialogin_appurl']);
	
	update_option('erphplogin_url', $erphplogin_url);
	update_option('erphplogin_socialogin_qq', $erphplogin_socialogin_qq);
	update_option('erphplogin_socialogin_wb', $erphplogin_socialogin_wb);
	update_option('erphplogin_socialogin_weixin', $erphplogin_socialogin_weixin);
	update_option('socialogin_appid', $socialogin_appid);
	update_option('socialogin_appkey', $socialogin_appkey);
	update_option('socialogin_appurl', $socialogin_appurl);

	echo '<div class="updated settings-error"><p>保存成功</p></div>';

}

$erphplogin_url  = get_option('erphplogin_url');
$erphplogin_socialogin_qq  = get_option('erphplogin_socialogin_qq');
$erphplogin_socialogin_wb  = get_option('erphplogin_socialogin_wb');
$erphplogin_socialogin_weixin  = get_option('erphplogin_socialogin_weixin');
$socialogin_appid  = get_option('socialogin_appid');
$socialogin_appkey  = get_option('socialogin_appkey');
$socialogin_appurl  = get_option('socialogin_appurl');
?>

<form method="post" action="<?php echo admin_url('admin.php?page='.plugin_basename(__FILE__)); ?>" style="width: 80%;">

		<h2>Socialogin设置</h2>
		<table class="form-table">
            <tr>
				<th valign="top"><strong>返回地址</strong><br />
				</th>
				<td><input type="text" id="erphplogin_url" name="erphplogin_url"
					value="<?php echo $erphplogin_url; ?>" class="regular-text"/><br />（绑定登录后返回的地址，一般是首页或者个人中心页）
				</td>
			</tr>
            <tr>
				<th valign="top"><strong>代理微信登录</strong>
				</th>
				<td><input type="checkbox" id="erphplogin_socialogin_weixin" name="erphplogin_socialogin_weixin" value="1"  <?php if($erphplogin_socialogin_wb) echo 'checked'; ?>/>开启
				</td>
			</tr>
			<tr>
				<th valign="top"><strong>代理QQ登录</strong>
				</th>
				<td><input type="checkbox" id="erphplogin_socialogin_qq" name="erphplogin_socialogin_qq" value="1"  <?php if($erphplogin_socialogin_qq) echo 'checked'; ?>/>开启
				</td>
			</tr>
			<tr>
				<th valign="top"><strong>代理微博登录</strong>
				</th>
				<td><input type="checkbox" id="erphplogin_socialogin_wb" name="erphplogin_socialogin_wb" value="1"  <?php if($erphplogin_socialogin_wb) echo 'checked'; ?>/>开启
				</td>
			</tr>
            
			<tr>
				<th valign="top"><strong>代理应用 APPID</strong>
				</th>
				<td><input type="text" id="socialogin_appid" name="socialogin_appid"
					value="<?php echo $socialogin_appid ; ?>" class="regular-text"/>（接口3秒申请：<a href="https://socialogin.520yxl.cn">https://socialogin.520yxl.cn</a>）
				</td>
			</tr>
			<tr>
				<th valign="top"><strong>代理应用 APPKEY</strong>
				</th>
				<td><input type="text" id="socialogin_appkey" name="socialogin_appkey"
					value="<?php echo $socialogin_appkey ; ?>" class="regular-text"/>
				</td>
			</tr>
			<tr>
				<th valign="top"><strong>代理应用 接口地址</strong>
				</th>
				<td><input type="text" id="socialogin_appurl" name="socialogin_appurl"
					value="<?php echo $socialogin_appurl ; ?>" class="regular-text"/>（默认：https://socialogin.520yxl.cn/，注意最后面带/）
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<p class="submit">
						<input type="submit" name="Submit" value="保存设置" class="button-primary" />
					</p>
				</td>
			</tr>
		</table>
	</form>
</div>
<div style="display:none">www.mobantu.com</div>
