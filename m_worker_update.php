<?php


require 'core/init.php';
    
if(Users::logged_in()){
//    echo 'welcome';
}else{
   
    $_GET['invalid_user'] = 'invalid';
    header("Location: index.php");
}


/* 
 * To change tdis license header, choose License Headers in Project Properties.
 * To change tdis template file, choose Tools | Templates
 * and open tde template in tde editor.
 */

    
    $connect = DB::getInstance();
    
    //FEATCH WORKER DETAILS
    $result = Users::workerDetails('worker', 'worker_info', array(
                                            'wr.id'  => $_GET['userid'],
                                        ));
    
    $x = 1;
    
    
    if(isset($_POST['update'])){
        
        //EMAIL ADDRESS EXIST / NOT
        if(Users::user_exists($_POST['email']) == true){
            $error[] = 'Email Address already taken.';
        
            
        }else if($_POST['dept'] == 'default'){
            $error[] =  'Please select a department';
            
        }
        
        
        
        else{
            
            $_worker_information = array(
                    'firstname' =>   $_POST['firstname'],
                    'lastname' =>   $_POST['lastname'],
                    'gender' =>   $_POST['gender'],
                    'phone' =>  $_POST['phone'],
                ); 

                $insert = DB::getInstance()->update('worker_info',array('userid' => $_GET['userid']), $_worker_information );
                
                
                
            //NOW YOU CAN UPDATE
            $_worker_data = array(
                'username' =>   $_POST['username'],
                'email' =>   $_POST['email'],
                'hiredate'  =>  $date,
                'department' =>   $_POST['dept'],
                'salary'    =>  $_POST['salary'],
            ); 

            //inserting to worker table;
            $insert = DB::getInstance()->update('worker',array('id' => $_GET['userid']), $_worker_data );

            
            if($insert == true){
                
                $_worker_information = array(
                    'firstname' =>   $_POST['firstname'],
                    'lastname' =>   $_POST['lastname'],
                    'address' =>   $_POST['address'],
                    'gender' =>   $_POST['gender'],
                    'phone' =>  $_POST['phone'],
                ); 

                $insert = DB::getInstance()->update('worker_info',array('userid' => $_GET['userid']), $_worker_information );

                if($insert){
                    $_GET['result'] = 'successful'; 
                }else{
                    $error[] = 'Problem.';
                }
            }  else {

                $error[] = 'Insert Problem. Try again.';

            }
            
            
        }
    }
    
    
    print_r($error);
    
    
    
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard | <?php echo $user_data['username']; ?></title>
    <link href="css/style.css" type="text/css" rel="stylesheet">
</head>
<body>
   
    <?php include 'template-part/userInformation.php'; ?>
    
    <div class="wraper">
        
        <?php include 'template-part/lists.php'; ?>
    
    
    
        <div class="content">
            <div class="widget">
                <h2>Worker Details</h2>
                <hr>
                
                <form method="post">
                    <table widtd="100%" cellspacing="1" cellpadding="4" border="1" align="center">
                        <tbody>


                            <?php while ($row = mysql_fetch_assoc($result)) :   ?>
                            <tr bgcolor="#ccc" align="center">
                                <td>First Name</td>
                                <td><input type="text" name="firstname" value="<?php echo $row['firstname'] ?>"></td>
                            </tr>
                            
                            <tr bgcolor="#ccc" align="center">
                                <td>Last Name</td>
                                <td><input type="text" name="lastname" value="<?php echo $row['lastname'] ?>"></td>
                            </tr>
                            
                            <tr bgcolor="#ccc" align="center">
                                <td>Username</td>
                                <td><input type="text" name="username" value="<?php echo $row['username'] ?>"></td>
                            </tr>
                            
                            <tr bgcolor="#ccc" align="center">
                                <td>Email Address</td>
                                <td><input type="text" name="email" value="<?php echo $row['email'] ?>"></td>
                            </tr>
                            
                            <tr bgcolor="#ccc" align="center">
                                <td>Phone</td>
                                <td><input type="text" name="phone" value="<?php echo $row['phone'] ?>"></td>
                            </tr>

                            <tr bgcolor="#ccc" align="center">
                                <td>Department</td>
                                <td><?php echo $row['department'] ?></td>
                            </tr>

                            <tr bgcolor="#ccc" align="center">
                                <td>Salary</td>
                                <td><input type="text" name="salary" value="<?php echo $row['salary'] ?>"></td>
                            </tr>

                            <tr bgcolor="#ccc" align="center">
                                <td>Hiredate</td>
                                <td><?php echo $row['hiredate'] ?></td>
                            </tr>



                            <tr bgcolor="#ccc" align="center">
                                <td>Gender</td>
                                <td><?php echo $row['gender'] ?></td>
                            </tr>
                            
                            
                            <tr bgcolor="#ccc" align="center">
                                <td><label>Department </label></td>
                                <td>
                                <?php $dept = Users::getDepartment();  ?>
                                    <select name="dept">
                                        <option value="default">-SELECT-</option>
                                        <?php while($row = mysql_fetch_assoc($dept)) :  ?>
                                        <option value="<?php echo $row['dept_name']; ?>"><?php echo strtoupper($row['dept_name']); ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </td>
                            </tr>
                            
                            <?php endwhile; ?>


                        </tbody>

                    </table>
                    
                    <input type="submit" name="update" value="Submit" style="float: right">
                </form>
            </div>
        </div>
    
        
        
    
    </div>
    
</body>
</html>
