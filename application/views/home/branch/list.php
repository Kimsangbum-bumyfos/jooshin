<!DOCTYPE html>
<html lang="ko">
<head>
     <link rel="canonical" href="<?= base_url();?>home/branch?menu_code=<?= $menu_code ?>&menu_up_code=<?= $menu_up_code ?>" />
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
    <meta property="og:url" content="<?= base_url();?>home/branch?menu_code=<?= $menu_code ?>&menu_up_code=<?= $menu_up_code ?>">
    <meta property="og:image" content="<?= base_url();?>uploads/thumb/th-t190315.png" />
    <meta property="og:description" content="<?=$this->config->item('META_DESC')?>" />

    <!-- Tw -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="<?=$this->config->item('HOMEPAGE_TITLE')?>" />
    <meta name="twitter:description" content="<?=$this->config->item('META_DESC')?>" />
    <meta name="twitter:image" content="<?= base_url();?>uploads/thumb/th-t190315.png" />
    <meta name="twitter:url" content="<?= base_url();?>home/branch?menu_code=<?= $menu_code ?>&menu_up_code=<?= $menu_up_code ?>" />  
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
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/map.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/board.js"></script>

    <!-- 고객센터 -->
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/floating.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/cscenter/js/cs-handle.js"></script>

    <!-- 웨이포인트 효과 -->
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/waypoints.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/vendor/waypoint/jquery.waypoints.min.js"></script>

    <!-- 구글맵 map api key = 2019/08/28 만료  -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCy5oQHGB6oLkS4pOk1cvbUu2oeseb5_gQ"></script>

    <!-- common_head -->
    <?php $this->load->view('home/inc/common_head'); ?>
    <!-- // common_head -->
</head>
<body>
    <!-- 스킵 내비게이션 -->
    <div id="skip">
        <a rel="bookmark" href="#skip_menu">전체 메뉴 바로가기</a>
        <a rel="bookmark" href="#skip_container">컨텐츠 영역 바로가기</a>
        <a rel="bookmark" href="#search-branch">검색 영역 바로가기</a>
        <a rel="bookmark" href="#branch_list_group">지점 리스트 영역 바로가기</a>
        <a rel="bookmark" href="#more_branchList">지점 더보기 영역 바로가기</a>
    </div>
    <!-- //스킵 내비게이션 -->
    <div class="wrap">
        <!-- header -->
        <?php $this->load->view('home/inc/header'); ?>
        <!-- //header -->
        <!-- container -->
        <div class="container">
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
            <div class="section-t section-category section-category-post board">
                <div class="category-group wp-box" data-animate-effect="fadeInUp">
                    <ul>
                        <li class="category-all" onclick="">
                            <span>전체</span>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- 검색 영역 -->
            <div class="section-t section-cs-search branch-seach clearfix">
                <div class="b-search-area">
                    <div class="sub-search-box">
                        <label for="search-branch">
                            <input type="text" id="search-branch" class="b-search" placeholder="지점을 검색하세요.">
                            <span id="btn-branch-search" class="ico-b-search"></span>
                        </label>
                    </div>
                </div>
            </div>
            <!-- // 검색 영역 -->
            <div id="section_branch" class="section-t section_branch">
                <div id="branch_list_group" class="list-group-t clearfix">
                </div>
            </div>
            <div class="section-area">
                <div class="contents">
                    <div class="list-btn-area">
                        <button type="button" id="more_branchList" class="btn-list-more sub-more-btn"><span>더보기</span></button>
                    </div>
                </div>
            </div>
            <!-- 지점안내 팝업 -->
            <div class="modal branch-modal">
                <div class="modal-dimmed" id="store-dimmed"></div>
                <div class="modal-full store-modal">
                    <div class="modal-box">
                        <div class="store-modal-wrap">
                            <div class="store-modal-header">
                                <p id="store_branch_name"  class="store-modal-header-title ellipsis"></p>
                                <span class="store-modal-header-close" id="store_modal_close"></span>
                            </div>
                            <div class="store-modal-container clearfix">
                                <div id="map-canvas" class="store-modal-map"></div>
                                <div class="store-modal-group-text">
                                    <div class="store-modal-text">
                                        <span class="modal-ico ico-modal-point-A"></span>
                                        <p id="store_addr" class="store-modal-info"></p>
                                    </div>
                                    <div class="store-modal-text">
                                        <span class="modal-ico ico-modal-point-B"></span>
                                        <p id="store_office_tel" class="store-modal-info"></p>
                                    </div>
                                    <div class="store-modal-text">
                                        <span class="modal-ico ico-modal-point-C"></span>
                                        <p id="store_business_hours" class="store-modal-info"></p>
                                    </div>
                                    <div class="store-modal-text">
                                        <span class="modal-ico ico-modal-point-D"></span>
                                        <p id="store_additional_comment" class="store-modal-info"></p>
                                    </div>
                                    <div class="store-modal-text">
                                        <span class="modal-ico ico-modal-point-E"></span>
                                        <p id="store_map_comment" class="store-modal-info"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- //지점안내 팝업 -->
        </div><!-- //container -->
        <!-- FOOTER -->
        <?php $this->load->view('home/inc/footer'); ?>
        <!-- //FOOTER -->
    </div>
</body>
</html>