
<div class="modal-header" style="display:block; ">
    <button type="button"   class="close closeModal"  data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <center>
        <h5 style="font-size:17px;" class=""> <?php echo $itemsData[0]->itemName; ?> (<?php echo $itemsData[0]->barCode;?>)</h5>
    </center>
</div>
<div class="modal-body" style="overflow-y: auto !important; height:100%;" >
    <center>

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
<?php
        for ($i=0; $i < count($images) ; $i++) {   
            if($i == 0){
?>
            <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i ?>" class="active"></li>
<?php
            }else{
?>
            <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i ?>" ></li>

<?php
            }
    }
?>
        </ol>
        <div class="carousel-inner">
<?php
        for ($i=0; $i < count($images) ; $i++) {   
            if($i == 0){
?>
            <div class="carousel-item active">
                <img class="d-block " style="width:450px; height:auto;" src="<?php echo base_url(); ?>assets/images/itemImages/<?php echo $images[$i]->id;?>.<?php echo $images[$i]->attachmentExt;?>" alt="First slide">
            </div>
<?php
            }else{
?>
            <div class="carousel-item ">
                <img class="d-block " style="width:450px; height:auto;" src="<?php echo base_url(); ?>assets/images/itemImages/<?php echo $images[$i]->id;?>.<?php echo $images[$i]->attachmentExt;?>" alt="First slide">
            </div>
<?php
            }
        }
?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</center>


    <div class="row">
        <?php 
            if($itemsData[0]->sale > 0){
        ?>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3 mt-2" style="">
            <label for="" style="margin-top:6px;"> Price:</label>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 mt-1" style="text-align:center; padding-top:3px;">
            <p id="" style="border: solid 1px #1a4345; margin-bottom: 0px; text-decoration: line-through;" name="" class="form-control form-control-sm" > 
                    <b>
                        <?php 
                            echo (round($itemsData[0]->price * $currencyData[0] ,1)) ." ". $currencyData[1];
                        ?> 
                    </b>
                </p>
        </div>

        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-5 mt-2" style="">
            <p  style="margin-top:6px;"> Per item </p>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2 mt-2" style="text-align:center;">
            <label for="" style="margin-top:6px;"> Sale:</label>
        </div>
        <?php 
            }else{
        ?>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3 mt-2" style="">
            <label for="" style="margin-top:6px;"> Price:</label>
        </div>
        <?php 
            }
        ?>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 mt-1" style="text-align:center; padding-top:3px;">
            <p id="itemPriceInModal" style="border: solid 1px #1a4345; margin-bottom: 0px;" name="itemPriceInModal" class="form-control form-control-sm" > 
                    <b>
                        <?php 
                            echo (round($itemsData[0]->price * $currencyData[0] - ($itemsData[0]->price * $currencyData[0] * $itemsData[0]->sale / 100),1)) ." ". $currencyData[1];
                        ?> 
                    </b>
                </p>
        </div>

        
        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-5 mt-2" style="">
            <button class ="btn btn-sm greenButtonsCss addToCartInModalButton" data-dismiss="modal" itemBarCode="<?php echo $itemsData[0]->barCode;?>"> Add To Cart </button>   
            <!-- <a href="https://api.whatsapp.com/send/?phone=96176433813&text&app_absent=0" target="_blank" style="vertical-align: sub; font-size:22px; margin-left:5px;">
                <i class="fab fa-whatsapp" style="color:limegreen !important;"></i>
            </a> -->
        </div> 
       

        <!-- START OF COLOR -->
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3 mt-2">
            <label style="width:95px;" for=""> Item Color:</label>
        </div>
        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9 mt-2">
            <div class="itemColorInModalMain">
                <?php
                    if(!empty($itemColor)){
                        for ($j=0; $j < count($itemColor) ; $j++) {  
                            if ($j % 3 == 0 && $j!= 0){
                                echo "<div style='height:10px;'></div>";
                            }
                            if($j == 0){
                ?>
                        <span class="form-control form-control-sm itemColorInModal itemColorSelected" barCode="<?php echo $itemsData[0]->barCode; ?>" orderOfColor="<?php echo $j; ?>" style="display:inline; max-width:30px; cursor:pointer;"><?php echo $itemColor[$j][0];?></span>
                        <span style="padding-left:8px;"> </span>
                <?php
                            }else{
                ?>
                        <span class="form-control form-control-sm itemColorInModal" barCode="<?php echo $itemsData[0]->barCode; ?>" orderOfColor="<?php echo $j; ?>" style="display:inline; max-width:30px; cursor:pointer;"><?php echo $itemColor[$j][0];?></span>
                        <span style="padding-left:8px;"> </span>
                <?php
                            }
                        }
                    } 
                ?>
            </div>
        </div>
        <!-- END OF COLOR -->
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3 mt-2">
            <label style="width:95px;" for=""> Item Size:</label>
        </div>
        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9 mt-2">
            <div class="itemSizeInModalMain">
            <?php
                    if(!empty($itemColor)){
                        for ($o=0; $o < count($itemColor[0][1]) ; $o++) {   
                            if ($o % 3 == 0 && $o!= 0){
                                echo "<div style='height:10px;'></div>";
                            }

                            if($o == 0){
                ?>
                    <span class="form-control form-control-sm itemSizeInModal itemSizeSelected" style="display:inline; max-width:30px; cursor:pointer;"><?php echo $itemColor[0][1][$o]; ?></span>
                    <span style="padding-left:8px;"></span>
                <?php
                            }else{
                ?>
                    <span class="form-control form-control-sm itemSizeInModal" style="display:inline; max-width:30px; cursor:pointer;"><?php echo $itemColor[0][1][$o]; ?></span>
                    <span style="padding-left:8px;"></span>
                <?php
                            }
                        }
                    }
                ?>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3 mt-2">
            <label for="itemQuantityInModal" style="margin-top:4px; width:100px;"> Item Quantity:</label>
        </div>
        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9 mt-2">
            <input type="number" min="1" value="1" 
                originalPrice="<?php  
                    echo (round($itemsData[0]->price  - ($itemsData[0]->price  * $itemsData[0]->sale / 100),1));
                ;?>"
                name="itemQuantityInModal" id="itemQuantityInModal" class="form-control form-control-sm" 
            />
        </div> 
        <!-- <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 v">
            <label for="itemPriceInModal" style="margin-top:12px;"> Item Price:</label>
        </div>
        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 mt-2">
            <p id="itemPriceInModal" name="itemPriceInModal" class="form-control form-control-sm" > 
                <b>
                    <?php 
                        echo (round($itemsData[0]->price * $currencyData[0] - ($itemsData[0]->price * $currencyData[0] * $itemsData[0]->sale / 100),1)) ." ". $currencyData[1];
                        
                    ?> 
                </b>
            </p>
        </div> -->
        <!-- <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12 mt-2">
            <label style="width: 120px;" for=""> Item Description:</label>
        </div>
        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-12 mt-2 " title=" <?php echo $itemsData[0]->itemDescription; ?>">
            <p style="width:100%; "> <?php echo $itemsData[0]->itemDescription; ?></p>
        </div> -->
    </div>

</div>

    
<script>$('.carousel').carousel(); </script>