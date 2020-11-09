<?php
/**
 *
 * PHP course project
 * url: /signin.php
 */
include("../includes/utilities.php");

//   THIS IS THE BEGINNING OF THE MARKUP
include("../includes/top.php");
include("../includes/header.php");
include("../includes/bottomNav.php");
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
                    <div class="form">
                        <div class="align">
                            <div>
                                <label for="hPostcode">Postcode</label>
                            </div><!--label postcode-->
                            <div>
                                <input class="formField" type="text" id="hPostcode" name="hPostcode" value="">
                            </div><!--input postcode-->
                        </div><!--align postcode-->
                        <div class="align">
                            <div>
                                <label for="hHouseNumber">House Number</label>
                            </div><!-- label house number -->
                            <div>
                                <input class="formField" type="text" id="hHouseNumber" name="hHouseNumber" value="">
                            </div><!--input housenumber-->
                        </div><!--align house number-->                       
                        <div class="align">
                            <div>
                                <label for="hCity">City</label>
                            </div><!-- label city -->
                            <div>
                                <input class="formField" type="text" id="hCity" name="hCity" value="">
                            </div><!-- input city -->
                        </div><!-- align city -->
                        <div class="align">
                            <div>
                                <label for="hPropertyDealer">Property Dealer</label>
                            </div><!-- label propertydealer -->
                            <div>
                                <input list="hPropertyDealer" name="propertydealer">
                                <datalist id="hPropertyDealer">
                                </datalist>   
                            </div><!-- input propertydealer -->
                        </div><!--/align-->
                        <div class="align">
                            <div>
                                <label for="hImage">Picture</label>
                            </div><!-- label picture -->
                            <div class="fileUpload">
                                <div class="fileUploadBlock">
                                    <div class="flexCont">
                                        <label for="hImage" class="">Choose File</label>
                                        <p>
                                            <span class="formField uploadFileSpan" id="uploadPic">No file selected</span>
                                        </p>
                                    </div><!--flexCont-->
                                    <input class="hiddenFileUpload" type="file" id="pImage" name="pImage">
                                </div><!--/fileUploadBlock-->
                            </div><!-- file upload -->
                        </div><!--align picture-->
                        <div class="alignBtn">
                            <button type="submit" name="submit" class="btnSubmit">Submit</button>                              
                        </div><!-- alignBtn -->
                    </div>
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
