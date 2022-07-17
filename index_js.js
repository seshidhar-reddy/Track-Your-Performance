const CHART = document.getElementById("myChart");
goals = [9,5,7,8,7.5,5.5];
distractions = [2,3,2,2,1.5,3.5];
var result = new Array(6);
for(var i=0;i<6;i++){
    result[i] = (goals[i]+10-distractions[i])/2;
}
let linechart = new Chart(CHART,{
    type: 'line',
    data: {
        labels: [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
          ],
        datasets: [{
          lineTension: 0.1,
          fill:false,
          label: 'Distractions',
          backgroundColor: 'rgb(255, 0, 0,0.2)',
          borderColor: 'rgb(255, 0, 0,0.6)',
          pointBorderColor: 'rgb(255, 0, 0)',
          pointBorderWidth: 1,
          pointHoverRadius: 5,
          data: distractions,
        },
        {
            lineTension: 0.1,
            fill:false,
            label: 'Goals',
            backgroundColor: 'rgb(0,255, 0,0.2)',
            borderColor: 'rgb(0, 255, 0,0.6)',
            pointBorderColor: 'rgb(0, 255, 0)',
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            data: goals,
          },
          {
            lineTension: 0.1,
            fill:true,
            label: 'Your Progress',
            backgroundColor: 'rgb(0,0,255,0.2)',
            borderColor: 'rgb(0,0,255,0.6)',
            pointBorderColor: 'rgb(0,0,255)',
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            data: result,
          }
        ]
      }
});
