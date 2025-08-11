<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="ko">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title><?php echo $this->config->item('HOMEPAGE_TITLE'); ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <meta content="<?php echo $this->config->item('META_DATA'); ?>" name="description" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo $this->config->item('INCLUDE_DIR2'); ?>/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="<?php echo $this->config->item('INCLUDE_DIR2'); ?>/pages/css/error.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class=" page-404-full-page">
        <div class="row">
            <div class="col-md-12 page-404">
                <div class="number font-red"> 404 </div>
                <div class="details">
                    <h3>Oops! 페이지를 찾을 수 없습니다.</h3>
                    <p> <h3>일시적인 오류이거나 페이지 주소가 잘못 입력되었습니다.</h3>
                        <br/>
                        <h3><strong><a href="<?php echo $this->config->item('ADMIN_ROOT'); ?>/contents"> 홈으로가기 > </a></strong></p></h3>

                </div>
            </div>
        </div>
    
    </body>

</html>