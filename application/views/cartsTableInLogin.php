<table id="cartsTable" class="table table-striped" style="table-layout: fixed !important; width:100%;">
    <thead>
        <tr>
            <th style="width: 5% !important; ">Action </th>
            <th style="width: 26%!important; ">Name</th>
            <th style="width: 31% !important; ">Address</th>
            <th style="width: 13% !important; ">Number</th>
            <th style="width: 10% !important; ">Date</th>
            <th style="width: 5% !important; ">Total</th>
            <!-- <th style="width: 50px !important; ">Type</th> -->
            <th style="width: 10% !important; ">discount</th>
            <!-- <th style="width: 12% !important; " title="Top Speed tracking number.">TSpeed Traking N</th> -->
        </tr>
    </thead>
    <tbody>
    <?php
        $totalPriceUSD= 0;
        $totalPriceLBP= 0;  
        foreach ($cartData as $data) {   
            $cartId = $data->id;         
            $name = $data->name;
            $promoCode = $data->promoCode;
            $employeeCode = $data->employeeCode;
            $address = $data->address;
            $number = $data->number;
            $date = $data->date;
            $pending = $data->pending;
            $currency = $data->currency;
            $totalAmount = doubleval($data->totalAmount);
            $totalAmountWithoutFormat =doubleval( $data->totalAmount);
            $note = $data->note;
            $restockedItem = $data->restockedItem;
            $discount = $data->discountPercentage;
            if(is_numeric($totalAmount)){
            }else{
                $totalAmount = 0;
            }
            $totalClass = "";
            $type = $data->cartNature;
            $topSpeedTrackingNumber = $data->topSpeedTrackingNumber;
            $topSpeed = intval($data->topspeed);
            $messaged = intval($data->messaged);
            if($currency == 1){
                $currency ="USD";
                $totalAmount = round($totalAmount);
                $totalPriceUSD= $totalPriceUSD + $totalAmount;
                $totalClass = "totalUsdClass";
                
            }else{
                $currency= "LBP";
                if(doubleval($totalAmount) != 0){
                    $totalPriceLBP= $totalPriceLBP + $totalAmount;  
                    $totalClass = "totalLbpClass";
                }
            }
            $totalAmount =number_format($totalAmount ,0);
            $userId = $data->userId;
            $octopus = $data->octopus;
            $trackingNumber = $data->trackingNumber;
            $isSubmitted =  $data->submittedOrNot;
            $collected = $data->collected;
            
    ?>      
        <tr>
            <td> 
                <center>
                <?php
                    if (isset($_SESSION["userType"]) && $_SESSION["userType"] == 1) {
                ?>    
                    <a class="deleteCartInLogin" title="Delete Cart" href="javascript:void(0);"  cartId ="<?php echo $cartId ?>">
                        <i class ="fa fa-trash" style="color:#ef6b6b; font-size:11pt; padding-left:2.5px; margin-right:5px; text-decoration:none !important"></i>
                    </a>
                <?php 
                    }
                ?>

                <?php 
                    if($note != ""){
                ?>
                    <i class="fas fa-sticky-note" style="color: #fb9109;" title = "<?php echo $note;?>"></i>
                <?php
                    }
                ?>
               
                <!-- <a class="" title="Octopus Delivery" href="javascript:void(0);"  cartId ="<?php echo $cartId ?>">
                    <i class="fab fa-octopus-deploy" style="color: #CCC; font-size:11pt; padding-left:2.5px; text-decoration:none !important"></i>
                </a> -->
        <?php
                if($topSpeed == 1){
        ?>
                    <a class="topSpeedInCartInLogin" title="Top Speed Delivery" href="javascript:void(0);"  cartId ="<?php echo $cartId ?>">
                        <i class="fas fa-tachometer-alt limegreen" style="font-size:11pt; padding-left:2.5px; text-decoration:none !important"></i>
                    </a>
        <?php
                }else{
        ?>
                    <a class="topSpeedInCartInLogin" title="Top Speed Delivery" href="javascript:void(0);"  cartId ="<?php echo $cartId ?>">
                        <i class="fas fa-tachometer-alt" style="color: #CCC; font-size:11pt; padding-left:2.5px; text-decoration:none !important"></i>
                    </a>
        <?php   
                } 
        ?>
        <?php
                if($messaged == 1){
        ?>
                <!-- <a class=" messagedInCartInLogin" title="Messaged Or Not" href="javascript:void(0);"  cartId ="<?php echo $cartId ?>">
                    <i class="far fa-comments limegreen" style=" font-size:11pt; padding-left:2.5px; text-decoration:none !important"></i>
                </a> -->
        <?php
            }else{
        ?>
                 <!-- <a class=" messagedInCartInLogin" title="Messaged Or Not" href="javascript:void(0);"  cartId ="<?php echo $cartId ?>">
                    <i class="far fa-comments" style="color: #CCC; font-size:11pt; padding-left:2.5px; text-decoration:none !important"></i>
                </a> -->
        <?php   
            } 
        ?>
   

    <?php
            if($pending == 1){
    ?>
                    <a class="pendingInCartInLogin"  title="pending cart" href="javascript:void(0);" userId= "<?php echo $userId ?>" cartId ="<?php echo $cartId ?>">
                        <i class ="fas fa-pause-circle limegreen" style="padding-left:5px; font-size:11pt; text-decoration:none !important"></i>
                    </a>
                   
    <?php
            }else{
    ?>
                    <a class="pendingInCartInLogin" title="pending cart" href="javascript:void(0);" userId= "<?php echo $userId ?>" cartId ="<?php echo $cartId ?>">
                        <i class ="fas fa-pause-circle" style="padding-left:5px; color:#CCC; font-size:11pt; text-decoration:none !important"></i>
                    </a>
    <?php } ?>
               
            

                </center>
            </td>
            <td class="displayCarts makeEllipsis" style="padding-left:18px; cursor:pointer;" href="javascript:void(0);" userId= "<?php echo $userId ?>" cartId= "<?php echo $cartId ?>" title="<?= ucfirst($name); ?>"><?= ucfirst($name); ?></td>
            <td class="displayCarts makeEllipsis" style="padding-left:18px; cursor:pointer;" href="javascript:void(0);" userId= "<?php echo $userId ?>" cartId= "<?php echo $cartId ?>" title="<?= ucfirst($address); ?>"><?= ucfirst($address); ?></td>
            <td class="displayCarts makeEllipsis" style="padding-left:18px; cursor:pointer;" href="javascript:void(0);" userId= "<?php echo $userId ?>" cartId= "<?php echo $cartId ?>" title="<?= ucfirst($number); ?>">
                <?= ucfirst($number); ?>
                <a href="https://api.whatsapp.com/send/?phone=961<?= ucfirst($number); ?>&text&app_absent=0" target="_blank" style="vertical-align: sub; font-size:22px; margin-left:5px; ">
                    <i class="fab fa-whatsapp" style="color:limegreen !important;"></i>
                </a>
            </td>
            <td class="displayCarts makeEllipsis" style="padding-left:18px; cursor:pointer;" href="javascript:void(0);" userId= "<?php echo $userId ?>" cartId= "<?php echo $cartId ?>" title=""><?= ucfirst($date); ?></td>
            <td class="displayCarts makeEllipsis <?php echo $totalClass ?> " style="padding-left:18px; cursor:pointer;"
                href="javascript:void(0);" userId= "<?php echo $userId ?>" dataAmount = "<?= $totalAmountWithoutFormat; ?>"
                cartId= "<?php echo $cartId ?>" title="<?= $totalAmount  ?>">
                <?= $totalAmount; ?>
            </td>
            <!-- <td class="displayCarts makeEllipsis" style="padding-left:18px; cursor:pointer;" href="javascript:void(0);" userId= "<?php echo $userId ?>" cartId= "<?php echo $cartId ?>" title="<?= ucfirst($type); ?>"><?= ucfirst($type); ?></td> -->
            <td class="displayCarts makeEllipsis" style="padding-left:18px; cursor:pointer;" href="javascript:void(0);" userId= "<?php echo $userId ?>" cartId= "<?php echo $cartId ?>" title="<?= ucfirst($discount); ?>"><?= ucfirst($discount); ?></td>
            <!-- <td class=" makeEllipsis" style="padding-left:18px; cursor:pointer;" href="javascript:void(0);" userId= "<?php echo $userId ?>" cartId= "<?php echo $cartId ?>" title="<?= ucfirst($trackingNumber); ?>">
    <?php
            if (isset($_SESSION["userType"]) && $_SESSION["userType"] == 1) {
            if($collected == 1){
    ?>
                    <a class="collectedInCartLogin " title="Collected Or Not" href="javascript:void(0);" userId= "<?php echo $userId ?>" cartId ="<?php echo $cartId ?>">
                        <i class="fas fa-hand-holding-usd purple" style="padding-left:5px; padding-right:3px;  font-size:11pt; text-decoration:none !important"></i>
                    </a>
    <?php
            }else{
    ?>
                    <a class="collectedInCartLogin" title="Collected Or Not" href="javascript:void(0);" userId= "<?php echo $userId ?>" cartId ="<?php echo $cartId ?>">
                        <i class="fas fa-hand-holding-usd" style="padding-left:5px; padding-right:3px; color:#CCC; font-size:11pt; text-decoration:none !important"></i>
                    </a>
    <?php   }} ?>
                <?= ucfirst($trackingNumber); ?>
            </td> -->
            <!-- <td class=" makeEllipsis" style="padding-left:18px; cursor:pointer;" href="javascript:void(0);" userId= "<?php echo $userId ?>" cartId= "<?php echo $cartId ?>" title="<?= ucfirst($topSpeedTrackingNumber); ?>"> -->
                
                <?php
                    if($restockedItem == 0 and $type == "replacement"){
                ?>
                    <!-- <a class="restockItems"  title="Restock Items" href="javascript:void(0);" userId= "<?php echo $userId ?>" cartId ="<?php echo $cartId ?>">
                        <i class ="fas fa-history limegreen" style="padding-left:7px; font-size:11pt; text-decoration:none !important"></i>
                    </a> -->
                <?php 
                    } 
                ?>

                <?= ucfirst($topSpeedTrackingNumber); ?>

            <!-- </td> -->
        </tr>
    <?php
        }
    ?>
    </tbody>

    <tfoot>
        <tr>
            <td> </td>
            <td> </td>
            <td> </td>
            <td> </td>
            <td>Total= <span id="totalLbpInCarts"><?= number_format($totalPriceLBP); ?> </span> USD</td>            
            <td>Total Carts= <span id="totalNumberOfCarts" > </span></td>            
            <td> </td>
            <!-- <td> </td> -->
            <!-- <td> </td> -->
        </tr>
    </tfoot>
</table>