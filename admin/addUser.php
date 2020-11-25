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
include("../includes/bottomNav.php");


//SELECT MODE
//IF the admin wants to edit the user, he should have a u_id and IsAdmin should be 1
if (isset($dbok) && $dbok && isset($_GET['u_id'])) {

//Only Admin can view details of house
    if ($_SESSION['IsAdmin'] == "1") {
//Display Data from database
//If he is admin-display all houses in database               
        $qSelectUsers = " SELECT DISTINCT *
                FROM `user` U                
                LEFT JOIN `userroles` UR
                ON U.`rID` = UR.`urID`
                WHERE     
                     U.`uID` = " . $_GET['u_id'] . " LIMIT 1";
//trace($qSelectHouses);
        $res = $mysqli->query($qSelectUsers);
//trace($res);
        $user = $res->fetch_assoc();
//trace($houses);
//    trace($q);
//Save the details in database
    }//if
}//if
//UPDATE MODE
//Update User values in Database
if (isset($_POST['submit']) && isset($_GET['u_id'])) {

    if ($_SESSION['IsAdmin'] == "1") {
//Check if $uID exists for editing
        $uID = $_GET['u_id'];


        if (isset($_POST['uEmail'])) {
            $email = trim($_POST['uEmail']);
        }//if
        if (isset($_POST['uRoleID'])) {
            $role = trim($_POST['uRoleID']);
        }//if
        if (isset($_POST['uPassword'])) {
            $password = trim($_POST['uPassword']);
        }//if
        if (isset($_POST['uName'])) {
            $name = $_POST['uName'];
        }//if
        if (isset($_POST['uPhoneNumber'])) {
            $phonenumber = trim($_POST['uPhoneNumber']);
        }//if
        //
        //Update the edited user details
        $qUpdateUser = "UPDATE `user` U "
                . "LEFT JOIN `userroles` UR "
                . "ON U.`rID` = UR.`urID` "
                . "SET `email`='" . $email . "', `phone`= '" . $phonenumber . "', `rID`= '" . $role . "',`uName`='" . $name . "',`pwd`='" . $pwd . "'";

//trace($qUpdateUser);

        $dRes = $mysqli->query($qUpdateUser);

        if ($mysqli->affected_rows > 0) {
            $successMsg = "User successfully updated.";
//            echo "<script>$('#updateHouse').reset();</script>";
        } else {
            $failMsg = "Nothing changed or Could not update user or user already deleted.";
        } //else  
    }//if
}//if
//INSERT NEW HOUSE
if (isset($_POST['submit']) && !isset($_GET['h_id'])) {

    //only admin can insert new house
    if ($_SESSION['IsAdmin'] == "1") {
        if (isset($_POST['hRentSale'])) {

            $rentsale = trim($_POST['hRentSale']);
            if ($rentsale == "Rent") {
                $rs = 1;
            } else {
                $rs = 2;
            }//else
        }//if

        if (isset($_POST['hHouseNumber'])) {
            $housenumber = trim($_POST['hHouseNumber']);
        }//if
        if (isset($_POST['hCity'])) {
            $city = trim($_POST['hCity']);
        }//if
        if (isset($_POST['hDetails'])) {
            $details = trim($_POST['hDetails']);
        }//if
        if (isset($_POST['hPropertyDealer'])) {
            $uid = $_POST['hPropertyDealer'];
        }//if
        if (isset($_POST['hImage'])) {
            $image = trim($_POST['hImage']);
        }//if
        if (isset($_POST['hFloorPlan'])) {
            $floorplan = trim($_POST['hFloorPlan']);
        }//if
        if (isset($_POST['hPostCode'])) {
            $postcode = trim($_POST['hPostCode']);
        }//if
        if (isset($_POST['hPrice'])) {
            $price = trim($_POST['hPrice']);
        }//if
        if (isset($_POST['hStreetname'])) {
            $streetname = trim($_POST['hStreetname']);
        }//if


        try {
            /* Start transaction */
            $mysqli->begin_transaction();

            //Update the edited house details
            $qInsertHouse = "INSERT INTO `house`"
                    . "(`city`, `rsID`, `details`, `floorplan`, `image`, `housenumber`, `postcode`, `price`, `streetname`)"
                    . " VALUES ('" . $city . "','" . $rs . "','" . $details . "','" . $floorplan . "','" . $image . "','" . $housenumber . "','" . $postcode . "','" . $price . "','" . $streetname . "');";

            //trace($qInsertHouse);

            $dRes = $mysqli->query($qInsertHouse);

            if ($mysqli->affected_rows === 1) {
                //Get the hID from the database
                $h_id = $mysqli->insert_id;
                
                if ($mysqli->affected_rows === 1) {
                    $successMsg = "User successfully added.";
                } else {
                    $failMsg = "Could not add User.";
                } //else 

                $mysqli->commit();
            }//try
        } catch (mysqli_sql_exception $exception) {
            $mysqli->rollback();

            $failMsg = $exception;
        }//catch
    }//if
}// if
?>


</div><!--/topHeader-->
</header>
</div><!--/wrapper-->
<main>
    <section class="mainBody">
        <div class="contain">
            <section class="editAddItem">               
                <h2 class="sectionTitle"></h2>
                <form method="post" action="#" class="fields">
                    <div class="headingCenter">
                        <h1><?php
                            if (isset($_GET['u_id'])) {
                                echo 'Edit User';
                            }//if
                            else {
                                echo 'Add User';
                            }//else
                            ?></h1>
                    </div><!--align heading-->

<?php
//start the loop
if (isset($dbok) && $dbok) {
    ?>
                        <!-- ====================  FEEDBACK START =========-->
                        <?php include("../includes/feedback.php"); ?>
                        <!-- ====================  FEEDBACK END ===========-->
                        <div class="form">
                            <div class="editAddHouseAlign">                       
                                <div class="align">
                                    <label for="uRole">Role:</label>
                                    <input list="roles" name="role" value="<?php
                                                            ?>     >
                                   
                                </div><!--align role-->
                                <div class="align">
                                    <label for="uEmail">Email :</label>
                                    <input class="formField" type="text" id="uEmail" name="uEmail" value="">
                                </div><!--align email address-->  
                                <div class="align">
                                    <label for="uPsw">Password :</label>
                                    <input class="formField" type="text" id="uPsw" name="uPsw" value="">
                                </div><!--align password--> 
                                <div class="align">
                                    <label for="uHouseAssigned">House Assigned :</label>
                                    <input list="houses" name="house">
                                    <datalist id="houses">
                                    </datalist>
                                </div><!--align password--> 
                                <div class="align">
                                    <label for="uName">Name :</label>
                                    <input class="formField" type="text" id="uName" name="uName" value="">
                                </div><!--align name--> 
                                <div class="align">
                                    <label for="uPhoneNumber">Phone Number :</label>
                                    <input class="formField" type="text" id="uPhoneNumber" name="uPhoneNumber" value="">                                
                                </div><!--align phone number-->                       
                                <div class="alignBtn">
                                    <button type="submit" class="btnSubmit">Submit</button>                                
                                </div><!--align submit--> 
                            </div><!--/editAddHousealign-->
                        </div><!--/form-->
                        
<?php } ?>
                    </form><!--/editAddHouse-->
                </section><!--/editAddHouse-->
            </div><!--/container-->   
        </section><!--/ mainBody-->
    </main>
    <?php include("../includes/footer.php"); ?> 

    <script src="<?php echo ROOT; ?>node_modules/jquery/dist/jquery.js"></script>
    <script src="<?php echo ROOT; ?>node_modules/enquire.js/dist/enquire.min.js"></script>
    <script src="<?php echo ROOT; ?>build/js/index.js"></script>
<!--/ your JS here-->
</body>
</html>
