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

    <script>
        $(document).ready(function() {

            //유효성 검사(공백, 이메일 유효성) 후 submit
            $("#btn-admin-pw1").click(function() {
                //유효성 검사 완료된 경우에만 submit
                if(email_valid_chk()){
                    $("#write_action").submit();
                }
            });

            // input에서 마우스 아웃 된 경우 유효성 체크
            $(".login-form").bind("focusout", function(){
                email_valid_chk();
            });

            //유효성 검사 공통 함수
            function email_valid_chk(){

                var alert_text = '';

                // blank : ?
                if($("#e-mail").val() == '' || $("#e-mail").val() =='undefined') {
                    alert_text = '이메일을 입력해 주세요.';
                    insert_false(alert_text);
                    return false;
                }else if(! cnf_e_mail($("#e-mail").val())){
                    alert_text = '이메일을 형식에 맞게 입력하세요.';
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
            //email valid
            function cnf_e_mail(emailVal){
                var regEmail=/([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
                return (regEmail.test(emailVal));
            }

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
                <h1>비밀번호 찾기</h1>
                <h2>가입하신 이메일 주소를 입력하시면<br>이메일 인증을 통해 새로운 비밀번호를 설정하실 수 있습니다.</h2>
            </div>
            <div class="form-group">
                <?=form_open('', 'id="write_action"')?>
                    <div class="input-group">
                        <label for="email" class="hidden-text">비밀번호를 입력</label>
                        <span class="ico-email"></span>
                        <input id="e-mail" type="text" placeholder="E-mail을 입력하세요" class="login-form" name="auth_email">
                    </div>
                </form>
                <button class="btn-login" id="btn-admin-pw1" type="submit">이메일 인증</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>