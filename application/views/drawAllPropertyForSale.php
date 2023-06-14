
<?php
    for ($i=0; $i <count($propertyInfo); $i++) {
        
        $id= $propertyInfo[$i]->id;
        $title= $propertyInfo[$i]->title;
        $saleOrRent= $propertyInfo[$i]->saleOrRent;
        $price= $propertyInfo[$i]->price;
        $price = number_format($price);
        $lotSize= $propertyInfo[$i]->lotSize;
        $fname= $propertyInfo[$i]->fname;
        $lname= $propertyInfo[$i]->lname;
        $status= $propertyInfo[$i]->accepted;   
        $description= $propertyInfo[$i]->description;   
        $enteredDate= $propertyInfo[$i]->enteredDate;   
        $date = date('Y-m-d');        
        // Start date
        $date1 = $enteredDate;
        // End date
        $date2 = $date;
        $diff = strtotime($date2) - strtotime($date1);
        $dateDiff = abs(round($diff / 86400));
?>      

    <div class="row mt-3" style="margin-bottom:18px;">
        <div class="col-xl-4 openPropertyFullInfo" propertyId="<?php echo $id; ?>" >
            <img style="width:400px; height:300px;" src="<?php echo base_url();?>assets/images/squareImageOne.png">
        </div>
        <div class="col-xl-6" style="position:relative">
            <h6 style="color: #055E20; margin-top:10px;"><?= $title ?></h6>
            <div style="display:flex; margin-top:20px;">
                <p style="width:60%; "><b>Price:</b> <?= $price ?> $</p>  
                <p style="width:60%; text-align:right;"><i style="font-size:15px; color:grey;" class="fas fa-calendar-alt" aria-hidden="true"></i> <?= $dateDiff ?> Day(s) on 961lb.com </p> 
            </div>
            <p><b>Lot Size:</b> <?= $lotSize ?> Acre(s)</p>
            <p><b>Description:</b> <?= $description ?></p>
            <div style="position:absolute; bottom:10px; color: #055E20; text-transform:capitalize; "> ~<?= $fname . " " . $lname ?></div>
        </div>
        <div class="col-xl-2 " style="border:solid 1px grey;">
            <h6 style="color: #055E20; margin-top:10px; text-align:center;">Amenities </h6>
            <p style="margin-top:20px;"> <i style="padding-right: 5px;" class="fas fa-check greenColor"></i> Private Pool </p>
            <p><i style="padding-right: 5px;" class="fas fa-check greenColor"></i> Area Pool </p>
          

        </div>
    </div>


    <hr style="background:#055E20; margin-left:15px;">
<?php
    }
?>      