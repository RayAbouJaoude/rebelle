<table id="propertySectionTable" class="table table-striped" style=" width:100%;">
    <thead>
        <tr>
            <th style="width:5%;"></th>
            <th style="width:30%;">Title</th>
            <th style="width: 20%;">Sale / Rent</th>
            <th style="width: 25%;">Price</th>
            <th style="width: 20%;">Lot Size</th>
            
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
            
    ?>      
            <tr>
                <td class="" style="padding-left:10px; ">
                    <center>
                        <i class="fas fa-trash-alt deletePropertyIcon" style="color:red; cursor:pointer;" title="Delete Property" dataId= "<?php echo $id; ?>"></i>
                    </center>
                </td>
                <td class="displayPropertyToEdit" style="cursor:pointer; padding-left:10px;" dataId= "<?php echo $id; ?>"> 
                    <?= ucfirst($title); ?> 
                </td>
                <td class="displayPropertyToEdit" style="cursor:pointer; padding-left:10px;" dataId= "<?php echo $id; ?>">
                    <?= ucfirst($saleOrRent); ?>
                </td>
                <td class="displayPropertyToEdit" style="cursor:pointer; padding-left:10px;" dataId= "<?php echo $id; ?>">
                    <?= ucfirst($price); ?>
                </td>
                <td class="displayPropertyToEdit" style="cursor:pointer; padding-left:10px;" dataId= "<?php echo $id; ?>">
                    <?= ucfirst($lotSize); ?>
                </td>
            </tr>
    <?php
        }
    ?>
    </tbody>
</table>
        