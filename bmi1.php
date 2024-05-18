<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <title>計算BMI的PHP程式</title>
</head>
  
<body>
<?php
if($_SERVER['REQUEST_METHOD']=='GET'){
    $recieve_method="資料接收方式:GET";
    $stNo=$_GET['stNo'];
    $stName=$_GET['stName'];
    $gender=$_GET['gender'];
    $grade=$_GET['grade'];
    $age=$_GET['age'];
    $department=$_GET['department'];
    $club=$_GET['club'];
    $height=$_GET['height'];
    $weight=$_GET['weight'];
}
   
if($_SERVER['REQUEST_METHOD']=='POST'){
    $recieve_method="資料接收方式:POST";
    $stNo=$_POST['stNo'];
    $stName=$_POST['stName'];
    $gender=$_POST['gender'];
    $grade=$_POST['grade'];
    $age=$_POST['age'];
    $department=$_POST['department'];
    $club=$_POST['club'];
    $height=$_POST['height'];
    $weight=$_POST['weight'];
}

if(empty($height)||empty($weight)){
    echo "*Server:身高或體重是空值，請重新輸入資料!";
    echo "<a href='form1.html'>[返回表單]</a>";
    }
else{
$bmi=$weight/pow($height/100,2);
echo "<h2>PHP程式:計算身體質量指數 BMI</h2>";
echo "<font color='red'><b>$recieve_method</b></font>";
echo "<br>";
echo "*學號:$stNo";
echo "<br>";
echo "*姓名:$stName";
echo "<br>";
echo "*性別:$gender";
echo "<br>";
echo "*年級:$grade";
echo "<br>";
echo "*年齡:$age";
echo "<br>";
echo "*系別:$department";
echo "<br>";
echo "*社團:$club";
echo "<br>";
echo "*身高:$height";
echo "<br>";
echo "*體重:$weight (kg)";
echo "<br>";
echo "*BMI=".round($bmi,1);
}
    

?>
</body>
</html>
