<?php


require 'core/init.php';
    
if(Users::logged_in()){
//    echo 'welcome';
}else{
   
    $_GET['invalid_user'] = 'invalid';
    header("Location: index.php");    $x = 1;

}


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    
    $connect = DB::getInstance();
    
    $result = Users::getDepartment();
    $x = 1;
    
    
    
    
?>

<!DOCTYPE html>
<html>
<head>
    <title>Department | <?php echo $user_data['username']; ?></title>
    <link href="css/style.css" type="text/css" rel="stylesheet">
</head>
<body>
   
    <?php include 'template-part/userInformation.php'; ?>
    
    <div class="wraper">
        
        <?php include 'template-part/lists.php'; ?>
    
    
    
        <div class="content">
            <div class="widget">
                <h2>Worker Details </h2>
                <hr>

                <table width="100%" cellspacing="1" cellpadding="4" border="0" align="center">
                    <tbody>
                        <tr bgcolor="#ccc" align="center">
                            <th>SN#</th>
                            <th>Department Name</th>
                            <th>Department Information</th>
                            <th>Edit</th>
                            
                        </tr>
                        
                        <?php while ($row = mysql_fetch_assoc($result)) :   ?>
                        <tr bgcolor="#f2f2f2" align="center">
                            <td><?php echo $x; $x++ ?></td>
                            <td><?php echo $row['dept_name'] ?></td>
                            <td><?php echo $row['dept_info'] ?></td>
                            <td><a href="edit.php?deptid=<?php echo $row['id']; ?>">Edit</a></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                    
                </table>
                
                <a href="create_department.php" style="float: right" class="button">Create Department + </a>
            </div>
        </div>
    
        
        
    
    </div>
    
</body>
</html>
