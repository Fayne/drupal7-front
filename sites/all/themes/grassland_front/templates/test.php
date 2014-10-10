<?php
/**
 * Created by PhpStorm.
 * User: fayne
 * Date: 10/10/14
 * Time: 10:33 AM
 */

if( is_numeric($argument) && strlen($argument) == 6 ){
    return true;
}
else{
    return false;
}