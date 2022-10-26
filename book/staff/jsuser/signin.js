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
$('form').submit(function(e){
  e.preventDefault();
  var dataSend=$('form').serialize();
      dataSend+='&event=login';
  queryDataPostJSon("API/staff/accout.php",dataSend, function (res) {
    if(res['login']==1){
      localStorage.setItem("username",res.items);
      window.location.href ='dashboard.php';
    }else{
      alert(res['msg']);
    }
  });
});