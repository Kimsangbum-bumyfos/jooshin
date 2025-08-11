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

            /*
                * IP추가 버튼 클릭시 input 생성
            */
            $(".btn-ip").click(function(){
                var ip_div = '<div class="ip-col">\
                                <label for="com_name" class="hidden-text">CMS 접속허용 IP설정</label>\
                                <input type="text" name="cms_allow_ips[]" id="" class="form" value="" placeholder="CMS 접속허용 IP를 입력하세요">\
                                </div>';

                $("#ip_table").prepend(ip_div);
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
                        <h2>설정 - CMS설정</h2>
                    </div>
                    <div class="breadcrumb">
                        <ol class="clearfix">
                            <li><a href="#"><i class="fas fa-home">&nbsp;</i>HOME</a></li>
                            <li><a href="#">설정</a></li>
                            <li><a href="#">CMS설정</a></li>
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
                                        <th>비밀번호 변경 주기 설정</th>
                                        <td>
                                            <div class="col-25">
                                                <label for="" class="hidden-text">비밀번호 변경 주기 설정</label>
                                                <select class="form" name="term_reset_passwd">
                                                    <option value="3" <?=@$lt['term_reset_passwd'] === '3' ? 'selected' : ''?>>3개월</option>
                                                    <option value="6" <?=@$lt['term_reset_passwd'] === '6' ? 'selected' : ''?>>6개월</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>CMS 접속허용 IP설정</th>
                                        <td>
                                            <div id="ip_table" class="col-100 clearfix">
                                                <div class="ip-col-with-btn">
                                                    <label for="com_name" class="hidden-text">CMS 접속허용 IP설정</label>
                                                    <input type="text" name="cms_allow_ips[]" id="" class="form" value="<?=@$lt['cms_allow_ips']?>" placeholder="CMS 접속허용 IP를 입력하세요">
                                                </div>
                                                <div class="ip-col-btn">
                                                    <button type="button" class="btn-ip">IP 추가</button>
                                                </div>
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