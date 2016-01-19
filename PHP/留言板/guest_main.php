<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
  <title>留言板</title>
  <script>
function test()
{
	var sum
	if(document.frm.title.value=='')
	{
		alert('请填写标题');
		return false;
	}else
	{
	    sum =document.frm.title.value.length;
		
		if(sum<5 || sum>20)
		{
			alert('请填写5-20个字符');
			return false;
		}	
	}
	
		if(document.frm.username.value=='')
	{
		alert('请填写姓名');
		return false;
	}else
	{
	    sum =document.frm.username.value.length;
		
		if(sum<2 || sum>10)
		{
			alert('请填写2-10个字符');
			return false;
		}	
	}
	sum = document.frm.content.value.length;
	if(sum<10){
		alert('留言内容不能小于10个字符');
		return false;
		}
return true;
}

function islogin()
{
	if(document.login.username.value=='')
	{
		alert('请输入账户名');
		return false;
	}
	if(document.login.password.value=='')
	{
		alert('请输入密码');
		return false;
		}
return true;
	
}
</script>
</head>
<body>
<div>
   <?php
    //分页功能待实现
    try {
        $pgpdo = new PDO("pgsql:host=localhost;dbname=ym",'ym','panyuli1314520');
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
	$sm=$pgpdo->prepare("select title,g_content,user_name,re_time from guestbook;");
	$sm->execute();
	$result = $sm->fetchALL();
	foreach($result as $key=>$value)
	{
		echo "<h3>".$value['title']."  <span>".$value['user_name']."</span>  <span>".$value['re_time']."</span></h3>
   <p>".$value['g_content']."</p><hr><br>";
	}
?>
	<a id='ao'></a>
</div>
  <form action="guest_sava.php" method="POST" name="frm" onsubmit="return test();">
    <table border="0" cellpadding="5" cellspacing="0" width="0">
			<tbody><tr>
				<td width="20%">留言标题</td><td><input name="title" size="30" type="text" value="" /></td>
			</tr>
			<tr>
				<td>用户网名</td><td><input name="username"  size="30" type="text" value="" /></td>
			</tr>
			<tr>
				<td>内容</td><td><textarea name="content" cols="42" rows="5"></textarea></td>
			</tr>
           	<tr>
				<td>回复的内容</td><td><textarea name="recontent" cols="42" rows="5"></textarea></td>
			</tr>
			    <td colspan="2" align="center">
					<input name="action" value="insert" type="hidden">
					<input value=" 提 交 " class="button" type="submit">
				</td>
			</tr>
	</tbody></table>
  </form>
</body>
</html>