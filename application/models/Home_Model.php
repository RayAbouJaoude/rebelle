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
        $sqlQuery = "INSERT INTO item (itemName, itemDescription, quantity, barCode, categoryItems, size, price, isDeleted, color, `weight`,initialQuantity, exported)
                     VALUES ($itemNameToAdd , $itemDescriptionToAdd, $itemQuantityToAdd , $itemBarCodeToAdd, $itemCategoryToAdd , $itemSizeToAdd, $itemPriceToAdd, 0, $colorToAdd, $itemWeightToAdd,$itemQuantityToAdd, 1)"; 
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
    
                $sqlQuery1 = "INSERT INTO item (itemName, itemDescription, quantity, barCode, categoryItems, size, price, isDeleted, color, `weight`, initialQuantity, exported)
                              VALUES ($itemNameToAdd , $itemDescriptionToAdd, $quantityyy , $itemBarCodeToAdd, $itemCategoryToAdd , $sizeee, $itemPriceToAdd, 0, $colorr, $itemWeightToAdd, $quantityyy, 1)"; 
                $query1 = $this->db->query($sqlQuery1);
                $lastInsertedId = $this->db->insert_id();
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

    // ----------------------------------------------------------- //
    public function submitPropertyAdd($userId, $propertyAddress, $propertyTitle, $propertyDescription, $propertyPrice, $propertyListingStatus, $propertyZipcode, $propertyLotSize, $propertySaleOrRent, $propertyYearBuilt, $propertyNumberOfBedrooms, $longitude, $latitude)
    {   
        $propertyYearBuilt = date("Y-m-d",strtotime($propertyYearBuilt));
        $propertyYearBuilt = $this->db->escape($propertyYearBuilt);
        $propertyAddress = $this->db->escape($propertyAddress);

        $propertyDescription = $this->db->escape($propertyDescription);
        $propertyPrice = $this->db->escape($propertyPrice);
        $propertyListingStatus = $this->db->escape($propertyListingStatus);
        $propertyZipcode = $this->db->escape($propertyZipcode);
        $propertyLotSize = $this->db->escape($propertyLotSize);
        $propertySaleOrRent = $this->db->escape($propertySaleOrRent);
        $propertyNumberOfBedrooms = $this->db->escape($propertyNumberOfBedrooms);
        $propertyTitle = $this->db->escape($propertyTitle);
        $longitude = floatval($longitude);
        $latitude = floatval($latitude);
        $sqlQuery = "INSERT INTO property (title, `description`, price, lotSize, numberOfBedrooms, `address`, zipCode, yearBuilt, saleOrRent, listingStatus, userId, longitude, latitude)
                     VALUES ($propertyTitle , $propertyDescription, $propertyPrice, $propertyLotSize, $propertyNumberOfBedrooms , $propertyAddress, $propertyZipcode , $propertyYearBuilt, $propertySaleOrRent, $propertyListingStatus, $userId, $longitude, $latitude)"; 
        $query = $this->db->query($sqlQuery);
        $lastInsertedId = $this->db->insert_id();

        if ($query) {
            $result = $lastInsertedId;
        }else{
            $result= -1;
        }
        return $result;
    }

    // ----------------------------------------------------------- //
    public function submitPropertyEdit($userId, $propertyAddress, $propertyTitle, $propertyIdHidden, $propertyDescription, $propertyPrice, $propertyListingStatus, $propertyZipcode, $propertyLotSize, $propertySaleOrRent, $propertyYearBuilt, $propertyNumberOfBedrooms, $longitude, $latitude)
    {
        $propertyYearBuilt = date("Y-m-d",strtotime($propertyYearBuilt));
        $propertyYearBuilt = $this->db->escape($propertyYearBuilt);
        $propertyAddress = $this->db->escape($propertyAddress);
        $propertyDescription = $this->db->escape($propertyDescription);
        $propertyPrice = $this->db->escape($propertyPrice);
        // $propertyListingStatus = $this->db->escape($propertyListingStatus);
        $propertyZipcode = $this->db->escape($propertyZipcode);
        $propertyLotSize = $this->db->escape($propertyLotSize);
        $propertySaleOrRent = $this->db->escape($propertySaleOrRent);
        $propertyNumberOfBedrooms = $this->db->escape($propertyNumberOfBedrooms);
        $propertyTitle = $this->db->escape($propertyTitle);
        $longitude = floatval($longitude);
        $latitude = floatval($latitude);
        $sqlQuery= "UPDATE property
                    SET `title` = $propertyTitle, `description` = $propertyDescription, `price` = $propertyPrice, `lotSize` = $propertyLotSize, `numberOfBedrooms` = $propertyNumberOfBedrooms,
                        `address` = $propertyAddress, `zipCode` = $propertyZipcode, `yearBuilt` = $propertyYearBuilt, `saleOrRent` = $propertySaleOrRent,`userId` = $userId,
                         longitude = $longitude, latitude = $latitude
                    WHERE id = $propertyIdHidden and isDeleted = 0";
        $query = $this->db->query($sqlQuery);

        if ($query) {
            $result = $propertyIdHidden;
        }else{
            $result= -1;
        }
        return $result;
    }

    // ----------------------------------------------------------- //
    public function getAllPropertiesInBackEnd($userId){
        $sqlQuery = "SELECT *
                     FROM  property
                     WHERE isDeleted = 0   and userId = $userId
                     ORDER BY  title ASC ";
        $query = $this->db->query($sqlQuery);
        if ($query) {
           $result = $query->result();
          
        }else{
            $result= -1;
        }
        return $result;
    }

    // ----------------------------------------------------------- //
    public function getAllPropertiesForAdmin($userId){
        $sqlQuery = "SELECT property.*, users.fname, users.lname
                     FROM  property
                     LEFT JOIN  users ON users.id = property.userId
                     WHERE property.isDeleted = 0 and users.is_deleted = 0
                     ORDER BY  userId DESC ";
        $query = $this->db->query($sqlQuery);
        if ($query) {
           $result = $query->result();
          
        }else{
            $result= -1;
        }
        return $result;
    }

    // ----------------------------------------------------------- //
    public function statusIcon($isChecked, $dataId, $userId, $userFname){
        $statusState = 0;
        $msg ="";
        if(intval($isChecked) == 0){
            $statusState = 1;
            $msg = 'Accepted By '. $userFname ;
            $sqlQuery1 = "UPDATE property 
                          SET `accepted` = $statusState, userId = $userId, enteredDate = NOW()
                          WHERE id = $dataId";
        }elseif (intval($isChecked) == 1 ){
            $statusState = -1;
            $sqlQuery1 = "UPDATE property 
                          SET `accepted` = $statusState, userId = $userId
                          WHERE id = $dataId";
            $msg = 'Declined By '. $userFname ;

        }elseif(intval($isChecked) == -1 ){
            $statusState = 0;
            $sqlQuery1 = "UPDATE property 
                          SET `accepted` = $statusState, userId = $userId
                          WHERE id = $dataId";
            $msg = 'Not selected';
        }
        $query1 = $this->db->query($sqlQuery1);
        if($query1){
            return $msg;
        }else{
            return -1;
        }
    }

    // ----------------------------------------------------------- //
    public function displayPropertyToEdit($id){
        $sqlQuery= "SELECT * FROM property
                    WHERE isDeleted = 0 and id = $id";
        $query = $this->db->query($sqlQuery);
        if ($query) {
            $result = $query->row();
        }else{
            $result= -1;
        }
        return $result;
    }

    //-----------------------------------------------------------//
    public function getAllPropertiesForSale(){
        $sqlQuery = "SELECT property.*, users.fname, users.lname
                     FROM  property
                     LEFT JOIN  users ON users.id = property.userId
                     WHERE property.isDeleted = 0 and users.is_deleted= 0 and property.saleOrRent = 'sale' and property.accepted = 1
                     ORDER BY  userId DESC ";
        $query = $this->db->query($sqlQuery);
        if ($query) {
           $result = $query->result();
          
        }else{
            $result= -1;
        }
        return $result;
    }


    
    //--------------------------------------------------------//
    public function getAllPropertiesForRent(){
        $sqlQuery = "SELECT property.*, users.fname, users.lname
                     FROM  property
                     LEFT JOIN  users ON users.id = property.userId
                     WHERE property.isDeleted = 0 and users.is_deleted= 0 and property.saleOrRent = 'rent'  and property.accepted = 1
                     ORDER BY  userId DESC ";
        $query = $this->db->query($sqlQuery);
        if ($query) {
        $result = $query->result();
        
        }else{
            $result= -1;
        }
        return $result;
    }



    //-----------------------------------------------------------//
    public function deleteProperty($idToDelete){
        $sqlQuery= "UPDATE property
                    SET isDeleted = 1
                    WHERE id = $idToDelete";

        $query = $this->db->query($sqlQuery);
        if ($query) {
            $result = 1;
        } else {
            $result = -1;
        }
        return $result;
    }   


    //-----------------------------------------------------------//
    public function deletePropertyInAdmin($idToDelete){
        $sqlQuery= "UPDATE property
                    SET isDeleted = 1
                    WHERE id = $idToDelete";

        $query = $this->db->query($sqlQuery);
        if ($query) {
            $result = 1;
        } else {
            $result = -1;
        }
        return $result;
    }   



    //-----------------------------------------------------------//
    public function getPropertyFullInfo($propertyId){
        $sqlQuery = "SELECT property.*, users.fname, users.lname, users.phoneNumber, users.description as userDescription,
                        users.email as userEmail
                     FROM  property
                     LEFT JOIN  users ON users.id = property.userId
                     WHERE property.isDeleted = 0 and users.is_deleted= 0 and property.id = $propertyId
                    ";
        $query = $this->db->query($sqlQuery);
        if ($query) {
            $result = $query->row();
        }else{
            $result= -1;
        }
        return $result;
    }


   //--------------------------------------------------------//
   public function displayAllPinsForSale(){
        $sqlQuery = "SELECT *
                     FROM  property
                     WHERE isDeleted= 0 and accepted = 1 and saleOrRent = 'sale'
                    ";
        $query = $this->db->query($sqlQuery);
        if ($query) {
        $result = $query->result();
        
        }else{
            $result= -1;
        }
        return $result;
    }
    //--------------------------------------------------------//
    public function displayAllPinsForRent(){
        $sqlQuery = "SELECT *
                    FROM  property
                    WHERE isDeleted= 0 and accepted = 1 and saleOrRent = 'rent'
                    ";
        $query = $this->db->query($sqlQuery);
        if ($query) {
        $result = $query->result();
        
        }else{
            $result= -1;
        }
        return $result;
    }


   //--------------------------------------------------------//
    public function uploadFiles($name, $transactionId, $extension)
    {
        $name = $this->db->escape($name);
        $extension = $this->db->escape($extension);
        $sql = "INSERT INTO property_attachment (`attachmentName`, `propertyId` ,`attachmentExt`)
                VALUES ($name, $transactionId, $extension)";
        $query = $this->db->query($sql);
        if ($query) {
            return $this->db->insert_id();
        } else {
          return 0;
        }
    }
    public function deleteAttachment($attachmentId)
    {
        $sql = "UPDATE property_attachment
                SET `is_deleted` = 1
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


//........................LAST ONE..............................//
}

    
