<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">
        <title>系統首頁</title>
        <link rel="shortcut icon" href="favicon.ico" />
        <link href="dist/css/bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" href="dist/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="dist/css/docs.min.css">
        <script type="text/javascript" src="dist/js/jquery.min.js"></script> 
    </head>
    <div class="container">
        <div class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    </button>
                    <a class="navbar-brand" href="index.php">CarServer</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <?php
                        if ($_SESSION['user_id']) {//if login
                            echo '<li class="#"><a href="#">歡迎 ' . $_SESSION['name'] . '</a></li>';
//                            echo '<li id ="seller_orders" class="#"><a href="#">客戶訂單</a></li>';
//                            echo '<li id ="addgoods" class="#"><a href="#">新增商品</a></li>';
//                            echo '<li id ="cart" class="#"><a href="#">購物車</a></li>';
//                            echo '<li id ="bought" class="#"><a href="#">已購買</a></li>';
                            echo '<li id ="uploadData" class="#"><a href="#">新增資料</a></li>';
                            echo '<li id ="acc" class="#"><a href="#">管理</a></li>';
                            echo '<li class="#"><a href="logout.php">登出</a></li>';
                        } else {
                            echo '<li id ="login" class="#"><a href="#">會員登入</a></li>';
                            echo '<li id ="register" class="#"><a href="#">免費註冊</a></li>';
                        }
                        ?>
                    </ul>
                </div>	
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <ul class="list-group">
                    <li class="list-group-item" id="publicInfo"><a href="#">所有資訊</a></li>
                    <li class="list-group-item" id="privateInfo" name="qa"><a href="#">個人資訊</a></li>
                </ul>
            </div>
            <div class="col-md-10" id="infoFrame">
            </div>
        </div>
        <footer><p>Copyright © 2016 </p></footer>
    </div>
    <script src="dist/js/jquery.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>

    <script>
        function loadList(filter_type) {
            $.post(
                    "cars_list.php",
                    {type_id: filter_type},
                    function (data) {
                        $('#infoFrame').html(data);
                    }, "html");
        }

        $(document).ready(function () {
            loadList(0);
        });
        $('#publicInfo').click(function () {
            loadList(0);
        });

        $('#privateInfo').click(function () {
            loadList(1);
        });

<?php
if ($_SESSION['user_id']) {//if login
    echo "\$('#uploadData').click(function() {\$.get('uploadData.php').success(function(data) { \$('#infoFrame').html(data);});});";
    echo "\$('#acc').click(function() {\$.get('updateInfo.php').success(function(data) { \$('#infoFrame').html(data);});});";
} else {
    echo "\$('#login').click(function() {\$.get('login.php').success(function(data) { \$('#infoFrame').html(data);});});";
    echo "\$('#register').click(function() {\$.get('register.php').success(function(data) { \$('#infoFrame').html(data);});});";
}
?>

    </script>

</body>
</html>