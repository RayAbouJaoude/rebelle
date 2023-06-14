<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    if(isset($_SESSION["userFname"]) && !empty($_SESSION["userFname"])){
        $userFname = $_SESSION["userFname"];
    }else{
        $userFname = "";

    }
    if(isset($_SESSION["userLname"]) && !empty($_SESSION["userLname"])){
        $userLname = $_SESSION["userLname"];
    }else{
        $userLname = "";

    }
?>

<div id="forRentFirstSection">
    <div class="layer">
        <div class="container">
            <div class="row">
                <div class="col-xl-12" style="text-align:center;">
                    <h2 style="color:white; margin-top:73px;">Rent search for homes & apartments</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container" style="margin-top:10px;"> 
    <div id="propertyForRentContainer">
    </div>

<!-- end container  -->
</div>

