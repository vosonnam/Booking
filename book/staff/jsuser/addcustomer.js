$('form').submit(function(e){
  e.preventDefault();
  var dataSend=$('form').serialize();
	dataSend+='&event=customer';
	console.log(dataSend);
	queryDataPostJSon("API/staff/add.php",dataSend,function (res) {
		alert(res['msg']);
        window.location.href ='addcustomer.php';
	});
});