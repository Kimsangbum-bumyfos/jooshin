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
       
        <!-- BEGIN PLUGIN, JS INCLUDE -->
        <?php $this->load->view('admin/include/js_inc'); ?>
        <!-- END PLUGIN, JS INCLUDE -->

         <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo $this->config->item('INCLUDE_DIR');?>/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->

        <link rel="shortcut icon" href="favicon.ico" /> 
        <script>
            $(document).ready(function() {

                $("#write_btn").click(function() {

                    if ($("#title").val() == '') {
                        alert('제목을 입력해 주세요.');
                        $("#title").focus();
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
                                        <h1>메인슬라이드 관리</h1>
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
                                                            <i class="fa fa-desktop"></i>
                                                            <span class="caption-subject uppercase">메인슬라이드 등록</span>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body">
                                                    <form class="form-horizontal" method="post" id="write_action" enctype="multipart/form-data"> 
                                                        <div class="table-scrollable">
                                                            <table class="table table-bordered">
                                                                <tbody>
                                                                   <tr>
                                                                        <td class="col-md-2"> 제목 </td>
                                                                        <td>
                                                                            <div class="col-md-12">
                                                                                <div class="input-icon right">
                                                                                    <i class="fa fa-info-circle tooltips" data-original-title="콘텐츠의 제목이 노출됩니다." data-container="body"></i>
                                                                                <input type="text" name="title" id="title" class="form-control input-lg" placeholder="제목">
                                                                            </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td> 부제목 </td>
                                                                        <td>
                                                                            <div class="col-md-12">
                                                                            <textarea class="form-control input-lg" name="sub_title" rows="2" placeholder="부제목"></textarea>
                                                                          </div>
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td> 요약내용(옵션) </td>
                                                                        <td>
                                                                            <div class="col-md-12">
                                                                            <textarea class="form-control input-lg" name="excerpt" rows="2" placeholder="요약내용(지원 테마만 사용)"></textarea>
                                                                          </div>
                                                                        </td>
                                                                    </tr>

                                                                     <tr>
                                                                        <td> 게시여부</td>
                                                                        <td>
                                                                            <div class="col-md-6">
                                                                            <select class="bs-select form-control input-lg" data-width="125px" name="status">
                                                                                <option selected value="Y">게시</option>
                                                                                <option value="N">대기</option>';
                                                                            </select>
                                                                          </div>
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td class="col-md-2"> 링크정보 </td>
                                                                        <td>
                                                                         <div class="col-md-12">
                                                                                <div class="input-icon right">
                                                                                    <i class="fa fa-info-circle tooltips" data-original-title="링크를 입력하면 콘텐츠 클릭 시 해당 URL로 이동합니다." data-container="body"></i>
                                                                                <input type="text" name="link_url" id="link_url" class="form-control input-lg" placeholder="링크 URL">

                                                                            </div>
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>슬라이드 순서</td>
                                                                        <td>
                                                                            <div class="col-md-2">
                                                                                <div class="input-icon right">
                                                                                <input type="number" name="order_no" id="order_no" class="form-control input-lg" placeholder="순서"  required>
                                                                            </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td> PC 이미지 </td>
                                                                        <td>
                                                                    <div class="col-md-9">
                                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 900px; height: 500px;"> 
                                                                            </div>
                                                                            <div>
                                                                                <span class="btn red btn-outline btn-file">
                                                                                    <span class="fileinput-new"> Select image </span>
                                                                                    <span class="fileinput-exists"> Change </span>
                                                                                    <input type="file" name="userfile[]"> </span>
                                                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                        </td>
                                                                    </tr>

                                                                      <tr>
                                                                        <td> 모바일 이미지 </td>
                                                                        <td>
                                                                    <div class="col-md-9">
                                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 500px; height: 400px;"> 
                                                                            </div>
                                                                            <div>
                                                                                <span class="btn red btn-outline btn-file">
                                                                                    <span class="fileinput-new"> Select image </span>
                                                                                    <span class="fileinput-exists"> Change </span>
                                                                                    <input type="file" name="userfile[]"> </span>
                                                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                        </td>
                                                                    </tr>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        </form>
                                                        <!--  start search group -->
                                                        <div align="right" class="form-actions noborder">
                                                            <button type="button" class="btn btn-primary" id="write_btn">저장</button>
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

        <!-- BEGIN PAGE LEVEL PLUGINS Fileinput-->
        <script src="<?php echo $this->config->item('INCLUDE_DIR');?>/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->

    </body>
</html>