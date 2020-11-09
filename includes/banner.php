<?php
/**
 *
 * PHP course project
 * url: /includes/banner.php
 */
?>
<div class="banner">     
    <div class="containerSearchPanel">  
        <h1 class="mainName">Search</h1>
        <div class="redDash"></div><!-- redDash -->
        <form method="post" action="#" class="fields">
            <div class="centerAlign">
                <div class="alignView">
                    <label for="ddSaleRent" class="spSaleRent">Sale/Rent :</label>   
                    <select id="ddSaleRent" title="ddSaleRent" name="dropdown" class="ddSaleRent">
                        <option value="sale">For Sale</option>
                        <option value="rent">For Rent</option>
                    </select>             
                </div>  <!-- saleRent -->
                <div class="alignView">
                    <label for="citypostcode" class="spPostcode">Postcode :</label>                             
                    <input name="cityPostcode" title = "postcode" type="text" id="citypostcode" class="fields" placeholder="City/Postcode" required>
                </div><!-- City/Postcode -->
                <div class="alignView">                
                    <label for="min" class="spMin">Min :</label>
                    <input name="min" type="number" placeholder="0" required step="100" id="min">
                </div><!-- Min -->
                <div class="alignView">
                    <label for="max" class="spMax">Max :</label>
                    <input name="max" type="number" placeholder="450k" required step="100" id="max">
                </div><!-- Max -->   
                <div class="indexSubmit">
                    <button type="button" class="btnSubmit">Submit</button>
                </div><!-- submit Button -->
            </div><!--/centerAlign-->
        </form>
    </div><!--/container-->
</div><!--/banner-->
