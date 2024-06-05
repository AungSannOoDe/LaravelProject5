$(document).ready(function(){
    $('.btn-plus').click(function(){
        $parentNode=$(this).parents('tr');
        $price=Number($parentNode.find('#pizzaPrice').html().replace("kyats",""));
        $qty=parseInt($parentNode.find('#qty').val());
        $total=$price*$qty;

  $parentNode.find('#total').html($total+"kyats");
  summaryCalculation();
    })
    $('.btn-minus').click(function(){
        $parentNode=$(this).parents('tr')
        $price=Number($parentNode.find('#pizzaPrice').html().replace("kyats",""));
        $qty=parseInt($parentNode.find('#qty').val());
        $total=$price*$qty;
        console.log($total);
  $parentNode.find('#total').html($total+"kyats");
  summaryCalculation();
    })
    $('.btnRemove').click(function(){
       $(this).parents('tr').remove();
       summaryCalculation()
    })
    function summaryCalculation(){
        $finaltotal=0;
  $('#table tr').each(function(index,row){
    $finaltotal+=Number($(row).find('#total').text().replace('kyats',''));
  })
  $('#totals').find('#finaltotal').html($finaltotal+"kyats");
  $('#totals').find('#FinalTotal').html($finaltotal+3000+"kyats");
    }
    //clear Cache

})
