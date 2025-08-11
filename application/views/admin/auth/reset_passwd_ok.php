<!DOCTYPE html>
<html lang="<?php echo $this->config->item('LANG'); ?>">
<head>
	<meta charset="UTF-8">
	<meta name="Referrer" content="origin">
	<meta name="referrer" contents="always"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="robots" content="noindex,nofollow">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="keywords" content=""> 
	<title><?php echo $this->config->item('HOMEPAGE_TITLE'); ?></title>
	<script>var base_url = '<?=base_url()?>'</script>
	<link rel="stylesheet" href="<?php echo $this->config->item('home_assets_url'); ?>/cms/css/style.css">
	<link rel="stylesheet" href="<?php echo $this->config->item('home_assets_url'); ?>/cms/css/login.css">
	<script src="<?php echo $this->config->item('home_assets_url'); ?>/cms/js/jquery.min.js"></script>
	<script src="<?php echo $this->config->item('home_assets_url'); ?>/cms/js/script.js"></script>	
</head>
<body onload='initLoginPage()'>
	<div class="wrap rollingImg">
		<div class="login-area">
			<div class="login-header">
				<div class="logo">
					<h1>Company Logo</h1>
				</div>
			</div>
			<div class="content-panel password">
				<div class="panel-title">
					<h1>안내</h1>
					<h2>새 비밀번호가 정상적으로 설정되었습니다.<br/> 감사합니다.</h2>
				</div>
				<div class="form-group">
					<button class="btn-login" onclick="goPage('<?php echo $this->config->item('ADMIN_BASE_URL'); ?>/auth')">로그인</button>
				</div>
			</div>
		</div>
	</div>
</body>
</html>