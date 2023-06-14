
<div class="row ml-2 mr-2" style="height:600px; overflow-y:scroll;">
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

        <div class="col-xl-6 col-12 openPropertyFullInfo propertyOnHover" propertyId="<?php echo $id; ?>" style="" >
            <img style="width:100%; margin-top:10px;" src="<?php echo base_url();?>assets/images/squareImageOne.png">
            <div class="ml-2">
                <h6 style="color: #055E20; margin-top:10px;"><?= $title ?></h6>
                <p style=""><b>Price:</b> <?= $price ?> $</p>  
                <p style=""><i style="font-size:15px; color:grey;" class="fas fa-calendar-alt" aria-hidden="true"></i> <?= $dateDiff ?> Day(s) on 961lb.com </p> 
                <p><b>Lot Size:</b> <?= $lotSize ?> Acre(s)</p>
                <div style="color: #055E20; text-transform:capitalize; padding-bottom:7px;"> ~<?= $fname . " " . $lname ?></div>
            </div>
        </div>
    
        <?php
    }
?>      

</div>