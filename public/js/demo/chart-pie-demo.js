var label = [];
let angka = [];

$.ajax({
  method: 'get',
  dataType: 'json',
  url: baseUrl + 'diagram',
  success: function(data) {
    // console.log(data)
    for (let i = 0; i < data.length; i++) {
      label.push(data[i]['provinsi'])
      angka.push(data[i]['data'])
    }

    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    // Pie Chart Example
    var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: label,
        datasets: [{
          data: angka,
          backgroundColor: ['#1cc88a', '#4e73df', '#36b9cc', '#e74a3b', '#f6c23e', '#e83e8c', '#6f42c1', '#6610f2','#3640cc','#cc3681'],
          hoverBackgroundColor: ['#17a673', '#2e59d9', '#2c9faf'],
          hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          caretPadding: 10,
        },
        legend: {
          display: false
        },
        cutoutPercentage: 80,
      },
    });
  }
})


