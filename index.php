<?php header('Access-Control-Allow-Origin: *'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>4K Activate</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sweetalert.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sweetalert.min.js"></script>
    <script src="http://mymaplist.com/js/vendor/TweenLite.min.js"></script>
</head>
<body>
<style>
    body {
        background-color: #444;
        background: url(http://s18.postimg.org/l7yq0ir3t/pick8_1.jpg);

    }
    .form-signin input[type="text"] {
        margin-bottom: 5px;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }
    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
    .form-signin .form-control {
        position: relative;
        font-size: 16px;
        font-family: 'Open Sans', Arial, Helvetica, sans-serif;
        height: auto;
        padding: 10px;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    .vertical-offset-100 {
        padding-top: 30px;
    }
    .img-responsive {
        display: block;
        max-width: 100%;
        height: auto;
        margin: auto;
    }
    .panel {
        margin-bottom: 20px;
        background-color: rgba(255, 255, 255, 0.75);
        border: 1px solid transparent;
        border-radius: 4px;
        -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
    }
</style>
<div class="container">
    <div class="row vertical-offset-100">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row-fluid user-row">
                        <img src="http://s11.postimg.org/7kzgji28v/logo_sm_2_mr_1.png" class="img-responsive" alt="Conxole Admin"/>
                    </div>
                </div>
                <div class="panel-body">
                    <form accept-charset="UTF-8" role="form" class="form-signin" id="activateForm" name="activateForm">
                        <fieldset>
                            <div class="form-group">
                                <label for="tel">เบอร์โทร :</label>
                                <input class="form-control" placeholder="087-725-55533" id="tel" name="tel" type="text">
                            </div>
                            <div class="form-group">
                                <label for="username">ยูสเซอเนม :</label>
                                <input class="form-control" placeholder="aommiez" id="username" name="username" type="text">
                            </div>
                            <div class="form-group">
                                <label for="password">รหัสผ่าน :</label>
                                <input class="form-control" placeholder="123456" id="password" name="password" type="password">
                            </div>
                            <div class="form-group">
                                <label for="email">อีเมล์ :</label>
                                <input class="form-control" placeholder="test@email.com" id="email" name="email" type="text">
                            </div>
                            <div class="form-group">
                                <label for="macAddress">เลข Mac Address กล่อง :</label>
                                <input class="form-control" placeholder="9CH8AB04WCD1" id="macAddress" name="macAddress" type="text">
                            </div>
                            <div class="form-group">
                                <label for="addr">ที่อยู่ :</label>
                                <textarea class="form-control" rows="3" id="addr" name="addr"></textarea>
                            </div>
                            <select class="form-control" id="province" name="province">
                                <option selected>จังหวัด</option>
                                <?php
                                $url = "http://4kmoviestar.com/api/provinces";
                                $json = file_get_contents($url);
                                $json_data = json_decode($json, true);
                                foreach ($json_data as $key => $value ) {
                                    echo <<<HTML
                                    <option value="{$value["PROVINCE_ID"]}">{$value["PROVINCE_NAME"]}</option>
HTML;
                                }
                                ?>
                            </select>
                            <br>
                            <select class="form-control" id="buyfrom" name="buyfrom">
                                <option selected>ซื้อจาก</option>
                                <?php
                                $url = "http://4kmoviestar.com/api/buyfrom";
                                $json = file_get_contents($url);
                                $json_data = json_decode($json, true);
                                foreach ($json_data as $key => $value ) {
                                    echo <<<HTML
                                    <option value="{$value["id"]}">{$value["shop_name"]}</option>
HTML;
                                }
                                ?>
                            </select>
                            <br>
                            <input class="btn btn-lg btn-success btn-block" id="login" value="Activate">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function() {
        $("#login").click(function(){
            event.preventDefault();
            $.ajax({
                url: 'http://4kmoviestar.com/api/activate',
                type: "POST",
                crossDomain: true,
                dataType: 'json',
                data: $("#activateForm").serialize(),
                success: function (result) {
                    console.log(result);
                    if (result['ss'] == 'success') {
                        swal("Success!", "Activate สำเร็จ คุณสามารถเข้าสู่ระบบโดย username และ password ได้เลยครับ !", "success")
                    } else if (result['ss'] == 'mac use') {
                        swal({title: "Something went wrong!", text:"Mac Address ถูกใช้งานโดยผู้ใช้งานอื่นแล้ว", timer: 2000, type: "error"});
                    } else if (result['ss'] == 'no mac') {
                        swal({title: "Something went wrong!", text:"Mac Address นี้ไม่มีในระบบ", timer: 2000, type: "error"});
                    }
                },
                error: function (result) {
                    console.log(result);
                    swal({title: "Something went wrong!", text: "Server Error !", timer: 2000, type: "error"});
                }
            });
        });
        $(document).mousemove(function(event) {
            TweenLite.to($("body"),
                .5, {
                    css: {
                        backgroundPosition: "" + parseInt(event.pageX / 8) + "px " + parseInt(event.pageY / '12') + "px, " + parseInt(event.pageX / '15') + "px " + parseInt(event.pageY / '15') + "px, " + parseInt(event.pageX / '30') + "px " + parseInt(event.pageY / '30') + "px",
                        "background-position": parseInt(event.pageX / 8) + "px " + parseInt(event.pageY / 12) + "px, " + parseInt(event.pageX / 15) + "px " + parseInt(event.pageY / 15) + "px, " + parseInt(event.pageX / 30) + "px " + parseInt(event.pageY / 30) + "px"
                    }
                });
        });
    });
</script>

</body>
</html>