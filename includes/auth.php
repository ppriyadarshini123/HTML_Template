<?php # includes/auth.php
/**
 * @file:         includes/auth.php
 * @desctription: this will take care of login / logout logic
 */


## 1) starting session
startSessionOnce();


## 2) checking if user is allowed
if( !is_logged_in() && !isset($adminPage) ) {
  $failMsg = "You are not allowed. Click <a 
    class='boldLink' 
    href='" . ROOT . "admin/admin.php'>here</a> to login.";
} // is logged in



## 3) log out logic
if(isset($_GET['log']) && $_GET['log'] === 'out') {
  // session_destroy();
  $_SESSION['logID']    = null;
  $_SESSION['logNAME']  = null;
  $_SESSION['IsAdmin'] = null;
  // redirecting to login page, out of restricted area
  header('location:' . ROOT . "index.php");
} // log out
