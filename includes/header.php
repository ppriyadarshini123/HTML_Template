<?php
/**
 *
 * PHP course project
 * url: /includes/header.php
 */
?>
 <body>
        <div class="wrapper">
            <header>
                <div class="topHeader">                    
                    <div>
                        <span class="hamburger" id="openNav">&#9776;</span>
                    </div><!--Hamburger Icon-->
                    <div class="identity">
                        <a  href="<?php echo ROOT;?>index.php">
                            <picture>
                                <source media="(max-width: 768px)" srcset="<?php echo ROOT;?>build/imgs/HomeSearch_logo_1-218x139.png">
                                <source media="(min-width: 1200px)" srcset="<?php echo ROOT;?>build/imgs/HomeSearch_logo_1-218x139.png">
                                <img class="logo" src="<?php echo ROOT;?>build/imgs/HomeSearch_logo_1-218x139.png" alt="logo">
                            </picture>
                        </a>
                    </div><!--/identity-->
                    <nav class="topNav">
                        <ul>
                            <li class="homeBorder"><a  href="<?php echo ROOT;?>index.php">Home</a></li> <!-- class="currentPageLink" -->
                            <li><a href="<?php echo ROOT;?>admin/signin.php">Sign In</a></li>                
                        </ul>
                    </nav><!--/topNav-->
       

