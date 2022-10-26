var currentPage=0;
var txtsearch='';
var dataSend={
  event:'customer',
  page:currentPage,
  records:5
};
function loadData(page,record,dataSend) { 
    var url="API/staff/get.php"; 
    txtsearch=$('[name="txtsearch"]').val();
    if(txtsearch==''){
      dataSend={
        event:'customer',
        page:page,
        records:record
      }
    }else{
      dataSend={
        event:'customer',
        page:page,
        records:record,
        txtsearch:txtsearch
      }
    }
    console.log(dataSend);
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
loadData(currentPage,5,dataSend);
$(".ls_numberpage").on('click','button',function () {
    currentPage=$(this).val();
    loadData(currentPage,5,dataSend);
});
$(".tb_data").on('click','.btn_sua',function () {
  var row=$(this).parents('tr')[0];
  var cell=$(row).data('1');
  sessionStorage.setItem("customer",cell);
  window.location.href ='editcustomer.php';
});
$('#btn-tim').click(function () {
  txtsearch=$('[name="txtsearch"]').val();
  currentPage=0;
  if(txtsearch==''){
    dataSend={
      event:'customer',
      page:currentPage,
      records:5
    }
  }else{
    dataSend={
      event:'customer',
      page:currentPage,
      records:5,
      txtsearch:txtsearch
    }
  }
  loadData(currentPage,5,dataSend);
})