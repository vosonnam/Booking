var currentPage=0;
var bookdate='';
function loadData(page,record) { 
    var url="API/staff/get.php"; 
    var dataSend={
      event:'book',
      page:page,
      records:record
    }
    $(".tb_data").html("<img src='images/loading.gif' width='5px' height='5px'/>");
    queryDataPostJSon(url,dataSend,function (res) {
      $(".tb_data").html("");
      showData(res);
    });
}
function loadData(page,record,bookdate) { 
    var url="API/staff/get.php";
    var dataSend={
      event:'book',
      page:page,
      records:record,
      bookdate:bookdate
    }
    $(".tb_data").html("<img src='images/loading.gif' width='5px' height='5px'/>");
    queryDataPostJSon(url,dataSend,function (res) {
      $(".tb_data").html("");
      showData(res);
    });
}
function showData (data) {
  var html="";
  var item=data['items'];
  for (key in item){
    html+=item[key];
  }
  $(".tb_data").html(html);
  var totalPage=data['total']/5;
  buildSlidePage($('.ls_numberpage'),5,currentPage,totalPage);
}
function loadSearch(page,record) {
  if(bookdate==''){
    loadData(page,record);
  }else{
    loadData(page,record,bookdate);
  }
}
loadData(currentPage,5);
$(".ls_numberpage").on('click','button',function () {
    currentPage=$(this).val();
    loadSearch(currentPage,5);
});
$(".tb_data").on('click','.btn_sendemail',function () {
  var row=$(this).parents('tr')[0];
  var cell=$(row).data('1');
  queryDataPostJSon("API/staff/get.php",{event: 'sendmailagain', id: cell},function (res) {
    alert(res['msg']);
    loadSearch(currentPage,5);
  });
});
$(".tb_data").on('click','.btn_sendsms',function () {
  var row=$(this).parents('tr')[0];
  var cell=$(row).data('1');
  queryDataPostJSon("API/SMS/index.php",{event:1, id: cell},function (res) {
    alert(res['msg']);
    loadSearch(currentPage,5);
  });
});
$('#bookdate').click(function (e) {
  $('#bookdate').val('');
})
$('#bookdate').change(function (e) {
  bookdate=$('#bookdate').val();
  loadData(currentPage,5,bookdate);
})
$('#btn-all').click(function () {
  bookdate='';
  currentPage=0;
  loadData(currentPage,5);
})