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
function setTimePick(val) {
	var html="";
	for(i in val){
		html+='<option value="{val}">{val}</option>'.replace(/{val}/g,val[i]);
	}
	$('#timepick').html(html);
}
function editPickDate(day) {
	queryDataPostJSon("API/user/get.php",{event: 'getoffdate',bookdate: day}, function (res) {
		var date = new Date(day);
		var timeWork=["7:00","7:30","8:00","8:30","9:00",
					"9:30","10:00","10:30","11:00","11:30",
					"12:00","12:30","13:00","13:30","14:00",
					"14:30","15:00","15:30","16:00","16:30",
					"17:00","17:30","18:00"];
		var setWork=[];
		var strDate=date.toISOString();
		strDate=strDate.slice(0, 10);
		for(i in timeWork){
			const strCheckDate=strDate+" "+timeWork[i];
			var CheckDate=new Date(strCheckDate).valueOf();
			var data=res['getoffdate'];
			var isadd=true;
			for (row in data){
				var item=data[row];
				var fromDate=new Date(item.fromtime).valueOf();
				var toDate=new Date(item.totime).valueOf();
				isadd=isadd && (!(fromDate<=CheckDate && CheckDate<=toDate));
			}
			if(isadd)setWork.push(timeWork[i]);
		}
		setTimePick(setWork);
	});
}
