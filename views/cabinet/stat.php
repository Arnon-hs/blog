<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="content">
    <div class="pure-g">
        <div class="div-flex">
            <div class="pure-u-1-1" id="text">
                <h2 class="pure-u-1">Статистика</h2>
            </div>

            <div class="pure-u-1-2">   
                <label for="myChart">Количество посещений по ID пользователя</label> 
                <canvas id="myChart"></canvas>
            </div>
            <div class="pure-u-1-2">    
                <label for="myChart2">IP адреса пользователей</label>
                <canvas id="myChart2"></canvas>
            </div>
            <div class="pure-u-2-3">  
                <label for="myChart">Посещенные страницы</label>
                <canvas id="myChart3"></canvas>
            </div>
            <div class="pure-u-2-3">  
                <label for="myChart">Переходы пользователей</label>
                <canvas id="myChart4"></canvas>
            </div>
        </div>
        <style>
            .div-flex{
                display:flex;
                justify-content:center;
                align-items:center; 
                flex-wrap:wrap;
            }
            .div-flex > div{
                margin-bottom:2rem;
            }
            .div-flex > div label{
                text-align:center;
                margin-bottom:1rem;
                display:block;
            }
            canvas{
                width:100% !important;
                height:auto !important;
            }
        </style>
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
// console.log(data);
var out = [];
for(var i in data)
{
	var d = [];
	for(var j in fields)
		d.push(data[i][fields[j]]);
    out.push(d);
}
// console.log(out);
var userId=[];
var userIP=[];
var refererURL=[];
var requestURL=[];
for(var v in out){
    userId.push(out[v][0]);
    userIP.push(out[v][3]);
    refererURL.push(out[v][1]);
    requestURL.push(out[v][2]);
}
// console.log(out, userId);
function countEl(l){
   var t = Object.values(l.reduce(function(acc, el) {
        acc[el] = (acc[el] || 0) + 1;
        return acc;
    }, {}));
    return t;
}

var userIdCount = countEl(userId);
var userIPCount = countEl(userIP);
var requestURLCount = countEl(requestURL);
var refererURLCount = countEl(refererURL);

users = unique(userId);
usersIP = unique(userIP);
requestURLs = unique(requestURL);
refererURLs = unique(refererURL);

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
        responsive:true,
        // maintainAspectRatio: false,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});




var ctx = document.getElementById('myChart2');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: usersIP,//
        datasets: [{
            label: '# of Votes',
            data: userIPCount,//
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
        responsive:true,
        // maintainAspectRatio: false,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

var ctx = document.getElementById('myChart3');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: requestURLs,//
        datasets: [{
            label: '# of Votes',
            data: requestURLCount,//
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
        responsive:true,
        // maintainAspectRatio: false,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

var ctx = document.getElementById('myChart4');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: refererURLs,//
        datasets: [{
            label: '# of Votes',
            data: refererURLCount,//
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
        responsive:true,
        // maintainAspectRatio: false,
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