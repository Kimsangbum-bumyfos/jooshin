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
        <meta content="<?php echo $this->config->item('META_DATA'); ?>"
            name="description" />

        <!-- BEGIN PLUGIN, JS INCLUDE -->
        <?php $this->load->view('admin/include/js_inc'); ?>
        <!-- END PLUGIN, JS INCLUDE -->

        <link rel="shortcut icon" href="favicon.ico" /> 

        <script>
            $(document).ready(function() {
                $("#search_btn").click(function() {
                        if($("#q").val()==''){
                            var act = "<?php echo $this->config->item('ADMIN_ROOT'); ?>/main_slide/lists/page/1";
                        }else{
                            var act = "<?php echo $this->config->item('ADMIN_ROOT'); ?>/main_slide/lists/q/" + $("#q").val() + "/page/1";    
                        }                        
                        $("#bd_search").attr('action', act).submit();
                    //}
                });
            });
 
            function board_search_enter(form) {
                var keycode = window.event.keyCode;
                if (keycode == 13)
                    $("#search_btn").click();
            }
            function modify(url){
                location.href=url;
            }
       </script>
       <style type="text/css">
       .thumbnail img {
  
        padding-right:20px;
        }

.textRight {
  
text-align : right;
}
.media-heading{
    padding-top:10px;
}


/* Added some padding to make it more readable */




       </style>
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
                                        <h1>메인 슬라이드 관리</h1>
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
                                                <!-- BEGIN SAMPLE TABLE PORTLET-->
                                                <div class="portlet box green">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <i class="fa fa-desktop"></i>메인 슬라이드  관리 </div>
                                                    </div>
                                                    <div class="portlet-body">
                                                        <!--  start search group -->
                                                        <form id="bd_search" method="post">
                                                        <div class="form-group">
                                                            <div class="input-group input-group">
                                                                <input type="text" name = "search_word" id="q" class="form-control input-lg" id="q" onkeypress="board_search_enter(document.q);" placeholder="Search for...">
                                                                <span class="input-group-btn">
                                                                    <button class="btn green btn-lg" type="button" id="search_btn">Go!</button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        </from>
                                                        <!-- input-group -->
                                                        <div class="row">
                                                            <?php
                                                                foreach($list as $lt){
                                                            ?>
                                                          <div class="col-xs-12 col-md-12">
                                                            <div class="thumbnail clearfix">
                                                                <a href="<?php echo $this->config->item('ADMIN_ROOT'); ?>/main_slide/modify/<?php echo $lt -> idx; ?>" class="pull-left">
                                                                    <img src="<?php echo $this->config->item('UPLOAD_DIR'); ?>/<?php echo $lt -> pc_img; ?>" width="400" height="300" class="media-object">
                                                                </a>
                                                                <div class="media-body">
                                                                  <h1 class="media-heading"><a href="<?php echo $this->config->item('ADMIN_ROOT'); ?>/main_slide/modify/<?php echo $lt -> idx; ?>"><?php echo $lt -> title; ?></a></h1>
                                                                    <h4><?php echo $lt -> sub_title; ?></h4>
                                                                    <?php if($lt -> status =='Y') echo "<span class='btn btn-md btn-success'> 게시 </span>"; ?>
                                                                    <?php if($lt -> status =='N') echo "<span class='btn btn-md btn-default'> 대기 </span>"; ?>
                                                                    
                                                                </div>
                                                            </div>

                                                          </div>

                                                          <?php
                                                            }
                                                          ?>
                                                        
                                                        <!--end pagination-->
                                                    </div>
                                                     <div align="center">
                                                        <?php echo $my_pagination;?>
                                                     </div>

                                                     <!--  start write button -->
                                                        <div align="right" class="form-actions noborder">
                                                            <a href="<?php echo $this->config->item('ADMIN_ROOT'); ?>/main_slide/write/page/<?php echo $this -> uri -> segment(5); ?>">
                                                            <button type="button" class="btn btn-primary">신규</button>
                                                            </a>
                                                        </div>
                                                        <!-- end  write button-->
                                                </div>
                                                <!-- END SAMPLE TABLE PORTLET-->
                                            </div>
                                            
                                        </div>
                                    </div>
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
        </div>
        <?php $this->load->view('admin/include/footer_inc'); ?>
        
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
    </body>
</html>