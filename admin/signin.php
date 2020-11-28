<?php
/**
 *
 * PHP course project
 * url: /signin.php
 */
include("../includes/utilities.php");
include("../includes/auth.php");

//   THIS IS THE BEGINNING OF THE MARKUP
include("../includes/top.php");
include("../includes/header.php");
if (isset($_SESSION['logID'])) {
    include("../includes/signoutNav.php");
} else {
    include("../includes/topNav.php");
}

//Sign In Logic & add to favourites logic
if (isset($dbok) && $dbok && !is_logged_in()) {

    include("../includes/topNav.php");
    // form handling
    if (isset($_POST['login'])) {
        /**
         * never forget form validation and sanitation
         * (see contacts.php)
         */
        $logEmail = $_POST['email'];
        $logPsw = $_POST['password'];

        $q = "SELECT * FROM `user` U LEFT JOIN `userroles` UR ON U.`rID` = UR.`urID`" .
                " WHERE U.`email` = '" . $logEmail . "' AND U.`pwd` = '" . $logPsw . "'";

        //echo $q;

        $res = $mysqli->query($q);

        //trace($res);

        if ($res->num_rows === 1) {
            // user is allowed
            $user = $res->fetch_assoc();
            //trace($user);

            /**
             *  we can store persistent data
             * 1) on the client using $_COOKIE -> do not use for sensitive data
             * 2) store securely in $_SESSION  -> good for login, sensitive data etc
             * --------------------------------------
             *
             *
             * $_SESSION:
             * it's a superglobal
             * it's only accessible AFTER we start the session using session_start()
             * it's only populated by code
             *
             * ----------
             * sessions should start only once, before any output
             *
             */
            /* session_start();
              $_SESSION['test'] = 'this is a demo';
              trace($_SESSION);
              session_destroy(); */
            // starting  session
            startSessionOnce();
            // storing user name and id in $_SESSION
            $_SESSION["logID"] = $user['uID'];
            $_SESSION["logNAME"] = $user['uName'];


            //Check if user is Admin
            if ($user['urRole'] == "Admin") {
                $_SESSION["IsAdmin"] = "1";
            } else {
                $_SESSION["IsAdmin"] = "0";
            }

            // redirecting user to viewHouses.php after logging in
            if (!isset($_GET['page'])) {
                header('location:' . ROOT . 'admin/viewHouses.php');
            } else {
                //add to favourites
                if (isset($_GET['h_id']) && isset($_GET['page'])) {
                    $page = $_GET['page'];
                    // DO NOT FORGET VALIDATION AND SANITATION!!!!    
                    $keyhouseID = $_GET['h_id'];

                    //select - check if the house is already added as a favourite for the user 
                    //- to avoid duplicate data in database
                    $qselect = "SELECT hID, uID FROM " . "`" . DBN . "`.`houseuser` WHERE hID = " . $keyhouseID . " AND uID = " . $_SESSION['logID'] . " ";

//                    trace($qselect);

                    $res = $mysqli->query($qselect);

//                    trace($res);

                    if ($res->num_rows === 1) {
                        // House is already added as the user'sfavourite
                        
                        //If the user is a customer or a property dealer, then he should view his favourite houses otherwise admin pages
                        if($_SESSION('IsAdmin') == "0")
                        {
                        $failMsg = "House already added as your Favourite. " . '<a href = "viewHouses.php">' . "Click here to visit your favourite houses" . '</a>';
                        }
                        else 
                        {
                            $failMsg = "House already added as your Favourite. " . '<a href = "viewHouses.php">' . "Click here to visit Admin Pages" . '</a>';
                        }
                    }//if
                    else {
                        //house is not already added a a favourite
                        //Insert into database only if it does not exist
                        $qinsert = " INSERT INTO "
                                . "`" . DBN . "`.`houseuser`(`hID`, `uID`) 
                                     VALUES (" . $keyhouseID . "," . $_SESSION['logID'] . ")"
                        ;
                        //trace($qinsert);
                        $eRes = $mysqli->query($qinsert);

                        if ($mysqli->affected_rows === 1) {
                            //If the user is a customer or a property dealer, then he should view his favourite houses otherwise admin pages
                        if($_SESSION('IsAdmin') == 0)
                        {
                            $successMsg = "House added as your Favourite" . '<a href = "viewHouses.php">' . "Click here to view your favourite houses" . '</a>';
                        }//if
                        else
                        {
                            $successMsg = "House added as your Favourite" . '<a href = "viewHouses.php">' . "Click here to Admin pages" . '</a>';
                        }
                        } else {                            
                            $failMsg = "Could not add House as favourite" . '<a href = "viewHouses.php">' . "Click here to view your favourite houses" . '</a>';
                        } ### update check
                        //                    header('location:' . ROOT . '' . $page . '');
                    }//else
                }//if
            }//else
        }//if ($res->num_rows === 1)
        else {
            // user is not allowed
            $failMsg = "User not found. Could not log in, please try again.";
        } //else
    } //if (isset($_POST['login']))
} // dbok

//add to favourites logic for a logged in customer
if (isset($dbok) && $dbok && is_logged_in()) {
    //add to favourites
    if (isset($_GET['h_id']) && isset($_GET['page'])) {
        $page = $_GET['page'];
        // DO NOT FORGET VALIDATION AND SANITATION!!!!    
        $keyhouseID = $_GET['h_id'];

        //select - check if the house is already added as a favourite for the user 
        //- to avoid duplicate data in database
        $qselect = "SELECT hID, uID FROM " . "`" . DBN . "`.`houseuser` WHERE hID = " . $keyhouseID . " AND uID = " . $_SESSION['logID'] . " ";

//                    trace($qselect);

        $res = $mysqli->query($qselect);

//                    trace($res);

        if ($res->num_rows === 1) {
            if($_SESSION['IsAdmin'] == 0){
            // House is already added as the user'sfavourite
            $failMsg = "House already added as your Favourite. " . '<a href = "viewHouses.php">' . "Click here to view your favourite Houses." . '</a>';
        }//if
        else {
            $failMsg = "House already added as your Favourite. " . '<a href = "viewHouses.php">' . "Click here to visit Admin Pages" . '</a>';
        }
        }//if
        else {
            //house is not already added a a favourite
            //Insert into database only if it does not exist
            $qinsert = " INSERT INTO "
                    . "`" . DBN . "`.`houseuser`(`hID`, `uID`) 
                                     VALUES (" . $keyhouseID . "," . $_SESSION['logID'] . ")"
            ;
            //trace($qinsert);
            $eRes = $mysqli->query($qinsert);

            if ($mysqli->affected_rows === 1) {
                $successMsg = "House added as your Favourite. " . '<a href = "viewHouses.php">' . "Click here to visit Admin Pages" . '</a>';
            } else {
                $failMsg = "Could not add House as favourite. " . '<a href = "viewHouses.php">' . "Click here to visit Admin Pages" . '</a>';
            } ### update check
            //                    header('location:' . ROOT . '' . $page . '');
        }//else
    }//if
}//if
?>


</div><!--/topHeader-->
</header>
</div><!--/wrapper--> 
<main>
    <section class="mainBody"> 

        <div class="contain">
            <section class="signinpage">                                  
                <div class="signin"><!--result product-->
                    <p class="headingCenter">Sign In</p>
                    <!-- ====================  FEEDBACK START =========-->
<?php include("../includes/feedback.php"); ?>
                    <!-- ====================  FEEDBACK END ===========-->
                    <form method="post" action="#" class="fields">
                        <div class="alignSignIn">
                            <div class="alignView">                                    
                                <label for="email" class="spEmail">Email :</label> 
                                <input name="email" type="email" placeholder="john@johndoe.com" required id="email">
                            </div><!--/email-->
                            <div class="alignView">                                    
                                <label for="psw" class="spPsw">Password :</label> 
                                <input name="password" type="password" placeholder="" required id="psw">                                  
                            </div><!--/password-->                               
                            <div class="alignBtn">
                                <button type="submit" name="login" class="btnSubmit">Submit</button>
                            </div><!-- submit Button --> 
                        </div>  <!--/signin-->   
                    </form>
                </div>
            </section><!--/signinpage-->
        </div><!--/container-->
    </section><!--/ mainBody-->
</main>
<?php //if user is logged in
if (isset($_SESSION['logID'])) {
    include("../includes/signoutFooter.php");
//    $successMsg = '<a href = "admin/viewHouses.php">' . "Click here to visit Admin Pages" . '</a>';
} else {
    include("../includes/footer.php");
}//else
?>

<!--/ your JS here-->
<script src="<?php echo ROOT; ?>node_modules/jquery/dist/jquery.js"></script>
<script src="<?php echo ROOT; ?>node_modules/enquire.js/dist/enquire.min.js"></script>
<script src="<?php echo ROOT; ?>build/js/index.js"></script>

</body>
</html>