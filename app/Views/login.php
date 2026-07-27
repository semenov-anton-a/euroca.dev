<!DOCTYPE html>
<html lang="<?= session('locale', 'en') ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- TITLE -->
    <title>EuroCargo Finland Oy</title>
    <style type="text/css">
    body {
        font-family: 'Varela Round', sans-serif;
        /* background-image: "<?=base_url('assets/img/warehouse.jpg')?>"; */
        background: url(assets/img/warehouse.jpg) no-repeat center center fixed;
        background-size: cover;
        width: 100%;
        height: 100%;
        background-position: top center;
        background-attachment: fixed;
        background-repeat: no-repeat;
        background-size: cover;
    }
    .modal-login {top: 50px;color: #636363;width: 350px;margin: 80px auto 0;}
    .modal-login .modal-content {padding: 20px;border-radius: 5px;border: none;}
    .modal-login .modal-header {border-bottom: none;position: relative;justify-content: center;}
    .modal-login h4 {text-align: center;font-size: 26px;/* margin: 30px 0 -15px; */}
    .modal-login p {text-align: center;font-size: 16px;margin: 30px 0 -15px;color: red;}
    .modal-login .form-control:focus { border-color: #70c5c0; }
    .modal-login .form-control,
    .modal-login .btn {min-height: 40px; border-radius: 3px;}
    .modal-login .close {position: absolute;top: -5px;right: -5px;}
    .modal-login .modal-footer {
        background: #ecf0f1;
        border-color: #dee4e7;
        text-align: center;
        justify-content: center;
        margin: 0 -20px -20px;
        border-radius: 5px;
        font-size: 13px;
    }
    .modal-login .modal-footer button {color: #9999;}
    .modal-login .avatar {
        position: absolute;
        margin: 0 auto;
        left: 0;
        right: 0;
        top: -95px;
        width: 128px;
        height: 128px;
        border-radius: 50%;
        z-index: 9;
        /* background: #60c7c1; */
        /* background: #60c7c1; */
        /* padding: 15px; */
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
    }
    .modal-login .avatar img {width: 100%;}
    .modal-login .btn {
        color: #fff;
        border-radius: 4px;
        /* background: #60c7c1; */
        /* background: #60c7c1; */
        text-decoration: none;
        transition: all 0.4s;
        line-height: normal;
        border: none;
    }
    .modal-login .btn:hover,
    .modal-login .btn:focus {/* background: #45aba6; */outline: none;}
    .trigger-btn {display: inline-block;margin: 100px auto;}
    </style>
</head>

<body>
    <script type="text/javascript">$(document).ready(function() { $('#loginModal').modal('show'); });</script>
    <!-- Modal HTML -->
    <div id="loginModal" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static"
        data-keyboard="false">
        <div class="modal-dialog modal-login">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">EuroCargo Finland</h4>
                </div>
                <div class="modal-body">
                    <form autocomplete="off" action="" method="post" id="adminLogin">
						<input type="hidden" name="token" value=""/>
                        <?= csrf_field("csrf_token") ?>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="E-Mail"
                                required="required">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password"
                                required="required">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block login-btn">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>