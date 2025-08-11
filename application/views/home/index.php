<!DOCTYPE html>
<html lang="ko">
<head>
	<link rel="canonical" href="<?= base_url();?>" />
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
    <meta property="og:site_name" content="@(주)주신산업" />	
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?= base_url();?>">
    <meta property="og:image" content="<?= base_url();?>uploads/thumb/logo.png" />
    <meta property="og:description" content="<?=$this->config->item('META_DESC')?>" />

    <!-- Tw -->
	<meta name="twitter:card" content="summary_large_image" />
	<meta name="twitter:title" content="<?=$this->config->item('HOMEPAGE_TITLE')?>" />
	<meta name="twitter:description" content="<?=$this->config->item('META_DESC')?>" />
	<meta name="twitter:image" content="<?= base_url();?>uploads/thumb/logo.png" />
	<meta name="twitter:url" content="<?= base_url();?>" />  
	<meta name="twitter:site" content="@(주)주신산업" />	
	<meta name="twitter:creator" content="@(주)주신산업" />		

	<title><?=$this->config->item('HOMEPAGE_TITLE')?></title>

	<link rel="stylesheet" href="<?=$this->config->item('INCLUDE_HOME_DIR')?>/css/page-main.css?version=4">

	<script src="<?=$this->config->item('home_assets_url')?>/common/vendor/jquery/jquery-3.1.1.min.js"></script>
	<script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/base.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/layout.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/main.js?version=4"></script>
	
	<!-- 공용 라이브러리 -->
	<script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/vendor/fullpage/fullpage.extensions.min.js"></script>
	<script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/vendor/fullpage/easings.min.js"></script>
	<script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/vendor/slick/slick.js"></script>
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
        <!-- // header -->
		<!-- container -->
		<div id="skip_container" class="container">
			<div id="fullpage">
				<!-- 메인 풀화면 슬라이드 영역 -->
				<div class="section section-fp-main" data-anchor="main">
					<!-- Ajax -->
				</div>
				<!-- // 메인 풀화면 슬라이드 영역 -->
				<!-- 메인2  -->
				<div class="section fp-auto-height section-t section-main2" data-anchor="company">
					<div class="slide clearfix">
						<div class="m2-title">
							<p>고객이 신뢰하는</p>
							<h2>글로벌 산업장비 선도 기업</h2>
						</div>
						<div class="m2-list section-1200 clearfix">
							<div class="m2-item typeA pointer" onclick="location.href='<?= base_url(); ?>home/info/company?menu_code=company&menu_up_code='">
								<div class="m2-txt">
									<h3>회사소개</h3>
									<span>고객 여러분께 더 큰 신뢰와<br>사랑을 받는 기업이 되도록<br>최선의 노력을 다 하겠습니다.</span>
									<a href="javascript:void(0);"></a>
								</div>
							</div>
							<div class="m2-item typeB pointer" onclick="location.href='<?= base_url(); ?>home/product?menu_code=product&menu_up_code='">
								<div class="m2-txt">
									<h3>제품소개</h3>
									<span>세계 선진국의 초정밀 산업장비와<br>계측장비를 보급하고자 최선을<br>다하고 있습니다.</span>
									<a href="javascript:void(0);"></a>
								</div>
							</div>
							<div class="m2-item typeC pointer" onclick="location.href='<?= base_url(); ?>home/service?menu_code=service&menu_up_code='">
								<div class="m2-txt">
									<h3>용역정보</h3>
									<span>끊임없는 연구와 오랜 노하우로<br>어떤 어려운 계측용역도 완벽하게<br>수행합니다.</span>
									<a href="javascript:void(0);"></a>
								</div>
							</div>
							<div class="m2-item typeD pointer" onclick="location.href='<?= base_url(); ?>home/info/cs?menu_code=cs&menu_up_code='" >
								<div class="m2-txt">
									<h3>문의하기</h3>
									<span>전화주시면 언제나 친절히<br>상담해드립니다.</span>
									<p>T. 02-774-0622</p>
									<p>F. 031-742-0624</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- // 메인2  -->
				<!-- 메인3 주요제품 -->
				<div class="section fp-auto-height section-t section-main3" data-anchor="product">
					<div class="slide clearfix">
						<div class="ms-header">
							<h2>주요제품군</h2>
						</div>
						<div class="m3-list section-1200 clearfix">
							<ul>
								<li>
									<a href="<?= base_url();?>home/product?menu_code=product&menu_up_code=&depth_1=계측장비" title="Data Logger">
										<div class="m3-img-area m-img-area">
											<div class="m3-img m-img" style='background-image:url("<?=$this->config->item('INCLUDE_HOME_DIR')?>/img/dummy/th-product-a.png");' aria-label="Data Logger"></div>
										</div>
										<div class="m3-title">
											<h3>Data Logger</h3>
										</div>
									</a>
								</li>
								<li>
									<a href="<?= base_url();?>/home/product?menu_code=product&menu_up_code=&depth_1=스트레인게이지&depth_2=스트레인게이지" title="Strain Gauge">
										<div class="m3-img-area m-img-area">
											<div class="m3-img m-img" style='background-image:url("<?=$this->config->item('INCLUDE_HOME_DIR')?>/img/dummy/th-product-b.png");' aria-label="Strain Gauge"></div>
										</div>
										<div class="m3-title">
											<h3>Strain Gauge</h3>
										</div>
									</a>
								</li>
								<li>
									<a href="<?= base_url();?>home/product?menu_code=product&menu_up_code=&depth_1=계측센서&depth_2=하중계" title="Transducer">
										<div class="m3-img-area m-img-area">
											<div class="m3-img m-img" style='background-image:url("<?=$this->config->item('INCLUDE_HOME_DIR')?>/img/dummy/th-product-c.png");' aria-label="Transducer"></div>
										</div>
										<div class="m3-title">
											<h3>Transducer</h3>
										</div>
									</a>
								</li>
								<li>
									<a href="<?= base_url();?>home/product?menu_code=product&menu_up_code=&depth_1=비디오게이지" title="Video Gauge">
										<div class="m3-img-area m-img-area">
											<div class="m3-img m-img" style='background-image:url("<?=$this->config->item('INCLUDE_HOME_DIR')?>/img/dummy/th-product-d.png");' aria-label="Video Gauge"></div>
										</div>
										<div class="m3-title">
											<h3>Video Gauge</h3>
										</div>
									</a>
								</li>
								<li>
									<a href="<?= base_url();?>home/product?menu_code=product&menu_up_code=&depth_1=시험용치구" title="TestFixture">
										<div class="m3-img-area m-img-area">
											<div class="m3-img m-img" style='background-image:url("<?=$this->config->item('INCLUDE_HOME_DIR')?>/img/dummy/th-product-e.png");' aria-label="TestFixture"></div>
										</div>
										<div class="m3-title">
											<h3>TestFixture</h3>
										</div>
									</a>
								</li>
								<li>
									<a href="<?= base_url();?>home/service?menu_code=service&menu_up_code="  title="Testing and Services">
										<div class="m3-img-area m-img-area">
											<div class="m3-img m-img" style='background-image:url("<?=$this->config->item('INCLUDE_HOME_DIR')?>/img/dummy/th-product-f.png");' aria-label="Testing and Services"></div>
										</div>
										<div class="m3-title">
											<h3>Testing and Services</h3>
										</div>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- // 메인3 주요제품 -->
				<!-- 메인 4 제품 리스트 -->
				<!-- <div class="section fp-auto-height section-t section-main4" data-anchor="productList">
					<div class="slide clearfix">
						<div class="ms-header section-1200">
							<h2>제품정보</h2>
							<p>최고의 전문기술과 서비스를 통하여<br> 고객 가치를 창출합니다.</p>
							<a href="<?= base_url(); ?>home/product?menu_code=product&menu_up_code=">전체보기</a>
						</div>
						<div id="list_product" class="ms-list">
							<ul></ul>
						</div>
					</div>
				</div> -->
				<!-- // 메인 4 제품 리스트 -->
				<!-- 메인5 용역리스트 -->
				<div class="section fp-auto-height section-t section-main5" data-anchor="serviceList">
					<div class="slide clearfix">
						<div class="ms-header section-1200">
							<h2>시험 및 용역</h2>
							<p>끊임없는 연구와 오랜 노하우로<br> 어떤 어려운 계측용역도 완벽하게 수행합니다.</p>
							<a href="<?= base_url(); ?>home/service?menu_code=service&menu_up_code=">전체보기</a>
						</div>
						<div id="list_service" class="ms-list">
							<ul></ul>
						</div>
					</div>
				</div>
				<!-- // 메인5 용역리스트 -->
				<!-- 메인6 협력사 -->
				<!-- <div class="section fp-auto-height section-t section-main6" data-anchor="partner" style='background-image:url("<?=$this->config->item('INCLUDE_HOME_DIR')?>/img/dummy/bg-partner.png");'>
					<div class="slide clearfix">
						<div class="ms-header">
							<h2>협력사</h2>
						</div>
						<div id="list_partner" class="section-1080">
							<ul>
								<li>
									<a href="https://tml.jp/" target="_blank" title="TML" style='background-image:url("<?=$this->config->item('INCLUDE_HOME_DIR')?>/img/dummy/th-partner-13.png");' aria-label="TML"></a>
								</li>
								<li>
									<a href="https://www.kyowa-ei.com/eng/" target="_blank" title="kyowa" style='background-image:url("<?=$this->config->item('INCLUDE_HOME_DIR')?>/img/dummy/th-partner-12.png");' aria-label="kyowa"></a>
								</li>
								<li>
									<a href="https://www.epsilontech.com/" target="_blank" title="Epsilon" style='background-image:url("<?=$this->config->item('INCLUDE_HOME_DIR')?>/img/dummy/th-partner-04.png");' aria-label="Epsilon"></a>
								</li>
								<li>
									<a href="https://wyomingtestfixtures.com/" target="_blank" title="wyomingtestfixtures" style='background-image:url("<?=$this->config->item('INCLUDE_HOME_DIR')?>/img/dummy/th-partner-07.png");' aria-label="wyomingtestfixtures"></a>
								</li>
								<li>
									<a href="https://dewesoft.com/" target="_blank" title="dewesoft" style='background-image:url("<?=$this->config->item('INCLUDE_HOME_DIR')?>/img/dummy/th-partner-01.png");' aria-label="dewesoft"></a>
								</li>
								<li>
									<a href="https://www.novatechloadcells.co.uk/" target="_blank" title="novatechloadcells" style='background-image:url("<?=$this->config->item('INCLUDE_HOME_DIR')?>/img/dummy/th-partner-02.png");' aria-label="novatechloadcells"></a>
								</li>
								<li>
									<a href="https://www.stellartech.com/" target="_blank" title="stellartech" style='background-image:url("<?=$this->config->item('INCLUDE_HOME_DIR')?>/img/dummy/th-partner-03.png");' aria-label="stellartech"></a>
								</li>
								<li>
									<a href="https://kinemetrics.com" target="_blank" title="kinemetrics" style='background-image:url("<?=$this->config->item('INCLUDE_HOME_DIR')?>/img/dummy/th-partner-05.png");' aria-label="kinemetrics"></a>
								</li>
								<li>
									<a href="https://www.vishay.com/" target="_blank" title="vishay" style='background-image:url("<?=$this->config->item('INCLUDE_HOME_DIR')?>/img/dummy/th-partner-06.png");' aria-label="vishay"></a>
								</li>
								<li>
									<a href="https://www.pcb.com/" target="_blank" title="pcb" style='background-image:url("<?=$this->config->item('INCLUDE_HOME_DIR')?>/img/dummy/th-partner-08.png");' aria-label="pcb"></a>
								</li>
								<li>
									<a href="http://www.showa-sokki.co.jp" target="_blank" title="showa-sokki" style='background-image:url("<?=$this->config->item('INCLUDE_HOME_DIR')?>/img/dummy/th-partner-09.png");' aria-label="showa-sokki"></a>
								</li>
								<li>
									<a href="http://www.ssk-co.jp/" target="_blank" title="ssk" style='background-image:url("<?=$this->config->item('INCLUDE_HOME_DIR')?>/img/dummy/th-partner-10.png");' aria-label="ssk"></a>
								</li>
								<li>
									<a href="https://www.dewetron.com/" target="_blank" title="dewetron" style='background-image:url("<?=$this->config->item('INCLUDE_HOME_DIR')?>/img/dummy/th-partner-11.png");' aria-label="dewetron"></a>
								</li>
								<li>
									<a href="https://www.sherbornesensors.com/" target="_blank" title="SHERBORNE" style='background-image:url("<?=$this->config->item('INCLUDE_HOME_DIR')?>/img/dummy/th-partner-14.png");' aria-label="SHERBORNE"></a>
								</li>
							</ul>
						</div>
					</div>
				</div> -->
				<!-- // 메인6 협력사 -->
			</div>
		</div><!-- //container -->
		<!-- FOOTER -->
		<div class="section fp-auto-height section-t fp-completely" data-anchor="footer">
			<?php $this->load->view('home/inc/footer'); ?>
		</div>
		<!-- //FOOTER -->
	</div>
</body>
</html>