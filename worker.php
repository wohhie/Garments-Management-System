<?php


require 'core/init.php';
    
if(Users::logged_in()){
//    echo 'welcome';
}else{
   
    $_GET['invalid_user'] = 'invalid';
    header("Location: index.php");
}


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    
    $connect = DB::getInstance();
//    $result = Users::workerDetails('worker', 'worker_info');
    
    $present = Users::totalPresent($user_data['id']);
    
    $totalSalary = Users::perDaySalary($user_data['id']);
    
    
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
        
        <?php include 'template-part/userlist.php'; ?>
    
    
    
        <div class="content">
            <div class="widget">
                <h2>Worker Details</h2>
                <hr>
                
                <div class="profile">
                    <table width="100%" cellspacing="1" cellpadding="4" border="0" align="center">
                        <tbody>
                            <tr bgcolor="#f2f2f2" align="center">
                                <td align="right">First Name </td> 
                                <td><?php echo $user_data['firstname']; ?></td> 
                            </tr>
                            
                            <tr bgcolor="#f2f2f2" align="center">
                                <td align="right">Last Name </td> 
                                <td><?php echo $user_data['lastname']; ?></td> 
                            </tr>
                            
                            <tr bgcolor="#f2f2f2" align="center">
                                <td align="right">Email Name </td> 
                                <td><?php echo $user_data['email']; ?></td> 
                            </tr>
                            
                            <tr bgcolor="#f2f2f2" align="center">
                                <td align="right"> Username</td> 
                                <td><?php echo $user_data['username']; ?></td> 
                            </tr>
                            
                            <tr bgcolor="#f2f2f2" align="center">
                                <td align="right">Address</td> 
                                <td><?php echo $user_data['address']; ?></td> 
                            </tr>
                            
                            <tr bgcolor="#f2f2f2" align="center">
                                <td align="right">Password</td> 
                                <td><?php echo $user_data['password']; ?></td> 
                            </tr>
                            
                            <tr bgcolor="#f2f2f2" align="center">
                                <td align="right">Department</td> 
                                <td><?php echo $user_data['department']; ?></td> 
                            </tr>
                            
                            <tr bgcolor="#f2f2f2" align="center">
                                <td align="right">Contact Number</td> 
                                <td>+<?php echo $user_data['phone']; ?></td> 
                            </tr>
                            
                            <tr bgcolor="#f2f2f2" align="center">
                                <td align="right">Hire date</td> 
                                <td><?php echo $user_data['hiredate']; ?></td> 
                            </tr>
                            
                            <tr bgcolor="#f2f2f2" align="center">
                                <td align="right">Birth date</td> 
                                <td><?php echo $user_data['birthdate']; ?></td> 
                            </tr>
                            
                            <tr bgcolor="#f2f2f2" align="center">
                                <td align="right">Total Present </td> 
                                <td><?php echo $present; ?></td> 
                            </tr>
                            
                            
                            <tr bgcolor="#f2f2f2" align="center">
                                <td align="right">Salary </td> 
                                <td>$ <?php echo $totalSalary ?></td> 
                            </tr>
                        </tbody>
                    
                    </table>
                    
                </div>
            </div>
        </div>
    
        
        
    
    </div>
    
</body>
</html>
