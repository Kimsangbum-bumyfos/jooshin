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
            $("#write_action :input:text:visible:enabled:first").focus();
            
            $("#write_btn").click(function() {

                if ($("#peak_title").val() == '') {
                    showModal('#popupModal');
                    $("#popup-msg").text("성수기명을 입력해 주세요.");
                    $("#peak_title").focus();
                    return;
                }else if($("#s_date").val() == ''){
                    showModal('#popupModal');
                    $("#popup-msg").text("성수기 시작일을 입력해 주세요.");
                    $("#s_date").focus();
                    return;
                }else if($("#e_date").val() == ''){
                    showModal('#popupModal');
                    $("#popup-msg").text("성수기 종료일을 입력해 주세요.");
                    $("#e_date").focus();
                    return;
                }

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
                            <h2>부가서비스관리 - 등록</h2>
                        </div>
                        <div class="breadcrumb">
                            <ol class="clearfix">
                                <li><a href="#"><i class="fas fa-home">&nbsp;</i>HOME</a></li>
                                <li><a href="#">부가서비스관리</a></li>
                            </ol>
                        </div>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="content-area">
                                <?=form_open('', 'id="write_action" enctype="multipart/form-data"')?>
                                <input type="hidden" name="v" value="<?=$v?>">
                                <fieldset>
                                <legend class="hidden-text">부가서비스수정</legend>
                                <table class="table table-typeB">
                                    <colgroup>
                                        <col width="180">
                                        <col>
                                    </colgroup>
                                    <tbody>
                                        <tr>
                                            <th>부가서비스명</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">부가서비스명</label>
                                                    <input type="text" class="form" name="name" id="name" value="<?php echo $views->name;?>">
                                                </div>
                                                <?=form_error('name','<div class="col-error">', '</div>')?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>단가</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">단가</label>
                                                    <input type="number" class="form" name="option_unit_price" id="option_unit_price" value="<?php echo $views->option_unit_price;?>">
                                                </div>
                                                <?=form_error('option_unit_price','<div class="col-error">', '</div>')?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>부가설명</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">부가설명</label>
                                                    <textarea class="table-textarea" name="desc" value="" rows="2"><?php echo $views->desc;?></textarea>
                                                </div>                                               
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>대표이미지</th>
                                            <td>
                                                <div class="preview-img" style="background: url('<?=base_url().$views->path.'/'.$views->thumb_img?>') 50% center / 100%;"></div>
                                                <div class="file">
                                                    <input class="form upload-name" placeholder="찾아보기 버튼으로 이미지를 추가하세요" readonly>
                                                    <span class="ico-file-cancel"></span>
                                                    <br>
                                                    <div class="col-100 m-t-8">
                                                        <label class="btn typeA-blue pointer btn-file" for="input_file3"><i class="fas fa-search">&nbsp;</i>찾아보기</label>
                                                        <input type="file" name="userfile" id="input_file3" class="upload-hidden" accept="image/*">
                                                        <input type="hidden" name="thumb_chk" value ="<?=$views->thumb_img;?>">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
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