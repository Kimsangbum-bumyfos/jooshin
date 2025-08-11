<!DOCTYPE html>
<html lang="ko">
<head>
    <link rel="canonical" href="<?= base_url();?>home/search" />
    <meta charset="UTF-8" />
    <meta name="Referrer" content="origin" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> 
    <?php $this->load->view('home/inc/meta'); ?>
    <meta name="format-detection" content="telephone=no" />
    <meta name="description" content="--subtitle" />
    <meta name="author" content="<?=$this->config->item('COMPANY_NAME')?>" />
    <meta name="keywords" content="<?=$this->config->item('META_KEYWORDS')?>" /> 

    <!-- OG Tag -->
    <meta property="fb:app_id" content="<?= $this->config->item('FB_APP_ID')?>" />
    <meta property="og:title" content="" />
    <meta property="og:site_name" content="@" />    
    <meta property="og:type" content="website" />
    <meta property="og:url" content="">
    <meta property="og:image" content="" />
    <meta property="og:description" content="" />

    <!-- Tw -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="" />
    <meta name="twitter:description" content="" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:url" content="<?= base_url();?>home/search" />  
    <meta name="twitter:site" content="@" />    
    <meta name="twitter:creator" content="@" />     

    <title>검색 | (주)주신산업</title>

    <link rel="stylesheet" href="<?=$this->config->item('INCLUDE_HOME_DIR')?>/css/page-sub.css">
    <link rel="stylesheet" href="<?=$this->config->item('INCLUDE_HOME_DIR')?>/css/search.css">
<!--     <script>
        var mCode = 'search_page';
        var mUpCode = '';
    </script> -->


    <script src="<?=$this->config->item('home_assets_url')?>/common/vendor/jquery/jquery-3.1.1.min.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/base.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/layout.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/floating.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/sub.js"></script>

    <!-- 고객센터 -->
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
                    <h2>검색</h2>
                    <p>찾으시려는 검색어를 입력하세요.</p>
                </div>
                <div class="section-bg-img">
                    <div class="section-bg-pc" style='background-image:url("<?=$this->config->item('INCLUDE_HOME_DIR')?>/img/dummy/th-menu05.png");'></div>
                    <div class="section-bg-m" style='background-image:url("<?=$this->config->item('INCLUDE_HOME_DIR')?>/img/dummy/th-menu05.png");'></div>
                </div>
            </div>
            <div id="wrap_search" class="section-1024">
                <div id="list_txt">
                    <h3>'<strong></strong>'으로 검색된 결과입니다.</h3>
                    <p>총 <span id="search_list_cnt"></span>건</p>
                </div>
                <div id="list_result" class="clearfix"></div>
                <div id="list_no_result" class="hide">
                    <h3>'<span id="search_val_no"></span>'에 대한 검색결과가 없습니다.</h3>
                    <p>단어의 철자가 정확한지 확인해보세요.</p>
                    <p>더 일반적인 검색어를 사용해 보세요.</p>
                    <p>다른 검색어를 사용해보세요.</p>
                </div>
                <div class="js-list-more section-1024">
                    <button type="button" id="btn_gnb_more">더보기</button>
                </div>
            </div>
        </div><!-- //container -->
        <!-- FOOTER -->
        <?php $this->load->view('home/inc/footer'); ?>
        <!-- //FOOTER -->
    </div>
</body>
</html>