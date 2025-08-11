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

    <!-- Page Level include -->
    <link rel="stylesheet" href="<?php echo $this->config->item('home_assets_url'); ?>/cms/css/style.css">
    <script src="<?php echo $this->config->item('home_assets_url'); ?>/cms/js/jquery.min.js"></script>
    <script src="<?php echo $this->config->item('home_assets_url'); ?>/cms/vendor/datepickk/datepickk.js"></script>
    <script src="<?php echo $this->config->item('home_assets_url'); ?>/cms/js/script.js"></script>
    <!--//Page Level include --> 

    <!-- 유효성 검사 -->
    <script>
        $(document).ready(function() {

            // 텍스트 입력 필드가 있는 경우 첫 텍스트 필드로 포커스 이동
            // $("#write_action :input:text:visible:enabled:first").focus();
            
            $("#write_btn").click(function() {
                
                $("#write_action").submit();                
            });
        });
    </script> 
    <!-- //유효성 검사 -->

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
                            <h2>휴무일관리 - 등록</h2>
                        </div>
                        <div class="breadcrumb">
                            <ol class="clearfix">
                                <li><a href="#"><i class="fas fa-home">&nbsp;</i>HOME</a></li>
                                <li><a href="#">휴무일관리</a></li>
                            </ol>
                        </div>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="content-area">
                                <?=form_open('', 'id="write_action"')?>
                                <input type="hidden" name="v" value="<?=$v?>">
                                <fieldset>
                                <legend class="hidden-text">휴무일관리등록</legend>
                                <table class="table table-typeB">
                                    <colgroup>
                                        <col width="180">
                                        <col>
                                    </colgroup>
                                    <tbody>
                                   
                                        <tr>
                                            <th>연도</th>
                                            <td>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">연도</label>
                                                    <select class="form" name="year">
                                                        <option value="2018">2018년</option>
                                                        <option value="2019">2019년</option>
                                                        <option value="2020">2020년</option>
                                                        <option value="2021">2021년</option>
                                                        <option value="2022">2022년</option>
                                                        <option value="2023">2023년</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>01월</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">01월</label>
                                                    <input type="text" class="form" name="m_1" id="m_1" placeholder="쉼표(,)로 구분하여 숫자만 입력( 예 : 1,3)">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>02월</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">02월</label>
                                                    <input type="text" class="form" name="m_2" id="m_2">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>03월</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">03월</label>
                                                    <input type="text" class="form" name="m_3" id="m_3">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>04월</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">04월</label>
                                                    <input type="text" class="form" name="m_4" id="04">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>05월</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">05월</label>
                                                    <input type="text" class="form" name="m_5" id="05">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>01월</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">06월</label>
                                                    <input type="text" class="form" name="m_6" id="06">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>07월</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">07월</label>
                                                    <input type="text" class="form" name="m_7" id="07">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>08월</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">08월</label>
                                                    <input type="text" class="form" name="m_8" id="08">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>09월</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">09월</label>
                                                    <input type="text" class="form" name="m_9" id="09">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>10월</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">10월</label>
                                                    <input type="text" class="form" name="m_10" id="10">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>11월</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">11월</label>
                                                    <input type="text" class="form" name="m_11" id="11">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>12월</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">12월</label>
                                                    <input type="text" class="form" name="m_12" id="12">
                                                </div>
                                            </td>
                                        </tr>
                                        <?=form_error('m_1','<div class="col-error">', '</div>')?>
                                        <tr>
                                            <th>사용여부</th>
                                            <td>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">사용여부</label>
                                                    <select class="form" name="use_yn">
                                                        <option value="Y">사용</option>
                                                        <option value="N">사용안함</option>                   
                                                    </select>
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
                                    <button class="btn typeA-darkgray" onclick="history.go(<?=$v+1?>); return false;">취소</button>
                                    <button type="submit" class="btn typeA-blue" id="write_btn">저장</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- //각 페이지 별 -->
        </div><!-- //바디 -->
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