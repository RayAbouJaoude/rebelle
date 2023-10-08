<table id="itemsTable" class="table table-striped" style="table-layout: fixed !important; width:100%;">
    <thead>
        <tr>
            <th style="width: 90px !important; max-width:90px !important; ">Action </th>
            <th style="width: 215px !important; max-width:215px !important; ">Name</th>
            <th style="width: 100px !important; max-width:100px !important; ">Product Code</th>
            <!-- <th style="width: 100px !important; max-width:100px !important; ">BarCode</th> -->
            <th style="width: 100px !important; max-width:100px !important; ">Quantity</th>
            <th style="width: 100px !important; max-width:150px !important; ">Size</th>
            <th style="width: 150px !important; max-width:150px !important; ">Color</th>
            <?php
                if (isset($_SESSION["userType"]) && $_SESSION["userType"] == 1) {
            ?>
            <!-- <th style="width: 150px !important; max-width:150px !important; ">Cost</th> -->
            <?php
            }
                
                if($checkBoxForDescription == "on"){
            ?>
            <th style="width: 150px !important; max-width:150px !important; ">description</th>
            <?php
                }
            ?>

            <th style="width: 150px !important; max-width:150px !important; ">Price</th>
            <!-- <th style="width: 215px !important; max-width:150px !important; ">Supplier</th> -->
        </tr>
    </thead>
    <tbody>
    <?php
    $totalItems= 0;
    $totalCost= 0;
    $totalPrice= 0;
        foreach ($itemsData as $data) {   
            $itemId = $data->id;         
            $itemName = $data->itemName;
            $size = $data->size;
            $quantity = $data->quantity;
            $barCode = $data->barCode;
            $supplier = $data->supplier;
            $cost = $data->cost;
            $price = $data->price;
            $price = round(floatval($price), 2);
            $cost = round(floatval($cost), 2);

            $summerCollection = $data->summerCollection;
            $winterCollection = $data->winterCollection;

            $color = $data->color;
            $description = $data->itemDescription;
            $gender = $data->gender;
            $categoryItems = $data->categoryItems;
            $weight = $data->weight;
            $archive = $data->archive;
            $exported = $data->exported;
            $newCollection = $data->newCollection;
            $barCodeToPrint = $data->barCodeToPrint;
            $totalItems = $totalItems + $quantity;
            $totalCost = $totalCost + ($cost * $quantity);
            $totalPrice = $totalPrice + ($price * $quantity);
            $attachmentName = $data->imageId;
            $attachmentExt = $data->imageExt;
            
    ?>      
        <tr>
            <td> 
                <center>
                    <input type="checkbox" dataId= "<?php echo $itemId ?>" class="itemCheckBox">

                    <!-- <a class="printItems" title="Print Items" href="javascript:void(0);" data-itemId ="<?php echo $itemId ?>">
                        <i class="fas fa-print" style="color:#3498db; padding-right:2.5px; font-size:12pt; vertical-align: text-bottom; text-decoration:none !important"></i>
                    </a> -->
                    
                    <!-- <a class="deleteItems" title="Delete Items" href="javascript:void(0);" data-itemId ="<?php echo $itemId ?>">
                        <i class ="fa fa-trash" style="color:#ef6b6b; font-size:11pt; padding-left:2.5px; text-decoration:none !important"></i>
                    </a> -->
                   
                    <a class="addItems" title="Add Item" href="javascript:void(0);" data-itemId ="<?php echo $itemId ?>" barCode= "<?php echo $barCode ?>" itemName= "<?php echo $itemName ?>" cost= "<?php echo $cost ?>" price= "<?php echo $price ?>"
                     supplier= "<?php echo $supplier ?>" weight= "<?php echo $weight ?>" description= "<?php echo $description ?>" categoryItems= "<?php echo $categoryItems ?>" gender= "<?php echo $gender ?>">
                        <i class ="fa fa-plus-circle" style="color:#0193f5; font-size:11pt; padding-left:2.5px; text-decoration:none !important"></i>
                    </a>

                    <?php
                        if($archive == 1){
                    ?>
                            <a class="archiveItem " title="Archive Items" href="javascript:void(0);" data-itemId ="<?php echo $itemId ?>">
                                <i class="fas fa-archive darkGreen" style="padding-left:5px; padding-right:3px;  font-size:11pt; text-decoration:none !important"></i>
                            </a>
                    <?php   
                        }else{
                    ?>
                            <a class="archiveItem" title="Archive Items" href="javascript:void(0);" data-itemId ="<?php echo $itemId ?>">
                                <i class="fas fa-archive" style="padding-left:5px; padding-right:3px; color:#CCC; font-size:11pt; text-decoration:none !important"></i>
                            </a>
                    <?php } ?>

                    <?php
                        if($exported == 1){
                    ?>
                            <a class="exportedItem" title="exported Items" href="javascript:void(0);" data-itemId ="<?php echo $itemId ?>">
                                <i class="fas fa-plane  mt-2 blueColorForPlane" style="padding-left:0px; padding-right:3px;  font-size:12pt; text-decoration:none !important"></i>
                            </a>
                    <?php   
                        }else{
                    ?>
                            <a class="exportedItem " title="exported Items" href="javascript:void(0);" data-itemId ="<?php echo $itemId ?>">
                                <i class="fas fa-plane mt-2" style="padding-left:0px; padding-right:3px; color:#CCC; font-size:12pt; text-decoration:none !important"></i>
                            </a>
                    <?php } ?>

                    <?php
                        if($newCollection == 1){
                    ?>
                            <a class="newCollectionItem" title="new collection Items" href="javascript:void(0);" data-itemId ="<?php echo $barCode ?>">
                                <i class="fas fa-star  mt-2 yellowForStar" style="padding-left:5px; padding-right:3px;  font-size:12pt; text-decoration:none !important"></i>
                            </a>
                    <?php   
                        }else{
                    ?>
                            <a class="newCollectionItem" title="new collection Items" href="javascript:void(0);" data-itemId ="<?php echo $barCode ?>">
                                <i class="fas fa-star mt-2" style="padding-left:5px; padding-right:3px; color:#CCC; font-size:12pt; text-decoration:none !important"></i>
                            </a>
                    <?php } ?>

                    <!-- <?php
                        if($winterCollection == 1){
                    ?>
                            <a class="winterCollection" title="add item to winter collection" href="javascript:void(0);" data-itemId ="<?php echo $barCode ?>">
                                <i class="far fa-snowflake blueColorForPlane"  style="padding-left:5px; padding-right:3px;  font-size:12pt; text-decoration:none !important"></i>
                            </a>
                    <?php   
                        }else{
                    ?>
                            <a class="winterCollection " title="add item to winter collection" href="javascript:void(0);" data-itemId ="<?php echo $barCode ?>">
                                <i class="far fa-snowflake "  style="padding-left:5px; padding-right:3px; color:#CCC; font-size:12pt; text-decoration:none !important"></i>
                            </a>
                    <?php } ?>

                    <?php
                        if($summerCollection == 1){
                    ?>
                            <a class="summerCollection" title="add item to summer collection." href="javascript:void(0);" data-itemId ="<?php echo $barCode ?>">
                                <i class="fas fa-umbrella-beach  orangeColorForBeach" style="padding-left:5px; padding-right:3px;  font-size:12pt; text-decoration:none !important"></i>
                            </a>
                    <?php   
                        }else{
                    ?>
                            <a class="summerCollection " title="add item to summer collection." href="javascript:void(0);" data-itemId ="<?php echo $barCode ?>">
                                <i class="fas fa-umbrella-beach" style="padding-left:5px; padding-right:3px; color:#CCC; font-size:12pt; text-decoration:none !important"></i>
                            </a>
                    <?php } ?>
                     -->

                   
                            <!-- <a class="getItemLink" title="Get Item Link" href="javascript:void(0);" data-itemId ="<?php echo $itemId ?>" barCode= "<?php echo $barCode ?>" itemName= "<?php echo $itemName ?>" cost= "<?php echo $cost ?>" price= "<?php echo $price ?>"
                            supplier= "<?php echo $supplier ?>" weight= "<?php echo $weight ?>" description= "<?php echo $description ?>" categoryItems= "<?php echo $categoryItems ?>" gender= "<?php echo $gender ?>">
                                <i class ="fas fa-link" style="color:#0193f5; font-size:11pt; padding-left:2.5px; text-decoration:none !important"></i>
                            </a> -->
                </center>
            </td>
            <td class="displayItemsToEdit" style="padding-left:18px; cursor:pointer;" href="javascript:void(0);" itemId="<?php echo $itemId ?>" barCode= "<?php echo $barCode ?>">
                <p><?= ucfirst($itemName); ?></p>
            </td>
            <td class="displayItemsToEdit" style="padding-left:18px; cursor:pointer;" href="javascript:void(0);" itemId="<?php echo $itemId ?>" barCode= "<?php echo $barCode ?>"><?= ucfirst($barCode); ?></td>
            <!-- <td class="displayItemsToEdit" style="padding-left:18px; cursor:pointer;" href="javascript:void(0);" itemId="<?php echo $itemId ?>" barCode= "<?php echo $barCode ?>"><?= ucfirst($barCodeToPrint); ?></td> -->
            <td class="displayItemsToEdit getQuantityInViewItem" style="padding-left:18px; cursor:pointer;" href="javascript:void(0);" itemId="<?php echo $itemId ?>" quantityData = "<?= $quantity; ?>" barCode= "<?php echo $barCode ?>"><?= $quantity; ?></td>
            <td class="displayItemsToEdit" style="padding-left:18px; cursor:pointer;" href="javascript:void(0);" itemId="<?php echo $itemId ?>" barCode= "<?php echo $barCode ?>"><?= ucfirst($size); ?></td>
            <td class="displayItemsToEdit" style="padding-left:18px; cursor:pointer;" href="javascript:void(0);" itemId="<?php echo $itemId ?>" barCode= "<?php echo $barCode ?>"><?= ucfirst($color); ?></td>
            <?php
                if (isset($_SESSION["userType"]) && $_SESSION["userType"] == 1) {
            ?>
            <!-- <td class="displayItemsToEdit getCostInViewItem" style="padding-left:18px; cursor:pointer;" href="javascript:void(0);" itemId="<?php echo $itemId ?>" costData = "<?= $cost * $quantity; ?>"  barCode= "<?php echo $barCode ?>"><?= $cost; ?></td> -->
            <?php
                }
            ?>
            <?php
                if (isset($checkBoxForDescription) && $checkBoxForDescription  == "on") {
            ?>
            <td class="displayItemsToEdit " style="padding-left:18px; cursor:pointer;" href="javascript:void(0);" itemId="<?php echo $itemId ?>"  barCode= "<?php echo $barCode ?>"><?= $description; ?></td>
            <?php
                }
            ?>
            <td class="displayItemsToEdit getPriceInViewItem" style="padding-left:18px; cursor:pointer;" href="javascript:void(0);" itemId="<?php echo $itemId ?>" priceData = "<?= $price * $quantity; ?>" barCode= "<?php echo $barCode ?>"><?= $price; ?></td>
            <!-- <td class="displayItemsToEdit" style="padding-left:18px; cursor:pointer;" href="javascript:void(0);" itemId="<?php echo $itemId ?>" barCode= "<?php echo $barCode ?>"><?= ucfirst($supplier); ?></td> -->
        </tr>
    <?php
            $oldBarCode = $barCode;
        }
    ?>
    </tbody>
    <tfoot>
        <tr>
            <td> </td>
            <td> </td>
            <!-- <td> </td> -->
            <td> </td>
            <td> </td>            
            <td>Total Items = <span id="totalItemsInMainTable"> <?= $totalItems; ?> </span></td>  
            <?php
                if (isset($_SESSION["userType"]) && $_SESSION["userType"] == 1) {
            ?>          
            <!-- <td>Total Cost = <span id="totalCostInMainTable"><?= number_format($totalCost); ?> </span> USD</td>        -->
            <?php
                }
            ?>    
            <?php
                if (isset($checkBoxForDescription) && $checkBoxForDescription  == "on") {
            ?>          
                <td> </td>            
            <?php
                }
            ?>    
            <td>Total Price = <span id="totalPriceInMainTable"><?= number_format($totalPrice); ?> </span> USD</td>            
        </tr>
    </tfoot>
</table>