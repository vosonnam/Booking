<?php
require_once("../server.php");
require("SpeedSMSAPI.php");
require("TwoFactorAPI.php");
function getUserInfo() {
    $sms = new SpeedSMSAPI("x39j497vQ62Fb9FnuU9foIUzuaxWYgTt");
    $userInfo = $sms->getUserInfo();
    var_dump($userInfo);
}

function sendSMS($phone, $content) {
    $sms = new SpeedSMSAPI("x39j497vQ62Fb9FnuU9foIUzuaxWYgTt");
    $return = $sms->sendSMS([$phone], $content, SpeedSMSAPI::SMS_TYPE_CSKH, "da9e03f8eda4b06d");
    // var_dump($return);
    return ($return['status']==='success')?1:0;
}

//$content contain OTP conde only
function sendVoiceOTP($phone, $content) {
    $sms = new SpeedSMSAPI("x39j497vQ62Fb9FnuU9foIUzuaxWYgTt");
    $return = $sms->sendVoice($phone, $content);
    var_dump($return);
}

function createPIN($phone, $content, $appId) {
    $twoFA = new TwoFactorAPI("x39j497vQ62Fb9FnuU9foIUzuaxWYgTt");
    $result = $twoFA->pinCreate($phone, $content, $appId);
    var_dump($result);

}

function verifyPIN($phone, $pinCode, $appId) {
    $twoFA = new TwoFactorAPI("x39j497vQ62Fb9FnuU9foIUzuaxWYgTt");
    $result = $twoFA->pinVerify($phone, $pinCode, $appId);
    var_dump($result);
}

function sendMMS($phone, $content, $link) {
    $sms = new SpeedSMSAPI("x39j497vQ62Fb9FnuU9foIUzuaxWYgTt");
    $return = $sms->sendMMS([$phone], $content, $link, "da9e03f8eda4b06d");
    var_dump($return);
}

function getAPI($key) {
    return isset($_GET[$key])? $_GET[$key]:"";
}
function postAPI($key) {
    return isset($_POST[$key])? $_POST[$key]:"";
}
$event=postAPI("event");
// $event=getAPI("event");
switch ($event) {
    case '0':
        getUserInfo();
        break;
    case '1':
        $phone=postAPI('phone');
        $sql=mysqli_query($conn,"SELECT * FROM `user` WHERE `usesms`=1");
        $row=mysqli_fetch_array($sql);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $currentDate=date("Y/m/d h:i:sa");
        $txt="5 SECOND SALON\n"
            ."Lịch hẹn đặt thành công lúc: \"$currentDate\"\n"
            ."Mọi thông tin chi tiết tại Email đã đăng ký.";
        ob_end_clean();
        if($row>0){
            if(sendSMS($phone,$txt)){
                $jsonData['status']=1;
            }else{
                $jsonData['status']=0;
            }
        }else{
            $jsonData['status']=0;
            $jsonData['msg']="Điều kiện gửi không thoả";
        }
        echo json_encode($jsonData);
        break;
    
    default:
        echo "Chọn thao tác để thực hiện";
        break;
}
mysqli_close($conn);
?>