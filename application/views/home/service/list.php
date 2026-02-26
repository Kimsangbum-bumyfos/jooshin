<!DOCTYPE html>
<html lang="ko">
<head>
    <link rel="canonical" href="<?= base_url();?>home/service?menu_code=<?= $menu_code ?>&menu_up_code=<?= $menu_up_code ?>" />
    <meta charset="UTF-8" />
    <meta name="Referrer" content="origin" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> 
    <?php $this->load->view('home/inc/meta'); ?>
    <meta name="format-detection" content="telephone=no" />
    <meta name="description" content="고객을 위한 최고의 서비스와 기술력으로 최고의 가치를 창조해가겠습니다." />
    <meta name="author" content="<?=$this->config->item('COMPANY_NAME')?>" />
    <meta name="keywords" content="<?=$this->config->item('META_KEYWORDS')?>" /> 

    <!-- OG Tag -->
    <meta property="fb:app_id" content="<?= $this->config->item('FB_APP_ID')?>" />
    <meta property="og:title" content="시험 및 용역 | (주)세인테크" />
    <meta property="og:site_name" content="@(주)세인테크" />    
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?= base_url();?>home/service?menu_code=<?= $menu_code ?>&menu_up_code=<?= $menu_up_code ?>">
    <meta property="og:image" content="<?= base_url();?>uploads/thumb/logo.png" />
    <meta property="og:description" content="고객을 위한 최고의 서비스와 기술력으로 최고의 가치를 창조해가겠습니다." />

    <!-- Tw -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="시험 및 용역 | (주)세인테크" />
    <meta name="twitter:description" content="고객을 위한 최고의 서비스와 기술력으로 최고의 가치를 창조해가겠습니다." />
    <meta name="twitter:image" content="<?= base_url();?>uploads/thumb/logo.png" />
    <meta name="twitter:url" content="<?= base_url();?>home/service?menu_code=<?= $menu_code ?>&menu_up_code=<?= $menu_up_code ?>" />  
    <meta name="twitter:site" content="@(주)세인테크" />    
    <meta name="twitter:creator" content="@(주)세인테크" />     

    <title>시험 및 용역 | (주)세인테크</title>

    <script>
        var mCode = '<?php echo $menu_code?>';
        var mUpCode = '<?php echo $menu_up_code?>';
        var sCategory = '<?php echo $category?>';
        var sOffset = '<?php echo $offset ?>';
        var list_base_url = '<?= base_url(); ?>home/service?menu_code='+mCode+'&menu_up_code='+mUpCode+'';
    </script>

    <link rel="stylesheet" href="<?=$this->config->item('INCLUDE_HOME_DIR')?>/css/page-sub.css">
    <link rel="stylesheet" href="<?=$this->config->item('INCLUDE_HOME_DIR')?>/css/service.css">
    <script src="<?=$this->config->item('home_assets_url')?>/common/vendor/jquery/jquery-3.1.1.min.js"></script>
    <!-- common_head -->
    <?php $this->load->view('home/inc/common_head'); ?>
    <!-- // common_head -->

    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/base.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/layout.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/sub.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/service.js"></script>

    <!-- 웨이포인트 효과 -->
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/waypoints.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/vendor/waypoint/jquery.waypoints.min.js"></script>
</head>
<body>
    <!-- 스킵 내비게이션 -->
    <div id="skip">
        <a rel="bookmark" href="#skip_menu">전체 메뉴 바로가기</a>
        <a rel="bookmark" href="#skip_container">컨텐츠 영역 바로가기</a>
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
                            <span>ALL</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="service-wrap" class="section-1024">
                <div class="service-container">
                    <ul id="sc_category" class="clearfix">
                        <li data-category=""  class="<?= $category == '' ? 'active' : '' ?>"><span>전체</span></li>
                        <li data-category="1" class="<?= $category == '1' ? 'active' : '' ?>"><span>토목/건축/구조물 시험</span></li>
                        <li data-category="2" class="<?= $category == '2' ? 'active' : '' ?>"><span>항공/기계/자동차 시험</span></li>
                        <li data-category="3" class="<?= $category == '3' ? 'active' : '' ?>"><span>재료 부품 시험</span></li>
                        <li data-category="4" class="<?= $category == '4' ? 'active' : '' ?>"><span>비디오 게이지 활용 시험</span></li>
                        <li data-category="5" class="<?= $category == '5' ? 'active' : '' ?>"><span>기타 시험</span></li>
                    </ul>
                    <div id="list_service" class="clearfix"></div>
                    <div id="paging"></div>
                </div>
            </div>
        </div><!-- //container -->
        <!-- FOOTER -->
        <?php $this->load->view('home/inc/footer'); ?>
        <!-- //FOOTER -->
    </div>
</body>
</html>