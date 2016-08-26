<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require 'core/init.php';


if(empty($_POST) === false ){

    DB::getInstance();

    //submited information
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($email) === true || empty($password) === true){
        //if empty
        $error[] = 'Please enter Email and Password';

    }else if(Users::user_exists($email) === false){

        $error[] = 'User don\'t exist.';

    }else{

        //check 'MANAGER' table
        $login = DB::getInstance()->get('manager', array(
                                            "email='$email'",
                                            "password='$password'"
        ));




        if($login == false){
            //check 'WORKER' table
            $login = DB::getInstance()->get('worker', array(
                                            "email='$email'",
                                            "password='$password'")
                    );


            if($login == false){
                echo 'INVALID USER';
            }else{
                /** WORKER INFORMATION **/
                //START SESSION;
                //START SESSION;
                $_SESSION['user'] = $login;
                $_SESSION['role'] = 'Worker';


                //START COOKIE; - MANAGER
                header("Location: worker.php");
                exit();
                //START COOKIE; - WORKER

            }

        }else {
            /** MANAGER INFORMATION **/
            //START SESSION;
            $_SESSION['user'] = $login;
            $_SESSION['role'] = 'Manager';


            //START COOKIE; - MANAGER
            header("Location: dashboard.php");
            exit();
        }

    }

}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Login Here</title>
    <link href="css/style.css" type="text/css" rel="stylesheet">
</head>
<body>

    <div class="wraper">
        <!-- title -->
        <div class="title">
            <img src="img/logo.png" alt="logo">
            <h2>Login Here</h2>

        </div>
        <!-- title -->

        <div class="login-content">
            <form method="post">
                <!-- table -->
                <table width="40%">
                    <tr align >
                        <td align="right"><label>Email Address : </label><br /><br /></td>
                        <td><input type="email" name="email" placeholder="Enter Username"><br /><br /></td>

                    </tr>

                    <tr>
                        <td align="right"><label>Password : </label><br /><br /></td>
                        <td><input type="password" name="password" placeholder="Enter Password"><br /><br /></td>
                    </tr>

                    <tr>
                        <td><br /><br /></td>
                        <td><input type="submit" name="submit" value="Submit"><br /><br /></td>
                    </tr>

                </table>
                <!-- table -->
            </form>
        </div>





    </div>

</body>
</html>
