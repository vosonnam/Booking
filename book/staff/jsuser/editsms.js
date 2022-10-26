queryDataPostJSon("API/staff/accout.php",{event: 'getsms'},function (res) {
	$('[name="txtsms"]').text(res.getsms.txtsms);
	if(res.getsms.usesms==1){
		$('[value="1"]').attr("checked", "checked");
	}else{
		$('[value="0"]').attr("checked", "checked");
	}
});
$('form').submit(function(e){
	e.preventDefault();
	var dataSend=$('form').serialize();
	dataSend+='&event=editsms';
	queryDataPostJSon("API/staff/accout.php",dataSend,function (res) {
		if(res['editsms']==1){
			alert(res['msg']);
            window.location.href ='editsms.php';
		}else{
			alert(res['msg']);
		}
	});
});