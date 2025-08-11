<!DOCTYPE html>
<html lang="ko">
<head>
    <link rel="canonical" href="<?= base_url();?>home/support/notice?idx=<?= $idx ?>&menu_code=<?= $menu_code ?>&menu_up_code=<?= $menu_up_code ?>" />
    <meta charset="UTF-8" />
    <meta name="Referrer" content="origin" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> 
    <?php $this->load->view('home/inc/meta'); ?>
    <meta name="format-detection" content="telephone=no" />
    <meta name="description" content="<?php echo $sub_title ?>" />
    <meta name="author" content="<?=$this->config->item('COMPANY_NAME')?>" />
    <meta name="keywords" content="<?=$this->config->item('META_KEYWORDS')?>" /> 

    <!-- OG Tag -->
    <meta property="fb:app_id" content="<?= $this->config->item('FB_APP_ID')?>" />
    <meta property="og:title" content="<?php echo $title?> | 메이크홈" />
    <meta property="og:site_name" content="@메이크홈" />    
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?= base_url();?>home/support/notice?idx=<?= $idx ?>&menu_code=<?= $menu_code ?>&menu_up_code=<?= $menu_up_code ?>">
    <meta property="og:image" content="<?= base_url();?>uploads/thumb/th-t190315.png" />
    <meta property="og:description" content="<?php echo $sub_title ?>" />

    <!-- Tw -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="<?php echo $title?> | 메이크홈" />
    <meta name="twitter:description" content="<?php echo $sub_title ?>" />
    <meta name="twitter:image" content="<?= base_url();?>uploads/thumb/th-t190315.png" />
    <meta name="twitter:url" content="<?= base_url();?>home/support/notice?idx=<?= $idx ?>&menu_code=<?= $menu_code ?>&menu_up_code=<?= $menu_up_code ?>" />  
    <meta name="twitter:site" content="@메이크홈" />    
    <meta name="twitter:creator" content="@메이크홈" />     

    <title><?php echo $title?> | 메이크홈</title>

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
        <a rel="bookmark" href="#editorContents">게시글 영역 바로가기</a>
        <a rel="bookmark" href="#noti_prev">이전글 바로가기</a>
        <a rel="bookmark" href="#noti_next">다음글 영역 바로가기</a>
        <a rel="bookmark" href="#skip_return_notice">게시글 목록 영역 바로가기</a>
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
            <div class="section section-notice-read">
                <div class="b-section-body" id="noti_read">
                    <div class="b-board-read">
                        <legend class="hidden">글읽기</legend>
                        <table class="b-table b-table-typeD">
                            <tbody>
                                <tr>
                                    <td class="b-table-typeD-title">
                                        <div class="b-row b-notice">
                                            <span id="noti_title"></span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="b-row b-notice b-notice-sub">
                                            <span id="noti_date"></span>
                                            <span class="b-read-title-count">조회수 : <i id="noti_cnt"></i></span>
                                        </div>
                                    </td>
                                </tr>
                                <th>
                                    <div class="b-read-content">
                                        <!-- 내용 -->
                                        <div id="editorContents"></div>
                                    </div>
                                </th>
                            </tbody>
                        </table>
                        <div class="b-read-page">
                            <p><i class="b-read-ico b-ico-read-up"></i><span class="b-read-page-txt1">이전글</span><a href="#none" class="b-read-page-txt2" id="noti_prev"></a></p>
                        </div>
                        <div class="b-read-page b-read-next ">
                            <p><i class="b-read-ico b-ico-read-down"></i><span class="b-read-page-txt1">다음글</span><a href="#none" class="b-read-page-txt2" id="noti_next"></a></p>
                        </div>
                    </div>
                </div><!-- //b-section-body -->
            </div>

            <div class="section-t dp-ib">
                <div class="list-btn-area">
                     <button type="button" id="skip_return_notice" class="btn-list-more board-list" onclick="location.href='<?=base_url()?>home/support/notice?menu_code=<?=$menu_code?>&menu_up_code=<?=$menu_up_code?>'"><span>목록</span></button>
                </div>
            </div>
        </div><!-- //container -->
        <!-- FOOTER -->
        <?php $this->load->view('home/inc/footer'); ?>
        <!-- //FOOTER -->
	</div>
</body>
</html>