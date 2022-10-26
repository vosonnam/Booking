queryDataPostJSon("API/staff/accout.php",{event: 'gettxt'},function (res) {
	$('[name="txtemail"]').text(res.gettxt.txtemail);
	if(res.gettxt.useemail==1){
		$('[value="1"]').attr("checked", "checked");
	}else{
		$('[value="0"]').attr("checked", "checked");
	}
});
$('form').submit(function(e){
	e.preventDefault();
	var dataSend=$('form').serialize();
	dataSend+='&event=edittxt';
	queryDataPostJSon("API/staff/accout.php",dataSend, function (res) {
		if(res['edittxt']==1){
			alert(res['msg']);
            window.location.href ='edittxt.php';
		}else{
			alert(res['msg']);
		}
	});
});