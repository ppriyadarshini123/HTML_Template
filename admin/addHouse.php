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


if (isset($dbok) && $dbok && isset($_GET['h_id'])) {

    if ($_SESSION['IsAdmin'] == "1") {
        //Display Data from database
        //If he is admin-display all houses in database               
        $qSelectHouses = " SELECT DISTINCT *
                FROM `house` H
                LEFT JOIN `houseuser` HU
                ON H.`hID` = HU.`hID`
                LEFT JOIN `user` U
                ON HU.`uID` = U.`uID`
                LEFT JOIN `userroles` UR
                ON U.`rID` = UR.`urID`
                WHERE     
                     H.`hID` = " . $_GET['h_id'] . " LIMIT 1";
        trace($qSelectHouses);
        $res = $mysqli->query($qSelectHouses);
        trace($res);
        if ($res->num_rows > 0) {
            $houses = [];

            while ($row = $res->fetch_assoc()) {
                array_push($houses, $row);
            } // while
            trace($houses);
        } else {
            $failMsg = "Could not find house or something went wrong";
        } //else
        //Save the details in database
    }//if
}//if

if($_POST['submit'] && isset($_GET['h_id']))
{
    $rentsale = $_GET['rentsale'];
            if ($rentsale = "Rent")
                $rs = 1;
            else
                $rs = 2;
            $city = $_GET['city'];
            $details = $_GET['details'];
            $housenumber = $_GET['housenumber'];
            $postcode = $_GET['postcode'];
            $price = $_GET['price'];
            $streetname = $_GET['streetname'];

    //Update the edited house details
    $qUpdateHouse = "UPDATE `house` SET city = " . $city . ", rsID = " . $rs . ", details = " . $details . ", housenumber = " . $housenumber . ", postcode= " . $postcode . ", price$= " . $price . ", streetname= " . $streetname . " where `hID` = '" . $hID . "'";
    
    //            //Edit/Update House
//            //update mode: for Admin ONLY: Update values in database 
//            
//            $qUPDATE = "UPDATE `house` SET city = " . $city . ", rsID = " . $rs . ", details = " . $details . ", housenumber = " . $housenumber . ", postcode= " . $postcode . ", price$= " . $price . ", streetname= " . $streetname . " where `hID` = '" . $hID . "'";
//
//            trace($qUPDATE);
//            $dRes = $mysqli->query($qUPDATE);
//
//            if ($mysqli->affected_rows === 1) {
//                $successMsg = "House successfully updated.";
//            } else {
//                $failMsg = "Could not update house or house already deleted.";
//            } #### delete check    
//        
}
?>

</div><!--/topHeader-->
</header>
</div><!--/wrapper-->
<main>
    <section class="mainBody">
        <div class="contain">
            <section class="editAddItem">               
                <form method="post" action="#" class="fields">
                    <div class="headingCenter">
                        <h1>Add/Edit House</h1>
                    </div><!--headingCenter-->

                    <?php
                    //start the loop
                    if (isset($houses) && isset($dbok) && $dbok) {
                        foreach ($houses as $house) {
                            ?>
                            <div class="form">                       
                                <div class="align">
                                    <div>
                                        <label for="hRentSale">Rent/Sale</label>
                                    </div><!--label streetname-->
                                    <div>                                
                                        <input class="formField" type="text" id="hRentSale" name="hRentSale" value="<?php
                                        if (isset($house['rsID']) && ($_GET['editmode'] == 1)) {
//        echo $house['streetname'];
                                            if ($house['rsID'] == 1)
                                                echo 'Rent';
                                            else
                                                echo 'Sale';
                                        } else {
                                            echo '';
                                        }
                                        ?>     
                                               ">
                                    </div><!--input postcode-->
                                </div><!--align postcode-->
                                <div class="align">
                                    <div>
                                        <label for="hHouseNumber">House Number</label>
                                    </div><!-- label house number -->
                                    <div>
                                        <input class="formField" type="text" id="hHouseNumber" name="hHouseNumber" value="<?php
                                        if (isset($house['housenumber']) && ($_GET['editmode'] == 1)) {
                                            echo $house['housenumber'];
                                        } else {
                                            echo '';
                                        }
                                        ?>     ">
                                    </div><!--input housenumber-->
                                </div><!--align house number--> 
                                <div class="align">
                                    <div>
                                        <label for="hPrice">Price (£)</label>
                                    </div><!-- label Price -->
                                    <div>
                                        <input class="formField" type="text" id="hPrice" name="hPrice" value="<?php
                                        if (isset($house['price']) && ($_GET['editmode'] == 1)) {
                                            echo $house['price'];
                                        } else {
                                            echo '';
                                        }
                                        ?>     ">
                                    </div><!--input housenumber-->
                                </div><!--align price--> 
                                <div class="align">
                                    <div>
                                        <label for="hStreetname">Street Name</label>
                                    </div><!--label streetname-->
                                    <div>                                
                                        <input class="formField" type="text" id="hStreetname" name="hStreetname" value="<?php
                                        if (isset($house['streetname']) && ($_GET['editmode'] == 1)) {
                                            echo $house['streetname'];
                                        } else {
                                            echo '';
                                        }
                                        ?>     
                                               ">
                                    </div><!--input postcode-->
                                </div><!--align postcode-->
                                <div class="align">
                                    <div>
                                        <label for="hCity">City</label>
                                    </div><!-- label city -->
                                    <div>
                                        <input class="formField" type="text" id="hCity" name="hCity" value="<?php
                                        if (isset($house['city']) && ($_GET['editmode'] == 1)) {
                                            echo $house['city'];
                                        } else {
                                            echo '';
                                        }
                                        ?>     ">
                                    </div><!-- input city -->
                                </div><!-- align city -->
                                <div class="align">
                                    <div>
                                        <label for="hDetails">Details</label>
                                    </div><!-- label city -->
                                    <div>
                                        <input class="formField" type="text" id="hDetails" name="hDetails" value="<?php
                                        if (isset($house['details']) && ($_GET['editmode'] == 1)) {
                                            echo $house['details'];
                                        } else {
                                            echo '';
                                        }
                                        ?>     ">
                                    </div><!-- input city -->
                                </div><!-- align details -->
                                <div class="align">
                                    <div>
                                        <label for="hPropertyDealer">Property Dealer</label>
                                    </div><!-- label propertydealer -->
                                    <div>
                                        <select id="hPropertyDealer" name="propertydealer">
                                            <!--                                    <option value='' id='hPropertyDealer'></option>                          -->
                                            <!--                                    <option selected="selected" value="-->
                                            <?php
                                            if (isset($house['uName']) && ($_GET['editmode'] == 1)) {

                                                //Populate property dealers datalist
                                                $getPropertyDealers = "SELECT `uName` from `user` WHERE `rID`= 2";

                                                $res = $mysqli->query($getPropertyDealers);

                                                if ($res->num_rows > 0) {
                                                    $pds = [];

                                                    while ($row = $res->fetch_assoc()) {
                                                        array_push($pds, $row);
                                                    } // while 
//            trace($pds);
                                                }//if               
                                                foreach ($pds as $pd) {
                                                    if ($house['uName'] == $pd['uName']) {
                                                        echo '<option selected=\'selected\' value=\'' . $pd['uName'] . '\'>' . $pd['uName'] . '</option>';
                                                    } else {
                                                        echo '<option value=\'' . $pd['uName'] . '\'>' . $pd['uName'] . '</option>';
                                                    }//else            
                                                }//foreach
                                            }//if
                                            else {
                                                echo '';
                                            }//else
                                            ?>
                                        </select>
                                        </datalist>   
                                    </div><!-- input propertydealer -->
                                </div><!--/align property dealer-->
                                <div class="align">
                                    <div>
                                        <label for="hImage">Picture</label>
                                    </div><!-- label picture -->
                                    <div>
                                        <input class="formField" type="text" id="hImage" name="hImage" value="<?php
                                        if (isset($house['image']) && ($_GET['editmode'] == 1)) {
                                            echo $house['image'];
                                        } else {
                                            echo '';
                                        }
                                        ?>     ">
                                    </div><!--align picture-->

                                </div><!--/align images-->                    
                                <div class="align">
                                    <div>
                                        <label for="hFloorPlan">Floor Plan</label>
                                    </div><!-- label picture -->
                                    <div>
                                        <input class="formField" type="text" id="hFloorPlan" name="hFloorPlan" value="<?php
                                        if (isset($house['floorplan']) && ($_GET['editmode'] == 1)) {
                                            echo $house['floorplan'];
                                        } else {
                                            echo '';
                                        }
                                        ?>     ">
                                    </div><!--align floor plan-->
                                    <div class="alignBtn">
                                        <button type="submit" name="submit" class="btnSubmit">Submit</button>                              
                                    </div><!-- alignBtn -->
                                </div><!--/align floor plan-->
                                <?php
                            } // foreach
                        } // if $houses
                        ?>  
                </form><!--/editAddHouse-->
            </section><!--/editAddHouse-->
        </div><!--/container-->    
    </section><!--/mainBody-->
</main>
<?php include("../includes/footer.php"); ?> 

<script src="<?php echo ROOT; ?>node_modules/jquery/dist/jquery.js"></script>
<script src="<?php echo ROOT; ?>node_modules/enquire.js/dist/enquire.min.js"></script>
<script src="<?php echo ROOT; ?>build/js/index.js"></script>
<!--/ your JS here-->
</body>
</html>
