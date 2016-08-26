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
    
    $result = Users::workerDetails('worker', 'worker_info');    //eta
//    $result = Users::workerDetails('worker', 'worker_info');
    $x = 1;
    
    
    
    /**
     * TAKE ATTENDANCE
     */
    
    
    
    
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
        
        
        <!-- SHOW DEPARTMENT WISE WORKER.
        ===================================================-->
        
        <?php 
        if(isset($_GET['department']) ){
            
            
            $dept = $_GET['dept'];
//            $_GET['department'] = $_POST['dept'];
            
            
            
                
            if($dept){
                $result = Users::workerDetails('worker', 'worker_info', array(
                    'wr.department'  =>  $dept,
                )); 
                
                    
            }
                
        }
        
        
        
        
        
        
         
        if(isset($_POST['submit'])){
            
            if(!empty($_POST['uid'])){
//                print_r( $_POST['uid']);
                $date = date("Y-m-d");
                
                if(Users::attendanceDone($date, $dept)){
                    //TODAY YOU CAN'T TAKE ANYOMORE ATTENDANCE;
                    echo 'Today Attendance Done.';
                                        
                }else{
                    
                    foreach($_POST['uid'] as $selector){
                        $department = Users::workerDetails('worker', 'worker_info', array(
                            'wi.id'  =>  $selector
                    ));
                    
                    
                    $row = mysql_fetch_assoc($department);
                   
                    
                    //PER DAY SALARY. 
                    $insert = DB::getInstance()->insert('attendance', array(
                                                  'attendance' =>  1,
                                                  'date'    =>  $date,
                                                  'userid' =>  $row['userid'],
                                                  'deptname' =>  $row['department'],
                                              ));
                    
                    
                    
                    
                    }   //end foreach
                }
                                
            }
            
           
        }
        
        
        
        ?>
        
        
    
        <div class="content">
            <div class="widget">
                <h2>Worker Details</h2>
                <hr>

                <form method="post">
                    <table width="100%" cellspacing="1" cellpadding="4" border="0" align="center">
                        <tbody>
                            <tr bgcolor="#ccc" align="center">
                                <th>SN#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Username</th>
                                <th>Department</th>
                                <th>Attendance</th>
                            </tr>
                            
                            <?php 
                            $count = 0;
                            while ($row = mysql_fetch_assoc($result)) :   
                                $count++;
                                ?>
                            <tr bgcolor="#f2f2f2" align="center">
                                <td><?php echo $x; $x++ ?></td>
                                <td><?php echo $row['firstname'] ?></td>
                                <td><?php echo $row['lastname'] ?></td>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['department']; ?></td>
                                <td><input type="checkbox" name="uid[]" value="<?php echo $row['id'] ?>" checked="checked"></td>
                            </tr>
                            <?php endwhile; ?>
                            
                        </tbody>
                    </table>
                    
                    <input style="float: right" type="submit" name="submit" value="Submit">
                </form>
            </div>
        </div>
    
        
        
    
    </div>
    
</body>
</html>
