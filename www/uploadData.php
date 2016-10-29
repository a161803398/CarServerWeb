<?php
session_start();
if (!$_SESSION['user_id']) {
    header("Location:login.php");
}
include("/tools/db.php");
header("Content-Type:text/html; charset=utf-8");
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
        <title>shopping</title>
        <link rel="shortcut icon" href="favicon.ico" />
        <link href="dist/css/bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" href="dist/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="dist/css/docs.min.css">
        <script type="text/javascript" src="dist/js/jquery.min.js"></script>
    </head>
    <body>
        <div class="container"> 
            <h1 id ="webtitle" class="glyphicon glyphicon-cog overview-normalize">New Info</h1>
        </div>
        <div class="bs-example"> 
            <div id="alert_placeholder">
            </div>
            <div class="row ">
                <div class=" col-md-4">
                    <?php
                    foreach ($carInsertInfoCols as &$value) {
                        echo '<p class="context">' . $value . '</p>';
                        echo '<input type="text" class="form-control" id="' . $value . '" placeholder="' . $value . '">';
                    }
                    ?>
                </div>
            </div>
            <button class="btn btn-success" type="submit" onclick="ok_mod()">確認</button>
            <button class="btn btn-danger " type="submit" onclick="go_back()">返回</button>
        </div>	 	

    </body>
</html>
<script>
    function showalert(message, alerttype) {
        $("#alertdiv").remove();
        $('#alert_placeholder').append('<div id="alertdiv" class="alert ' + alerttype + '"><a class="close" data-dismiss="alert">×</a><span>' + message + '</span></div>')
    }

    function ok_mod() {
        var json = {
<?php
foreach ($carInsertInfoCols as &$value) {
    echo $value . ': $("#' . $value . '").val(),';
}
?>
            apiFun: "infoAdd"
        }

        $.post(
                "carInfoApi.php",
                json,
                function (data)
                {
                    showalert(data, 'alert-success');
                    console.log(data);
                }
        );

    }

    function go_back() {
        $.post("cars_list.php",
                {type_id: 0},
                function (data) {
                    $('#infoFrame').html(data);
                }, "html");
    }

</script>