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

if(isset($_POST['submit']) && empty($_POST) === false){
    
    $deptName = $_POST['dept_name'];
    $deptInfo = $_POST['dept_info'];
    
    
    if(empty($deptName) === true || empty($deptInfo) === true ){
        $error[] = 'Empty department name.';
        
    }else if(Users::dept_exists($deptName) === true){
        $error[] = 'Department already exists';
    
        
    }else{
        //CREATE A DEPARTMENT.
        $insert = DB::getInstance()->insert('departments', array(
                                        'dept_name' =>  "$deptName",
                                        'dept_info' =>  $deptInfo,
                                    ));
        
        if($insert){
            $_GET['result'] = 'successful';
        }  else {
            
            $error[] = 'Insert Problem. Try again.';
            
        }
    }
    
    
    print_r($error);
    
}



?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Department | <?php echo $user_data['username']; ?></title>
    <link href="css/style.css" type="text/css" rel="stylesheet">
</head>
<body>
    
    
    <?php include 'template-part/userInformation.php'; ?>
    
    <div class="wraper">
        <?php include 'template-part/lists.php'; ?>
        
        
        <div class="content">
            <div class="widget">
                <h2>Create Department</h2>
                <hr>
                <br>
                <?php if(isset($_GET['result'])) :   ?>
                <p class="success"> 
                    <?php echo 'Successfully done.' ?>
                </p>
                <?php endif; ?>
                
                <form method="post">
                    <!-- table -->
                    <table width="100%">
                        <tr align="">
                            <td align="right"><label>Department Name :</label><br>
                            <br></td>
                            <td><input name="dept_name" placeholder="enter department name"
                            type="text"><br>
                            <br></td>
                        </tr>
                        <tr>
                            <td align="right"><label>Description :</label><br>
                            <br></td>
                            <td>
                            <textarea name="dept_info" rows="6"></textarea><br>
                            <br></td>
                        </tr>
                        <tr>
                            <td><br><br></td>
                            <td><input name="submit" type="submit" value="Submit"><br><br></td>
                        </tr>
                    </table><!-- table -->
                </form>
            </div>
        </div>
    </div>
    
    
    
    
</body>
</html>
