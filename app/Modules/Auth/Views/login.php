<!DOCTYPE html>
<html lang="<?= esc(service('language')->getLocale()) ?>">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.0/css/all.min.css" integrity="sha512-ApSLB1Pd3/bZN8fWB/RG9YhN/7bd9Hkf3AGaE2mPfebjrxagjuBtx2GcgdqIlJkUzwylBo61r9Xa9NmgBI0swA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/htmx.org@2.0.10/dist/htmx.min.js"
        integrity="sha384-H5SrcfygHmAuTDZphMHqBJLc3FhssKjG7w/CeCpFReSfwBWDTKpkzPP8c+cLsK+V"
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- TITLE -->
    <title>EuroCargo Finland Oy</title>
    <style type="text/css">
        body {
            font-family: 'Varela Round', sans-serif;
            /* background-image: "<?= base_url('assets/img/warehouse.jpg') ?>"; */
            background: url(assets/img/warehouse.jpg) no-repeat center center fixed;
            background-size: cover;
            width: 100%;
            height: 100%;
            background-position: top center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .modal-login {
            top: 50px;
            color: #636363;
            width: 350px;
            margin: 80px auto 0;
        }

        .modal-login .modal-content {
            padding: 20px;
            border-radius: 5px;
            border: none;
        }

        .modal-login .modal-header {
            border-bottom: none;
            position: relative;
            justify-content: center;
        }

        .modal-login h4 {
            text-align: center;
            font-size: 26px;
            /* margin: 30px 0 -15px; */
        }

        .modal-login p {
            text-align: center;
            font-size: 16px;
            margin: 30px 0 -15px;
            color: red;
        }

        .modal-login .form-control:focus {
            border-color: #70c5c0;
        }

        .modal-login .form-control,
        .modal-login .btn {
            min-height: 40px;
            border-radius: 3px;
        }

        .modal-login .close {
            position: absolute;
            top: -5px;
            right: -5px;
        }

        .modal-login .modal-footer {
            background: #ecf0f1;
            border-color: #dee4e7;
            text-align: center;
            justify-content: center;
            margin: 0 -20px -20px;
            border-radius: 5px;
            font-size: 13px;
        }

        .modal-login .modal-footer button {
            color: #9999;
        }

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

        .modal-login .avatar img {
            width: 100%;
        }

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
        .modal-login .btn:focus {
            /* background: #45aba6; */
            outline: none;
        }

        .trigger-btn {
            display: inline-block;
            margin: 100px auto;
        }

        .login-spinner {
            display: none;
        }

        .htmx-request .login-text {
            display: none;
        }

        .htmx-request .login-spinner {
            display: inline-block;
        }

        #login-message {
            display: none;
            margin-top: 15px;
            text-align: center;
            border-radius: 4px;
        }

        #login-message:not(:empty) {
            display: block;
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

</head>

<body>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#loginModal').modal('show');
        });
    </script>
    <!-- Modal HTML -->
    <div id="loginModal" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static"
        data-keyboard="false">
        <div class="modal-dialog modal-login">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">EuroCargo Finland</h4>
                </div>
                <div class="modal-body">
                
                    <?php
                    if (ENVIRONMENT == 'development') 
                    {
                        $email = "semenov.anton.a@gmail.com";
                        $password = "12345678";
                    }
                    ?>
                
                    <form
                        hx-post="<?= base_url('login') ?>"
                        hx-target="#login-message"
                        hx-swap="innerHTML"
                        hx-disabled-elt="button"
                        autocomplete="off"
                        id="adminLogin">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <input <?= isset($email) ? "value=\"{$email}\"" : "" ?>
                                type="email"
                                class="form-control"
                                name="email"
                                placeholder="<?= lang('Auth.email_placeholder') ?>"
                                required>
                        </div>

                        <div class="form-group">
                            <input <?= isset($password) ? "value=\"{$password}\"" : "" ?>
                                type="password"
                                class="form-control"
                                name="password"
                                placeholder="<?= lang('Auth.password_placeholder') ?>"
                                required>
                        </div>

                        <div class="form-group">
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" name="remember" value="1">
                                    <?= lang('Auth.remember_me') ?>
                                </label>
                            </div>

                            <div id="login-message" class="alert alert-danger "></div>

                            <button
                                type="submit"
                                class="btn btn-primary btn-lg btn-block login-btn">
                                <span class="login-text">
                                    <?= lang('Auth.login_title') ?>
                                </span>

                                <span class="login-spinner">
                                    <i class="fas fa-spinner fa-spin"></i>
                                </span>
                            </button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</body>

</html>