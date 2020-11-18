<?php

/**
 *
 * PHP course project 2020
 * url: /includes/utilities.php
 */
/**
 *  This will take care of:
 *  + useful constants,
 *  + error handling,
 *  + database connection and selection
 *  + helper functions
 */
//===========  ERROR HANDLING:
######  DO NOT EXPOSE ERRORS IN PRODUCTION MODE
###### ATTACKERS CAN GET ADVANTAGE OF THEM!!!!
ini_set('display_errors', 'on');
error_reporting(E_ALL);


//===========  CONSTANTS:
###### defining a constant pointing at the root folder
//define('CONST_NAME','VALUE');
define('ROOT', 'http://localhost/Payal_Priyadarshini_PHP_Project_Template/');
define('DBN', 'home_search');
define('USR', 'root');
define('PSW', ''); // default password: root
define('HST', 'localhost');


//===========  DATABASE LOGIC:
// creating a mysqli object using mysqli class
$mysqli = new mysqli(HST, USR, PSW, DBN);
//trace($mysqli);
if (isset($mysqli->connect_error)) {
    $dbok = false;
    // die("****ERRROR**** " . $mysqli->connect_error);
    $failMsg = "Something went wrong, please try again later.";
} else {
    $dbok = true;
    //trace($dbok);
} // dbnok
//
//===========  HELPER FUNCTIONS:

/**
 * 	@name   trace
 * 	@desc   this foo will display the content of arrays/superglobals
 * 	            in a nice and readable fashion
 *  @param   object	$obj		the object to print
 */
function trace($obj) {
    echo "<pre>";
    print_r($obj);
    echo "</pre>";
}

//end trace



/**
 *	@name       is_logged_in
 *	@desc       this foo will detect if user is currently logged in
 *  @return     boolean
 */
function is_logged_in(){
  if(isset($_SESSION['logID'])) {
    return true;
  } else {
    return false;
  }
}//is_logged_in


/**
 * @name          startSessionOnce
 * @description   this will start session only if not started yet
 */
function startSessionOnce() {
  if(!isset($_SESSION)){
    session_start();
  }
} // startSessionOnce