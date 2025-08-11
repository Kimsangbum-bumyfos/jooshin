<!DOCTYPE html>
<html lang="ko">
<head>
    <link rel="canonical" href="<?= base_url();?>home/support/event?menu_code=<?= $menu_code ?>&menu_up_code=<?= $menu_up_code ?>" />
    <meta charset="UTF-8" />
    <meta name="Referrer" content="origin" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> 
    <?php $this->load->view('home/inc/meta'); ?>
    <meta name="format-detection" content="telephone=no" />
    <meta name="description" content="<?=$this->config->item('META_DESC')?>" />
    <meta name="author" content="<?=$this->config->item('COMPANY_NAME')?>" />
    <meta name="keywords" content="<?=$this->config->item('META_KEYWORDS')?>" /> 

    <!-- OG Tag -->
    <meta property="fb:app_id" content="<?= $this->config->item('FB_APP_ID')?>" />
    <meta property="og:title" content="<?=$this->config->item('HOMEPAGE_TITLE')?>" />
    <meta property="og:site_name" content="@메이크홈" />    
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?= base_url();?>home/support/event?menu_code=<?= $menu_code ?>&menu_up_code=<?= $menu_up_code ?>">
    <meta property="og:image" content="<?= base_url();?>uploads/thumb/th-t190315.png" />
    <meta property="og:description" content="<?=$this->config->item('META_DESC')?>" />

    <!-- Tw -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="<?=$this->config->item('HOMEPAGE_TITLE')?>" />
    <meta name="twitter:description" content="<?=$this->config->item('META_DESC')?>" />
    <meta name="twitter:image" content="<?= base_url();?>uploads/thumb/th-t190315.png" />
    <meta name="twitter:url" content="<?= base_url();?>home/support/event?menu_code=<?= $menu_code ?>&menu_up_code=<?= $menu_up_code ?>" />  
    <meta name="twitter:site" content="@메이크홈" />    
    <meta name="twitter:creator" content="@메이크홈" />   

    <title><?=$this->config->item('HOMEPAGE_TITLE')?></title>
    <script>
        var mCode = '<?php echo $menu_code?>';
        var mUpCode = '<?php echo $menu_up_code?>';
    </script>

    <link rel="stylesheet" href="<?=$this->config->item('INCLUDE_HOME_DIR')?>/css/page-sub.css">
    <link rel="stylesheet" href="<?=$this->config->item('INCLUDE_HOME_DIR')?>/css/board.css">

    <script src="<?=$this->config->item('home_assets_url')?>/common/vendor/jquery/jquery-3.1.1.min.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/base.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/layout.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/sub.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/board.js"></script>

    <!-- 고객센터 -->
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/floating.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/cscenter/js/cs-handle.js"></script>

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
        <a rel="bookmark" href="#search-noti">검색 영역 바로가기</a>
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
            <div class="section-t section-category section-category-post">
                <div class="category-group category wp-box" data-animate-effect="fadeInUp">
                    <ul>
                        <li class="category-all" onclick="">
                            <span>전체</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="section-t section-notice clearfix">
                 <!-- 검색영역  -->
                <div class="b-search-area">
                    <div class="sub-search-box">
                        <label for="search-event">
                            <input type="text" id="search-event" class="b-search" placeholder="키워드를 검색하세요.">
                            <span id="btn-event-search" class="ico-b-search"></span>
                        </label>
                    </div>
                </div>
                <!-- // 검색영역  -->
                <!-- 이벤트 리스트  -->
                <div id="section_event">
                    <div class="sc-event-list clearfix">
                        
                    </div>
                </div>
                <!-- // 이벤트 리스트  -->
                <!-- 더보기 -->
                <div class="section-t">
                    <div class="list-btn-area wp-box fadeInUp animated-fast">
                        <button type="button" id="more_eventList" class="btn-list-more sub-more-btn"><span>더보기</span></button>
                    </div>
                </div>
                <!-- // 더보기 -->
            </div>
        </div><!-- //container -->
        <!-- FOOTER -->
        <?php $this->load->view('home/inc/footer'); ?>
        <!-- //FOOTER -->
	</div>
</body>
</html>