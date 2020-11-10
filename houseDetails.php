<?php
/**
 *
 * PHP course project
 * url: /index.php
 */
include("includes/utilities.php");

//   THIS IS THE BEGINNING OF THE MARKUP
include("includes/top.php");
include("includes/header.php");

if ($dbok) {
    // DO NOT FORGET VALIDATION AND SANITATION!!!!    

    $keyID = isset($_GET['h_id']) ? $_GET['h_id'] : '';

    trace($keyID);
    $q = "        
                SELECT H.`price`, H.`image`, H.`details`, H.`postcode`, H.`city`, H.`streetname`, H.`housenumber`, H.`rsID`, H.`hID`
                FROM `house` H 
                WHERE     
                     H.hID = '$keyID';
        ";

    trace($q);
    $res = $mysqli->query($q);
    trace($res);

    if ($res->num_rows > 0) {
        $houses = [];

        while ($row = $res->fetch_assoc()) {
            array_push($houses, $row);
        } // while
//        trace($houses);
    } else {
        displayMsg('Could not find house or something went wrong.', 'f');
    } # select check
}

# 

?>

</div><!--/topHeader-->
</header>
<main>
    <section class="mainBody">           
        <div class="contain housedetails">
            <div class="headingCenter">
                <h1>House Details</h1>
            </div><!--headingCenter-->
            <section class="searchResults">

<?php
if (isset($houses) && isset($dbok) && $dbok) {
    foreach ($houses as $house) {
        ?>

                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
        <!--                            <picture>-->
        <!--                                <source media="(max-width: 768px)" srcset="build/imgs/house-432x239.png">
                                        <source media="(min-width: 1200px)" srcset="build/imgs/house-432x239.png">-->
                                    <img class="d-block w-100" src="<?php echo ROOT; ?>build/imgs/<?php
                if (isset($house['image'])) {
                    echo(explode(";", $house['image'])[0]); //explode is a string function to break the string from ; into arrays                                       
                } else {
                    echo "no-image-359x198.png";
                }
        ?>" alt="First slide">
                                    <!--                            </picture>-->
                                </div><!-- carousel-item active-->
                                <div class="carousel-item">
        <!--                            <picture>-->
        <!--                                <source media="(max-width: 768px)" srcset="build/imgs/house-insideview-432x239.png">
                                        <source media="(min-width: 1200px)" srcset="build/imgs/house-insideview-432x239.png">-->
                                    <img class="d-block w-100" src="<?php echo ROOT; ?>build/imgs/<?php
                            if (isset($house['image'])) {
                                echo(explode(";", $house['image'])[1]); //explode is a string function to break the string from ; into arrays                                        
                            } else {
                                echo "no-image-359x198.png";
                            }
        ?>" alt="Second slide">
                                    <!--                            </picture>-->
                                </div><!-- carousel-item-->
                                <div class="carousel-item">
        <!--                            <picture>-->
        <!--                                <source media="(max-width: 768px)" srcset="build/imgs/houseinsideview2-432x239.png">
                                        <source media="(min-width: 1200px)" srcset="build/imgs/houseinsideview2-432x239.png">-->
                                    <img class="d-block w-100" src="<?php echo ROOT; ?>build/imgs/<?php
                            if (isset($house['image'])) {
                                echo(explode(";", $house['image'])[2]); //explode is a string function to break the string from ; into arrays                                        
                            } else {
                                echo "no-image-359x198.png";
                            }
        ?>" alt="Third slide">
                                    <!--                            </picture>-->
                                </div><!-- carousel-item-->
                            </div><!-- carousel-inner-->
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div><!-- carousel slide-->
                        <div class="flexAlign headingHouseDetails">
                            <div class="divDetails clicked notClicked" id="divDetails">Details
                            </div> <!-- divDetails-->                       
                            <div class="divFloorPlan clicked notClicked" id="divFloorPlan">Floor Plan
                            </div><!-- divFloorPlan-->                 
                        </div><!--/flexAlign-->
                        <div class="resStreetNameDetails" id="clickedDivDetails">
                            <div>
                                <p class="hRentSale">House for Rent/Sale</p>
                            </div><!-- rent/sale-->
                            <div>
                                <p class="hPrice">Price: £ 400k</p>
                            </div><!-- price-->
                            <div>                                   
                                <p class="hStreet">35 Osier Way, Cambridge, CB1 5FR</p> 
                            </div><!--/StreetName-->  
                            <div>                                   
                                <p class="hDetails">4 bedroom detached house for sale</p> 
                            </div><!--/hDetails-->
                            <div>                                   
                                <p class="hPD">Property Dealer: Malcolms</p> 
                            </div><!--/hPD-->
                            <div class="flexAlignInline">
                                <div class="alignBtnFav">
                                    <input name="AddtoFavourites" type="submit" class="btnSubmit" value="Add to Favourites">
                                </div><!--/alignBtnFav-->
                                <div class="alignBtnFav">
                                    <input name="ContactPropertyDealer" type="submit" class="btnSubmit" value="Contact Property Dealer">
                                </div><!--/alignBtnFav-->
                            </div><!--/flexAlignInline-->
                        </div><!--/resStreetNameDetails-->
                        <div class="clickedDivFloorPlan" id="clickedDivFloorPlan">
                            <picture>
                                <source media="(max-width: 768px)" srcset="build/imgs/floor-plan.jpg">
                                <source media="(min-width: 1200px)" srcset="build/imgs/floor-plan.jpg">
                                <img src="build/imgs/floor-plan.jpg" width="200" height="200" alt="alt"/> 
                            </picture>
                        </div><!--/clickedDivFloorPlan-->  

        <?php
    }
}
?>

            </section><!--/searchResults-->
        </div><!--/wrapper mainBody container-->
    </section><!--/mainBody-->
</main>
<?php include("includes/footer.php"); ?> 
</div><!--/wrapper-->
<!-- add your JS here-->
<script src="node_modules/jquery/dist/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="node_modules/enquire.js/dist/enquire.min.js"></script>
<script src="build/js/index.js"></script>
</body>
</html>
