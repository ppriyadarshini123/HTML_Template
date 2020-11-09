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
?>
</div><!--/topHeader-->
</header>
</div><!--/wrapper--> 
<main>
    <section class="mainBody">           
        <div class="contain">
            <section class="signinpage">                                  
                <div class="signin"><!--result product-->
                    <p class="headingCenter">Sign In</p>
                    <form method="post" action="#" class="fields">
                        <div class="alignSignIn">
                            <div class="alignView">                                    
                                <label for="email" class="spEmail">Email :</label> 
                                <input name="email" type="email" placeholder="john@johndoe.com" required id="email">
                            </div><!--/email-->
                            <div class="alignView">                                    
                                <label for="psw" class="spPsw">Password :</label> 
                                <input name="password" type="password" placeholder="" required id="psw">                                  
                            </div><!--/password-->                               
                            <div class="alignBtn">
                                <button type="submit" class="btnSubmit">Submit</button>
                            </div><!-- submit Button --> 
                        </div>  <!--/signin-->   
                    </form>
                </div>
            </section><!--/signinpage-->
        </div><!--/container-->
    </section><!--/ mainBody-->
</main>

<?php include("../includes/footer.php"); ?> 


<!--/ your JS here-->
<script src="<?php echo ROOT; ?>node_modules/jquery/dist/jquery.js"></script>
<script src="<?php echo ROOT; ?>node_modules/enquire.js/dist/enquire.min.js"></script>
<script src="<?php echo ROOT; ?>build/js/index.js"></script>

</body>
</html>
