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
                
                if ($("#branch_name").val() == '') {
                    showModal('#popupModal');
                    $("#popup-msg").text("지점명을 입력해 주세요.");
                    $("#branch_name").focus();
                    return;                    
                }else if($("#addr_code").val() == '' || $("#address").val() == '' || $("#address2").val() == ''){
                    showModal('#popupModal');
                    $("#popup-msg").text("주소를 입력해 주세요.");
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
                            <h2>지점관리 - 등록</h2>
                        </div>
                        <div class="breadcrumb">
                            <ol class="clearfix">
                                <li><a href="#"><i class="fas fa-home">&nbsp;</i>HOME</a></li>
                                <li><a href="#">지점관리</a></li>
                            </ol>
                        </div>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="content-area">
                                <form method="post" id="write_action" enctype="multipart/form-data">
                                <fieldset>
                                <legend class="hidden-text">지점관리등록</legend>
                                <table class="table table-typeB">
                                    <colgroup>
                                        <col width="180">
                                        <col>
                                    </colgroup>
                                    <tbody>
                                        <tr>
                                            <th>지점명</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">지점명</label>
                                                    <input type="text" class="form" name="branch_name" id="branch_name">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>주소</th>
                                            <td>
                                                <div class="col-50 m-b-5">
                                                    <label for="" class="hidden-text">우편번호</label>
                                                    <input class="form form-50 p-l-20" type="text" name="addr_code" id="postcode" readonly>
                                                    <button type="button" class="btn typeA-blue" onclick="execPostcode()" ><i class="fas fa-search">&nbsp;</i>우편번호 찾기</button>
                                                </div>
                                                <div class="col-100 m-b-5">
                                                    <label for="" class="hidden-text">도로명 주소</label>
                                                    <input class="form" type="text" name="addr" id="address" readonly>
                                                </div>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">지번 주소</label>
                                                    <input class="form" type="text" name="addr2" id="address2">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>사무실번호</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">사무실번호</label>
                                                    <input type="text" class="form" name="office_tel" id="office_tel" placeholder="'-'를 포함하여 입력해 주세요(예:02-777-1389)">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>휴대폰번호</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">휴대폰번호</label>
                                                    <input type="text" class="form" name="office_phone" id="office_phone" placeholder="'-'를 포함하여 입력해 주세요(예:010-777-1389)">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>FAX번호</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">FAX번호</label>
                                                    <input type="text" class="form" name="office_fax" id="office_fax" placeholder="'-'를 포함하여 입력해 주세요(예:010-777-1389)">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>영업시간</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">영업시간</label>
                                                    <input type="text" class="form" name="business_hours" id="business_hours" placeholder="예:09:00~19:00">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>지점소개/인사말</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">지점소개/인사말</label>
                                                    <textarea class="table-textarea" name="additional_comment" rows="2"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>찾아오는길</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">찾아오는길</label>
                                                    <textarea class="table-textarea" name="map_comment" rows="2"></textarea>
                                                </div>
                                            </td>
                                        </tr>

                                         <tr>
                                            <th>대표이미지</th>
                                            <td>
                                                <div class="col-75 file preview-image">
                                                    <input class="form w-60 upload-name" placeholder="'찾아보기' 버튼으로 이미지 추가" disabled="disabled">
                                                    <label class="btn typeA-blue pointer" for="input_file"><i class="fas fa-search">&nbsp;</i>찾아보기</label>
                                                    <input type="file" name="userfile" id="input_file" class="upload-hidden"> 
                                                </div>
                                            </td>
                                        </tr>                                        
                                       
                                        <tr>
                                            <th>게시여부</th>
                                            <td>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">사용여부</label>
                                                    <select class="form" name="open_yn">
                                                        <option value="N">대기</option>
                                                        <option value="Y">게시</option>
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
                                    <button class="btn typeA-darkgray" onclick="goPage('<?php echo $this->config->item('ADMIN_BASE_URL'); ?>/branch/')">취소</button>
                                    <button type="submit" class="btn typeA-blue" id="write_btn">저장</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- //각 페이지 별 -->
        </div><!-- //바디 -->
    </div>    

    <script>
    $(document).ready(function(){
       var fileTarget = $('.file .upload-hidden');

        fileTarget.on('change', function(){
            if(window.FileReader){
                // 파일명 추출
                var filename = $(this)[0].files[0].name;
            } 

            else {
                // Old IE 파일명 추출
                var filename = $(this).val().split('/').pop().split('\\').pop();
            };

            $(this).siblings('.upload-name').val(filename);
        });

        //preview image 
        var imgTarget = $('.preview-image .upload-hidden');

        imgTarget.on('change', function(){
            var parent = $(this).parent();
            parent.children('.upload-display').remove();

            if(window.FileReader){
                //image 파일만
                if (!$(this)[0].files[0].type.match(/image\//)) return;
                
                var reader = new FileReader();
                reader.onload = function(e){
                    var src = e.target.result;
                    parent.prepend('<div class="upload-display"><div class="upload-thumb-wrap"><img src="'+src+'" class="upload-thumb"></div></div>');
                }
                reader.readAsDataURL($(this)[0].files[0]);
            }

            else {
                $(this)[0].select();
                $(this)[0].blur();
                var imgSrc = document.selection.createRange().text;
                parent.prepend('<div class="upload-display"><div class="upload-thumb-wrap"><img class="upload-thumb"></div></div>');

                var img = $(this).siblings('.upload-display').find('img');
                img[0].style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(enable='true',sizingMethod='scale',src=\""+imgSrc+"\")";        
            }
        });
    });
    </script>   

    <!-- 우편번호/주소 검색 모듈-->
    <script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
    <script src="<?php echo $this->config->item('home_assets_url'); ?>/cms/vendor/postCode/postCode.js"></script>
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

</body>
</html>