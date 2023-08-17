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
                     Where isDeleted = 0 and categoryItems = $category and archive < 1 and storage < 1 and exported < 1 and summerCollection = 0 and winterCollection =0
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

    
//........................LAST ONE..............................//
}

    
