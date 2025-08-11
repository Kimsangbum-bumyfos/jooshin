<!DOCTYPE html>
<html lang="ko">
<head>
    <link rel="canonical" href="<?= base_url();?>home/info/company?menu_code=<?= $menu_code ?>&menu_up_code=<?= $menu_up_code ?>" />
    <meta charset="UTF-8" />
    <meta name="Referrer" content="origin" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> 
    <?php $this->load->view('home/inc/meta'); ?>
    <meta name="format-detection" content="telephone=no" />
    <meta name="description" content="세계인이 모두 행복해지는 세상, 주신이 보여주는 내일의 모습입니다." />
    <meta name="author" content="<?=$this->config->item('COMPANY_NAME')?>" />
    <meta name="keywords" content="<?=$this->config->item('META_KEYWORDS')?>" /> 

    <!-- OG Tag -->
    <meta property="fb:app_id" content="<?= $this->config->item('FB_APP_ID')?>" />
    <meta property="og:title" content="회사소개 | (주)주신산업" />
    <meta property="og:site_name" content="@(주)주신산업" />    
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?= base_url();?>home/info/company?menu_code=<?= $menu_code ?>&menu_up_code=<?= $menu_up_code ?>">
    <meta property="og:image" content="<?= base_url();?>uploads/thumb/logo.png" />
    <meta property="og:description" content="세계인이 모두 행복해지는 세상, 주신이 보여주는 내일의 모습입니다." />

    <!-- Tw -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="회사소개 | (주)주신산업" />
    <meta name="twitter:description" content="세계인이 모두 행복해지는 세상, 주신이 보여주는 내일의 모습입니다." />
    <meta name="twitter:image" content="<?= base_url();?>uploads/thumb/logo.png" />
    <meta name="twitter:url" content="<?= base_url();?>home/info/company?menu_code=<?= $menu_code ?>&menu_up_code=<?= $menu_up_code ?>" />  
    <meta name="twitter:site" content="@(주)주신산업" />    
    <meta name="twitter:creator" content="@(주)주신산업" />     

    <title>회사소개 | (주)주신산업</title>

    <script>
        var mCode = '<?php echo $menu_code?>';
        var mUpCode = '<?php echo $menu_up_code?>';
    </script>

    <link rel="stylesheet" href="<?=$this->config->item('INCLUDE_HOME_DIR')?>/css/page-sub.css">
    <script src="<?=$this->config->item('home_assets_url')?>/common/vendor/jquery/jquery-3.1.1.min.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/base.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/layout.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/sub.js"></script>

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
            <div id="company" class="section-1024 clearfix">
                <div class="c-img"  style='background-image:url("<?=$this->config->item('INCLUDE_HOME_DIR')?>/img/dummy/th-company.png");' aria-label="주신사업"></div>
                <div class="company-info">
                    <div class="c-title">
                        <h2>주신산업 홈페이지를 방문해 주신 고객분들께 <br>먼저 감사의 인사를 전합니다.</h2>
                    </div>
                    <div class="c-desc">
                        <p>
                            주신산업은 오랜 경험을 바탕으로 축적된 기술력을 통해 고품질 엔지니어링 서비스와 국내외 다양한 메이커와의 파트너 쉽을 통해 계측장비 및 센서를 공급하고 차별화된 맞춤 솔루션을 제공해 왔습니다.
                        </p>
                        <p>
                            또한, 기술의 전문성과 기술개발의 노력으로 시험기 제조 및 제품개발로 첨단 ICT기반 융합기술에 힘쓰고 있습니다.
                        </p>
                        <br><br>
                        <p>
                            저희는 SHM(Structure Health Monitoring), 컬럼쇼트닝, 스카이브릿지 인양 중 계측, 남극장보고기지 계측시스템 구축 외 다양한 과업수행으로 건축, 토목분야 뿐만 아니라 기계, 항공, 자동차, 재료 분야에서도 주목 받고 있으며, 이에 부흥하고자 최선의 노력과 신뢰를 바탕으로 고객만족의 엔지니어링 서비스 품질과 고품격 가치로 충실히 수행할 것입니다.
                        </p>
                        <br><br>
                        <p>
                            마지막으로 저희 주신산업에 관심을 가져 주시는 고객분들께 다시 한 번 감사드리며 계속적인 관심과 사랑 부탁드립니다.
                        </p>
                        <br><br>
                        <p>
                            감사합니다.
                        </p>
                        <!-- <p>날로 세분화 되어 가는 산업 분업화 속에서 저희 주신산업은 세계 선진국의 초정밀 mechanical sensor와 측정장비 국내 연구기관이나 대학 그리고 산업체에 소개하며 각 기관의 실험 및 현장 계측에 가장 적합한 컨설팅을 하고 정확한 데이터를 얻고자 최선을 다하고 있습니다</p>
                        <p>또한 국내의 우수한 업체를 선별하여 그들의 우수한 장비를 세계시장으로 진출 할 수 있도록 적극 협렵하여 국가경쟁력을 높이고 있습니다.</p>
                        <br><br>
                        <p>주신산업은 항상 최고의 품질과 신제품 개발을 위하여 꾸준히 연구하고 보다 전문적이고 앞선 기술로서 최고의 제품을 생산하기 위해 끊임없이 노력할 것입니다.</p>
                        <br><br>
                        <p>감사합니다.</p> -->
                    </div>
                </div>
            </div>
            <div class="his-table-area section-1024">
                <div class="c-title his">
                    <h2>회사연혁</h2>
                </div>
                <table class="his-table">
                    <tbody>
                        <tr>
                            <th>2021</th>
                            <td class="his-rd"><div></div></td>
                            <td>06</td>
                            <td>특허등록<침매터널 누출 유량 측정시스템></td>
                        </tr>
                        <tr>
                            <th rowspan="2">2020</th>
                            <td rowspan="2" class="his-rd"><div></div></td>
                            <td>07</td>
                            <td>특허등록<동결관을 이용한 지반동결 모의시험장치 및 모의시험방법></td>
                        </tr>
                        <tr>
                            <td>06</td>
                            <td>㈜주신산업 경남지사 설립</td>
                        </tr>
                        <tr>
                            <th rowspan="4">2018</th>
                            <td rowspan="4" class="his-rd"><div></div></td>
                            <td>02</td>
                            <td>이메트럼사와 대리점 협약</td>
                        </tr>
                        <tr>
                            <td>04</td>
                            <td>(주)주신산업 사옥이전</td>
                        </tr>
                        <tr>
                            <td>07</td>
                            <td>(주)주신산업 성남사옥 공장등록</td>
                        </tr>
                        <tr>
                            <td>09</td>
                            <td>특허출원(콘크리트 구조물 외벽 도막 수축 변위량 검출장치 및 이를 이용한 수축변위량 검출방법)</td>
                        </tr>
                        <tr>
                            <th>2017</th>
                            <td class="his-rd"><div></div></td>
                            <td>10</td>
                            <td>특허출원(모델링된 교량시편을 이용한 교량 안전성 시험장치)</td>
                        </tr>
                        <tr>
                            <th rowspan="2">2014</th>
                            <td rowspan="2" class="his-rd"><div></div></td>
                            <td>09</td>
                            <td>벤처기업등록</td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>포에스구조안전그룹협동조합 창립(대우건설외7개중소기업)</td>
                        </tr>
                        <tr>
                            <th rowspan="2">2013</th>
                            <td rowspan="2" class="his-rd"><div></div></td>
                            <td>03</td>
                            <td>한국여성경제인협회 여성기업등록</td>
                        </tr>
                        <tr>
                            <td>04</td>
                            <td>중소기업 소상공인확인</td>
                        </tr>
                        <tr>
                            <th rowspan="3">2012</th>
                            <td rowspan="3" class="his-rd"><div></div></td>
                            <td>06</td>
                            <td>스마트제어계측시와 대리점 협약</td>
                        </tr>
                        <tr>
                            <td>07</td>
                            <td>한양대학교 산학협력협약서 체결</td>
                        </tr>
                        <tr>
                            <td>11</td>
                            <td>연구개발전담부서 설립 (한국산업 기술진흥협회 ; 제 201252693호)</td>
                        </tr>
                        <tr>
                            <th>2011</th>
                            <td class="his-rd"><div></div></td>
                            <td>01</td>
                            <td>건국대학교 산학협력단과의 산학협력에 관한 협약</td>
                        </tr>
                        <tr>
                            <th>2010</th>
                            <td class="his-rd"><div></div></td>
                            <td>05</td>
                            <td>(주)주신산업 법인 전환</td>
                        </tr>
                        <tr>
                            <th rowspan="2">2009</th>
                            <td rowspan="2" class="his-rd"><div></div></td>
                            <td>04</td>
                            <td>영국 SHERBORNE사와 대리점 협약</td>
                        </tr>
                        <tr>
                            <td>06</td>
                            <td>영국 NOVATECH Measurements사와 대리점 협약</td>
                        </tr>
                        <tr>
                            <th rowspan="2">2008</th>
                            <td rowspan="2" class="his-rd"><div></div></td>
                            <td>06</td>
                            <td>(주)주신산업 설립</td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>일본 Instrument Commerce사와 대리점 협약</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div><!-- //container -->
        <!-- FOOTER -->
        <?php $this->load->view('home/inc/footer'); ?>
        <!-- //FOOTER -->
    </div>
</body>
</html>