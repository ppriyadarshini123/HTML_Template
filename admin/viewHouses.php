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


if (isset($dbok) && $dbok) {
    //Check User: If he is admin-display all houses in database
    //property dealer - display only his houses, added as favourite
    // customer - display only his houses, added as favourite

    $qCheckUser = "SELECT UR.urRole, U.uID "
            . " FROM `user` U "
            . "LEFT JOIN `userroles` UR "
            . "ON U.`rID` = UR.`urID`"
            . " WHERE U.`uID` = '" . $_SESSION['logID'] . "'";

    trace($qCheckUser);
    if ($res = $mysqli -> query($qCheckUser)) {
    
    while ($row = $res -> fetch_row()) {
    
         //If he is admin-display all houses in database
    if ($row[0] == 'Admin') {
        
         $qSelectHouses = "SELECT *                    
                        FROM `house` H  
                        ";

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
        
    } 
    else {
        //Display Houses for PROPERTY DEALER and CUSTOMER
        //property dealer - display only his houses, added as favourite
         // customer - display only his houses, added as favourite
        $qSelectHouses = "SELECT H.`hID`, H.`rsID`, H.`housenumber`, H.`streetname`,
                        H.`city`, H.`postcode`, H.`details`, H.`image`, H. `price`
                    
                        FROM `house` H                        
                        LEFT JOIN  `houseuser` HU
                        ON H.`hID` = HU.`hID`                       
                        
                        WHERE HU.`uID` = '" . $_SESSION['logID'] . "'";

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
    }//else
              
  }//while ($row = $res -> fetch_row())

}//if ($res = $mysqli -> query($qCheckUser))

   
    
    //Edit House
   



    //Delete House
}//$dbok
else {
    $failMsg = "User not logged in";
}//else
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
                <!-- ====================  FEEDBACK START =========-->
<?php include("../includes/feedback.php"); ?>
                <!-- ====================  FEEDBACK END ===========-->
                <div>
                    <h2><?php if (isset($_SESSION['logNAME'])) {
    echo " Welcome " . $_SESSION['logNAME'];
} ?></h2>
                </div>
                <div class="resHouseTitle">
                    <div>
                        <p class="uRole">House</p>
                    </div><!--user role-->                               
                    <div class="alignCenter">                                   
                        <p >House Details</p> 
                    </div><!--/Phone number--> 
                </div>  <!--/resUser-->
                
                <?php
                            if (isset($houses) && isset($dbok) && $dbok) {
                                foreach ($houses as $house) {
                                    ?>
                
                <div class="resHouse flexCont"><!--result house-->
                    <picture>
                        <source media="(max-width: 359px)" srcset="../build/imgs/house-359x300.png">
                        <source media="(max-width: 768px)" srcset="../build/imgs/house-432x239.png">
                        <source media="(min-width: 1200px)" srcset="../build/imgs/house-432x239.png">
                        <img src="../build/imgs/house-359x300.png" class="mobile" width="432"  height="239" title="Click for House Details"
                             alt="Click for House Details">
                    </picture>
                    <div class="resStreetName">
                        <div>
                            <p class="hRentSale">House for Rent/Sale</p>
                        </div><!--house for rent/sale-->
                        <div>
                            <p class="hPrice">Price: £ 400k</p>
                        </div><!--price-->
                        <div>                                   
                            <p class="hStreet">35 Osier Way, Cambridge, CB1 5FR</p> 
                        </div><!--/Street Name-->  
                        <div>                                   
                            <p class="hDetails">4 bedroom detached house for sale</p> 
                        </div><!--/Details-->
                        <div class="alignBtn">   
                            <button type="button" class="btnSubmit">Edit House</button>
                            <button type="button" class="btnSubmit">Delete House</button>
                        </div><!--/alignBtn-->

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
