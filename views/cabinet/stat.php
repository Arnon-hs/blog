<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="content">
    <div class="pure-g">
        <div class="pure-u-1-1" id="text">
            <h2 class="pure-u-1"></h2>
        </div>

        <div class="pure-u-1-1">    
            <canvas id="myChart" width="600" height="600"></canvas>
        </div>
    </div>
</div>
<script>

function unique(arr) {
  let result = [];

  for (let str of arr) {
    if (!result.includes(str)) {
      result.push(str);
    }
  }

  return result;
}

var xhr = new XMLHttpRequest();
xhr.open('GET', 'http://blog/api/users/stat/', false);
xhr.send();
if (xhr.status != 200) {
    alert( xhr.status + ': ' + xhr.statusText ); // пример вывода: 404: Not Found
}
json_data = xhr.responseText;
var fields = ['userId','refererUrl','requestUrl','ip','userAgent', 'language'];

var data = JSON.parse(json_data);
var out = [];
for(var i in data)
{
	var d = [];
	for(var j in fields)
		d.push(data[i][fields[j]]);
    out.push(d);
}
var userId=[];
for(var v in out){
    userId.push(out[v][0]);
}
// console.log(out, userId);

var userIdCount = Object.values(userId.reduce(function(acc, el) {
  acc[el] = (acc[el] || 0) + 1;
  return acc;
}, {}));
users = unique(userId);
//document.write('<pre>', userIdCount, '</pre>');

var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: users,
        datasets: [{
            label: '# of Votes',
            data: userIdCount,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>

<?php include ROOT . '/views/layouts/footer.php'; ?>