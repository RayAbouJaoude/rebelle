<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    if(isset($_SESSION["userFname"]) && !empty($_SESSION["userFname"])){
        $userFname = $_SESSION["userFname"];
    }else{
        $userFname = "";

    }
    if(isset($_SESSION["userLname"]) && !empty($_SESSION["userLname"])){
        $userLname = $_SESSION["userLname"];
    }else{
        $userLname = "";

    }
    if(isset($_SESSION["dateOfBirth"]) && !empty($_SESSION["dateOfBirth"])){
        $dateOfBirth = $_SESSION["dateOfBirth"];
    }else{
        $dateOfBirth = "";

    }
    if(isset($_SESSION["gender"]) && !empty($_SESSION["gender"])){
        $gender = $_SESSION["gender"];
    }else{
        $gender = -1;
    
    }
    if(isset($_SESSION["userType"])){
        $userType = $_SESSION["userType"];
    }
    if(isset($_SESSION["email"])){
        $email = $_SESSION["email"];
    }
    if(isset($_SESSION["description"])){
        $description = $_SESSION["description"];
    }else{
        $description =""; 
    }
    if(isset($_SESSION["phoneNumber"])){
        $phoneNumber = $_SESSION["phoneNumber"];
    }else{
        $phoneNumber ="";
    }
?>

<!-- <img class="w-100"  src="<?php echo base_url(); ?>assets/images/mainPagePicOne.jpg" > -->

<div class="container" style="margin-top:10px;"> 

    <!-- main header start  -->
    <div id= "mainHeader" name="mainHeader" class="mt-2">
        <div class="row ml-0 mr-0">
            <div class="col-xl-2 col-6 greenBackground">
                <button type ="button" id="profileInfoHeaderButton" name="profileInfoHeaderButton" class =" whiteColor mainHeaderButtons btn btn-sm">
                    <i class="mainHeaderIcons fas fa-id-badge   whiteColor"></i>
                    Manage Profile
                </button>
            </div>
            <div class="col-xl-2 col-6">
                <button type ="button" id="managePropertiesHeaderButton" name="managePropertiesHeaderButton" class ="mainHeaderButtons btn btn-sm">
                    <i class="fas fa-home mainHeaderIcons"></i>
                    Manage Properties
                </button>
            </div>   
            <div class="col-xl-2 col-6">
                <button type ="button" id="adminSectionHeaderButton" name="adminSectionHeaderButton" class ="mainHeaderButtons btn btn-sm">
                    <i class="fas fa-user-cog mainHeaderIcons"></i>
                    Admin Section
                </button>
            </div> 
        </div>
    </div>
    <!-- end of main header  -->
        

    <!-- profile section start  -->
    <div id="profileInfo" >
        <form method="POST" id="profileForm">
            <div class="row  mt-1" >
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                    <label for="firstName" class="" >First Name</label>
                    <input type ="text" value="<?php echo $userFname ; ?>" required class="form-control form-control-sm " name="firstName" id="firstName"  />
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                    <label for="lastName" class=" ">Last Name</label>
                    <input type ="text"  value="<?php echo $userLname ; ?>" required class="form-control form-control-sm " name="lastName" id="lastName"  />
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                    <label for="email" class=" ">Email Adress</label>
                    <input type ="text"  disabled value="<?php echo $email ; ?>" required class="form-control form-control-sm " name="email" id="email"  />
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                    <label for="gender" class="" >Gender</label>
                    <input type="hidden" id="hiddenInputForGender" value="<?php echo $gender ; ?>"/>
                    <select name="gender" id="gender" class="form-control form-control-sm selectpicker" data-live-search="true" >
                        <option value="-1">--select--</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                    <label for="dateOfBirth" class=" ">Date Of Birth</label>
                    <div class='input-group date' id='datetimepicker'>
                        <input type='text' id="dateOfBirth" value="<?php echo $dateOfBirth ; ?>"   name="dateOfBirth" style="background-color:white; padding-left:13px;"  class="form-control form-control-sm"  readonly="readonly"/>
                        <div class="input-group-append input-group-addon">
                            <span class="input-group-text far fa-calendar-alt dueDateBtn"></span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                    <label for="phoneNumber" class=" ">Phone Number</label>
                    <input type ="text" value="<?php echo $phoneNumber ; ?>" required class="form-control form-control-sm " name="phoneNumber" id="phoneNumber"  />
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <label for="description" class=" ">Description</label>
                    <textarea class="form-control form-control-sm " name="description" id="description"  rows="3"><?php echo $description; ?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="mt-2 col-xl-12 col-12">
                    <button type="submit" class="btn btn-sm greenButtonsCss" style="float:right;" id="editProfileButton">
                        <i class="fas fa-paper-plane" style="color:white; margin-right:4px;"></i> Edit Profile
                    </button>
                </div>
            </div>
        </form>
    </div>
    <!-- profile section finish  -->





    <!-- manage property section  -->
    <div id="manageProperty" class="displayNone" style="margin-top:10px;">
        <div class="row">
            <div class="col-12">
                <button id="addPropertyButton" style="height:30px;" class="btn btn-sm greenButtonsCss" ><i class="fas fa-plus" style="margin-right:5px;"></i> Add Property</button>
            </div>
        </div>
        <form method="POST" id="managePropertyForm" name="managePropertyForm">
            <div class="row mt-2">  
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                    <label for="propertyTitle"> Title:</label>
                    <input type="text" name="propertyTitle" id="propertyTitle" class="form-control form-control-sm"  />
                    <input type="hidden" name="propertyIdHidden" id="propertyIdHidden" class="form-control form-control-sm"  />
                    <input type="hidden" name="propertyCounterAddOrEdit" id="propertyCounterAddOrEdit" class="form-control form-control-sm"  />
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                    <label for="propertyDescription">Description:</label>
                    <input type="text" name="propertyDescription" id="propertyDescription" class="form-control form-control-sm"  />
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ">
                    <label for="propertyPrice">Price:</label>
                    <input type="text" name="propertyPrice" id="propertyPrice" class="form-control form-control-sm"  />
                </div>
            </div>
            <div class="row mt-2">  
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                    <label for="propertyAddress">Address:</label>
                    <input type="text" name="propertyAddress" id="propertyAddress" class="form-control form-control-sm"  />
                </div>
                <!-- <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                    <label for="propertyListingStatus">Listing Status:</label>
                    <select class="form-control form-control-sm selectpicker"  data-live-search="true" id="propertyListingStatus" name="propertyListingStatus">
                        <option value="-1">-- Select --</option>
                        <option value="2">For Sale</option>
                        <option value="3">Under Contract - Option Pending (OP)</option>
                        <option value="4">Under Contract - Option Continue To Show (PS)</option>
                        <option value="5">Under Contract - Pending (P)</option>
                    </select>   
                </div>   -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ">
                    <label for="propertyZipcode">Zip Code:</label>
                    <input type="text" name="propertyZipcode" id="propertyZipcode" class="form-control form-control-sm"  />
                </div> 
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ">
                    <label for="propertyYearBuilt">Year Built:</label>
                    <div class='input-group date' id='datetimepicker1'>
                        <input type='text' id="propertyYearBuilt" name="propertyYearBuilt" style="background-color:white; padding-left:13px;"  class="form-control form-control-sm"  readonly="readonly"/>
                        <div class="input-group-append input-group-addon">
                            <span class="input-group-text far fa-calendar-alt dueDateBtn"></span>
                        </div>
                    </div>
                </div>
            </div>  
            <div class="row mt-2">  
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ">
                    <label for="propertyLotSize">Lot Size:</label>
                    <input type="text" name="propertyLotSize" id="propertyLotSize" class="form-control form-control-sm"  />
                </div> 
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ">
                    <label for="propertySaleOrRent">Sale Or Rent:</label>
                    <select class="form-control form-control-sm selectpicker"  data-live-search="true" id="propertySaleOrRent" name="propertySaleOrRent">
                        <option value="-1">-- Select --</option>
                        <option value="sale">Sale</option>
                        <option value="rent">Rent</option>
                    </select>  
                </div> 
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ">
                    <label for="propertyNumberOfBedrooms">Number Of Bedrooms:</label>
                    <input type="text" name="propertyNumberOfBedrooms" id="propertyNumberOfBedrooms" class="form-control form-control-sm"  />
                </div>
            </div> 
            <div class="row">
                <div class="col-xl-1 col-md-1 col-sm-1 mt-3">
                    <p style="font-size:16px;">Attachments </p> 
                </div>
                <div class="col-xl-2 col-md-2 col-sm-2 mt-3">
                    <i class=" fa fa-paperclip" title="Add Attachment" name ="attachIconAdd" id="attachIconAdd" style=" cursor:pointer; margin-top:5px;font-size:11pt; color:rgb(38, 140, 228) ;"></i>
                    <input type="file" class="displayNone" multiple name="hiddenAttachmentButtonAdd" id="hiddenAttachmentButtonAdd">
                </div>
                <div id ="attachmentFileTableContainer" class=" col-xl-12" >
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-xl-12">
                    <h6>Amenitiessss</h6>
                </div>
            </div>
            <div class="row boxCss ml-0 mr-0">
                <div class="col-xl-3" >
                    <label style="cursor:pointer;"  for="areaPoolCheckbox">
                        <input style="vertical-align:middle;" class="categoryTypeCheckBoxes " type="checkbox" name="areaPoolCheckbox" id="areaPoolCheckbox">
                        <span style="vertical-align:middle; margin-left:5px;">Area Pool</span>
                    </label>
                </div>
                <div class="col-xl-3" >
                    <label style="cursor:pointer;"  for="areaTennisCheckbox">
                        <input style="vertical-align:middle;" class="categoryTypeCheckBoxes " type="checkbox" name="areaTennisCheckbox" id="areaTennisCheckbox">
                        <span style="vertical-align:middle; margin-left:5px;">Area Tennis</span>
                    </label>
                </div>
                
                <div class="col-xl-3" >
                    <label style="cursor:pointer;"  for="elevatorCheckbox">
                        <input style="vertical-align:middle;" class="categoryTypeCheckBoxes " type="checkbox" name="elevatorCheckbox" id="elevatorCheckbox">
                        <span style="vertical-align:middle; margin-left:5px;">Elevator / Elevator Shaft</span>
                    </label>
                </div>
                <div class="col-xl-3" >
                    <label style="cursor:pointer;"  for="energyFeatureCheckbox">
                        <input style="vertical-align:middle;" class="categoryTypeCheckBoxes " type="checkbox" name="energyFeatureCheckbox" id="energyFeatureCheckbox">
                        <span style="vertical-align:middle; margin-left:5px;">Energy Features</span>
                    </label>
                </div>
                <div class="col-xl-3" >
                    <label style="cursor:pointer;"  for="garageAptCheckbox">
                        <input style="vertical-align:middle;" class="categoryTypeCheckBoxes " type="checkbox" name="garageAptCheckbox" id="garageAptCheckbox">
                        <span style="vertical-align:middle; margin-left:5px;">Garage Apt / Guest House</span>
                    </label>
                </div>
                <div class="col-xl-3" >
                    <label style="cursor:pointer;"  for="lakeCheckbox">
                        <input style="vertical-align:middle;" class="categoryTypeCheckBoxes " type="checkbox" name="lakeCheckbox" id="lakeCheckbox">
                        <span style="vertical-align:middle; margin-left:5px;">Lake</span>
                    </label>
                </div>
                <div class="col-xl-3" >
                    <label style="cursor:pointer;"  for="privatePoolCheckbox">
                        <input style="vertical-align:middle;" class="categoryTypeCheckBoxes " type="checkbox" name="privatePoolCheckbox" id="privatePoolCheckbox">
                        <span style="vertical-align:middle; margin-left:5px;">Private Pool</span>
                    </label>
                </div>
                <div class="col-xl-3" >
                    <label style="cursor:pointer;"  for="spaCheckbox">
                        <input style="vertical-align:middle;" class="categoryTypeCheckBoxes " type="checkbox" name="spaCheckbox" id="spaCheckbox">
                        <span style="vertical-align:middle; margin-left:5px;">Spa</span>
                    </label>
                </div>
                <div class="col-xl-3" >
                    <label style="cursor:pointer;"  for="wheelChairCheckbox">
                        <input style="vertical-align:middle;" class="" type="checkbox" name="wheelChairCheckbox" id="wheelChairCheckbox">
                        <span style="vertical-align:middle; margin-left:5px;">Wheelchair Access</span>
                    </label>
                </div>
                <div class="col-xl-3" >
                    <label style="cursor:pointer;"  for="yardCheckbox">
                        <input style="vertical-align:middle;" class="categoryTypeCheckBoxes " type="checkbox" name="yardCheckbox" id="yardCheckbox">
                        <span style="vertical-align:middle; margin-left:5px;">Yard</span>
                    </label>
                </div>
            </div>


            <!-- map setting -->
                <div class="row mt-2 mb-1">
                    <div class="col-xl-12" style="text-align:center;">
                        <h6>Drag pin to property location.</h6>
                    </div>
                </div>
                <div id='map' style='height: 300px;'>
                </div>
                <pre id="coordinates" class="coordinates"></pre>
            <!-- end map setting  -->

            <div class="row">
                <div class="col-xl-12 mt-3">
                    <button type ="submit" id="submitPropertyButton" name="submitPropertyButton" style="float:right;" class ="btn btn-sm greenButtonsCss">
                        <i class="fas fa-paper-plane" style="margin-right:5px; color:white;"></i>
                        Submit
                    </button>
                    <button type ="button" style="float:right; margin-right:5px;" class ="btn btn-sm redButtonsCss cancelButton">
                        <i class="fas fa-times" style="color:white; margin-right:5px;"></i> 
                        Cancel 
                    </button>
                </div>
            </div>
        </form>
        <div class="row mt-2">
            <div class="col-xl-12">
                <div id="propertyTableContainer">
                </div>
            </div>
        </div>
    </div>
    <!-- end manage property section  -->



     
    <!-- admin section  -->
    <div id="adminSection" class="displayNone" style="margin-top:10px;">       
        <div class="row" style="margin-right:0px !important; margin-left:0px !important;">
            <div class="col-xl-12" style="text-align:center; margin-top:20px; border: 1px solid #055E20; padding-top:10px; padding-bottom:3px;">
                <h6>Manage Properties</h6>
            </div>
        </div>  

        <div id="displayAdminSectionPropertyInfo">
            <div class="row mt-2">  
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                    <label for="propertyTitleInAdmin"> Title:</label>
                    <input type="text" name="propertyTitleInAdmin" id="propertyTitleInAdmin" class="form-control form-control-sm"  />
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                    <label for="propertyDescriptionInAdmin">Description:</label>
                    <input type="text" name="propertyDescriptionInAdmin" id="propertyDescriptionInAdmin" class="form-control form-control-sm"  />
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ">
                    <label for="propertyPriceInAdmin">Price:</label>
                    <input type="text" name="propertyPriceInAdmin" id="propertyPriceInAdmin" class="form-control form-control-sm"  />
                </div>
            </div>
            <div class="row mt-2">  
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                    <label for="propertyAddressInAdmin">Address:</label>
                    <input type="text" name="propertyAddressInAdmin" id="propertyAddressInAdmin" class="form-control form-control-sm"  />
                </div>
                <!-- <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                    <label for="propertyListingStatus">Listing Status:</label>
                    <select class="form-control form-control-sm selectpicker"  data-live-search="true" id="propertyListingStatus" name="propertyListingStatus">
                        <option value="-1">-- Select --</option>
                        <option value="2">For Sale</option>
                        <option value="3">Under Contract - Option Pending (OP)</option>
                        <option value="4">Under Contract - Option Continue To Show (PS)</option>
                        <option value="5">Under Contract - Pending (P)</option>
                    </select>   
                </div>   -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ">
                    <label for="propertyZipcodeInAdmin">Zip Code:</label>
                    <input type="text" name="propertyZipcodeInAdmin" id="propertyZipcodeInAdmin" class="form-control form-control-sm"  />
                </div> 
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ">
                    <label for="propertyYearBuiltInAdmin">Year Built:</label>
                    <div class='input-group date' id='datetimepicker1'>
                        <input type='text' id="propertyYearBuiltInAdmin" name="propertyYearBuiltInAdmin" style="background-color:white; padding-left:13px;"  class="form-control form-control-sm"  readonly="readonly"/>
                        <div class="input-group-append input-group-addon">
                            <span class="input-group-text far fa-calendar-alt dueDateBtn"></span>
                        </div>
                    </div>
                </div>
            </div>  
            <div class="row mt-2">  
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ">
                    <label for="propertyLotSizeInAdmin">Lot Size:</label>
                    <input type="text" name="propertyLotSizeInAdmin" id="propertyLotSizeInAdmin" class="form-control form-control-sm"  />
                </div> 
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ">
                    <label for="propertySaleOrRentInAdmin">Sale Or Rent:</label>
                    <select class="form-control form-control-sm selectpicker"  data-live-search="true" id="propertySaleOrRentInAdmin" name="propertySaleOrRentInAdmin">
                        <option value="-1">-- Select --</option>
                        <option value="sale">Sale</option>
                        <option value="rent">Rent</option>
                    </select>  
                </div> 
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ">
                    <label for="propertyNumberOfBedroomsInAdmin">Number Of Bedrooms:</label>
                    <input type="text" name="propertyNumberOfBedroomsInAdmin" id="propertyNumberOfBedroomsInAdmin" class="form-control form-control-sm"  />
                </div>
            </div> 
            <div class="row mt-2">
                <div class="col-xl-12">
                    <h6>Amenities</h6>
                </div>
            </div>
            <div class="row boxCss ml-0 mr-0">
                <div class="col-xl-3" >
                    <label style="cursor:pointer;"  for="areaPoolCheckboxInAdmin">
                        <input style="vertical-align:middle;" class="categoryTypeCheckBoxes " type="checkbox" name="areaPoolCheckboxInAdmin" id="areaPoolCheckboxInAdmin">
                        <span style="vertical-align:middle; margin-left:5px;">Area Pool</span>
                    </label>
                </div>
                <div class="col-xl-3" >
                    <label style="cursor:pointer;"  for="areaTennisCheckbox">
                        <input style="vertical-align:middle;" class="categoryTypeCheckBoxes " type="checkbox" name="areaTennisCheckbox" id="areaTennisCheckbox">
                        <span style="vertical-align:middle; margin-left:5px;">Area Tennis</span>
                    </label>
                </div>
                
                <div class="col-xl-3" >
                    <label style="cursor:pointer;"  for="elevatorCheckbox">
                        <input style="vertical-align:middle;" class="categoryTypeCheckBoxes " type="checkbox" name="elevatorCheckbox" id="elevatorCheckbox">
                        <span style="vertical-align:middle; margin-left:5px;">Elevator / Elevator Shaft</span>
                    </label>
                </div>
                <div class="col-xl-3" >
                    <label style="cursor:pointer;"  for="energyFeatureCheckbox">
                        <input style="vertical-align:middle;" class="categoryTypeCheckBoxes " type="checkbox" name="energyFeatureCheckbox" id="energyFeatureCheckbox">
                        <span style="vertical-align:middle; margin-left:5px;">Energy Features</span>
                    </label>
                </div>
                <div class="col-xl-3" >
                    <label style="cursor:pointer;"  for="garageAptCheckbox">
                        <input style="vertical-align:middle;" class="categoryTypeCheckBoxes " type="checkbox" name="garageAptCheckbox" id="garageAptCheckbox">
                        <span style="vertical-align:middle; margin-left:5px;">Garage Apt / Guest House</span>
                    </label>
                </div>
                <div class="col-xl-3" >
                    <label style="cursor:pointer;"  for="lakeCheckbox">
                        <input style="vertical-align:middle;" class="categoryTypeCheckBoxes " type="checkbox" name="lakeCheckbox" id="lakeCheckbox">
                        <span style="vertical-align:middle; margin-left:5px;">Lake</span>
                    </label>
                </div>
                <div class="col-xl-3" >
                    <label style="cursor:pointer;"  for="privatePoolCheckbox">
                        <input style="vertical-align:middle;" class="categoryTypeCheckBoxes " type="checkbox" name="privatePoolCheckbox" id="privatePoolCheckbox">
                        <span style="vertical-align:middle; margin-left:5px;">Private Pool</span>
                    </label>
                </div>
                <div class="col-xl-3" >
                    <label style="cursor:pointer;"  for="spaCheckbox">
                        <input style="vertical-align:middle;" class="categoryTypeCheckBoxes " type="checkbox" name="spaCheckbox" id="spaCheckbox">
                        <span style="vertical-align:middle; margin-left:5px;">Spa</span>
                    </label>
                </div>
                <div class="col-xl-3" >
                    <label style="cursor:pointer;"  for="wheelChairCheckbox">
                        <input style="vertical-align:middle;" class="" type="checkbox" name="wheelChairCheckbox" id="wheelChairCheckbox">
                        <span style="vertical-align:middle; margin-left:5px;">Wheelchair Access</span>
                    </label>
                </div>
                <div class="col-xl-3" >
                    <label style="cursor:pointer;"  for="yardCheckbox">
                        <input style="vertical-align:middle;" class="categoryTypeCheckBoxes " type="checkbox" name="yardCheckbox" id="yardCheckbox">
                        <span style="vertical-align:middle; margin-left:5px;">Yard</span>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 mt-3">
                    <button type ="button" style="float:right;" class ="btn btn-sm redButtonsCss cancelButton">
                        <i class="fas fa-times" style="color:white; margin-right:5px;"></i> 
                        Cancel 
                    </button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div id="propertyTableContainerForAdmin" class="mt-2 ">
                </div>
            </div>
        </div>
    </div>
    <!-- end admin section  -->


    <!-- end container  -->
</div>

<div style="height:50px;"></div>