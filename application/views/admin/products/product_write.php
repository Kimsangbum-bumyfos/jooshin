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

        // img val
        var sel_files = []; // 파일 업로드 배열
        var ex_files = false;
        var cnt = 0;

        // file val
        var f_sel_files = []; // 파일 업로드 배열
        var f_ex_files = 'false';
        var real_files = 'false';  // 기존 파일명 배열(real)
        var f_cnt = 0;


        var sf = false;
        var si = false;

        $(document).ready(function() {

            // 파일 추가 핸들링
            $('#upload_files').on("change", handleFilesSelect);

            // 이미지 추가 핸들링
            $('#input_imgs').on("change", handleImgsFilesSelect);


            // 텍스트 입력 필드가 있는 경우 첫 텍스트 필드로 포커스 이동
            $("#write_action :input:text:visible:enabled:first").focus();
            
            $("#write_btn").click(function() {
                // var cke_contents = CKEDITOR.instances.contents.getData();

                cell.save();    // 추가 항목 저장

                var category_chk = true;
                for(var i=1; i<=3; i++){
                    if($('#depth_'+i+' option:selected').val() == 'null'){
                        category_chk = false;
                    }
                }

                if ($("#title").val() == '') {
                    showModal('#popupModal');
                    $("#popup-msg").text("제품명을 입력해 주세요.");
                }
                // else if($("#model_name").val() == '') {
                //     showModal('#popupModal');
                //     $("#popup-msg").text("모델명을 입력해 주세요.");
                // }
                // else if($("#manufacturer").val() == '') {
                //     showModal('#popupModal');
                //     $("#popup-msg").text("제조사를 입력해 주세요.");
                // }
                else if($('#th_name').val()== ''){
                    showModal('#popupModal');
                        $("#popup-msg").text("대표이미지를 등록해주세요.");
                }
                else if(category_chk == false){
                    showModal('#popupModal');
                        $("#popup-msg").text("카테고리를 선택해 주세요.");
                }
                // else if(cke_contents == '' || cke_contents == null || cke_contents == '&nbsp;' || cke_contents == '<p>&nbsp;</p>') {
                //     showModal('#popupModal');
                //     $("#popup-msg").text("내용을 입력해 주세요.");
                // }
                else{
                    // $("#cke_contents").val(cke_contents);

                    if(sel_files.length > 0){
                        si = true;
                        fileUploadAction('', 'products/product'); // 이미지 업로드
                    }

                    if(f_sel_files.length > 0){
                        sf = true;
                        fileUploadAction_product('', ''); // 파일 업로드
                    }

                    if(sf == true || si == true){
                        showModal('#popupModal');
                        $("#popup-msg").text("저장중입니다. 잠시만 기다려주세요.");

                        setInterval(function() {
                            if(sf == true || si == true){
                                showModal('#popupModal');
                                $("#popup-msg").text("저장중입니다. 잠시만 기다려주세요.");
                            }
                            else{
                                var textArea_1 = $('#sub_title').val();
                                textArea_1 = textArea_1.replace(/(?:\r\n|\r|\n)/g, '<br>');
                                $('#sub_title').val(textArea_1);

                                $("#write_action").submit();
                            }
                         }, 300);
                    }
                    else{
                        var textArea_1 = $('#sub_title').val();
                        textArea_1 = textArea_1.replace(/(?:\r\n|\r|\n)/g, '<br>');
                        $('#sub_title').val(textArea_1);
                                
                        $("#write_action").submit();
                    }
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
                            <h2>제품관리-등록</h2>
                        </div>
                        <div class="breadcrumb">
                            <ol class="clearfix">
                                <li><a href="#">HOME</a></li>
                                <li><a href="#">제품관리</a></li>                                
                            </ol>
                        </div>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="content-area">
                                <?=form_open('', 'id=write_action enctype="multipart/form-data"')?>
                                <input type="hidden" name="v" value="<?=$v?>">
                                <input type="hidden" name="k" value="<?=$hash?>">
                                <fieldset>
                                    <legend class="hidden-text">제품관리등록</legend>
                                    <table class="table table-typeB">
                                        <colgroup>
                                            <col width="180">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr>
                                                <th>제품명 *</th>
                                                <td>
                                                    <div class="col-100">
                                                        <label for="" class="hidden-text">제품명</label>
                                                        <input type="text" name="title" id="title" class="form" value="<?=set_value('title')?>" placeholder="제품명을 입력하세요.">
                                                    </div>
                                                    <?=form_error('title','<div class="col-error">', '</div>')?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>부가설명</th>
                                                <td>
                                                    <div class="col-100">
                                                        <label for="" class="hidden-text">부가설명</label>
                                                        <!-- <input type="text" name="sub_title" id="sub_title" class="form" value="" placeholder="부가설명을 입력하세요."> -->
                                                        <textarea name="sub_title" id="sub_title" style="height:90px;" class="form" placeholder="부가설명을 입력하세요."></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>카테고리 *</th>
                                                <td class="clearfix">
                                                    <div class="col-33 fl-l">
                                                       <label for="depth_1" class="hidden-text">뎁스1</label>
                                                       <select name="depth_1" id="depth_1" class="form product_depth_1">
                                                           <option selected hidden value="null">선택하세요.</option>
                                                           <option value="계측장비">계측장비</option>
                                                           <option value="스트레인게이지">스트레인게이지</option>
                                                           <option value="계측센서">계측센서</option>
                                                           <option value="비디오게이지">비디오게이지</option>
                                                           <option value="시험용치구">시험용치구</option>
                                                           <option value="제작품">제작품</option>
                                                       </select> 
                                                    </div>
                                                    <div class="col-33 fl-l">
                                                       <label for="depth_2" class="hidden-text">뎁스2</label>
                                                       <select name="depth_2" id="depth_2" class="form product_depth_2" disabled>
                                                           <option selected hidden value="null">선택하세요.</option>
                                                       </select> 
                                                    </div>
                                                    <div class="col-33 fl-l">
                                                       <label for="depth_3" class="hidden-text">뎁스3</label>
                                                       <select name="depth_3" id="depth_3" class="form product_depth_3" disabled>
                                                           <option selected hidden value="null">선택하세요.</option>
                                                       </select> 
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>모델명</th>
                                                <td>
                                                    <div class="col-100">
                                                        <label for="model_name" class="hidden-text">모델명</label>
                                                        <input type="text" name="model_name" id="model_name" class="form" value="" placeholder="모델명을 입력하세요">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>제조사</th>
                                                <td>
                                                    <div class="col-100">
                                                        <label for="manufacturer" class="hidden-text">제조사</label>
                                                        <input type="text" name="manufacturer" id="manufacturer" class="form" value="" placeholder="제조사를 입력하세요">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>타입</th>
                                                <td>
                                                    <div class="col-100">
                                                        <label for="type" class="hidden-text">타입</label>
                                                        <input type="text" name="type" id="type" class="form" value="" placeholder="타입을 입력하세요">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>측정범위</th>
                                                <td>
                                                    <div class="col-100">
                                                        <label for="sensor_range" class="hidden-text">측정범위</label>
                                                        <input type="text" name="sensor_range" id="sensor_range" class="form" value="" placeholder="센서의 측정범위를 입력하세요">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>외경</th>
                                                <td>
                                                    <div class="col-100">
                                                        <label for="sensor_outline" class="hidden-text">외경</label>
                                                        <input type="text" name="sensor_outline" id="sensor_outline" class="form" value="" placeholder="센서의 외경을 입력하세요">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>항목추가</th>
                                                <td>
                                                    <div id="add_input_wrap" class="clearfix">
                                                        <div id="ctl_cell">
                                                            <div class="col-25 fl-l">
                                                                <input type="text"  name="" id="form_cell_key" class="form add-cell-key" value="" placeholder="항목명을 입력해주세요">
                                                            </div>
                                                            <div class="cell-with-btn">
                                                                <textarea name="" id="form_cell_value" class="add-cell-value" cols="" rows=""></textarea>
                                                            </div>
                                                            <div class="cell-btn">
                                                                <button type="button" id="add_cell" class="btn-cell btn typeA-blue">항목추가</button>
                                                                <input type="hidden" id="key_value" name="key_value">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- <tr>
                                                <th>고정페이지여부</th>
                                                <td>
                                                    <div class="col-100">
                                                        <input type="checkbox" name="page_fix" id="page_fix" value="Y">
                                                        <label class="checkbox-label" for="page_fix"><span></span>고정페이지사용여부</label>
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
                                            </tr> -->
                                            <tr>
                                                <th>대표이미지 *</th>
                                                <td>
                                                    <div class="preview-img"></div>
                                                    <div class="file">
                                                        <input class="form upload-name" id="th_name" placeholder="찾아보기 버튼으로 이미지를 추가하세요" readonly>
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
                                            <!-- <tr>
                                                <th>내용 *</th>
                                                <td>
                                                    <div class="col-100">
                                                        <label for="" class="hidden-text">내용</label>
                                                        <div>
                                                            <textarea name="contents" id="contents" rows="30" style="width:100%;"><?=set_value('contents')?></textarea>
                                                            
                                                            <script>
                                                                CKEDITOR.replace( 'contents', {
                                                                    filebrowserUploadUrl: '<?=$this->config->item('ADMIN_ROOT'); ?>/CKE_Upload/cke_upload?k=<?=$hash?>'
                                                                });
                                                            </script>
                                                        </div>
                                                    </div>
                                                    <?=form_error('contents','<div class="col-error">', '</div>')?>
                                                </td>
                                            </tr> -->
                                            <!-- ckeditor 호출 및 파일 업로드 실행 파일 경로 설정 -->
                                            <!--// ckeditor 호출 및 파일 업로드 실행 파일 경로 설정 -->
                                            <tr>
                                                <th>파일첨부</th>
                                                <td>
                                                    <div class="col-100">
                                                        <label class="btn typeA-blue pointer btn-file" for="upload_files"><i class="fas fa-search">&nbsp;</i>찾아보기</label>
                                                        <input type="file"  id="upload_files" class="file-hidden file-temp-upload" accept="image/*, .pdf, .doc, .docx, .pptx" value="" multiple>
                                                    </div>
                                                    <div class="col-100" style="display:none;">
                                                        <input type="text" name="file_law_name" id="file_list">
                                                        <input type="text" name="file_real_name" id="file_real_name">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>파일목록</th>
                                                <td>
                                                    <div id="files_wrap" class="col-100"></div>
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