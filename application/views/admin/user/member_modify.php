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
                
                if ($("#user_name").val() == '') {
                    showModal('#popupModal');
                    $("#popup-msg").text("회원이름을 입력해 주세요.");
                    $("#user_name").focus();
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
                            <h2>회원관리 - 수정</h2>
                        </div>
                        <div class="breadcrumb">
                            <ol class="clearfix">
                                <li><a href="#"><i class="fas fa-home">&nbsp;</i>HOME</a></li>
                                <li><a href="#">회원관리</a></li>
                            </ol>
                        </div>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="content-area">
                                <?=form_open('', 'id="write_action"')?>
                                <input type="hidden" name="v" value="<?=$v?>">
                                <fieldset>
                                <legend class="hidden-text">회원관리수정</legend>
                                <table class="table table-typeB">
                                    <colgroup>
                                        <col width="180">
                                        <col>
                                    </colgroup>
                                    <tbody>
                                        <tr>
                                            <th>아이디</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">아이디</label>
                                                    <?=$views->user_id;?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>이름</th>
                                            <td>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">지점명</label>
                                                    <input type="text" class="form" name="user_name" id="user_name" value="<?=$views->user_name;?>">
                                                </div>
                                                <?=form_error('user_name','<div class="col-error">', '</div>')?>
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
                                                <div class="col-100 m-b-5">
                                                    <label for="" class="hidden-text">도로명 주소</label>
                                                    <input class="form" type="text" name="addr" id="address" readonly value="<?=$views->addr;?>">
                                                </div>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">지번 주소</label>
                                                    <input class="form" type="text" name="addr2" id="address2" value="<?=$views->addr2;?>">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>휴대폰번호</th>
                                            <td>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">휴대폰번호</label>
                                                    <input type="text" class="form" name="user_phone" id="user_phone" value="<?=$views->user_phone;?>">
                                                </div>
                                                <?=form_error('user_phone','<div class="col-error">', '</div>')?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>수신여부</th>
                                            <td>
                                                <div class="col-100">
                                                     <input type="checkbox" id="chk1" name="agreement[]" value="sms" <?php if(strpos($views->agreement, 'sms') !==false) echo "checked" ?>>
                                                    <label class="checkbox-label" for="chk1"><span></span>문자수신</label>
                                                    <input type="checkbox" id="chk2" name="agreement[]" value="email" <?php if(strpos($views->agreement, 'email') !==false) echo "checked" ?>>
                                                    <label class="checkbox-label" for="chk2"><span></span>이메일수신</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>차단설정</th>
                                            <td>
                                                <div class="col-100">
                                                     <input type="checkbox" id="chk3" name="login_block_yn" value="Y" <?php if(strpos($views->login_block_yn, 'Y') !==false) echo "checked" ?>>
                                                    <label class="checkbox-label" for="chk3"><span></span>로그인 차단설정</label>                                                 
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>최근로그인일시</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">최근로그인일시</label>
                                                    <?=substr($views->latest_login_date,0,16);?> (총 <?=$views->login_cnt;?>회 로그인)
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>가입일</th>
                                            <td>
                                                <div class="col-100">
                                                    <label for="" class="hidden-text">가입일</label>
                                                    <?=substr($views->reg_date,0,16);?> 
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>회원상태</th>
                                            <td>
                                                <div class="col-25">
                                                    <label for="" class="hidden-text">회원상태</label>
                                                        <span class="color-positive"><?php if($views->status == 'Y') echo "정상"; ?></span>
                                                        <span class="color-positive"><?php if($views->status == 'N') echo "탈퇴"; ?></span>
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
                                    <button class="btn typeA-gray" onclick="goUnregister('<?=$this->config->item('ADMIN_ROOT'); ?>/user/member/delete/<?=$views->idx ?>?v=<?=$v?>')">탈퇴</button>
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