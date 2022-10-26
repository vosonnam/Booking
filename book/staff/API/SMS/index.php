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
        $id=postAPI('id');
        // $id=getAPI('id');
        $sql=mysqli_query($conn,"SELECT user.txtsms, book.phone, book.date, book.time FROM user JOIN book ON book.id='$id' AND book.status=1 AND book.fbsms=0 AND user.usesms=1");
        $row=mysqli_fetch_array($sql);
        $phone=$row['phone'];
        $bookdate=$row['date']." ".$row['time'];
        $sms=$row['txtsms'];
        $txt="5 SECOND SALON\n"
            ."Quý khách có hẹn lúc: \"$bookdate\"\n"
            ."Thông Báo: $sms";
        ob_end_clean();
        if($row>0){
            if(sendSMS($phone,$txt)){
                mysqli_query($conn,"UPDATE `book` SET `fbsms`='1' WHERE `id`='$id'");
                $jsonData['status']=1;
                $jsonData['msg']="SMS nhắc hẹn đã gửi";
            }else{
                $jsonData['status']=0;
                $jsonData['msg']="SMS nhắc hẹn gửi không thành công";
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