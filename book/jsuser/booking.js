function queryDataPostJSon(url,dataSend,callback){
    $.ajax({
        type: 'POST',
        url: url,
        data: dataSend,
        async: true,
        dataType: 'JSON',
        success: callback
    });
}
var currentDay=(new Date()).toISOString();
currentDay=currentDay.slice(0, 10);
$('[name="bookdate"]').attr("min",currentDay);
$('[name="bookdate"]').val(currentDay);
editPickDate(currentDay);
$('[name="bookdate"]').change(function (e) {
	e.preventDefault();
	editPickDate($(this).val());
})
$('form').submit(function(e){
	e.preventDefault();
	var dataSend=$('form').serialize();
	dataSend+='&event=booking';
	queryDataPostJSon("API/user/add.php",dataSend,function (res) {
		if(res['booking']==1){
			alert(res['msg']);
			var phone=$('[name="phone"]').val();
			queryDataPostJSon("API/SMS/index.php",{event: 1, phone: phone},function (ressms) {
				alert(ressms['msg']);
				window.location.href ='booking.php';
			});
            // window.location.href ='booking.php';
		}else{
			alert(res['msg']);
		}
	});
});