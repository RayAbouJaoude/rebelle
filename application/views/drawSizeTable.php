<table id="sizeTable" class="table table-striped " style="table-layout: fixed !important; width:100%;">
        <thead>
            <tr>
                <th style="width: 6.3% !important; max-width:6.3% !important  background-color:white;">Action </th>
                <th style="width: 93.7% !important; max-width: 93.7%  !important ; background-color:white;">Size</th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach ($imagesData as $attach) {   
                $attachmentId = $attach->id;         
                $attachmentName = $attach->sizeName;
               
        ?>
        <tr style=" background-color:white;">
            <td class="" style=" background-color:white;"> 
                <center>
                    <a class="deleteSizeInEdit" title="Delete Size" href="javascript:void(0);" dataId ="<?php echo $attachmentId ?>">
                        <i class ="fa fa-trash" style="color:#ef6b6b; font-size:11pt; text-decoration:none !important" > </i>
                    </a>
                </center>
            </td>
            <td style="padding-left:18px; background-color:white;"  class="displaySizeToEdit" href="javascript:void(0);" dataId ="<?php echo $attachmentId ?>">
                <?= $attachmentName; ?>
            </td> 
        </tr>
        <?php
    }
?>
    </tbody>
</table>