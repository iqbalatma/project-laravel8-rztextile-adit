/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*****************************************************!*\
  !*** ./resources/js/application/dashboard/index.js ***!
  \*****************************************************/
$(document).ready(function () {
  var ctx = $("#salesChart").get(0).getContext("2d");
  var salesChartOption = {
    responsive: true,
    plugins: {
      title: {
        display: true,
        text: 'Summary Sales Data'
      }
    },
    interaction: {
      intersect: false
    },
    scales: {
      x: {
        display: true,
        title: {
          display: true,
          text: "This Month"
        }
      },
      y: {
        display: true,
        title: {
          display: true,
          text: 'Amount in Rupiah'
        }
      }
    }
  };
  $.ajax({
    url: "ajax/dashboard/sales-summary",
    type: "GET",
    dataType: "json"
  }).done(function (res) {
    console.log(res);
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: res.data.period,
        datasets: [{
          label: 'Sales Data',
          data: res.data.total_bill,
          cubicInterpolationMode: 'monotone',
          tension: 0.5,
          backgroundColor: ['rgba(32, 34, 220, 0.2)'],
          borderColor: ['rgba(32, 34, 220, 1)'],
          borderWidth: 1
        }, {
          label: 'Profit Data',
          data: res.data.total_profit,
          cubicInterpolationMode: 'monotone',
          tension: 0.5,
          backgroundColor: ['rgba(37, 175, 67, 0.2)'],
          borderColor: ['rgba(37, 175, 67, 0.8)'],
          borderWidth: 1
        }, {
          label: 'Capital Data',
          data: res.data.total_capital,
          cubicInterpolationMode: 'monotone',
          tension: 0.5,
          backgroundColor: ['rgba(204, 44, 44, 0.2)'],
          borderColor: ['rgba(220, 32, 32, 0.8)'],
          borderWidth: 1
        }]
      },
      options: salesChartOption
    });
    myChart.options.scales.x.title.text = res.data.month;
    myChart.update();
  });
});
/******/ })()
;