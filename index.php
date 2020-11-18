<?php
/**
 *
 * PHP course project
 * url: /index.php
 */
include("includes/utilities.php");

if ($dbok) {
    // DO NOT FORGET VALIDATION AND SANITATION!!!!    

    $keySaleRent = isset($_GET['dropdown']) ? $_GET['dropdown'] : '2';
    $keyCityPostCode = isset($_GET['cityPostcode']) ? $_GET['cityPostcode'] : '';
    $keyMin = isset($_GET['min']) ? $_GET['min'] : '0';
    $keyMax = isset($_GET['max']) ? $_GET['max'] : '0';

//    trace($keySaleRent);
//    trace($keyCityPostCode);
//    trace($keyMin);
//    trace($keyMax);
    /*
      mysql wildcards:
     * => any value
      % => any substring
      _ => any character
     */

    $q = "        
                SELECT H.`price`, H.`image`, H.`details`, H.`postcode`, H.`city`, H.`streetname`, H.`housenumber`, H.`rsID`, H.`hID`, RS.`rsID`, RS.`rsRentSale`
                FROM `" . DBN . "`.`house` H 
                LEFT JOIN `" . DBN . "`.`rentsale` RS 
                    ON RS.`rsID` = H.`rsID`
                LEFT JOIN `houseuser` HU
					ON H.`hID` = HU.`hID`
				LEFT JOIN `user` U
					ON HU.`uID` = U.`uID`
				LEFT JOIN `userroles` UR
					ON U.`rID` = UR.`urID`                    
                WHERE     
                    H.rsID = '$keySaleRent' AND UR.`urRole` = 'Property Dealer'
                    AND H.`city` LIKE '%$keyCityPostCode%'  
                    OR        
                    H.`postcode` LIKE '%$keyCityPostCode%'
                    AND       
                    H.`price` BETWEEN '$keyMin' AND '$keyMax'
                    
        ";

//   trace($q);
    $res = $mysqli->query($q);
//   trace($res);

    if ($res->num_rows > 0) {
        $houses = [];

        while ($row = $res->fetch_assoc()) {
            array_push($houses, $row);
            
        } // while
//        trace($houses);
    } else {
        displayMsg('Could not find house or something went wrong.', 'f');
    } # select check
} ### search logic
# 
# 
//   THIS IS THE BEGINNING OF THE MARKUP
include("includes/top.php");
include("includes/header.php");
include("includes/topNav.php");
include("includes/banner.php");
?>
</div><!--/topHeader-->
</header>
<main>
    <section class="mainBody">           
        <div class="contain">
            <section class="searchResults">
                <!-- ====================  FEEDBACK START =========-->
<?php include("includes/feedback.php"); ?>
                <!-- ====================  FEEDBACK END ===========-->

                <div class="headingCenter">
<?php if (isset($keySaleRent)) { ?>
    <?php
    if ($keySaleRent == 1) {
        $v = "Rent";
    } else {
        $v = "Sale";
    }
    ?>
                        <h1>Search Results for "<span class="qName"><?php
                        echo "{$v},{$keyCityPostCode},{$keyMin},{$keyMax}";
                        
                        ?></span>"</h1>
                    <?php } // if key ?>
                </div><!--headingCenter-->

                            <?php
                            if (isset($houses) && isset($dbok) && $dbok) {
                                foreach ($houses as $house) {
                                    ?>

                        <div class="resHouse flexCont"><!--result house-->
                            <a class="hImage" href="<?php echo ROOT; ?>houseDetails.php?h_id=<?php echo $house['hID']; ?>">
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
                                        echo(explode(";",$house['image'])[0]);//explode is a string function to break the string from ; into arrays                                        
                                        
                                    } else {
                                        echo "no-image-359x198.png";
                                    }
                                    ?>" class="mobile"  title="Click for House Details"
                                         alt="Click for House Details">
                                </picture>
                            </a><!--/hImage-->
                            <div class="resStreetName">
                                <div>
                                    <p class="hRentSale">House for <?php
                                         echo $v;
                                         ?></p>
                                </div><!--/hRentSale-->
                                <div>
                                    <p class="hPrice">Price: £ <?php
                                         if (isset($house['price'])) {
                                             echo $house['price'];
                                         }
                                         else
                                             echo '--';
                                         ?></p>
                                </div><!--/hPrice-->
                                <div>                                   
                                    <p class="hStreet"><?php
                                        if (isset($house['housenumber'])) {
                                            echo "{$house['housenumber']},{$house['streetname']},{$house['city']},{$house['postcode']}";
                                        }
                                        else
                                             echo '--';
                                        ?></p> 
                                </div><!--/hStreet-->  
                                <div>                                   
                                    <p class="hDetails"><?php
                                        if (isset($house['details'])) {
                                            echo $house['details'];
                                        } else
                                             echo '--';
                                        ?></p> 
                                </div><!--/hDetails-->
                                <div class="alignBtn">                            
<!--                                    <button class="btnSubmit" name="submit">Add to Favourites</button>-->
                                    <a href="<?php echo ROOT; ?>admin/signin.php?h_id=<?php echo $house['hID']; ?>&page=index.php" class="btnSubmit">Add to Favourites</a>
                                </div><!--/alignBtn-->
                            </div><!--/resStreetName-->
                        </div>  <!--/resHouse-->  
        <?php
    } // foreach
} // if $houses
?>
            </section><!--/searchResults-->
        </div><!--/mainBody container-->
    </section><!--/ mainBody-->
</main>
                <?php include("includes/footer.php"); ?> 

</div><!--/wrapper-->
<script src="node_modules/jquery/dist/jquery.js"></script>
<script src="node_modules/enquire.js/dist/enquire.min.js"></script>
<script src="build/js/index.js"></script>
<!--/ your JS here-->
</body>
</html>