<?php
    try {
        $pgpdo = new PDO("pgsql:host=localhost;dbname=ym",'ym','panyuli1314520');
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
	$result = $pgpdo->query("select count(*) from guestbook;");
	$real = $result->fetchALL();
	echo '<h1>总评论数:'.$real[0]['count'].'</h1>';
	$pagesize = 1; //一页显示的数量
	$countmax = $real[0]['count']; //总数量
	$pagecount = ceil($countmax/$pagesize); //页数
	$currpage = empty ($_GET["page"])?1:$_GET["page"]; //empty():变量不存在则返回TRUE,三目运算符 ，当前页
	if($currpage>$countmax)
	{
		$currpage = 1;
	}
	try
	{
		//分页靠limit $pagesize offset ($currpage-1)*$pagesize 这个是pgsql的写法，具体数据库具体语法
		$sql = "select title,g_content,user_name,re_time from guestbook limit ".$pagesize." offset ".($currpage-1)*$pagesize.";";
	    $sm = $pgpdo->prepare($sql,array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL)); //想让 PDOStatement 对象
		//使用可滚动游标，必须在用 PDO::prepare() 预处理SQL语句时，设置 PDO::ATTR_CURSOR 属性为 PDO::CURSOR_SCROLL
	    $sm->execute();
	    while($row = $sm->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
	    {
	    	    $retime = substr($row[3],0,19);
		    echo "<h3>".$row[0]."  <span>".$row[2]."</span>  <span>".$retime."</span></h3>
   <p>".$row[1]."</p><hr><br>";
	    }
		for($i=1;$i<=$countmax;$i++)   //显示页码
		{
			if($i==$currpage)
			{
				echo "<b>$i</b>&nbsp";
			}
			else
			{
				echo "<a href='?page=$i'>$i</a>&nbsp";
			}
		}
	}
	catch (PDOException $e)
	{
		print $e->getMessage();
	}
?>
