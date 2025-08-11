<!DOCTYPE html>
<html lang="<?=$this->config->item('LANG'); ?>">
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
    <title><?=$this->config->item('HOMEPAGE_TITLE'); ?></title>

    <!-- Page Level include -->
    <link rel="stylesheet" href="<?=$this->config->item('home_assets_url'); ?>/cms/css/style.css">
    <script src="<?=$this->config->item('home_assets_url'); ?>/cms/js/jquery.min.js"></script>
    <script src="<?=$this->config->item('home_assets_url'); ?>/cms/vendor/datepickk/datepickk.js"></script>
    <script src="<?=$this->config->item('home_assets_url'); ?>/cms/js/script.js"></script>
    <!--//Page Level include --> 

    <!-- 유효성 검사 -->
    <script>
        $(document).ready(function() {

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
                            <h2>지점관리 - 수정</h2>
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
                                <?=form_open('', 'id="write_action" enctype="multipart/form-data"')?>
                                <input type="hidden" name="v" value="<?=$v?>">
                                <fieldset>
                                <legend class="hidden-text">지점관리수정</legend>
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
                                                    <input type="text" class="form" name="branch_name" id="branch_name" value="<?=$views->branch_name;?>">
                                                </div>
                                                <?=form_error('branch_name','<div class="col-error">', '</div>')?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>주소</th>
                                            <td>
                                                <div class="col-50 m-b-5">
                                                    <label for="" class="hidden-text">우편번호</label>
                                                    <input class="form form-50 p-l-20" type="text" name="addr_code" id="postcode" readonly value="<?=$views->addr_code;?>">
                                                    <button type="button" class="btn typeA-blue" onclick="execPostcode()" ><i class="fas fa-search">&nbsp;</i>우편번호 찾기</button>
                                                </div>
                                                <?=form_error('addr_code','<div class="col-error">', '</div>')?>
                                                <div class="col-100 m-b-5">
                                                    <label for="" class="hidden-text">도로명 주소</label>
                                                    <input class="form" type="text" name="addr" id="address" readonly value="<?=$views->addr;?>">
                                                </div>
                                                <?=form_error('addr','<div class="col-error">', '</div>')?>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">지번 주소</label>
                                                    <input class="form" type="text" name="addr2" id="address2" value="<?=$views->addr2;?>">
                                                </div>
                                                <?=form_error('addr2','<div class="col-error">', '</div>')?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>사무실번호</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">사무실번호</label>
                                                    <input type="text" class="form" name="office_tel" id="office_tel" value="<?=$views->office_tel;?>">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>휴대폰번호</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">휴대폰번호</label>
                                                    <input type="text" class="form" name="office_phone" id="office_phone" value="<?=$views->office_phone;?>">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>FAX번호</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">FAX번호</label>
                                                    <input type="text" class="form" name="office_fax" id="office_fax" value="<?=$views->office_fax;?>">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>영업시간</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">영업시간</label>
                                                    <input type="text" class="form" name="business_hours" id="business_hours" value="<?=$views->business_hours;?>">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>지점소개/인사말</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">지점소개/인사말</label>
                                                    <textarea class="table-textarea" name="additional_comment" rows="2"><?=$views->additional_comment;?></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>찾아오는길</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">찾아오는길</label>
                                                    <textarea class="table-textarea" name="map_comment" rows="2"><?=$views->map_comment;?></textarea>
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
                                            <th>게시여부</th>
                                            <td>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">사용여부</label>
                                                    <select class="form" name="open_yn">
                                                        <option value="N" <?php if($views->open_yn == 'Y') echo "selected"; ?>>대기</option>
                                                        <option value="Y" <?php if($views->open_yn == 'Y') echo "selected"; ?>>공개</option>
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
                                <div class="btn-group fl-l">
                                    <button class="btn typeA-gray" onclick="goDelete('<?=$this->config->item('ADMIN_ROOT'); ?>/branch/delete/<?=$views->idx ?>?v=<?=$v?>')">삭제</button>
                                </div>
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

    <!-- 우편번호/주소 검색 모듈-->
<!--    <script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>-->
    <script src="https://ssl.daumcdn.net/dmaps/map_js_init/postcode.v2.js"></script>
    <script src="<?=$this->config->item('home_assets_url'); ?>/cms/vendor/postCode/postCode.js"></script>
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
    <!-- 팝업(삭제) -->
        <div class="modal" id="popupModalDelete">
            <div class="modal-dimmed">
                <div class="modal-panel">
                    <div class="modal-header">
                        <p class="font-16 gray-6" id="delete-popup-msg"></p>
                    </div>
                    <div class="btn-group">
                        <button onclick="hideModal('#popupModalDelete')" class="btn typeA-gray">아니요</button>
                        <button class="btn typeA-blue" id="delete">예</button>
                    </div>
                </div>
            </div>
        </div><!-- //팝업 -->

</body>
</html>