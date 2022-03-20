<!DOCTYPE html>
<html lang="en">
<?php
require_once("connection.php");
?>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous" />

  <title>onepageShow</title>
</head>

<body>
  <?php
  /* $username = '';
  if (isset($_GET['username'])) {
    $username = $_GET['username'];
  }
  echo 'username:' . $username . '<br>';
  if ($username === 'admin') {
    echo 'hello admin!';
  } else {
    echo 'fail';
  } */
  ?>

  <?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $db = "chart";
  // Create connection
  $conn = new mysqli($servername, $username, $password, $db); //創造一個 mysql，帶入上面的資料：
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $sql = "SELECT * FROM marriage"; //設置一個變數 sql 去接收這些資料;關鍵字習慣都是要要大寫才可以，小寫也可以執行，但是會影響可讀性，所以字串符號內的全部大寫都代表示是指令
  $result = $conn->query($sql); //設置一個變數 result 接收 conn 選中 sql 的資料庫
  $buildingName = '';
  if ($result->num_rows > 0) {  //偵測 rows 是不是大於 0 如果是才走後面那段，如果不是就印出沒有結果。
    while ($row = $result->fetch_assoc()) {  //把讀到的這個 row 讀取下來。$result 指向 fetch_assoc() ，把 $result 的結果賦給 $row ，直到 $row 為空值，就會 false 跳出迴圈
      echo "site_id: " . $row["site_id"] . "marriage_type: " . $row["marriage_type"] .  "<br>";
    }
  } else {
    echo "0 results";
  }
  $conn->close();
  ?>
  <!-- <form action='/onepageShow.php' method='POST'>
    username: <input name='username' />
    password: <input name='password' />
    <input type='submit' />
  </form> -->

  <div class="container-fluid">
    <!-- 流動布局 -->
    <div class="row">
      <canvas id="myChart" width="800" height="600"></canvas>

      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <script>
        var polarAreaChart = {
          labels: [<?php echo $row["site_id"] . $row["marriage_type"] ?>],
          datasets: [{
            lables: 'consumption',
            backgroundColor: 'rgb(255 ,99 , 132)',
            borderColor: 'rgb(255 , 99 , 132)',
            borderWidth: 1,
            data: [<?php echo $data1 ?>]
          }, {
            label: 'cost',
            backgroundColor: 'rgb(54 ,162, 235)',
            borderColor: 'rgb(54 ,162, 235)',
            borderWidth: 1,
            data: [<?php echo $data2 ?>]
          }]
        };
        window.onload = function() {
          var ctx = document.getElementById('canvas').getContext('2d');
          window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
              responsive: true,
              legend: {
                position: 'top',
              },
              title: {
                display: true,
                text: 'Chart.js Bar Chart'
              }
            }
          });

        };
      </script>
      <!-- Bootstrap JavaScript Libraries -->
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    </div>

</body>

</html>