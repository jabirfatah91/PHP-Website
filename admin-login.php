<?php include('includes/header-admin-login.php'); ?>

<?php include('server.php') ?>

<html>
    <head>
        <style>
            /*
            To change this license header, choose License Headers in Project Properties.
            To change this template file, choose Tools | Templates
            and open the template in the editor.
            */
            /* 
                Created on : Jun 2, 2020, 10:31:31 AM
                Author     : Jabir
            */

            * {
                margin: 0px;
                padding: 0px;

            }


            body {
                font-size: 150%;

                min-height: 100%;

                background-image: url('./images/back.jpg');

                background-repeat:no-repeat;

                background-attachment:fixed;

            }



            .header {
                width: 30%;
                margin: 50px auto 0px;
                color: white;
                background: #5F9EA0;
                text-align: center;
                border: 1px solid #B0C4DE;
                border-bottom: none;
                border-radius: 10px 10px 0px 0px;
                padding: 20px;
            }
            form, .content {
                width: 80%;
                margin: 0px auto;
                padding: 20px;
                /*
                border: 1px solid #B0C4DE;
                */

                background: white;
                /*
                border-radius: 0px 0px 10px 10px;
                */
            }
            .input-group {
                margin: 10px 0px 10px 0px;
            }
            .input-group label {
                display: block;
                text-align: left;
                margin: 3px;
            }
            .input-group input {
                height: 50px;
                width: 100%;
                padding: 5px 10px;
                font-size: 16px;
                border-radius: 5px;
                border: 1px solid gray;
            }
            .btn {
                padding: 10px;
                font-size: 20px;
                color: white;
                background: #5F9EA0;
                border: none;
                border-radius: 5px;
            }
            .error {
                width: 92%; 
                margin: 0px auto; 
                padding: 10px; 
                border: 1px solid #a94442; 
                color: #a94442; 
                background: #f2dede; 
                border-radius: 5px; 
                text-align: left;
            }
            .success {
                color: #3c763d; 
                background: #dff0d8; 
                border: 1px solid #3c763d;
                margin-bottom: 20px;
            }
        </style>
    </head>
    <body>
        <div id="content">
            <div class="box-section contact-section triggerAnimation animated" data-animate="flipInY">

                <form method="post" action="admin-login.php">
                    <?php include('errors.php'); ?>
                    <div class="input-group">
                        <label>Username</label>
                        <input type="text" name="username" >
                    </div>
                    <div class="input-group">
                        <label>Password</label>
                        <input type="password" name="password">
                    </div>
                    <div class="input-group">
                        <button type="submit" class="btn" name="login_user">Login</button>
                    </div>
<!--                <p>
                        Not an admin yet? <a href="register.php">Sign up</a>
                    </p>-->
                </form>
            </div>
    </body>

</html>
<?php include('includes/footer.php'); ?>