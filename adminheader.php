<?php
   session_start();
   include_once "./config/dbconnect.php";

?> 
       
 <!-- nav -->
 <nav  class="navbar navbar-expand-lg navbar-light px-5" style="background-color: #70CAB0;">
    
    <a class="navbar-brand ml-5" href="./admin_index.php">
        <img src="./images/logo.png" width="80" height="80" alt="Swiss Collection">
    </a>
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0"></ul>
    
    <div class="user-cart">  
          <a href="./admin_index.php" style="text-decoration:none;">
            <i class="fa fa-user mr-5" style="font-size:30px; color:#fff;" aria-hidden="true"></i>
         </a>

            <a href="./logout.php" style="text-decoration:none;">
                    <i class="fa fa-sign-in mr-5" style="font-size:30px; color:#fff;" aria-hidden="true"></i>
            </a>

    
    </div>  
</nav>
