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
include("../includes/signoutNav.php");
include("../includes/bottomNav.php");

//UPDATE MODE
//Update User values in Database
if (isset($_POST['submit']) && isset($_GET['u_id'])) {

    if ($_SESSION['IsAdmin'] == "1") {
        
        //Check if $uID exists for editing
        $uID = $_GET['u_id'];

        if (isset($_POST['uEmail'])) {
            $email = trim($_POST['uEmail']);
        }//if
        if (isset($_POST['uRole'])) {
            $role = trim($_POST['uRole']);
        }//if
        if (isset($_POST['uPsw'])) {
            $password = trim($_POST['uPsw']);
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
                . "SET `email`='" . $email . "', `phone`= '" . $phonenumber . "', `rID`= '" . $role . "',`uName`='" . $name . "',`pwd`='" . $password . "'"
                ." WHERE uID = ". $uID;

       // trace($qUpdateUser);

        $dRes = $mysqli->query($qUpdateUser);

        if ($mysqli->affected_rows > 0) {
            $successMsg = "User successfully updated.";
//            echo "<script>$('#updateHouse').reset();</script>";
        } else {
            $failMsg = "Nothing changed or Could not update user or user already deleted.";
        } //else  
    }//if
}//if
//SELECT IN EDIT MODE
//IF the admin wants to edit the user, he should have a u_id and IsAdmin should be 1
if (isset($dbok) && $dbok && isset($_GET['u_id'])) {

    //Only Admin can view details of house
    if ($_SESSION['IsAdmin'] == "1") {

        //Display Data from database            
        $qSelectUsers = " SELECT DISTINCT *
                FROM `user` U                
                LEFT JOIN `userroles` UR
                ON U.`rID` = UR.`urID`
                WHERE     
                     U.`uID` = " . $_GET['u_id'] . " LIMIT 1";
        //trace($qSelectUsers);
        $res = $mysqli->query($qSelectUsers);
        //trace($res);
        $user = $res->fetch_assoc();
        //trace($user);
    }//if
}//if


//INSERT NEW HOUSE
if (isset($_POST['submit']) && !(isset($_GET['u_id']))) {

    if ($_SESSION['IsAdmin'] == "1") {
        if (isset($_POST['uEmail'])) {
            $email = trim($_POST['uEmail']);
        }//if
        if (isset($_POST['uRole'])) {
            $rID = trim($_POST['uRole']);
        }//if
        if (isset($_POST['uPsw'])) {
            $password = trim($_POST['uPsw']);
        }//if
        if (isset($_POST['uName'])) {
            $name = $_POST['uName'];
        }//if
        if (isset($_POST['uPhoneNumber'])) {
            $phonenumber = trim($_POST['uPhoneNumber']);
        }//if
        
         if (isset($_POST['uHouseAssigned'])) {
            $houseassigned = trim($_POST['uHouseAssigned']);
        }//if
        
        try {
            /* Start transaction */
            $mysqli->begin_transaction();

            //Insert new user details
            $qInsertUser = "INSERT INTO `user`"
                    . "(`email`, `phone`, `pwd`, `rID`, `uName`)"
                    . " VALUES ('" . $email . "','" . $phonenumber . "','" . $password . "','" . $rID . "','" . $name ."');";

            trace($qInsertUser);

            $dRes = $mysqli->query($qInsertUser);

            if ($mysqli->affected_rows === 1) {
                //Get the hID from the database
                $uID = $mysqli->insert_id;
                
                //Update the edited house details
                $qInsertHouseUser = "INSERT INTO `houseuser`"
                    . "(`hID`, `uID`)"
                    . " VALUES ('" . $houseassigned . "','" . $uID . "');";
                
                $dRes2 = $mysqli->query($qInsertHouseUser);

                if ($mysqli->affected_rows === 1) {
                    $successMsg = "User successfully added.";
                } else {
                    $failMsg = "Could not add User.";
                } //else             

                $mysqli->commit();
                }//if           
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
                                    <label for="uName">Name :</label>
                                    <input class="formField" type="text" id="uName" name="uName" value="<?php
                                if (isset($user['uName']) && isset($_GET['u_id']) && !isset($_POST['submit'])) {
                                    echo trim($user['uName']);
                                } else {
                                    echo '';
                                }
                                            ?>">
                                </div><!--align name--> 
                                <div class="align">
                                    <label for="uRole">Role:</label>
                                    <div>
                                        <select id="uRole" name="uRole">
                                            <!--  <option value='' id='hPropertyDealer'></option>                          -->
                                            <!--  <option selected="selected" value="-->
                                            <?php
                                            //Populate property dealers datalist
                                            $getRoles = "SELECT * from `userroles`";

                                            $res3 = $mysqli->query($getRoles);

                                            if ($res3->num_rows > 0) {
                                                $roles = [];
                                                while ($row3 = $res3->fetch_assoc()) {
                                                    array_push($roles, $row3);
                                                } // while 
                                              //  trace($roles);
                                            }//if           
                                            //If edit mode, select the value already in the database, else just populate the datalist with roles
                                            if (isset($user['urRole']) && isset($_GET['u_id']) && !isset($_POST['submit'])) {
                                                foreach ($roles as $role) {
                                                    if ($role['urID'] == $user['rID']) {
                                                        echo '<option selected=\'selected\' value=\'' . $role['urID'] . '\'>' . $role['urRole'] . '</option>';
                                                    } else {
                                                        echo '<option value= \'' . $role['urID'] . '\'>' . $role['urRole'] . '</option>';
                                                    }//else            
                                                }//foreach
                                            }//if
                                            else {
                                                foreach ($roles as $role) {
                                                    echo '<option value= \'' . $role['urID'] . '\'>' . $role['urRole'] . '</option>';
                                                }//foreach
                                            }//else
                                            ?>
                                        </select>
                                    </div><!-- input roles -->
                                </div><!--align role-->
                                <div class="align">
                                    <label for="uHouseAssigned">House Assigned :</label>
                                    <div>
                                        <!--                                        House will be assigned to a property dealer in the add mode by the admin.
                                                                                Customer can choose his favourite and it need not be assigned by admin-->
                                        <select id="uHouseAssigned" name="uHouseAssigned">
                                            <!--  <option value='' id='hPropertyDealer'></option>                          -->
                                            <!--  <option selected="selected" value="-->
                                            <?php
                                            if (!isset($_GET['u_id'])) {
                                                //Populate houses datalist
                                                $getHouses = "SELECT * from `house`";

                                                $res2 = $mysqli->query($getHouses);

                                                if ($res2->num_rows > 0) {
                                                    $houses = [];

                                                    while ($row = $res2->fetch_assoc()) {
                                                        array_push($houses, $row);
                                                    } // while 
                                                   // trace($houses);
                                                }//if  

                                                if (!isset($_POST['submit'])) {
                                                    foreach ($houses as $house) {
                                                        echo '<option value= \'' . $house['hID'] . '\'>' . $house['housenumber'] . "  " .$house['streetname'] ."  " . $house['postcode'] . '</option>';
                                                    }//foreach
                                                }//if
                                            }//if
                                            ?>
                                        </select>

                                    </div><!-- input roles -->

                                </div><!--align house assigned--> 
                                <div class="align">
                                    <label for="uPhoneNumber">Phone Number :</label>
                                    <input class="formField" type="text" id="uPhoneNumber" name="uPhoneNumber" value="<?php
                                if (isset($user['phone']) && isset($_GET['u_id']) && !isset($_POST['submit'])) {
                                    echo trim($user['phone']);
                                } else {
                                    echo '';
                                }
                                            ?>">                                
                                </div><!--align phone number--> 
                                <div class="align">
                                    <label for="uEmail">Email :</label>
                                    <input class="formField" type="text" id="uEmail" name="uEmail"  value="<?php
                                        if (isset($user['email']) && isset($_GET['u_id']) && !isset($_POST['submit'])) {
                                            echo $user['email'];
                                        } else {
                                            echo '';
                                        }
                                            ?>">
                                </div><!--align email address-->  
                                <div class="align">
                                    <label for="uPsw">Password :</label>
                                    <input class="formField" type="text" id="uPsw" name="uPsw" value="<?php
                                if (isset($user['pwd']) && isset($_GET['u_id']) && !isset($_POST['submit'])) {
                                    echo trim($user['pwd']);
                                } else {
                                    echo '';
                                }
                                            ?>">
                                </div><!--align password-->  
                                <div class="alignBtn">
                                    <button type="submit" id="submit" name="submit" class="btnSubmit">Submit</button>                                
                                </div><!--align submit--> 
                            </div><!--/editAddHousealign-->
                        </div><!--/form-->

<?php } ?>
                </form><!--/editAddHouse-->
            </section><!--/editAddHouse-->
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

<script src="<?php echo ROOT; ?>node_modules/jquery/dist/jquery.js"></script>
<script src="<?php echo ROOT; ?>node_modules/enquire.js/dist/enquire.min.js"></script>
<script src="<?php echo ROOT; ?>build/js/index.js"></script>
<!--/ your JS here-->
</body>
</html>
