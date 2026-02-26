<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// CMS setting 값 불러오기
$CI = & get_instance();
$CI->load->model('admin/setting_m');
$result = $CI->setting_m->getData();
$cnt = count($result);
$setting_data = array();

for($i=0;$i<$cnt;$i++) {
    $setting_data[$result[$i]->k] = $result[$i]->v;
}

$config['PROJECT_PATH']             = '';

//HOMEPAGE 기본 설정 관리
$config['LANG']                     = 'ko';
$config['COMPANY_NAME']             = @$setting_data['com_name'] ? $setting_data['com_name'] : '';
$config['COMPANY_ADDR_CODE']        = @$setting_data['company_addr_code'] ? $setting_data['company_addr_code'] : '';
$config['COMPANY_ADDR']             = @$setting_data['company_addr'] ? $setting_data['company_addr'] : '';
$config['COMPANY_ADDR2']            = @$setting_data['company_addr2'] ? $setting_data['company_addr2'] : '';
$config['COMPANY_PHONE']            = @$setting_data['company_phone'] ? $setting_data['company_phone'] : '';
$config['COMPANY_FAX']            = @$setting_data['company_fax'] ? $setting_data['company_fax'] : '';
$config['CEO_NAME']                 = @$setting_data['ceo_name'] ? $setting_data['ceo_name'] : '';
$config['COMPANY_REG_NO']           = @$setting_data['company_reg_no'] ? $setting_data['company_reg_no'] : '';
$config['MAIL_ORDER_SALES_REPORT_NO'] = @$setting_data['mail_order_sales_report_no'] ? $setting_data['mail_order_sales_report_no'] : '';
$config['PRIVACY_MGR']              = @$setting_data['privacy_mgr'] ? $setting_data['privacy_mgr'] : '';
$config['COPYRIGHT']                = @$setting_data['copyright'] ? $setting_data['copyright'] : '';
$config['HOMEPAGE_TITLE']           = @$setting_data['site_name'] ? $setting_data['site_name'] : '';
$config['META_DESC']                = @$setting_data['site_contents'] ? $setting_data['site_contents'] : '';
$config['META_KEYWORDS']            = @$setting_data['site_keyword'] ? $setting_data['site_keyword'] : '';
$config['COMPANY_EMAIL']            = @$setting_data['company_email'] ? $setting_data['company_email'] : '';
$config['SITE_LOGO_PC']             = @$setting_data['logo_pc'] ? $setting_data['logo_pc'] : '';
$config['SITE_LOGO_PC_SUB']         = @$setting_data['logo_pc_sub'] ? $setting_data['logo_pc_sub'] : '';
$config['SITE_LOGO_MOBILE']         = @$setting_data['logo_mobile'] ? $setting_data['logo_mobile'] : '';
$config['SITE_LOGO_PC_FOOTER']      = @$setting_data['logo_pc_footer'] ? $setting_data['logo_pc_footer'] : '';

//api setting
$config['GOOGLE_WEB_CODE']          = @$setting_data['google_web_code'] ? $setting_data['google_web_code'] : '';
$config['GOOGLE_ANALYTICS_CODE']    = @$setting_data['google_analytics_code'] ? $setting_data['google_analytics_code'] : '';
$config['GOOGLE_ADS_CODE']          = @$setting_data['google_ads_code'] ? $setting_data['google_ads_code'] : '';
$config['GOOGLE_CLIENT_ID']         = @$setting_data['google_client_id'] ? $setting_data['google_client_id'] : '';
$config['NAVER_ANALYTICS_CODE']     = @$setting_data['naver_analytics_code'] ? $setting_data['naver_analytics_code'] : '';
$config['NAVER_WEB_CODE']           = @$setting_data['naver_web_code'] ? $setting_data['naver_web_code'] : '';
$config['NAVER_CLIENT_ID']          = @$setting_data['naver_client_id'] ? $setting_data['naver_client_id'] : '';
$config['NAVER_CLIENT_SECRET']      = @$setting_data['naver_client_secret'] ? $setting_data['naver_client_secret'] : '';
//sms setting
$config['SMS_API_KEY']              = @$setting_data['sms_api_key'] ? $setting_data['sms_api_key'] : '';
$config['SMS_API_SECRET']           = @$setting_data['sms_api_secret'] ? $setting_data['sms_api_secret'] : '';
$config['KAKAO_SENDER_KEY']         = @$setting_data['sms_kakao_sender_key'] ? $setting_data['sms_kakao_sender_key'] : '';
$config['SMS_SEND_NUMBER_ADMIN']    = @$setting_data['sms_admin_sender_number'] ? $setting_data['sms_admin_sender_number'] : '';
$config['SMS_RECEIVE_NUMBER_ADMIN'] = @$setting_data['sms_admin_receiver_number'] ? $setting_data['sms_admin_receiver_number'] : '';
$config['SMS_TYPE'] = 'ATA';
//sns api key setting
$config['FB_APP_ID']                = @$setting_data['fb_app_id'] ? $setting_data['fb_app_id'] : '';
$config['KAKAO_JS_KEY']             = @$setting_data['kakao_js_key'] ? $setting_data['kakao_js_key'] : '';

//sns url setting...
$config['SNS_NAVERTV_URL']          = @$setting_data['sns_navertv_url'] ? $setting_data['sns_navertv_url'] : '';
$config['SNS_NAVERBLOG_URL']        = @$setting_data['sns_naverblog_url'] ? $setting_data['sns_naverblog_url'] : '';
$config['SNS_FB_URL']               = @$setting_data['sns_fb_url'] ? $setting_data['sns_fb_url'] : '';
$config['SNS_YOUTUBE_URL']          = @$setting_data['sns_youtube_url'] ? $setting_data['sns_youtube_url'] : '';
$config['SNS_INSTA_URL']            = @$setting_data['sns_insta_url'] ? $setting_data['sns_insta_url'] : '';
$config['SNS_KAKAOSTORY_URL']       = @$setting_data['sns_kakaostory_url'] ? $setting_data['sns_kakaostory_url'] : '';
$config['SNS_KAKAOPLUS_URL']        = @$setting_data['sns_kakaoplus_url'] ? $setting_data['sns_kakaoplus_url'] : '';
$config['SNS_NAVERTALK_URL']        = @$setting_data['sns_navertalk_url'] ? $setting_data['sns_navertalk_url'] : '';

//sns id setting..
$config['SNS_KAKAO_ID']             = @$setting_data['sns_kakao_id'] ? $setting_data['sns_kakao_id'] : '';
$config['SNS_KAKAOPLUS_ID']         = @$setting_data['sns_kakaoplus_id'] ? $setting_data['sns_kakaoplus_id'] : '';
$config['SNS_NAVERTALK_ID']         = @$setting_data['sns_navertalk_id'] ? $setting_data['sns_navertalk_id'] : '';


$config['ADMIN_COPYRIGHT'] = '2020 JOOSHIN Admin Dashboard';
$config['NEWSLETTER_URL'] = 'http://127.0.0.1/admin/newsletter';
$config['ADMIN_BASE_URL'] = base_url().'admin';

//DOC DIRECTORY 관리

$config['UPLOAD_DIR'] = base_url().'uploads';
$config['ADMIN_ROOT'] = base_url().'admin';
//$config['INCLUDE_DIR'] = '/assets/global';
$config['home_assets_url'] = base_url().'assets';
//$config['INCLUDE_MANUAL'] = '/assets/manual';
$config['INCLUDE_HOME_DIR'] = base_url().'assets/home';

//admin 로그인 시 초기 메뉴 설정
$config['ADMIN_LOGIN_INDEX'] = base_url().'admin/customer/inquire';

//upload directory..
$config['UPLOAD_CAR'] = '/uploads/car';
$config['UPLOAD_POPUP'] = '/uploads/popup';
$config['UPLOAD_MAIN_SLIDE'] = '/uploads/main_slide';
$config['UPLOAD_BRANCH'] = '/uploads/branch';
$config['UPLOAD_LOGO'] = '/uploads/logo';
$config['UPLOAD_NOTICE'] = '/uploads/notice';
$config['UPLOAD_MENU'] = '/uploads/menu';
$config['UPLOAD_POSTS'] = '/uploads/posts';
$config['UPLOAD_PRODUCTS'] = '/uploads/products';
$config['UPLOAD_SERVICES'] = '/uploads/services';
$config['UPLOAD_GALLERY'] = '/uploads/board';
$config['UPLOAD_EVENT'] = '/uploads/event';
$config['UPLOAD_PENSION'] = '/uploads/pension';

//ADMIN MAIN MENU 관리
$config['Inquire'] = '고객문의관리';

$config['content'] = '메인관리';
	$config['popup'] = '팝업관리';
	$config['mainSlide'] = '메인슬라이드관리';

$config['posts'] = '메뉴콘텐츠관리';

$config['board'] = '게시판관리';
	$config['faq'] = 'FAQ';
	$config['notice'] = '공지사항관리';
	$config['gallery'] = '갤러리관리';
	$config['event'] = '이벤트관리';

// 세인테크
$config['products'] = '제품관리';

$config['services'] = '시험및용역관리';

$config['pension_reservation'] = '실시간예약관리';

$config['pension'] = '팬션관리';
	$config['pension_room'] = '객실관리';
	$config['pension_info'] = '기본정보관리';
	$config['pension_option'] = '부가서비스관리';
	$config['pension_holiday'] = '휴무일관리';
	$config['pension_peak'] = '성수기관리';

$config['super'] = '관리자관리';
$config['sms'] = '문자발송관리';
$config['stats'] = '통계관리';

$config['setting'] = '환경설정';
	$config['basic_setting'] = '기본정보설정';
	$config['api_setting'] = 'API설정';
	$config['sns_setting'] = 'SNS설정';
	$config['cms_setting'] = 'CMS설정';
	$config['menu_setting'] = '메뉴설정';


$config['branch'] = '지점관리';
$config['shop'] = '쇼핑몰관리';

//회원관리
$config['member'] = '회원관리';
$config['member'] = '회원관리';
$config['member_setting'] = '회원환경설정';

//팬션 예약 시 가능한 날짜 범위, 최대 일수 셋팅
$config['RESERVE_MAX_RANGE'] = '30';
$config['RESERVE_MAX_DAY'] = '7';