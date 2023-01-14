$(document).ready(function(){
  console.log("TES");

  $("#invoice").on("change", function(){
    console.log("change triggered");
    let billLeft = $(this).find(':selected').data('bill-left')

    $("#bill_left").val(billLeft)
  })
});