<html>
<head>
<meta http-equiv = "content-type" content= "text/html"; charset = utf-8>
<title)顯示成績紀錄的PHP程式</title>
<link rel ="stylesheet" href="score.csv">


  <style>
    h2{
        font-family:monospace;
        font-size:30px;
        color:green;
    }
       .absolute{
        position:absolute;
        right:100px;
        top:70px;
    }

    body{
        background-attachment:fixed;
        background-image:url("https://images.996pic.com/7593ff9a75f047cb9bf8774518e3179d.jpg");
        background-size:1540px 750px;
        background-repeat:no-repeat;
   </style>


</head>
<center>
<b>
<body>
<br><br>
<h2>顯示成績紀錄的PHP程式</h2>
<table border=1 width=700 height=200>
<tr>
<th bgcolor = #FF8EFF>學號</th>
<th bgcolor = #FF8EFF>姓名</th>
<th bgcolor = #FF8EFF>系別</th>
<th bgcolor = #FF8EFF>國文</th>
<th bgcolor = #FF8EFF>數學</th>
<th bgcolor = #FF8EFF>英文</th>
<th bgcolor = #FF8EFF>總分</th>
<th bgcolor = #FF8EFF>平均</th>
</tr>
<?php
$myfile = fopen("score.csv", "r");
$sum1=0.0;
$num1= 0.0;
$sum2=0.0;
$num2= 0.0;
$sum3=0.0;
$num3= 0.0;
$res1=0.0;
$res2=0.0;
$res3=0.0;
while(($row = fgetcsv($myfile,0,","))!= false) {
    echo "<tr>";
    echo "<th>$row[1]</th>";
    echo "<th>$row[2]</th>";
    echo "<th>$row[7]</th>";
    echo "<th>$row[9]</th>";
    echo "<th>$row[10]</th>";
    echo "<th>$row[11]</th>";
    $total = ($row[9]+$row[10]+$row[11]);
    echo "<th>$total</th>";
    $average = round((($row[9]+$row[10]+$row[11])/3),1);
    echo "<th>$average</th>";

}
echo "</tr>";
fclose($myfile)
?>
</table>
<?php
$myfile=fopen("score.csv","r");
$sum1=0.0;$num1=0.0;$sum2=0.0;$num2=0.0;$sum3=0.0;$num3=0.0;$res1=0.0;$res2=0.0;$res3=0.0;
while(($row=fgetcsv($myfile,0,","))!=false){
    echo"<tr>";
    $arr1=array($row[9]);
    $sum1+=array_sum($arr1);
    $num1+=count($arr1);
    $res1=round($sum1/$num1,1);
    $arr2=array($row[10]);
    $sum2+=array_sum($arr2);
    $num2+=count($arr2);
    $res2=round($sum2/$num2,1);
    $arr3=array($row[9]);
    $sum3+=array_sum($arr3);
    $num3+=count($arr3);
    $res3=round($sum3/$num3,1);
}   
echo"<br>";    
echo"國文平均分數：".$res1;
echo"<br>";   
echo"英文平均分數：".$res2;
echo"<br>";   
echo"數學平均分數 :".$res3;
fclose($myfile)
?>
</b>
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
</body>
</center>
</html>