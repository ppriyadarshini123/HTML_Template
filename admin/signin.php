<?php
/**
 *
 * PHP course project
 * url: /signin.php
 */
include("../includes/utilities.php");

//   THIS IS THE BEGINNING OF THE MARKUP
include("../includes/top.php");
include("../includes/header.php");


if(isset($dbok) && $dbok) {

  // form handling
  if( isset($_POST['login']) ) {
    /**
     * never forget form validation and sanitation
     * (see contacts.php)
     */
      $logEmail   = $_POST['email'];
      $logPsw     = $_POST['password'];

      $q = "
        SELECT
            * 
        FROM
            `" . DBN . "`.`user`
        WHERE
            `user`.`email` = '$logEmail' 
        AND         
            `user`.`pwd` = '$logPsw'      
      ";

      echo $q;

      $res = $mysqli->query($q);

      trace($res);
      
      if( $res->num_rows === 1 ) {
        // user is allowed
        $user = $res->fetch_assoc();
        // trace($user);

        trace($user);
        /**
         *  we can store persistent data
         * 1) on the client using $_COOKIE -> do not use for sensitive data
         * 2) store securely in $_SESSION  -> good for login, sensitive data etc
         *--------------------------------------
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
          /*session_start();
          $_SESSION['test'] = 'this is a demo';
          trace($_SESSION);
          session_destroy();*/
          // starting  session
          startSessionOnce();
          // storing user name and id in $_SESSION
          $_SESSION['logID']      =   $user['uID'];
          $_SESSION['logNAME']    =   $user['uName'];

          // redirecting user to viewProducts.php
          header('location:' . ROOT . 'admin/viewHouses.php');
      } else {
        // user is not allowed
        $failMsg = "Could not log in, please try again.";
      } #### select check



  } ######## login form submisison

  //add to favourites
  if(isset($_GET['h_id'])) 
  {
    // DO NOT FORGET VALIDATION AND SANITATION!!!!    
    $keyhouseID = $_GET['h_ID'];
//    $q = "INSERT INTO "
//            . "`" . DBN . "`.user (hID)
//            VALUES ('')
//            WHERE uID = " . $_SESSION['logID'] .";";
    
            "UPDATE " . "`" . DBN . "`.user(hID)
            SET hID = " . $keyhouseID
            . "WHERE uID = " . $_SESSION['logID'] .";";"
  }

} // dbok
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

<?php include("../includes/footer.php"); ?> 

<!--/ your JS here-->
<script src="<?php echo ROOT; ?>node_modules/jquery/dist/jquery.js"></script>
<script src="<?php echo ROOT; ?>node_modules/enquire.js/dist/enquire.min.js"></script>
<script src="<?php echo ROOT; ?>build/js/index.js"></script>

</body>
</html>
