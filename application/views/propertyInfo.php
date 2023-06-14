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
    if($propertyFullInfo->saleOrRent == "sale"){
        $saleOrRent ="For Sale";
    }elseif ($propertyFullInfo->saleOrRent == "rent") {
        $saleOrRent ="For Rent";

    }
    $enteredDate= $propertyFullInfo->enteredDate;   
    $date = date('Y-m-d');        
    // Start date
    $date1 = $enteredDate;
    // End date
    $date2 = $date;
    $diff = strtotime($date2) - strtotime($date1);
    $dateDiff = abs(round($diff / 86400));
?>


<div class="container"> 
    <div class="row">
        <div class="col-xl-12">
            <img style="width:100%; height:350px;" src="<?php echo base_url();?>assets/images/squareImageOne.png">
        </div>
    </div>
    <div class="row mt-2" >
        <!-- --------------------------------------- -->    
        <div class="col-xl-9">
            <div class="row">
                <div class="col-xl-5">
                    <h5  style="color: #055E20; margin-top:10px;"> <?= $propertyFullInfo->title ;?></h5>
                </div>
                <div class="col-xl-3">
                    <p style="margin-top: 5px; border: solid 1px; font-size: 16px; padding: 3px; text-align:center; color:#0074db;">
                        <?= $saleOrRent;?>
                    </p>
                </div>
                <div class="col-xl-4">
                    <p style=" text-align:center; margin-top:11px;">
                        <i style="font-size:16px; color:grey;" class="fas fa-calendar-alt" aria-hidden="true"></i> <?= $dateDiff ?> Day(s) on 961lb.com 
                    </p> 
                </div>
            </div>

            <div id="generalInfoSection" style="border:solid 1px #055E20; padding:15px; margin-top:4px;">
                <div class="row">
                    <div class="col-xl-4">
                        <p style=""> 
                            <b>Price : </b> <?= $propertyFullInfo->price ;?> $
                        </p>
                    </div>
                    <div class="col-xl-4">
                        <p style=""> 
                            <b>Lot Size: </b> <?= $propertyFullInfo->lotSize ;?> 
                        </p>
                    </div>
                    <div class="col-xl-4">
                        <p style="">
                            <b>Year Built: </b> <?= $propertyFullInfo->yearBuilt ;?> 
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4">
                        <p style=""> 
                            <b>Address : </b> <?= $propertyFullInfo->address ;?> 
                        </p>
                    </div>
                    <div class="col-xl-4">
                        <p style="">
                            <b>Zip Code: </b> <?= $propertyFullInfo->zipCode ;?> 
                        </p>
                    </div>
                    <div class="col-xl-4">
                        <p style=""> 
                            <b>Number of bedrooms: </b> <?= $propertyFullInfo->numberOfBedrooms ;?> 
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <p style=""> 
                            <b>Description : </b> <?= $propertyFullInfo->description ;?> 
                        </p>
                    </div>
                </div>
            </div>
        <!-- ------------------ -->
        </div>


        <!-- --------------------------------------- -->
        <div class="col-xl-3">
            <div id="agentInfoSection" style="border:solid 1px #055E20; padding:15px; margin-top:6px;">
                <h5 style="color: #055E20; margin-top:10px; text-align:center;">Listing Provided By:</h5>
                <p style="text-transform: capitalize; margin-top:1.5rem;"> <b>Name: </b> <?= $propertyFullInfo->fname . " " . $propertyFullInfo->lname  ;?> </p>
                <p style="text-transform: capitalize;"> <b>Phone Number: </b> <?= $propertyFullInfo->phoneNumber ;?> </p>
                <p style=""> <b>Email Address: </b> <?= $propertyFullInfo->userEmail ;?> </p>
                <p style="text-transform: capitalize; line-height:24px;"> <b>Description: </b> <?= $propertyFullInfo->userDescription ;?> </p>
            </div>
        <!-- ------------------ -->
        </div>
    </div>


    
<!-- end container  -->
</div>

