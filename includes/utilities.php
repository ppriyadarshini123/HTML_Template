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



//===========  CONSTANTS:

###### defining a constant pointing at the root folder
//define('CONST_NAME','VALUE');
define('ROOT','http://localhost:3000/Payal_Priyadarshini_PHP_Project_Template/');



//===========  DATABASE LOGIC:
// creating a mysqli object using mysqli class


//===========  HELPER FUNCTIONS:



/**
 *	@name   trace
 *	@desc   this foo will display the content of arrays/superglobals
 *	            in a nice and readable fashion
 *  @param   object	$obj		the object to print
 */
