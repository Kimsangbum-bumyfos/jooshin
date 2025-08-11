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
                    $("#popup-msg").text("제목을 입력해 주세요.");
                }else if($('#sub_title').val() == ''){
                    showModal('#popupModal');
                    $("#popup-msg").text("하위 제목을 입력해 주세요.");
                }else if($("#s_date").val() == ''){
                    showModal('#popupModal');
                    $("#popup-msg").text("진행될 기간을 입력해 주세요.");
                    $("#s_date").focus();
                    return;
                }else if($("#e_date").val() == ''){
                    showModal('#popupModal');
                    $("#popup-msg").text("진행될 기간을 입력해 주세요.");
                    $("#e_date").focus();
                    return;
                }else if(cke_contents == '' || cke_contents == null || cke_contents == '&nbsp;' || cke_contents == '<p>&nbsp;</p>') {
                    showModal('#popupModal');
                    $("#popup-msg").text("내용을 입력해 주세요.");
                }else{
                    $("#cke_contents").val(cke_contents);
                    $("#write_action").submit();
                }
            });
            
            // $("#write_btn").click(function() {
            //     var cke_contents = CKEDITOR.instances.contents.getData();
            //     if ($("#title").val() == '') {
            //         showModal('#popupModal');
            //         $("#popup-msg").text("제목을 입력해 주세요.");
            //     }else if(cke_contents == '' || cke_contents == null || cke_contents == '&nbsp;' || cke_contents == '<p>&nbsp;</p>') {
            //         showModal('#popupModal');
            //         $("#popup-msg").text("내용을 입력해 주세요.");
            //     }else{
            //         $("#cke_contents").val(cke_contents);
            //         $("#write_action").submit();
            //     }
            // });
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
                            <h2>게시판관리 - 이벤트</h2>
                        </div>
                        <div class="breadcrumb">
                            <ol class="clearfix">
                                <li><a href="#"><i class="fas fa-home">&nbsp;</i>HOME</a></li>
                                <li><a href="#">게시판관리</a></li>
                                <li><a href="#">이벤트</a></li>
                            </ol>
                        </div>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="content-area">
                                <?=form_open('', 'id=write_action enctype="multipart/form-data"')?>
                                <!-- <?=form_open('', 'id=write_action')?> -->
                                <input type="hidden" name="v" value="<?=$v?>">
                                <input type="hidden" name="k" value="<?=$hash?>">
                                <fieldset>
                                    <legend class="hidden-text">공지사항수정</legend>
                                    <table class="table table-typeB">
                                        <colgroup>
                                            <col width="180">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr>
                                                <th>제목 *</th>
                                                <td>
                                                    <div class="col-100">
                                                        <label for="" class="hidden-text">제목</label>
                                                        <input type="text" name="title" id="title" class="form" value="<?=set_value('title')?>" placeholder="제목을 입력하세요">
                                                    </div>
                                                    <?=form_error('title','<div class="col-error">', '</div>')?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>하위제목 *</th>
                                                <td>
                                                    <div class="col-100">
                                                        <label for="" class="hidden-text">하위제목</label>
                                                        <input type="text" name="sub_title" id="sub_title" class="form" value="<?=set_value('sub_title')?>" placeholder="하위제목을 입력하세요">
                                                    </div>
                                                    <?=form_error('sub_title','<div class="col-error">', '</div>')?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>진행기간(*)</th>
                                                <td>
                                                <div class="calendar-form">
                                                    <div class="col-25">
                                                        <label for="" class="hidden-text">시작일</label>
                                                        <input type="text" class="form date" placeholder="날짜를 선택하세요" name="s_date" id="s_date" value="<?=set_value('s_date')?>" readonly data-set>
                                                    </div>
                                                    <span class="m-blank">~</span>
                                                    <div class="col-25">
                                                        <label for="" class="hidden-text">종료일</label>
                                                        <input type="text" class="form date" placeholder="날짜를 선택하세요" id="e_date" name="e_date" value="<?=set_value('e_date')?>" readonly>
                                                    </div>
                                                    <?=form_error('s_date','<div class="col-error">', '</div>')?>
                                                    <?=form_error('e_date','<div class="col-error">', '</div>')?>
                                                    <div class="calendar-panel">
                                                        <p class="cal-info"><span class="fas fa-info-circle gray-6 m-r-5"></span>날짜를 선택해주세요.</p>
                                                        <div class="calendar" id="calMulti1"></div>
                                                    </div>
                                                </div>
                                            </td>
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
                                                        <input type="text" name="tags" class="form" placeholder="태그는 ',(쉼표)'로 구분하세요.">
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- <tr>
                                                <th>썸네일이미지</th>
                                                <td>
                                                    <div class="preview-img"></div>
                                                    <div class="file">
                                                        <input class="form upload-name" placeholder="찾아보기 버튼으로 이미지를 추가하세요" readonly>
                                                        <span class="ico-file-cancel"></span>
                                                        <br>
                                                        <div class="col-100 m-t-8">
                                                            <label class="btn typeA-blue pointer btn-file" for="input_file3"><i class="fas fa-search">&nbsp;</i>찾아보기</label>
                                                            <input type="file" name="userfile" id="input_file3" class="upload-hidden" accept="image/*">
                                                        </div>
                                                        <?=form_error('userfile','<div class="col-error">', '</div>')?>
                                                    </div>
                                                </td>
                                            </tr> -->
                                            <tr>
                                                <th>내용 *</th>
                                                <td>
                                                    <div class="col-100">
                                                        <label for="" class="hidden-text">내용</label>
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