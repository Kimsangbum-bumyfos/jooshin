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
    <script src="<?php echo $this->config->item('home_assets_url'); ?>/cms/js/jooshin.js"></script>
    <script src="<?=$this->config->item('home_assets_url'); ?>/cms/vendor/ckeditor/ckeditor.js"></script>
    <!--//Page Level include -->

    <!-- 유효성 검사 -->
    <script>
        var sel_files = []; // 파일 업로드 배열
        var ex_files = false;
        var cnt = 0;

        var si = false;

        $(document).ready(function() {

            // 이미지 추가 핸들링
            $('#input_imgs').on("change", handleImgsFilesSelect);


            // 텍스트 입력 필드가 있는 경우 첫 텍스트 필드로 포커스 이동
            $("#write_action :input:text:visible:enabled:first").focus();
            
            $("#write_btn").click(function() {
                var cke_contents = CKEDITOR.instances.contents.getData();


                if ($("#title").val() == '') {
                    showModal('#popupModal');
                    $("#popup-msg").text("제목을 입력해 주세요.");
                }
                // else if($('#buyer').val() ==''){
                //     showModal('#popupModal');
                //     $("#popup-msg").text("발주처를 입력해 주세요.");
                // }
                // else if($("#s_date").val() == ''){
                //     showModal('#popupModal');
                //     $("#popup-msg").text("시작일을 입력해 주세요.");
                //     $("#s_date").focus();
                //     return;
                // }else if($("#e_date").val() == ''){
                //     showModal('#popupModal');
                //     $("#popup-msg").text("종료일을 입력해 주세요.");
                //     $("#e_date").focus();
                //     return;
                // }
                else if(cke_contents == '' || cke_contents == null || cke_contents == '&nbsp;' || cke_contents == '<p>&nbsp;</p>') {
                    showModal('#popupModal');
                    $("#popup-msg").text("내용을 입력해 주세요.");
                }else{
                    $("#cke_contents").val(cke_contents);

                    
                    if(sel_files.length > 0){
                        si = true;
                        fileUploadAction('', 'services/service'); // 파일업로드
                    }

                    if(si == true){
                        showModal('#popupModal');
                        $("#popup-msg").text("파일 업로드중입니다. 잠시만 기다려주세요.");

                        setInterval(function() {
                            if(si == true){
                                showModal('#popupModal');
                                $("#popup-msg").text("파일 업로드중입니다. 잠시만 기다려주세요.");
                            }
                            else
                                $("#write_action").submit();
                         }, 300);
                    }
                    else
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
                            <h2>용역관리-등록</h2>
                        </div>
                        <div class="breadcrumb">
                            <ol class="clearfix">
                                <li><a href="#">HOME</a></li>
                                <li><a href="#">용역관리</a></li>                                
                            </ol>
                        </div>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="content-area">
                                <?=form_open('', 'id=write_action enctype="multipart/form-data"')?>
                                <input type="hidden" name="v" value="<?=$v?>">
                                <input type="hidden" name="k" value="<?=$hash?>">
                                <input type="hidden" id="token" value="<?=$this->security->get_csrf_hash()?>">
                                <fieldset>
                                    <legend class="hidden-text">용역관리등록</legend>
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
                                                <th>용역유형</th>
                                                <td class="clearfix">
                                                    <div class="col-33 fl-l">
                                                       <label for="category" class="hidden-text">용역유형</label>
                                                       <select name="category" id="category" class="form">
                                                           <option selected hidden value="없음">선택하세요.</option>
                                                           <option value="1">토목/건축/구조물 시험</option>
                                                           <option value="2">항공/기계/자동차 시험</option>
                                                           <option value="3">재료 부품 시험</option>
                                                           <option value="4">비디오 게이지 활용 시험</option>
                                                           <option value="5">기타 시험</option>
                                                       </select> 
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>메인페이지노출</th>
                                                <td>
                                                    <div class="col-100">
                                                        <input type="checkbox" name="page_main" id="page_main" value="Y">
                                                        <label class="checkbox-label" for="page_main"><span></span>메인페이지노출</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- <tr>
                                                <th>주소</th>
                                                <td>
                                                    <div class="col-50 m-b-5">
                                                        <label for="" class="hidden-text">우편번호</label>
                                                        <input class="form form-50 p-l-20" type="text" name="postcode" value="" id="postcode" readonly>
                                                        <button type="button" class="btn typeA-blue" onclick="execPostcode()" ><i class="fas fa-search">&nbsp;</i>주소 찾기</button>
                                                    </div>
                                                    <div class="col-100 m-b-5">
                                                        <label for="" class="hidden-text">주소</label>
                                                        <input class="form" type="text" name="addr" id="address" value="" readonly>
                                                    </div>
                                                    <div class="col-100">
                                                        <label for="" class="hidden-text">상세 주소</label>
                                                        <input class="form" type="text" name="addr_detail" id="address2" placeholder="상세주소를 입력해주세요." value="">
                                                    </div>
                                                </td>
                                            </tr> -->
                                            <!-- <tr>
                                                <th>발주처 *</th>
                                                <td>
                                                    <div class="col-100">
                                                        <label for="buyer" class="hidden-text">발주처</label>
                                                        <input type="text" name="buyer" id="buyer" class="form" value="" placeholder="발주처를 입력해주세요.">
                                                    </div>
                                                </td>
                                            </tr> -->
                                            <!-- <tr>
                                                <th>규모</th>
                                                <td>
                                                    <div class="col-100">
                                                        <label for="scale" class="hidden-text">규모</label>
                                                        <input type="text" name="scale" id="scale" class="form" value="" placeholder="규모를 입력해주세요.">
                                                    </div>
                                                </td>
                                            </tr> -->
                                            <!-- <tr>
                                                <th>기간 *</th>
                                                <td>
                                                    <div class="row">
                                                        <div class="calendar-form col-25">
                                                            <div>
                                                                <label for="" class="hidden-text">날짜지정</label>
                                                                <input type="text" class="form date single-limit" placeholder="시작일을 선택해주세요." id="s_date" name="s_date" value="<?=set_value('s_date')?>" readonly>
                                                            </div>
                                                            <div class="calendar-panel cal-w100">
                                                                <p class="cal-info"><span class="fas fa-info-circle gray-6 m-r-5"></span>시작일을 선택해주세요.</p>
                                                                <div class="calendar notMinDate" id="calSingle1"></div>
                                                            </div>
                                                        </div>
                                                        <span class="m-blank">~</span>
                                                        <div class="calendar-form col-25">
                                                            <div>
                                                                <label for="" class="hidden-text">날짜지정</label>
                                                                <input type="text" class="form date single-limit" placeholder="종료일을 선택해주세요." id="e_date"  name="e_date" value="<?=set_value('e_date')?>" readonly>
                                                            </div>

                                                            <div class="calendar-panel cal-w100">
                                                                <p class="cal-info"><span class="fas fa-info-circle gray-6 m-r-5"></span>종료일을 선택해주세요.</p>
                                                                <div class="calendar notMinDate notMinEnd" id="calSingle2"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?=form_error('s_date','<div class="col-error">', '</div>')?>
                                                    <?=form_error('e_date','<div class="col-error">', '</div>')?>
                                                </td>
                                            </tr> -->
                                            <tr>
                                                <th>대표이미지 *</th>
                                                <td>
                                                    <div class="preview-img"></div>
                                                    <div class="file">
                                                        <input class="form upload-name" placeholder="찾아보기 버튼으로 이미지를 추가하세요" readonly>
                                                        <span class="ico-file-cancel"></span>
                                                        <br>
                                                        <div class="col-100 m-t-8">
                                                            <label class="btn typeA-blue pointer btn-file" for="input_file1"><i class="fas fa-search">&nbsp;</i>찾아보기</label>
                                                            <input type="file" name="userfile[]" id="input_file1" class="upload-hidden" accept="image/*" value="<?=set_value('userfile')?>">
                                                        </div>
                                                        <?=form_error('userfile','<div class="col-error">', '</div>')?>
                                                    </div>
                                                </td>
                                            </tr>
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
                                            <tr>
                                                <th>추가이미지</th>
                                                <td>
                                                    <div class="col-100">
                                                        <label class="btn typeA-blue pointer btn-file" for="input_imgs"><i class="fas fa-search">&nbsp;</i>찾아보기</label>
                                                        <input type="file" name="" id="input_imgs" class="file-hidden file-temp-upload" accept="image/*" value="" multiple>
                                                    </div>
                                                    <div class="col-100" style="display:none;">
                                                        <input type="text" name="img_list" id="img_list">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>미리보기</th>
                                                <td>
                                                    <div id="imgs_wrap" class="col-100"></div>
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

        <!-- 우편번호/주소 검색 모듈-->
        <!-- <script src="https://ssl.daumcdn.net/dmaps/map_js_init/postcode.v2.js"></script>
        <script src="<?php echo $this->config->item('home_assets_url'); ?>/cms/vendor/postCode/postCode.js"></script> -->
        <!-- //우편번호/주소 검색 모듈-->

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