<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require 'core/init.php';
    
    DB::getInstance();

    if(Users::logged_in()){
    //    echo 'welcome';
    }else{
        
        $_GET['invalid_user'] = 'invalid';
        header("Location: index.php");
    }
    
    if(isset($_POST['submit']) && empty($_POST) === false ){
        $email = $_POST['email'];
        
        
        $requred_worker = array('username','password', 'email', 'dept');
        $requred_worker_info = array('firstname', 'lastname');
        
        foreach($_POST as $key=>$value){
            if(empty($value) && in_array($key, $requred_worker) === true){
                $error[] = 'Fields are required.';
                break 1;
            }
        }
        
        //if no errors
        if ( empty($error) === true ){
            
            if(Users::user_exists($email) === true ){
                $error[] = 'User email already exists';
            } 
        }
        
    }
    
    
    /**
     * IF NO ERRORS AND SUBMITED SUCCESFULLY
     */
    if(empty($_POST) === false && empty($error) === true){
        //CREATE A DEPARTMENT.
        
        $date = date('Y-m-d');
        
        $_worker_data = array(
            'username' =>   $_POST['username'],
            'password' =>   $_POST['password'],
            'email' =>   $_POST['email'],
            'hiredate'  =>  $date,
            'department' =>   $_POST['dept'],
            'salary'    =>  $_POST['salary'],
        ); 
        
        //inserting to worker table;
        $insert = DB::getInstance()->insert('worker', $_worker_data );
        
        if($insert == true){
            
            $userid = DB::getInstance()->query('worker', array(
                                        'email' => $_POST['email']
                                    ));
            
            $_worker_information = array(
                'firstname' =>   $_POST['firstname'],
                'lastname' =>   $_POST['lastname'],
                'address' =>   $_POST['address'],
                'gender' =>   $_POST['gender'],
                'phone' =>  $_POST['phone'],
                'userid'    =>  $userid,
            ); 
            
            //  print_r($_worker_information);
            //  die();

            $insert = DB::getInstance()->insert('worker_info', $_worker_information );
            
            if($insert){
                $_GET['result'] = 'successful'; 
            }else{
                $error[] = 'Problem.';
            }
        }  else {
            
            $error[] = 'Insert Problem. Try again.';
            
        }
    }
    
    
    

    if(isset($error)){
        print_r($error);
    }
    
    

?>




<!DOCTYPE html>
<html>
<head>
    <title>Register Worker | <?php echo $user_data['username']; ?></title>
    <link href="css/style.css" type="text/css" rel="stylesheet">
</head>
<body>
    
    
    
    <?php include 'template-part/userInformation.php'; ?>
    
    <div class="wraper">
        <?php include 'template-part/lists.php'; ?>
    
        <div class="content">
            <div class="widget">
                <h2>Register Worker</h2>
                <hr>
                
                <?php if(isset($_GET['result'])) :   ?>
                <p class="success"> 
                    <?php echo 'Successfully done.' ?>
                </p>
                <?php endif; ?>

                <form method="post" enctype="multipart/form-data">
                <!-- table -->
                    <table width="100%">
                        <!-- firstname & lastname -->
                        <tr>
                            <td align="right"><label>First Name : </label></td>
                            <td><input type="text" name="firstname" placeholder="Enter First Name"></td>
                            
                            <td align="right"><label>Last Name : </label></td>
                            <td><input type="text" name="lastname" placeholder="Enter Last Name"></td>
                        </tr>
                        <!-- username -->
                        <tr>
                            <td align="right"><label>Username : </label></td>
                            <td><input type="text" name="username" placeholder="Enter Username"></td>
                            
<!--                            <td align="right">Upload Image : </td>
                            <td><input type="file" name="image" placeholder="Enter First Name"></td>-->
                            <!-- password -->
                            
                            <td align="right"><label>Phone : </label></td>
                            <td><input type="text" name="phone" placeholder="Enter Phone Number" value="+880"></td>
                        </tr>
                        
                        <!-- email address -->
                        <tr>
                            <td align="right"><label>Email Address : </label></td>
                            <td><input type="text" name="email" placeholder="Enter Email Address"></td>
                            
                            
                            <td align="right"><label>Salary : </label></td>
                            <td><input type="text" name="salary" placeholder="$"></td>
                        </tr>
                        
                        <!-- GENDER -->
                        <tr>
                            <td align="right"><label>Gender : </label></td>
                            <td><input type="radio" name="gender" value="male" checked> Male <input type="radio" name="gender" value="female"> Female</td> 
                            
                            <td align="right"><label>Department : </label></td>
                            <td>
                            <?php $department = Users::getDepartment();  ?>
                                <select name="dept">
                                    <option value="default">-SELECT-</option>
                                    <?php while($row = mysql_fetch_assoc($department)) :  ?>
                                    <option value="<?php echo $row['dept_name']; ?>"><?php echo strtoupper($row['dept_name']); ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </td>
                        </tr>
                        
                        <tr>
                            <td align="right">Address : </td>
                            <td><textarea rows="6" name="address"></textarea></td>
                        </tr>

                        
                        
                        <!-- password -->
                        <tr>
                            <td align="right"><label>Password : </label></td>
                            <td><input type="password" name="password" placeholder="Enter Password"></td>
                        </tr>
                        
                        <!-- submit  -->
                        <tr>
                            <td></td>
                            <td><input type="submit" name="submit" value="Submit"></td>
                        </tr>

                    </table>
                    <!-- table -->
                </form>
                
            </div>
        </div>
    
        
        
    
    </div>
    
    
</body>
</html>
