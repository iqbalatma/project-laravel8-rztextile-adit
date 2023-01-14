import "../../module/yearpicker";

$(document).ready(function(){
  // let customYearlyStartYear = $("#custom-yearly-start-year").yearpicker({
  //   onChange: function(){
  //     // $("#custom-yearly-end-year").yearpicker({
  //     //   startYear : $("#custom-yearly-start-year").val(),
  //     // });
  //   },
  //   onHide: function(){
  //     console.log($("#custom-yearly-start-year").val());
  //     $("#custom-yearly-end-year").yearpicker({
  //       startYear : $("#custom-yearly-start-year").val(),
  //     });
  //   }
  // });
  // let customYearlyEndYear = $("#custom-yearly-end-year").yearpicker();



  $("#startDate").datepicker({
    dateFormat : "yy-mm-dd",
    onSelect: function(selected) {
      $("#endDate").datepicker("option","minDate", selected)
    }
  });
  $("#endDate").datepicker({
    dateFormat : "yy-mm-dd",
    onSelect: function(selected) {
        $("#startDate").datepicker("option","maxDate", selected)
    }
  });


  $("#selectPeriod").on("change", function(){
    const selectedValue = $(this).val();
    $(".datepicker-row").addClass("d-none");
    if(selectedValue == "daily"){
      $("#row-date-daily").removeClass("d-none")
    }else if(selectedValue == "monthly"){
      $("#row-date-monthly").removeClass("d-none")
    }else if(selectedValue == "yearly"){
      $("#row-date-yearly").removeClass("d-none")
    }else if(selectedValue == "custom"){
      $("#row-date-custom").removeClass("d-none")
    }else if(selectedValue == "custom-monthly"){
      $("#row-date-custom-monthly").removeClass("d-none")
    }else if(selectedValue == "custom-yearly"){
      $("#row-date-custom-yearly").removeClass("d-none")
    }
  });
});