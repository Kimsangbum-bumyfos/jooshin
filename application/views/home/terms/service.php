<!DOCTYPE html>
<html lang="ko">
<head>
	<link rel="canonical" href="<?= base_url();?>home/terms/service" />
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
    <meta property="og:title" content="서비스약관 - <?=$this->config->item('HOMEPAGE_TITLE')?>" />
    <meta property="og:site_name" content="@메이크홈" />    
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?= base_url();?>home/terms/service">
    <meta property="og:image" content="<?= base_url();?>uploads/thumb/th-t190315.png" />
    <meta property="og:description" content="<?=$this->config->item('META_DESC')?>" />

    <!-- Tw -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="서비스약관 - <?=$this->config->item('HOMEPAGE_TITLE')?>" />
    <meta name="twitter:description" content="<?=$this->config->item('META_DESC')?>" />
    <meta name="twitter:image" content="<?= base_url();?>uploads/thumb/th-t190315.png" />
    <meta name="twitter:url" content="<?= base_url();?>home/terms/service" />  
    <meta name="twitter:site" content="@메이크홈" />    
    <meta name="twitter:creator" content="@메이크홈" />     

    <title>서비스약관 - <?=$this->config->item('HOMEPAGE_TITLE')?></title>

    <link rel="stylesheet" href="<?=$this->config->item('INCLUDE_HOME_DIR')?>/css/page-sub.css">

    <script src="<?=$this->config->item('home_assets_url')?>/common/vendor/jquery/jquery-3.1.1.min.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/base.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/layout.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/sub.js"></script>

    <!-- 고객센터 -->
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/floating.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/cscenter/js/cs-handle.js"></script>

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
    <div id="skip_container" class="wrap">
        <!-- header -->
        <?php $this->load->view('home/inc/header'); ?>
        <!-- //header -->
        <!-- container -->
        <div class="container">
            <section class="terms">
                <h2 class="hidden">서비스 이용약관</h2>
                <div class="contents-box">
                    <div class="terms-group">
                        <div class="row text-right">
                            <span class="ico-sub-back text-hidden terms-close" aria-label="닫기">닫기</span>
                        </div>
                        <div class="terms-top-title">
                            <p>서비스 이용약관</p>
                        </div>
                        <div class="terms-box">
                            <p class="terms-sub">홈 | <span class="terms-bold">서비스 이용약관</p>
                            <p class="terms-sub2">제 1 조 목적</p>
                            <p>이 약관은 프롬티어 주식회사(이하 "회사"라 합니다.)가 제공하는 메이크홈 서비스(이하 "서비스" 라 합니다.)를 이용함에 있어 "회사"와 이용 고객 (이하 "고객"이라 합니다.)의 권리와 의무를 비롯해 책임과 기타 제반 사항을 규정하기 위한 목적입니다.</p>
                            <br>
                            <p class="terms-sub2">제 2조 서비스 내용</p>
                            <p>본 서비스는 고객이 신청한 디자인에 따라 회사가 고객의 요구에 맞춰 디자인을 스타일링(로고 색상 등에 맞춰 변형)한 웹사이트를 구성해 제공하는 업무와 고객이 제공된 웹사이트를 직접 관리할 수 있는 콘텐츠 관리시스템(이하 "CMS"라 합니다.)을 제공하는 업무, 제공된 웹사이트의 인터넷 호스팅 업무로 구성돼 있습니다.</p>
                            <br>
                            <p class="terms-sub2">제 3조 회원가입 및 정보변경</p>
                            <p>1. 본 서비스는 회원가입 절차 완료 후 이용이 가능하며, 회원가입 시 기재한 사항이 변경되었을 경우에는 고객이 온라인으로 직접 수정해야 합니다.</p>
                            <p>2. 고객이 제 1항의 회원정보 변경사항을 회사에 알리지 않아 발생한 불이익에 대해 회사는 책임지지 않습니다.</p>
                            <br>
                            <p class="terms-sub2">제 4조 서비스 약정기간 및 이용요금</p>
                            <p>1. 본 서비스의 약정기간은 1년입니다.</p>
                            <p>2. 고객이 본 서비스를 이용하기 위해서는 회사에서 정한 약정기간의 이용요금을 납부하여야 합니다.</p>
                            <p>3. 서버 셋팅일로 만 1년이 도래하는 시점까지의 최초 1년 간은 회사가 고객에게 무료 호스팅 서비스를 제공합니다.</p>
                            <p>4. 1년 간의 무료 호스팅 서비스가 종료하면 그 이후에는 월 사용료가 발생하며 12 개월 단위로 총 금액을 일시에 지급하여야 합니다.</p>
                            <br>
                            <p class="terms-sub2">제 5조 서비스의 제공</p>
                            <p>1. 회사는 고객의 서비스 이용요금 납부가 확인되면 고객의 서비스 신청 내역에 따라 웹사이트의 구성과 솔루션 설정을 진행하고 호스팅 서비스를 진행하는 정해진 업무를 원활하게 제공하기 위해 노력해야 합니다.</p>
                            <p>2. 회사에서 기본 금액으로 제공하는 콘텐츠 구성의 범위는 고객이 제공한 자료를 기반으로 총 10페이지(메인, 서브페이지, 게시판, 상세페이지 등) 까지만 구성하는 것으로 합니다. 단, 추가되는 페이지는 회사에서 책정된 추가금액을 납부하면 제작이 가능합니다.</p>
                            <p>3. 파트너쉽 프로그램으로 데모체험 완성형 상품을 구매한 고객에게는 별도의 스타일링 업무(로고 색상등에 맞춘 배경이나 포인트 색상 변경, 바로가기용 아이콘과 사진 이미지, 메뉴별 상단 이미지 제작, 메인 이미지로 사용되는 프로모션용 콘텐츠를 포함한 대표 콘텐츠 10개 제작(이미지 구입 비용 포함))를 제공하지 않습니다.</p>
                            <p>4. 구입하신 솔루션 템플릿을 셋팅 완료 후에 고객이 도메인 연결 절차를 제대로 이행하지 않아 발생하는 웹사이트의 원활한 인터넷 연결과 솔루션의 새로운 기능 추가 등의 제반 사항에 문제가 발생할 경우는 회사가 책임지지 않습니다.</p>
                            <p>5. 고객은 본 서비스를 이용하는 기간 동안 고객 웹사이트가 메이크홈 포트폴리오 및 체험사이트로 활용될 수 있도록 협조하여야 합니다.</p>
                            <br>
                            <p class="terms-sub2">제 6조 지적재산권</p>
                            <p>본 서비스를 이용함에 있어 회사(프롬티어 메이크홈 서비스)와 계약을 통해 제공받지 않은 모든 사진 이미지와 서체의 저작권리는 계약 고객이 직접 확보해야 합니다. 이를 위반하여 발생하는 지적재산권 침해의 모든 법적 문제는 계약 고객의 책임으로 직접 해결하여야 합니다.</p>
                            <br>
                            <p class="terms-sub2">제 7조 게시물의 저작권</p>
                            <p>게시물의 저작권은 게시자 본인에게 있으며 회원은 서비스를 이용하여 얻은 정보를 가공, 판매하는 행위 등 서비스에 게재된 자료를 상업적으로 사용할 수 없습니다.</p>
                            <br>
                            <p class="terms-sub2">제 8조 라이센스</p>
                            <p>무료로 제공되는 콘텐츠는 게시된 글의 라이센스 여부를 확인 후 사용을 하셔야 하며, 이를 위반하여 발생하는 라이센스의 모든 법적문제는 고객의 책임으로 직접 해결해야 합니다.</p>
                            <br>
                            <p class="terms-sub2">제 9조 서비스 이용의 제한.해지</p>
                            <p>1. 고객 또는 회사 양 당사자 중 일방에게 다음 각호에 해당하는 사유가 발생한 때에는 상대방은 최고 없이 즉시 본 서비스의 이용을 제한. 해 지할 수 있습니다.</p>
                            <p class="terms-indent">1) 발행한 어음이나 수표가 부도 또는 거래 정지된 경우</p>
                            <p class="terms-indent">2) 감독관청으로부터 영업정지 또는 영업면허, 영업등록 등의 취소처분을 받은 때</p>
                            <p class="terms-indent">3) 파산절차 또는 회생절차가 시작되거나 이러한 신청이 있는 경우</p>
                            <p class="terms-indent">4) 가압류, 가처분 등으로 본 계약의 목적달성이 곤란하다고 판달 될 경우</p>
                            <p class="terms-indent">5) 고객의 서비스 이용대금이 정해진 기일안에 미납된 경우</p>
                            <br>
                            <p>2. 고객 또는 회사 양 당사자 중 일방이 본 서비스 이용약관을 위반한 경우 상대방은 14일의 기간을 두고 위반 내용의 시정을 최고한 후 시정되지 않을 시 본 서비스 이용을 제한.해지할 수 있습니다.</p>
                            <p>3. 고객의 서비스 이용대금이 정해진 기일안에 미납돼 호스팅 서비스가 종료된 경우 회사는 고객의 웹사이트에 존재하는 콘텐츠(게시물 포함), 회원정보, 영상, 사진 이미지, 쇼핑 목록 등 모든 데이터를 유지할 의무가 없으며 최고 없이 폐기합니다.</p>
                            <br>
                            <p class="terms-sub2">제 10조 회사의 의무</p>
                            <p>1. 회사는 이 약관에서 정한 바에 따라 계속적, 안정적으로 서비스를 제공할 수 있도록 최선의 노력을 다해야 합니다.</p>
                            <p>2. 회사는 서비스와 관련한 고객의 불만사항이 접수되는 경우 이를 즉시 처리해야 하며, 즉시 처리가 곤란한 경우 그 사유와 처리 일정을 온라인 서비스 또는 이메일을 통해 고객에게 통지해야 합니다.</p>
                            <br>
                            <p class="terms-sub2">제 11조 고객의 의무</p>
                            <p>1. 고객은 관계법령, 이 약관의 규정, 이용안내 및 주의사항 등 회사가 통지하는 사항을 준수해야 하며, 기타 회사의 업무에 방해되는 행위를 해서는 안됩니다.</p>
                            <p>2. 고객은 서비스 이용과 관련해 다음 각 호의 행위를 해서는 안됩니다.</p>
                            <p class="terms-indent">1) 다른 회원의 아이디(ID)를 부정 사용하는 행위</p>
                            <p class="terms-indent">2) 범죄행위를 목적으로 하거나 기타 범죄행위와 관련된 행위</p>
                            <p class="terms-indent">3) 타인의 지적재산권 등의 권리를 침해하는 행위</p>
                            <p class="terms-indent">4) 타인에 대한 개인정보를 수집 또는 저장하는 행위</p>
                            <p class="terms-indent">5) 해킹행위 또는 컴퓨터바이러스의 유포행위</p>
                            <p class="terms-indent">6) 타인의 의사에 반해 광고성 정보 등 일정한 내용을 지속적으로 전송하는 행위</p>
                            <p class="terms-indent">7) 서비스의 안정적인 운영에 지장을 주거나 줄 우려가 있는 일체의 행위</p>
                            <p class="terms-indent">8) 관계법령에 위배되는 행위</p>
                            <p class="terms-indent">9) 기타 회사가 서비스 운영상 부적절하다고 판단하는 행위</p>
                            <br>
                            <p class="terms-sub2">제 12조 파트너쉽 고객의 의무</p>
                            <p>회사에서 진행하는 파트너쉽 프로그램으로 진행하는 파트너의 경우 다음 사항을 준수해야 합니다.</p>
                            <p>1. 파트너쉽 프로그램은 데모체험 완성형 상품에서만 구입이 가능합니다.</p>
                            <p>2. 파트너는 스스로 고객을 유치해야 하며 유치한 고객과 파트너의 직접계약으로 진행해야 합니다.</p>
                            <p>3. 웹사이트 제작에 사용되는 모든 사진 이미지와 서체의 저작권은 파트너의 책임입니다.</p>
                            <p>4. 이와 관련하여 파트너와 파트너 고객사간 발생하는 모든 법적 문제는 해당 파트너의 책임입니다.</p>
                            <br>
                            <p class="terms-sub2">제 13조 고객에 대한 통지</p>
                            <p>회사가 고객에 대한 통지를 하는 경우 이 이용약관에 별도 규정이 없는 한 온라인 서비스, 이메일, SMS 등으로 할 수 있습니다.</p>
                            <br>
                            <p class="terms-sub2">제 14조 손해배상 책임</p>
                            <p>회사와 고객 중 어느 일방이 본 서비스 이용 약관에 규정된 의무 이행을 해태 하거나 또는 지연 시킬 때에는 그 행위를 야기한 당사자는 그러한 불이행에 대해 전적으로 책임을 지며, 그에 따른 일체의 손해를 배상함과 동시에 상대방이 요구하는 모든 적절한 조치를 취해야 합니다.</p>
                            <br>
                            <p class="terms-sub2">제 15조 계약의 해석</p>
                            <p>본 서비스이용 약관의 해석상 이의가 있거나 약관에 명시되지 않은 사항에 대해서는 회사와 고객의 상호 합의에 따릅니다.</p>
                            <br>
                            <p class="terms-sub2">제 16조 계약의 체결 및 동의</p>
                            <p>제 4조에 따라 고객이 회사에 서비스 이용요금을 지급하거나 온라인 서비스 상에서 서비스 이용약관에 동의 표시를 했을 경우에 본 서비스 이용약관이 쌍방이 동의해 체결된 것으로 하며 서명을 대신한 것으로 합니다.</p>
                            <br>
                            <p class="terms-sub2">제 17조 개인정보보호 의무</p>
                            <p>회사는 “정보통신망법”등 관계법령이 정하는 바에 따라 고객의 개인정보를 보호하기 위하여 노력합니다. 개인정보의 보호 및 사용에 대해서는 관련법 및 회사의 개인정보 취급방침이 적용됩니다.</p>
                            <br>
                            <p class="terms-sub2">제 18조 손해배상</p>
                            <p>회사가 제공하는 서비스로 인해 고객에게 손해가 발생하는 경우 회사는 그 손해가 회사의 고의 또는 중과실에 의한 경우에 한해 통상손해의 범위에서 손해배상책임을 부담합니다.</p>
                            <br>
                            <p class="terms-sub2">제 19조 면책조항</p>
                            <p>1. 회사는 천재지변, 전쟁 및 기타 이에 준하는 불가항력으로 인하여 서비스를 제공할 수 없는 경우에는 서비스 제공에 대한 책임을 지지 않습니다.</p>
                            <p>2. 회사는 기간통신 사업자가 전기통신 서비스를 중지하거나 정상적으로 제공하지 아니하여 손해가 발생한 경우에는 책임을 지지 않습니다.</p>
                            <p>3. 회사는 서비스용 설비의 보수, 교체, 정기점검, 공사 등 부득이한 사유로 발생한 손해에 대한 책임을 지지 않습니다.</p>
                            <p>4. 회사는 고객의 귀책사유로 인한 서비스 이용의 장애 또는 손해에 대해 책임을 지지 않습니다.</p>
                            <p>5. 회사는 고객의 컴퓨터 오류에 의해 손해가 발생한 경우, 또는 고객이 신상정보나 이메일(전자우편) 주소를 부실하게 기재하여 손해가 발생한 경우 책임을 지지 않습니다.</p>
                            <p>6. 회사는 고객이 서비스를 이용하여 기대하는 수익을 얻지 못하거나 상실한 것에 대하여 책임을 지지 않습니다.</p>
                            <p>7. 회사는 고객이 서비스를 이용하면서 얻은 자료로 인한 손해에 대해 책임을 지지 않습니다. 또한 회사는 고객이 서비스를 이용하며 타인으로 인해 입게 되는 정신적 피해에 대하여 보상할 책임을 지지 않습니다.</p>
                            <p>8. 회사는 고객이 서비스에 게재한 각종 정보, 자료, 사실의 신뢰도, 정확성 등 내용에 대해 책임을 지지 않습니다.</p>
                            <p>9. 회사는 고객 상호간 및 고객과 제 3자 상호 간에 서비스를 매개로 발생한 분쟁에 대해 개입할 의무가 없으며, 이로 인한 손해를 배상할 책임도 없습니다.</p>
                            <br>
                            <p class="terms-sub2">제 20조 재판권 및 준거법</p>
                            <p>본 약관에 명시되지 않은 사항은 전기통신사업법 등 관계법령과 상관습에 따릅니다. 서비스 이용으로 발생한 고객과의 분쟁에 대해 소송이 제기되는 경우 회사의 본사 소재지를 관할하는 법원을 관할 법원으로 합니다.</p>
                            <br>
                            <p class="terms-sub">부칙</p>
                            <p>(시행일)본 약관은 2019년 03월 01일부터 적용됩니다.</p>
                            <br>
                        </div>
                        <div class="row text-right">
                            <span class="ico-sub-back text-hidden terms-close" aria-label="닫기">닫기</span>
                        </div>
                    </div>
                </div>
            </section>
        </div> 
    </div>
</body>
</html>