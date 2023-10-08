<div class="mt-2"></div>
<table id="cartTableInLogin" class="table table-striped" style="table-layout: fixed !important; width:100%;">
    <thead>
        <tr>
            <!-- <th style="width: 50px !important; max-width:50px !important; ">Action </th> -->
            <th style="width: 215px !important; max-width:215px !important; ">Name</th>
            <th style="width: 140px !important; max-width:215px !important; ">Product Code</th>
            <th style="width: 120px !important; max-width:215px !important; ">BarCode</th>
            <th style="width: 120px !important; max-width:215px !important; ">Stock</th>
            <th style="width: 80px !important; max-width:150px !important; ">Quantity</th>
            <th style="width: 190px !important; max-width:150px !important; ">Price</th>
            <th style="width: 100px !important; max-width:150px !important; ">Sale</th>
            <th style="width: 150px !important; max-width:150px !important; ">Size</th>
            <th style="width: 150px !important; max-width:150px !important; ">Color</th>
        </tr>
    </thead>
    <tbody>
    <?php  
        $total = 0;
        $totalQuantity = 0;
        for ($i=0; $i < count($data); $i++) { 
            $itemName = $data[$i][4];         
            $quantity = $data[$i][2];
            $productCode = $data[$i][0];
            $size = $data[$i][1];
            $price = $data[$i][3];
            $attachmentName = $data[$i][5];
            $attachmentExt = $data[$i][6];
            $userId = $data[$i][7];
            $itemId = $data[$i][8];
            $color = $data[$i][9];
            $cartId = $data[$i][10];
            $number = $data[$i][11];
            $name = $data[$i][12];
            $newCollection = $data[$i][13];
            $barcode = $data[$i][14];
            $sale = $data[$i][15];
            $price = $price * $quantity;
            $price = round($price,2);
            $total = $total + $price;
            $OriginalPrice = $data[$i][16];
            $discountPercentage = $data[$i][17];
            $stockLeft = $data[$i][18];
            if($sale < 1 &&  doubleval($discountPercentage) < 1){
                $OriginalPrice = "";
            }else{
                $OriginalPrice = $OriginalPrice ." $ /";
            }
            $totalQuantity = $totalQuantity + $quantity;
            if ($quantity >0 ){
    ?>      

        
        <tr>
            <td style="padding-left:18px;" href="javascript:void(0);" userId= "<?php echo $userId ?>" itemId= "<?php echo $itemId ?>">
                <?= ucfirst($itemName); ?>
                <?php
                    if($newCollection == 1){
                ?>
                <a class="" title="new collection Items" href="javascript:void(0);" >
                    <i class="fas fa-star  mt-2 yellowForStar" style="padding-left:5px; padding-right:3px;  font-size:12pt; text-decoration:none !important"></i>
                </a>
                <?php
                    }
                ?>
                <img width="80" height="60" src="https://cotlinelb.com/assets/images/itemImages/<?php echo $attachmentName;?>.<?php echo $attachmentExt;?>" alt="NoImage" >
            </td>
            <td style="padding-left:18px;" href="javascript:void(0);" userId= "<?php echo $userId ?>" itemId= "<?php echo $itemId ?>"><?= ucfirst($productCode); ?></td>
            <td style="padding-left:18px;" href="javascript:void(0);" userId= "<?php echo $userId ?>" itemId= "<?php echo $itemId ?>"><?= ucfirst($barcode); ?></td>
            <td style="padding-left:18px;" href="javascript:void(0);" userId= "<?php echo $userId ?>" itemId= "<?php echo $itemId ?>"><?= $stockLeft . " Left"; ?></td>
            <td style="padding-left:18px;" href="javascript:void(0);" userId= "<?php echo $userId ?>" itemId= "<?php echo $itemId ?>"><?= ucfirst($quantity); ?></td>
            <td style="padding-left:18px;" href="javascript:void(0);" userId= "<?php echo $userId ?>" itemId= "<?php echo $itemId ?>"><?=  $OriginalPrice  . $price; ?></td>
            <td style="padding-left:18px;" href="javascript:void(0);" userId= "<?php echo $userId ?>" itemId= "<?php echo $itemId ?>"><?= ucfirst($sale); ?> %</td>
            <td style="padding-left:18px;" href="javascript:void(0);" userId= "<?php echo $userId ?>" itemId= "<?php echo $itemId ?>"><?= ucfirst($size); ?></td>
            <td style="padding-left:18px;" href="javascript:void(0);" userId= "<?php echo $userId ?>" itemId= "<?php echo $itemId ?>"><?= ucfirst($color); ?></td>
        </tr>
    <?php
            }
        }
    ?>
    </tbody>
    <tbody>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        
    </tr>


        
    </tbody>
    <tfoot>
           <tr>
            <td style="padding-left:18px;" href="javascript:void(0);">
                <b>Client Name</b>:
            </td>
            <td style="padding-left:18px;" href="javascript:void(0);">
            <?php echo $data[0][12]; ?>
            </td>
            <td style="padding-left:18px;" href="javascript:void(0);">
                <b>Total Quantity: </b><?php echo $totalQuantity; ?>
            </td>
            <td style="padding-left:18px;" href="javascript:void(0);">
                <b>Client Number: </b> <?php echo $data[0][11]; ?>

            </td>
            <!-- <td style="padding-left:18px;" href="javascript:void(0);">
                <b>Tracking Number:</b>
            </td>
            <td style="padding-left:18px;" href="javascript:void(0);">
                <?php echo $trackingNumber; ?>
            </td> -->
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            </td>
            <td>
            </td>
            <td>
        </tr>
    </tfoot>
</table>


  