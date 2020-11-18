<?php
/**
 *
 * PHP course project
 * url: /houseDetails.php
 */
include("includes/utilities.php");

if ($dbok) {
    // DO NOT FORGET VALIDATION AND SANITATION!!!!    

    $keyID = isset($_GET['h_id']) ? $_GET['h_id'] : '';

//    trace($keyID);
    $q = "        
               SELECT H.`hID`, H.`rsID`, H.`housenumber`, H.`streetname`, H.`city`, H.`postcode`, H.`details`, H.`image`, H.`floorplan`, H.`price`, HU.`uID`, U.`email`, U.`uName`
                FROM `house` H
                LEFT JOIN `houseuser` HU
                ON H.`hID` = HU.`hID`
                LEFT JOIN `user` U
                ON HU.`uID` = U.`uID`
                LEFT JOIN `userroles` UR
                ON U.`rID` = UR.`urID`
                WHERE     
                     H.`hID` = '$keyID' AND UR.`urRole` = 'Property Dealer' LIMIT 1                
        ";

//    trace($q);
    $res = $mysqli->query($q);
//    trace($res);
    $house = $res->fetch_assoc();

//    trace($house);
} else {
    displayMsg('Could not find house or something went wrong.', 'f');
} # select check# 
//   THIS IS THE BEGINNING OF THE MARKUP
include("includes/top.php");
include("includes/header.php");
include("includes/topNav.php");
?>
</div><!--/topHeader-->
</header>
<main>
    <?php
    if (isset($house)) {
        ?>
        <section class="mainBody">           
            <div class="contain housedetails">
                <div class="headingCenter">
                    <h1>House Details</h1>
                </div><!--headingCenter-->
                <section class="searchResults">                    
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">  
                                <img class="d-block w-100"  src="<?php echo ROOT; ?>build/imgs/<?php
                                if (isset($house['image'])) {
                                    echo(explode(";", $house['image'])[0]); //explode is a string function to break the string from ; into arrays                                        
                                } else {
                                    echo "no-image-359x198.png";
                                } //explode is a string function to break the string from ; into arrays                                       
                                ?>" alt="First slide">                               
                            </div><!-- carousel-item active-->
                            <div class="carousel-item">
                                <img class="d-block w-100"  src="<?php echo ROOT; ?>build/imgs/<?php
                                if (isset($house['image'])) {
                                    echo(explode(";", $house['image'])[1]); //explode is a string function to break the string from ; into arrays                                        
                                } else {
                                    echo "no-image-359x198.png";
                                } //explode is a string function to break the string from ; into arrays                                        
                                ?>" alt="Second slide">                             
                            </div><!-- carousel-item-->
                            <div class="carousel-item">
                                <img class="d-block w-100"  src="<?php echo ROOT; ?>build/imgs/<?php
                                if (isset($house['image'])) {
                                    echo(explode(";", $house['image'])[2]); //explode is a string function to break the string from ; into arrays                                        
                                } else {
                                    echo "no-image-359x198.png";
                                } //explode is a string function to break the string from ; into arrays                                        
                                ?>" alt="Third slide">                                
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
                            <p class="hRentSale">House for <?php
                                if (isset($house['rsID'])) {
                                    if ($house['rsID'] == 1)
                                        echo("Rent");
                                    else {
                                        echo("Sale");
                                    }
                                }
                                ?></p>
                        </div><!-- rent/sale-->
                        <div>
                            <p class="hPrice">Price: £ 
                                <?php
                                if (isset($house['price'])) {
                                    echo($house['price']);
                                } else
                                    echo '--';
                                ?>
                                k</p>
                        </div><!-- price-->
                        <div>                                   
                            <p class="hStreet"> <?php
                                if (isset($house['housenumber'])) {
                                    echo "{$house['housenumber']},{$house['streetname']},{$house['city']},{$house['postcode']}";
                                } else
                                    echo '--';
                                ?></p> 
                        </div><!--/StreetName-->  
                        <div>                                   
                            <p class="hDetails">  <?php
                                if (isset($house['details'])) {
                                    echo($house['details']);
                                } else
                                    echo '--';
                                ?></p> 
                        </div><!--/hDetails-->
                        <div>                                   
                            <p class="hPD">Property Dealer: <?php
                                if (isset($house['uName'])) {
                                    echo($house['uName']);
                                } else
                                    echo '--';
                                ?></p> 
                        </div><!--/hPD-->
                        <div class="flexAlignInline">
                            <div class="alignBtnFav">
    <!--                                <input name="AddtoFavourites" type="submit" class="btnSubmit" value="Add to Favourites">-->
                                <a href="<?php echo ROOT; ?>admin/signin.php?h_id=<?php echo $house['hID']; ?>&page=houseDetails.php" class="btnSubmit">Add to Favourites</a>
                            </div><!--/alignBtnFav-->
                            <div class="alignBtnFav">
    <!--                                <input name="ContactPropertyDealer" type="submit" class="btnSubmit" value="Contact Property Dealer">-->
                                <a class="btnSubmit" href="mailto:<?php echo($house['email']); ?>?subject=Interested in this property&body=Hi, I really like this house and would like to know if I can fix an appointment to view this property.Thanks">Contact Property Dealer</a>
                            </div><!--/alignBtnFav-->
                        </div><!--/flexAlignInline-->
                    </div><!--/resStreetNameDetails-->
                    <div class="clickedDivFloorPlan" id="clickedDivFloorPlan">
                        <picture>
                            <source media="(max-width: 768px)" srcset="<?php echo ROOT; ?>build/imgs/<?php echo $house['floorplan']; ?>">
                            <source media="(min-width: 1200px)" srcset="<?php echo ROOT; ?>build/imgs/<?php echo $house['floorplan']; ?>">
                            <img src="<?php echo ROOT; ?>build/imgs/<?php echo $house['floorplan']; ?>" width="200" height="200" alt="alt"/> 
                        </picture>
                    </div><!--/clickedDivFloorPlan-->  
                </section><!--/searchResults-->
            </div><!--/wrapper mainBody container-->
        </section><!--/mainBody-->
        <?php
    }
    ?> 
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
