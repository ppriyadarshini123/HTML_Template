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
if ($_SESSION['IsAdmin'] == "1")
    include("../includes/bottomNav.php");

//DELETE MODE
if ($dbok && isset($_GET['u_id']) && isset($_SESSION['IsAdmin'])) {

    $uID = $_GET['u_id'];
    echo $uID;

    if ($_SESSION['IsAdmin'] == "1") {
        //Delete User
        //delete mode: for Admin: Delete user from database
        $qDELETE = "DELETE FROM `user` where `uID` = '" . $uID . "'";

        //trace($qDELETE);
        $dRes = $mysqli->query($qDELETE);

        if ($mysqli->affected_rows === 1) {
            $successMsg = "User successfully deleted.";
        } else {
            $failMsg = "Could not delete user or user already deleted.";
        } //else
    }//if
}//if
//
//SELECT QUERY
if (isset($dbok) && $dbok && !isset($_GET['u_id'])) {
    //Check User: If he is admin-display all houses in database
    //property dealer - display only his houses, added as favourite
    // customer - display only his houses, added as favourite
    //FOR ADMIN            
    if ($_SESSION['IsAdmin'] == "1") {

        //If he is admin-display all users in database               
        $qSelectUsers = "SELECT  *                    
                        FROM `user` U 
                        LEFT JOIN  `userroles` UR
                        ON U.`rID` = UR.`urID`  
                        ";

        //trace($qSelectUsers);
        $res = $mysqli->query($qSelectUsers);
        //trace($res);

        if ($res->num_rows > 0) {
            $users = [];

            while ($row = $res->fetch_assoc()) {
                array_push($users, $row);
            } // while
//            trace($houses);
        } else {
            $failMsg = "Could not find user or something went wrong";
        } //else
    }// if ($row[0] == 'Admin')
    else {
        $failMsg = "Sorry, Only Admin can view Users.";
    }//else   
}//if
?>
</div><!--/topHeader-->
</header>
<main>
    <section class="mainBody">           
        <div class="contain">
            <section class="searchResults">
                <div class="headingCenter">
                    <h1>View Users</h1>
                </div><!--align heading-->
                <!-- ====================  FEEDBACK START =========-->
                <?php
                include("../includes/feedback.php");
                if (!isset($_GET['u_id'])) {
                    ?>
                    <!-- ====================  FEEDBACK END ===========-->
                    <div class="flexCont"><!--result house-->
                        <div class="resUser">
                            <div>
                                <p class="uRole">Role</p>
                            </div><!--user role-->
                            <div>                                   
                                <p class="uName">Name</p> 
                            </div><!--/user Name--> 
                            <div>
                                <p class="uEmail">Email</p>
                            </div><!--user email-->
                            <div>                                   
                                <p class="uPhone">Phone Number</p> 
                            </div><!--/Phone number--> 
                            <div>                                   
                                <p class="uPhone"></p> 
                            </div><!--/--> 
                            <div>                                   
                                <p class="uPhone"></p> 
                            </div><!--/Phone number--> 

                        </div>  <!--/resUser-->  
    <?php
    //start the loop
    if (isset($users) && isset($dbok) && $dbok) {
        foreach ($users as $user) {
            ?>

                                <div class="resUserDetails">
                                    <div>
                                        <p class="uRole"><?php echo $user['urRole']; ?></p>
                                    </div><!--user role-->
                                    <div>                                   
                                        <p class="uName"><?php echo $user['uName']; ?></p> 
                                    </div><!--/user Name--> 
                                    <div>
                                        <p class="uEmail"><?php echo $user['email']; ?></p>
                                    </div><!--user email-->
                                    <div>                                   
                                        <p class="uPhone"><?php echo $user['phone']; ?></p> 
                                    </div><!--/Phone number-->  
            <?php
            if (isset($_SESSION["IsAdmin"]) && $_SESSION["IsAdmin"] = "1") {
                ?>
                                        <div class="alignBtn">   
                                            
                                            <a href="<?php echo ROOT; ?>admin/addUser.php?u_id=<?php echo $user['uID']; ?>&editmode=1" class="btnSubmit">Edit User</a>

                                        </div><!--/alignBtn-->

                                        <div class="alignBtn"> 
                                            <!--                                        <button type="submit" name="delete" class="btnSubmit" value="Delete User" ​>Delete User</button>-->
                                            <a href="<?php echo ROOT; ?>admin/viewUsers.php?u_id=<?php echo $user['uID']; ?>" class="btnSubmit">Delete User</a>
                                        </div><!--/alignBtn-->
            <?php } ?>
                                </div><!--/resUserDetails-->
                            </div><!--/flexCont-->  
            <?php
        } // foreach
    } // if $users
}//if isset u_id
?>
            </section><!--/searchResults-->
        </div><!--/contain-->
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
</div><!--/ wrapper-->
<!--/ your JS here-->
<script src="<?php echo ROOT; ?>node_modules/jquery/dist/jquery.js"></script>
<script src="<?php echo ROOT; ?>node_modules/enquire.js/dist/enquire.min.js"></script>
<script src="<?php echo ROOT; ?>build/js/index.js"></script>

</body>
</html>
