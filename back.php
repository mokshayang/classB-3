<?php include_once "./api/base.php"; ?>
<?php //原本在back.php>login.php的判斷 :
if(!empty($_POST['acc'])){
    if($_POST['acc']=='admin' && $_POST['pw']=='1234'){
        $_SESSION['login']=1;
    }else{
        // echo "<span style='color:red'>帳號或密碼錯誤</span>";
        // echo "<script>alert('帳號或密碼錯誤')</script>";//錯誤時下方程式法還未執行，所以網頁會空白
        $error="<span style='color:red'>帳號或密碼錯誤</span>";//將錯誤存入變數，並在下方嗅出
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0055)?do=admin -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>影城</title>
  <link rel="stylesheet" href="css/css.css">
  <link href="css/s2.css" rel="stylesheet" type="text/css">
  <script src="scripts/jquery-1.9.1.min.js"></script>
</head>

<body>
  <div id="main">
    <div id="top" style=" background:#999 center; background-size:cover; " title="替代文字">
      <h1>ABC影城</h1>
    </div>
    <div id="top2">
      <a href="index.php">首頁</a>
      <a href="index.php?do=order">線上訂票</a>
      <a href="#">會員系統</a>
      <a href="back.php">管理系統</a>
    </div>
    <div id="text"> <span class="ct">最新活動</span>
      <marquee direction="right">
        ABC影城票價全面八折優惠1個月
      </marquee>
    </div>
    <div id="mm">
      <?php
      // session_start(); 不能有兩次session_start();
      if (isset($_SESSION['login'])) {//session 梅的話 去登入畫面
        $do = $_GET['do'] ?? "main";
        $file = "back/$do.php";
        include_once "./back/nav.php";//back .nav 

        if (file_exists($file)) {
          include_once $file;
        } else {
          include_once "back/main.php";
        }
      } else {
        include_once "back/login.php";
        if(isset($error)) echo $error; //將錯誤訊息，移到下方
      }
      ?>
    </div>
    <div id="bo"> ©Copyright 2010~2014 ABC影城 版權所有 </div>
  </div>
</body>

</html>