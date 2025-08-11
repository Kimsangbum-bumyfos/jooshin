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
    <script src="<?php echo $this->config->item('home_assets_url'); ?>/cms/js/script.js"></script>
    <!--//Page Level include -->


    <!-- 유효성 검사 -->
    <script>
        $(document).ready(function() {
            $('#write_btn').click(function () {
                $("#write_action").submit();
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
                        <h2>설정 - SNS설정</h2>
                    </div>
                    <div class="breadcrumb">
                        <ol class="clearfix">
                            <li><a href="#"><i class="fas fa-home">&nbsp;</i>HOME</a></li>
                            <li><a href="#">설정</a></li>
                            <li><a href="#">SNS설정</a></li>
                        </ol>
                    </div>
                </div>
                <div class="section-body">
                    <div class="row">
                        <div class="content-area">
                            <?=form_open('', 'id="write_action" enctype="multipart/form-data"')?>
                            <fieldset>
                                <legend class="hidden-text">SNS설정</legend>
                                <table class="table table-typeB">
                                    <colgroup>
                                        <col width="180">
                                        <col>
                                    </colgroup>
                                    <tbody>
                                    <tr>
                                        <th>네이버TV URL</th>
                                        <td>
                                            <div class="col-100">
                                                <label for="com_name" class="hidden-text">네이버TV URL</label>
                                                <input type="text" name="sns_navertv_url" id="sns_navertv_url" class="form" value="<?=@$lt['sns_navertv_url']?>" placeholder="네이버TV URL을 입력하세요">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>네이버블로그 URL</th>
                                        <td>
                                            <div class="col-100">
                                                <label for="com_name" class="hidden-text">네이버블로그 URL</label>
                                                <input type="text" name="sns_naverblog_url" id="sns_naverblog_url" class="form" value="<?=@$lt['sns_naverblog_url']?>" placeholder="네이버블로그 URL을 입력하세요">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>페이스북 URL</th>
                                        <td>
                                            <div class="col-100">
                                                <label for="com_name" class="hidden-text">페이스북 URL</label>
                                                <input type="text" name="sns_fb_url" id="sns_fb_url" class="form" value="<?=@$lt['sns_fb_url']?>" placeholder="페이스북 URL을 입력하세요">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>유튜브 URL</th>
                                        <td>
                                            <div class="col-100">
                                                <label for="com_name" class="hidden-text">유튜브 URL</label>
                                                <input type="text" name="sns_youtube_url" id="sns_youtube_url" class="form" value="<?=@$lt['sns_youtube_url']?>" placeholder="유튜브 URL을 입력하세요">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>인스타그램 URL</th>
                                        <td>
                                            <div class="col-100">
                                                <label for="com_name" class="hidden-text">인스타그램 URL</label>
                                                <input type="text" name="sns_insta_url" id="sns_insta_url" class="form" value="<?=@$lt['sns_insta_url']?>" placeholder="인스타그램 URL을 입력하세요">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>카카오스토리 URL</th>
                                        <td>
                                            <div class="col-100">
                                                <label for="com_name" class="hidden-text">카카오스토리 URL</label>
                                                <input type="text" name="sns_kakaostory_url" id="sns_kakaostory_url" class="form" value="<?=@$lt['sns_kakaostory_url']?>" placeholder="카카오스토리 URL을 입력하세요">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>카카오플러스 URL</th>
                                        <td>
                                            <div class="col-100">
                                                <label for="com_name" class="hidden-text">카카오플러스 URL</label>
                                                <input type="text" name="sns_kakaoplus_url" id="sns_kakaoplus_url" class="form" value="<?=@$lt['sns_kakaoplus_url']?>" placeholder="카카오플러스 URL을 입력하세요">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>네이버톡 URL</th>
                                        <td>
                                            <div class="col-100">
                                                <label for="com_name" class="hidden-text">네이버톡 URL</label>
                                                <input type="text" name="sns_navertalk_url" id="sns_navertalk_url" class="form" value="<?=@$lt['sns_navertalk_url']?>" placeholder="네이버톡 URL을 입력하세요">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>카카오톡 ID</th>
                                        <td>
                                            <div class="col-100">
                                                <label for="com_name" class="hidden-text">네이버톡 URL</label>
                                                <input type="text" name="sns_kakao_id" id="sns_kakao_id" class="form" value="<?=@$lt['sns_kakao_id']?>" placeholder="카카오톡 ID를 입력하세요">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>카카오플러스 ID</th>
                                        <td>
                                            <div class="col-100">
                                                <label for="com_name" class="hidden-text">카카오플러스 ID</label>
                                                <input type="text" name="sns_kakaoplus_id" id="sns_kakaoplus_id" class="form" value="<?=@$lt['sns_kakaoplus_id']?>" placeholder="네이버톡 URL을 입력하세요">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>네이버톡 ID</th>
                                        <td>
                                            <div class="col-100">
                                                <label for="com_name" class="hidden-text">네이버톡 ID</label>
                                                <input type="text" name="sns_navertalk_id" id="sns_navertalk_id" class="form" value="<?=@$lt['sns_navertalk_id']?>" placeholder="네이버톡 URL을 입력하세요">
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