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
                            <h2>고객문의관리</h2>
                        </div>
                        <div class="breadcrumb">
                            <ol class="clearfix">
                                <li><a href="#"><i class="fas fa-home">&nbsp;</i>HOME</a></li>
                                <li><a href="#">고객문의관리</a></li>
                            </ol>
                        </div>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="content-area">
                                <?=form_open('', 'id="write_action"')?>
                                <fieldset>
                                    <legend class="hidden-text">고객문의관리</legend>
                                    <table class="table table-typeB">
                                        <colgroup>
                                            <col width="180">
                                            <col>
                                        </colgroup>
                                        <tbody>
                                            <tr>
                                                <th>문의제목</th>
                                                <td>
                                                    <div class="col-100">
                                                        <?php echo $views->title;?>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>등록일</th>
                                                <td>
                                                    <div class="col-100">
                                                        <pre><?php echo substr($views->reg_date,0,16);?></pre>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>이름</th>
                                                <td>
                                                    <div class="col-100">
                                                        <pre><?php echo $views->name;?></pre>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>연락처</th>
                                                <td>
                                                    <div class="col-100">
                                                        <pre><?php echo $views->phone;?></pre>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>이메일</th>
                                                <td>
                                                    <div class="col-100">
                                                        <pre><?php echo $views->email;?></pre>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>문의내용</th>
                                                <td>
                                                    <div class="col-100">
                                                        <?php echo $views->contents;?>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>답변방식</th>
                                                <td>
                                                    <div class="col-100">
                                                        <input type="radio" id="radio-support-enroll-1" name="feedback_type" value="cable" <?php if($views->feedback_type =='cable') echo "checked"; ?>>
                                                        <label class="radio-label" for="radio-support-enroll-1"><span></span>유선</label>
                                                        
                                                        <input type="radio" id="radio-support-enroll-2" name="feedback_type" value="sms" <?php if($views->feedback_type =='sms') echo "checked"; ?>>
                                                        <label class="radio-label" for="radio-support-enroll-2"><span></span>SMS</label>

                                                        <input type="radio" id="radio-support-enroll-3" name="feedback_type" value="mail" <?php if($views->feedback_type =='mail') echo "checked"; ?>>
                                                        <label class="radio-label" for="radio-support-enroll-3"><span></span>메일</label>

                                                        <input type="radio" id="radio-support-enroll-4" name="feedback_type" value="etc" <?php if($views->feedback_type =='etc') echo "checked"; ?>>
                                                        <label class="radio-label" for="radio-support-enroll-4"><span></span>기타</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>답변메모</th>
                                                <td>
                                                    <div class="col-100">
                                                        <label for="" class="hidden-text">답변메모</label>
                                                        <textarea class="table-textarea" name="feedback_memo" rows="5"><?php echo $views->feedback_memo;?></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>답변여부</th>
                                                <td>
                                                    <div class="col-25">
                                                        <label for="" class="hidden-text">답변여부</label>
                                                        <select class="form" name="feedback_yn">
                                                            <option value="Y" <?php if($views->feedback_yn =='Y') echo "selected"; ?>>답변완료</option>
                                                            <option value="N" <?php if($views->feedback_yn =='N') echo "selected"; ?>>답변대기</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>답변일</th>
                                                <td>
                                                    <div class="col-100">
                                                        <pre><?php echo substr($views->feedback_date,0,16);?></pre>
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
                                    <button class="btn typeA-gray" onclick="goDelete('<?php echo $this->config->item('ADMIN_ROOT'); ?>/customer/inquire/delete/<?php echo $views->idx ?>')">삭제</button>
                                </div>
                                <div class="btn-group fl-r">
                                    <button class="btn typeA-darkgray" onclick="history.back(); return false;">취소</button>
                                    <button type="submit" class="btn typeA-blue" id="write_btn">저장</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- //각 페이지 별 -->
        </div><!-- //바디 -->
    </div>
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