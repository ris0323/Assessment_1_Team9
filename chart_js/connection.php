<?php
header('Content-Type: text/html; charset=utf-8');
print('<html><head>');
print('<meta http-equiv="Content-Type"' .
  ' content="text/html; charset=utf-8"/>');
print('</head><body>' . "\n");
function conn()
{
  $servername = "localhost";
  $username = "root";
  $password = "";
  $db = "chart";
  // Create connection
  $conn = new mysqli($servername, $username, $password, $db);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  //echo "<h1>Connected successfully</h1>";
  mysqli_query($conn, "SET character_set_client=utf8");
  mysqli_query($conn, "SET character_set_connection=utf8");
  return $conn;
}
conn();

//圓餅圖的婚姻類型統計(先以區域再來全台)
//site_id=mysql_real_escape_string($conn, "新北%");

// function marriageType(m_type, site){
//   $marriage_type=m_type; '不同性別';
//   $site_id=site; '新北市%';
//   $sql ="SELECT SUM(marry_count) AS total FROM marriage WHERE site_id LIKE '$site_id' AND marriage_type='$marriage_type'";
//   $res = $conn->query($sql);
//   if ($res->num_rows > 0) {
//     // output data of each row
//     while($row = $res->fetch_assoc()) {
//       //echo "sex: " . $row["sex"]. " - site_id: " . $row["site_id"]. " " . $row["edu"]. "<br>";
//       return $row['total'];
//     }
//   }
// }

function marriageType($city, $marryType)
{
  $conn = conn();
  $site_id = $city . "%";
  $marriage_type = $marryType;
  $sql = "SELECT SUM(marry_count) AS total FROM marriage WHERE site_id LIKE '$site_id' AND marriage_type='$marriage_type'";
  $res = $conn->query($sql);
  if ($res->num_rows > 0) {
    // output data of each row
    while ($row = $res->fetch_assoc()) {
      return $row['total'];
    }
  }
  mysqli_free_result($res);
  $conn->close();
}

function marriageTypeTotal($marryType)
{
  $conn = conn();
  $marriage_type = $marryType;
  $sql = "SELECT SUM(marry_count) AS total FROM marriage WHERE marriage_type='$marriage_type'";
  $res = $conn->query($sql);
  if ($res->num_rows > 0) {
    // output data of each row
    while ($row = $res->fetch_assoc()) {
      return $row['total'];
    }
  }
  mysqli_free_result($res);
  $conn->close();
}

//柱狀圖的教育程度統計(先以區域再來全台)
function edu($city, $education)
{
  $conn = conn();
  $site_id = $city . "%";
  $edu = $education;
  $sql = "SELECT SUM(marry_count) AS total FROM marriage WHERE site_id LIKE '$site_id' AND edu='$edu'";
  // $sql ="SELECT SUM(marry_count) AS total FROM marriage WHERE NOT edu='博士畢業'AND site_id LIKE '新北市%'";
  $res = $conn->query($sql);
  if ($res->num_rows > 0) {
    // output data of each row
    while ($row = $res->fetch_assoc()) {
      return $row['total'];
    }
  }
  mysqli_free_result($res);
  $conn->close();
}

function eduTotal($education)
{
  $conn = conn();
  $edu = $education;
  $sql = "SELECT SUM(marry_count) AS total FROM marriage WHERE edu='$edu'";
  $res = $conn->query($sql);
  if ($res->num_rows > 0) {
    // output data of each row
    while ($row = $res->fetch_assoc()) {
      return $row['total'];
    }
  }
  mysqli_free_result($res);
  $conn->close();
}


//寶拉圖的原屬國際統計(先以區域再來全台)
function nation($city, $country)
{
  $conn = conn();
  $site_id = $city . "%";
  $nation = $country;
  $sql = "SELECT SUM(marry_count) AS total FROM marriage WHERE site_id LIKE '$site_id' AND nation='$nation'";
  $res = $conn->query($sql);
  if ($res->num_rows > 0) {
    // output data of each row
    while ($row = $res->fetch_assoc()) {
      return $row['total'];
    }
  }
  mysqli_free_result($res);
  $conn->close();
}

function nationTotal($country)
{
  $conn = conn();
  $nation = $country;
  $sql = "SELECT SUM(marry_count) AS total FROM marriage WHERE nation='$nation'";
  $res = $conn->query($sql);
  if ($res->num_rows > 0) {
    // output data of each row
    while ($row = $res->fetch_assoc()) {
      return $row['total'];
    }
  }
  mysqli_free_result($res);
  $conn->close();
}

//綜合指數 各區結婚人數+年紀(暫以20~24&25~29)
function age($city, $fromAge, $toAge)
{
  $conn = conn();
  $site_id = $city . "%";
  $age1 = $fromAge;
  $age2 = $toAge;
  $sql = "SELECT SUM(marry_count) AS total FROM marriage WHERE site_id LIKE '$site_id' AND age BETWEEN '$age1' AND '$age2'";
  $res = $conn->query($sql);
  if ($res->num_rows > 0) {
    // output data of each row
    while ($row = $res->fetch_assoc()) {
      return $row['total'];
    }
  }
}

// echo queryData($sql);

//datasets:[{
// data: <?php echo queryData($sql)
//}]
//$sql = sprintf("SELECT age, marry_count FROM marriage where site_id=$site_id or edu=$edu AND "); 
//}
print('</body></html>');
