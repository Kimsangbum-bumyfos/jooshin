<!DOCTYPE html>
<html lang="ko">
<head>
    <link rel="canonical" href="<?= base_url();?>home/terms/allowPrivacy" />
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
    <meta property="og:url" content="<?= base_url();?>home/terms/allowPrivacy">
    <meta property="og:image" content="<?= base_url();?>uploads/thumb/th-t190315.png" />
    <meta property="og:description" content="<?=$this->config->item('META_DESC')?>" />

    <!-- Tw -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="개인정보처리방침 - <?=$this->config->item('HOMEPAGE_TITLE')?>" />
    <meta name="twitter:description" content="<?=$this->config->item('META_DESC')?>" />
    <meta name="twitter:image" content="<?= base_url();?>uploads/thumb/th-t190315.png" />
    <meta name="twitter:url" content="<?= base_url();?>home/terms/allowPrivacy" />  
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
                        <div class="terms-top-title">
                            <p>메이크홈 개인정보처리방침</p>
                        </div>
                        <div class="terms-box">
                            <p>메이크홈페이지 (이하 "메이크홈"이라 함)는 정보통신망 이용촉진 및 정보보호 등에 관한 법률, 개인 정보보호법등 정보통신서비스제공자가 준수하여야 할 관련 법령상의 개인정보보호 규정을 준수하며, 관련 법령에 의거한 개인정보처리방침을 정하여 이용자 권익 보호에 최선을 다하고 있습니다.</p>
                            <br>
                            <p>1. 개인정보의 수집 및 이용 목적</p>
                            <p>2. 개인정보의 수집항목 및 수집방법</p>
                            <p>3. 개인정보의 보유 및 이용기간</p>
                            <p>4. 개인정보의 이용 및 제3자 제공</p>
                            <p>5. 개인정보의 이용 및 처리위탁</p>
                            <p>6. 이용자의 권리 및 의무</p>
                            <p>7. 개인정보 자동 수집 장치의 운영 및 그 거부에 관한 사항</p>
                            <p>8. 개인정보의 파기 및 분리보관</p>
                            <p>9. 개인정보 보호를 위한 기술적/관리적 대책</p>
                            <p>10. 개인정보 관련 분쟁 조정</p>
                            <p>11. 개인정보 보호 책임자</p>
                            <p>12. 개인정보처리방침의 개정과 고지</p>
                            <br>
                            <p class="terms-sub">1. 개인정보의 수집 및 이용 목적</p>
                            <p>메이크홈페이지(이하 "메이크홈"이라 함)는 서비스 제공 및 개선을 위하여 아래의 목적으로만 개인 정보를 이용합니다.</p>
                            <br>
                            <p>&#10112; 홈페이지 내 자료 업로드 기능의 제공</p>
                            <p>&#10113; 이벤트 정보 및 참여기회 제공, 광고성 정보 제공 등 마케팅 및 프로모션 목적.</p>
                            <br>
                            <p class="terms-sub">2. 개인정보의 수집항목 및 수집방법</p>
                            <p>메이크홈의 개인정보 수집항목 및 수집방법은 다음과 같습니다.</p>
                            <br>
                            <p>&#10112; 수집 개인정보 – 이름, 비밀번호, 이메일 주소, 연락처</p>
                            <p>&#10113; 수집방법</p>
                            <p>a. 홈페이지, 모바일 앱, 전화, 상담 게시판, 이메일 또는 메이크홈이 개최하는 각종 이벤트나 공모전에서 동의를 구하고 최소한의 정보 수집</p>
                            <br>
                            <p class="terms-sub">3. 개인정보의 보유 및 이용기간</p>
                            <p>메이크홈의 개인정보 보유 및 이용기간은 다음과 같습니다.</p>
                            <br>
                            <p>&#10112;이벤트 경품 배송을 위한 정보는 상품수령 후 3개월까지 보관</p>
                            <p>&#10113;홈페이지 게재 정보는 운영기간 동안 보관</p>
                            <p>&#8251; 관련법령에 따라 보존되는 정보</p>
                            <div class="terms-table">
                                <table class="terms-table-list">
                                    <colgroup>
                                        <col span="1">
                                        <col style="width: 10%;">
                                    </colgroup>
                                    <tbody>
                                        <tr>
                                            <td><span>보유정보</span></td>
                                            <td><span>보유기간</span></td>
                                            <td><span>근거법령</span></td>
                                        </tr>
                                        <tr>
                                            <td><span>이용자의 불만 또는 분쟁처리에 관한 기록</span></td>
                                            <td><span>3년</span></td>
                                            <td rowspan="2"><span>전자상거래 등에서의 소비자 보호에 관한 법률</span></td>
                                        </tr>
                                        <tr>
                                            <td><span>표시, 광고에 관한 기록</span></td>
                                            <td><span>6개월</span></td>
                                        </tr>
                                        <tr>
                                            <td><span>웹 사이트 방문기록</span></td>
                                            <td><span>3개월</span></td>
                                            <td><span>통신비밀보호법</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="terms-box">
                            <p class="terms-sub">4. 개인정보의 이용 및 제3자 제공</p>
                            <p>메이크홈은 회원의 개인정보를 ‘개인정보의 수집 및 이용 목적, 수집하는 개인정보의 항목 및 수집 방법’에서 고지한 범위 내에서 이용하며, 동 범위를 초과하여 이용하거나 타인 또는 타기업, 기관에 제공하지 않습니다. 단, 회원이 사전에 동의하거나 관계법률에서 정한 절차와 방법에 따라 수사기관이 개인정보 제공을 요구하는 경우 또는 영업의 양수로 인해 부득이하게 개인정보 이전이 필요한 경우(회원 대상 사전 공지)는 별도로 제외 됩니다.</p>
                            <br>
                            <p class="terms-sub">5. 개인정보의 처리 및 위탁</p>
                            <p>메이크홈은 회원의 개인정보를 ‘개인정보의 수집 및 이용 목적, 수집하는 개인정보의 항목 및 수집 방법’에서 고지한 범위 내에서 처리하며, 타인 또는 타기업, 기관에 해당 개인정보를 위탁하지 않습니다. 단, 회원이 사전에 동의하거나 이벤트에 따른 경품발송 등 부득이하게 개인정보 이전이 필요한 경우(이용자 대상 사전 공지)는 별도로 제외 됩니다.</p>
                            <br>
                            <p class="terms-sub">6. 이용자의 권리 및 의무</p>
                            <p>&#10112; 이용자는 언제든지 개인정보의 열람, 동의철회 및 삭제를 요청할 수 있습니다.</p>
                            <p>&#10113; 이용자는 본인의 개인정보에 대해서 정정을 요청할 수 있으며, 메이크홈은 본인 확인 절차를 거쳐 즉시 조치를 취하고, 정정을 완료하기 전까지 개인정보를 이용 또는 제공하지 않습니다.</p>
                            <p>&#10114; 이용자는 자신의 개인정보를 보호할 의무를 가지며, 본인의 부주의나 인터넷 상의 문제 등으로 개인정보가 유출될 경우에는 회사가 일체의 책임을 지지 않습니다.</p>
                            <br>
                            <p class="terms-sub">7. 개인정보 자동 수집 장치의 운영 및 그 거부에 관한 사항</p>
                            <p>&#10112; 쿠키의 사용 목적</p>
                            <p>a. 회사는 개인 맞춤 서비스를 제공하기 위해서 이용자에 대한 정보를 저장하고 수시로 불러오는 '쿠키(cookie)'를 사용합니다. 쿠키는 웹사이트 서버가 이용자의 브라우저에게 전송하는 소량의 정보로서 이용자 컴퓨터의 하드디스크에 저장됩니다.</p>
                            <p>&#10113; 쿠키 설정 거부 방법</p>
                            <p>a. 이용자는 쿠키 설치에 대한 선택권을 가지고 있습니다. 따라서 이용자는 웹브라우저에서 옵션을 조정함으로써 쿠키를 허용 또는 거부하거나, 쿠키가 저장될 때마다 확인을 거칠 수 있습니다.</p>
                            <p>b. 쿠키거부(Internet Explorer) 설정은 다음과 같습니다. [도구]-[인터넷옵션]-[개인정보 탭]-[개인정보 취급수준 설정] 단, 쿠키 저장을 거부하였을 경우 서비스 제공에 어려움이 있을 수 있습니다.</p>
                            <br>
                            <p class="terms-sub">8. 개인정보의 파기 및 분리보관</p>
                            <p>메이크홈의 개인정보 파기 및 분리보관의 절차와 방법은 다음과 같습니다.</p>
                            <br>
                            <p>&#10112; 파기절차</p>
                            <p>메이크홈은 서비스에 대한 개인정보 수집 및 이용목적이 달성 된 후 해당정보를 지체없이 파기하며, 내부 방침 및 법률에 의한 경우가 아닌 경우 개인정보를 다른 목적으로 이용하지 않습니다.</p>
                            <p>&#10113; 파기방법</p>
                            <p>종이에 출력된 개인정보는 분쇄기로 분쇄하거나 소각을 통하여 파기하고 전자적 파일 형태로 저장된 개인정보는 기록을 재생할 수 없는 기술적 방법을 사용하여 삭제합니다.</p>
                            <br>
                            <p class="terms-sub">9. 개인정보 보호를 위한 기술적/관리적 대책</p>
                            <p>메이크홈은 이용자의 개인정보가 분실, 도난, 유출, 변조 또는 훼손되지 않도록 안정성 확보를 위하여 다음과 같은 기술적/관리적 대책을 강구하고 있습니다.</p>
                            <br>
                            <p>&#10112; 기술적 대책</p>
                            <p>a. 메이크홈은 개인정보를 취급함에 있어 개인정보가 분실, 도난, 유출, 변조 또는 훼손되지 않도록 안전성 확보를 위하여 다음과 같은 기술적 대책을 강구하고 있습니다.</p>
                            <p>b. 이용자의 개인정보는 비밀번호에 의해 보호되며 파일 및 전송데이터를 암호화하거나 파일 잠금기능(Lock)을 사용하여 중요한 데이터는 별도의 보안기능을 통해 보호되고 있습니다.</p>
                            <p>c. 메이크홈은 백신프로그램을 이용하여 컴퓨터바이러스에 의한 피해를 방지하기 위한 조치를 취하고 있습니다. 백신프로그램은 주기적으로 업데이트되며 갑작스런 바이러스가 출현할 경우 백신이 나오는 즉시 이를 제공함으로써 개인정보가 침해되는 것을 방지하고 있습니다.</p>
                            <p>d. 메이크홈은 암호알고리즘을 이용하여 네트워크 상의 개인정보를 안전하게 전송할 수 있는 보안장치(SSL)를 채택하고 있습니다.</p>
                            <p>e. 해킹 등 외부침입에 대비하여 침입차단시스템 등을 이용하여 보안에 만전을 기하고 있습니다.</p>
                            <p>&#10113; 관리적 대책</p>
                            <p>메이크홈은 개인정보에 대한 접근권한을 최소한의 인원으로 제한하고 있습니다. 그 최소한의 인원에 해당하는 자는 다음과 같습니다.</p>
                            <br>
                            <p>a. 이용자를 직접 상대로 하여 마케팅 업무를 수행하는 자, 개인정보 보호책임자 및 담당자 등 개인정보관리업무를 수행하는 자, 기타 업무상 개인정보의 취급이 불가피한 자.</p>
                            <p>b. 개인정보를 취급하는 직원을 대상으로 새로운 보안 기술 습득 및 개인정보 보호 의무 등에 관해 정기적인 사내 교육을 실시하고 있습니다.</p>
                            <p>c. 입사 시 개인정보 관련 취급자의 보안서약서를 통하여 사람에 의한 정보유출을 사전에 방지하고 개인정보 처리방침에 대한 이행사항 및 직원의 준수여부를 감사하기 위한 내부절차를 마련하고 있습니다.</p>
                            <p>d. 개인정보 관련 취급자의 업무 인수인계는 보안이 유지된 상태에서 철저하게 이뤄지고 있으며 입사 및 퇴사 후 개인정보 사고에 대한 책임을 명확화하고 있습니다.</p>
                            <p>e. 개인정보와 일반 데이터를 혼합하여 보관하지 않고 별도로 분리하여 보관하고 있습니다.</p>
                            <p>f. 전산실 및 자료 보관실 등을 특별 보호구역으로 설정하여 출입을 통제하고 있습니다.</p>
                            <p>g. 회사는 이용자 본인의 부주의 또는 인터넷상의 문제로 인해 발생한 개인정보 유출문제에 대해 고의, 과실이 없을 경우 책임을 지지 아니합니다. 회원 개개인이 본인의 개인정보를 보호하기 위해서 자신의 ID 와 비밀번호를 적절하게 관리하고 여기에 대한 책임을 져야 합니다.</p>
                            <p>h. 그 외 내부 관리자의 실수나 기술관리 상의 사고로 인해 개인정보의 상실, 유출, 변조, 훼손이 유발될 경우 회사는 즉각 이용자께 사실을 알리고 적절한 대책과 보상을 강구할 것입니다.</p>
                            <br>
                            <p class="terms-sub">10. 개인정보 관련 분쟁 조정</p>
                            <p>개인정보침해에 대한 분쟁이 발생한 경우 아래 기관에 문의하시기 바랍니다.</p>
                            <p>&middot; 개인정보침해신고센터: (국번없이) 118 / <a href="http://privacy.kisa.or.kr">http://privacy.kisa.or.kr</a></p>
                            <p>&middot; 대검찰청 사이버수사과: (국번없이) 1301 / <a href="www.spo.go.kr">www.spo.go.kr</a></p>
                            <p>&middot; 경찰청 사이버범죄수사단: (국번없이) 182 / <a href="www.ctrc.go.kr">www.ctrc.go.kr</a></p>
                            <br>
                            <p class="terms-sub">11. 개인정보 보호 책임자</p>
                            <p>&#10112; 메이크홈 개인정보 보호 책임자</p>
                            <p>a.성명: 김상범</p>
                            <p>b.전화: 1833-3457</p>
                            <p>&#10113; 메이크홈 개인정보 관리 담당자</p>
                            <p>a.성명: 김상범</p>
                            <p>b.전화: 1833-3457</p>
                            <p>c.이메일: help@thefrom.kr</p>
                            <br>
                            <p class="terms-sub">12. 개인정보처리방침의 개정과 고지</p>
                            <p>법률 및 지침의 변경과 메이크홈의 정책 변화에 따라 본 개인정보처리방침을 변경할 수 있으며 이를 개정하는 경우 시행일의 7일 전부터 이를 고지 또는 통지합니다.</p>
                        </div>
                        <div class="terms-box center">
                            <p>시행일자: 2019년 월 일</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>
</html>