<?php
/**
 * Created by PhpStorm.
 * User: Jlndbe
 * Date: 11.11.2015
 * Time: 21:25
 * @param $var_name
 * @return string
 */

function db_get_var($var_name){
    if(preg_match('/^[A-Z_]+$/', $var_name) != 1) return 'INVALID_VAR_NAME_PASSED';
    return '__TODO__GOT_VAR_FROM_DB';
}