<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="<?php echo $this->config->item('LANG'); ?>">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title><?php echo $this->config->item('HOMEPAGE_TITLE'); ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="<?php echo $this->config->item('META_DATA'); ?>" name="description" />
       
        <script type="text/javascript" src="<?php echo $this->config->item('INCLUDE_DIR2'); ?>/ckeditor/ckeditor.js"></script>

        <link href="<?php echo $this->config->item('INCLUDE_DIR2'); ?>/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $this->config->item('INCLUDE_DIR2'); ?>/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        
        <!-- BEGIN PLUGIN, JS INCLUDE -->
        <?php $this->load->view('admin/include/js_inc'); ?>
        <!-- END PLUGIN, JS INCLUDE -->
        
        <link rel="shortcut icon" href="favicon.ico" /> 
        <script>
            $(document).ready(function() {

                $("#write_btn").click(function() {

                    if ($("#address_title").val() == '') {
                        alert('제목을 입력해 주세요.');
                        $("#address_title").focus();
                        return false;
                    } else {
                        $("#write_action").submit();
                    }
                });
            });
       </script>
    </head>
    <!-- END HEAD -->

    <body class="page-container-bg-solid">
        <div class="page-wrapper">
            <div class="page-wrapper-row">
                <div class="page-wrapper-top">
                    <!-- BEGIN HEADER -->
                    <?php $this->load->view('admin/include/header_inc'); ?>
                    <!-- END HEADER -->
                </div>
            </div>
            <div class="page-wrapper-row full-height">
                <div class="page-wrapper-middle">
                    <!-- BEGIN CONTAINER -->
                    <div class="page-container">
                        <!-- BEGIN CONTENT -->
                        <div class="page-content-wrapper">
                            <!-- BEGIN CONTENT BODY -->
                            <!-- BEGIN PAGE HEAD-->
                            <div class="page-head">
                                <div class="container">
                                    <!-- BEGIN PAGE TITLE -->
                                    <div class="page-title">
                                        <h1>주소록 관리</h1>
                                    </div>
                                    <!-- END PAGE TITLE -->
                                </div>
                            </div>
                            <!-- END PAGE HEAD-->
                            <!-- BEGIN PAGE CONTENT BODY -->
                            <div class="page-content">
                                <div class="container">
                                    <!-- BEGIN PAGE CONTENT INNER -->
                                    <div class="page-content-inner">
                                        <div class="row">
                                            
                                            <div class="col-md-12">
                                                <!-- BEGIN BORDERED TABLE PORTLET-->
                                                <div class="portlet box green ">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <i class="fa fa-bullhorn"></i>
                                                            <span class="caption-subject uppercase">주소록 등록</span>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body">
                                                        <form class="form-horizontal" name="frm" method="post" action="" id="write_action">
                                                        <div class="table-scrollable">
                                                            <table class="table table-bordered">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="col-md-2"> 주소록 그룹명 </td>
                                                                        <td>
                                                                            <div class="col-md-12">
                                                                                <input type="text" name="address_title" id="address_title" class="form-control input-lg" placeholder="제목을 입력하세요" required> 
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="col-md-2"> 회원선택 </td>
                                                                        <td>
                                                                        <div class="col-md-12">    
                                                                        <label for="multiple" class="control-label">회원을 검색하여 추가해 주세요.</label>
                                                                        <select id="multiple" name="member_list[]" class="form-control select2-multiple input-lg" multiple>
                                                                        <optgroup label="회원을 검색하여 추가해 주세요.">
                                                                        <?php 
                                                                            foreach($list as $lt){
                                                                        ?>    
                                                                        
                                                                        <option value="<?php echo $lt -> user_name ?>|<?php echo $lt -> user_email ?>|<?php echo $lt -> receive_mail_yn ?>"><?php echo $lt -> user_name ?> - <?php echo $lt -> user_email ?></option>
                                                                       
                                                                        <?php
                                                                            }
                                                                        ?>
                                                                        </optgroup>
                                                                       
                                                                        </select>

                                                                        </div>
                                                                    </td>
                                                                    </tr>
                                                            
                                                              
                                                                </tbody>
                                                            </table>

                                                        </div>
                                                    </form>
                                                        <!--  start search group -->
                                                        <div align="right" class="form-actions noborder">
                                                            <button type="submit" class="btn btn-primary" id="write_btn">저장</button>
                                                            <a href="javascript:history.back()"><button type="button" class="btn btn-default">취소</button></a>
                                                        </div>
                                                        <!-- input-group -->
                                                    </div>
                                                </div>
                                                <!-- END BORDERED TABLE PORTLET-->
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                    <!-- END PAGE CONTENT INNER -->
                                </div>
                            </div>
                            <!-- END PAGE CONTENT BODY -->
                            <!-- END CONTENT BODY -->
                        </div>
                        <!-- END CONTENT -->
                        
                    </div>
                    <!-- END CONTAINER -->
                </div>
            </div>
            <?php $this->load->view('admin/include/footer_inc'); ?>
        </div>
        
        <!--[if lt IE 9]>
        <script src="<?php echo $this->config->item('INCLUDE_DIR'); ?>/plugins/respond.min.js"></script>
        <script src="<?php echo $this->config->item('INCLUDE_DIR'); ?>/plugins/excanvas.min.js"></script> 
        <script src="<?php echo $this->config->item('INCLUDE_DIR'); ?>/plugins/ie8.fix.min.js"></script> 
        <![endif]-->
         <!-- BEGIN CORE PLUGINS -->
        <script src="<?php echo $this->config->item('INCLUDE_DIR'); ?>/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo $this->config->item('INCLUDE_DIR'); ?>/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo $this->config->item('INCLUDE_DIR'); ?>/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?php echo $this->config->item('INCLUDE_DIR'); ?>/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?php echo $this->config->item('INCLUDE_DIR'); ?>/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?php echo $this->config->item('INCLUDE_DIR'); ?>/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo $this->config->item('INCLUDE_DIR'); ?>/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?php echo $this->config->item('INCLUDE_DIR2'); ?>/layouts/layout3/scripts/layout.min.js" type="text/javascript"></script>
        <script src="<?php echo $this->config->item('INCLUDE_DIR2'); ?>/layouts/layout3/scripts/demo.min.js" type="text/javascript"></script>
        <script src="<?php echo $this->config->item('INCLUDE_DIR2'); ?>/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="<?php echo $this->config->item('INCLUDE_DIR2'); ?>/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->   

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo $this->config->item('INCLUDE_DIR2'); ?>/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo $this->config->item('INCLUDE_DIR2'); ?>/pages/scripts/components-select2.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
     
    </body>
</html>