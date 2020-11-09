<?php
/**
 *
 * PHP course project
 * url: /index.php
 */
include("includes/utilities.php");


if ($dbok)
{
    // DO NOT FORGET VALIDATION AND SANITATION!!!!    
    $keySaleRent = isset($_GET['dropdown']) ? $_POST['dropdown'] : '';
    $keyCityPostCode = isset($_GET['cityPostcode']) ? $_POST['cityPostcode'] : '';
    $keyMin = isset($_GET['min']) ? $_POST['min'] : '';
    $keyMax = isset($_GET['max']) ? $_POST['max'] : '';    
    
    /*
      mysql wildcards:
     * => any value
      % => any substring
      _ => any character
     */


    $q = "        
                SELECT H.`price`, H.`image`, H.`details`, H.`postcode`, H.`city`, H.`streetname`, H.`housenumber`, H.`rsID`, H.`hID`, RS.`rsID`, RS.`rsRentSale`
                FROM `house` H LEFT JOIN `rentsale` RS ON RS.`rsID` = H.`rsID`
                WHERE
                     RS.`rsRentSale` LIKE '%$keySaleRent%'
                   OR        
                     H.`city` LIKE '%$keyCityPostCode%'  
                     OR        
                     H.`postcode` LIKE '%$keyCityPostCode%'
                     OR        
                     H.`price` BETWEEN '%$keyMin%' AND '%$keyMax%'
        ";

    $res = $mysqli->query($q);
    trace($res);
    
    if ($res->num_rows > 0) {
        $houses = [];

        while ($row = $res->fetch_assoc()) {
            array_push($houses, $row);
        } // while
         trace($houses);
    } else {
        displayMsg('Could not find house or something went wrong.', 'f');
    } # select check
} ### search logic
# 
# 
# 
//   THIS IS THE BEGINNING OF THE MARKUP
include("includes/top.php");
include("includes/header.php");
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
                    <h1>Search Results</h1>
                </div><!--headingCenter-->
                <div class="resHouse flexCont"><!--result house-->
                    <a class="hImage" href="houseDetails.php">
                        <picture>
                            <source media="(max-width: 359px)" srcset="build/imgs/house-359x300.png">
                            <source media="(max-width: 768px)" srcset="build/imgs/house-432x239.png">
                            <source media="(min-width: 1200px)" srcset="build/imgs/house-432x239.png">
                            <img src="build/imgs/house-359x300.png" class="mobile" width="432"  height="239" title="Click for House Details"
                                 alt="Click for House Details">
                        </picture>
                    </a><!--/hImage-->
                    <div class="resStreetName">
                        <div>
                            <p class="hRentSale">House for Rent/Sale</p>
                        </div><!--/hRentSale-->
                        <div>
                            <p class="hPrice">Price: £ 400k</p>
                        </div><!--/hPrice-->
                        <div>                                   
                            <p class="hStreet">35 Osier Way, Cambridge, CB1 5FR</p> 
                        </div><!--/hStreet-->  
                        <div>                                   
                            <p class="hDetails">4 bedroom detached house for sale</p> 
                        </div><!--/hDetails-->
                        <div class="alignBtn">                            
                            <button type="button" class="btnSubmit">Add to Favourites</button>
                        </div><!--/alignBtn-->
                    </div><!--/resStreetName-->
                </div>  <!--/resHouse-->             
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