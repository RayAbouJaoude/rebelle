<table id="imagesTable" class="table table-striped " style="table-layout: fixed !important; width:100%;">
        <thead>
            <tr>
                <th style="width: 6.3% !important; max-width:6.3% !important  background-color:white;">Action </th>
                <th style="width: 93.7% !important; max-width: 93.7%  !important ; background-color:white;">Image Name</th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach ($imagesData as $attach) {   
                $attachmentId = $attach->id;         
                $attachmentName = $attach->attachmentName;
                $attachmentExt = $attach->attachmentExt;
                $barCode = $attach->barCode;
                $mainPage = $attach->mainPage;
        ?>
        <tr style=" background-color:white;">
            <td class="toHideFromModal" style=" background-color:white;"> 
                <center>
                <a class="deleteImageInEdit" title="Delete Image" href="javascript:void(0);" data-deleteImageId ="<?php echo $attachmentId ?>">
                    <i class ="fa fa-trash" style="color:#ef6b6b; font-size:11pt; text-decoration:none !important" > </i>
                </a>
                <?php
                    if($mainPage == 1){
                ?>
                    <input type="checkbox" checked barcodeId="<?php echo $barCode ?>" dataid="<?php echo $attachmentId ?>" class="mainImageCheckBox ml-2">
                <?php
                    }else{
                ?>
                    <input type="checkbox" barcodeId="<?php echo $barCode ?>" dataid="<?php echo $attachmentId ?>" class="mainImageCheckBox ml-2">
                <?php
                    }
                ?>
                </center>
            </td>
            <td style="padding-left:18px; background-color:white;">
                <a download href="<?php echo base_url(); ?>assets/images/itemImages/<?= $attachmentId ?>.<?= $attachmentExt ; ?>"><?= $attachmentName; ?>.<?= $attachmentExt; ?></a>
            </td> 
        </tr>
        <?php
    }
?>
    </tbody>
</table>