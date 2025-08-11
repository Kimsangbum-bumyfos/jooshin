<!DOCTYPE html>
<html lang="ko">
<head>
    <link rel="canonical" href="<?= base_url();?>home/terms/privacy" />
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
    <meta property="og:title" content="개인정보처리방침 - <?=$this->config->item('HOMEPAGE_TITLE')?>" />
    <meta property="og:site_name" content="@메이크홈" />    
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?= base_url();?>home/terms/privacy">
    <meta property="og:image" content="<?= base_url();?>uploads/thumb/th-t190315.png" />
    <meta property="og:description" content="<?=$this->config->item('META_DESC')?>" />

    <!-- Tw -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="개인정보처리방침 - <?=$this->config->item('HOMEPAGE_TITLE')?>" />
    <meta name="twitter:description" content="<?=$this->config->item('META_DESC')?>" />
    <meta name="twitter:image" content="<?= base_url();?>uploads/thumb/th-t190315.png" />
    <meta name="twitter:url" content="<?= base_url();?>home/terms/privacy" />  
    <meta name="twitter:site" content="@메이크홈" />    
    <meta name="twitter:creator" content="@메이크홈" />     

    <title>개인정보처리방침 - <?=$this->config->item('HOMEPAGE_TITLE')?></title>

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
    <div class="wrap">
        <!-- header -->
        <?php $this->load->view('home/inc/header'); ?>
        <!-- //header -->
        <!-- container -->
        <div id="skip_container" class="container">
            <section class="terms">
                <h2 class="hidden">메이크홈 개인정보처리방침</h2>
                <div class="contents-box">
                    <div class="terms-group">
                        <div class="row text-right">
                            <span class="ico-sub-back text-hidden terms-close" aria-label="닫기">닫기</span>
                        </div>
                        <div class="terms-top-title">
                            <p>개인정보 처리방침</p>
                        </div>
                        <div class="terms-box">
                            <p>('www.makehomepage.kr이하 '메이크홈')은 개인정보보호법에 따라 이용자의 개인정보 보호 및 권익을 보호하고 개인정보와 관련한 이용자의 고충을 원활하게 처리할 수 있도록 다음과 같은 처리방침을 두고 있습니다. 메이크홈은 개인정보처리방침을 개정하는 경우 웹사이트(또는 개별공지)을 통하여 공지할 것입니다.</p>
                            <div class="terms-table">
                                <table class="terms-table-list">
                                    <tbody>
                                        <tr>
                                            <th><span>목적</span></th>
                                            <th><span>항목</span></th>
                                            <th><span>보유기간</span></th>
                                        </tr>
                                        <tr>
                                            <td><span>홈페이지 회원가입 및 관리<br>재화 또는 서비스 제공</span></td>
                                            <td><span>이메일, 휴대전화번호, 비밀번호, 이름, 회사명, 대표자명, 사업자등록번호, 서비스 이용 기록, 쿠키</span></td>
                                            <td><span>회원 탈퇴 시 지체없이 파기</span></td>
                                        </tr>
                                        <tr>
                                            <td><span>서비스 이용에 관한 소식제공 활용</span></td>
                                            <td><span>이름, 이메일</span></td>
                                            <td><span>회원 탈퇴 시 지체없이 파기</span></td>
                                        </tr>
                                        <tr>
                                            <td><span>CS사무 처리</span></td>
                                            <td><span>이름, 이메일, 비밀번호, 휴대전화번호</span></td>
                                            <td><span>회원 탈퇴 시 지체없이 파기</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <p>메이크홈 서비스 제공을 위해서 필요한 최소한의 개인정보이므로 동의를 해 주셔야 서비스를 이용하실 수 있습니다. 자세한 내용은 아래 개인정보처리방침을 참조 하여 주시기 바랍니다.</p>
                            <br>
                            <p class="terms-sub">제 1 조 개인정보의 처리 목적</p>
                            <p>메이크홈은 개인정보를 다음의 목적을 위해 처리합니다. 처리한 개인정보는 다음의 목적이외의 용도로는 사용되지 않으며 이용 목적이 변경될 시에는 사전동의를 구할 예정입니다.</p>
                            <br>
                            <p>&#10112; 홈페이지 회원가입 및 관리</p>
                            <p>회원제 서비스 이용에 따른 본인확인 및 식별, 회원가입의사 확인, 회원자격 유지·관리, 만14세 미만 아동 개인정보 수집 시 법정대리인 동의 여부 확인, 각종 고지·통지, 고충처리, 분쟁 조정을 위한 기록 보존 등을 목적으로 개인정보를 처리합니다.</p>
                            <p>&#10113; CS사무 처리</p>
                            <p>문의자의 신원 확인, 문의사항 확인 및 조치를 위한 연락 · 통지, 처리결과 통보 등을 목적으로 개인정보를 처리합니다.</p>
                            <p>&#10114; 재화 또는 서비스 제공</p>
                            <p>전자세금계산서의 발행, 서비스 제공에 따른 금액 정산, 서비스 콘텐츠 제공, 서비스 부정이용 방지, 서비스 이용에 대한 통계, 회원에게 최적화된 서비스 제공, 접속 빈도 파악 등을 목적으로 개인정보를 처리합니다.</p>
                            <p>&#10115; 서비스 이용에 관한 소식제공 활용</p>
                            <p>서비스 기능 업데이트 소식 제공 등을 목적으로 개인정보를 처리합니다.</p>
                            <br>
                            <p class="terms-sub">제 2 조 개인정보 파일 현황</p>
                            <p>메이크홈은 이용자의 개인정보를 목적 달성을 위한 기간 동안에만 제한적으로 처리하고 있으며, 처리목적이 달성되면 해당 이용자의 개인정보는 지체 없이 파기됩니다.</p>
                            <br>
                            <p>1. 웹사이트 회원 가입 및 관리</p>
                            <p class="terms-indent">&#10112; 개인정보 항목 : 이메일, 휴대전화번호, 비밀번호, 이름, 회사명, 대표자명, 사업자등록번호, 서비스 이용 기록, 쿠키</p>
                            <p class="terms-indent">&#10113; 수집방법 : 회사는 온라인을 통한 회원가입, 회원정보 수정의 방법으로 개인정보를 수집하고 해당 목적을 위해서만 사용합니다.</p>
                            <p class="terms-indent">&#10114; 보유근거 : 개인정보보호 규정 및 정보통신부가 제정한 개인정보보호지침</p>
                            <p class="terms-indent">&#10115; 보유기간 : 회원 탈퇴 시 지체없이 파기</p>
                            <br>
                            <p>2. 회사 내부방침에 의한 정보보유 및 기간</p>
                            <p class="terms-indent">&#10112; 개인정보 항목 : 이름, 휴대전화번호, 이메일, 회사명, 대표자명, 사업자등록번호</p>
                            <p class="terms-indent">&#10113; 보유근거 : 서비스 이용의 혼선 방지, 부정사용 방지.</p>
                            <p class="terms-indent">&#10114; 보유기간 : 1년</p>
                            <br>
                            <p>3. 관련법령에 의한 정보보유 및 기간 : 상법, 전자상거래 등에서의 소비자보호에 관한 법률 등 관계법령의 규정에 의해 보존할 필요가 있는 경우 회사는 관계법령에서 정한 일정한 기간 동안 회원정보를 보관합니다.</p>
                            <p class="terms-indent">&#10112; 개인정보 항목 : 계약 또는 해지 등에 관한 기록</p>
                            <p class="terms-indent">&#10113; 보유근거 : 전자상거래 등에서의 소비자보호에 관한 법률</p>
                            <p class="terms-indent">&#10114; 보유기간 : 5년</p>
                            <br>
                            <p class="terms-sub">제 3 조 개인정보처리 위탁</p>
                            <br>
                            <p>&#10112; 메이크홈은 원활한 개인정보 업무처리를 위하여 다음과 같이 개인정보 처리업무를 위탁하고 있지 않습니다.</p>
                            <p>&#10113; 메이크홈은 위탁계약 체결시 개인정보 보호법 제25조에 따라 위탁업무 수행목적 외 개인정보 처리금지, 기술적․관리적 보호조치, 재위탁 제한, 수탁자에 대한 관리·감독, 손해배상 등 책임에 관한 사항을 계약서 등 문서에 명시하고, 수탁자가 개인정보를 안전하게 처리하는지를 감독하겠습니다.</p>
                            <p>&#10114; 위탁업무의 내용이나 수탁자가 변경될 경우에는 지체없이 본 개인정보 처리방침을 통하여 공개하도록 하겠습니다.</p>
                            <br>
                            <p class="terms-sub">제 4 조 정보주체의 권리,의무 및 그 행사방법 이용자는 개인정보주체로서 다음과 같은 권리를 행사할 수 있습니다.</p>
                            <br>
                            <p>1. 정보주체는 메이크홈에 대해 언제든지 다음 각 호의 개인정보 보호 관련 권리를 행사할 수 있습니다.</p>
                            <p class="terms-indent">&#10112; 개인정보 열람요구</p>
                            <p class="terms-indent">&#10113; 오류 등이 있을 경우 정정 요구</p>
                            <p class="terms-indent">&#10114; 삭제요구</p>
                            <p class="terms-indent">&#10115; 처리정지 요구</p>
                            <p>2. 제1항에 따른 권리 행사는 메이크홈에 대해 개인정보 보호법 시행규칙 별지 제8호 서식에 따라 웹사이트, 서면, 전자우편, 모사전송(FAX) 등을 통하여 하실 수 있으며 메이크홈은 이에 대해 지체 없이 조치하겠습니다.</p>
                            <p>3. 정보주체가 개인정보의 오류 등에 대한 정정 또는 삭제를 요구한 경우에는 메이크홈은 정정 또는 삭제를 완료할 때까지 당해 개인정보를 이용하거나 제공하지 않습니다.</p>
                            <p>4. 제1항에 따른 권리 행사는 정보주체의 법정대리인이나 위임을 받은 자 등 대리인을 통하여 하실 수 있습니다. 이 경우 개인정보 보호법 시행규칙 별지 제11호 서식에 따른 위임장을 제출하셔야 합니다.</p>
                            <p>5. 회사는 만 14세 미만 아동의 법정대리인의 법령 상의 권리를 보장합니다.</p>
                            <p class="terms-indent">(아동의 개인정보에 대한 열람, 정정·삭제, 개인정보처리정지요구권)</p>
                            <br>
                            <p class="terms-sub">제 5 조 처리하는 개인정보의 항목 작성</p>
                            <p>메이크홈은 다음의 개인정보 항목을 처리하고 있습니다.</p>
                            <br>
                            <p class="terms-indent">&#10112; 회원 가입 및 관리</p>
                            <p class="terms-indent-B">- 필수항목 : 이름, 이메일, 비밀번호, 서비스 이용 기록, 쿠키</p>
                            <p class="terms-indent-B">- 선택항목 : 휴대전화번호</p>
                            <p class="terms-indent">&#10113; 서비스 구매 시</p>
                            <p class="terms-indent-B">- 필수항목 : 이메일, 휴대전화번호, 비밀번호, 이름, 회사명, 대표자명, 사업자등록번호, 서비스 이용 기록, 쿠키</p>
                            <br>
                            <p class="terms-sub">제 6 조 개인정보 자동수집장치</p>
                            <p>메이크홈은 쿠키를 설치, 운영하고 있고 이용자는 이를 거부할 수 있습니다.</p>
                            <p>쿠키는 이용자에게 보다 빠르고 편리한 웹사이트 사용을 지원하고 맞춤형 서비스를 제공하기 위해 사용됩니다.</p>
                            <br>
                            <p>&#10112; 쿠키란 웹사이트를 운영하는데 이용되는 서버가 이용자의 브라우저에 보내는 아주 작은 텍스트 파일로서 이용자의 컴퓨터에 저장됩니다.</p>
                            <p>&#10113; 쿠키를 통해 이용자가 선호하는 설정 등을 저장하여 이용자에게 보다 빠른 웹 환경을 지원하며, 편리한 이용을 위해 서비스 개선에 활용합니다. 이를 통해 이용자는 보다 손쉽게 서비스를 이용할 수 있게 됩니다.</p>
                            <p>&#10114; 쿠키를 통해 이용자가 선호하는 설정 등을 저장하여 이용자에게 보다 빠른 웹 환경을 지원하며, 편리한 이용을 위해 서비스 개선에 활용합니다. 이를 통해 이용자는 보다 손쉽게 서비스를 이용할 수 있게 됩니다.</p>
                            <p>&#10115; 이용자는 쿠키 설치에 대한 선택권을 가지고 있습니다. 따라서, 이용자는 웹 브라우저에서 옵션을 설정함으로써 모든 쿠키를 허용하거나, 쿠키가 저장될 때마다 확인을 거치거나, 모든 쿠키의 저장을 거부할 수도 있습니다. 다만 쿠키 설치를 거부할 경우 웹 사용이 불편해지며 로그인이 필요한 일부 서비스 이용에 어려움이 있을 수 있습니다.</p>
                            <br>
                            <p>설정 방법의 예)</p>
                            <p class="terms-indent">1) Internet Explorer의 경우 :</p>
                            <br>
                            <p class="terms-indent">2) Chrome의 경우 :</p>
                            <p class="terms-indent">웹 브라우저 우측의 설정 메뉴 > 화면 하단의 고급 설정 표시 > 개인정보의 콘텐츠 설정 버튼 > 쿠키</p>
                            <br>
                            <p class="terms-sub">제 7 조 개인정보의 파기</p>
                            <p>메이크홈은 원칙적으로 개인정보 처리목적이 달성된 경우에는 지체없이 해당 개인정보를 파기합니다. 파기의 절차, 기한 및 방법은 다음과 같습니다.</p>
                            <p class="terms-indent">- 파기절차이용자가 입력한 정보는 목적 달성 후 별도의 DB에 옮겨져(종이의 경우 별도의 서류) 내부 방침 및 기타 관련 법령에 따라 일정기간 저장된 후 혹은 즉시 파기됩니다. 이 때, DB로 옮겨진 개인정보는 법률에 의한 경우가 아니고서는 다른 목적으로 이용되지 않습니다.</p>
                            <p class="terms-indent">- 파기기한이용자의 개인정보는 개인정보의 보유기간이 경과된 경우에는 보유기간의 종료일로부터 5일 이내에, 개인정보의 처리 목적 달성, 해당 서비스의 폐지, 사업의 종료 등 그 개인정보가 불필요하게 되었을 때에는 개인정보의 처리가 불필요한 것으로 인정되는 날로부터 5일 이내에 그 개인정보를 파기합니다.</p>
                            <p class="terms-indent">-파기방법은 전자적 파일 형태의 정보는 기록을 재생할 수 없는 기술적 방법을 사용합니다. 종이에 출력된 개인정보는 분쇄기로 분쇄하거나 소각을 통하여 파기합니다.</p>
                            <br>
                            <p class="terms-sub">제 8 조 개인정보 자동수집장치</p>
                            <p>메이크홈은 쿠키를 설치, 운영하고 있고 이용자는 이를 거부할 수 있습니다.</p>
                            <p>쿠키는 이용자에게 보다 빠르고 편리한 웹사이트 사용을 지원하고 맞춤형 서비스를 제공하기 위해 사용됩니다.</p>
                            <br>
                            <p>&#10112; 쿠키란 웹사이트를 운영하는데 이용되는 서버가 이용자의 브라우저에 보내는 아주 작은 텍스트 파일로서 이용자의 컴퓨터에 저장됩니다.</p>
                            <p>&#10113; 쿠키를 통해 이용자가 선호하는 설정 등을 저장하여 이용자에게 보다 빠른 웹 환경을 지원하며, 편리한 이용을 위해 서비스 개선에 활용합니다. 이를 통해 이용자는 보다 손쉽게 서비스를 이용할 수 있게 됩니다.</p>
                            <p>&#10114; 쿠키를 통해 이용자가 선호하는 설정 등을 저장하여 이용자에게 보다 빠른 웹 환경을 지원하며, 편리한 이용을 위해 서비스 개선에 활용합니다. 이를 통해 이용자는 보다 손쉽게 서비스를 이용할 수 있게 됩니다.</p>
                            <p>&#10115; 이용자는 쿠키 설치에 대한 선택권을 가지고 있습니다. 따라서, 이용자는 웹 브라우저에서 옵션을 설정함으로써 모든 쿠키를 허용하거나, 쿠키가 저장될 때마다 확인을 거치거나, 모든 쿠키의 저장을 거부할 수도 있습니다. 다만 쿠키 설치를 거부할 경우 웹 사용이 불편해지며 로그인이 필요한 일부 서비스 이용에 어려움이 있을 수 있습니다.</p>
                            <br>
                            <p class="terms-sub">제 9 조 만 14세 미만 아동의 개인정보보호</p>
                            <p>메이크홈은 아동의 개인정보를 보호하기 위하여, 인터넷 홈페이지에 동의 내용을 게재하고 정보주체가 동의를 받도록 하고 있습니다. 따라서 14세 미만의 아동이 회원에 가입하고자 하는 경우에는 웹사이트에서 동의를 해야 합니다.</p>
                            <br>
                            <p class="terms-sub">제 10 조 개인정보에 관한 민원서비스</p>
                            <p>메이크홈은 이용자님의 개인정보를 보호하고 개인정보와 관련한 불만을 처리하기 위하여 아래와 같이 개인정보관리책임자를 지정하고 있습니다.</p>
                            <p>개인정보 보호책임자 : 박용</p>
                            <p>이메일 : help@thefrom.kr</p>
                            <br>
                            <p>귀하께서는 회사의 서비스를 이용하시며 발생하는 모든 개인정보보호 관련 민원을 개인정보관리책임자에게 신고하실 수 있습니다. 회사는 이용자들의 신고사항에 대해 신속하게 충분한 답변을 드릴 것입니다.기타 개인정보침해에 대한 신고나 상담이 필요하신 경우에는 아래 기관에 문의하시기 바랍니다.</p>
                            <p class="terms-indent">1.개인정보보호 침해센터 (privacy.kisa.or.kr / 02-405-5118)</p>
                            <p class="terms-indent">2.정보보호마크인증위원회 (www.eprivacy.or.kr / 02-580-9531~2)</p>
                            <p class="terms-indent">3.대검찰청 사이버범죄신고 (spo.go.kr / 02-3480-2000)</p>
                            <p class="terms-indent">4.경찰청 사이버안전국 (www.ctrc.go.kr / 1566-0112)</p>
                            <br>
                            <p class="terms-sub">제 11 조 기타</p>
                            <p>홈페이지에 링크되어 있는 웹사이트들이 개인정보를 수집하는 개별적인 행위에 대해서는 본 "개인정보처리방침"이 적용되지 않음을 알려 드립니다.</p>
                            <br>
                            <p class="terms-sub">제 12 조 고지의 의무</p>
                            <p>현 개인정보처리방침의 내용이 변경될 경우에는 개정 최소 7일전부터 홈페이지의 "공지사항"을 통해 고지 하겠습니다.</p>
                        </div>
                        <div class="terms-box center">
                            <p>- 시행일자 : 2019년 03월 02일</p>
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