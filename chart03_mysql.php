<?php
  header("Content-Type: text/html; charset=utf-8");
  include("connMySQL.php");  
  // connect with database  
  $seldb = mysqli_select_db($link, "hami")  
    or die("資料庫選擇失敗！");
   
  $sql = "SELECT deptTitle AS 系別, COUNT(*) AS 人數
    FROM student, department
    WHERE student.departId = department.deptNo
    GROUP BY departId;";    
    
  mysqli_query($link, "SET CHARACTER SET UTF8");  
  $result = mysqli_query($link, $sql);

  $sendData1 = "";
  $sendData2 = "";  
  for ($i=1; $i<=mysqli_num_rows($result); $i++) {
    $data = mysqli_fetch_row($result);
    if ($i<mysqli_num_rows($result)) {
      $sendData1 = $sendData1.$data[0].",";
      $sendData2 = $sendData2.$data[1].",";
    } else {
      $sendData1 = $sendData1.$data[0];
      $sendData2 = $sendData2.$data[1];
    }  
  }  
  mysqli_free_result($result);
  $label_of_department = explode(",", $sendData1);
  $num_of_student = explode(",", $sendData2);       
  
  $dataPoints = array( 
	  array("label"=>$label_of_department[0], "y"=>$num_of_student[0]),
	  array("label"=>$label_of_department[1], "y"=>$num_of_student[1]),
	  array("label"=>$label_of_department[2], "y"=>$num_of_student[2]),
	  array("label"=>$label_of_department[3], "y"=>$num_of_student[3]),
	  array("label"=>$label_of_department[4], "y"=>$num_of_student[4]),
	  array("label"=>$label_of_department[5], "y"=>$num_of_student[5])                  
  ) 
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>2022年高醫 PHP & MySQL 資訊研習營工作坊</title>
<?php include('style.css'); ?>

<script>
window.onload = function() { 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title: {
		text: "HAMI-學員資料管理系統：學生人數統計",
    fontSize: 30,    
    fontColor: "blue",
    fontWeight: "bold"
	},
	subtitles: [{
		text: "2022 各系所人數統計圖"
	}],
	data: [{
		type: "pie",
    showInLegend: true,
    legendText: "{label}",
    toolTipContent: "{y} - #percent %",
		//yValueFormatString: "#,##0.00\"%\"",
    yValueFormatString: "#,##0",
		indexLabel: "{label} ({y})",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();  
}
</script>
</head>
 
<body>
<font face="DFKai-sb" color="blue">
<h1>　　2022年高醫 PHP & MySQL 資訊研習營工作坊</h1>
</font>

<!-- 圖示網站：https://www.w3schools.com/icons/fontawesome_icons_webapp.asp -->
<div class="navbar">
  <a href="#"><i class="fa fa-fw fa-home"></i> Home</a> 
  <a href="#"><i class="fa fa-pencil-square-o"></i> 新增會員</a>
  <a href="#" class="active"><i class="fa fa-pie-chart"></i> 繪製統計圖</a>
  <a href="#"><i class="fa fa-tablet"></i> Web APP</a>  
  <a href="#"><i class="fa fa-cutlery"></i> 訂購餐點</a>
  <a href="#"><i class="fa fa-laptop"></i> 大數據分析</a>
  <a href="logout.php"><i class="fa fa-window-close-o"></i> 結束操作</a>
</div>
<br>
<div id="chartContainer" style="height: 520px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>