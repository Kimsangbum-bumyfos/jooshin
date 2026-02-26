<!DOCTYPE html>
<html lang="ko">
<head>
    <link rel="canonical" href="<?= base_url();?>home/info/cs?menu_code=cs&menu_up_code=" />
    <meta charset="UTF-8" />
    <meta name="Referrer" content="origin" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> 
    <?php $this->load->view('home/inc/meta'); ?>
    <meta name="format-detection" content="telephone=no" />
    <meta name="description" content="문의를 남겨주시면 빠른 시일 내 답변드리겠습니다." />
    <meta name="author" content="<?=$this->config->item('COMPANY_NAME')?>" />
    <meta name="keywords" content="<?=$this->config->item('META_KEYWORDS')?>" /> 

    <!-- OG Tag -->
    <meta property="fb:app_id" content="<?= $this->config->item('FB_APP_ID')?>" />
    <meta property="og:title" content="고객문의 | (주)세인테크" />
    <meta property="og:site_name" content="@(주)세인테크" />    
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?= base_url();?>home/info/cs?menu_code=cs&menu_up_code=">
    <meta property="og:image" content="<?= base_url();?>uploads/thumb/logo.png" />
    <meta property="og:description" content="<?=$this->config->item('META_DESC')?>" />

    <!-- Tw -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="고객문의 | (주)세인테크" />
    <meta name="twitter:description" content="문의를 남겨주시면 빠른 시일 내 답변드리겠습니다." />
    <meta name="twitter:image" content="<?= base_url();?>uploads/thumb/logo.png" />
    <meta name="twitter:url" content="<?= base_url();?>home/info/cs?menu_code=cs&menu_up_code=" />  
    <meta name="twitter:site" content="@(주)세인테크" />    
    <meta name="twitter:creator" content="@(주)세인테크" />     

    <title>고객문의 | (주)세인테크</title>

    <script>
        var mCode = '<?php echo $menu_code?>';
        var mUpCode = '<?php echo $menu_up_code?>';
    </script>
    
    <link rel="stylesheet" href="<?=$this->config->item('INCLUDE_HOME_DIR')?>/css/page-sub.css">
    <script src="<?=$this->config->item('home_assets_url')?>/common/vendor/jquery/jquery-3.1.1.min.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/base.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/layout.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/map.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/sub.js"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCy5oQHGB6oLkS4pOk1cvbUu2oeseb5_gQ"></script>

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
            <div id="cs_wrap" class="section-1024">
                <div class="cs-title">
                    <h3><strong>문의를 남겨주시면</strong><br> 빠른 시일 내 답변드리겠습니다.</h3>
                </div>
                <div class="cs-wrap section-t">
                    <div class="cs-form-wrap">
                        <div class="cs-form">
                            <label for="cs_name">
                                <input type="text" id="cs_name" placeholder="이름">
                            </label>
                        </div>
                        <div class="cs-form">
                            <label for="cs_phone">
                                <input type="text" id="cs_phone" placeholder="연락처">
                            </label>
                        </div>
                        <div class="cs-form">
                            <label for="cs_email">
                                <input type="text" id="cs_email" placeholder="이메일">
                            </label>
                        </div>
                        <div class="cs-form">
                            <label for="cs_title">
                                <input type="text" id="cs_title" placeholder="제목">
                            </label>
                        </div>
                        <div class="cs-form">
                            <textarea name="" id="cs_contents" placeholder="문의내용"></textarea>
                        </div>
                        <div class="cs-agree">
                            <h4>개인정보 수집·이용동의</h4>
                            <p>※아래 주의사항을 확인해 주시기 바랍니다.</p>
                            <br>
                            <p>1. 개인 정보의 수집 및 이용목적</p>
                            <p>- 서비스 이용에 따른 본인 식별 및 실명확인</p>
                            <p>- 고지사항 전달, 불만처리 의사소통 경로 확보</p>
                            <p>- 신규 서비스 등 최신 정보 안내 및 개인맞춤서비스 제공을 위한 자료</p>
                            <p>- 기타 원활한 양질의 서비스 제공 등</p>
                            <br>
                            <p>2. 수집하는 개인정보의 항목</p>
                            <p>- 성명, 연락처,이메일</p>
                            <br>
                            <p>3. 개인정보의 보유 및 이용기간</p>
                            <p>- 원칙적으로 개인정보의 수집 또는 제공받은 목적 달성 시 지체 없이 파기 합니다</p>
                        </div>
                        <div class="cs-form">
                            <input type="checkbox" id="cs_agreement" class="cs-checkbox" name="checkbox">
                            <label for="cs_agreement" class="cs-checkbox-desc"><span></span>개인정보취급동의</label>
                        </div>
                        <div class="cs-form with-btn">
                            <button type="button" id="cs_submit">문의하기</button>
                        </div>
                    </div>
                    <div id="cs_map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3168.029442310391!2d127.16751547640149!3d37.43640923157815!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x357ca9274bc370e7%3A0xf2938436cec11731!2z6rK96riw64-EIOyEseuCqOyLnCDspJHsm5Dqtawg7IKs6riw66eJ6rOo66GcNDXrsojquLggMTQ!5e0!3m2!1sko!2skr!4v1772096736203!5m2!1sko!2skr" width="1024" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="cs-addr">
                        <p><?=$this->config->item('COMPANY_ADDR')?><?=$this->config->item('COMPANY_ADDR2')?></p>
                    </div>
                    <div class="cs-summary clearfix">
                        <div class="cs-icon tel">
                            <p><strong>TEL</strong></p>
                            <p>02 774 0622</p>
                        </div>
                        <div class="cs-icon mail">
                            <p><strong>E-mail</strong></p>
                            <p>help@joosh.co.kr</p>
                        </div>
                        <div class="cs-icon time">
                            <p><strong>근무시간</strong></p>
                            <p>평일 09~18시, 점심 : 12~13시</p>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- //container -->
        <!-- FOOTER -->
        <?php $this->load->view('home/inc/footer'); ?>
        <!-- //FOOTER -->
    </div>
</body>
</html>