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
    $result = Users::workerDetails('worker', 'worker_info');
    
    $x = 1;
    
    
    
    
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

                <table width="100%" cellspacing="1" cellpadding="4" border="0" align="center">
                    <tbody>
                        <tr bgcolor="#ccc" align="center">
                            <th>SN#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Username</th>
                            <th>Department</th>
                            <th>Salary</th>
                            <th>Hire Date</th>
                            <th>Details</th>
                            <th>Update</th>
                        </tr>
                        
                        <?php while ($row = mysql_fetch_assoc($result)) :   ?>
                        <tr bgcolor="#f2f2f2" align="center">
                            <td><?php echo $x; $x++ ?></td>
                            <td><?php echo $row['firstname'] ?></td>
                            <td><?php echo $row['lastname'] ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['department']; ?></td>
                            <td><?php echo $row['salary'] ?></td>
                            <td><?php echo $row['hiredate']; ?></td>
                            <td><a href="m_worker_details.php?userid=<?php echo $row['userid']; ?>">&RightTriangle;</a></td>
                            <td><a href="m_worker_update.php?userid=<?php echo $row['userid']; ?>">&uparrow;</a></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                    
                </table>
            </div>
        </div>
    
        
        
    
    </div>
    
</body>
</html>
