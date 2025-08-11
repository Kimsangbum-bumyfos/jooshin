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
    <title><?php echo $this->config->item('HOMEPAGE_TITLE');?></title>

    <!-- Page Level include -->
    <link rel="stylesheet" href="<?php echo $this->config->item('home_assets_url'); ?>/cms/css/style.css">
    <script src="<?php echo $this->config->item('home_assets_url'); ?>/cms/js/jquery.min.js"></script>
    <script src="<?php echo $this->config->item('home_assets_url'); ?>/cms/vendor/datepickk/datepickk.js"></script>
    <script src="<?php echo $this->config->item('home_assets_url'); ?>/cms/js/script.js"></script>
    <script src="<?=$this->config->item('home_assets_url'); ?>/cms/vendor/ckeditor/ckeditor.js"></script>
    <!--//Page Level include -->


    <!-- 유효성 검사 -->
    <script>
        $(document).ready(function() {
            $('#write_btn').click(function () {
                $('#write_action').submit();
            });
        });
    </script> 

</head>
<body>
    <div class="wrap">
        
        <!--Page Header include -->
        <?php $this->load->view('admin/inc/header'); ?>
        <!--//Page Header include -->

        <!-- 바디 -->
        <div class="container">
            
            <!--Page sidemenu include -->
            <?php $this->load->view('admin/inc/sidemenu'); ?>
            <!--Page sidemenu include -->

            <!-- 각 페이지 별 -->
            <div class="section">
                <div class="section-content">
                    <div class="section-header">
                        <div class="section-title">
                            <h2>설정 - API설정</h2>
                        </div>
                        <div class="breadcrumb">
                            <ol class="clearfix">
                                <li><a href="#"><i class="fas fa-home">&nbsp;</i>HOME</a></li>
                                <li><a href="#">설정</a></li>
                                <li><a href="#">API설정</a></li>
                            </ol>
                        </div>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="content-area">
                                <?=form_open('', 'id="write_action" enctype="multipart/form-data"')?>
                                <fieldset>
                                    <legend class="hidden-text">설정 - API</legend>
                                    <table class="table table-typeB">
	                                    <colgroup>
	                                    	<col width="180">
	                                        <col>
	                                    </colgroup>
	                                    <tbody>
	                                    	<tr>
	                                    		<th colspan="2">구글 API 설정 <a href="#none">[발급방법]</a></th>
	                                    	</tr>
	                                    	<tr>
	                                    		<th>웹마스터 도구 코드</th>
	                                    		<td>
	                                    			<div class="col-100">
	                                    				<label for="google_web_code" class="hidden-text">웹마스터 도구 코드</label>
	                                    				<input type="text" name="google_web_code" id="google_web_code" class="form" value="<?=@$lt['google_web_code']?>" placeholder="웹마스터 도구 코드를 입력하세요">
	                                                </div>
	                                            </td>
	                                        </tr>
	                                        <tr>
	                                    		<th>애널리틱스 코드</th>
	                                    		<td>
	                                    			<div class="col-100">
	                                    				<label for="google_analytics_code" class="hidden-text">사이트제목</label>
	                                    				<input type="text" name="google_analytics_code" id="google_analytics_code" class="form" value="<?=@$lt['google_analytics_code']?>" placeholder="애널리틱스 코드를 입력하세요">
	                                                </div>
	                                            </td>
	                                        </tr>
	                                        <tr>
	                                    		<th>Ads 코드</th>
	                                    		<td>
	                                    			<div class="col-100">
	                                    				<label for="google_ads_code" class="hidden-text"></label>
	                                    				<input type="text" name="google_ads_code" id="google_ads_code" class="form" value="<?=@$lt['google_ads_code']?>" placeholder="Ads코드를 입력하세요">
	                                                </div>
	                                            </td>
	                                        </tr>
	                                        <tr>
	                                    		<th>클라이언트 ID</th>
	                                    		<td>
	                                    			<div class="col-100">
	                                    				<label for="google_client_id" class="hidden-text"></label>
	                                    				<input type="text" name="google_client_id" id="google_client_id" class="form" value="<?=@$lt['google_client_id']?>" placeholder="클라이언트 ID를 입력하세요">
	                                                </div>
	                                            </td>
	                                        </tr>

	                                        <tr><td></td></tr>

	                                        <tr>
	                                        	<th colspan="2" style="border-top:2px solid #b9b9b9;">네이버 API 설정 <a href="#none">[발급방법]</a></th>
	                                        </tr>
	                                        <tr>
	                                    		<th>애널리틱스 코드</th>
	                                    		<td>
	                                    			<div class="col-100">
	                                    				<label for="naver_analytics_code" class="hidden-text">사이트제목</label>
	                                    				<input type="text" name="naver_analytics_code" id="naver_analytics_code" class="form" value="<?=@$lt['naver_analytics_code']?>" placeholder="애널리틱스 코드를 입력하세요">
	                                                </div>
	                                            </td>
	                                        </tr>
	                                        <tr>
	                                    		<th>웹마스터 도구 코드</th>
	                                    		<td>
	                                    			<div class="col-100">
	                                    				<label for="naver_web_code" class="hidden-text">웹마스터 도구 코드</label>
	                                    				<input type="text" name="naver_web_code" id="naver_web_code" class="form" value="<?=@$lt['naver_web_code']?>" placeholder="웹마스터 도구 코드를 입력하세요">
	                                                </div>
	                                            </td>
	                                        </tr>
	                                        <tr>
	                                    		<th>Client ID</th>
	                                    		<td>
	                                    			<div class="col-100">
	                                    				<label for="naver_client_id" class="hidden-text"></label>
	                                    				<input type="text" name="naver_client_id" id="naver_client_id" class="form" value="<?=@$lt['naver_client_id']?>" placeholder="클라이언트 ID를 입력하세요">
	                                                </div>
	                                            </td>
	                                        </tr>
	                                        <tr>
	                                    		<th>Client Secret</th>
	                                    		<td>
	                                    			<div class="col-100">
	                                    				<label for="naver_client_secret" class="hidden-text"></label>
	                                    				<input type="text" name="naver_client_secret" id="naver_client_secret" class="form" value="<?=@$lt['naver_client_secret']?>" placeholder="클라이언트 Secret을 입력하세요">
	                                                </div>
	                                            </td>
	                                        </tr>

	                                        <tr><td></td></tr>

	                                        <tr>
	                                        	<th colspan="2" style="border-top:2px solid #b9b9b9;">페이스북 API 설정 <a href="#none">[발급방법]</a></th>
	                                        </tr>
	                                        <tr>
	                                    		<th>App ID</th>
	                                    		<td>
	                                    			<div class="col-100">
	                                    				<label for="fb_app_id" class="hidden-text"></label>
	                                    				<input type="text" name="fb_app_id" id="fb_app_id" class="form" value="<?=@$lt['fb_app_id']?>" placeholder="App ID를 입력하세요">
	                                                </div>
	                                            </td>
	                                        </tr>

	                                        <tr><td></td></tr>

	                                        <tr>
	                                        	<th colspan="2" style="border-top:2px solid #b9b9b9;">카카오톡 API 설정 <a href="#none">[발급방법]</a></th>
	                                        </tr>
	                                        <tr>
	                                        	<th>JavaScript 키</th>
	                                        	<td>
	                                    			<div class="col-100">
	                                    				<label for="kakao_js_key" class="hidden-text"></label>
	                                    				<input type="text" name="kakao_js_key" id="kakao_js_key" class="form" value="<?=@$lt['kakao_js_key']?>" placeholder="카카오 JavaScript 키를 입력하세요">
	                                                </div>
	                                            </td>
	                                        </tr>

	                                        <tr><td></td></tr>

	                                        <tr>
	                                        	<th colspan="2" style="border-top:2px solid #b9b9b9;">문자 API 설정(coolsms)</th>
	                                        </tr>
	                                        <tr>
	                                        	<th>등록 발신번호</th>
	                                        	<td>
	                                    			<div class="col-100">
	                                    				<label for="sms_admin_sender_number" class="hidden-text"></label>
	                                    				<input type="text" name="sms_admin_sender_number" id="sms_admin_sender_number" class="form" value="<?=@$lt['sms_admin_sender_number']?>" placeholder="등록 발신번호를 입력하세요">
	                                                </div>
	                                            </td>
	                                        </tr>
                                            <tr>
                                                <th>등록 수신번호(관리자)</th>
                                                <td>
                                                    <div class="col-100">
                                                        <label for="sms_admin_receiver_number" class="hidden-text"></label>
                                                        <input type="text" name="sms_admin_receiver_number" id="sms_admin_receiver_number" class="form" value="<?=@$lt['sms_admin_receiver_number']?>" placeholder="등록 수신번호를 입력하세요">
                                                    </div>
                                                </td>
                                            </tr>
	                                        <tr>
	                                        	<th>API Key</th>
	                                        	<td>
	                                    			<div class="col-100">
	                                    				<label for="sms_api_key" class="hidden-text"></label>
	                                    				<input type="text" name="sms_api_key" id="sms_api_key" class="form" value="<?=@$lt['sms_api_key']?>" placeholder="SMS API 키를 입력하세요">
	                                                </div>
	                                            </td>
	                                        </tr>
	                                        <tr>
	                                        	<th>API Secret</th>
	                                        	<td>
	                                    			<div class="col-100">
	                                    				<label for="sms_api_secret" class="hidden-text"></label>
	                                    				<input type="text" name="sms_api_secret" id="sms_api_secret" class="form" value="<?=@$lt['sms_api_secret']?>" placeholder="API Secret을 입력하세요">
	                                                </div>
	                                            </td>
	                                        </tr>
	                                        <tr>
	                                        	<th>카카오 발신 키</th>
	                                        	<td>
	                                    			<div class="col-100">
	                                    				<label for="sms_kakao_sender_key" class="hidden-text"></label>
	                                    				<input type="text" name="sms_kakao_sender_key" id="sms_kakao_sender_key" class="form" value="<?=@$lt['sms_kakao_sender_key']?>" placeholder="카카오 발신 키를 입력하세요">
	                                                </div>
	                                            </td>
	                                        </tr>
                                    	</tbody>
                                    </table>
                                </fieldset>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="content-area clearfix">
                                <div class="btn-group fl-r">
                                     <button class="btn typeA-darkgray" onclick="history.go(-1); return false;">취소</button>
                                    <button class="btn typeA-blue" id="write_btn">저장</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- //각 페이지 별 -->
        </div><!-- //바디 -->

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

    </div>
</body>
</html>