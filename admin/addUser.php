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
                <h2 class="sectionTitle"></h2>
                <form method="post" action="#" class="fields">
                    <div class="headingCenter">
                        <h1>Add/Edit User</h1>
                    </div><!--align heading-->
                    <div class="form">
                        <div class="editAddHouseAlign">                       
                            <div class="align">
                                <label for="uRole">Role:</label>
                                <input list="roles" name="role">
                                <datalist id="roles">
                                </datalist>
                            </div><!--align role-->
                            <div class="align">
                                <label for="uEmail">Email :</label>
                                <input class="formField" type="text" id="uEmail" name="uEmail" value="">
                            </div><!--align email address-->  
                            <div class="align">
                                <label for="uPsw">Password :</label>
                                <input class="formField" type="text" id="uPsw" name="uPsw" value="">
                            </div><!--align password--> 
                            <div class="align">
                                <label for="uHouseAssigned">House Assigned :</label>
                                <input list="houses" name="house">
                                <datalist id="houses">
                                </datalist>
                            </div><!--align password--> 
                            <div class="align">
                                <label for="uName">Name :</label>
                                <input class="formField" type="text" id="uName" name="uName" value="">
                            </div><!--align name--> 
                            <div class="align">
                                <label for="uPhoneNumber">Phone Number :</label>
                                <input class="formField" type="text" id="uPhoneNumber" name="uPhoneNumber" value="">                                
                            </div><!--/align phone number-->                       
                            <div class="alignBtn">
                                <button type="submit" class="btnSubmit">Submit</button>                                
                            </div><!--/align submit--> 
                        </div><!--/editAddHousealign-->
                    </div><!--/form-->
                </form><!--/editAddHouse-->
            </section><!--/editAddHouse-->
        </div><!--/container-->   
    </section><!--/ mainBody-->
</main>
<?php include("../includes/footer.php"); ?> 

<script src="<?php echo ROOT; ?>node_modules/jquery/dist/jquery.js"></script>
<script src="<?php echo ROOT; ?>node_modules/enquire.js/dist/enquire.min.js"></script>
<script src="<?php echo ROOT; ?>build/js/index.js"></script>
<!--/ your JS here-->
</body>
</html>
