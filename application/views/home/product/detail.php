<!DOCTYPE html>
<html lang="ko">
<head>
    <link rel="canonical" href="<?= base_url();?>home/product/detail?idx=<?= $idx ?>&menu_code=<?= $menu_code ?>&menu_up_code=<?= $menu_up_code ?>&depth_1=<?= $depth_1 ?>&depth_2=<?= $depth_2 ?>&depth_3=<?= $depth_3 ?>" />
    <meta charset="UTF-8" />
    <meta name="Referrer" content="origin" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> 
    <?php $this->load->view('home/inc/meta'); ?>
    <meta name="format-detection" content="telephone=no" />
    <meta name="description" content="<?= $sub_title ?>" />
    <meta name="author" content="<?=$this->config->item('COMPANY_NAME')?>" />
    <meta name="keywords" content="<?=$this->config->item('META_KEYWORDS')?>" /> 

    <!-- OG Tag -->
    <meta property="fb:app_id" content="<?= $this->config->item('FB_APP_ID')?>" />
    <meta property="og:title" content="<?= $title ?> | (주)세인테크" />
    <meta property="og:site_name" content="@(주)세인테크" />    
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?= base_url();?>home/product/detail?idx=<?= $idx ?>&menu_code=<?= $menu_code ?>&menu_up_code=<?= $menu_up_code ?>&depth_1=<?= $depth_1 ?>&depth_2=<?= $depth_2 ?>&depth_3=<?= $depth_3 ?>">
    <meta property="og:image" content="<?= base_url();?><?= $path ?>/<?= $thumb_img ?>" />
    <meta property="og:description" content="<?= $sub_title ?>" />

    <!-- Tw -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="<?= $title ?> | (주)세인테크" />
    <meta name="twitter:description" content="<?= $sub_title ?>" />
    <meta name="twitter:image" content="<?= base_url();?><?= $path ?>/<?= $thumb_img ?>" />
    <meta name="twitter:url" content="<?= base_url();?>home/product/detail?idx=<?= $idx ?>&menu_code=<?= $menu_code ?>&menu_up_code=<?= $menu_up_code ?>&depth_1=<?= $depth_1 ?>&depth_2=<?= $depth_2 ?>&depth_3=<?= $depth_3 ?>" />
    <meta name="twitter:site" content="@(주)세인테크" />    
    <meta name="twitter:creator" content="@(주)세인테크" />     

    <title><?= $title ?> | (주)세인테크</title>

    <script>
        var mCode = '<?php echo $menu_code?>';
        var mUpCode = '<?php echo $menu_up_code?>';
        var pDepth_1 = '<?php echo $depth_1?>';
        var pDepth_2 = '<?php echo $depth_2?>';
        var pDepth_3 = '<?php echo $depth_3?>';
        var pOffset = '<?php echo $offset ?>';
        var pSearchWord = '<?php echo $search_word ?>';
        var pSearchFlag = '<?php echo $search_flag ?>';
        var pageType = 'detail';
    </script>
    <link rel="stylesheet" href="<?=$this->config->item('INCLUDE_HOME_DIR')?>/css/page-sub.css">
    <link rel="stylesheet" href="<?=$this->config->item('INCLUDE_HOME_DIR')?>/css/product.css">
    <script src="<?=$this->config->item('home_assets_url')?>/common/vendor/jquery/jquery-3.1.1.min.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/base.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/layout.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/floating.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/sub.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/product_sub.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/product.js"></script>

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

    <script type="application/ld+json">
    {
      "@context": "https://schema.org/",
      "@type": "Product",
      "name": "<?= $title ?>",
      "image": [
        "<?= base_url();?><?= $path ?>/<?= $thumb_img ?>"
       ],
      "description": "<?= $sub_title ?>",
      "brand": {
        "@type": "Brand",
        "name": "<?= $model_name ?>"
      },
      "offers": {
        "@type": "Offer",
        "url": "<?= base_url();?>home/product/detail?idx=<?= $idx ?>&menu_code=<?= $menu_code ?>&menu_up_code=<?= $menu_up_code ?>&depth_1=<?= $depth_1 ?>&depth_2=<?= $depth_2 ?>&depth_3=<?= $depth_3 ?>",
        "availability": "https://schema.org/InStock",
        "seller": {
          "@type": "Organization",
          "name": "(주)세인테크"
        }
      }
    }
    </script>
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
                    <div class="trail-box hide">
                        <div id="list_trail" class="section-1024 clearfix">
                            <div id="trail_home">
                                <a href="<?= base_url(); ?>"></a>
                            </div>
                            <div id="trail_depth_def" class="trail-item">
                                <span data-name="제품소개">제품소개</span>
                            </div>
                            <div id="trail_depth1" class="trail-item toggle-item">
                                <span id="trail_depth1_txt" data-name=""></span>
                                <ul id="trail_item_depth1" class="trail-item-depth trail-item-depth1">
                                    <li data-name="계측장비">계측장비</li>
                                    <li data-name="스트레인게이지">스트레인게이지</li>
                                    <li data-name="계측센서">계측센서</li>
                                    <li data-name="비디오게이지">비디오게이지</li>
                                    <li data-name="시험용치구">시험용치구</li>
                                    <li data-name="제작품">제작품</li>
                                </ul>
                            </div>
                            <div id="trail_depth2" class="trail-item hide toggle-item">
                                <span id="trail_depth2_txt"></span>
                                <ul id="trail_item_depth2" class="trail-item-depth trail-item-depth2"></ul>
                            </div>
                            <div id="trail_depth3" class="trail-item hide toggle-item">
                                <span id="trail_depth3_txt"></span>
                                <ul id="trail_item_depth3" class="trail-item-depth trail-item-depth3"></ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="detail_product" class="section-1024 clearfix">
                <ul class="img-area">
                </ul>
                <div class="view-detail">
                    <div class="title">
                        <h2></h2>
                    </div>
                    <table class="info">
                        <tbody></tbody>
                    </table>
                    <div class="file-wrap clearfix">
                        <div class="file-title"><span>첨부파일 : </span></div>
                        <ul id="file_list"></ul>
                    </div>
                    <div id="editorContents" class="service-contents"></div>
                </div>
            </div>
            <div id="go_list_box" class="section-1024">
                <?php
                    if($search_flag == 't'){
                        // 검색 리턴
                ?>
                   <a href="<?= base_url(); ?>home/product?menu_code=product&menu_up_code=&depth_1=<?= $depth_1 ?>&depth_2=<?= $depth_2 ?>&depth_3=<?= $depth_3 ?>&offset=<?= $offset ?>&search_word=<?= $search_word ?>&search_flag=<?= $search_flag ?>" id="go_list">목록</a>
                <?php
                    }else{
                        // 일반 리스트 리턴
                ?>
                    <a href="<?= base_url(); ?>home/product?menu_code=product&menu_up_code=&depth_1=<?= $depth_1 ?>&depth_2=<?= $depth_2 ?>&depth_3=<?= $depth_3 ?>&offset=<?= $offset ?>" id="go_list">목록</a>
                <?php
                    }
                ?>
            </div>
        </div><!-- //container -->
        <!-- FOOTER -->
        <?php $this->load->view('home/inc/footer'); ?>
        <!-- //FOOTER -->
    </div>
</body>
</html>