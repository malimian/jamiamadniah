
$(document).ready(function() {
    $('#dataTable1').DataTable();
  });
  
  // var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
  
  // elems.forEach(function(html) {
  //   var switchery = new Switchery(html ,
  //   { 
  //                     color: '#28a745', 
  //                     secondaryColor: '#dc3545', 
  //                     size: 'small'
  //   });
  
  // });
  
  
  // $('.js-switch').on("change", function(){
  //   var id = $(this).data("id");
     
  //      senddata(
  //                 'post/logs/logs.php' ,
  //                  "POST" ,
  //                 {id:id , change_status:true} ,
  //                function(result){ console.log(result);} ,
  //               function(result){  console.log(result);}   
  //             );
  
  // if(!$(this).is(':checked')){
  //   $('#status_'+id).removeClass().addClass('badge badge-danger').html('Block');
  // } 
  // else  {
  // $('#status_'+id).removeClass().addClass('badge badge-success').html('Active');
  // }
  
  // });
  
  
  
  function chart_settings (max_ , min_){
    console.log('in graph');
// Set new default font family and font color to mimic Bootstrap's default styling
  Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
  Chart.defaults.global.defaultFontColor = '#292b2c';
  
  // Area Chart Example
  var ctx = document.getElementById("myAreaChart");
  var myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: chartLabels,
      datasets: [{
        label: "Sessions",
        lineTension: 0.3,
        backgroundColor: "rgba(2,117,216,0.2)",
        borderColor: "rgba(2,117,216,1)",
        pointRadius: 5,
        pointBackgroundColor: "rgba(2,117,216,1)",
        pointBorderColor: "rgba(255,255,255,0.8)",
        pointHoverRadius: 5,
        pointHoverBackgroundColor: "rgba(2,117,216,1)",
        pointHitRadius: 50,
        pointBorderWidth: 2,
        data: chartData,
      }],
    },
    options: {
      scales: {
        xAxes: [{
          time: {
            unit: 'date'
          },
          gridLines: {
            display: true
          },
          ticks: {
            maxTicksLimit: 70
          }
        }],
        yAxes: [{
          ticks: {
            min: min_,
            max: max_,
            maxTicksLimit: 5,
          },
          gridLines: {
            color: "rgba(0, 0, 0, .125)",
          }
        }],
      },
      legend: {
        display: false
      }
    }
  });

  }
  
