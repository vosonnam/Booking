<?php
require("SpeedSMSAPI.php");
require("TwoFactorAPI.php");
// $token="HVbE2h7xbdBd8PA3FKyRSkf0K-meweF9";
// $sender="4cad17254f7c8de7";
function getUserInfo() {
    $sms = new SpeedSMSAPI("HVbE2h7xbdBd8PA3FKyRSkf0K-meweF9");
    $userInfo = $sms->getUserInfo();
    var_dump($userInfo);
}

function sendSMS($phone, $content) {
    $sms = new SpeedSMSAPI("HVbE2h7xbdBd8PA3FKyRSkf0K-meweF9");
    $return = $sms->sendSMS([$phone], $content, SpeedSMSAPI::SMS_TYPE_CSKH, "4cad17254f7c8de7");
    var_dump($return);
}

//$content contain OTP conde only
function sendVoiceOTP($phone, $content) {
    $sms = new SpeedSMSAPI("HVbE2h7xbdBd8PA3FKyRSkf0K-meweF9");
    $return = $sms->sendVoice($phone, $content);
    var_dump($return);
}

function createPIN($phone, $content, $appId) {
    $twoFA = new TwoFactorAPI("HVbE2h7xbdBd8PA3FKyRSkf0K-meweF9");
    $result = $twoFA->pinCreate($phone, $content, $appId);
    var_dump($result);

}

function verifyPIN($phone, $pinCode, $appId) {
    $twoFA = new TwoFactorAPI("HVbE2h7xbdBd8PA3FKyRSkf0K-meweF9");
    $result = $twoFA->pinVerify($phone, $pinCode, $appId);
    var_dump($result);
}

function sendMMS($phone, $content, $link) {
    $sms = new SpeedSMSAPI("HVbE2h7xbdBd8PA3FKyRSkf0K-meweF9");
    $return = $sms->sendMMS([$phone], $content, $link, "4cad17254f7c8de7");
    var_dump($return);
}

function getAPI($key) {
    return isset($_GET[$key])? $_GET[$key]:"";
}
function postAPI($key) {
    return isset($_POST[$key])? $_POST[$key]:"";
}
//using send voice OTP
//sendVoiceOTP("849xxxxx", "1234");
// sendSMS(["0965276269"],"hi thằng chó");
// getUserInfo();
$event=getAPI("event");
switch ($event) {
    case '0':
        getUserInfo();
        break;
    case '1':
        $phone=$_GET['phone'];
        $sms=$_GET['sms'];
        sendSMS($phone,$sms);
        break;
    
    default:
        echo "Chọn thao tác để thực hiện";
        break;
}
?>