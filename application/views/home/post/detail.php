<!DOCTYPE html>
<html lang="ko">
<head>
    <link rel="canonical" href="<?= base_url();?>home/post/detail?idx=<?= $idx ?>&menu_code=<?= $menu_code ?>&menu_up_code=<?= $menu_up_code ?>" />
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
    <meta property="og:title" content="<?= $title ?> | 메이크홈" />
    <meta property="og:site_name" content="@메이크홈" />    
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?= base_url();?>home/post/detail?idx=<?= $idx ?>&menu_code=<?= $menu_code ?>&menu_up_code=<?= $menu_up_code ?>">
    <meta property="og:image" content="<?= base_url();?><?= $path ?>/<?= $thumb_img ?>" />
    <meta property="og:description" content="<?= $sub_title ?>" />

    <!-- Tw -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="<?= $title ?> | 메이크홈" />
    <meta name="twitter:description" content="<?= $sub_title ?>" />
    <meta name="twitter:image" content="<?= base_url();?><?= $path ?>/<?= $thumb_img ?>" />
    <meta name="twitter:url" content="<?= base_url();?>home/post/detail?idx=<?= $idx ?>&menu_code=<?= $menu_code ?>&menu_up_code=<?= $menu_up_code ?>" />  
    <meta name="twitter:site" content="@메이크홈" />    
    <meta name="twitter:creator" content="@메이크홈" />     

    <title><?= $title ?> | 메이크홈</title>

    <script>
        var mCode = '<?php echo $menu_code?>';
        var mUpCode = '<?php echo $menu_up_code?>';
    </script>
    <link rel="stylesheet" href="<?=$this->config->item('INCLUDE_HOME_DIR')?>/css/page-sub.css">
    <script src="<?=$this->config->item('home_assets_url')?>/common/vendor/jquery/jquery-3.1.1.min.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/base.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/layout.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/floating.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/sub.js"></script>

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
        <a rel="bookmark" href="#skipt_detail_A">상세보기 영역 바로가기</a>
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
            <div id="skipt_detail_A" class="section-t section-detail-B">
                <div class="detail-group-B clearfix">
                    <!-- 뒤로가기 -->
                    <div class="detail-close-area">
                        <span class="ico-cancel-black detail-close" onclick="location.href='<?=base_url()?>home/dummy/listB'" title="뒤로가기" aria-label="뒤로가기"></span>
                    </div>
                    <!-- // 뒤로가기-->

                    <!-- 글 제목 -->
                    <div class="detail-B-title">
                        <h3></h3>
                        <!-- 
                        <div class="detail-B-info">
                            <span>등록일 : </span>
                            <span class="detail-B-date"></span>
                            <span>조회수 : </span>
                            <span class="detail-B-view-cnt"></span>
                        </div> 
                        -->
                    </div>
                    <!-- // 글 제목 -->
                    <!-- 글 내용 -->
                    <div id="editorContents" class="detail-B-contents">
                        <!-- Ajax -->
                    </div>
                    <!-- //  글 내용 -->

                    <!-- 공유 영역  -->
                    <div class="detail-share-area">
                        <ul>
                            <li>
                                <a href="#none" class="btn-share fb text-hidden" data-toggle="sns_share" data-service="facebook" data-title="페이스북 SNS공유" title="페이스북 SNS공유">페이스북</a>
                            </li>
                            <li>
                                <a href="#none" class="btn-share kas text-hidden" data-toggle="sns_share" data-service="kakaostory" data-title="카카오스토리 SNS공유" title="카카오스토리 SNS공유">카카오스토리</a>
                            </li>
                            <li>
                                <a href="#none" class="btn-share url text-hidden" title="링크 복사하기">링크</a>
                                <textarea id="url" class="text-hidden url-clipboard" rows="0" cols="0"></textarea>
                            </li>
                            <!-- <li>
                                <input type="hidden" id="token" value="<?=$this->security->get_csrf_hash()?>">
                                <input type="checkbox" id="temp_heart" class="temp-checkbox temp-info-checkbox">
                                <label for="temp_heart" class="target-like btn-share likes" data-temp-code="" title="게시물 좋아요">
                                    <span></span>
                                </label>
                                <span class="badge">0</span> 
                            </li> -->
                        </ul>
                    </div>
                    <!-- // 공유 영역  -->

                    <!-- 뒤로가기-->
                    <div class="detail-close-area">
                        <span class="ico-cancel-black detail-close" onclick="location.href='<?=base_url()?>home/dummy/listB'" title="뒤로가기" aria-label="뒤로가기"></span>
                    </div>
                    <!-- // 뒤로가기-->
                </div>
            </div>
        </div><!-- //container -->
        <!-- FOOTER -->
        <?php $this->load->view('home/inc/footer'); ?>
        <!-- //FOOTER -->
    </div>
</body>
</html>