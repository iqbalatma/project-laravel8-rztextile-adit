$(document).ready((function(){var a=$("#salesChart").get(0).getContext("2d"),t={responsive:!0,plugins:{title:{display:!0,text:"Summary Sales Data"}},interaction:{intersect:!1},scales:{x:{display:!0,title:{display:!0,text:"This Month"}},y:{display:!0,title:{display:!0,text:"Amount in Rupiah"}}}};$.ajax({url:"ajax/dashboard/sales-summary",type:"GET",dataType:"json"}).done((function(o){console.log(o);var e=new Chart(a,{type:"line",data:{labels:o.data.period,datasets:[{label:"Sales Data",data:o.data.total_bill,cubicInterpolationMode:"monotone",tension:.5,backgroundColor:["rgba(32, 34, 220, 0.2)"],borderColor:["rgba(32, 34, 220, 1)"],borderWidth:1},{label:"Profit Data",data:o.data.total_profit,cubicInterpolationMode:"monotone",tension:.5,backgroundColor:["rgba(37, 175, 67, 0.2)"],borderColor:["rgba(37, 175, 67, 0.8)"],borderWidth:1},{label:"Capital Data",data:o.data.total_capital,cubicInterpolationMode:"monotone",tension:.5,backgroundColor:["rgba(204, 44, 44, 0.2)"],borderColor:["rgba(220, 32, 32, 0.8)"],borderWidth:1}]},options:t});e.options.scales.x.title.text=o.data.month,e.update()}))}));