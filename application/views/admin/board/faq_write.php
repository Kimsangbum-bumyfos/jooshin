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
    <script src="<?=$this->config->item('home_assets_url'); ?>/cms/vendor/ckeditor/ckeditor.js"></script>
    <!--//Page Level include -->


    <!-- 유효성 검사 -->
    <script>
        $(document).ready(function() {

            // 텍스트 입력 필드가 있는 경우 첫 텍스트 필드로 포커스 이동
            $("#write_action :input:text:visible:enabled:first").focus();
            
            $("#write_btn").click(function() {
                var cke_contents = CKEDITOR.instances.contents.getData();
                if ($("#title").val() == '') {
                    showModal('#popupModal');
                    $("#popup-msg").text("질문을 입력해 주세요.");
                }else if(cke_contents == '' || cke_contents == null || cke_contents == '&nbsp;' || cke_contents == '<p>&nbsp;</p>') {
                    showModal('#popupModal');
                    $("#popup-msg").text("답변을 입력해 주세요.");
                }else{
                    $("#cke_contents").val(cke_contents);
                    $("#write_action").submit();
                }
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
                            <h2>게시판관리 - FAQ</h2>
                        </div>
                        <div class="breadcrumb">
                            <ol class="clearfix">
                                <li><a href="#"><i class="fas fa-home">&nbsp;</i>HOME</a></li>
                                <li><a href="#">게시판관리</a></li>
                                <li><a href="#">FAQ</a></li>
                            </ol>
                        </div>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="content-area">
                                <?= form_open('', 'id=write_action')?>
                                <input type="hidden" name="v" value="<?=$v?>">
                                <input type="hidden" name="k" value="<?=$hash?>">
                                <fieldset>
                                    <legend class="hidden-text">FAQ수정</legend>
                                    <table class="table table-typeB">
                                        <colgroup>
                                            <col width="180">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr>
                                                <th>질문 *</th>
                                                <td>
                                                    <div class="col-100">
                                                        <label for="" class="hidden-text">질문</label>
                                                        <input type="text" name="title" id="title" class="form guidetext" value="<?=set_value('title')?>" placeholder="질문을 입력하세요">
                                                    </div>
                                                    <?=form_error('title','<div class="col-error">', '</div>')?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>카테고리 *</th>
                                                <td>
                                                    <div class="col-25">
                                                        <label for="" class="hidden-text">카테고리</label>
                                                        <select class="form" name="category">
                                                            <option value="주문/결제">주문/결제</option>
                                                            <option value="제품관련">제품관련</option>
                                                            <option value="이용관련">이용관련</option>
                                                            <option value="기타">기타</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>게시여부 *</th>
                                                <td>
                                                    <div class="col-25">
                                                        <label for="" class="hidden-text">게시여부</label>
                                                        <select class="form" name="open_yn">
                                                            <option value="Y">게시</option>
                                                            <option value="N">대기</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>검색 태그(Tags)</th>
                                                <td>
                                                    <div class="col-100">
                                                        <label for="" class="hidden-text">검색 태그(Tags)</label>
                                                        <input type="text" name="tags" class="form guidetext" placeholder="태그는 ',(쉼표)'로 구분하세요.">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>답변 *</th>
                                                <td>
                                                    <div class="col-100">
                                                        <label for="" class="hidden-text">답변</label>
                                                        <div>
                                                            <textarea name="contents" id="contents" rows="30" style="width:100%;"><?=set_value('contents')?></textarea>
                                                            <!-- ckeditor 호출 및 파일 업로드 실행 파일 경로 설정 -->
                                                            <script>
                                                                CKEDITOR.replace( 'contents', {
                                                                    filebrowserUploadUrl: '<?=$this->config->item('ADMIN_ROOT'); ?>/CKE_Upload/cke_upload?k=<?=$hash?>'
                                                                });
                                                            </script><!--// ckeditor 호출 및 파일 업로드 실행 파일 경로 설정 -->
                                                        </div>
                                                    </div>
                                                    <?=form_error('contents','<div class="col-error">', '</div>')?>
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
                                    <button  class="btn typeA-blue" id="write_btn">저장</button>
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