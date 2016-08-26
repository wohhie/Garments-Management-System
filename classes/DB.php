<?php
/**
 * Description of DB
 *
 * @author wohhie
 */
class DB {
    
    public static $instance;
    private $connection;
    private $query;
    private $result;
    
    public function __construct() {
        
        try{
            $this->connection = mysql_connect(Config::get('mysql/host'),Config::get('mysql/username'),Config::get('mysql/password'));
            if(!$this->connection){
                echo 'Connection Problem.';
                die();
            }
            
            mysql_select_db(Config::get('mysql/dbname'), $this->connection );
            
        } catch (Exception $ex) {
            
            echo $ex->getMessage();
            
        }  
    }
    
    public static function getInstance(){
        
        if(!isset(self::$instance)){
            self::$instance = new DB();
        }
        
        return self::$instance;
        
    }
    
    
    public function query($table, $fields = array()){
        
//        echo count($fields);
        if(count($fields) > 0){
            //compare
            $values = "";  
            
            foreach($fields as $key=>$value){
                $values .= (!is_numeric($value)) ? $key . "=" ."'". $value  ."'" : $key . "=" . $value;
                
            }
            
            $query = mysql_query("SELECT id FROM {$table} WHERE {$values}");
            $result = mysql_result($query, 0);
            
            return $result;            
            
        }else{
            
            $query = "SELECT * FROM {$table} ";
            $result = mysql_query($query);

            return $result;
        }
        
        
        
        
    }
    
    
    public function action($action, $table, $fields ){
        $values = "";
        
        foreach($fields as $value){
            $values .=  $value;
            if(count($fields) > 1){
                $values .= " and ";
            }
        }
        
        $content = rtrim($values, ' and ');
        $sql = "{$action} FROM {$table} WHERE {$content}";
        
        
        
        
        $query = mysql_query($sql);
//        $result = mysql_result($query, 0);
        $row = mysql_fetch_assoc($query);
        
        return ($row['countvalue'] == 1) ? $row['id'] : false;
        
    }
    
    
    
    
    
    /**
     * INSERT -> DATABASE
     * @param type $table
     * @param type $fields
     */
    public function insert($table, $fields = array() ){
//        echo $table;
//        print_r($fields);
        
        $key = array_keys($fields);
        $values = "";
        $x = 1;
        
        foreach($fields as $field){
            
            $values .= (!is_numeric($field)) ? "'". $field  ."'" : $field;
            
            if( count($fields) > $x){
                $values .= ',';
            }
            
            $x++;
        }
        
        $query = "INSERT INTO $table (". implode(", ", $key)  .") VALUES({$values})";
        
        $result = mysql_query($query);
        
        return $result;
        //not done yet;
    }
    
    
    
    public function update($table, $where = array(), $fields = array() ){
//        echo $table;
//        print_r($fields);
        
        $key = array_keys($fields);
        
        $whereClause = "";
        $fieldClause = "";
                
        foreach ($where as $key=>$value){
            $value = (!is_numeric($field)) ? $value : "'". $value  ."'";
            
            $whereClause .= $key . '=' . $value;
        }
        
        
        foreach ($fields as $key=>$value){
            $value = (!is_numeric($field)) ? "'". $value  ."'" : $value ;
            $fieldClause .= $key . '=' . $value;
            
            if(count($fields) > 0){
                $fieldClause .= ",";
            }
        }
        
        $fieldClause = rtrim($fieldClause, ",");
        
        
        
//          UPDATE table_name
//          SET column1=value, column2=value2,...
//          WHERE some_column=some_value
                
          
        
        $query = "UPDATE $table SET {$fieldClause} WHERE {$whereClause} ";
        
        $result = mysql_query($query);
        
        return $result;
        //not done yet;
    }
    
    
    /**
     * GETTING INFORMATION
     * ------------------------
     * @return string 
     */
    
    public function get($table, $fields){
        return $this->action("SELECT count(*) as countvalue ,id", $table, $fields);
    }
    
    
    
    
    
}
