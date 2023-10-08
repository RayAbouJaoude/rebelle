<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_Model extends CI_Model {


    //...................ADD SURVBEY..................//
    public function addItem($itemNameToAdd, $itemDescriptionToAdd, $itemQuantityToAdd, $itemBarCodeToAdd, $itemCategoryToAdd, $itemSizeToAdd, $itemPriceToAdd, $quantityArr, $sizeArr, $colorArr, $colorToAdd, $itemWeightToAdd){
        $attachmentId=0;
        $itemNameToAdd = $this->db->escape($itemNameToAdd);
        $itemDescriptionToAdd = $this->db->escape($itemDescriptionToAdd);
        $itemBarCodeToAdd = $this->db->escape($itemBarCodeToAdd);
        $itemCategoryToAdd = $this->db->escape($itemCategoryToAdd);
        $itemSizeToAdd = $this->db->escape($itemSizeToAdd);
        $colorToAdd = $this->db->escape($colorToAdd);
        $itemPriceToAdd = $this->db->escape($itemPriceToAdd);
        if( $quantityArr != [] || $sizeArr !=[] || $colorArr !=[] ){
            $quantityArr=explode(",",$quantityArr);
            $sizeArr=explode(",",$sizeArr);
            $colorArr=explode(",",$colorArr);
        }
        $sqlQuery = "INSERT INTO item (itemName, itemDescription, quantity, barCode, categoryItems, size, price, isDeleted, color, `weight`, exported)
                     VALUES ($itemNameToAdd , $itemDescriptionToAdd, $itemQuantityToAdd , $itemBarCodeToAdd, $itemCategoryToAdd , $itemSizeToAdd, $itemPriceToAdd, 0, $colorToAdd, $itemWeightToAdd, 1)"; 
        $query = $this->db->query($sqlQuery);
        $lastInsertedId = $this->db->insert_id();
        // $beforeAfter= "Quantity > " . $itemQuantityToAdd . " Size > " . $itemSizeToAdd ;
        // $this->addToLog($userId, $lastInsertedId, 5, 1, $lastInsertedId, $beforeAfter);
        // $lastInsertedIdToPrint = str_pad($lastInsertedId, 12,'0',STR_PAD_LEFT);
        // $lastInsertedIdToPrint = $this->db->escape($lastInsertedIdToPrint);

        // $sql2 = "UPDATE item
        //          SET `barCodeToPrint` = $lastInsertedIdToPrint
        //          WHERE `id` = $lastInsertedId";
        // $query2 = $this->db->query($sql2);
        if($quantityArr != "" || $quantityArr != [] || count($quantityArr) > 0 ){
            for ($i=0; $i < count($quantityArr) ; $i++) { 
                $sizeee = $sizeArr[$i];
                $colorr = $colorArr[$i];
                $quantityyy = $quantityArr[$i];
                $sizeee = $this->db->escape($sizeee);
                $colorr = $this->db->escape($colorr);
    
                $sqlQuery1 = "INSERT INTO item (itemName, itemDescription, quantity, barCode, categoryItems, size, price, isDeleted, color, `weight`, exported)
                            VALUES ($itemNameToAdd , $itemDescriptionToAdd, $quantityyy , $itemBarCodeToAdd, $itemCategoryToAdd , $sizeee, $itemPriceToAdd, 0, $colorr, $itemWeightToAdd, 1)"; 
                $query1 = $this->db->query($sqlQuery1);
                // $lastInsertedId = $this->db->insert_id();
                // $beforeAfter= "Quantity > " . $quantityyy . " Size > " . $sizeee ;
                // $this->addToLog($userId, $lastInsertedId, 5, 1, $lastInsertedId, $beforeAfter);
                // $lastInsertedIdToPrint = str_pad($lastInsertedId, 12,'0',STR_PAD_LEFT);
                // $lastInsertedIdToPrint = $this->db->escape($lastInsertedIdToPrint);

                // $sql2 = "UPDATE item
                //         SET `barCodeToPrint` = $lastInsertedIdToPrint
                //         WHERE `id` = $lastInsertedId";
                // $query2 = $this->db->query($sql2);
            }
        }
        if ($query) {
            $result = 1;
        } else {
            $result = -1;
        }
        return array($result, $itemBarCodeToAdd);
    }

    public function getItemsData($archivedOrNot, $category, $gender){
        $gender = -1;
        $category = -1;
        if($category == -1 && $gender == -1){
            if($archivedOrNot == 1){
                $sqlQuery = "SELECT item.*, images.id as imageId, images.attachmentExt as imageExt FROM item
                            LEFT JOIN(
                                SELECT barCode, id, attachmentExt 
                                FROM itemimage 
                                Where isDeleted = 0
                                ORDER BY  id DESC
                            ) AS images ON item.barCode = images.barCode  
                            Where isDeleted = 0 and storage < 1 
                            GROUP BY id
                            ";
            }elseif($archivedOrNot == 2){
                $sqlQuery = "SELECT item.*, images.id as imageId, images.attachmentExt as imageExt FROM item
                            LEFT JOIN(
                                SELECT barcode, id, attachmentExt 
                                FROM itemimage 
                                Where isDeleted = 0
                                ORDER BY  id DESC
                            ) AS images ON item.barCode = images.barCode  
                            Where isDeleted = 0 and archive =1 and storage < 1 
                            GROUP BY id
                            
                            ";
            }elseif($archivedOrNot == 4){
                // ON SALE 
                $sqlQuery = "SELECT item.*, images.id as imageId, images.attachmentExt as imageExt FROM item
                            LEFT JOIN(
                                SELECT barcode, id, attachmentExt 
                                FROM itemimage 
                                Where isDeleted = 0
                                ORDER BY  id DESC
                            ) AS images ON item.barCode = images.barCode  
                            Where isDeleted = 0  and sale > 0 and storage < 1 
                            GROUP BY id
                            
                            ";
            
            }elseif($archivedOrNot == 5){
                // NOT ON SALE 
                $sqlQuery = "SELECT item.*, images.id as imageId, images.attachmentExt as imageExt FROM item
                            LEFT JOIN(
                                SELECT barcode, id, attachmentExt 
                                FROM itemimage 
                                Where isDeleted = 0
                                ORDER BY  id DESC
                            ) AS images ON item.barCode = images.barCode  
                            Where isDeleted = 0  and sale < 0.1 and storage < 1 
                            GROUP BY id
                            ";
            }elseif($archivedOrNot == 6){
                // NOT ON SALE 
                $sqlQuery = "SELECT item.*, images.id as imageId, images.attachmentExt as imageExt FROM item
                            LEFT JOIN(
                                SELECT barcode, id, attachmentExt 
                                FROM itemimage 
                                Where isDeleted = 0
                                ORDER BY  id DESC
                            ) AS images ON item.barCode = images.barCode  
                            Where isDeleted = 0  and exported = 1 and storage < 1 
                            GROUP BY id
                            ";
            }elseif($archivedOrNot == 7){
                // NOT ON SALE 
                $sqlQuery = "SELECT item.*, images.id as imageId, images.attachmentExt as imageExt FROM item
                            LEFT JOIN(
                                SELECT barcode, id, attachmentExt 
                                FROM itemimage 
                                Where isDeleted = 0
                                ORDER BY  id DESC
                            ) AS images ON item.barCode = images.barCode  
                            Where isDeleted = 0  and newCollection = 1 and storage < 1 
                            GROUP BY id
                            ";
            }elseif($archivedOrNot == 8){
                // NOT ON SALE 
                $sqlQuery = "SELECT item.*, images.id as imageId, images.attachmentExt as imageExt FROM item
                            LEFT JOIN(
                                SELECT barcode, id, attachmentExt 
                                FROM itemimage 
                                Where isDeleted = 0
                                ORDER BY  id DESC
                            ) AS images ON item.barCode = images.barCode  
                            Where isDeleted = 0  and summerCollection = 1 and storage < 1 
                            GROUP BY id
                            ";
            }elseif($archivedOrNot == 9){
                // NOT ON SALE 
                $sqlQuery = "SELECT item.*, images.id as imageId, images.attachmentExt as imageExt FROM item
                            LEFT JOIN(
                                SELECT barcode, id, attachmentExt 
                                FROM itemimage 
                                Where isDeleted = 0
                                ORDER BY  id DESC
                            ) AS images ON item.barCode = images.barCode  
                            Where isDeleted = 0  and winterCollection = 1 and storage < 1 
                            GROUP BY id
                            ";
            }elseif($archivedOrNot == 10){
                // NOT ON SALE 
                $sqlQuery = "SELECT item.*, images.id as imageId, images.attachmentExt as imageExt FROM item
                            LEFT JOIN(
                                SELECT barcode, id, attachmentExt 
                                FROM itemimage 
                                Where isDeleted = 0
                                ORDER BY  id DESC
                            ) AS images ON item.barCode = images.barCode  
                            Where isDeleted = 0 and storage = 1 
                            GROUP BY id
                            ";
            }else{
                $sqlQuery = "SELECT item.*, images.id as imageId, images.attachmentExt as imageExt FROM item
                            LEFT JOIN(
                                SELECT barcode, id, attachmentExt 
                                FROM itemimage 
                                Where isDeleted = 0
                                ORDER BY  id DESC
                                
                            ) AS images ON item.barCode = images.barCode  
                            Where isDeleted = 0 and archive != 1 and  exported != 1 and summerCollection != 1 and winterCollection != 1 and storage < 1 
                            GROUP BY id
                            ";
            }
        }elseif ($category != -1 && $gender != -1) {
            if($archivedOrNot == 1){
                $sqlQuery = "SELECT item.*, images.id as imageId, images.attachmentExt as imageExt FROM item
                            LEFT JOIN(
                                SELECT barCode, id, attachmentExt 
                                FROM itemimage 
                                Where item.isDeleted = 0
                                ORDER BY  id DESC
                            ) AS images ON item.barCode = images.barCode
                            Where isDeleted = 0  and item.categoryItems = $category and item.gender = $gender  and storage < 1 
                            GROUP BY id
                            ";
            }elseif($archivedOrNot == 2){
                $sqlQuery = "SELECT item.*, images.id as imageId, images.attachmentExt as imageExt FROM item
                            LEFT JOIN(
                                SELECT barcode, id, attachmentExt 
                                FROM itemimage 
                                Where isDeleted = 0
                                ORDER BY  id DESC
                            ) AS images ON item.barCode = images.barCode  
                            Where isDeleted = 0 and archive =1 and item.categoryItems = $category and item.gender = $gender and storage < 1 
                            GROUP BY id
                            
                            ";
            }elseif($archivedOrNot == 4){
                // ON SALE 
                $sqlQuery = "SELECT item.*, images.id as imageId, images.attachmentExt as imageExt FROM item
                            LEFT JOIN(
                                SELECT barcode, id, attachmentExt 
                                FROM itemimage 
                                Where isDeleted = 0
                                ORDER BY  id DESC
                            ) AS images ON item.barCode = images.barCode  
                            Where isDeleted = 0  and sale > 0 and item.categoryItems = $category and item.gender = $gender and storage < 1 
                            GROUP BY id
                            
                            ";
            
            }elseif($archivedOrNot == 5){
                // NOT ON SALE 
                $sqlQuery = "SELECT item.*, images.id as imageId, images.attachmentExt as imageExt FROM item
                            LEFT JOIN(
                                SELECT barcode, id, attachmentExt 
                                FROM itemimage 
                                Where isDeleted = 0
                                ORDER BY  id DESC
                            ) AS images ON item.barCode = images.barCode  
                            Where isDeleted = 0  and sale < 0.1 and item.categoryItems = $category and item.gender = $gender and storage < 1 
                            GROUP BY id
                            ";
            }elseif($archivedOrNot == 6){
                // NOT ON SALE 
                $sqlQuery = "SELECT item.*, images.id as imageId, images.attachmentExt as imageExt FROM item
                            LEFT JOIN(
                                SELECT barcode, id, attachmentExt 
                                FROM itemimage 
                                Where isDeleted = 0
                                ORDER BY  id DESC
                            ) AS images ON item.barCode = images.barCode  
                            Where isDeleted = 0  and exported = 1 and item.categoryItems = $category and item.gender = $gender and storage < 1 
                            GROUP BY id
                            ";
            }elseif($archivedOrNot == 7){
                // NOT ON SALE 
                $sqlQuery = "SELECT item.*, images.id as imageId, images.attachmentExt as imageExt FROM item
                            LEFT JOIN(
                                SELECT barcode, id, attachmentExt 
                                FROM itemimage 
                                Where isDeleted = 0
                                ORDER BY  id DESC
                            ) AS images ON item.barCode = images.barCode  
                            Where isDeleted = 0  and newCollection = 1 and item.categoryItems = $category and item.gender = $gender and storage < 1 
                            GROUP BY id
                            ";
            }elseif($archivedOrNot == 8){
                // NOT ON SALE 
                $sqlQuery = "SELECT item.*, images.id as imageId, images.attachmentExt as imageExt FROM item
                            LEFT JOIN(
                                SELECT barcode, id, attachmentExt 
                                FROM itemimage 
                                Where isDeleted = 0
                                ORDER BY  id DESC
                            ) AS images ON item.barCode = images.barCode  
                            Where isDeleted = 0  and summerCollection = 1 and item.categoryItems = $category and item.gender = $gender and storage < 1 
                            GROUP BY id
                            ";
            }elseif($archivedOrNot == 9){
                // NOT ON SALE 
                $sqlQuery = "SELECT item.*, images.id as imageId, images.attachmentExt as imageExt FROM item
                            LEFT JOIN(
                                SELECT barcode, id, attachmentExt 
                                FROM itemimage 
                                Where isDeleted = 0 
                                ORDER BY  id DESC
                            ) AS images ON item.barCode = images.barCode  
                            Where isDeleted = 0  and winterCollection = 1 and item.categoryItems = $category and item.gender = $gender and storage < 1 
                            GROUP BY id
                            ";
            }else{
                $sqlQuery = "SELECT item.*, images.id as imageId, images.attachmentExt as imageExt FROM item
                            LEFT JOIN(
                                SELECT barcode, id, attachmentExt 
                                FROM itemimage 
                                Where isDeleted = 0
                                ORDER BY  id DESC
                                
                            ) AS images ON item.barCode = images.barCode  
                            Where isDeleted = 0 and archive != 1 and  exported != 1 and summerCollection != 1 and winterCollection != 1  and item.categoryItems = $category and item.gender = $gender and storage < 1 
                            GROUP BY id
                            ";
            }
        }elseif ($category != -1 && $gender == -1) {
            if($archivedOrNot == 1){
                $sqlQuery = "SELECT item.*, images.id as imageId, images.attachmentExt as imageExt FROM item
                            LEFT JOIN(
                                SELECT barCode, id, attachmentExt 
                                FROM itemimage 
                                Where item.isDeleted = 0
                                ORDER BY  id DESC
                            ) AS images ON item.barCode = images.barCode
                            Where isDeleted = 0  and item.categoryItems = $category  and storage < 1 
                            GROUP BY id
                            ";
            }elseif($archivedOrNot == 2){
                $sqlQuery = "SELECT item.*, images.id as imageId, images.attachmentExt as imageExt FROM item
                            LEFT JOIN(
                                SELECT barcode, id, attachmentExt 
                                FROM itemimage 
                                Where isDeleted = 0
                                ORDER BY  id DESC
                            ) AS images ON item.barCode = images.barCode  
                            Where isDeleted = 0 and archive =1 and item.categoryItems = $category and storage < 1 
                            GROUP BY id
                            
                            ";
            }elseif($archivedOrNot == 4){
                // ON SALE 
                $sqlQuery = "SELECT item.*, images.id as imageId, images.attachmentExt as imageExt FROM item
                            LEFT JOIN(
                                SELECT barcode, id, attachmentExt 
                                FROM itemimage 
                                Where isDeleted = 0
                                ORDER BY  id DESC
                            ) AS images ON item.barCode = images.barCode  
                            Where isDeleted = 0  and sale > 0 and item.categoryItems = $category and storage < 1 
                            GROUP BY id
                            
                            ";
            
            }elseif($archivedOrNot == 5){
                // NOT ON SALE 
                $sqlQuery = "SELECT item.*, images.id as imageId, images.attachmentExt as imageExt FROM item
                            LEFT JOIN(
                                SELECT barcode, id, attachmentExt 
                                FROM itemimage 
                                Where isDeleted = 0
                                ORDER BY  id DESC
                            ) AS images ON item.barCode = images.barCode  
                            Where isDeleted = 0  and sale < 0.1 and item.categoryItems = $category and storage < 1 
                            GROUP BY id
                            ";
            }elseif($archivedOrNot == 6){
                // NOT ON SALE 
                $sqlQuery = "SELECT item.*, images.id as imageId, images.attachmentExt as imageExt FROM item
                            LEFT JOIN(
                                SELECT barcode, id, attachmentExt 
                                FROM itemimage 
                                Where isDeleted = 0
                                ORDER BY  id DESC
                            ) AS images ON item.barCode = images.barCode  
                            Where isDeleted = 0  and exported = 1 and item.categoryItems = $category and storage < 1 
                            GROUP BY id
                            ";
            }elseif($archivedOrNot == 7){
                // NOT ON SALE 
                $sqlQuery = "SELECT item.*, images.id as imageId, images.attachmentExt as imageExt FROM item
                            LEFT JOIN(
                                SELECT barcode, id, attachmentExt 
                                FROM itemimage 
                                Where isDeleted = 0
                                ORDER BY  id DESC
                            ) AS images ON item.barCode = images.barCode  
                            Where isDeleted = 0  and newCollection = 1 and item.categoryItems = $category and storage < 1 
                            GROUP BY id
                            ";
            }elseif($archivedOrNot == 8){
                // NOT ON SALE 
                $sqlQuery = "SELECT item.*, images.id as imageId, images.attachmentExt as imageExt FROM item
                            LEFT JOIN(
                                SELECT barcode, id, attachmentExt 
                                FROM itemimage 
                                Where isDeleted = 0
                                ORDER BY  id DESC
                            ) AS images ON item.barCode = images.barCode  
                            Where isDeleted = 0  and summerCollection = 1 and item.categoryItems = $category and storage < 1 
                            GROUP BY id
                            ";
            }elseif($archivedOrNot == 9){
                // NOT ON SALE 
                $sqlQuery = "SELECT item.*, images.id as imageId, images.attachmentExt as imageExt FROM item
                            LEFT JOIN(
                                SELECT barcode, id, attachmentExt 
                                FROM itemimage 
                                Where isDeleted = 0 
                                ORDER BY  id DESC
                            ) AS images ON item.barCode = images.barCode  
                            Where isDeleted = 0  and winterCollection = 1 and item.categoryItems = $category and storage < 1 
                            GROUP BY id
                            ";
            }else{
                $sqlQuery = "SELECT item.*, images.id as imageId, images.attachmentExt as imageExt FROM item
                            LEFT JOIN(
                                SELECT barcode, id, attachmentExt 
                                FROM itemimage 
                                Where isDeleted = 0
                                ORDER BY  id DESC
                                
                            ) AS images ON item.barCode = images.barCode  
                            Where isDeleted = 0 and archive != 1 and  exported != 1 and summerCollection != 1 and winterCollection != 1  and item.categoryItems = $category and storage < 1 
                            GROUP BY id
                            ";
            }
        }elseif ($category == -1 && $gender != -1) {
            if($archivedOrNot == 1){
                $sqlQuery = "SELECT item.*, images.id as imageId, images.attachmentExt as imageExt FROM item
                            LEFT JOIN(
                                SELECT barCode, id, attachmentExt 
                                FROM itemimage 
                                Where item.isDeleted = 0
                                ORDER BY  id DESC
                            ) AS images ON item.barCode = images.barCode
                            Where isDeleted = 0  and item.gender = $gender and storage < 1 
                            GROUP BY id
                            ";
            }elseif($archivedOrNot == 2){
                $sqlQuery = "SELECT item.*, images.id as imageId, images.attachmentExt as imageExt FROM item
                            LEFT JOIN(
                                SELECT barcode, id, attachmentExt 
                                FROM itemimage 
                                Where isDeleted = 0
                                ORDER BY  id DESC
                            ) AS images ON item.barCode = images.barCode  
                            Where isDeleted = 0 and archive =1 and item.gender = $gender and storage < 1 
                            GROUP BY id
                            
                            ";
            }elseif($archivedOrNot == 4){
                // ON SALE 
                $sqlQuery = "SELECT item.*, images.id as imageId, images.attachmentExt as imageExt FROM item
                            LEFT JOIN(
                                SELECT barcode, id, attachmentExt 
                                FROM itemimage 
                                Where isDeleted = 0
                                ORDER BY  id DESC
                            ) AS images ON item.barCode = images.barCode  
                            Where isDeleted = 0  and sale > 0 and item.gender = $gender and storage < 1 
                            GROUP BY id
                            
                            ";
            
            }elseif($archivedOrNot == 5){
                // NOT ON SALE 
                $sqlQuery = "SELECT item.*, images.id as imageId, images.attachmentExt as imageExt FROM item
                            LEFT JOIN(
                                SELECT barcode, id, attachmentExt 
                                FROM itemimage 
                                Where isDeleted = 0
                                ORDER BY  id DESC
                            ) AS images ON item.barCode = images.barCode  
                            Where isDeleted = 0  and sale < 0.1 and item.gender = $gender and storage < 1 
                            GROUP BY id
                            ";
            }elseif($archivedOrNot == 6){
                // NOT ON SALE 
                $sqlQuery = "SELECT item.*, images.id as imageId, images.attachmentExt as imageExt FROM item
                            LEFT JOIN(
                                SELECT barcode, id, attachmentExt 
                                FROM itemimage 
                                Where isDeleted = 0
                                ORDER BY  id DESC
                            ) AS images ON item.barCode = images.barCode  
                            Where isDeleted = 0  and exported = 1 and item.gender = $gender and storage < 1 
                            GROUP BY id
                            ";
            }elseif($archivedOrNot == 7){
                // NOT ON SALE 
                $sqlQuery = "SELECT item.*, images.id as imageId, images.attachmentExt as imageExt FROM item
                            LEFT JOIN(
                                SELECT barcode, id, attachmentExt 
                                FROM itemimage 
                                Where isDeleted = 0
                                ORDER BY  id DESC
                            ) AS images ON item.barCode = images.barCode  
                            Where isDeleted = 0  and newCollection = 1 and item.gender = $gender and storage < 1 
                            GROUP BY id
                            ";
            }elseif($archivedOrNot == 8){
                // NOT ON SALE 
                $sqlQuery = "SELECT item.*, images.id as imageId, images.attachmentExt as imageExt FROM item
                            LEFT JOIN(
                                SELECT barcode, id, attachmentExt 
                                FROM itemimage 
                                Where isDeleted = 0
                                ORDER BY  id DESC
                            ) AS images ON item.barCode = images.barCode  
                            Where isDeleted = 0  and summerCollection = 1 and item.gender = $gender and storage < 1 
                            GROUP BY id
                            ";
            }elseif($archivedOrNot == 9){
                // NOT ON SALE 
                $sqlQuery = "SELECT item.*, images.id as imageId, images.attachmentExt as imageExt FROM item
                            LEFT JOIN(
                                SELECT barcode, id, attachmentExt 
                                FROM itemimage 
                                Where isDeleted = 0 
                                ORDER BY  id DESC
                            ) AS images ON item.barCode = images.barCode  
                            Where isDeleted = 0  and winterCollection = 1 and item.gender = $gender and storage < 1 
                            GROUP BY id
                            ";
            }else{
                $sqlQuery = "SELECT item.*, images.id as imageId, images.attachmentExt as imageExt FROM item
                            LEFT JOIN(
                                SELECT barcode, id, attachmentExt 
                                FROM itemimage 
                                Where isDeleted = 0
                                ORDER BY  id DESC
                                
                            ) AS images ON item.barCode = images.barCode  
                            Where isDeleted = 0 and archive != 1 and  exported != 1 and summerCollection != 1 and winterCollection != 1  and item.gender = $gender and storage < 1 
                            GROUP BY id
                            ";
            }
        }
        $query = $this->db->query($sqlQuery);
        if ($query) {
            $result = $query->result();
        } else {
            $result = -1;
        }
        return $result;
    }

    //-----------------------------------------------------------//
    public function deleteAttachment($attachmentId)
    {
        $sql = "UPDATE itemimage
                SET `isDeleted` = 1
                WHERE `id` = $attachmentId";
        $query = $this->db->query($sql);
        if ($query) {
            return 1;
        } else {
            return 0;
        }
    }
   //--------------------------------------------------------//


   public function getItemDataInItemsToEdit($itemId, $barCode){
        $barCode = $this->db->escape($barCode);
        $sqlQuery = "SELECT * FROM item
                    Where isDeleted = 0 and id = $itemId";

        $query = $this->db->query($sqlQuery);
        if ($query) {
            $result = $query->result();
        } else {
            $result = -1;
        }
        return $result;
    }
   //--------------------------------------------------------//


    public function newCollectionItem($itemId){
        $barCode = $this->db->escape($itemId);
        $sqlQuery1 = "SELECT * FROM item
                    Where isDeleted = 0 and barCode = $barCode
                    ORDER BY `id` ASC";

        $query1 = $this->db->query($sqlQuery1);
        $newCollectionInfo = $query1->row();
        $newCollection = $newCollectionInfo->newCollection;
        if($newCollection == 1){
            $newCollection = 0;
        }else{
            $newCollection = 1;
        }
        $sqlQuery = "UPDATE item
                        SET newCollection = $newCollection
                        WHERE  isDeleted =0  and barCode = $barCode";
        $query=$this->db->query($sqlQuery); 
        if($query){
            $result =$newCollection;
        }else{
            $result = -1;
        }
        return $result;
    }
    //--------------------------------------------------------//


    public function deleteMainPageItems($arrayToAddStorage) {
        $arrayToAddStorage=explode(",",$arrayToAddStorage);

        for ($i=0; $i <count($arrayToAddStorage) ; $i++) { 
            $sqlQuery= "UPDATE item
                        SET isDeleted = 1
                        WHERE id = $arrayToAddStorage[$i]";
        
            $query = $this->db->query($sqlQuery);
            
        }

        if ($query) {
            $result = 1;
        } else {
            $result = -1;
        }
        return $result;
    }
    //--------------------------------------------------------//

    public function archiveItem($itemId){

        
        $sqlQuery = "UPDATE item
                        SET archive = CASE 
                                            WHEN archive = 0 then 1
                                            WHEN archive = 1 then 0
                                        END
                        WHERE  isDeleted =0  and id = $itemId";
            $query=$this->db->query($sqlQuery);  
            if($query){
                $result =1;
            }else{
                $result = -1;
            }
            return $result;
    }
    //--------------------------------------------------------//


    public function exportedItem($itemId){
        $sqlQuery = "UPDATE item
                        SET exported = CASE 
                                            WHEN exported = 0 then 1
                                            WHEN exported = 1 then 0
                                        END
                        WHERE  isDeleted =0  and id = $itemId";
        $query=$this->db->query($sqlQuery);


        $sqlQuery1 = "SELECT * FROM item
                    Where isDeleted = 0 and id = $itemId
                    ";

        $query1 = $this->db->query($sqlQuery1);
        $exportedInfo = $query1->row();
        $exported = $exportedInfo->exported;  
        if($query){
            $result = $exported;
        }else{
            $result = -1;
        }
        return $result;
    }
    //--------------------------------------------------------//



    public function getItemSizeInModal(){
        $sqlQuery = "SELECT * FROM sizes
                    Where isDeleted = 0
                    ORDER BY `id` DESC";

        $query = $this->db->query($sqlQuery);
        if ($query) {
            $result = $query->result();
        } else {
            $result = -1;
        }
        return $result;
    }
    public function getItemColorInModal(){

        $sqlQuery = "SELECT * FROM colors
                    Where isDeleted = 0
                    ORDER BY `id` DESC";

        $query = $this->db->query($sqlQuery);
        if ($query) {
            $result = $query->result();
        } else {
            $result = -1;
        }
        return $result;
    }

    public function fillSize()
    {
        $sqlQuery = "SELECT * 
                     FROM `sizes`
                     Where isDeleted = 0
                     ORDER BY `sizeName` ASC";

        $query = $this->db->query($sqlQuery);

        if ($query) {
            $result = $query->result();
        } else {
            $result = -1;
        }

        return $result;
    }


    // -- -- -- -- -- # # -- -- -- -- -- //
    public function fillColor()
    {
        $sqlQuery = "SELECT * 
                     FROM `colors`
                     Where isDeleted = 0
                     ORDER BY `colorName` ASC";

        $query = $this->db->query($sqlQuery);

        if ($query) {
            $result = $query->result();
        } else {
            $result = -1;
        }

        return $result;
    }


    

    // -- -- -- -- -- # # -- -- -- -- -- //
    public function submitSizeAdd($colorNameToAddInModal)
    {
        $colorNameToAddInModal = $this->db->escape($colorNameToAddInModal);

        $sqlQuery ="INSERT INTO `sizes`(`sizeName`)
                    VALUES ($colorNameToAddInModal)";
        $query = $this->db->query($sqlQuery);
        $lastId = $this->db->insert_id();

        if ($query) {
            $result = $lastId;
        } else {
            $result = -1;
        }

        return $result;
    }


    // -- -- -- -- -- # # -- -- -- -- -- //
	// -- -- -- -- -- # # -- -- -- -- -- //
    public function submitSizeEdit($colorIdHidden, $colorNameToAddInModal)
    {

        $colorNameToAddInModal = $this->db->escape($colorNameToAddInModal);

        $sqlQuery = "UPDATE `sizes` 
                     SET `sizeName`= $colorNameToAddInModal
                     WHERE `id` = $colorIdHidden";
        $query = $this->db->query($sqlQuery);

        if ($query) {
            $result = -2;
        } else {
            $result = -1;
        }

        return $result;
    }

    public function deleteSizeInModal($dataId) {
        
        $sqlQuery= "UPDATE sizes
                    SET isDeleted = 1
                    WHERE id = $dataId";
    
        $query = $this->db->query($sqlQuery);

        if ($query) {
            $result = 1;
        } else {
            $result = -1;
        }
        return $result;
    }


    public function deleteColorInModal($dataId) {
        
        $sqlQuery= "UPDATE colors
                    SET isDeleted = 1
                    WHERE id = $dataId";
    
        $query = $this->db->query($sqlQuery);

        if ($query) {
            $result = 1;
        } else {
            $result = -1;
        }
        return $result;
    }


    public function displaySizeToEdit($dataId){
        
        $sqlQuery = "SELECT * FROM sizes
                     Where isDeleted = 0 and id = $dataId";

        $query = $this->db->query($sqlQuery);
        if ($query) {
            $result = $query->result();
        } else {
            $result = -1;
        }
        return $result;
    }

    public function displayColorToEdit($dataId){
        
        $sqlQuery = "SELECT * FROM colors
                     Where isDeleted = 0 and id = $dataId";

        $query = $this->db->query($sqlQuery);
        if ($query) {
            $result = $query->result();
        } else {
            $result = -1;
        }
        return $result;
    }

    
    // -- -- -- -- -- # # -- -- -- -- -- //
    public function submitColorAdd($colorNameToAddInModal)
    {
        $colorNameToAddInModal = $this->db->escape($colorNameToAddInModal);

        $sqlQuery ="INSERT INTO `colors`(`colorName`)
                    VALUES ($colorNameToAddInModal)";
        $query = $this->db->query($sqlQuery);
        $lastId = $this->db->insert_id();

        if ($query) {
            $result = $lastId;
        } else {
            $result = -1;
        }

        return $result;
    }


    // -- -- -- -- -- # # -- -- -- -- -- //
	// -- -- -- -- -- # # -- -- -- -- -- //
    public function submitColorEdit($colorIdHidden, $colorNameToAddInModal)
    {
    
        $colorNameToAddInModal = $this->db->escape($colorNameToAddInModal);

        $sqlQuery = "UPDATE `colors` 
                    SET `colorName`= $colorNameToAddInModal
                    WHERE `id` = $colorIdHidden";
        $query = $this->db->query($sqlQuery);

        if ($query) {
            $result = -2;
        } else {
            $result = -1;
        }

        return $result;
    }

	// -- -- -- -- -- # # -- -- -- -- -- //
    public function uploadImagesInEdit($name, $itemId, $extension, $itemColor, $barcode)
    {
        $name = $this->db->escape($name);
        $extension = $this->db->escape($extension);
        $itemId = $this->db->escape($itemId);
        $barcode = $this->db->escape($barcode);
        $itemColor = $this->db->escape($itemColor);

        // $sql = "INSERT INTO itemimage (`attachmentName`, `itemId` ,`attachmentExt`)
        //         VALUES ($name, $itemId, $extension)";
        // $query = $this->db->query($sql);
        $sql1 = "SELECT * FROM item
                 Where isDeleted = 0 and barCode = $barcode and color = $itemColor";
        $query1 = $this->db->query($sql1);
        $result = $query1->result();
        for ($i=0; $i < count($result); $i++) { 
            $id = $result[$i]->id ;
            $sql = "INSERT INTO itemimage (`attachmentName`, `itemId` ,`attachmentExt`)
                    VALUES ($name, $id, $extension)";
            $query = $this->db->query($sql);
        }


        if ($query) {
            return $this->db->insert_id();
        } else {
          return 0;
        }
    }

    public function getItemImages($itemId){
        $itemId = $this->db->escape($itemId);

        $sqlQuery = "SELECT * FROM itemimage
                     Where isDeleted = 0 and itemId = $itemId
                     ORDER BY `id` DESC";

        $query = $this->db->query($sqlQuery);
        if ($query) {
            $result = $query->result();
        } else {
            $result = -1;
        }
        return $result;
    }


    public function editItemInLogin($itemId, $itemName, $itemDescription, $itemBarCode, $itemCategory, $itemPrice, $itemQuantity, $itemSize, $itemColor, $oldBarCode, $saleToAddToEdit) {
        $itemName = $this->db->escape($itemName);
        $itemDescription = $this->db->escape($itemDescription);
        $itemSize = $this->db->escape($itemSize);
        $itemColor = $this->db->escape($itemColor);
        $itemBarCode = $this->db->escape($itemBarCode);
        $oldBarCode = $this->db->escape($oldBarCode);
        $saleToAddToEdit = $this->db->escape($saleToAddToEdit);
        
        $sqlQuery= "UPDATE item
                    SET itemName = $itemName, itemDescription = $itemDescription, barCode = $itemBarCode, categoryItems = $itemCategory, price = $itemPrice, sale = $saleToAddToEdit
                    WHERE barCode = $oldBarCode";
        $query = $this->db->query($sqlQuery);
        $sqlQuery1= "UPDATE item
                    SET color = $itemColor, size = $itemSize, quantity = $itemQuantity
                    WHERE id = $itemId";
        $query1 = $this->db->query($sqlQuery1);
        $sqlQuery2= "UPDATE itemimage
                    SET barCode = $itemBarCode
                    WHERE barCode = $oldBarCode";
        $query2 = $this->db->query($sqlQuery2);
        $sqlQuery3= "UPDATE cart
                    SET itemBarCode = $itemBarCode
                    WHERE itemBarCode = $oldBarCode";
        $query3 = $this->db->query($sqlQuery3);
        if ($query) {
            $result = 1;
        } else {
            $result = -1;
        }
        return $result;
    }


    //..............GET DATA SECTION.............//
    public function categoryToDisplay($category) {
        $sqlQuery = "SELECT * FROM item
                     Where isDeleted = 0 and quantity > 0 and  categoryItems = $category and archive < 1 and storage < 1 and exported < 1 and summerCollection = 0 and winterCollection =0
                     ORDER BY id DESC";
        $query = $this->db->query($sqlQuery);
        $items = $query->result();
        $itemsArray= [];
        for ($i=0; $i < count($items); $i++) { 
            $imagesArray=[];
            $id = $items[$i]->id;
            $price = $items[$i]->price;
            $itemSize = $items[$i]->size;
            $barCode = $items[$i]->barCode;
            $sale = $items[$i]->sale;
            $barCode = $this->db->escape($barCode);

            $itemName = $items[$i]->itemName;
            $quantity = $items[$i]->quantity;
            $itemDescription = $items[$i]->itemDescription;
            $sqlQuery1 = "SELECT * FROM itemimage
                          Where isDeleted = 0 and itemId = $id";
            $query1 = $this->db->query($sqlQuery1);
            $images = $query1->result();
            for ($j=0; $j < count($images); $j++) { 
                $imageExt = $images[$j]->attachmentExt;
                $imageId = $images[$j]->id;
                $mainPage = $images[$j]->mainPage;
                array_push($imagesArray,array($imageExt, $imageId, $mainPage));
            }   
            array_push($itemsArray,array($id, $price, $itemSize, $barCode, $itemName, $quantity, $itemDescription, $imagesArray, $sale));
        }
        if ($query) {
            $result = $itemsArray;
        } else {
            $result = -1;
        }
        return $result;
    }


    public function displayItemModal($itemId, $itemName, $productCode) {
        $itemName = $this->db->escape($itemName);
        if($itemName == -1){
            $productCode = $this->db->escape($productCode);
        }
        $sqlQuery = "SELECT * FROM item
                     Where isDeleted = 0 and barCode = $productCode and quantity > 0 and archive < 1 and storage < 1  and exported < 1  and summerCollection = 0 and winterCollection =0
                     ORDER BY color ASC , id ASC";
        $query = $this->db->query($sqlQuery);
        $sizeArray = [];
        $colorArray = [];
        $itemsData = $query->result();
        $colorSection = "";
        if($query->num_rows()>0){
            for ($i=0; $i < $query->num_rows(); $i++) {
                if($i == 0 &&  $query->num_rows() -1 != 0){
                    // HA LA AWAL ROW W TKOUN MANA LAST 
                    $colorSection = $itemsData[$i]->color;
                    $size = $itemsData[$i]->size;
                    array_push($sizeArray,$size);
                }elseif($i == 0 && $i == $query->num_rows() -1 ){
                    // EZA BASS FI ONE ROW ONE COLOR 
                    $color = $itemsData[$i]->color;
                    $colorSection = $itemsData[$i]->color;
                    $size = $itemsData[$i]->size;
                    array_push($sizeArray,$size);
                    array_push($colorArray, array($colorSection, $sizeArray));
                }
                elseif($i == $query->num_rows() -1  && $i != 0){
                    // EZA HA LAST ROW  W MANA FIRST ROW 
                    $color = $itemsData[$i]->color;
                    if($color == $colorSection){
                        $size = $itemsData[$i]->size;
                        array_push($sizeArray,$size);
                        array_push($colorArray, array($colorSection, $sizeArray));

                    }else{
                        array_push($colorArray, array($colorSection, $sizeArray));
                        $sizeArray = [];
                        $colorSection = $itemsData[$i]->color;
                        $size = $itemsData[$i]->size;
                        array_push($sizeArray,$size);
                        array_push($colorArray, array($colorSection, $sizeArray));

                    }
                }else{
                    $color = $itemsData[$i]->color;
                    if($color == $colorSection){
                        $size = $itemsData[$i]->size;
                        array_push($sizeArray,$size);
                    }else{
                        array_push($colorArray, array($colorSection, $sizeArray));
                        $sizeArray = [];
                        $colorSection = $itemsData[$i]->color;
                        $size = $itemsData[$i]->size;
                        array_push($sizeArray, $size);
                    }
                }
            }
        }
        $barCode = $itemsData[0]->barCode;
        $barCode = $this->db->escape($barCode);

        $sqlQuery1="SELECT * FROM itemimage
                    Where isDeleted = 0 and itemId =$itemId
                    ORDER BY `mainPage` DESC";
        $query1 = $this->db->query($sqlQuery1);
        
        if ($query) {
            $result = $query->result();
        } else {
            $result = -1;
        }
        return array($result, $sizeArray, $query1->result(), $colorArray);
    }


    public function deleteItemImagesInItems($itemImageIdToDeleteAttach) {
        
        $sqlQuery= "UPDATE itemimage
                    SET isDeleted = 1
                    WHERE id = $itemImageIdToDeleteAttach";
    
        $query = $this->db->query($sqlQuery);

        if ($query) {
            $result = 1;
        } else {
            $result = -1;
        }
        return $result;
    }



    
    public function displayCardigan() {
        $sqlQuery = "SELECT * FROM item
                     Where isDeleted = 0 and quantity > 0 and archive < 1 and exported < 1 and storage < 1  and categoryItems = 5  and summerCollection = 0 and winterCollection =0
                     ORDER BY id Desc";
        $query = $this->db->query($sqlQuery);
        $items = $query->result();
        $itemsArray= [];
        for ($i=0; $i < count($items); $i++) { 
            $imagesArray=[];
            $id = $items[$i]->id;
            $price = $items[$i]->price;
            $itemSize = $items[$i]->size;
            $barCode = $items[$i]->barCode;
            $sale = $items[$i]->sale;
            $barCode = $this->db->escape($barCode);

            $itemName = $items[$i]->itemName;
            $quantity = $items[$i]->quantity;
            $itemDescription = $items[$i]->itemDescription;
            $sqlQuery1 = "SELECT * FROM itemimage
                          Where isDeleted = 0 and itemId = $id";
            $query1 = $this->db->query($sqlQuery1);
            $images = $query1->result();
            for ($j=0; $j < count($images); $j++) { 
                $imageExt = $images[$j]->attachmentExt;
                $imageId = $images[$j]->id;
                $mainPage = $images[$j]->mainPage;
                array_push($imagesArray,array($imageExt, $imageId, $mainPage));

            }   
            array_push($itemsArray,array($id, $price, $itemSize, $barCode, $itemName, $quantity, $itemDescription, $imagesArray, $sale));
        }
        if ($query) {
            $result = $itemsArray;
        } else {
            $result = -1;
        }
        return $result;
    }
    

    // ----------------------------------------------------------- //
    public function createAccount($emailMainPage, $passwordMainPage)
    {
        $emailMainPage = $this->db->escape($emailMainPage);
        $passwordMainPage = $this->db->escape($passwordMainPage);
        $sqlQuery1 = "SELECT * FROM users
                        Where is_deleted = 0 and email = $emailMainPage";
        $query1 = $this->db->query($sqlQuery1);
        if($query1->num_rows() < 1){
            $sqlQuery = "INSERT INTO `users`(`email`, `password`, `created_on`, `user_type`)
                            VALUES($emailMainPage, $passwordMainPage, NOW(), 2)";
            $query = $this->db->query($sqlQuery);
            return $this->db->insert_id();
        }else{
            return -1 ;
        }
    
    }


    public function editProfile($userId, $firstName, $lastName, $phoneNumber, $description){
        $firstName = $this->db->escape($firstName);
        $lastName = $this->db->escape($lastName);
        $phoneNumber = $this->db->escape($phoneNumber);
        $description = $this->db->escape($description);
        
        $sqlQuery= "UPDATE users
                    SET fname = $firstName, lname = $lastName,  phoneNumber = $phoneNumber, `description` = $description
                    WHERE id = $userId";
        $query = $this->db->query($sqlQuery);

        if ($query) {
            $result = 1;
        } else {
            $result = -1;
        }
        return $result;
    }


    public function addToCart($itemBarCode, $itemSize, $quantity, $userId, $color){
        $itemSize = $this->db->escape($itemSize);
        $itemBarCode = $this->db->escape($itemBarCode);
        $color = $this->db->escape($color);
        $sqlQuery2 = "SELECT * FROM item
                      WHERE  barCode = $itemBarCode and size = $itemSize and color = $color and isDeleted = 0 and archive = 0 and exported = 0 and summerCollection = 0 and winterCollection =0";
        $query2 = $this->db->query($sqlQuery2);
        $itemRow = $query2->row();
        $barCodeToPrint = $itemRow->id;
        $barCodeToPrint = $this->db->escape($barCodeToPrint);
        // barCodeToPrint is item ID 

        $sqlQuery = "SELECT * FROM cart
                     WHERE userId = $userId and itemBarcodeToPrint = $barCodeToPrint and isPurchased = 0 and cartId =0";
        $query = $this->db->query($sqlQuery);
        if($query->num_rows() > 0){
            $sqlQuery1 = "UPDATE `cart` 
                          SET quantity =  quantity + $quantity
                          WHERE userId = $userId and itemBarcodeToPrint = $barCodeToPrint and isPurchased = 0 and cartId =0";
            $query1 = $this->db->query($sqlQuery1);
        }else{
            $sqlQuery1 = "INSERT INTO cart (userId, itemBarCode, itemSize, quantity, color, itemBarcodeToPrint)
                          VALUES ($userId, $itemBarCode, $itemSize, $quantity, $color, $barCodeToPrint)";
            $query1 = $this->db->query($sqlQuery1);
        }
        if ($query1) {
            $result= 1;
        }else{
            $result= -1;
        }
        return $result;
    }


    public function drawCart($userId) {
        $sqlQuery = "SELECT * FROM cart
                     Where userId = $userId and isPurchased = 0 and cartId =0";
        $query = $this->db->query($sqlQuery);
        $allItemsArray = [];
        if($query->num_rows()>0){
            $cartItems = $query->result();
            for ($i=0; $i < count($cartItems); $i++) { 
                $itemBarCode = $cartItems[$i]->itemBarCode;
                $itemBarCode = $this->db->escape($itemBarCode);

                $itemSize = $cartItems[$i]->itemSize;
                $itemSize = $this->db->escape($itemSize);
                $quantity = $cartItems[$i]->quantity;
                $idInCart = $cartItems[$i]->id;
                $colorInCart = $cartItems[$i]->color;
                $colorInCart = $this->db->escape($colorInCart);
                $itemId = $cartItems[$i]->itemBarcodeToPrint;

                $sqlQuery1 = "SELECT * FROM item
                              Where isDeleted = 0 and id = $itemId ";
                $query1 = $this->db->query($sqlQuery1);
                $itemData = $query1->result();
                if($query1->num_rows()>0){
                    $itemId = $itemData[0]->id;
                    $itemName = $itemData[0]->itemName;
                    $itemPrice = $itemData[0]->price;
                    $sale = $itemData[0]->sale;
                    $sqlQuery2 = "SELECT * FROM itemimage
                                  Where isDeleted = 0 and itemId = $itemId";
                    $query2 = $this->db->query($sqlQuery2);
                    $itemImages = $query2->result();
                    $imagesArray= [];
                    for ($j=0; $j < count($itemImages); $j++) { 
                        $imageExt = $itemImages[$j]->attachmentExt;
                        $imageId = $itemImages[$j]->id;
                        $mainPage = $itemImages[$j]->mainPage;
                        array_push($imagesArray,array($imageExt, $imageId, $mainPage));
                    } 
                    $attachmentName = $itemImages[0]->id;
                    $attachmentExt = $itemImages[0]->attachmentExt;
                    array_push($allItemsArray,array($itemBarCode, $itemSize, $quantity, $itemId, $itemPrice, $attachmentName, $attachmentExt, $itemName, $idInCart, $colorInCart, $sale, $imagesArray));
                }
            }
        }
        if ($query->num_rows()>0) {
            $result = array($allItemsArray);
        } else {
            $result = -1;
        }
        return $result;
    }

    public function removeItemFromCart($itemId){
        $sqlQuery = "DELETE FROM cart WHERE id =$itemId";     
        $query = $this->db->query($sqlQuery);
        if ($query) {
            $result= 1;
        }
        else{
            $result= -1;
        }

        return $result;
    }

    public function changeItemQuantityFromCart($itemId, $quantity){
        $sqlQuery = "UPDATE cart
                     SET quantity= $quantity 
                     WHERE id = $itemId";     
        $query = $this->db->query($sqlQuery);
        if ($query) {
            $result= 1;
        }
        else{
            $result= -1;
        }

        return $result;
    }

    public function drawTotalInPurchaseCartModal($userId){
        $sqlQuery = "SELECT * FROM cart
                     Where userId = $userId and isPurchased = 0 and cartId =0";    
        $query = $this->db->query($sqlQuery);
        $itemThatAreSoldOut=[];
        if ($query) {
            $total = 0;
            $cartInfo = $query->result();
            for ($i=0; $i < count($cartInfo); $i++) { 
                $quantity = $cartInfo[$i]->quantity;
                $itemBarCode = $cartInfo[$i]->itemBarCode;
                $itemColor = $cartInfo[$i]->color;
                $itemSize = $cartInfo[$i]->itemSize;
                $itemBarcodeToPrint = $cartInfo[$i]->itemBarcodeToPrint;
                $itemBarcodeToPrint = $this->db->escape($itemBarcodeToPrint);
                $itemSize = $this->db->escape($itemSize);
                $itemColor = $this->db->escape($itemColor);
                $itemBarCode = $this->db->escape($itemBarCode);
                
                $sqlQuery1 = "SELECT * FROM item
                              Where  isDeleted = 0 AND quantity >= $quantity and id = $itemBarcodeToPrint
                              LIMIT 1";  
                               
                $query1 = $this->db->query($sqlQuery1);
                $priceOfQuery = $query1->result();
                if($query1->num_rows() == 0){
                    $sqlQuery2 = "SELECT * FROM item
                                  Where  isDeleted = 0 and id = $itemBarcodeToPrint
                                  LIMIT 1";  
                    $query2 = $this->db->query($sqlQuery2);
                    $priceOfQuery2 = $query2->result();
                    $itemName = $priceOfQuery2[0]->itemName;
                    $size = $priceOfQuery2[0]->size;
                    $color = $priceOfQuery2[0]->color;
                    $quantityLeft = $priceOfQuery2[0]->quantity;
                    array_push($itemThatAreSoldOut,array($itemName, $size, $color, $quantityLeft));
                }else{
                    $price = $priceOfQuery[0]->price - ($priceOfQuery[0]->price * $priceOfQuery[0]->sale / 100);
                    $total = $total + ($price * intval($quantity));
                }
            }
            $result= $total + 4;
        }
        else{
            $result= -1;
        }

        return array($result, $itemThatAreSoldOut);
    }

    public function getUserInfoForCart($userId){

        // to check item eza 5ales aw la2 
        $sqlQuery = "SELECT * FROM users
                     Where id = $userId and is_deleted = 0";    
        $query = $this->db->query($sqlQuery);
        $result = $query->result();
        return $result;
    }
    

    public function purchaseCart($userId, $name, $telephone, $address, $city, $state, $zipCode, $localShippingFlag){
        $name = $this->db->escape($name);
        $address = $this->db->escape($address);
        $telephone = $this->db->escape($telephone);
        $city = $this->db->escape($city);
        $state = $this->db->escape($state);
        $zipCode = $this->db->escape($zipCode);

        // to check item eza 5ales aw la2 
        $sqlQuery = "SELECT * FROM cart
                     Where userId = $userId and isPurchased = 0 and cartId = 0";    
        $query = $this->db->query($sqlQuery);
        $itemThatAreSoldOut=[];
        if ($query) {
            $total = 0;
            $cartInfo = $query->result();
            for ($i=0; $i < count($cartInfo); $i++) { 
                $quantity = $cartInfo[$i]->quantity;
                $itemBarCode = $cartInfo[$i]->itemBarCode;
                $itemColor = $cartInfo[$i]->color;
                $itemSize = $cartInfo[$i]->itemSize;
                $itemBarcodeToPrint = $cartInfo[$i]->itemBarcodeToPrint;
                $itemBarcodeToPrint = $this->db->escape($itemBarcodeToPrint);
                $itemSize = $this->db->escape($itemSize);
                $itemColor = $this->db->escape($itemColor);
                $itemBarCode = $this->db->escape($itemBarCode);
                
                $sqlQuery1 = "SELECT * FROM item
                              Where  isDeleted = 0 AND quantity >= $quantity and id = $itemBarcodeToPrint
                              LIMIT 1";  
                                
                $query1 = $this->db->query($sqlQuery1);
                $priceOfQuery = $query1->result();
                if($query1->num_rows() == 0){
                    $sqlQuery2 = "SELECT * FROM item
                                    Where  isDeleted = 0 and id = $itemBarcodeToPrint
                                    LIMIT 1";  
                    $query2 = $this->db->query($sqlQuery2);
                    $priceOfQuery2 = $query2->result();
                    $itemName = $priceOfQuery2[0]->itemName;
                    $size = $priceOfQuery2[0]->size;
                    $color = $priceOfQuery2[0]->color;
                    $quantityLeft = $priceOfQuery2[0]->quantity;
                    array_push($itemThatAreSoldOut,array($itemName, $size, $color, $quantityLeft));
                    
                }
            }


            if(count($itemThatAreSoldOut) < 1){

                // end off checking 
                $sqlQuery = "INSERT INTO cartpurchased (`name`, `address`, `number`, `date`, `userId`, `city`, `state`, `zip_code`, `localShipping`, cartNature)
                             VALUES ($name, $address, $telephone, DATE_ADD(NOW(), INTERVAL 9 HOUR), $userId, $city , $state, $zipCode, $localShippingFlag, 'normal')"; 
                $query = $this->db->query($sqlQuery);
                $lastInsertedId = $this->db->insert_id();

                $sqlQuery1 = "SELECT * FROM cart
                              Where userId = $userId and isPurchased = 0 and cartId = 0";    
                $query1 = $this->db->query($sqlQuery1);
                $cartInfo = $query1->result();
                $total = 0;
                $totalOfItemsNotOnSale = 0;
                $totalOfItemsThatAreOnSale = 0;
                $totalWeight = 0;
                $totalQuantity = 0;
                $numberOfItemsNotOnSale= 0;
                $numberOfPyjamas= 0;
                $specialOfferFlag = -1;
            
                for ($i=0; $i < count($cartInfo); $i++) { 
                    $cartId = $cartInfo[$i]->id;
                    $quantity = $cartInfo[$i]->quantity;
                    $itemBarCode = $cartInfo[$i]->itemBarCode;
                    $itemColor = $cartInfo[$i]->color;
                    $itemSize = $cartInfo[$i]->itemSize;
                    $itemBarcodeToPrint = $cartInfo[$i]->itemBarcodeToPrint;
                    $itemSize = $this->db->escape($itemSize);
                    $itemColor = $this->db->escape($itemColor);
                    $itemBarCode = $this->db->escape($itemBarCode);
                    $itemBarcodeToPrint = $this->db->escape($itemBarcodeToPrint);
                    $queryToMakeCartPurchased = "UPDATE cart
                                                 SET isPurchased = 2 , cartId = $lastInsertedId
                                                 WHERE id = $cartId";   
                    $queryToMakeCartPurchasedRun = $this->db->query($queryToMakeCartPurchased);
                    $sqlQuery4 = "UPDATE  item
                                  SET quantity = quantity - $quantity 
                                  WHERE isDeleted = 0 and id = $itemBarcodeToPrint";  
                    $query4 = $this->db->query($sqlQuery4);

                    $sqlQuery2 = "SELECT * FROM item
                                  Where isDeleted = 0 and id = $itemBarcodeToPrint
                                  LIMIT 1";  
                    $query2 = $this->db->query($sqlQuery2);
                    $itemQuery = $query2->result();
                    $weight = $itemQuery[0]->weight;
                    $newCollection = $itemQuery[0]->newCollection;
                    $price = $itemQuery[0]->price - ($itemQuery[0]->price * $itemQuery[0]->sale / 100);
                    $priceForPurchasedItems = $price;

                    $total = $total + ($price * intval($quantity));
                    if($itemQuery[0]->sale < 0.1  ){
                        $totalOfItemsNotOnSale = $totalOfItemsNotOnSale + ($price * intval($quantity));
                        $numberOfItemsNotOnSale = $numberOfItemsNotOnSale + intval($quantity);
                    }
                    
                    
                    $totalWeight = $totalWeight + ($weight * intval($quantity));
                    $totalQuantity = $totalQuantity + intval($quantity);
                    $sqlQuery5 = "INSERT INTO purchaseditems (`date`, `userId`, `quantity`, `price`, barCodeToPrint, localOrNot, currency)
                                  VALUES (NOW(), $userId, $quantity, $priceForPurchasedItems, $itemBarcodeToPrint, 1, 1)"; 
                    $query5 = $this->db->query($sqlQuery5);
                }
                $totalOfItemsThatAreOnSale = $total - $totalOfItemsNotOnSale;
                
                if ($specialOfferFlag  == -1){
                        // ha la international need to add shipping
                        $total = $total + 4;
                }else{
                        // ha la international need to add shipping
                        $total = $total ;
                }
                
                $sqlQuery66 = "UPDATE  cartpurchased
                               SET totalAmount = $total
                               Where isDeleted = 0 and id = $lastInsertedId";
                $query66 = $this->db->query($sqlQuery66);
                $returnResult= array($total, $totalWeight, $totalQuantity);
                return $returnResult;

            }else{
                return -1;
            }
           
        }else{
            return -1;
        }
    }



    
    public function getCartsData($selectValues, $fromDate, $toDate){

        $myArray = explode(',', $selectValues);
        if (in_array(1, $myArray)) {
            $sqlQuery = "SELECT * FROM cartpurchased
                          Where isDeleted = 0";    
        }else{
            $sqlQuery = "SELECT * FROM cartpurchased
            Where isDeleted = 0";   
            if (in_array(2, $myArray)){
                $sqlQuery .= " and ";
                $sqlQuery .= " octopus  = 1 || topspeed = 1 and pending  = 0 ";
            }
            if (in_array(3, $myArray)){
                $sqlQuery .= " and ";
                $sqlQuery .= " submittedOrNot  = 1 and pending  = 0  ";

            }
            if (in_array(4, $myArray)){
                $sqlQuery .= " and ";
                $sqlQuery .= " collected  = 1 and pending  = 0 ";
            }
            if (in_array(5, $myArray)){
                $sqlQuery .= " and ";
                $sqlQuery .= " octopus  = 0 and topspeed = 0 and pending  = 0 " ;
            }
            if (in_array(6, $myArray)){
                $sqlQuery .= " and ";
                $sqlQuery .= " submittedOrNot  = 0 and pending  = 0 ";
            }
            if (in_array(7, $myArray)){
                $sqlQuery .= " and ";
                $sqlQuery .= " collected  = 0 and pending  = 0 ";
            }
            if (in_array(8, $myArray)){
                $sqlQuery .= " and ";
                $sqlQuery .= " restockedItem  = 0 and cartNature = 'replacement' and pending  = 0 ";
            }
            if (in_array(9, $myArray)){
                $sqlQuery .= " and ";
                $sqlQuery .= " pending  = 1 ";
            }
        }
        if($fromDate != "" and $toDate !=""){
            $fromDate = date("Y-m-d H:i:s",strtotime($fromDate));
            $fromDate = $this->db->escape($fromDate);

            $toDate = date("Y-m-d H:i:s",strtotime($toDate));
            $toDate = $this->db->escape($toDate);
            $sqlQuery .= " and (date between $fromDate and $toDate ) ";
        }
        $sqlQuery .= " ORDER BY id DESC LIMIT 2000";
   
        $query = $this->db->query($sqlQuery);
      
        if ($query) {
            $result= $query->result();
        }
        else{
            $result= -1;
        }
        return $result;
    }



    
    public function displayCarts($cartId){
        $sqlQuery = "SELECT * FROM cart
                     Where isPurchased = 2 and cartId = $cartId";   
        $query = $this->db->query($sqlQuery);

        $sqlToGetNumber = "SELECT * FROM cartpurchased
                           Where  id = $cartId and isDeleted = 0"; 
        $queryToGetNumber = $this->db->query($sqlToGetNumber);
        $purchasedCartInfo = $queryToGetNumber->row();
        $number = $purchasedCartInfo->number;
        $userName = $purchasedCartInfo->name;
        $discountPercentage = $purchasedCartInfo->discountPercentage;
        $cartItems = $query->result();
        $array=[];
        for ($i=0; $i < count($cartItems); $i++) { 
            $itemBarCode = $cartItems[$i]->itemBarCode;
            $barCodeWithoutescape = $cartItems[$i]->itemBarCode;
            $quantity = $cartItems[$i]->quantity;
            $itemSize = $cartItems[$i]->itemSize;
            $cartId = $cartItems[$i]->id;
            $color = $cartItems[$i]->color;
            $barCodeToPrint = $cartItems[$i]->itemBarcodeToPrint;
            $itemBarCode = $this->db->escape($itemBarCode);

            $sqlQuery4 = "SELECT * FROM itemimage
                          Where isDeleted = 0 and barCode = $itemBarCode
                          ORDER BY `id` ASC";
            $query4 = $this->db->query($sqlQuery4);
            $imageInfo = $query4->result();
            
            $sqlQuery2 = "SELECT DISTINCT * FROM  item
                          WHERE id = $barCodeToPrint and isDeleted = 0";   
            $query2 = $this->db->query($sqlQuery2);
            $itemInfo = $query2->result();

            // $attachmentName = $imageInfo[0]->id;
            // $attachmentExt = $imageInfo[0]->attachmentExt;
            $attachmentExt = "empty";
            $attachmentName = "empty";
            $itemName = $itemInfo[0]->itemName;
            $OriginalPrice = $itemInfo[0]->price;
            $itemId = $itemInfo[0]->id;
            $newCollection = $itemInfo[0]->newCollection;
            $sale = $itemInfo[0]->sale;
            $stockLeft = $itemInfo[0]->quantity;
            $userId ="0";
            array_push($array,array($barCodeWithoutescape, $itemSize, $quantity, $OriginalPrice, $itemName, $attachmentName, $attachmentExt, $userId, $itemId, $color, $cartId, $number, $userName, $newCollection, $barCodeToPrint, $sale, $OriginalPrice, $discountPercentage, $stockLeft));
        }
        // get tracking number 
        // $sqlGettopSpeedTrackingNumber = "SELECT topSpeedTrackingNumber,extraInLbp FROM cartpurchased
        //                                  Where  userId = $userId and isDeleted = 0";    
                     
        // $queryToGettopSpeedTrackingNumber = $this->db->query($sqlGettopSpeedTrackingNumber);
        // $queryToGettopSpeedTrackingNumber = $queryToGettopSpeedTrackingNumber->row();
        // $topSpeedTrackingNumber = $queryToGettopSpeedTrackingNumber->topSpeedTrackingNumber;
        // $extraInLbp = $queryToGettopSpeedTrackingNumber->extraInLbp;
        // end get tracking number 

        // get replacement items 
        // $sqlGetReplacement = "SELECT replacementcartitems.* , item.itemName, item.barCode, item.size, item.quantity as stockLeft, item.newCollection , item.sale FROM replacementcartitems
        //                       LEFT JOIN item ON replacementcartitems.barCodeToPrint = item.barCodeToPrint  
        //                       Where replacementcartitems.userId = $userId";   
        // $queryGetReplacement = $this->db->query($sqlGetReplacement);
        // $replacementItems = $queryGetReplacement->result();
        // end get replacement items 
        $topSpeedTrackingNumber = "0";
        $replacementItems = "0";
        $extraInLbp = "0";
        if ($query) {
            $result= array($array, $topSpeedTrackingNumber, $replacementItems, $extraInLbp);
        }
        else{
            $result= -1;
        }
        return $result;
    }


    public function changeTopSpeedIcon($cartId){
        $sqlQuery = "UPDATE cartpurchased
                         SET topspeed = CASE 
                                            WHEN topspeed = 0 then 1
                                            WHEN topspeed = 1 then 0
                                        END
                         WHERE  isDeleted =0  and id = $cartId";
            $query=$this->db->query($sqlQuery);  
            if($query){
                $result =1;
            }else{
                $result = -1;
            }
            return $result;
    }


    public function changePendingIcon($cartId){
        $sqlQuery = "UPDATE cartpurchased
                     SET pending = CASE 
                                    WHEN pending = 0 then 1
                                    WHEN pending = 1 then 0
                                   END
                     WHERE  isDeleted =0  and id = $cartId";
            $query=$this->db->query($sqlQuery);  
            if($query){
                $result =1;
            }else{
                $result = -1;
            }
            return $result;
    }

//........................LAST ONE..............................//
}

    
