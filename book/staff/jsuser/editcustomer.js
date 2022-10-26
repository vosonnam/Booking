function getCustomerId() {
  data=sessionStorage.getItem("customer");
  if(data==null){
    window.history.back();
  }
  return data;
}
var  localData=getCustomerId();
queryDataPostJSon("API/staff/get.php",{event: 'getcustomer', id : localData}, function (res) {
	data=res['getcustomer'];
	if(data['gender']=='M'){
		$('[value="M"]').attr("checked", "checked");
	}else{
		$('[value="F"]').attr("checked", "checked");
	}
	$('[name="name"]').val(data['name']);
	$('[name="phone"]').val(data['phone']);
	$('[name="email"]').val(data['email']);
	$('[name="birthday"]').val(data['birthday']);
});
$('form').submit(function(e){
  	e.preventDefault();
  	var dataSend=$('form').serialize();
		dataSend+="&event=editcustomer&id="+localData;
	queryDataPostJSon("API/staff/add.php",dataSend,function (res) {
		alert(res['msg']);
		sessionStorage.removeItem('customer');
        window.location.href ='managecustomer.php';
	});
});