<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_Model extends CI_Model {
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



//........................LAST ONE..............................//
}

    
