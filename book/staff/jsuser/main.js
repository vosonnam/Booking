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
function queryDataGetJSon(url,dataSend,callback){
    $.ajax({
        type: 'GET',
        url: url,
        data: dataSend,
        async: true,
        dataType: 'JSON',
        success: callback
    });
}
function buildSlidePage(obj,codan,pageActive,totalPage) {
    var html="";
    pageActive=parseInt(pageActive);
    for(i = 1 ; i <=codan; i++) {
        if(pageActive-i<0) break;
        html='<button type="button" class="btn btn-outline btn-default" value="'+(pageActive-i)+'">'+(pageActive-i+1)+'</button>'+html;
    }
    if(pageActive>codan){
        html='<button type="button" class="btn btn-outline btn-default" value="'+(pageActive-i)+'">...</button>'+html;
    }
    html+='<button type="button" class="btn btn-outline btn-default" style="background-color: #5cb85c" value="'+pageActive+'">'+(pageActive+1)+'</button>';
    for(i = 1 ; i <=codan; i++){
        if(pageActive+i>=totalPage) break;
        html=html+'<button  type="button" class="btn btn-outline btn-default" value="'+(pageActive+i)+'">'+(pageActive+i+1)+'</button>';
    }
    if(totalPage-pageActive>codan+1){
        html=html+'<button type="button" value="'+(pageActive+i)+'" class="btn btn-outline btn-default">...</button>';
    }
    obj.html(html);
}
queryDataPostJSon("API/staff/get.php",{event:'smsuser'},function (res) {
    var data=res['smsuser'];
    setInterval(function(){        
        var date = new Date().valueOf();
        for(i in data){
            var row=data[i];
            // var bookdate = (new Date(row['date'])).valueOf()-3600000;
            var bookdate = (new Date(row['date'])).valueOf();
            if((bookdate-3600000)>date){
                bookdate= (new Date(row['date'])).valueOf()-3600000;
            }
            var timeEnd = bookdate+300000;
            if(bookdate<=date && date<=timeEnd){
                var dataSend={event:1, 
                        id: row['id']}
                queryDataPostJSon("API/SMS/index.php",dataSend,function (resSMS) {
                    // console.log("Data: "+JSON.stringify(resSMS)); 
                    if(resSMS['status']==1){
                        delete res.smsuser[i];
                    }
                });
            }
            // console.log("Data: "+JSON.stringify(res)); 
        }
    },1000);   
});
function logout() {
    localStorage.clear();
    sessionStorage.clear();
    window.location.href = "../index.php";
}
$('#dangxuat').click(function () {
    logout();
})
function checklogin() {
    var uname=localStorage.getItem("username");
    if(uname=="" || uname==undefined || uname==null){
        window.location.href = "../index.php";
    }
    $('.username').text(uname);
}
checklogin();