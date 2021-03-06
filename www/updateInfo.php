<?php
session_start();
if (!$_SESSION['user_id']) {
    header("Location:login.php");
}
?>
<html>
    <head>

        <script type="text/javascript">

            function chk() {
                function showalert(message, alerttype) {
                    $("#alertdiv").remove();
                    $('#alert_placeholder').append('<div id="alertdiv" class="alert ' + alerttype + '"><a class="close" data-dismiss="alert">×</a><span>' + message + '</span></div>')
                }


                if (document.form1.name.value == '') {
                    showalert('姓名未填！', 'alert-danger');
                    document.form1.name.focus();
                    return false;
                }
                if (document.form1.account.value == '') {
                    showalert('帳號未填！', 'alert-danger');
                    document.form1.account.focus();
                    return false;
                }
                if (document.form1.oldPassword.value == '') {
                    showalert('請輸入舊密碼！', 'alert-danger');
                    document.form1.oldPassword.focus();
                    return false;
                }

                if (document.form1.newPassword.value !== document.form1.password2.value) {
                    showalert('密碼不符！', 'alert-danger');
                    document.form1.password2.focus();
                    return false;
                }
                if (document.form1.email.value == '') {
                    showalert('信箱未填！', 'alert-danger');
                    document.form1.email.focus();
                    return false;
                }
                return true;
            }
        </script>

    </head>

    <body >
        <div id="alert_placeholder">
        </div>
        <div class="container">


            <div align="center" class ="row">
                <h1><small>會員資料</small></h1>

                <form name="form1" class="row col-xs-4 col-xs-offset-4" method="post"  name="form1" action="updatecheck.php" onsubmit="return chk();">
                    <div class="input-group">
                        <span class="input-group-addon">姓&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp名</span>
                        <input type="text" class="form-control" name="name" disabled="disabled">
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon">登入帳號</span>
                        <input type="text" class="form-control" name="account" disabled="disabled">
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">舊的密碼</span>
                        <input type="password" class="form-control" name="oldPassword" >
                    </div>  
                    
                    <div class="input-group">
                        <span class="input-group-addon">新的密碼</span>
                        <input type="password" class="form-control" name="newPassword" placeholder="若空白則不更改密碼">
                    </div>  

                    <div class="input-group">
                        <span class="input-group-addon">密碼確認</span>
                        <input type="password" class="form-control" name="password2" >
                    </div>      

                    <div class="input-group">
                        <span class="input-group-addon">信&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp箱</span>
                        <input type="email" class="form-control"  name="email">
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon">市&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp話</span>
                        <input type="text" class="form-control" name="phone" placeholder="02-1234567">
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon">手&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp機</span>
                        <input type="text" class="form-control" name="mobilephone" placeholder="0911-111-111" >
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon">住家地址</span>
                        <input type="text" class="form-control" name="live_in">
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon">性&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp別</span>
                        <select name="sex"class="form-control" >
                            <option value="u">不公開</option>
                            <option value="m">男性</option>
                            <option value="f">女性</option>
                        </select>
                    </div> 
                    <br>
                    <button class="btn btn-success" type="submit">更改</button>
                </form>	
            </div>
        </div>

        <script src="dist/js/jquery.min.js"></script>
        <script src="../../dist/js/bootstrap.min.js"></script>
        <script>
       $(document).ready(function() {
<?php
include("/tools/db.php");

$user_id = $_SESSION['user_id'];

$sql = "SELECT name, sex, email, phone, mobilephone, live_in " .
        "FROM users " .
        "WHERE user_id = '$user_id'";

$user_info = mysql_fetch_row(mysql_query($sql));

if (mysql_errno() != 0) {
    echo "alert('" . mysql_errno() . ": " . mysql_error() . "');"; //show other error
}
echo"$(\"input[name='account']\").val('$user_id');";
echo"$(\"input[name='name']\").val('$user_info[0]');";
echo"$(\"select[name='sex']\").val('$user_info[1]');";
echo"$(\"input[name='email']\").val('$user_info[2]');";
echo"$(\"input[name='phone']\").val('$user_info[3]');";
echo"$(\"input[name='mobilephone']\").val('$user_info[4]');";
echo"$(\"input[name='live_in']\").val('$user_info[5]');";
?>
                    });
        </script>
    </body>
</html>