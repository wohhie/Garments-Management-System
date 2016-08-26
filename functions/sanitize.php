<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



/**
 * 
 * @param type $string
 * @return type htmlentites()
 */
function sanitize($string){
    return mysql_real_escape_string($string);
}


