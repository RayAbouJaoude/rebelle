
<div class="row " style="margin-right:0px !important;">
    <?php
        $barArray=[];
        $counter=0;
        $maxItemsInARow = 0;
        for ($i=0; $i < count($itemsData); $i++) {   
            $itemName = $itemsData[$i][4];         
            $itemDescription = $itemsData[$i][6];   
            $quantity = $itemsData[$i][5];   
            $barCode = $itemsData[$i][3];   
            $size = $itemsData[$i][2];   
            $price =  $itemsData[$i][1];   
            $itemId =   $itemsData[$i][0];   
            $sale =   doubleval($itemsData[$i][8]);   
            $imagesArray =   $itemsData[$i][7];   
            // $attachmentName = $data->attachmentName;
            $imageToDisplay =""; 
            // $attachmentName = $data->attachmentName;
            for ($p=0; $p < count($imagesArray) ; $p++) { 
                $mainPageImage = $imagesArray[$p][2];
                if($mainPageImage == 1){
                    $imageToDisplay = '<img loading="lazy" class="itemImageDisplayed" src="'.base_url().'assets/images/itemImages/'. $imagesArray[$p][1] .'.'. $imagesArray[$p][0].'" alt="NoImage" >';
                }
            }


            if(!empty($itemsData[$i][7][0][0])){
                $attachmentExt = $itemsData[$i][7][0][0];
                $imageId = $itemsData[$i][7][0][1];
            }else{
                $attachmentExt = "";
                $imageId="";
            }
            if(!empty($barArray)){
                for ($j=0; $j < count($barArray) ; $j++) { 
                    if( $barCode == $barArray[$j]){
                        $counter=1;
                    }
                }
            }
            if($counter == 0 and $quantity >0 and $maxItemsInARow < 4){
                array_push($barArray,$barCode);
         

    ?>      
        <div class="col-xl-3 co-lg-3 col-md-6 col-sm-6 col-6 mt-2">
            <center>
            <?php if ($imageToDisplay == ""){ ?>
                    <img loading="lazy" class="itemImageDisplayed" src="<?php echo base_url(); ?>assets/images/itemImages/<?php echo $imageId;?>.<?php echo $attachmentExt;?>" alt="NoImage" >
                <?php } else { ?>
                    <?php echo $imageToDisplay; ?>
                <?php } ?>
        <?php 
            if($quantity < 1){
        ?>
                <p style="color:red; margin-top:10px; font-style:italic;">Sold Out! </p>
        <?php 
            }
        ?>
                <p style="letter-spacing:1px;" class="mt-2 mb-1"><?php echo $itemName;?> </p>
        <?php 
            if($sale > 0){
        ?>
                <p  class="mb-1" style="color:red;  text-decoration: line-through;"> 
                    <b>
                <?php 
                    echo number_format($price,1) ." $";
                ?> 
                                    
                    </b>
                </p>
                <p class="mb-1"> <b>
                <?php 
                    echo number_format($price - ($price * $sale / 100),1) ." $";
                ?> 
                </b> </p>
        <?php 
            }else{
        ?>
            <p > <b>
            <?php 
                    echo number_format($price,1) ." $";
            ?> </b> </p>

        <?php
            }
            if($quantity >0){
                $maxItemsInARow = $maxItemsInARow + 1 ;
        ?>
                <button class ="btn btn-sm greenButtonsCss viewItemsButtons" productCode="<?= $barCode; ?>" itemName="<?php echo $itemName ?>" itemId="<?php echo $itemId;?>"> View Item </button>
        <?php 
            }
        ?>
            </center>
        </div>

    <?php
            }else{
                $counter=0;
            }
        }
    ?>
</div>
<div style="height:60px;">
</div>