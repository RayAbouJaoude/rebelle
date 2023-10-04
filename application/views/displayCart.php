<div class="container">
<div class="row" style="margin-right:0px !important;">
    <?php   
    $total=0.0;
    $totalToUseForSale = 0.0;
    $totalToUseForSaleUsd = 0.0;
    $totalUsd=0;
    $shipping = 4;
        for ($i=0; $i < count($itemsData) ; $i++) { 
            $idInCart = $itemsData[$i][8];         
            $itemName = $itemsData[$i][7];         
            $quantity =  $itemsData[$i][2];
            $barCode = $itemsData[$i][0];
            $size = $itemsData[$i][1];
            $price =  $itemsData[$i][4] * $currencyData[0];
            $attachmentName =  $itemsData[$i][5];
            $attachmentExt =  $itemsData[$i][6];
            $itemId = $itemsData[$i][3];
            $color = $itemsData[$i][9];
            $sale = $itemsData[$i][10];

            $finalPrice = $price -($price * $sale / 100);

            $priceUSD = $itemsData[$i][4];
            $rawPriceUSD = $itemsData[$i][4];
            $finalPriceUSD = $priceUSD -($priceUSD * $sale / 100);

            number_format($finalPrice ,1) ." ". $currencyData[1];
    ?>      
        <div class="col-xl-12 co-lg-12 col-md-12 col-sm-12 col-12 mt-2">
                
            <center >
                <!-- <?php if ($imageToDisplay == ""){ ?>
                    <img loading="lazy" class="itemImageDisplayed" src="<?php echo base_url()?>assets/images/itemImages/<?php echo $attachmentName;?>.<?php echo $attachmentExt;?>" alt="itemImages" >
                <?php } else { ?>
                    <?php echo $imageToDisplay; ?>
                <?php } ?> -->

                <div class="row">
                    <div class="col-xl-5 col-5">
                        <p style="" class=""><?php echo ucfirst($itemName) . " " .$size . "  " . $color;?> </p>
                    </div>
                    <div class="col-xl-3 col-3">
                        <p style="margin-bottom:5px;"> Quantity: </p>
                        <p> 
                            <i class="fas fa-minus-circle minusButtonInCart" idInCart="<?php echo $idInCart;?>" style="color:red; margin-right:3px; margin-left:2px; cursor:pointer; font-size:12pt; text-decoration:none !important"></i>
                            <span> <?php echo $quantity;?> </span>
                            <i class="fas fa-plus-circle plusButtonInCart" idInCart="<?php echo $idInCart;?>" style="color:#3498db; margin-left:3px; font-size:12pt; cursor:pointer;  text-decoration:none !important"></i>
                            <input type="hidden" value="<?php echo $finalPrice; ?>">
                        </p>
                    </div>
                    <div class="col-xl-3 col-3">
                        <?php 
                            if($sale < 0.1){
                        ?>   
                            <p> 
                                <b>
                                <?php
                                    echo  number_format($finalPrice * intval($quantity) , 1) ." ". $currencyData[1];
                                ?>
                                </b> 
                            </p>
                        <?php 
                            }else{
                        ?>
                            <p style="color:red; text-decoration: line-through;"> <b><?php echo number_format($price * intval($quantity)) ." ". $currencyData[1];?></b> </p>
                            <p> 
                                <b>
                            <?php
                                echo  number_format($finalPrice * intval($quantity),1) ." ". $currencyData[1];
                            ?>
                                </b> 
                            </p>
                        <?php
                            }
                        ?>
                    </div>
                    <div class="col-xl-1 col-1">
                        <i class="fa fa-times removeItemFromCartIcon" idInCart="<?php echo $idInCart;?>" title="Remove Item From Cart" style="float:right; color:red; cursor:pointer; font-size:15pt; text-decoration:none !important"></i> 
                    </div>
                </div>
                
        
                <hr style="margin-top:0px; margin-bottom:5px;">
            </center>
        </div>
    <?php
        $total = $total + ($finalPrice * intval($quantity));   
        $totalUsd = $totalUsd + ($finalPriceUSD * intval($quantity));     
        
        if($sale < 0.1 && intval($rawPriceUSD) > 10){
            $totalToUseForSaleUsd = $totalToUseForSaleUsd + (number_format($finalPriceUSD,1) * intval($quantity));
        }
    }
    $totalAndShipping = $total + $shipping;
    $total = number_format($total , 1);
    $totalToUse= $total;
    
    ?>
</div>

<center>
<div style="width:300px; border:solid 1px rgba(0,0,0,.3); margin-top:20px;">
    <div style="text-align:center; margin-top:10px;">
        <p style="letter-spacing:1px; margin-bottom:10px;"> <b>Order Summary:</b> </p>
        <p style="letter-spacing:1px; margin-bottom:10px;"> <b>SubTotal: <span id="totalInCartToUseInModal" totalUsd="<?php echo round($totalUsd,1); ?>" totalToUseForSale ="<?php echo $totalToUseForSale; ?>"  totalToUseForSaleUsd ="<?php echo $totalToUseForSaleUsd; ?>" totalToUse ="<?php echo $totalToUse; ?>" ><?php echo $total ;?></span><?php echo " ".$currencyData[1] ;?></b> </p>
        <p style="letter-spacing:1px; margin-bottom:10px;"> <b>Shipping: 4$</b> </p>
        <hr style=" margin-bottom:10px; margin-top:10px;">
        <p style="display:inline; letter-spacing:1px; margin-bottom:10px;">  <b>Total: <?php echo $totalAndShipping   ;?></span><?php echo " ".$currencyData[1] ;?></b> </p>
    </div>
    <div style="text-align:center; margin-top:10px;">
        <button style="display:inline; letter-spacing:1px;" id="purchaseButtonInCartSection" class ="btn btn-md greenButtonsCss ">Purchase Cart </button>
    </div>
    <div style="height:10px;"></div>
</div>
</center>
<div style="height:50px;">
</div>
</div>