var parts = window.location.search.substr(1).split("&");
var $_GET = {};
for (var i = 0; i < parts.length; i++) {
    var temp = parts[i].split("=");
    $_GET[decodeURIComponent(temp[0])] = decodeURIComponent(temp[1]);
}
var book=$_GET['book'];
//SELECT MD5(`id`), `id` FROM `book` 
queryDataPostJSon("API/user/get.php",{event: 'getbooked', id : book}, function (res) {
	console.log(res);
	data=res['getbooked'];
	$('[name="bookeddate"]').val("Ngày đặt thành công: "+data['bookeddate']);
	if(data['status']){
		$('[value="1"]').attr("checked", "checked");
	}else{
		$('[value="0"]').attr("checked", "checked");
	}
	$('[name="name"]').val(data['name']);
	$('[name="phone"]').val(data['phone']);
	$('[name="bookdate"]').val(data['date']);
	editPickDate(data['date']);
	$('[name="booktime"]').val(data['time']);
});
$('form').submit(function(e){
  	e.preventDefault();
  	var dataSend=$('form').serialize();
		dataSend+="&event=editbooked&id="+book;
	queryDataPostJSon("API/user/add.php",dataSend);
});