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
    $result = Users::workerDetails('worker', 'worker_info', array(
                                            'wr.id'  => $_GET['userid'],
                                        ));
    
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

                <table widtd="100%" cellspacing="1" cellpadding="4" border="0" align="center">
                    <tbody>
                        
                        
                        <?php while ($row = mysql_fetch_assoc($result)) :   ?>
                        <tr bgcolor="#ccc" align="center">
                            <td>First Name</td>
                            <td><?php echo $row['firstname'] ?></td>
                        </tr>
                        
                        <tr bgcolor="#ccc" align="center">
                            <td>Last Name</td>
                            <td><?php echo $row['lastname'] ?></td>
                        </tr>
                        
                        <tr bgcolor="#ccc" align="center">
                            <td>Username</td>
                            <td><?php echo $row['username'] ?></td>
                        </tr>
                        
                        
                        <tr bgcolor="#ccc" align="center">
                            <td>Address</td>
                            <td><?php echo $row['address'] ?></td>
                        </tr>
                        
                        
                        <tr bgcolor="#ccc" align="center">
                            <td>Gender</td>
                            <td><?php echo $row['gender'] ?></td>
                        </tr>
                        
                        
                        <tr bgcolor="#ccc" align="center">
                            <td>Phone</td>
                            <td><?php echo $row['phone'] ?></td>
                        </tr>
                        
                        
                        
                        <tr bgcolor="#ccc" align="center">
                            <td>Department</td>
                            <td><?php echo $row['department'] ?></td>
                        </tr>
                        
                        <tr bgcolor="#ccc" align="center">
                            <td>Salary</td>
                            <td><?php echo $row['salary'] ?></td>
                        </tr>
                        
                        <tr bgcolor="#ccc" align="center">
                            <td>Hiredate</td>
                            <td><?php echo $row['hiredate'] ?></td>
                        </tr>
                        
                        <tr bgcolor="#ccc" align="center">
                            <td>Update </td>
                            <td><a href="m_worker_update.php?userid=<?php echo $row['userid']; ?>">></a></td>
                        </tr>
                        
                        <?php endwhile; ?>
                        
                        
                    </tbody>
                    
                </table>
            </div>
        </div>
    
        
        
    
    </div>
    
</body>
</html>
