  <?php
    /**
     *
     * PHP course project
     * url: /index.php
     */
    include("includes/utilities.php");
    ?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>PHP PROJECT| HOME</title>
        <link rel="stylesheet" href="https://use.typekit.net/vnj5wbt.css"><!-- Special Font used in e.g. Search -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
        <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css"> <!-- Required for Bootstrap -->
        <link rel="stylesheet" href="build/css/main.css" media="screen"/>
        <link rel="shortcut icon" type="image/x-icon" href=""/>
        <meta name="author" content="Payal"/>
        <meta name="description" content="php project"/>
        <meta name="keywords" content="housing agency house search"/>
    </head>  
    <body>
        <div class="wrapper">
            <header>
                <div class="topHeader">
                    <div class="identity">
                        <a  href="<?php echo ROOT; ?>index.php">
                            <img class="logo" src="<?php echo ROOT; ?>build/imgs/HomeSearch_logo_1-218x139.png" alt="logo">
                        </a>
                    </div><!--/identity-->
                    <nav class="topNav">
                        <ul>
                            <li><a  href="<?php echo ROOT; ?>index.php">Home</a></li> <!-- class="currentPageLink" -->
                            <li><a href="<?php echo ROOT; ?>admin/signin.php">Sign In</a></li>                
                        </ul>
                    </nav><!--/topNav-->
                </div><!--/topHeader-->
            </header>
            <main>
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
                                        <picture>
                                            <source media="(max-width: 768px)" srcset="build/imgs/house-432x239.png">
                                            <source media="(min-width: 1200px)" srcset="build/imgs/house-432x239.png">
                                            <img class="d-block w-100" src="build/imgs/house-432x239.png" alt="First slide">
                                        </picture>
                                    </div><!-- carousel-item active-->
                                    <div class="carousel-item">
                                        <picture>
                                            <source media="(max-width: 768px)" srcset="build/imgs/house-insideview-432x239.png">
                                            <source media="(min-width: 1200px)" srcset="build/imgs/house-insideview-432x239.png">
                                            <img class="d-block w-100" src="build/imgs/house-insideview-432x239.png" alt="Second slide">
                                        </picture>
                                    </div><!-- carousel-item-->
                                    <div class="carousel-item">
                                        <picture>
                                            <source media="(max-width: 768px)" srcset="build/imgs/houseinsideview2-432x239.png">
                                            <source media="(min-width: 1200px)" srcset="build/imgs/houseinsideview2-432x239.png">
                                            <img class="d-block w-100" src="build/imgs/houseinsideview2-432x239.png" alt="Third slide">
                                        </picture>
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
