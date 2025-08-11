<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sms
{
    private $api_key;
    private $api_secret;
    private $kakao_sender_key;
    public $CI;

    function __construct() {
        $this->CI =& get_instance();
        $this->CI->config->load('setting');
        $this->api_key = $this->CI->config->item('SMS_API_KEY');
        $this->api_secret = $this->CI->config->item('SMS_API_SECRET');
        $this->kakao_sender_key = $this->CI->config->item("KAKAO_SENDER_KEY");
    }
    function sendSimpleMessage($arr) {
        $url = "https://rest.coolsms.co.kr/messages/v4/send";
        $fields = new stdClass();
        $message = new stdClass();
        $kakao_option = new stdClass();

        $kakao_option->senderKey = $this->kakao_sender_key;
        $kakao_option->templateCode = $arr['kakao_template'];
        if($arr['kakao_button_name']) $kakao_option->buttonName = $arr['kakao_button_name'];
        if($arr['kakao_button_url']) $kakao_option->buttonUrl = $arr['kakao_button_url'];
        $message->kakaoOptions = $kakao_option;

        $message->text = $arr['text'];
        $message->to = $arr['to'];
        $message->from = $arr['from'];
        $message->type = $arr['type'];

        $fields->message = $message;
        $fields_string = json_encode($fields);
        $fields_string_log = json_encode($fields,JSON_UNESCAPED_UNICODE);

        $result = $this->runCurl($url, $fields_string);

        if($result) {
            log_message('LOG', 'SMS 전송요청 통신 성공'.$fields_string_log);
            //DB 저장 시작
            if(isset($result->errorCode)) {
                log_message('LOG', 'SMS 전송 실패' . $fields_string_log);
                $insert_arr = array(
                    'message_text' => $arr['text'],
                    'to' => $arr['to'],
                    'from' => $arr['from'],
                    'type' => $arr['type'],
                    'kakao_template' => $arr['kakao_template'],
                    'kakao_button_name' => $arr['kakao_button_name'],
                    'kakao_button_url' => $arr['kakao_button_url'],
                    'error_code' => $result->errorCode,
                    'error_message' => $result->errorMessage,
                    'created_at' => date('Y-m-d H:i:s')
                );
            }else {
                log_message('LOG', 'SMS 전송 성공' . $fields_string_log);
                $insert_arr = array(
                    'group_id' => $result->groupId,
                    'message_id' => $result->messageId,
                    'message_text' => $arr['text'],
                    'to' => $result->to,
                    'from' => $result->from,
                    'type' => $result->type,
                    'kakao_template' => $arr['kakao_template'],
                    'kakao_button_name' => $arr['kakao_button_name'],
                    'kakao_button_url' => $arr['kakao_button_url'],
                    'status_code' => $result->statusCode,
                    'status_message' => $result->statusMessage,
                    'country' => $result->country,
                    'account_id' => $result->accountId,
                    'created_at' => date('Y-m-d H:i:s')
                );
            }
            $this->CI->load->model('sms_m');
            $result = $this->CI->sms_m->insert($insert_arr);
           

            if(!$result) log_message('LOG', 'SMS 전송요청 후 DB저장 실패'.$fields_string_log);
            else log_message('LOG', 'SMS 전송요청 DB저장 성공'.$fields_string_log);
        }else {
            log_message('LOG', 'SMS 전송요청 통신 실패'.$fields_string_log);
        }

    }

    //sms,lms만 보내는 모듈이 필요해서 추가(2019-05-25)
    function sendSimpleSms($arr) {
        $url = "https://rest.coolsms.co.kr/messages/v4/send";
        $fields = new stdClass();
        $message = new stdClass();
        $kakao_option = new stdClass();

        $message->text = $arr['text'];
        $message->subject = $arr['subject'];
        $message->to = $arr['to'];
        $message->from = $arr['from'];
        $message->type = $arr['type'];

        $fields->message = $message;
        $fields_string = json_encode($fields);
        $fields_string_log = json_encode($fields,JSON_UNESCAPED_UNICODE);

        $result = $this->runCurl($url, $fields_string);

        if($result) {
            log_message('LOG', 'SMS 전송요청 통신 성공'.$fields_string_log);
            //DB 저장 시작
            if(isset($result->errorCode)) {
                log_message('LOG', 'SMS 전송 실패' . $fields_string_log);
                $insert_arr = array(
                    'message_text' => $arr['text'],
                    'to' => $arr['to'],
                    'from' => $arr['from'],
                    'type' => $arr['type'],
                    'kakao_template' => '',
                    'kakao_button_name' => '',
                    'kakao_button_url' => '',
                    'error_code' => $result->errorCode,
                    'error_message' => $result->errorMessage,
                    'created_at' => date('Y-m-d H:i:s')
                );
            }else {
                log_message('LOG', 'SMS 전송 성공' . $fields_string_log);
                $insert_arr = array(
                    'group_id' => $result->groupId,
                    'message_id' => $result->messageId,
                    'message_text' => $arr['text'],
                    'to' => $result->to,
                    'from' => $result->from,
                    'type' => $result->type,
                     'kakao_template' => '',
                    'kakao_button_name' => '',
                    'kakao_button_url' => '',
                    'status_code' => $result->statusCode,
                    'status_message' => $result->statusMessage,
                    'country' => $result->country,
                    'account_id' => $result->accountId,
                    'created_at' => date('Y-m-d H:i:s')
                );
            }
            $this->CI->load->model('sms_m');
            $result = $this->CI->sms_m->insert($insert_arr);
           

            if(!$result) log_message('LOG', 'SMS 전송요청 후 DB저장 실패'.$fields_string_log);
            else log_message('LOG', 'SMS 전송요청 DB저장 성공'.$fields_string_log);
        }else {
            log_message('LOG', 'SMS 전송요청 통신 실패'.$fields_string_log);
        }

    }

    function reSendSimpleMessage($data) {
        $url = "https://rest.coolsms.co.kr/messages/v4/send";
        $fields = new stdClass();
        $message = new stdClass();
        $kakao_option = new stdClass();

        $kakao_option->senderKey = $this->kakao_sender_key;
        $kakao_option->templateCode = $data->kakao_template;
        if(isset($data->kakao_button_name)) $kakao_option->buttonName = $data->kakao_button_name;
        if(isset($data->kakao_button_url)) $kakao_option->buttonUrl = $data->kakao_button_url;
        $message->kakaoOptions = $kakao_option;

        $message->text = $data->message_text;
        $message->to = $data->to;
        $message->from = $data->from;
        $message->type = $data->type;

        $fields->message = $message;
        $fields_string = json_encode($fields);
        $fields_string_log = json_encode($fields,JSON_UNESCAPED_UNICODE);

        $result = $this->runCurl($url, $fields_string);

        if($result) {
            log_message('LOG', 'SMS 재전송요청 통신 성공' . $fields_string_log);
            //DB 저장 시작
            if (isset($result->errorCode)) {
                log_message('LOG', 'SMS 재전송 실패' . $fields_string_log);
                $update_arr = array(
                    'error_code' => $result->errorCode,
                    'error_message' => $result->errorMessage,
                    'updated_at' => date('Y-m-d H:i:s')
                );
            } else {
                log_message('LOG', 'SMS 재전송 성공' . $fields_string_log);
                $update_arr = array(
                    'group_id' => $result->groupId,
                    'message_id' => $result->messageId,
                    'status_code' => $result->statusCode,
                    'status_message' => $result->statusMessage,
                    'type' => $result->type,
                    'kakao_template' => $data->kakao_template,
                    'kakao_button_name' => $data->kakao_button_name,
                    'kakao_button_url' => $data->kakao_button_url,
                    'country' => $result->country,
                    'account_id' => $result->accountId,
                    'error_code' => NULL,
                    'error_message' => NULL,
                    'updated_at' => date('Y-m-d H:i:s')
                );
            }
            $this->CI->load->model('sms_m');
            $result = $this->CI->sms_m->edit($update_arr, $data->idx);
            if(!$result) log_message('LOG', 'SMS 전송요청 후 DB저장 실패'.$fields_string_log);
            else log_message('LOG', 'SMS 전송요청 DB저장 성공'.$fields_string_log);
        }else {
            log_message('LOG', 'SMS 전송요청 통신 실패'.$fields_string_log);
        }

    }
    function getBalance() {
        $url = "https://rest.coolsms.co.kr/cash/v1/balance";
        $result = $this->runCurl($url, '', FALSE);
        return $result;
    }

    function runCurl($url, $fields_string, $post = 1) {
        date_default_timezone_set('Asia/Seoul');
        $date = date('Y-m-d\TH:i:s.Z\Z', time());  // date must be ISO 8361 format
        $salt = uniqid(); // Any random strings with [0-9a-zA-Z]
        $signature = hash_hmac('sha256', $date.$salt, $this->api_secret);

        $header = "Authorization: HMAC-SHA256 apiKey={$this->api_key}, date={$date}, salt={$salt}, signature={$signature}";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array($header, "Content-Type: application/json; charset=utf-8"));
        if($post) {
            curl_setopt($ch, CURLOPT_POST, $post);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        $result = iconv("UTF-8", "UTF-8", $result);

        return json_decode($result);
    }

}