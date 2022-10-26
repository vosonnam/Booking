$('[name="fromtime"]').change(function (e) {
	e.preventDefault();
	$('[name="totime"]').attr("min", $('[name="fromtime"]').val());
})
$('form').submit(function(e){
  	e.preventDefault();
  	var dataSend=$('form').serialize();
	dataSend+='&event=setoff';
	queryDataPostJSon("API/staff/add.php",dataSend,function (res) {
		alert(res['msg']);
		window.location.href ='manageoffdate.php';
	});
});