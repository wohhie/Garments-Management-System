<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Users
 *
 * @author wohhie
 */
class Users {
    
    
    public function logged_in(){
//        echo $_SESSION['user'];
        return (isset($_SESSION['user'])) ? true : false;
    }
    
    public function user_data($user_id, $role){
        
        $data = array();
        $user_id = (int)$user_id;
        
        
        /**
         * CHECK MANAGER / EMPLOYEE
         */
        if($role == 'Manager'){
            //if Manager
            $mainTable = 'manager';
            $infoTable = 'manager_info';
            
            
        }elseif($role == 'Worker'){
            //else if Worker
            $mainTable = 'worker';
            $infoTable = 'worker_info';
        }
        
        //number of arguments
        $func_num_args = func_num_args();
        //get arguments
        $func_get_args = func_get_args();

        
        if($func_num_args > 1){
            unset($func_get_args[0]);
            unset($func_get_args[1]);
            
            $fields = implode(',', $func_get_args);
            
//            $sql = "SELECT $fields FROM {$mainTable} mr, {$infoTable} mi WHERE mr.id=$user_id AND mr.id = mi.userid";
//            
            $query = mysql_query("SELECT $fields FROM {$mainTable} mr, {$infoTable} mi WHERE mr.id=$user_id AND mr.id = mi.userid");
            
            $data = mysql_fetch_assoc($query);
            
            return $data;
            
        }
        
    }
    
    /**
     * 
     * @param type $email
     * @return boolean
     */
    public function user_exists($email){
        $email = sanitize($email);
        
        
        
        $query =  mysql_query("SELECT COUNT(id) FROM manager WHERE email='$email'");
        $query2 = mysql_query("SELECT COUNT(id) FROM worker WHERE email='$email'");
        
        //return (mysql_result($query, 0) == 1) ? true : false
        if(mysql_result($query, 0) == 1){
            return true;
            
        }else if(mysql_result($query2, 0) == 1){
            return true;
            
        }else{
            return false;
            
        }
    }
    
    
    /**
     * 
     * @param type $deptment
     * @return type
     */
    public function dept_exists($deptment){
        
        $deptment = sanitize($deptment);
        
        $query = mysql_query("SELECT COUNT(id) FROM departments WHERE dept_name='$deptment'");
        return (mysql_result($query, 0) == 1) ? true : false;
        
    }
    
    /**
     * Worker Information
     */
    public function workerDetails($table1, $table2, $condition = array()){
        
        if(count($condition) > 0){
//            print_r($condition);
            $key = array_keys($condition);
            $values = "";
            
            foreach($condition as $value){
                
                $values .= (!is_numeric($value)) ? "'". $value  ."'" :  $value;
            }
            
//            $q = "SELECT * FROM {$table1} wr, {$table2} wi WHERE wr.id = wi.userid and ". implode(", ", $key) ."={$values}";
//            echo $q;
            $sql = "SELECT * FROM {$table1} wr, {$table2} wi WHERE wr.id = wi.userid and ". implode(", ", $key) ."={$values}";
            
            $result = mysql_query($sql);
            
            
            
            
            return $result;
            
            
            
        }else{
            $result = mysql_query("SELECT * FROM {$table1} wr, {$table2} wi WHERE wr.id = wi.userid");
//            $result = mysql_query($query);
//            $sql = "SELECT * FROM {$table1} wr, {$table2} wi WHERE wr.id = wi.userid";
//            echo $sql;

            return $result;
        }
        
        
    }
    
    
    public function attendanceDone($date, $deptname){
        
        $query = mysql_query("SELECT * FROM attendance WHERE date='$date' && deptname='$deptname'");
        
        
        return (mysql_result($query, 0) > 1) ? true : false;
        
        
        
    }
    
    
    /**
     * getDepartmentName
     * @return type
     */
    public function getDepartment(){
    
        $query = "SELECT * FROM `departments`";
        $result = mysql_query($query);
        
        return $result;
    }
    
    
    /**
     * totalPresent()
     * @param type $userid
     * @return $result
     */
    public function totalPresent($userid){
        $userid = sanitize($userid);
        
        $sql = "SELECT count('id') FROM attendance WHERE userid=$userid";
        
        $query = mysql_query($sql);
        $result = mysql_result($query, 0);
        
        return $result;
    }
    
    
    public function perDaySalary($userid){
        
        
        $userid = sanitize($userid);
        
        //WORKER TOTAL ATTENDANCE.        
        $totalPresent = Users::totalPresent($userid);
        
        //SELECT WORKER ORIGINAL SALARY .
        $sql1 = "SELECT salary FROM worker WHERE id=$userid";
        $query1 = mysql_query($sql1);
        $salary = mysql_result($query1, 0);

        //PERDAY SALARY.
        $perday = round($salary/31, 2);
        
        //TOTAL SALARY DEPENDING ON THR PRESENT.
        $totalSal = $perday * $totalPresent;
        
        //ALTER SALARY IN WORKER TABLE
        
        $sql = "UPDATE worker SET salary=$totalSal WHERE id=$userid";
        $query = mysql_query($sql);
        
        
        return $totalSal;   
    
    }
    
    
}
