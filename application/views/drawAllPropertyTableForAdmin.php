<table id="propertySectionTableForAdmin" class="table table-striped" style=" width:100%;">
    <thead>
        <tr>
            <th style="width:5%;"></th>
            <th style="width:20%;">Full Name</th>
            <th style="width:25%;">Title</th>
            <th style="width: 10%;">Sale / Rent</th>
            <th style="width: 20%;">Price</th>
            <th style="width: 10%;">Lot Size</th>
            <th style="width: 10%;">Status</th>
            
        </tr>
    </thead>
    <tbody>
    <?php
        for ($i=0; $i <count($propertyInfo); $i++) {
            
            $id= $propertyInfo[$i]->id;
            $title= $propertyInfo[$i]->title;
            $saleOrRent= $propertyInfo[$i]->saleOrRent;
            $price= $propertyInfo[$i]->price;
            $lotSize= $propertyInfo[$i]->lotSize;
            $fname= $propertyInfo[$i]->fname;
            $lname= $propertyInfo[$i]->lname;
            $status= $propertyInfo[$i]->accepted;
            if($status == 1){
                $isCheckedIcon = '<img dataIsChecked="1"   src="'. base_url() .'assets/images/enabled2_small.png">';
                $titleToChange = 'Accepted By '. ucfirst($fname) ;
            }else if($status == 0){
                $isCheckedIcon = '<img dataIsChecked="0" src="'. base_url() .'assets/images/nothing_small.png" />';
                $titleToChange = 'Not selected';
            
            }else{
                $isCheckedIcon = '<img dataIsChecked="-1"  src="'. base_url() .'assets/images/disabled2_small.png" />';
                $titleToChange = 'Declined By '. ucfirst($fname) ;
            }
    ?>      
            <tr>
                <td class="" style="padding-left:10px; ">
                    <center>
                        <i class="fas fa-trash-alt deletePropertyIconForAdmin" style="color:red; cursor:pointer;" title="Delete Property" dataId= "<?php echo $id; ?>"></i>
                    </center>
                </td>
                <td class="displayAdminPropertyInfoToEdit" style="cursor:pointer; padding-left:10px;" dataId= "<?php echo $id; ?>">
                    <?= ucfirst($fname ." ". $lname); ?>
                </td>
                <td class="displayAdminPropertyInfoToEdit" style="cursor:pointer; padding-left:10px;" dataId= "<?php echo $id; ?>"> 
                    <?= ucfirst($title); ?> 
                </td>
                <td class="displayAdminPropertyInfoToEdit" style="cursor:pointer; padding-left:10px;" dataId= "<?php echo $id; ?>">
                    <?= ucfirst($saleOrRent); ?>
                </td>
                <td class="displayAdminPropertyInfoToEdit" style="cursor:pointer; padding-left:10px;" dataId= "<?php echo $id; ?>">
                    <?= $price; ?>
                </td>
                <td class="displayAdminPropertyInfoToEdit" style="cursor:pointer; padding-left:10px;" dataId= "<?php echo $id; ?>">
                    <?= $lotSize; ?>
                </td>
                <td  style="text-align:center;  padding-top:9px; cursor :pointer;" title ="<?= $titleToChange; ?>"   data-toggle="tooltip" data-placement="top" findTooltipStatus="<?php echo $id; ?>" class="statusIcon" dataId= "<?php echo $id; ?>" isChecked="<?= $status;?>" href="javascript:void(0);" >
                     <?= $isCheckedIcon; ?>
                </td>        
            </tr>
    <?php
        }
    ?>
    </tbody>
</table>
        