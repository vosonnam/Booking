var currentPage=0;
function loadData(page,record) { 
    var url="API/staff/get.php"; 
    var dataSend={
      event:'offdate',
      page:page,
      records:record
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
loadData(currentPage,5);
$(".ls_numberpage").on('click','button',function () {
    currentPage=$(this).val();
    loadData(currentPage,5);
});
$(".tb_data").on('click','.btn_huy',function () {
  var row=$(this).parents('tr')[0];
  var cell=$(row).data('1');
  queryDataPostJSon("API/staff/add.php",{event: 'editoffdate',id:cell},function (res) {
    alert(res['msg']);
    loadData(currentPage,5);
  });
});