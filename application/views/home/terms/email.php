<!DOCTYPE html>
<html lang="ko">
<head>
    <link rel="canonical" href="<?= base_url();?>home/terms/email" />
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
    <meta property="og:title" content="이메일 무단수집거부 | (주)주신산업" />
    <meta property="og:site_name" content="@(주)주신산업" />    
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?= base_url();?>home/terms/email">
    <meta property="og:image" content="<?= base_url();?>uploads/thumb/logo.png" />
    <meta property="og:description" content="<?=$this->config->item('META_DESC')?>" />

    <!-- Tw -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="이메일 무단수집거부 | (주)주신산업" />
    <meta name="twitter:description" content="<?=$this->config->item('META_DESC')?>" />
    <meta name="twitter:image" content="<?= base_url();?>uploads/thumb/logo.png" />
    <meta name="twitter:url" content="<?= base_url();?>home/terms/email" />  
    <meta name="twitter:site" content="@(주)주신산업" />    
    <meta name="twitter:creator" content="@(주)주신산업" />     

    <title>이메일 무단수집거부 | (주)주신산업</title>

    <link rel="stylesheet" href="<?=$this->config->item('INCLUDE_HOME_DIR')?>/css/page-sub.css">
    
    <script src="<?=$this->config->item('home_assets_url')?>/common/vendor/jquery/jquery-3.1.1.min.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/base.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/layout.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/sub.js"></script>
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
    <div class="wrap" id="email_wrap">
        <!-- header -->
        <?php $this->load->view('home/inc/header'); ?>
        <!-- //header -->
        <!-- container -->
        <div id="skip_container" class="container">
            <section class="terms">
                <h2 class="hidden">(주)주신산업 이메일 무단수집 거부</h2>
                <div class="contents-box">
                     <div class="terms-group">
                        <div class="terms-top-title">
                            <p>(주)주신산업 이메일 무단수집 거부</p>
                        </div>
                        <div class="terms-box">
                            <p>본 웹사이트에 게시된 이메일 주소가 전자우편 수집 프로그램이나 그 밖의 기술적 장치를 이용하여 무단으로 수집되는것을 거부하며, 이를 위반시 정보통신망법에 의해 형사 처벌됨을 유의하시기 바랍니다.</p>
                            <br>
                            <p>정보통신망 이용 촉진 및 정보보호에 관한 법률-(일부개정 2002. 12.18 법률 제06797호)-제50조의2 (전자우편주소의 무단 수집행위 등 금지)</p>
                            <br>
                            <p>&#10112; 누구든지 전자우편주소의 수집을 거부하는 의가사 명시된 인터넷 홈페이지에서 자동으로 전자우편주소를 수집하는 프로그램 그 밖의 기술적 장치를 이용하여 전자우편주소를 수집하여서는 아니 된다.</p>
                            <p>&#10113; 누구든지 제1항의 규정을 위반하여 수집된 전자우편주소를 판매·유통하여서는 아니된다.</p>
                            <p>&#10114; 누구든지 제1항 및 제2항의 규정에 의하여 수집·판매 및 유통이 금지된 전자우편주소임을 알고 이를 정보전송에 이용하여서는 아니된다.</p>
                            <br>
                            <p>제65조의2 (벌칙) 다음 각호의 1에 해당하는 자는 1천만원 이하의 벌금에 처한다.</p>
                            <br>
                            <p>&#10112; 제50조제4항의 규정을 위반하여 기술적 조치를 한 자</p>
                            <p>&#10113; 제50조제6항의 규정을 위반하여 영리목적의 광고성 정보를 전송한 자</p>
                            <p>&#10114; 제50조의2의 규정을 위반하여 전자우편주소를 수집ㆍ판매ㆍ유통 또는 정보전송에 이용한 자</p>
                            <br>
                        </div>
                        <div class="terms-box center">
                            <p>시행일자: 2020년 4월 3일</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>
</html>