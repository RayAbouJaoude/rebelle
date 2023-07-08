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


<div class="container" style="margin-top:50px;"> 
    <!-- main header start  -->
    <div id= "mainHeader" name="mainHeader" class="mt-2">
        <div class="row ml-0 mr-0">
            <div class="col-xl-2 col-6 ">
                <button type ="button" id="manageProfileHeaderButton" name="manageProfileHeaderButton" class ="mainHeaderButtons btn btn-sm">
                    <i class="mainHeaderIcons fas fa-id-badge "></i>
                    Profile
                </button>
            </div>
            <div class="col-xl-2 col-6 greenBackground">
                <button type ="button" id="manageItemsHeaderButton" name="manageItemsHeaderButton" class =" whiteColor mainHeaderButtons btn btn-sm">
                    <i class="mainHeaderIcons fas fa-id-badge whiteColor"></i>
                    Manage Items
                </button>
            </div>
            <div class="col-xl-2 col-6 ">
                <button type ="button" id="manageCartsHeaderButton" name="manageCartsHeaderButton" class ="  mainHeaderButtons btn btn-sm">
                    <i class="mainHeaderIcons fas fa-id-badge  "></i>
                    Manage Carts
                </button>
            </div>
        </div>
    </div>
    <!-- end of main header  -->
        

    <!-- profile section start  -->
    <div id="profileInfo" >
        <div class="row mt-3">
            <div class="col-lg-2 pr-0">
                <button type ="button" id="addItemButton"  name="addItemButton" class ="btn buttonStyle"><i style="margin-right:10px" class="fas fa-caret-down"></i>Manage Profile </button>
            </div>
            <div class="col-lg-10 lineClass">
            </div>
        </div>    
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
                    <label for="description" class=" ">Address</label>
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
    <!-- profile section end  -->


    <!-- manage item section  -->
    <div id="manageItemSection" >
        <div class="row mt-3">
            <div class="col-lg-2 pr-0">
                <button type ="button" id="addItemButton"  name="addItemButton" class ="btn buttonStyle"><i style="margin-right:10px" class="fas fa-caret-down"></i>Add Item </button>
            </div>
            <div class="col-lg-10 lineClass">
            </div>
        </div>       
        <form method="POST" id="addItemsForm" name="addItemsForm">
            <div class="row toAppendNewSizeQ form-group mt-2">  
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                    <label for="itemNameToAdd"> Item Name:</label>
                    <input type="text" name="itemNameToAdd" id="itemNameToAdd" class="form-control form-control-sm"  />
                    <input type="hidden" name="barcodeToPrintHidden" id="barcodeToPrintHidden" class="form-control form-control-sm"  />
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                    <label for="itemDescriptionToAdd">Description:</label>
                    <input type="text" name="itemDescriptionToAdd" id="itemDescriptionToAdd" class="form-control form-control-sm"  />
                </div>

                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 mt-2">
                    <label for="itemBarCodeToAdd">Product Code:</label>
                    <input type="text" name="itemBarCodeToAdd" id="itemBarCodeToAdd" class="form-control form-control-sm"  />
                </div>
                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 mt-2">
                    <label for="itemBarCodeToAdd">Weight:</label>
                    <input type="text" name="itemWeightToAdd" id="itemWeightToAdd" class="form-control form-control-sm"  />
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2">
                    <label for="itemCategoryToAdd">Item Category:</label>
                    <select class="form-control form-control-sm" id="itemCategoryToAdd" name="itemCategoryToAdd">
                
                        <option value="-1">Category</option>
                        <option value="30">Attire</option>
                        <option value="41">Bags</option>
                        <option value="39">Blazer</option>
                        <option value="33">Belts</option>
                        <option value="38">Cardigan</option>
                        <option value="2">Dresses</option>
                        <option value="43">Headwear</option>
                        <!-- <option value="34">FootWear</option> -->
                        <option value="1">Jackets</option>
                        <option value="35">Jewelry</option>
                        <option value="21">Jumpsuits / Sets</option>
                        <option value="12">Matching Clothes</option>
                        <option value="31">Shoes</option>
                        <option value="45">Swimsuit / Bikini</option>
                        <option value="17">New Born</option>
                        <option value="23">Pants / Skirts</option>
                        <option value="37">Pants / Shorts</option>
                        <option value="40">Pull</option>
                        <option value="11">Pyjamas</option>
                        <option value="32">Scarves</option>
                        <option value="44">Socks</option>
                        <option value="36">Tshirts</option>
                        <option value="42">Shirts</option>
                        <option value="22">Tops</option>
                        
                    </select>
                            
                </div>   

                <!-- <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2">
                    <label for="itemGenderToAdd">Gender:</label>
                    <select class="form-control form-control-sm" id="itemGenderToAdd" name="itemGenderToAdd">
                        <option value="-1">Gender</option>
                        <option value="1">Male</option>
                        <option value="2">Female</option>
                        <option value="3">Kids</option>
                        <option value="4">Accessory</option>
                    </select>
                </div>  -->

            
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2">
                    <label for="itemPriceToAdd">Price:</label>    
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input class="form-control form-control-sm" type="text" name="itemPriceToAdd" id="itemPriceToAdd"/>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2">
                    <label for="attachItemImage">Attach Item Image:</label>
                    <Label class="form-control form-control-sm" id="labelForattachItemImage" name="labelForattachItemImage" for ="attachItemImage">Browse... </label>
                    <input type="file" multiple style="display:none;" name="attachItemImage" id="attachItemImage"  />
                    <button type="button" name="uploadItemImageButton" id="uploadItemImageButton" class="displayNone">Upload item image </button>
                    <input type="hidden" name="imageIdHidden" id="imageIdHidden" value="" />
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2">
                    <label for="itemQuantityToAdd">Quantity:</label>
                    <input type="text" name="itemQuantityToAdd" id="itemQuantityToAdd" class="form-control form-control-sm"  />
                </div>
            
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2">
                    <label for="itemSizeToAdd" >Size: <i class="fas fa-plus-circle" id="openSizeModal" style="font-size:17px; color:#3498db; margin-left:5px;"></i></label>
                    <!-- <select class="form-control form-control-sm "  id="itemSizeToAdd" name="itemSizeToAdd">
                    </select> -->
                    <input type="text" name="itemSizeToAdd" id="itemSizeToAdd" class="form-control form-control-sm"  />
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2">
                    <label for="colorToAdd">Color: <i class="fas fa-plus-circle" id="openColorModal" style="font-size:17px; color:#3498db; margin-left:5px;"></i></label>
                    <!-- <select class="form-control form-control-sm "  id="colorToAdd" name="colorToAdd">
                    </select> -->
                    <input type="text" name="colorToAdd" id="colorToAdd" class="form-control form-control-sm"  />
                </div>
                
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2">
                    <label for="itemQuantityToAddForNewItem">Quantity:</label>
                    <input type="text" name="itemQuantityToAddForNewItem"  class="form-control form-control-sm itemQuantityToAddForNewItem"  />
                </div>
            
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2">
                    <label for="itemSizeToAddForNewItem">Size:</label>
                    <!-- <select class="form-control form-control-sm itemSizeToAddForNewItem"   name="itemSizeToAddForNewItem">
                    </select> -->
                    <input type="text" name="itemSizeToAddForNewItem"  class="form-control form-control-sm itemSizeToAddForNewItem"   />
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mt-2">
                    <label for="colorToAddForNewItem">Color:</label>
                    <!-- <select class="form-control form-control-sm colorToAddForNewItem"  name="colorToAddForNewItem">
                    </select> -->
                    <input type="text" name="colorToAddForNewItem"  class="form-control form-control-sm colorToAddForNewItem"   />

                </div>
                <div class="col-xl-1 ">
                    <a class="insertNewRowInAddItem" href="javascript:void(0);">       
                        <i class="fas fa-plus-circle" style="font-size:22px; color:#3498db; margin-top:43px;"></i>
                    </a>
                    <a class="deleteRowInAddItem" style="display:none;" href="javascript:void(0);">       
                        <i class="fas fa-minus-circle" style="font-size:22px; color:#dc3545; margin-top:43px;"></i>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 mt-3 ">
                    <button type ="submit" id="submitAddItemButton" name="submitAddItemButton" style="float:right;" class ="btn btn-md blueButtonsCss">
                        <i class="fas fa-plus" style="margin-right:5px; color:white;"> </i>
                        Add Item 
                    </button>
                    <button type ="button" id="cancelAddItemButton" name="cancelAddItemButton" style="float:right;" class ="btn btn-md redButtonsCss">
                        <i class="fas fa-times" style="color:white; margin-right:5px;"> </i> 
                        Cancel 
                    </button>
                </div>
            </div>
        </form>
    

    <div class="row mt-3">
        <div class="col-lg-2 pr-0">
            <button type ="button" id="listOfItemsButton"  name="listOfItemsButton" class ="btn buttonStyle"><i style="margin-right:10px" class="fas fa-caret-down"></i>List Of Items </button>
        </div>
        <div class="col-lg-10 lineClass">
        </div>
    </div>      
    <div class="row">
        <div class="col-xl-2 col-md-2 mt-1 pr-0">
            <select class="form-control form-control-sm" name="archiveOrNotSelect" id="archiveOrNotSelect">
                <option value="1">All</option>
                <option value="2">Archived</option>
                <option value="3">Not Archived</option>
                <option value="4">On Sale</option>
                <option value="5">Not On Sale</option>
                <option value="6">Exported</option>
                <option value="7">New Collection</option>
                <option value="8">Summer Collection</option>
                <option value="9">Winter Collection</option>
                <option value="10">Storage</option>
            </select>
        </div>
        <!-- <div class="col-xl-2 col-md-2 mt-1 pr-0">
            <select class="form-control form-control-sm" name="showImage" id="showImage">
                <option value="2" selected >Hide Image</option>
                <option value="1">Show Image</option>
            </select>
        </div> -->
        <div class="col-xl-8">
            <i class="fas fa-sync-alt" id="refreshItems" style="color:green; font-size:15px; margin-top: 11px; cursor:pointer;"></i>
            <button class="btn greenButtonsCss btn-md ml-2" id ="archiveAllInItems" title="Archive all with quantity 0">Archive All</button>
            <button class="btn greenButtonsCss btn-md ml-2" id ="unArchiveAllInItems" title="UnArchive all with quantity > 0">UnArchive All</button>
            <button class="btn greenButtonsCss btn-md ml-2" style="background-color:#ce9018 !important" id ="removeFromNewCollectionAllInItems" title="Remove from new collection all">Remove New Collection</button>
            <!-- <button class="btn greenButtonsCss btn-md ml-2" style="background-color:#ce0c30 !important" id ="addToStorageManyItems" title="Add Checked Items To Storage">Add Storage</button> -->
            <!-- <button class="btn greenButtonsCss btn-md ml-2" style="background-color:#ce0c30 !important" id ="removeToStorageManyItems" title="Remove Checked Items To Storage">Remove Storage</button> -->
            <span class="ml-2">Description:</span>
            <input type="checkbox" id="checkBoxForDescription" name="checkBoxForDescription" >
            <button class="btn greenButtonsCss btn-md ml-2" style="background-color:#ce0c30 !important" id ="deleteMainPageManyItems" title="Delete Checked Items">Delete</button>
        </div>
        <div class="col-xl-1">
            <!-- <label for="itemCategoryInMainPage">Item Category:</label>
            <select class="form-control form-control-sm" id="itemCategoryInMainPage" name="itemCategoryInMainPage">
                <option value="-1">ALL</option>
                <option value="30">Attire</option>
                <option value="41">Bags</option>
                <option value="39">Blazer</option>
                <option value="33">Belts</option>
                <option value="38">Cardigan</option>
                <option value="2">Dresses</option>
                <option value="43">Headwear</option>
                <option value="1">Jackets</option>
                <option value="35">Jewelry</option>
                <option value="21">Jumpsuits / Sets</option>
                <option value="12">Matching Clothes</option>
                <option value="31">Shoes</option>
                <option value="45">Swimsuit / Bikini</option>
                <option value="17">New Born</option>
                <option value="23">Pants / Skirts</option>
                <option value="37">Pants / Shorts</option>
                <option value="40">Pull</option>
                <option value="11">Pyjamas</option>
                <option value="32">Scarves</option>
                <option value="44">Socks</option>
                <option value="36">Tshirts</option>
                <option value="42">Shirts</option>
                <option value="22">Tops</option>
            </select> -->
        </div>
        <!-- <div class="col-xl-1">
            <label for="itemGenderInMainPage">Gender:</label>
            <select class="form-control form-control-sm" id="itemGenderInMainPage" name="itemGenderInMainPage">
                <option value="-1">ALL</option>
                <option value="1">Male</option>
                <option value="2">Female</option>
                <option value="3">Kids</option>
                <option value="4">Accessory</option>
            </select>     
        </div> -->
    </div>
    <div  id="itemToEdit" name="itemToEdit" class="mt-2 displayNone">
        <form method="POST" id="editItemForm" name="editItemForm">
            <div class="row toAppendNewSizeQToEdit form-group mt-2">  
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                    <label for="itemNameToAddToEdit"> Item Name:</label>
                    <input type="text" name="itemNameToAddToEdit" id="itemNameToAddToEdit" labelToAudit="ItemName" oldValue="" class="changesToAudit form-control form-control-sm"  />
                    <input type="hidden" name="itemIdHidden" id="itemIdHidden" >
                    <input type="hidden" name="barCodeHidden" id="barCodeHidden" >
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                    <label for="itemDescriptionToAddToEdit">Description:</label>
                    <input type="text" name="itemDescriptionToAddToEdit" id="itemDescriptionToAddToEdit" labelToAudit="Description" oldValue="" class="changesToAudit form-control form-control-sm"  />
                </div>

                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 mt-2">
                    <label for="itemBarCodeToAddToEdit">Product:</label>
                    <input type="text" name="itemBarCodeToAddToEdit" id="itemBarCodeToAddToEdit" labelToAudit="Product" oldValue="" class="changesToAudit form-control form-control-sm"  />
                </div>
                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 mt-2">
                    <label for="itemBarCodeToAddToEdit">Weight:</label>
                    <input type="text" name="itemWeightToAddToEdit" id="itemWeightToAddToEdit" labelToAudit="Weight" oldValue="" class="changesToAudit form-control form-control-sm"  />
                </div>
                
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2">
                    <label for="itemCategoryToAddToEdit">Item Category:</label>
                    <select class="form-control form-control-sm changesToAudit" id="itemCategoryToAddToEdit" labelToAudit="ItemCategory" oldValue="" name="itemCategoryToAddToEdit">
                        <option value="-1">Category</option>
                        <option value="30">Attire</option>
                        <option value="41">Bags</option>
                        <option value="39">Blazer</option>
                        <option value="33">Belts</option>
                        <option value="38">Cardigan</option>
                        <option value="2">Dresses</option>
                        <option value="43">Headwear</option>
                        <option value="34">FootWear</option>
                        <option value="1">Jackets</option>
                        <option value="35">Jewelry</option>
                        <option value="21">Jumpsuits / Sets</option>
                        <option value="12">Matching Clothes</option>
                        <option value="31">Shoes</option>
                        <option value="45">Swimsuit / Bikini</option>
                        <option value="17">New Born</option>
                        <option value="37">Pants / Shorts</option>
                        <option value="23">Pants / Skirts</option>
                        <option value="40">Pull</option>
                        <option value="11">Pyjamas</option>
                        <option value="32">Scarves</option>
                        <option value="44">Socks</option>
                        <option value="36">Tshirts</option>
                        <option value="42">Shirts</option>
                        <option value="22">Tops</option>
                    </select>
                </div>   


                <!-- <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2">
                    <label for="itemGenderToAddToEdit">Gender:</label>
                    <select class="form-control form-control-sm changesToAudit" labelToAudit="Gender" oldValue="" id="itemGenderToAddToEdit" name="itemGenderToAddToEdit">
                        <option value="-1">Gender</option>
                        <option value="4">Accessory</option>
                        <option value="2">Female</option>
                        <option value="3">Kids</option>
                        <option value="1">Male</option>
                    </select>
                </div>  -->


                <!-- <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2">
                    <label for="itemCostToAddToEdit">Cost:</label>    
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input class="form-control form-control-sm changesToAudit" labelToAudit="Cost" oldValue="" type="text" name="itemCostToAddToEdit" id="itemCostToAddToEdit"/>
                    </div>
                </div> -->

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2">
                    <label for="itemPriceToAddToEdit">Price:</label>    
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input class="form-control form-control-sm changesToAudit" labelToAudit="Price" oldValue="" type="text" name="itemPriceToAddToEdit" id="itemPriceToAddToEdit"/>
                    </div>
                </div>


                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2">
                    <label for="itemQuantityToAddToEdit">Quantity:</label>
                    <input type="text" name="itemQuantityToAddToEdit" labelToAudit="Quantity" oldValue="" id="itemQuantityToAddToEdit" class="changesToAudit form-control form-control-sm"  />
                </div>
            
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2">
                    <label for="itemSizeToAddToEdit">Size:</label>
                    <!-- <select class="form-control form-control-sm changesToAudit"  labelToAudit="Size" oldValue=""  id="itemSizeToAddToEdit" name="itemSizeToAddToEdit">
                    </select> -->
                    <input type="text" name="itemSizeToAddToEdit" labelToAudit="Size" oldValue="" id="itemSizeToAddToEdit" class="changesToAudit form-control form-control-sm"  />

                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2">
                    <label for="colorToAddToEdit">Color:</label>
                    <!-- <select class="form-control form-control-sm changesToAudit" labelToAudit="Color" oldValue=""  id="colorToAddToEdit" name="colorToAddToEdit">
                    </select> -->
                    <input type="text" name="colorToAddToEdit" labelToAudit="Color" oldValue="" id="colorToAddToEdit" class="changesToAudit form-control form-control-sm"  />

                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2">
                    <label for="saleToAddToEdit">Sale:</label>
                    <input type="text" placeholder="Percentage" labelToAudit="Sale" oldValue="" name="saleToAddToEdit" id="saleToAddToEdit" class="changesToAudit form-control form-control-sm"  />
                    <input type="text" placeholder="Amount"  name="saleToAddAmount" id="saleToAddAmount" class="form-control form-control-sm"  />
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2">
                    <label for="matchingWithToEdit">Matching Group:</label>
                    <input type="text" name="matchingWithToEdit" labelToAudit="MatchingGroup" oldValue="" id="matchingWithToEdit" class="changesToAudit form-control form-control-sm"  />
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2">
                    <label for="initialQuantityToEdit">initial Quantity:</label>
                    <input type="text" name="initialQuantityToEdit" labelToAudit="InitialQuantity" oldValue="" id="initialQuantityToEdit" class="changesToAudit form-control form-control-sm"  />
                </div>
         
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2 displayNone">
                    <label for="itemCategoryToAddToEdit">Item Category:</label>
                    <select class="form-control form-control-sm changesToAudit" id="itemCategoryToAddToEdit" labelToAudit="ItemCategory" oldValue="" name="itemCategoryToAddToEdit">
                        <option value="-1">Category</option>
                        <option value="30">Attire</option>
                        <option value="41">Bags</option>
                        <option value="39">Blazer</option>
                        <option value="33">Belts</option>
                        <option value="38">Cardigan</option>
                        <option value="2">Dresses</option>
                        <option value="43">Headwear</option>
                        <!-- <option value="34">FootWear</option> -->
                        <option value="1">Jackets</option>
                        <option value="35">Jewelry</option>
                        <option value="21">Jumpsuits / Sets</option>
                        <option value="12">Matching Clothes</option>
                        <option value="31">Shoes</option>
                        <option value="45">Swimsuit / Bikini</option>
                        <option value="17">New Born</option>
                        <option value="37">Pants / Shorts</option>
                        <option value="23">Pants / Skirts</option>
                        <option value="40">Pull</option>
                        <option value="11">Pyjamas</option>
                        <option value="32">Scarves</option>
                        <option value="44">Socks</option>
                        <option value="36">Tshirts</option>
                        <option value="42">Shirts</option>
                        <option value="22">Tops</option>
                    </select>
                </div>   


                <!-- <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2 displayNone">
                    <label for="itemGenderToAddToEdit">Gender:</label>
                    <select class="form-control form-control-sm changesToAudit" labelToAudit="Gender" oldValue="" id="itemGenderToAddToEdit" name="itemGenderToAddToEdit">
                        <option value="-1">Gender</option>
                        <option value="4">Accessory</option>
                        <option value="2">Female</option>
                        <option value="3">Kids</option>
                        <option value="1">Male</option>
                    </select>
                </div>  -->

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2 displayNone">
                    <label for="itemPriceToAddToEdit">Price:</label>    
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input class="form-control form-control-sm changesToAudit" labelToAudit="Price" oldValue="" type="text" name="itemPriceToAddToEdit" id="itemPriceToAddToEdit"/>
                    </div>
                </div>


                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2 displayNone">
                    <label for="itemQuantityToAddToEdit">Quantity:</label>
                    <input type="text" name="itemQuantityToAddToEdit" labelToAudit="Quantity" oldValue="" id="itemQuantityToAddToEdit" class="changesToAudit form-control form-control-sm"  />
                </div>
            
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2 displayNone">
                    <label for="itemSizeToAddToEdit">Size:</label>
                    <!-- <select class="form-control form-control-sm changesToAudit"  labelToAudit="Size" oldValue=""  id="itemSizeToAddToEdit" name="itemSizeToAddToEdit">
                    </select> -->
                    <input type="text" name="itemSizeToAddToEdit" labelToAudit="Size" oldValue="" id="itemSizeToAddToEdit" class="changesToAudit form-control form-control-sm"  />

                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2 displayNone">
                    <label for="colorToAddToEdit">Color:</label>
                    <!-- <select class="form-control form-control-sm changesToAudit" labelToAudit="Color" oldValue=""  id="colorToAddToEdit" name="colorToAddToEdit">
                    </select> -->
                    <input type="text" name="colorToAddToEdit" labelToAudit="Color" oldValue="" id="colorToAddToEdit" class="changesToAudit form-control form-control-sm"  />

                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2 displayNone">
                    <label for="saleToAddToEdit">Sale:</label>
                    <input type="text" placeholder="Percentage" labelToAudit="Sale" oldValue="" name="saleToAddToEdit" id="saleToAddToEdit" class="changesToAudit form-control form-control-sm"  />
                    <input type="text" placeholder="Amount"  name="saleToAddAmount" id="saleToAddAmount" class="form-control form-control-sm"  />
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2 displayNone">
                    <label for="matchingWithToEdit">Matching Group:</label>
                    <input type="text" name="matchingWithToEdit" labelToAudit="MatchingGroup" oldValue="" id="matchingWithToEdit" class="changesToAudit form-control form-control-sm"  />
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2 displayNone">
                    <label for="initialQuantityToEdit">initial Quantity:</label>
                    <input type="text" name="initialQuantityToEdit" labelToAudit="InitialQuantity" oldValue="" id="initialQuantityToEdit" class="changesToAudit form-control form-control-sm"  />
                </div>


            </div>
        
            <div style="display: flex">
                <h6>Images Table:</h6>
                <i id="imageAttachIconInEdit" name="imageAttachIconInEdit" class="fa fa-paperclip ml-1" style="color: #0193f5; cursor:pointer;" title="Add Attachment"> </i>
                <input type="file" multiple name="hiddenAttachmentButton" id="hiddenAttachmentButton" class="displayNone">
            </div>
            <div id="imagesContainer" >
            </div>
         
            <div class="row">
                <div class="col-xl-12 mt-3 ">
                    <button type ="submit" id="submitEditItemButton" name="submitEditItemButton" style="float:right;" class ="btn btn-md blueButtonsCss">
                        <i class="fas fa-paper-plane" style="margin-right:5px; color:white;"> </i>
                        Edit Item 
                    </button>
                    <button type ="button" id="cancelEditItemButton" name="cancelEditItemButton" style="float:right;" class ="btn btn-md redButtonsCss">
                        <i class="fas fa-times" style="color:white; margin-right:5px;"> </i> 
                        Cancel 
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div  id="itemTableInLogin" name="itemTableInLogin" class="mt-2 ">
    </div>

</div>
<!-- manage item section end  -->



    <!-- manage cart section start  -->
    <div id="manageCart">
        <div class="row mt-3">
            <div class="col-lg-2 pr-0">
                <button type ="button" id="listOfLocalCartsButton"  name="listOfLocalCartsButton" class ="btn buttonStyle"><i style="margin-right:10px" class="fas fa-caret-down"></i>List Of Local Carts </button>
            </div>
            <div class="col-lg-10 lineClass">
            </div>
        </div>      
        <div class="row">
            <div class="col-xl-2 col-md-2 mt-1 pr-0">
                <select class="form-control form-control-sm selectpicker" multiple  name="selectToSortLocalCarts" id="selectToSortLocalCarts">
                    <option selected value="1">All</option>
                    <option value="5">Not Shipped</option>
                    <option value="9">Pending</option>
                    <!-- <option value="2">Shipped</option> -->
                    <!-- <option value="3">Submitted</option>
                    <option value="6">Not Submitted</option> -->
                    <option value="8">Restocked</option>
                </select>
            </div>
            <div class="col-xl-1">
                <i class="fas fa-sync-alt" id="refreshCart" style="color:green; font-size:15px; margin-top: 11px; cursor:pointer;"></i>
            </div>
            <div class="col-xl-2">
                <span class="" style="">From:</span>
                <div  class='input-group date' id='datetimepicker1' style="width:200px;">
                    <input type='text'  name="dateFrom" style="background-color:white;" id="dateFrom" class="form-control form-control-sm"  readonly="readonly"/>
                    <div class="input-group-append input-group-addon">
                        <span class="input-group-text far fa-calendar-alt dueDateBtn"></span>
                    </div>
                </div>
            </div>
            <div class="col-xl-2">
                <span class="" style="">To:</span>
                <div  class='input-group date ' id='datetimepicker2' style="width:200px;">
                    <input type='text'  name="dateTo" style="background-color:white;" id="dateTo" class="form-control form-control-sm"  readonly="readonly"/>
                    <div class="input-group-append input-group-addon">
                        <span class="input-group-text far fa-calendar-alt dueDateBtn"></span>
                    </div>
                </div>
            </div>
            <div class="col-xl-1 pl-0 mt-3">
                <p>Pending (<span id="numberOfPendingCarts" style="color:red;"></span>) </p>

            </div>
        </div>
        <div id="drawCartInLogin">
        </div>
        <form method="POST" id="editCartInLoginForm" name="editCartInLoginForm" class="displayNone">
            <div class="row form-group mt-2">  
                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                    <label for="topSpeedTrackingNumberInForm">TopSpeed tracking Numb:</label>
                    <input type="hidden" name="cartIdHiddenInForm" id="cartIdHiddenInForm">
                </div>
                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                    <input type="text" name="topSpeedTrackingNumberInForm" id="topSpeedTrackingNumberInForm" class="form-control form-control-sm"  />
                </div>
                <div class="col-xl-1" >
                    <label for="extraLbpInDisplay">Extra LBP:</label>
                </div>
                <div class="col-xl-1" >
                    <input type="text" id="extraLbpInDisplay" name="extraLbpInDisplay"  class="form-control form-control-sm">
                </div>
                <div class="col-xl-1" >
                    <label for="checkBoxForFreeDelivery">Free Delivery:</label>
                </div>
                <div class="col-xl-1" >
                    <input type="checkbox" id="checkBoxForFreeDelivery" name="checkBoxForFreeDelivery"  class="form-control form-control-sm">
                </div>
                <div class="col-xl-4 "> 
                    <button type ="submit" id="addEditTopSpeedForm" name="addEditTopSpeedForm" style="float:right;" class ="btn btn-md blueButtonsCss">
                        <i class="fas fa-paper-plane" style="margin-right:5px; color:white;"> </i>
                        Save
                    </button>
                    <button type ="button" id="cancelEditItemButtonInTopSpeedForm" name="cancelEditItemButton" style="float:right;" class ="btn btn-md redButtonsCss">
                        <i class="fas fa-times" style="color:white; margin-right:5px;"> </i> 
                        Cancel 
                    </button>
                </div>
            </div>
        </form>

        <form name="cartToEditForm" id="cartToEditForm" style="margin-bottom:20px;" class="displayNone">
            <div class="row mt-2"> 
                <div class="col-xl-4">
                    <div class="form-group">
                        <label for="fullNameInManageCarts">Full Name: *</label>
                        <input id="fullNameInManageCarts" name="fullNameInManageCarts" class="form-control form-control-sm" type="text">
                        <input id="cartToEditHiddenUserId" name="cartToEditHiddenUserId" class="form-control form-control-sm" type="hidden">
                    </div>
                </div>    

                <div class="col-xl-4">
                    <div class="form-group">
                        <label for="phoneNumberInManageCarts">Phone Number: *</label>
                        <input id="phoneNumberInManageCarts" name="phoneNumberInManageCarts" class="form-control form-control-sm" type="text">
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="form-group">
                        <label for="emailInManageCarts">Email: *</label>
                        <input id="emailInManageCarts" name="emailInManageCarts" class="form-control form-control-sm" type="text">
                    </div>
                </div>    
                <div class="col-xl-12">
                    <div class="form-group">
                        <label for="addressInManageCarts">Address: *</label>
                        <textarea name="addressInManageCarts" id="addressInManageCarts" class="form-control form-control-sm" rows="2"></textarea>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="form-group">
                        <label for="noteInManageCarts">Note: </label>
                        <textarea name="noteInManageCarts" id="noteInManageCarts" class="form-control form-control-sm" rows="2"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-2" style="text-align:center;">
                    <p>BarCode</p>
                </div>
                <div class="col-xl-2" style="text-align:center;">
                    <p>Quantity</p>
                </div>
                <div class="col-xl-2" style="text-align:center;">
                    <p>Product Code</p>
                </div>
                <div class="col-xl-3" style="text-align:center;">
                    <p>Color</p>
                </div>
                <div class="col-xl-2" style="text-align:center;">
                    <p>Size</p>
                </div>
                <div class="col-xl-1" style="text-align:center;">
                
                </div>
            </div>
            <div id="cartItemsToEdit">
            </div>
            
            <div class="row mt-2">
                <div class="col-xl-1" style="text-align:center;">
                    Discount:
                </div>
                <div class="col-xl-1" style="text-align:center;">
                    <input type="text" name="discountPercentage" id="discountPercentage" class="form-control form-control-sm"> %
                </div>
                <div class="col-xl-2" style="text-align:center;">
                    <input type="text" name="discountAmount" id="discountAmount" class="form-control form-control-sm">
                </div>
                <div class="col-xl-1" style="text-align:center;">
                    USD/LBP
                </div>
                <div class="col-xl-1" style="text-align:center;">
                    <input type="checkBox" name="currencyCheckboxInManageCarts" id="currencyCheckboxInManageCarts" title="CHECKED for USD UNCHECKED for LBP" style="float:left; margin-top:4px;">
                </div>
                <div class="col-xl-1" title="total quantity" style="text-align:center;">
                    Total Qty:
                </div>
                <div class="col-xl-1" style="text-align:center;">
                    <input type="text" name="totalQuantityInManageCart" disabled id="totalQuantityInManageCart" class="form-control form-control-sm">
                </div>
                <div class="col-xl-1" style="text-align:center;">
                    Total:
                </div>
                <div class="col-xl-2" style="text-align:center;">
                    <input type="text" name="totalToChangeInCarts" id="totalToChangeInCarts" readonly="readonly"  class="form-control form-control-sm">
                </div>
            </div> 
            <div class="row mt-2">
                <div class="col-xl-2 " style="margin-top:10px;" >
                    Are you sure you want to submit cart?
                    <input type="checkbox" style="margin-left:5px;" id="areYouSureYouWantToSubmitInEdit" name="areYouSureYouWantToSubmitInEdit" >
                </div>
                <div class="col-xl-1" >
                    <label for="employeeCodeInEdit">Employee Code:</label>
                </div>
                <div class="col-xl-1" >
                    <input type="text" id="employeeCodeInEdit" name="employeeCodeInEdit"  class="form-control form-control-sm">
                </div>
                <div class="col-xl-1" >
                    <label for="promoCodeInEdit">PromoCode:</label>
                </div>
                <div class="col-xl-1" >
                    <input type="text" id="promoCodeInEdit" name="promoCodeInEdit"  class="form-control form-control-sm">
                </div>
                <div class="col-xl-1" >
                    <label for="extraLbpInEdit">Extra LBP:</label>
                </div>
                <div class="col-xl-1" >
                    <input type="text" id="extraLbpInEdit" name="extraLbpInEdit"  class="form-control form-control-sm">
                </div>
                <!-- <div class="col-xl-2" >
                    <button class="pinkButtonsCss btn-md btn " id="editCartButtonInManageCarts" data-dismiss="modal" style="float:right;">Edit Cart</button>
                </div> -->
                <div class="col-xl-2" >
                    <button class="redButtonsCss btn-md btn" type="button" id="cancelCartToEditForm" data-dismiss="modal" style="float:right;">Cancel</button>
                </div>
            </div> 
        </form>
        
        <div  id="cartsInLogin" name="cartsInLogin" class="mt-2">
        </div>
    </div>
    <!-- manage cart section  -->



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
                    <h6>Amenities</h6>
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


    <!-- end container  -->
</div>






<div class="modal fade" id="deleteMainPageModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content "  >
            <div class="modal-header">
                <h5 style="font-size:14px;"><i class="fas fa-exclamation-triangle" style="margin-right:10px; font-size:16px; color:rgb(38, 140, 228) ;"></i>Attention</h5>
                <button type="button" class="close closeModal" data-dismiss="modal" id="closeModal" title="Close">×</button>
            </div>
            <div class="modal-body"  style="height:56px;"  >
                <p style="font-size:14px;">Are you sure you want to Delete All Checked ITEMS?  <span style="color:white;"> </span></p>
            </div>  
            <div class="modal-footer"  style="height:52px;" >
                <button class="btn btn-sm  redButtonsCssModal"  data-dismiss="modal" id="yesdeleteMainPageButton" style="float:right;">YES</button>
                <button class="btn btn-sm blueButtonsCssModal "  data-dismiss="modal" style="float:right;"> NO</button>
            </div>  
        </div>  
    </div>
</div>