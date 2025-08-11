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
    <!-- <script src="<?php echo $this->config->item('home_assets_url'); ?>/js/login.js"></script>	 -->

    <script>
        $(document).ready(function() {

            //유효성 검사(공백, 이메일 유효성) 후 submit
            $("#btn-admin-pw1").click(function() {

                //alert(passwd_valid_chk());
                //유효성 검사 완료된 경우에만 submit
                if(passwd_valid_chk()){
                    $("#write_action").submit();
                }

            });

            // input에서 마우스 아웃 된 경우 유효성 체크
            $(".login-form").bind("focusout", function(){
                passwd_valid_chk();
            });

            //유효성 검사 공통 함수
            function passwd_valid_chk(){

                var alert_text = '';

                // blank : ?
                if($("#pw").val() == '' || $("#pw").val() =='undefined' || $("#pw2").val() == '' || $("#pw2").val() =='undefined') {
                    alert_text = '비밀번호를 입력해 주세요.';
                    insert_false(alert_text);
                    return false;
                }else if($("#pw").val() !== $("#pw2").val() ){
                    alert_text = '비밀번호와 비밀번호 확인이 일치하지 않습니다.';
                    insert_false(alert_text);
                    return false;
                }else{
                    insert_true();
                    return true;
                }

            }

            //로그인 엔터 처리
            $("input[name=email]").keydown(function (key) {
                if(key.keyCode == 13){
                    $('#btn-admin-pw1').trigger('click');
                }
            });

            /*
            ******************************************************************************************************************
            */

            //경고 메시지 css 처리 함수
            function insert_false(alert_text){

                var tg_input_group = $(".input-group");
                tg_input_group.addClass('wrong');

                if(tg_input_group.find('.wrong-info').length<1){
                    var p_tag = "<p class='wrong-info'></p>"
                    tg_input_group.append(p_tag);
                }

                tg_input_group.find('.wrong-info').text(alert_text);
                tg_input_group.css({"margin-bottom":"32px"});

            }

            //경고 메시지 롤백 css 처리 함수
            function insert_true(){
                var tg_input_group = $(".input-group");
                tg_input_group.css({"margin-bottom":"15px"});
                tg_input_group.removeClass('wrong');
                tg_input_group.find('.wrong-info').remove();
            }
            /*
            ******************************************************************************************************************
            */
        });
    </script>

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
                <h1>비밀번호 재설정</h1>
                <h2>비밀번호를 다시 설정해 주세요</h2>
            </div>
            <div class="form-group">
                <?=form_open('', 'id="write_action"')?>
                <input type="hidden" name="auth_email" value="<?=$auth_email?>">

                <div class="input-group">
                    <label for="pw" class="hidden-text">비밀번호를 입력</label>
                    <span class="ico-pw"></span>
                    <input id="pw" type="password" placeholder="비밀번호를 입력하세요" class="login-form" name="auth_passwd">
                </div>
                <div class="input-group">
                    <label for="pw2" class="hidden-text">비밀번호를 재입력</label>
                    <span class="ico-pw"></span>
                    <input id="pw2" type="password" placeholder="비밀번호확인을 입력하세요" class="login-form">
                </div>
                </form>
                <button class="btn-login" id="btn-admin-pw1" type="submit">비밀번호 재설정</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>