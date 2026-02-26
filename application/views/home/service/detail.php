<!DOCTYPE html>
<html lang="ko">
<head>
    <link rel="canonical" href="<?= base_url();?>home/service/detail?idx=<?= $idx ?>&menu_code=<?= $menu_code ?>&menu_up_code=<?= $menu_up_code ?>" />
    <meta charset="UTF-8" />
    <meta name="Referrer" content="origin" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> 
    <?php $this->load->view('home/inc/meta'); ?>
    <meta name="format-detection" content="telephone=no" />
    <meta name="description" content="<?= $buyer ?>" />
    <meta name="author" content="<?=$this->config->item('COMPANY_NAME')?>" />
    <meta name="keywords" content="<?=$this->config->item('META_KEYWORDS')?>" /> 

    <!-- OG Tag -->
    <meta property="fb:app_id" content="<?= $this->config->item('FB_APP_ID')?>" />
    <meta property="og:title" content="<?= $title ?> | (주)세인테크" />
    <meta property="og:site_name" content="@(주)세인테크" />    
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?= base_url();?>home/service/detail?idx=<?= $idx ?>&menu_code=<?= $menu_code ?>&menu_up_code=<?= $menu_up_code ?>">
    <meta property="og:image" content="<?= base_url();?><?= $path ?>/<?= $thumb_img ?>" />
    <meta property="og:description" content="<?= $buyer ?>" />

    <!-- Tw -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="<?= $title ?> | 세인테크" />
    <meta name="twitter:description" content="<?= $buyer ?>" />
    <meta name="twitter:image" content="<?= base_url();?><?= $path ?>/<?= $thumb_img ?>" />
    <meta name="twitter:url" content="<?= base_url();?>home/service/detail?idx=<?= $idx ?>&menu_code=<?= $menu_code ?>&menu_up_code=<?= $menu_up_code ?>" />  
    <meta name="twitter:site" content="@(주)세인테크" />    
    <meta name="twitter:creator" content="@(주)세인테크" />     

    <title><?= $title ?> | 세인테크</title>

    <script>
        var mCode = '<?php echo $menu_code?>';
        var mUpCode = '<?php echo $menu_up_code?>';
        var sCategory = '<?php echo $category?>';
        var sOffset = '<?php echo $offset ?>';
    </script>
    <link rel="stylesheet" href="<?=$this->config->item('INCLUDE_HOME_DIR')?>/css/page-sub.css">
    <link rel="stylesheet" href="<?=$this->config->item('INCLUDE_HOME_DIR')?>/css/service.css">
    <script src="<?=$this->config->item('home_assets_url')?>/common/vendor/jquery/jquery-3.1.1.min.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/base.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/layout.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/floating.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/sub.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/service.js"></script>

    <!-- 고객센터 -->
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/cscenter/js/cs-handle.js"></script>

    <!-- 공용 라이브러리 -->
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/vendor/slick/slick.js"></script>

    <!-- 웨이포인트 효과 -->
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/waypoints.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/vendor/waypoint/jquery.waypoints.min.js"></script>

    <!-- common_head -->
    <?php $this->load->view('home/inc/common_head'); ?>
    <!-- // common_head -->
</head>
<body>
    <!-- 스킵 내비게이션 -->
    <div id="skip">
        <a rel="bookmark" href="#skip_menu">전체 메뉴 바로가기</a>
        <a rel="bookmark" href="#skip_container">컨텐츠 영역 바로가기</a>
        <a rel="bookmark" href="#detail_service">상세보기 영역 바로가기</a>
    </div>
    <!-- //스킵 내비게이션 -->
    <div class="wrap">
        <!-- header -->
        <?php $this->load->view('home/inc/header'); ?>
        <!-- //header -->
        <!-- container -->
        <div id="skip_container" class="container">
            <div class="section-t section-bg">
                <div class="section-bg-text">
                    <h2></h2>
                    <p></p>
                </div>
                <div class="section-bg-img">
                    <div class="section-bg-pc"></div>
                    <div class="section-bg-m"></div>
                </div>
            </div>
            <div id="detail_service" class="section-1024 clearfix">
                <ul class="img-area">
                </ul>
                <div class="view-detail">
                    <div class="title">
                        <h2></h2>
                    </div>
                    <ul class="info">
                    </ul>
                    <div id="editorContents" class="service-contents"></div>
                </div>
            </div>
            <div id="go_list_box" class="section-1024">
                <a href="<?= base_url(); ?>home/service?menu_code=service&menu_up_code=&category=<?= $category ?>&offset=<?= $offset ?>" id="go_list">목록</a>
            </div>
        </div><!-- //container -->
        <!-- FOOTER -->
        <?php $this->load->view('home/inc/footer'); ?>
        <!-- //FOOTER -->
    </div>
</body>
</html>