<?php
/**
 *
 * PHP course project
 * url: /viewHouses.php
 */
include("../includes/utilities.php");
include("../includes/auth.php");

//   THIS IS THE BEGINNING OF THE MARKUP
include("../includes/top.php");
include("../includes/header.php");
include("../includes/signoutNav.php");
include("../includes/bottomNav.php");

//SELECT QUERY
if (isset($dbok) && $dbok && !isset($_GET['h_id'])) {
    //Check User: If he is admin-display all houses in database
    //property dealer - display only his houses, added as favourite
    // customer - display only his houses, added as favourite
    //FOR ADMIN            
    if ($_SESSION['IsAdmin'] == "1") {

        //If he is admin-display all houses in database               
        $qSelectHouses = "SELECT *                    
                        FROM `house` H  
                        ";

        //    trace($qSelectHouses);
        $res = $mysqli->query($qSelectHouses);
        //    trace($res);

        if ($res->num_rows > 0) {
            $houses = [];

            while ($row = $res->fetch_assoc()) {
                array_push($houses, $row);
            } // while
//            trace($houses);
        } else {
            $failMsg = "Could not find house or something went wrong";
        } //else
    }// if ($row[0] == 'Admin')
    else {

        //NOT ADMIN
        //Display Houses for PROPERTY DEALER and CUSTOMER
        //property dealer - display only his houses, added as favourite
        // customer - display only his houses, added as favourite
        $qSelectHouses = "SELECT H.`hID`, H.`rsID`, H.`housenumber`, H.`streetname`,
                        H.`city`, H.`postcode`, H.`details`, H.`image`, H. `price`                    
                        FROM `house` H                        
                        LEFT JOIN  `houseuser` HU
                        ON H.`hID` = HU.`hID`  
                        WHERE HU.`uID` = '" . $_SESSION['logID'] . "'";

        //trace($qSelectHouses);
        $res = $mysqli->query($qSelectHouses);
        //trace($res);

        if ($res->num_rows > 0) {
            $houses = [];

            while ($row = $res->fetch_assoc()) {
                array_push($houses, $row);
            } // while
//            trace($houses);
        } else {
            $failMsg = "Could not find house or something went wrong";
        } //else
    }//else   
}//if
//EDIT & DELETE MODE
if ($dbok && isset($_GET['h_id']) && isset($_SESSION['IsAdmin']) && isset($_SESSION['logID'])) {

    $hID = $_GET['h_id'];
    if ($_SESSION['IsAdmin'] == "1" && isset($_POST['edit'])) {

        if ($_POST['edit']) {

            //Edit/Update House
            //update mode: for Admin ONLY: Update values in database 
            $rentsale = $_GET['rentsale'];
            if ($rentsale = "Rent") $rs = 1;
            else $rs = 2;
            $city = $_GET['city'];
            $details = $_GET['details'];
            $housenumber = $_GET['housenumber'];
            $postcode = $_GET['postcode'];
            $price = $_GET['price'];
            $streetname = $_GET['streetname'];
            
            
            $qUPDATE = "UPDATE `house` SET city = " . $city . ", rsID = ". $rs .", details = " . $details . ", housenumber = " . $housenumber . ", postcode= " . $postcode . ", price$= " . $price . ", streetname= " . $streetname . " where `hID` = '" . $hID . "'";

            trace($qUPDATE);
            $dRes = $mysqli->query($qUPDATE);

            if ($mysqli->affected_rows === 1) {
                $successMsg = "House successfully updated.";
            } else {
                $failMsg = "Could not update house or house already deleted.";
            } #### delete check    
        }//if ($_POST['edit']) {
    }//if
    else {
        //Delete House
        //delete mode: for Admin: Delete house from database
        //             for property dealer and customer: Remove as favourite
        //Remove as favourite for customer and property dealer. i.e. remove house from houseuser table for userid
        if ($_SESSION['IsAdmin'] == "1") {
            //ADMIN MODE - Delete house from database        
            $qDELETE = "DELETE FROM `house` where `hID` = '" . $hID . "'";
        } else {
            //For customer and property dealer - Remove as favourite        
            $qDELETE = "DELETE FROM `houseuser` WHERE hID = " . $hID . " AND uID= " . $logID;
        }//else
        trace($qDELETE);
        $dRes = $mysqli->query($qDELETE);

        if ($mysqli->affected_rows === 1) {
            $successMsg = "House successfully deleted.";
        } else {
            $failMsg = "Could not delete house or house already deleted.";
        } #### delete check
    }//else
}//if
?>
</div><!--/topHeader-->
</header>
</div><!--/wrapper-->
<main>
    <section class="mainBody">           
        <div class="contain">
            <section class="searchResults">
                <div class="headingCenter">
                    <h1>View Houses</h1>
                </div><!--align heading-->

                <div>
                    <h2><?php
if (isset($_SESSION['logNAME'])) {
    echo " Welcome " . $_SESSION['logNAME'];
}
?></h2>
                </div>
                <!-- ====================  FEEDBACK START =========-->
                <?php include("../includes/feedback.php"); ?>
                <!-- ====================  FEEDBACK END ===========-->
                <div class="resHouseTitle">
                    <div>
                        <p class="uRole">House</p>
                    </div><!--user role-->                               
                    <div class="alignCenter">                                   
                        <p >House Details</p> 
                    </div><!--/Phone number--> 
                </div>  <!--/resUser-->

                <?php
//start the loop
                if (isset($houses) && isset($dbok) && $dbok) {
                    foreach ($houses as $house) {
                        ?>

                        <div class="resHouse flexCont"><!--result house-->
                            <picture>
            <!--                                    <source media="(max-width: 359px)" srcset="<?php echo ROOT; ?>build/imgs/<?php
                if (isset($house['image'])) {
                    echo $house['image'];
                } else {
                    echo "no-image-359x198.png";
                }
                        ?>">
                                        <source media="(max-width: 768px)" srcset="<?php echo ROOT; ?>build/imgs/<?php echo ROOT; ?>build/imgs/<?php
                        if (isset($house['image'])) {
                            echo $house['image'];
                        } else {
                            echo "no-image-432x239.png";
                        }
                        ?>">
                                        <source media="(min-width: 1200px)" srcset="<?php echo ROOT; ?>build/imgs/<?php echo ROOT; ?>build/imgs/<?php
                        if (isset($house['image'])) {
                            echo $house['image'];
                        } else {
                            echo "no-image-432x239.png";
                        }
                        ?>">-->


                                <img src="<?php echo ROOT; ?>build/imgs/<?php
                        if (isset($house['image'])) {
                            global $house;
                            echo(explode(";", $house['image'])[0]); //explode is a string function to break the string from ; into arrays                                        
                        } else {
                            echo "no-image-359x198.png";
                        }
                        ?>" class="mobile"  title="Click for House Details"
                                     alt="Click for House Details">
                            </picture>
                            <div class="resStreetName">
                                <div>
                                    <p class="hRentSale">House for <?php
                                    if(isset($_POST['edit'])){
                                       ?>                                           
                                        <input value="0" name="rentsale" type="text"> 
                                           <?php                                         
                                    }
                                    else {
                                         if (isset($house['rsID'])) {
                            if ($house['rsID'] == 2)
                                echo 'Sale';
                            else
                                echo 'Rent';
                        }
                                    }
                                    
                       
                        ?></p>
                                </div><!--house for rent/sale-->
                                <div>
                                    <p class="hPrice">Price: £ <?php
                                if (isset($house['price'])) {
                                    echo $house['price'];
                                } else
                                    echo '--';
                        ?></p>
                                </div><!--price-->
                                <div>                                   
                                    <p class="hStreet"><?php
                                if (isset($house['housenumber'])) {
                                    echo "{$house['housenumber']},{$house['streetname']},{$house['city']},{$house['postcode']}";
                                } else
                                    echo '--';
                        ?></p> 
                                </div><!--/Street Name-->  
                                <div>                                   
                                    <p class="hDetails"><?php
                                if (isset($house['details'])) {
                                    echo $house['details'];
                                } else
                                    echo '--';
                        ?></p>
                                </div><!--/Details-->

                                <?php
                                if (isset($isAdmin) && $isAdmin) {
                                    ?>
                                    <div class="alignBtn"> 
                                        <input type="submit" name="edit" class="btnSubmit" value="Edit House">
                                    </div><!--/alignBtn-->

                                    <div class="alignBtn"> 
                                        <a href="<?php echo ROOT; ?>admin/viewHouses.php?h_id=<?php echo $house['hID']; ?>&isAdmin=<?php $isAdmin ?>" class="btnSubmit">Delete House</a>
                                    </div><!--/alignBtn-->
                                <?php } else { ?>
                                    <div class="alignBtn"> 
                                        <input type="submit" name="edit" class="btnSubmit" value="Edit House">
                                    </div><!--/alignBtn-->
                                    <div class="alignBtn">                            
                                        <!--                                    <button class="btnSubmit" name="submit">Add to Favourites</button>-->
                                        <a href="<?php echo ROOT; ?>admin/viewHouses.php?h_id=<?php echo $house['hID']; ?>&isAdmin=<?php $isAdmin ?>" class="btnSubmit">Remove House as Favourite</a>
                                    </div><!--/alignBtn-->
                                <?php } ?>

                            </div><!--/resStreetName-->
                        </div>  <!--/resHouse-->  

                        <?php
                    } // foreach
                } // if $houses
                ?>
            </section><!--/searchResults-->
        </div><!--/mainBody contain-->
    </section><!--/ mainBody-->
</main>
<?php include("../includes/footer.php"); ?> 

<script src="<?php echo ROOT; ?>node_modules/jquery/dist/jquery.js"></script>
<script src="<?php echo ROOT; ?>node_modules/enquire.js/dist/enquire.min.js"></script>
<script src="<?php echo ROOT; ?>build/js/index.js"></script>
<!--/ your JS here-->
</body>
</html>
