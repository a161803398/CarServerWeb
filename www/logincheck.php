<?php
session_start();
header("Content-Type:text/html; charset=utf-8");
?>
<?php

include("/tools/base.php");
include("/tools/db.php");

mysql_query("set names utf8");
$account = mysql_escape_string($_POST["account"]);
$plainText = mysql_escape_string($_POST["password"]);
$password = sha1($salt . $account . $plainText); //use user_id as salt

$str = "select password, name from users where user_id ='$account'";
$result = mysql_query($str);
$row = mysql_fetch_row($result);

if ($row[0] == $password) {
    $_SESSION['user_id'] = $account;
    $_SESSION['name'] = $row[1];
    jsAlert("登入成功！！");
    jsRedirect("index.php");
//    header("Location:login_user.php");
} else {
    jsAlert("帳號或密碼錯誤，登入失敗！！");
    jsRedirect("login.php");
//    header("Location:register.php");
}
?>