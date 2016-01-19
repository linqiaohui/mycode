<?php
$title = $_POST['title'];
$content = $_POST['content'];
$username = $_POST['username'];
try {
  $DBH = new PDO("pgsql:host=localhost;dbname=ym",'ym','panyuli1314520');
}
catch(PDOException $e) {
    echo $e->getMessage();
}

$STH = $DBH->prepare("INSERT INTO guestbook(title,g_content,user_name,re_time) values(?,?,?,now());");
$STH->execute(array($title,$content,$username));
if ($STH->rowCount() > 0)
{
	header("Location: http://localhost/guest_main.php#ao");
}
else
{
	echo "<script>alert('插入失败!');</script>";
}
?>