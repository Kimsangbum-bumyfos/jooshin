<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <?php $this->load->view('home/inc/meta'); ?> 
    <title></title>
    <link rel="stylesheet" href="<?=$this->config->item('INCLUDE_HOME_DIR')?>/cscenter/css/cs-common.css">
    <link rel="stylesheet" href="<?=$this->config->item('INCLUDE_HOME_DIR')?>/css/common.css">
    <link rel="stylesheet" href="<?=$this->config->item('INCLUDE_HOME_DIR')?>/css/notosans.css">
    <script>var base_url = "<?=base_url()?>"</script>

    <script src="<?=$this->config->item('home_assets_url')?>/common/vendor/jquery/jquery-3.1.1.min.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/vendor/lazyload/lazyload.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/base.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/cscenter/js/cs.js"></script>
    <script src="<?=$this->config->item('INCLUDE_HOME_DIR')?>/js/map.js"></script>

    <!-- 구글맵 map api key = 2019/08/28 만료  -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCy5oQHGB6oLkS4pOk1cvbUu2oeseb5_gQ"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?=$this->config->item('GOOGLE_ANALYTICS_CODE')?>"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', '<?=$this->config->item('GOOGLE_ANALYTICS_CODE')?>');
    </script>
    <script>
        /**********************************************
            * 데모 버전용 스크립트
        **********************************************/
        // $(document).ready(function(){
        //     $(".btn-talk").click(function(){
        //         alert("데모 버전에서는 제공하지 않는 기능입니다.")
        //     });
        // });
    </script>
</head>
<body class="cscenter">
    <div class="cs-wrap">
        <!-- 헤더 -->
        <div class="cs-header">
            <div class="h-title">
                <h1>고객센터</h1>
                <a href="#" class="btn-close">닫기</a>
            </div>
            <div class="cs-tab">
                <ul class="clearfix">
                    <li class="active">
                        <span data-cs-form="qnaTab" class="qnaTab">FAQ</span>
                    </li>
                    <li>
                        <span data-cs-form="talkTab" class="talkTab">실시간문의</span>
                    </li>
                    <li>
                        <span data-cs-form="formTab" class="formTab">1:1문의</span>
                    </li>
                </ul>
            </div>
        </div><!-- //헤더 -->
        <!-- 바디 -->
        <div class="cs-body">
            <div id="qnaTab" class="tab-panel active">
                <div class="search-group">
                    <div class="cs-form">
                        <input type="text" id="cs-search-faq" class="" placeholder="검색어를 입력하세요">
                    </div>
                    <button type="button" id="btn-cs-search" class="btn type-a btn-search">검색</button>
                </div>
                <div class="sort-group">
                    <div class="sort-crop">
                        <span class="sort-list">
                            <a href="#" class="cs-category-item active" data-category="">전체</a>
                            <a href="#" class="cs-category-item" data-category="회원가입">회원가입</a>
                            <a href="#" class="cs-category-item" data-category="결제">결제</a>
                            <a href="#" class="cs-category-item" data-category="이용관련">이용관련</a>
                            <a href="#" class="cs-category-item" data-category="실시간예약">실시간예약</a>
                            <a href="#" class="cs-category-item" data-category="기타">기타</a>
                        </span>
                    </div>
                    <div class="sort-btn-group">
                        <a href="#" class="btn-prev text-hidden">카테고리 맨 앞 보기</a>
                        <a href="#" class="btn-next text-hidden">카테고리 맨 뒤 보기</a>
                    </div>
                </div>
                <div class="qna-group">
                    <!-- FAQ List Ajax -->
                </div>
                <div class="qna-btn">
                    <button type="button" id="more_getCsFaq" class="btn type-a btn-search">더보기</button>
                </div>
            </div>
            <div id="talkTab" class="tab-panel">
                <ul class="talk-list">
                    <li class="cs-category-item">
                        <div class="talk-desc">
                            <h3>네이버 톡톡</h3>
                            <p>친구 추가 없이 앱 설치 없이 네이버 아이디만 있으면 실시간 톡 가능<br>
                        </div>
                        <!-- onclick="javascript:window.open('https://talk.naver.com/WC11HH?ref='+encodeURIComponent(location.href), 'talktalk', 'width=471, height=640');return false;" -->
                        <a href="#" class="btn-talk naver"><span>톡톡하기</span></a>
                    </li>
                    <li class="cs-category-item">
                        <div class="talk-desc">
                            <h3>카톡 플러스친구</h3>
                            <p>카카오톡 아이디만 있으면 친구 추가 후 사용할 수 있습니다.<br>
                        </div>
                        <!-- <?=$this->config->item('SNS_KAKAOPLUS_URL')?>
                        target="_blank" 
                        페이지 내부 스크립트 => 데모버전 지원X 안내문구 있음 -->
                        <a href="#" class="btn-talk kakao"><span>카톡문의</span></a>
                    </li>
                </ul>
            </div>
            <div id="formTab" class="tab-panel">
                <input type="hidden" id="token" value="<?=$this->security->get_csrf_hash()?>">
                <form class="cs-form">
                    <input type="text" id="cs_title" placeholder="제목" class="">
                    <input type="text" id="cs_name" placeholder="이름" class="">
                    <input type="text" id="cs_phone" placeholder="연락처('-'없이 입력)" class="">
                    <input type="text" id="cs_email" placeholder="이메일" class="">
                    <textarea id="cs_contents" placeholder="문의사항을 입력하세요" class=""></textarea>
                    <div class="agreement">
                        <input type="checkbox" id="cs-agreement" class="checkbox">
                        <label for="cs-agreement" class="checkbox-desc"><span></span>개인정보취급동의</label>
                        <a href="#" id="btn_cs_detail" class="btn-detail">자세히보기</a>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn type-a form-confirm">문의하기</button>
                    </div>
                </form>
                <div class="result-panel">
                    <p class="icon"></p>
                    <p class="result-info"></p>
                    <div class="btn-group">
                        <button type="button" class="btn type-a">확인</button>
                    </div>
                </div>
            </div>
        </div><!-- //바디 -->
        <!-- 푸터 -->
        <div class="cs-footer">
            <div class="f-desc">
                <a href="tel:<?=$this->config->item('COMPANY_PHONE')?>" class="phone"><?=$this->config->item('COMPANY_PHONE')?></a>
                <p class="address"><?=$this->config->item('COMPANY_ADDR')?><?=$this->config->item('COMPANY_ADDR2')?>(<?=$this->config->item('COMPANY_ADDR_CODE')?>)</p>
            </div>
            <div class="f-btn-group">
                <a href="#" id="cs_map" class="btn-map-cs"><span>약도보기</span></a>
            </div>
        </div><!-- //푸터 -->
    </div>
    <div class="modal" id="mapPreview">
        <div class="modal-full">
            <div class="cs-modal-header">
                <div class="h-title">
                    <h1><?=$this->config->item('COMPANY_NAME')?></h1>
                    <a href="#" class="btn-close map-off">닫기</a>
                </div>
            </div>
            <div class="cs-modal-content">
                <div id="map-canvas-1" style="position: relative; width:100%;height: 100%;"></div>
            </div>
        </div>
    </div>
    <div class="modal" id="cs_detail">
        <div class="modal-full">
            <div class="cs-modal-header">
                <div class="h-title">
                    <h1></h1>
                    <a href="#" id="btn_cs_detail_close" class="btn-close" aria-label="닫기"></a>
                </div>
            </div>
            <div class="cs-modal-content">
                <h3 class="cs-detail-title privacy">개인정보 수집&middot;이용동의</h3>
                <div class="cs-detail-group">
                    <p class="detail-subinfo">※아래 주의사항을 확인해 주시기 바랍니다</p>
                    <div class="terms-box">
                            <p>('www.makehomepage.kr'이하 '메이크홈')은 개인정보보호법에 따라 이용자의 개인정보 보호 및 권익을 보호하고 개인정보와 관련한 이용자의 고충을 원활하게 처리할 수 있도록 다음과 같은 처리방침을 두고 있습니다. 메이크홈은 개인정보처리방침을 개정하는 경우 웹사이트(또는 개별공지)을 통하여 공지할 것입니다.</p>
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
                            <p class="terms-indent">&#10113; 온라인 고객문의 게시판 이용 시</p>
                            <p class="terms-indent-B">- 필수항목 : 이름, 이메일, 휴대전화번호 , 서비스 이용 기록</p>
                            <p class="terms-indent-B">- 선택항목 : 휴대전화번호</p>
                            <p class="terms-indent">&#10114; 서비스 구매 및 비회원 주문 시</p>
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


                            <p class="terms-sub">제 8 조 만 14세 미만 아동의 개인정보보호</p>
                            <p>메이크홈은 아동의 개인정보를 보호하기 위하여, 인터넷 홈페이지에 동의 내용을 게재하고 정보주체가 동의를 받도록 하고 있습니다. 따라서 14세 미만의 아동이 회원에 가입하고자 하는 경우에는 웹사이트에서 동의를 해야 합니다.</p>
                            <br>
                            <p class="terms-sub">제 9 조 개인정보의 안전성 확보 조치</p>
                            <p>메이크홈은 개인정보보호법 제29조에 따라 다음과 같이 안전성 확보에 필요한 기술적/관리적 및 물리적 조치를 하고 있습니다.</p>
                            <br>
                            <p>1. 개인정보 취급 직원의 최소화 및 교육</p>
                            <p class="terms-indent">개인정보를 취급하는 직원을 지정하고 담당자에 한정시켜 최소화 하여 개인정보를 관리하는 대책을 시행하고 있습니다.</p>
                            <p>2. 내부관리계획의 수립 및 시행</p>
                            <p class="terms-indent">개인정보의 안전한 처리를 위하여 내부관리계획을 수립하고 시행하고 있습니다.</p>
                            <p>3. 해킹 등에 대비한 기술적 대책</p>
                            <p class="terms-indent">메이크홈은 해킹이나 컴퓨터 바이러스 등에 의한 개인정보 유출 및 훼손을 막기 위하여 보안프로그램을 설치하고 주기적인 갱신 &middot; 점검을 하며 외부로부터 접근이 통제된 구역에 시스템을 설치하고 기술적/물리적으로 감시 및 차단하고 있습니다.</p>
                            <p>4. 개인정보의 암호화</p>
                            <p class="terms-indent">이용자의 개인정보는 비밀번호는 암호화 되어 저장 및 관리되고 있어, 본인만이 알 수 있으며 개인정보 전송 데이터는 암호화 등의 별도의 보안기능을 사용하고 있습니다.</p>
                            <p>5. 접속기록의 보관 및 위변조 방지</p>
                            <p class="terms-indent">별도의 접속 이력을 보관하지 않습니다.</p>
                            <br>
                            <p class="terms-sub">제 10 조 개인정보 보호책임자 작성</p>
                            <br>
                            <p>&#10112; 메이크홈은 개인정보 처리에 관한 업무를 총괄해서 책임지고, 개인정보 처리와 관련한 정보주체의 불만처리 및 피해구제 등을 위하여 아래와 같이 개인정보 보호책임자를 지정하고 있습니다.</p>
                            <br>
                            <p>▶  개인정보 보호책임자</p>
                            <br>
                            <p>성명 : 김상범</p>
                            <p>소속 : 프롬티어 주식회사 대표</p>
                            <p>연락처 : 1833-3457, help@thefrom.kr</p>
                            <p>※ 개인정보 보호 담당부서로 연결됩니다</p>
                            <br>
                            <p>▶ 개인정보 보호담당자</p>
                            <br>
                            <p>성명 : 박용</p>
                            <p>소속 : 프롬티어 주식회사 팀장</p>
                            <p>연락처 : 1833-3457, help@thefrom.kr</p>
                            <p>※ 개인정보 보호 담당부서로 연결됩니다</p>
                            <br>
                            <p>&#10113; 정보주체께서는 메이크홈의 서비스(또는 사업)을 이용하시면서 발생한 모든 개인정보 보호 관련 문의, 불만처리, 피해구제 등에 관한 사항을 개인정보 보호책임자 및 담당부서로 문의하실 수 있습니다. 메이크홈은 정보주체의 문의에 대해 지체 없이 답변 및 처리해드릴 것입니다.</p>
                            <p>&#10114; 기타 개인정보침해에 대한 신고나 상담이 필요하신 경우에는 아래 기관에 문의하시기 바랍니다.</p>
                            <p>개인정보침해신고센터 : 118 (privacy.kisa.or.kr)</p>
                            <p>대검찰청 첨단범죄수사과 : 02-3480-2000 (www.spo.go.kr)</p>
                            <p>경찰청 사이버안전국 : 182 (cyberbureau.police.go.kr)</p>
                            <br>
                            <p class="terms-sub">제 11 조 개인정보 처리방침 변경</p>
                            <p>이 개인정보처리방침은 시행일로부터 적용되며, 법령 및 방침에 따른 변경내용의 추가, 삭제 및 정정이 있는 경우에는 변경사항의 시행 7일 전부터 공지사항을 통하여 고지할 것입니다.</p>
                            <br>
                            <p class="terms-sub">부칙</p>
                            <p>본 개인정보 처리방침은 2019년 3월 2일부터 적용됩니다.</p>
                        </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>
<script>
$(document).on('click','#cs_map', function(){
    $('#mapPreview').addClass('active');
    $('#mapPreview').css({'display':'block'});
    linkClicks('고객센터', '약도보기클릭', '고객센터하단 약도보기 클릭'); // 통계

    markerData = {address:'<?=$this->config->item('COMPANY_ADDR')?><?=$this->config->item('COMPANY_ADDR2')?>(<?=$this->config->item('COMPANY_ADDR_CODE')?>)' , name: '<?=$this->config->item('COMPANY_NAME')?>', tel:'<?=$this->config->item('COMPANY_PHONE')?>', index:'0'};
    initialize();
});

$(document).on('click','.map-off', function(){
    $('#mapPreview').removeClass('active');
    $('#mapPreview').css({'display':'none'});
});
</script>
</html>
