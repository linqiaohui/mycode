﻿<!DOCTYPE html>
<html>
<head>
  <title>龙贝网欢迎您</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./third_frameworks/jquery.mobile.min.css">
  <script src="./third_frameworks/jquery.min.js"></script>
  <script src="./third_frameworks/jquery.mobile.min.js"></script>
</head>
<body>
  <div data-role="page" id="home">
 
      <div data-role="header" data-position="fixed">
		<!--<a href="#" data-role="button" data-icon="grid" data-iconpos="notext">menu</a>-->
        <h1>龙贝网欢迎您</h1>
      </div>
 
      <div data-role="content">
         <ul data-role="listview" data-inset="true" runat="server">
			<li><img src="./images/longbei.jpg" /><h2>用户名：</h2>
				<p>联系方式:</p>
			</li>
         </ul>
      </div>

      <div data-role="footer" data-position="fixed">
        <div data-role="navbar">
		  <ul>
			<li><a href="main.php">龙贝</a></li>
			<li><a href="#">我</a></li>
		  </ul>
        </div>
      </div>
   </div>
</body>
</html>