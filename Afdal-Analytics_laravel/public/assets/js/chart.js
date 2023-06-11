

var options = {
          series: [{
          name: 'New Unpaid',
          data: [44, 55, 41, 67, 22, 43]
        }, {
          name: 'New Paid',
          data: [13, 23, 20, 8, 13, 27]
        }],
          chart: {
          type: 'bar',
          height: 270,
          stacked: true,
          toolbar: {
            show: false
          },
          zoom: {
            enabled: false
          }
        },
        responsive: [{
          breakpoint: 480,
          options: {
            legend: {
              position: 'bottom',
              offsetX: -10,
              offsetY: 0
            }
          }
        }],

        plotOptions: {
          bar: {
            horizontal: false,
            borderRadius: 10
          },
        },
        xaxis: {
          type: 'label',
          categories: ['11/03', '12/03', '13/03', '14/03',
            '15/03', '16/03'
          ],
        },
        legend: {
          position: 'bottom',
          offsetY: 200
        },
        fill: {

          opacity: 1,
          colors:['#545454', '#ff9a41']
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();


// Pai chart start
 var options = {
          series: [41, 59],
          chart: {
            height: 315,
          type: 'donut',
        },
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }],

        fill: {
          opacity:1,
          colors:['#ff9a41', '#356792']
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart2"), options);
        chart.render();







        //line
  var ctxL = document.getElementById("lineChart").getContext('2d');
  var myLineChart = new Chart(ctxL, {
    type: 'line',

    data: {
      labels: ["11/03", "12/03", "13/03", "14/03", "15/03", "16/03"],
      datasets: [{
         label: "Organic Reach",
          data: [65, 20, 50, 40, 35, 30],
          backgroundColor: [
            'rgb(255 154 65 / 10%)',
          ],
          borderColor: [
            '#ff9a41',
          ],
          borderWidth: 2
        },
        {
          label: "Paid Reach",
          data: [50, 15, 60, 30, 45, 70],
          backgroundColor: [
            'rgb(53 103 146 / 10%)',
          ],
          borderColor: [
            '#0b243a',
          ],
          borderWidth: 2
        }
      ]
    },
    options: {
      responsive: true
    }
  });


