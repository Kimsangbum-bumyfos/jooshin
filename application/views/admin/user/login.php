<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="Referrer" content="origin">
	<meta name="referrer" contents="always"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="robots" content="noindex,nofollow" />
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="keywords" content=""> 
	<title>Admin-login</title>
	<link rel="stylesheet" href="<?php echo $this->config->item('home_assets_url'); ?>/cms/css/style.css">
	<script src="<?php echo $this->config->item('home_assets_url'); ?>/cms/js/jquery.min.js"></script>
	<script src="<?php echo $this->config->item('home_assets_url'); ?>/cms/js/script.js"></script>
	<!-- 아이디 저장 쿠키 플러그인 -->
	<script src="<?php echo $this->config->item('home_assets_url'); ?>/cms/js/jquery.cookie.js"></script>
	<!--// 아이디 저장 쿠키 플러그인 -->

	<!-- 유효성 검사 -->
    <script>
        $(document).ready(function() {

        	var login_id = $.cookie('login_id');

	    	if(login_id != undefined) {
	    		//아이디에 쿠키값을 담는다
	        	$("#login_id").val(login_id);
	        	//아이디저장 체크박스 체크를 해놓는다
	        	$("#rememberID").prop("checked",true);
	    	}

			//로그인 엔터 처리
			$("input[name=password]").keydown(function (key) { 
		        if(key.keyCode == 13){
		            $('#write_btn').trigger('click');
		        } 
			});
	    	
            $("#write_btn").click(function() {
            	
            	if ($("#login_id").val() == '') {
                    showModal('#popupModal');
                    $("#popup-msg").text("아이디를 입력해 주세요.");                    
                }else if($("#password").val() == '') {
                    showModal('#popupModal');
                    $("#popup-msg").text("패스워드를 입력해 주세요.");
                    return;
                }else{                    
                    //아이디저장 체크되어있으면 쿠키저장
		            if($("#rememberID").prop("checked")) {
		                $.cookie('login_id', $("#login_id").val(), {expires:7});
		            //아이디저장 미체크면 쿠키에 정보가 있던간에 삭제
		            } else {
		                $.removeCookie("login_id");
		            }

		            $("#write_action").submit();                    
                }
            });
        });
    </script>
</head>
<body onload='initLoginPage()'>
	<div class="wrap">
		<div class="login-area">
			<div class="login-header">
				<div class="logo">
					<h1>Company Logo</h1>
				</div>
				<div class="saying">
					<!-- 오늘의 명언 -->
					<?php echo $views->contents;?>
					<p>- <?php echo $views->author;?> -</p><!--//오늘의 명언 -->
				</div>
			</div>
			<div class="login-panel">
				<!-- <form class="login-form" action="login" method="post"> -->
                <?=form_open('', 'id="write_action"')?>
					<fieldset>
						<legend class="label-hidden">관리자로그인</legend>
						<div class="input-group">
							<label for="#" class="hidden-text">아이디를입력</label>
							<span class="ico-user"></span>
							<input type="text" placeholder="ID" name="id" id="login_id">
						</div>
						<div class="input-group">
							<label for="#" class="hidden-text">비밀번호를입력</label>
							<span class="ico-pw"></span>
							<input type="password" placeholder="PASSWORD" name="password" id="password">
						</div>
						<button class="btn-login" type="button" id="write_btn">LOGIN</button>
						<input type="checkbox" id="rememberID">
                        <label class="checkbox-label" for="rememberID"><span></span>아이디저장33</label>
                        <span><a href="/admin/auth/forgot_password" class="fl-r">비밀번호찾기33</a></span>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
  	<!-- 팝업 -->
    <div class="modal" id="popupModal">
        <div class="modal-dimmed">
            <div class="modal-panel">
                <div class="modal-header">
                    <p class="font-16 gray-6" id="popup-msg"></p>
                </div>
                <div class="btn-group">
                    <button onclick="hideModal('#popupModal')" class="btn typeA-blue">확인</button>
                </div>
            </div>
        </div>
    </div><!-- //팝업 -->  
</body>
</html>