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
                if ($("#auth_name").val() == '') {
                    showModal('#popupModal');
                    $("#popup-msg").text("이름을 입력해 주세요.");                    
                } else if ($("#auth_id").val() == '') {
                    showModal('#popupModal');
                    $("#popup-msg").text("아이디를 입력해 주세요.");
                } else if ($("#auth_email").val() == '') {
                    showModal('#popupModal');
                    $("#popup-msg").text("이메일을 입력해 주세요.");
                } else if ($("#auth_passwd").val() == '') {
                    showModal('#popupModal');
                    $("#popup-msg").text("패스워드를 입력해 주세요.");
                } else {
                    $("#write_action").submit();
                }
            });
        });
    </script> 
</head>


<body> 
        <!--Page Header include -->
        <?php $this->load->view('admin/inc/header'); ?>
        <!--//Page Header include -->
        
        <!-- body -->
        <div class="container">
            
            <!--Page sidemenu include -->
            <?php $this->load->view('admin/inc/sidemenu'); ?>
            <!--Page sidemenu include -->

        <!-- 각 페이지 별 -->
            <div class="section">
                <div class="section-content">
                    <div class="section-header">
                        <div class="section-title">
                            <h2>관리자 관리</h2>
                        </div>
                        <div class="breadcrumb">
                            <ol class="clearfix">
                                <li><a href="#"><i class="fas fa-home">&nbsp;</i>HOME</a></li>
                                <li><a href="#">관리자관리</a></li>
                                <li><a href="#">관리자등록</a></li>
                            </ol>
                        </div>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="content-area">
                                <input type="hidden" id="token" value="<?=$this->security->get_csrf_hash()?>">
                                <?=form_open('', 'id="write_action"')?>
                                <input type="hidden" name="v" value="<?=$v?>">
                                <fieldset>
                                    <legend class="hidden-text">공지사항수정</legend>
                                    <table class="table table-typeB">
                                        <colgroup>
                                            <col width="180">
                                            <col>
                                        </colgroup>
                                        <thead>
                                            <tr>
                                                <th>이름 *</span></th>
                                                <td>
                                                    <div class="col-50">
                                                        <label for="" class="hidden-text">이름입력</label>
                                                        <input type="text" name="auth_name" id="auth_name" class="form" placeholder="이름을 입력하세요" value="<?=$views->auth_name;?>">
                                                    </div>
                                                    <?=form_error('auth_name','<div class="col-error">', '</div>')?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>아이디 *</th>
                                                <td>
                                                    <div class="col-50">
                                                        <label for="" class="hidden-text">아이디입력</label>
                                                        <?=$views->auth_id;?>
                                                    </div>
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <th>이메일 *</th>
                                                <td>
                                                    <div class="col-50 with-btn-m m-b-5">
                                                        <label for="" class="hidden-text">이메일</label>
                                                        <input type="text" name="auth_email" id="auth_email" class="form p-l-20" value="<?=$views->auth_email;?>">
                                                        <button type="button" id="email_dupl_chk" class="btn btn-with-form typeA-blue">중복검사</button>
                                                    </div>
                                                    <?=form_error('auth_email','<div class="col-error">', '</div>')?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th>비밀번호 *</th>
                                                <td>
                                                    <div class="col-50">
                                                        <label for="" class="hidden-text">비밀번호입력</label>
                                                        <input type="password" name="auth_passwd" id="auth_passwd" class="form" placeholder="비밀번호을 입력하세요" value="<?=$views->auth_passwd;?>">
                                                    </div>
                                                    <?=form_error('auth_passwd','<div class="col-error">', '</div>')?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>사용여부 *</th>
                                                <td>
                                                    <div class="col-25">
                                                        <label for="" class="hidden-text">사용여부</label>
                                                        <select class="form" name="use_yn">
                                                            <?php 
                                                                if($views->use_yn =='Y') 
                                                                    echo '<option selected value="Y">사용</option><option value="N">사용안함</option>';
                                                                else if($views->use_yn =='N') 
                                                                    echo '<option value="Y">사용</option><option selected value="N">사용안함</option>';
                                                            ?>
                                                            </select>                                                        
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                          
                                    </table>
                                </fieldset>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="content-area clearfix">
                                <div class="btn-group fl-l">
                                    <button class="btn typeA-gray" onclick="goDelete('<?=$this->config->item('ADMIN_ROOT'); ?>/user/super/delete/<?=$views->idx ?>?v=<?=$v?>')">삭제</button>
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
    </div>
</body>
</html>