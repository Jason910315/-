<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <title>計算成績的PHP程式</title>
</head>
 
<body>

<head>
  <style>
    .absolute{
        position:absolute;
        right:100px;
        top:500px;
    }
    h2{
        font-family:monospace;
        font-size:30px;
        color:gray;
    }
    body{
        background-attachment:fixed;
        background-image:url("https://i2.wp.com/pinkoi-wp-blog.s3.ap-southeast-1.amazonaws.com/wp-content/uploads/sites/7/2021/05/25150924/13.jpg?resize=510%2C208&ssl=1");
        background-size:1540px 750px;
        background-repeat:no-repeat;
        }
        
   </style>
   </head>

<table class="absolute">
    <form id="form" action="entry.html" method="POST">
    <td><input type="submit" name="buttom1" value="登錄學生成績"></td>
    </form>
    <form id="form" action="showdata.php" method="POST">
    <td><input type="submit" name="buttom2" value="顯示成績紀錄"></td>
    </form>
    <form id="form" action="index.html" method="POST">
    <td><input type="submit" name="buttom3" value="回主功能頁面"></td>
    </form>
</table>

<?php //PHP程式起始區域
  //自訂函數：判斷成績的評定結果
  function getScore($Score){
    if($Score==100){
        $status="<font color=#ff0000>(優!)</font>";
    } else if($Score>=90){
        $status="<font color=#ff0000>(甲)</font>";   
    } else if($Score>=80){
        $status="<font color=#ff0000>(乙)</font>";    
    } else if($Score>=70){
        $status="<font color=#ff0000>(丙)</font>";
    } else if($Score>=60){
        $status="<font color=#ff0000>(丁)</font>";
    } else{
        $status="<font color=#ff0000>(不及格)</font>";
    }
    return $status;
  }

  //自訂函數：依據性別判斷稱謂
  function getTitle($genderValue) {
    if ($genderValue == "M") {
      $title = "先生";
    } else {
      $title = "小姐";
    }
    return $title;
  }
  
  function getAge($year,$month,$day){
    $date="$year-$month-$day";
    if(version_compare(PHP_VERSION, '5.3.0')>=0) {
    $dob = new Datetime ($date);
    $now = new Datetime();
    return $now->diff($dob)->y;
    } 
    $difference=time()-strtotime($date);
    return floor($difference/31556926);
    }  

  if ($_SERVER['REQUEST_METHOD'] == 'GET') {    
    $receive_mtehod = "* 資料接收方式：GET";
    $stNo = $_GET['stNo'];
    $stName = $_GET['stName'];
    $gender = $_GET['gender'];
    $grade = $_GET['grade'];
    //指定變數$birthday，接收form 傳來的生日資料(年/月/日)
    $dob_year=$_GET['dob_year'];
    $dob_month=$_GET['dob_month'];
    $dob_day=$_GET['dob_day'];
    $birthday=$dob_year."/".$dob_month."/".$dob_day;
    $department = $_GET['department'];    
    $club = $_GET['club'];
    //指定變數$Cscore，接收form 傳來的國文成績
    $Cscore = $_GET['Cscore'];
    //指定變數$Escore，接收form 傳來的英文成績
    $Escore = $_GET['Escore'];
    $Mscore = $_GET['Mscore'];    
  }
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
    $receive_mtehod = "* 資料接收方式：POST";
    $stNo = $_POST['stNo'];
    $stName = $_POST['stName'];
    $gender = $_POST['gender'];
    $grade = $_POST['grade'];
    //指定變數$birthday，接收form 傳來的生日資料(年/月/日)
    $dob_year=$_POST['dob_year'];
    $dob_month=$_POST['dob_month'];
    $dob_day=$_POST['dob_day'];
    $birthday=$dob_year."/".$dob_month."/".$dob_day;   
    $department = $_POST['department'];    
    $club = $_POST['club'];
    //指定變數$Cscore，接收form 傳來的國文成績
    $Cscore = $_POST['Cscore'];
    //指定變數$Escore，接收form 傳來的英文成績
    $Escore = $_POST['Escore'];
    //指定變數$Mscore，接收form 傳來的數學成績
    $Mscore = $_POST['Mscore'];
  }
  //將複選的變數$club項目以"/"符號分割
  $myclub = implode("/", $club);
 
  $total= $Cscore+$Escore+$Mscore;
  $average = round($total/3, 1);
  $age=getAge($dob_year,$dob_month,$dob_day);
     
      echo "<h2>PHP 程式：計算成績資訊</h2>";
      echo "<font color='red'><b>$receive_mtehod</b></font>";
      echo "<br>";
      echo "* 學號：$stNo";
      echo "<br>";
      echo "* 姓名：$stName";
      echo "<br>";
      echo "* 生理性別：$gender";
      echo "<br>";
      echo "* 年級：$grade 年級";
      echo "<br>";
      echo "* 生日：".$birthday; //顯示生日
      echo "<br>";            
      echo "* 年齡：$age 歲";
      echo "<br>";
      echo "* 系別：$department";
      echo "<br>";
      echo "* 社團：$myclub";
      echo "<br>";      
      echo "* 國文成績：$Cscore 分";
      echo "<br>";
      echo "* 英文成績：$Escore 分";
      echo "<br>";
      echo "* 數學成績：$Mscore 分";
      echo "<br>";
      echo "* 總分：$total";
      echo "<br>";
      echo "* $stName".getTitle($gender)."好! 您總分是:".$total. " 平均:".$average;
      echo getScore($average);
      echo "<br><br>";
     
      //將登錄資料存入文字檔案 class.txt
      if (!$fp=fopen("score.csv", "a")) { //檢查能否開啟資料輸入檔案 class.txt
        echo "檔案無法開啟"; //如果不能開啟class.txt，則顯示檔案無法開啟
        exit;  //結束
      }
     
      //設定時區
      date_default_timezone_set("Asia/Taipei");
      //擷取 local 的系統時間
      $today = getdate();
      //時間格式 年/月/日-時:分
      $date = "$today[year]/$today[mon]/$today[mday]-$today[hours]:$today[minutes]";
      //寫入class.txt的時間格式
      $record1 = "$date,$stNo,$stName,$gender,$grade,$birthday,$age,";
      $record2 = "$department,$myclub,$Cscore,$Escore,$Mscore,$total,$average\r\n";
      fputs($fp,$record1.$record2); //寫入輸入檔案class.txt
      fclose($fp);  //關閉檔案
     
      //PHP Check End-Of-File - feof()
      echo "<br><br>";      
      $myfile = fopen("score.csv", "a") or die("Unable to open file!");
      //Output one line until end-of-file
      while(!feof($myfile)) {
        echo fgets($myfile) . "<br>";
      }
      fclose($myfile);
    
  //PHP程式結束
?>
</body>
</html>