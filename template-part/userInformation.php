<?php 

    $connect = DB::getInstance();

?>

<div class="department">
    <?php if($_SESSION['role'] != 'Worker') : ?>

    <form method="get">
        <label>Department : </label>
        <?php $department = Users::getDepartment();  ?>
        <select name="dept">
            <option value="default">-SELECT-</option>
            
            <?php while($row = mysql_fetch_assoc($department)) :  ?>
                <option value="<?php echo $row['dept_name']; ?>"><?php echo strtoupper($row['dept_name']); ?></option>
            <?php endwhile; ?>
        </select>
        
        <input type="submit" name="department" value="Search">
    </form>
    
    
    <?php endif; ?>
    
    
    
    
</div>

<div class="user-info">
    <?php if(Users::logged_in()) :  ?>
        <ul>
            <li>
                <div>
                    <p>Welcome,</p>
                    <p>Username : <?php echo $user_data['username']; ?></p>
                    <p>Name : <?php echo $user_data['firstname'] .' '. $user_data['lastname']; ?></p>
                    <p>Role : <?php echo $_SESSION['role']; ?></p>
                    
                 
                </div>
            </li>
        </ul>
    <?php endif; ?>
</div>
    