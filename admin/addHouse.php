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
//IF the admin wants to edit the house, he should have a h_id and IsAdmin should be 1
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
//UPDATE MODE
//Update House values in Database
if ($_POST['submit'] && isset($_GET['h_id'])) {
    if ($_SESSION['IsAdmin'] == "1") {
        $hID = $_GET['h_id'];
        if (isset($_POST['hRentSale'])) {
            $rentsale = $_POST['hRentSale'];

            if ($rentsale = "Rent") {
                $rs = 1;
            } else {
                $rs = 2;
            }
        }
        if (isset($_POST['hHouseNumber'])) {
            $housenumber = trim($_POST['hHouseNumber']);
        }
        if (isset($_POST['hCity'])) {
            $city = trim($_POST['hCity']);
        }
        if (isset($_POST['hDetails'])) {
            $details = trim($_POST['hDetails']);
        }
        if (isset($_POST['propertydealer'])) {
            echo $propertydealer;
            $propertydealer = trim($_POST['propertydealer']);
        }
        if (isset($_POST['hImage'])) {
            $image = trim($_POST['hImage']);
        }
        if (isset($_POST['hFloorPlan'])) {
            $floorplan = trim($_POST['hFloorPlan']);
        }
        if (isset($_POST['hPostCode'])) {
            $postcode = trim($_POST['hPostCode']);
        }
        if (isset($_POST['hPrice'])) {
            $price = trim($_POST['hPrice']);
        }
        if (isset($_POST['hStreetname'])) {
            $streetname = trim($_POST['hStreetname']);
        }

        //Update the edited house details
        $qUpdateHouse = "UPDATE `house` H "
                . "LEFT JOIN `houseuser` HU "
                . "ON H.`hID` = HU.`hID` "
                ."LEFT JOIN `user` U "
                ."ON HU.`uID` = U.`uID` "
                ."LEFT JOIN `userroles` UR "
                ."ON U.`rID` = UR.`urID` "
                . "SET `city`='".$city."',`propertydealer`='".$propertydealer."', `uID`= '".$house['uID']."', `rsID`= '".$rs."',`details`='".$details."',`floorplan`='".$floorplan."',`image`='".$image."',`housenumber`='".$housenumber."',`postcode`='".$postcode."',`price`='".$price."',`streetname`='".$streetname."' where `hID` = '" . $hID . "'";
        trace($qUpdateHouse);
        
        $dRes = $mysqli->query($qUpdateHouse);
        if ($mysqli->affected_rows === 1) {
            $successMsg = "House successfully updated.";
        } else {
            $failMsg = "Could not update house or house already deleted.";
        } #### delete check    
    }//if
}//if
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
                     <!-- ====================  FEEDBACK START =========-->
                <?php include("../includes/feedback.php"); ?>
                <!-- ====================  FEEDBACK END ===========-->
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
                            echo trim('Rent');
                        else
                            echo trim('Sale');
                    } else {
                        echo '';
                    }
        ?>     
                                               ">
                                    </div><!--input rent sale-->
                                </div><!--align rent sale-->
                                <div class="align">
                                    <div>
                                        <label for="hHouseNumber">House Number</label>
                                    </div><!-- label house number -->
                                    <div>
                                        <input class="formField" type="text" id="hHouseNumber" name="hHouseNumber" value="<?php
                                if (isset($house['housenumber']) && ($_GET['editmode'] == 1)) {
                                    echo trim($house['housenumber']);
                                } else {
                                    echo '';
                                }
        ?>     ">
                                    </div><!--input housenumber-->
                                </div><!--align house number--> 
                                <div class="align">
                                    <div>
                                        <label for="hPostCode">PostCode</label>
                                    </div><!-- label postcode -->
                                    <div>
                                        <input class="formField" type="text" id="hPostCode" name="hPostCode" value="<?php
                                if (isset($house['postcode']) && ($_GET['editmode'] == 1)) {
                                    echo trim($house['postcode']);
                                } else {
                                    echo '';
                                }
        ?>     ">
                                    </div><!--input postcode-->
                                </div><!--align postcode--> 
                                <div class="align">
                                    <div>
                                        <label for="hPrice">Price (£)</label>
                                    </div><!-- label Price -->
                                    <div>
                                        <input class="formField" type="text" id="hPrice" name="hPrice" value="<?php
                                if (isset($house['price']) && ($_GET['editmode'] == 1)) {
                                    echo trim($house['price']);
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
                                    echo trim($house['streetname']);
                                } else {
                                    echo '';
                                }
        ?>     
                                               ">
                                    </div><!--input streetname-->
                                </div><!--align streetname-->
                                <div class="align">
                                    <div>
                                        <label for="hCity">City</label>
                                    </div><!-- label city -->
                                    <div>
                                        <input class="formField" type="text" id="hCity" name="hCity" value="<?php
                                if (isset($house['city']) && ($_GET['editmode'] == 1)) {
                                    echo trim($house['city']);
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
                                    echo trim($house['details']);
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
                                        <select id="hPropertyDealer" name="hPropertyDealer">
                                            <!--  <option value='' id='hPropertyDealer'></option>                          -->
                                            <!--  <option selected="selected" value="-->
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
                                        echo trim($house['image']);
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
                                    echo trim($house['floorplan']);
                                } else {
                                    echo '';
                                }
        ?>     ">
                                    </div><!--align floor plan-->
                                </div><!--/align floor plan-->                             

                                <div class="alignBtn">
                                    <!--                                    <a href="#" class="btnSubmit">Edit House</a>-->
                                    <button type="submit" name="submit" class="btnSubmit" value="submit">Submit</button>
                                   <!--                                    <input type="submit" name="submit" class="btnSubmit" value="submit">                              -->
                                </div><!-- alignBtn -->                                
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
