$(document).ready(function (){ 
    getItemsData();
    displayCardigan();
    getCartsData();

    $("body").on("keyup", "#cartsTable_filter input",function(){
        totalUsd=0.0;
        totalLbp=0.0;
        counterLbp  = 0;
        counterUsd  = 0;
        
        $(".totalLbpClass").each(function(){
            totalLbp= totalLbp + parseFloat($(this).attr("dataAmount"));
            counterLbp = counterLbp +1;
        })
        counter =  counterLbp ;
        // $("#totalUsdInCarts").html(totalUsd);   
        $("#totalLbpInCarts").html(totalLbp);   
        $("#totalNumberOfCarts").html(counter);   
    })

    allColors = '';
    allSizes = '';
    $("#cancelAddItemButton").click(function(){
        $("#addItemsForm").slideUp();
    })

    $("#attachIconAdd").click(function(){
        if($("#propertyIdHidden").val() == ""){
            $("#saveFirstModal").modal("show");
        }else{
            $("#hiddenAttachmentButtonAdd").click();
        }
    })

    $(document).on("change","#hiddenAttachmentButtonAdd",function(){
        var files = $(this)[0].files;
        var fileslength = files.length;
        var filesnames = [];
        for (var i = 0; i < fileslength; i++) {
            filesnames.push(this.files[i].name + '<br />');
        }
        var data = new FormData();
        jQuery.each(jQuery('#hiddenAttachmentButtonAdd')[0].files, function (i, file) {
            data.append('file-' + i, file);
        });
        data.append('transactionId', $("#propertyIdHidden").val());        
        $.ajax({
            url: `${baseURL}/Rebelle/uploadFiles`,
            method: 'POST',
            data: data,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $(".loader").fadeIn(200);
            },
            success: function (data) {
              
            },
            complete: function () {
                $(".loader").fadeOut();   
            }
        }); 
    })
    

    //-------//
    $(".theCard").click(function(){
        $(this).addClass("transformClass");
    })
        
    $("body").on("click", ".theBack",function(){
        $(this).parent().removeClass("transformClass");
    })
    $('#gender').selectpicker('val', $("#hiddenInputForGender").val());
    $(".selectpicker").selectpicker("refresh");
    $('#datetimepicker, #datetimepicker1, #datetimepicker2').datepicker({
        format: 'yyyy/mm/dd',
        autoclose: true,
        todayHighlight: true,
        clearBtn: true,
        forceParse: false
    }); 

    $("body").on("click", "#addItemButton",function(){
        $("#addItemsForm").slideDown();
        $("#addItemsForm").trigger("reset");
        $("#attachItemImage").val("");
    })

    $("#manageItemsHeaderButton").click(function(){
        hideAll();
        fillSize();
        fillColor();
        setTimeout(function(){
            $("#manageItemsHeaderButton").parent().addClass("greenBackground");
            $("#manageItemsHeaderButton").addClass("whiteColor");
            $("#manageItemsHeaderButton").children().addClass("whiteColor");
            $("#manageItemSection").removeClass("displayNone");
        },20)
    })

    $("#manageCartsHeaderButton").click(function(){
        hideAll();
        setTimeout(function(){
            $("#manageCartsHeaderButton").parent().addClass("greenBackground");
            $("#manageCartsHeaderButton").addClass("whiteColor");
            $("#manageCartsHeaderButton").children().addClass("whiteColor");
            $("#manageCart").removeClass("displayNone");
        },20)

    })

    $("#manageProfileHeaderButton").click(function(){
        hideAll();
        setTimeout(function(){
            $("#manageProfileHeaderButton").parent().addClass("greenBackground");
            $("#manageProfileHeaderButton").addClass("whiteColor");
            $("#manageProfileHeaderButton").children().addClass("whiteColor");
            $("#profileInfo").removeClass("displayNone");
        },20)

    })

    $("#manageProfileHeaderButton").click();

    $("#adminSectionHeaderButton").click(function(){
        hideAll();
        setTimeout(function(){
            getAllPropertiesForAdmin();
            $("#adminSectionHeaderButton").parent().addClass("greenBackground");
            $("#adminSectionHeaderButton").addClass("whiteColor");
            $("#adminSectionHeaderButton").children().addClass("whiteColor");
            $("#adminSection").removeClass("displayNone");
        },20)
    })

 
    $(".cancelButton").click(function(){
        $("#managePropertyForm").slideUp();
        $("#displayAdminSectionPropertyInfo").slideUp();
    })




    //..........ADD ITEM......./
    $("#submitAddItemButton").click(function () {
            var postData = $("#addItemsForm").serialize();
            quantityArr = [];
            sizeArr = [];
            colorArr = [];
            $(".itemQuantityToAddForNewItem").each( async function(){
                var quantity = $(this).val();
                var size = $(this).parent().next().children("select").val();
                var color = $(this).parent().next().next().children("select").val();
                if(quantity != ""  && size != "-1" && color != "-1"){
                    quantityArr.push(quantity);
                    sizeArr.push(size);
                    colorArr.push(color);
                }
            })
            $.ajax({
                url: baseURL + "/Rebelle/addItem",
                dataType: "JSON",
                data: postData + "&quantityArr="+ quantityArr + "&sizeArr="+ sizeArr + "&colorArr=" + colorArr,
                method: "POST",
                beforeSend:function(){
                    $(".loader").fadeIn(500);
                },
                success: function (data) { 
                        if(data[0]==0){
                            $("#itemBarCodeToAdd").val(data[1]);
                            $("#addItemsForm").trigger('reset'); 
                            // if($("#attachItemImage").val() ==""){
                                // $("#attachItemImage").val("");
                                // $("#labelForattachItemImage").html("Browse...");
                                // $(".errorMessageChangeHtml").html('<i class="fas fa-check"  style="margin-right:10px; color:blue"></i>Item Added Successfully !');
                            // }else{
                                // uploadItemImage();
                            // }
                        }else{
                            $("#pleaseFillAllFields").modal('show');
                        }
                        
                },complete: function(){
                        // $("#uploadItemImageButton").click();
                        getItemsData();
                        
                    
                },
                error: function () {
                    console.log("Error");
                }
            });
        return false;
    }); 

    $("body").on("click", ".insertNewRowInAddItem",function(){
        $(this).hide();
        $(".deleteRowInAddItem").show();
        append = `
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2">
                <label for="itemQuantityToAddForNewItem">Quantity:</label>
                <input type="text" name="itemQuantityToAddForNewItem" class="form-control  itemQuantityToAddForNewItem  form-control-sm"  />
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2">
                <label for="itemSizeToAddForNewItem">Size:</label>
                <select class="form-control form-control-sm itemSizeToAddForNewItem"   name="itemSizeToAddForNewItem">
                    ${allSizes}
                </select>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mt-2">
                <label for="colorToAddForNewItem">Color:</label>
                <select class="form-control form-control-sm colorToAddForNewItem"  name="colorToAddForNewItem">
                    ${allColors}
                </select>
            </div>
            <div class="col-xl-1">
                <a class="insertNewRowInAddItem" href="javascript:void(0);">       
                    <i class="fas fa-plus-circle" style="font-size:22px; color:#3498db; margin-top:43px;"></i>
                </a>
                <a class="deleteRowInAddItem" style="display:none;" href="javascript:void(0);">       
                    <i class="fas fa-minus-circle" style="font-size:22px; color:#dc3545; margin-top:43px;"></i>
                </a>
            </div>
        `;
        $(".toAppendNewSizeQ").append(append);
        $(".itemSizeToAddForNewItem").html();
        
    })

    $("body").on("click", ".deleteRowInAddItem",function(){
        $(this).parent().prev().prev().prev().remove();   
        $(this).parent().prev().prev().remove();   
        $(this).parent().prev().remove();
        $(this).parent().remove();
    })

    
    $("body").on("click", ".displayItemsToEdit",function(){
        itemId = $(this).attr("itemId");
        barCode = $(this).attr("barCode");
        $("#itemIdHidden").val(itemId);
        $("#barCodeHidden").val(barCode);
        $.ajax({
            url: baseURL + "/Rebelle/getItemDataInItemsToEdit",
            method: "POST",
            data :"itemId=" + itemId + "&barCode=" + barCode,
            dataType: "json",
            beforeSend:function(){
                $(".loader").fadeIn(500);
            },
            success: function (data) {
                $("#itemNameToAddToEdit").val(data[0]["itemName"]);
                $("#itemNameToAddToEdit").attr("oldvalue",data[0]["itemName"]);
                $("#itemDescriptionToAddToEdit").val(data[0]["itemDescription"]);
                $("#itemDescriptionToAddToEdit").attr("oldvalue",data[0]["itemDescription"]);
                $("#itemSupplierToAddToEdit").val(data[0]["supplier"]);
                $("#itemSupplierToAddToEdit").attr("oldvalue",data[0]["supplier"]);
                $("#itemBarCodeToAddToEdit").val(data[0]["barCode"]);
                $("#itemBarCodeToAddToEdit").attr("oldvalue",data[0]["barCode"]);
                $("#itemCategoryToAddToEdit").val(data[0]["categoryItems"]);
                $("#itemCategoryToAddToEdit").attr("oldvalue",data[0]["categoryItems"]);
                $("#itemGenderToAddToEdit").val(data[0]["gender"]);
                $("#itemGenderToAddToEdit").attr("oldvalue",data[0]["gender"]);
                cost = parseFloat(data[0]["cost"]);
                price = parseFloat(data[0]["price"]);
                cost = cost.toFixed(2).replace(/\.0+$/,'');;
                price = price.toFixed(2).replace(/\.0+$/,'');;
                $("#itemCostToAddToEdit").val(cost);
                $("#itemCostToAddToEdit").attr("oldvalue",cost);
                $("#itemPriceToAddToEdit").val(price);
                $("#itemPriceToAddToEdit").attr("oldvalue",price);
                $("#itemQuantityToAddToEdit").val(data[0]["quantity"]);
                $("#itemQuantityToAddToEdit").attr("oldvalue",data[0]["quantity"]);
                $("#itemSizeToAddToEdit").val(data[0]["size"]);
                $("#itemSizeToAddToEdit").attr("oldvalue", data[0]["size"]);
                $("#colorToAddToEdit").val(data[0]["color"]);
                $("#colorToAddToEdit").attr("oldvalue", data[0]["color"]);
                $("#itemWeightToAddToEdit").val(data[0]["weight"]);
                $("#itemWeightToAddToEdit").attr("oldvalue", data[0]["weight"]);
                $("#saleToAddToEdit").val(data[0]["sale"]);
                $("#saleToAddToEdit").attr("oldvalue", data[0]["sale"]);
                $("#matchingWithToEdit").val(data[0]["matchingWith"]);
                $("#matchingWithToEdit").attr("oldvalue", data[0]["matchingWith"]);
                $("#initialQuantityToEdit").val(data[0]["initialQuantity"]);
                $("#initialQuantityToEdit").attr("oldvalue", data[0]["initialQuantity"]);
                $("#saleToAddAmount").val("");
                
            },
            error: function (error) {
                console.log("Network Error Please Refresh The Page.");
            },
            complete: function(){
                $("#itemToEdit").slideDown();
                $(".loader").fadeOut();
                getItemImages();
                $("html").animate({
                    scrollTop:$("#listOfItemsButton").offset().top 
                }, 500);
            }
        });   
    })


    $("body").on("click", "#openSizeModal", function () {
        $("#addOrEditCounterInModal").val(1);
        getItemSizeInModal();
        $("#sizeModal").modal("show");
        $("#sizeNameToAddInModal").val("");
        $("#sizeIdHidden").val("");

    })
    $("body").on("click", "#openColorModal", function () {
        $("#addOrEditCounterInModalColor").val(1);
        getItemColorInModal();
        $("#colorModal").modal("show");
        $("#colorNameToAddInModal").val("");
        $("#colorIdHidden").val("");

    })

    $("#submitSize").click(function(){
        postData = $("#addSizeForm").serialize();
        $.ajax({
            url: baseURL + "/Rebelle/submitSize",
            method: "POST",
            data: postData,
            dataType: "json",
            beforeSend:function(){
                $(".loader").fadeIn();
            },
            success: function (data) {
                if(data >0 ){
                    $("#addOrEditCounterInModal").val(2);
                    $("#sizeIdHidden").val(data);
                }
                getItemSizeInModal();
                fillColor();
                fillSize();
            },
            error: function (error) {
                console.log("Network Error Please Refresh The Page.");
            },
            complete: function(){
                $(".loader").fadeOut();
            }
        });  
        return false;
    })
    //................//
    $("#editProfileButton").click(function(){
        postData = $("#profileForm").serialize();
        $.ajax({
            url: baseURL + "/Rebelle/editProfile",
            method: "POST",
            data: postData,
            dataType: "json",
            beforeSend:function(){
                $(".loader").fadeIn();
            },
            success: function (data) {
                
            },
            error: function (error) {
                console.log("Network Error Please Refresh The Page.");
            },
            complete: function(){
                $(".loader").fadeOut();
            }
        });  
        return false;
    })

    $("#submitColor").click(function(){
        postData = $("#addColorForm").serialize();
        $.ajax({
            url: baseURL + "/Rebelle/submitColor",
            method: "POST",
            data: postData,
            dataType: "json",
            beforeSend:function(){
                $(".loader").fadeIn();
            },
            success: function (data) {
                if(data >0 ){
                    $("#addOrEditCounterInModal").val(2);
                    $("#colorIdHidden").val(data);
                }
                getItemColorInModal();
                fillColor();
                fillSize();
            },
            error: function (error) {
                console.log("Network Error Please Refresh The Page.");
            },
            complete: function(){
                $(".loader").fadeOut();
            }
        });  
        return false;
    })
    //................//

    $("body").on("click", ".newCollectionItem",function(){
        itemId = $(this).attr("data-itemId");
        $.ajax({
            url: baseURL + "/Rebelle/newCollectionItem",
            dataType: "JSON",
            data: "itemId=" + itemId,
            method: "POST",
            success: function (data) { 
                getItemsData();
            },
            error: function () {
                console.log("Error");
            }
        });
        return false;
    })


    $("#deleteMainPageManyItems").click(function(){
        arrayToAddStorage=[];
        $(".itemCheckBox").each(function(){
            if($(this).prop("checked")){
                itemId = $(this).attr("dataId");
                arrayToAddStorage.push(itemId);
            }
        })
        if(arrayToAddStorage.length >0){
            $("#deleteMainPageModal").modal('show');
        }
    })
    $("#yesdeleteMainPageButton").click(function(){
       
        $.ajax({
            method:"POST",
            data: "arrayToAddStorage=" + arrayToAddStorage ,
            url: baseURL + "Rebelle/deleteMainPageItems",
            dataType:"JSON",
            success: function(data){
                getItemsData();
            },
            error: function(){
                alert("Network Error Please Refresh The Page.");
            }
        })
    })

    $("body").on("click", ".archiveItem",function(){
        itemId = $(this).attr("data-itemId");
        if($(this).children().hasClass("darkGreen")){
            $(this).children().removeClass("darkGreen");
            $(this).children().addClass("grey");
        }else{
            $(this).children().addClass("darkGreen");
            $(this).children().removeClass("grey");

        }
        $.ajax({
            url: baseURL + "/Rebelle/archiveItem",
            dataType: "JSON",
            data: "itemId=" + itemId,
            method: "POST",
            success: function (data) { 
            },
            error: function () {
                console.log("Error");
            }
        });
        return false;
    })

    $("body").on("click", ".exportedItem",function(){
        itemId = $(this).attr("data-itemId");
        if($(this).children().hasClass("blueColorForPlane")){
            $(this).children().removeClass("blueColorForPlane");
            $(this).children().addClass("grey");
        }else{
            $(this).children().addClass("blueColorForPlane");
            $(this).children().removeClass("grey");
        }
        $.ajax({
            url: baseURL + "/Rebelle/exportedItem",
            dataType: "JSON",
            data: "itemId=" + itemId,
            method: "POST",
            success: function (data) { 
            },
            error: function () {
                console.log("Error");
            }
        });
        return false;
    })

    $("#refreshItems")  .click(function(){
        getItemsData();  
    })


    $("body").on("click", ".deleteSizeInEdit",function(){
        dataId = $(this).attr("dataId");
        $.ajax({
            method:"POST",
            data: "dataId=" + dataId ,
            url: baseURL + "Rebelle/deleteSizeInModal",
            dataType:"JSON",
            
            success: function(){ 
                getItemSizeInModal();
            },
            error: function(){
                console.log("Network Error Please Refresh The Page.");
            }
        })
    })
    $("body").on("click", ".deleteColorInEdit",function(){
        dataId = $(this).attr("dataId");
        $.ajax({
            method:"POST",
            data: "dataId=" + dataId ,
            url: baseURL + "Rebelle/deleteColorInModal",
            dataType:"JSON",
            
            success: function(){ 
                getItemColorInModal();
            },
            error: function(){
                console.log("Network Error Please Refresh The Page.");
            }
        })
    })
    

    $("body").on("click", ".displaySizeToEdit",function(){
        dataId = $(this).attr("dataId");
        $("#sizeIdHidden").val(dataId);
        $.ajax({
            url: baseURL + "/Rebelle/displaySizeToEdit",
            method: "POST",
            data :"dataId=" + dataId,
            dataType: "json",
            beforeSend:function(){
                $(".loader").fadeIn(500);
            },
            success: function (data) {
                $("#sizeNameToAddInModal").val(data[0]["sizeName"]);
                $("#addOrEditCounterInModal").val(2);
                
            },
            error: function (error) {
                console.log("Network Error Please Refresh The Page.");
            },
            complete: function(){
                $(".loader").fadeOut();
            }
        });   
    })

    $("body").on("click", ".displayColorToEdit",function(){
        dataId = $(this).attr("dataId");
        $("#colorIdHidden").val(dataId);
        $.ajax({
            url: baseURL + "/Rebelle/displayColorToEdit",
            method: "POST",
            data :"dataId=" + dataId,
            dataType: "json",
            beforeSend:function(){
                $(".loader").fadeIn(500);
            },
            success: function (data) {
                    $("#addOrEditCounterInModalColor").val(2);
                    $("#colorNameToAddInModal").val(data[0]["colorName"]);
            },
            error: function (error) {
                console.log("Network Error Please Refresh The Page.");
            },
            complete: function(){
   
                $(".loader").fadeOut();
             
            }
        });   
    })


    $("body").on("click", "#addNewSize",function(){
        $("#sizeNameToAddInModal").val("");
        $("#addOrEditCounterInModal").val(1);
        $("#sizeIdHidden").val("");
    })
    $("body").on("click", "#addNewColor",function(){
        $("#colorNameToAddInModal").val("");
        $("#colorIdHidden").val("");
        $("#addOrEditCounterInModal").val(1);
    })

    //................//


    
    $("#imageAttachIconInEdit").click(function(){
        $("#hiddenAttachmentButton").click();
    })
    $(document).on("change","#hiddenAttachmentButton",function(){
        var files = $(this)[0].files;
        var fileslength = files.length;
        var filesnames = [];
        for (var i = 0; i < fileslength; i++) {
            filesnames.push(this.files[i].name + '<br />');
        }
        var data = new FormData();
        jQuery.each(jQuery('#hiddenAttachmentButton')[0].files, function (i, file) {
            data.append('file-' + i, file);
        });
        data.append('itemId', $("#itemIdHidden").val());        
        data.append('itemColor', $("#colorToAddToEdit").val());        
        data.append('barcode', $("#itemBarCodeToAddToEdit").val());        
        $.ajax({
            url: `${baseURL}/Rebelle/uploadImagesInEdit`,
            method: 'POST',
            data: data,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $(".loader").fadeIn(200);
            },
            success: function (data) {
                getItemImages();
            },
            complete: function () {
                $(".loader").fadeOut();   
            }
        }); 
    })

    $("#cancelEditItemButton").click(function(){
        $("#itemToEdit").slideUp();
    })


    $("#submitEditItemButton").click(function(){
        var postData = $("#editItemForm").serialize();
        var itemId = $("#itemIdHidden").val();
        var oldBarCode = $("#barCodeHidden").val();
        
        $.ajax({
            url: baseURL + "/Rebelle/editItemInLogin",
            method: "POST",
            data: postData + "&itemId=" + itemId + "&oldBarCode=" + oldBarCode ,
            dataType: "json",
            beforeSend:function(){
                $(".loader").fadeIn(500);
            },
            success: function (data) {
                if(data == 1){
                    $("#pleaseFillAllFields").modal("show");
                }else{
                    getItemsData();       
                }
            },
            error: function (error) {
                console.log("Network Error Please Refresh The Page.");
            },
            complete: function(){
                // $(".loader").fadeOut();
            }
        });  
        return false;
    })

    $(".categoryToDisplay").click(function(){
        category = $(this).attr("dataCategoryNumber");
        $.ajax({
            url: baseURL + "Shop/categoryToDisplay",
            dataType: "JSON",
            data: "category=" + category ,
            method: "POST",
            beforeSend:function(){
                $(".loader").fadeIn(500);
            },
            success: function (data) { 
                // $(".itemContainer").html(data);    
                $("main").html(data);    
                $("body .menuBtn").click();
                $(".cartContainer").hide();
                
            },complete:function(){
                $(".loader").fadeOut(500);
            },
            error: function () {
                console.log("Error");
            }
        });
        return false;
    })


    $("body").on("click", ".deleteImageInEdit",function(){
        itemImageIdToDeleteAttach = $(this).attr("data-deleteImageId");
        $("#deleteItemImageModalInItems").modal('show');
    })

    $("#yesDeleteItemImageInItems").click(function(){
        $.ajax({
            method:"POST",
            data: "itemImageIdToDeleteAttach=" + itemImageIdToDeleteAttach ,
            url: baseURL + "Rebelle/deleteItemImagesInItems",
            dataType:"JSON",
            success: function(){ 
               getItemImages();
            },
            error: function(){
                console.log("Network Error Please Refresh The Page.");
            }
        })
    })


    $("body").on("click", ".viewItemsButtons",function(){

        itemId = $(this).attr("itemId");
        itemName = $(this).attr("itemName");
        productCode = $(this).attr("productCode");
        $.ajax({
            url: baseURL + "/Shop/displayItemModal",
            dataType: "JSON",
            data: "itemId=" + itemId + "&itemName=" + itemName + "&productCode=" + productCode ,
            method: "POST",
            beforeSend:function(){
                $(".loader").fadeIn(500);
            },
            success: function (data) { 
                $("#itemModal .modal-content").html(data);    
                $("#itemModal").modal("show");

            },complete:function(){
                $(".loader").fadeOut(500);
            },
            error: function () {
                console.log("Error");
            }
        });
        return false;
    })
    $("body").on("click", ".itemColorInModal",function(){
        $(this).addClass("itemColorSelected");
        $(this).siblings().removeClass("itemColorSelected");
    })

    $("body").on("click", ".itemSizeInModal",function(){
        $(this).addClass("itemSizeSelected");
        $(this).siblings().removeClass("itemSizeSelected");
    })



    function displayCardigan(){
        $.ajax({
            url: baseURL + "/Shop/displayCardigan",
            dataType: "JSON",
            method: "POST",
            beforeSend:function(){
                $(".loader").fadeIn(500);
            },
            success: function (data) { 
                $("#newCardiganContainer").html(data);    
    
            },complete:function(){
                $(".loader").fadeOut(500);
            },
            error: function () {
                console.log("Error");
            }
        });
        return false;
    }
    
    //.................//
    $("#createAccountButton").click(function(){
        password = $("#passwordMainPage").val();
        confirmPassword = $("#passwordConfirmMainPage").val();
        email = $("#emailMainPage").val();
        if(!validateEmailAddress(email)) {
            $("#errorMessageInMainPage").html("Incorrect Email Format.")
			return false;
		}
        if(email.trim() == "" || password.trim() == "") {
            $("#errorMessageInMainPage").html("Please Fill All Fields.")
			return false;
        }
        if(password == confirmPassword){
            postData = $("#accountForm").serialize();
            $.ajax({
                url: baseURL + "/Home/createAccount",
                method: "POST",
                data: postData,
                dataType: "json",
                beforeSend:function(){
                    $(".loader").fadeIn();
                },
                success: function (data) {
                    if(data == -1){
                        $("#errorMessageInMainPage").html("Email Already Used.")
                    }else{
                        function pageRedirect() {
                            window.location.replace(baseURL + "/Login")
                        }      
                        setTimeout(pageRedirect(), 1000);
                    }
                },
                error: function (error) {
                    console.log("Network Error Please Refresh The Page.");
                },
                complete: function(){
                    $(".loader").fadeOut();
                }
            });  
        }else{
            $("#errorMessageInMainPage").html("Passwords Don't Match")

        }
        return false;
    })
    //................//


    
    $("body").on("click", ".addToCartInModalButton",function(){
        quantity = $("#itemQuantityInModal").val();
        itemSize = $(".itemSizeSelected").html();
        color = $(".itemColorSelected").html();
        itemBarCode = $(this).attr("itemBarCode");
        if($.trim($(".loginButtonInHeader").html()) == "LOGIN"){
            showError("Please Login First.");
            setTimeout(function(){
                window.location.replace(baseURL + "Login");
            },3000)
        }else{
            if(itemSize != undefined ||  color != undefined){
                $.ajax({
                    url: baseURL + "/Home/addToCart",
                    dataType: "JSON",
                    data: "quantity=" + quantity + "&itemSize=" + itemSize + "&itemBarCode=" + itemBarCode + "&color=" + color,
                    method: "POST",
                    beforeSend:function(){
                        $(".loader").fadeIn(500);
                    },
                    success: function (data) { 
                    
                    },complete:function(){
                        $(".loader").fadeOut(500);
                        // getCartItemsCount();
                        drawCartInHome();
                    },
                    error: function () {
                        console.log("Error");
                    }
                });
                return false;
            }
        }

    })

    $("body").on("click", "#purchaseButtonInCartSection",function(){
        $.ajax({
            url: baseURL + "/Home/drawTotalInPurchaseCartModal",
            dataType: "JSON",
            method: "POST",
            success: function (data) { 
                if(data[1].length > 0){
                    var errorMessage = "";
                    for (let index = 0; index < data[1].length; index++) {
                        var itemName= data[1][index][0];
                        var size= data[1][index][1];
                        var color= data[1][index][2];
                        var quantityLeft= data[1][index][3];
                        errorMessage += `Sorry, We only have ${quantityLeft} item(s) left for ${itemName} (${size}, ${color}). <br>`; 
                    }

                    errorMessage += "Please Edit Cart before purchasing.";

                    showError(errorMessage)
                }else{
                    $("#purchaseCartForm").trigger("reset");
                    $("#purchaseCartModal").modal("show");
                    $("#purchaseCartButtonInModal").css("display", "block");
                    $("#fullAmountWithShipInModal").html(data[0]);
                    $("#shippingInModalValue").html("4 $");

                }
               

            },
            error: function () {
                console.log("Error");
            }
        });
        return false;
    });

    $("#purchaseCartButtonInModal").click(function(){
        if (isValidPurchaseCartForm()) {
            submitPurchaseCartForm();
            $("#purchaseCartButtonInModal").hide();
        }
        return false;
    });


    function drawCartInHome(){
        $.ajax({
            url: baseURL + "/Home/drawCart",
            dataType: "JSON",
            method: "POST",
            success: function (data) { 
                if(data == -1){
                    $("#cartContainer").html("<center style='margin-top:60px;'> <h5> Cart Is Empty </h5> </center>")
                    $("#cartContainer").css("height","150px");
                }else{
                    $("#cartContainer").html(data);    
                    $("#cartContainer").css("height","500px");

                }
            },
            error: function () {  
            }
        });
        return false;
    }
    
    $(".cartButton").click(function(){
        $(".cartContainer").toggle();
        drawCartInHome();
    })

    $("body").on("click", ".removeItemFromCartIcon",function(){
        itemId = $(this).attr("idInCart");
        $.ajax({
            url: baseURL + "/Home/removeItemFromCart",
            dataType: "JSON",
            data: "itemId=" + itemId,
            method: "POST",
            success: function () { 
                $(".cartButton").click();
                // getCartItemsCount();
            },
            error: function () {
                console.log("Error");
            }
        });
        return false;
    })

    $("body").on("click", ".plusButtonInCart",function(){
        quantity= $(this).parent().children().next("span").html();
        quantity = parseInt(quantity) +1;
        // symbol = $("#symbolHidden").val();
        // $(this).parent().children().next("span").html(quantity);
        // price = $(this).parent().children("input").val();
        // price = parseInt(price) * parseInt(quantity);
        // $(this).parent().next().html(`<b> ${price} ${symbol}<b>`);
        // $(this).parent().next().digits();
        // $(this).parent().next().addClass("makeBold");
        itemId = $(this).attr("idInCart");
        $.ajax({
            url: baseURL + "/Home/changeItemQuantityFromCart",
            dataType: "JSON",
            data: "quantity=" + quantity + "&itemId=" + itemId,
            method: "POST",
            async:false,
            success: function () { 
                // $(".cartMainHeader").click();
                drawCartInHome();

            },
            error: function () {
                console.log("Error");
            }
        });
        return false;
    })

    $("body").on("click", ".minusButtonInCart",function(){
        quantity= $(this).next("span").html();
        if(parseInt(quantity) == 0){
        }else{
            quantity = parseInt(quantity) -1;
            itemId = $(this).attr("idInCart");
            $.ajax({
                url: baseURL + "/Home/changeItemQuantityFromCart",
                dataType: "JSON",
                data: "quantity=" + quantity + "&itemId=" + itemId,
                method: "POST",
                async:false,
                success: function () { 
                    // $(".cartMainHeader").click();
                    drawCartInHome();

                },
                error: function () {
                    console.log("Error");
                }
            });
        }
        return false;
    })


    $("body").on("click", ".displayCarts",function(){
        cartId = $(this).attr("cartId");
        $("#cartIdHiddenInForm").val(cartId);
        $.ajax({
            url: baseURL + "/Rebelle/displayCarts",
            dataType: "JSON",
            data: "cartId=" + cartId ,
            method: "POST",
            success: function (data) { 
                $("#drawCartInLogin").html(data[0]);
                $("#topSpeedTrackingNumberInForm").val(data[1]);
                $("#drawCartInLogin").slideDown();
                $("#editCartInLoginForm").slideDown();
                var cartTableInLogin = $('#cartTableInLogin').DataTable({
                    "dom": 'lBfrtip',
                    "buttons": [
                        {
                            'footer': 'true',
                            "extend": 'excel'
                        },
                        { 
                            'extend': 'print',
                            'footer': true,
                            'exportOptions': {
                            'columns': ':visible'
                            }
                        }
                    
                    ],
                    "lengthMenu": [[50, 100, 200, -1],[50, 100, 200, "All"]],
                    "language" : {
                        "sLengthMenu": "Show _MENU_"
                    },
                    "columnDefs": [ {
                        "targets": 0,
                        "orderable": false
                        } ]
                }); 
                if($("#cartTableInLogin_filter label input").val()==""){
                    $("#cartTableInLogin_filter label").append('<i class="fas fa-search" style="color:#A9A9A9; margin-left:5px; margin-right:5px; cursor:pointer; font-size:15px;" id="cartTableInLoginSearch"></i> <i class="fas fa-times" style="color:red; display:none; margin-left:5px; margin-right:5px; cursor:pointer; font-size:16px;" id="clearcartTableInLoginSearch"></i>');
                    $("#cartTableInLogin_filter label input").removeAttr("type").attr("type","text");
                    $("#clearcartTableInLoginSearch").hide();
                    $("#cartTableInLoginSearch").show();
                }else{
                    $("#cartTableInLogin_filter label").append('<i class="fas fa-search" style="color:#A9A9A9; margin-left:5px; margin-right:5px; cursor:pointer; font-size:15px;  display:none;" id="cartTableInLoginSearch"></i> <i class="fas fa-times" style="color:red; margin-left:5px; margin-right:5px; cursor:pointer; font-size:16px;" id="clearcartTableInLoginSearch"></i>');
                    $("#cartTableInLogin_filter label input").removeAttr("type").attr("type","text");
                    $("#clearcartTableInLoginSearch").show();
                    $("#cartTableInLoginSearch").hide();
                }
    
                $("#clearcartTableInLoginSearch").click(function(){
                    cartTableInLogin.search("").draw();
                    $("#clearcartTableInLoginSearch").hide();
                    $("#cartTableInLoginSearch").show();
                })
                $("#cartTableInLogin_filter label input").on("keyup change",function(){
                    searchInput = $("#cartTableInLogin_filter label input").val();
                    if (cartTableInLogin.search() != ""){
                        $("#clearcartTableInLoginSearch").show();
                        $("#cartTableInLoginSearch").hide();
                    }else{
                        $("#clearcartTableInLoginSearch").hide();
                        $("#cartTableInLoginSearch").show();
                    }
                })
            },
            error: function () {
                console.log("Error");
            }
        });
        return false;
    })



// last bracket 
})


// ----------------------------------------------------------- //
function hideAll(){
    $("#manageItemsHeaderButton").parent().removeClass("greenBackground");
    $("#manageItemsHeaderButton").removeClass("whiteColor");
    $("#manageItemsHeaderButton").children().removeClass("whiteColor");
    
    $("#manageCartsHeaderButton").parent().removeClass("greenBackground");
    $("#manageCartsHeaderButton").removeClass("whiteColor");
    $("#manageCartsHeaderButton").children().removeClass("whiteColor");
    
    $("#manageProfileHeaderButton").parent().removeClass("greenBackground");
    $("#manageProfileHeaderButton").removeClass("whiteColor");
    $("#manageProfileHeaderButton").children().removeClass("whiteColor");
    
    $("#profileInfo").addClass("displayNone");
    $("#manageItemSection").addClass("displayNone");
    $("#manageCart").addClass("displayNone");
 
}



function getItemsData() {
    archivedOrNot = $("#archiveOrNotSelect").val();
    category = $("#itemCategoryInMainPage").val();
    gender = $("#itemGenderInMainPage").val();
    showImage = $("#showImage").val();
    checkBoxForDescription = $("#checkBoxForDescription").val();
    if($("#checkBoxForDescription").prop("checked")){
        checkBoxForDescription = "on";
    }else{
        checkBoxForDescription = "";
    }
    $.ajax({
        url: baseURL + "/Rebelle/getItemsData",
        method: "POST",
        dataType: "json",
        data: "archivedOrNot=" + archivedOrNot + "&showImage=" + showImage + "&category=" + category + "&gender=" + gender + "&checkBoxForDescription=" + checkBoxForDescription,
        beforeSend:function(){
            $(".loader").fadeIn(500);
        },
        success: function (data) {
            $("#itemTableInLogin").html(data); 
            // "order": [[ 1, "asc" ]],
            var itemsTable = $('#itemsTable').DataTable({
                "dom": 'lBfrtip',
                "buttons": [
                    {
                        "extend": 'excel', 
                        "footer": true ,
                        "exportOptions": {
                        "columns": ':gt(0)' 
                        }
                    }
                ],
                "lengthMenu": [[50, 100, 200, -1],[50, 100, 200, "All"]],
                "language" : {
                    "sLengthMenu": "Show _MENU_"
                },
                "stateSave": true,
                "columnDefs": [ {
                    "targets": 0,
                    "orderable": false
                    } ]
            }); 

            if($("#itemsTable_filter label input").val()==""){
                $("#itemsTable_filter label").append('<i class="fas fa-search" style="color:#A9A9A9; margin-left:5px; margin-right:5px; cursor:pointer; font-size:15px;" id="itemsTableSearch"></i> <i class="fas fa-times" style="color:red; display:none; margin-left:5px; margin-right:5px; cursor:pointer; font-size:16px;" id="clearitemsTableSearch"></i>');
                $("#itemsTable_filter label input").removeAttr("type").attr("type","text");
                $("#clearitemsTableSearch").hide();
                $("#itemsTableSearch").show();
            }else{
                $("#itemsTable_filter label").append('<i class="fas fa-search" style="color:#A9A9A9; margin-left:5px; margin-right:5px; cursor:pointer; font-size:15px;  display:none;" id="itemsTableSearch"></i> <i class="fas fa-times" style="color:red; margin-left:5px; margin-right:5px; cursor:pointer; font-size:16px;" id="clearitemsTableSearch"></i>');
                $("#itemsTable_filter label input").removeAttr("type").attr("type","text");
                $("#clearitemsTableSearch").show();
                $("#itemsTableSearch").hide();
            }

            $("#clearitemsTableSearch").click(function(){
                itemsTable.search("").draw();
                $("#clearitemsTableSearch").hide();
                $("#itemsTableSearch").show();
            })
            $("#itemsTable_filter label input").on("keyup change",function(){
                searchInput = $("#itemsTable_filter label input").val();
                if (itemsTable.search() != ""){
                    $("#clearitemsTableSearch").show();
                    $("#itemsTableSearch").hide();
                }else{
                    $("#clearitemsTableSearch").hide();
                    $("#itemsTableSearch").show();
                }
            })
            
        },
        error: function (error) {
            console.log("Network Error Please Refresh The Page.");
        },
        complete: function(){
            $(".loader").fadeOut();
        }
    });   
}




function getItemSizeInModal() {
    $.ajax({
        url: baseURL + "/Rebelle/getItemSizeInModal",
        method: "POST",
        dataType: "json",
        success: function (data) {
            $("#sizeTableContainer").html(data); 
            var sizeTable = $('#sizeTable').DataTable({
                  
                    "lengthMenu": [[50, 100, 200, -1],[50, 100, 200, "All"]],
                    "language" : {
                        "sLengthMenu": "Show _MENU_"
                    },
                    "stateSave": true,
                    "columnDefs": [ {
                        "targets": 0,
                        "orderable": false
                        } ]
                }); 
    
                if($("#sizeTable_filter label input").val()==""){
                    $("#sizeTable_filter label").append('<i class="fas fa-search" style="color:#A9A9A9; margin-left:5px; margin-right:5px; cursor:pointer; font-size:15px;" id="sizeTableSearch"></i> <i class="fas fa-times" style="color:red; display:none; margin-left:5px; margin-right:5px; cursor:pointer; font-size:16px;" id="clearsizeTableSearch"></i>');
                    $("#sizeTable_filter label input").removeAttr("type").attr("type","text");
                    $("#clearsizeTableSearch").hide();
                    $("#sizeTableSearch").show();
                }else{
                    $("#sizeTable_filter label").append('<i class="fas fa-search" style="color:#A9A9A9; margin-left:5px; margin-right:5px; cursor:pointer; font-size:15px;  display:none;" id="sizeTableSearch"></i> <i class="fas fa-times" style="color:red; margin-left:5px; margin-right:5px; cursor:pointer; font-size:16px;" id="clearsizeTableSearch"></i>');
                    $("#sizeTable_filter label input").removeAttr("type").attr("type","text");
                    $("#clearsizeTableSearch").show();
                    $("#sizeTableSearch").hide();
                }
    
                $("#clearsizeTableSearch").click(function(){
                    sizeTable.search("").draw();
                    $("#clearsizeTableSearch").hide();
                    $("#sizeTableSearch").show();
                })
                $("#sizeTable_filter label input").on("keyup change",function(){
                    searchInput = $("#sizeTable_filter label input").val();
                    if (sizeTable.search() != ""){
                        $("#clearsizeTableSearch").show();
                        $("#sizeTableSearch").hide();
                    }else{
                        $("#clearsizeTableSearch").hide();
                        $("#sizeTableSearch").show();
                    }
                }) 
        },
        error: function (error) {
            console.log("Network Error Please Refresh The Page.");
        }
    });   
}


function getItemColorInModal() {
    $.ajax({
        url: baseURL + "/Rebelle/getItemColorInModal",
        method: "POST",
        dataType: "json",
        success: function (data) {
            $("#colorTableContainer").html(data); 
            var colorTable = $('#colorTable').DataTable({
                  
                    "lengthMenu": [[50, 100, 200, -1],[50, 100, 200, "All"]],
                    "language" : {
                        "sLengthMenu": "Show _MENU_"
                    },
                    "stateSave": true,
                    "columnDefs": [ {
                        "targets": 0,
                        "orderable": false
                        } ]
                }); 
    
                if($("#colorTable_filter label input").val()==""){
                    $("#colorTable_filter label").append('<i class="fas fa-search" style="color:#A9A9A9; margin-left:5px; margin-right:5px; cursor:pointer; font-size:15px;" id="colorTableSearch"></i> <i class="fas fa-times" style="color:red; display:none; margin-left:5px; margin-right:5px; cursor:pointer; font-size:16px;" id="clearcolorTableSearch"></i>');
                    $("#colorTable_filter label input").removeAttr("type").attr("type","text");
                    $("#clearcolorTableSearch").hide();
                    $("#colorTableSearch").show();
                }else{
                    $("#colorTable_filter label").append('<i class="fas fa-search" style="color:#A9A9A9; margin-left:5px; margin-right:5px; cursor:pointer; font-size:15px;  display:none;" id="colorTableSearch"></i> <i class="fas fa-times" style="color:red; margin-left:5px; margin-right:5px; cursor:pointer; font-size:16px;" id="clearcolorTableSearch"></i>');
                    $("#colorTable_filter label input").removeAttr("type").attr("type","text");
                    $("#clearcolorTableSearch").show();
                    $("#colorTableSearch").hide();
                }
    
                $("#clearcolorTableSearch").click(function(){
                    colorTable.search("").draw();
                    $("#clearcolorTableSearch").hide();
                    $("#colorTableSearch").show();
                })
                $("#colorTable_filter label input").on("keyup change",function(){
                    searchInput = $("#colorTable_filter label input").val();
                    if (colorTable.search() != ""){
                        $("#clearcolorTableSearch").show();
                        $("#colorTableSearch").hide();
                    }else{
                        $("#clearcolorTableSearch").hide();
                        $("#colorTableSearch").show();
                    }
                }) 
        },
        error: function (error) {
            console.log("Network Error Please Refresh The Page.");
        }
    });   
}




//................//
function fillColor() {
	$.ajax({
		url: baseURL + "/Rebelle/fillColor",
		method: "POST",
		dataType: "JSON",
		success: function (data) {
			$("#colorToAdd").html(`<option value="-1">--Select-- </option>`);
			$("#colorToAddToEdit").html(`<option value="-1">--Select-- </option>`);
			$(".colorToAddForNewItem").html(`<option value="-1">--Select-- </option>`);
            allColors =   '<option value="-1">--Select-- </option>';

			for (var i = 0; i < data.length; i++) {
				$("#colorToAdd").append(`<option value="${data[i]["colorName"]}">${data[i]["colorName"]}</option>`);
				$("#colorToAddToEdit").append(`<option value="${data[i]["colorName"]}">${data[i]["colorName"]}</option>`);
				$(".colorToAddForNewItem").append(`<option value="${data[i]["colorName"]}">${data[i]["colorName"]}</option>`);
                allColors = allColors + ` <option value="${data[i]["colorName"]}">${data[i]["colorName"]}</option> `;

			}
		},
		error: function (error) {
			alert("Network Error Please Refresh The Page.");
		},
	});
}

//................//
function fillSize() {
	$.ajax({
		url: baseURL + "/Rebelle/fillSize",
		method: "POST",
		dataType: "JSON",
		success: function (data) {
			$("#itemSizeToAdd").html(`<option value="-1">--Select-- </option>`);
			$("#itemSizeToAddToEdit").html(`<option value="-1">--Select-- </option>`);
			$(".itemSizeToAddForNewItem").html(`<option value="-1">--Select-- </option>`);
            allSizes =   '<option value="-1">--Select-- </option>';
			for (var i = 0; i < data.length; i++) {
				$("#itemSizeToAdd").append(`<option value="${data[i]["sizeName"]}">${data[i]["sizeName"]}</option>`);
				$("#itemSizeToAddToEdit").append(`<option value="${data[i]["sizeName"]}">${data[i]["sizeName"]}</option>`);
				$(".itemSizeToAddForNewItem").append(`<option value="${data[i]["sizeName"]}">${data[i]["sizeName"]}</option>`);
                allSizes = allSizes + ` <option value="${data[i]["sizeName"]}">${data[i]["sizeName"]}</option> `;
            }

		},
		error: function (error) {
			alert("Network Error Please Refresh The Page.");
		},
	});
}



//.......GET IMAGES
function getItemImages() {
    var itemId = $("#itemIdHidden").val();
    $.ajax({
        url: baseURL + "/Rebelle/getItemImages",
        data: "itemId=" + itemId,
        method: "POST",
        dataType: "json",
        success: function (data) {
            $("#imagesContainer").html(data); 
            var imagesTable = $('#imagesTable').DataTable({
                  
                    "lengthMenu": [[50, 100, 200, -1],[50, 100, 200, "All"]],
                    "language" : {
                        "sLengthMenu": "Show _MENU_"
                    },
                    "stateSave": true,
                    "columnDefs": [ {
                        "targets": 0,
                        "orderable": false
                        } ]
                }); 
    
                if($("#imagesTable_filter label input").val()==""){
                    $("#imagesTable_filter label").append('<i class="fas fa-search" style="color:#A9A9A9; margin-left:5px; margin-right:5px; cursor:pointer; font-size:15px;" id="imagesTableSearch"></i> <i class="fas fa-times" style="color:red; display:none; margin-left:5px; margin-right:5px; cursor:pointer; font-size:16px;" id="clearimagesTableSearch"></i>');
                    $("#imagesTable_filter label input").removeAttr("type").attr("type","text");
                    $("#clearimagesTableSearch").hide();
                    $("#imagesTableSearch").show();
                }else{
                    $("#imagesTable_filter label").append('<i class="fas fa-search" style="color:#A9A9A9; margin-left:5px; margin-right:5px; cursor:pointer; font-size:15px;  display:none;" id="imagesTableSearch"></i> <i class="fas fa-times" style="color:red; margin-left:5px; margin-right:5px; cursor:pointer; font-size:16px;" id="clearimagesTableSearch"></i>');
                    $("#imagesTable_filter label input").removeAttr("type").attr("type","text");
                    $("#clearimagesTableSearch").show();
                    $("#imagesTableSearch").hide();
                }
    
                $("#clearimagesTableSearch").click(function(){
                    imagesTable.search("").draw();
                    $("#clearimagesTableSearch").hide();
                    $("#imagesTableSearch").show();
                })
                $("#imagesTable_filter label input").on("keyup change",function(){
                    searchInput = $("#imagesTable_filter label input").val();
                    if (imagesTable.search() != ""){
                        $("#clearimagesTableSearch").show();
                        $("#imagesTableSearch").hide();
                    }else{
                        $("#clearimagesTableSearch").hide();
                        $("#imagesTableSearch").show();
                    }
                }) 
        },
        error: function (error) {
            console.log("Network Error Please Refresh The Page.");
        }
    });   
}


function validateEmailAddress(email){
    var pattern = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return email.match(pattern);
}




// ----------------------------------------------------------- //
// ----------------------------------------------------------- //
function isValidPurchaseCartForm()
{
    var name = $("#customerFullNameInPurchaseCartModal").val();
    var phoneNumber = $("#telephoneInPurchaseCartModal").val();
    var country = $("#purchaseCartCountry").val();
    country = "LB";
    var cardNumber = $("#purchaseCardNumber").val();
    var cardCVV = $("#purchaseCardCVV").val();

    var state = $("#purchaseCartState").val();
    var city = $("#purchaseCartCity").val();
    var zipCode = $("#purchaseCartZipCode").val();

    var addressText = $("#addressInPurchaseCartModal").val();

    if (name.trim() == "") {
        console.log("The Full Name field is required.");
        $("#purchaseCartModalHeader").html("Please Enter Your Name.");
        return false;
    }
    if (phoneNumber.trim() == "") {
        console.log("The Phone Number field is required.");
        return false;
    } else {
        if (!isValidPhoneNumber(phoneNumber)) {
            console.log("Phone Number Not Valid.");
            $("#purchaseCartModalHeader").html("Invalid Phone Number");
            return false;
        }
    }
    if (country == -1) {
        console.log("The Country field is required.");
        return false;
    } else {
        if (country == "LB") {
            if (addressText.trim() == "") {
                console.log("The Address field is required.");
                $("#purchaseCartModalHeader").html("The Address field is required.");
                return false;
            }
        } else {
            
            if (cardNumber.trim() == "") {
                console.log("The Card Number field is required.");
                return false;
            }
            if (cardCVV.trim() == "") {
                console.log("The CVV field is required.");
                return false;
            }
            if (state.trim() == "") {
                console.log("The State field is required.");
                return false;
            }
            if (city.trim() == "") {
                console.log("The City field is required.");
                return false;
            }
            if (zipCode.trim() == "") {
                console.log("The Zip Code field is required.");
                return false;
            }
        }
    }
    return true;
}
// ----------------------------------------------------------- //
function isValidPhoneNumber(phoneNumb) 
{
	var pattern = /^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/;
    return phoneNumb.match(pattern);
}




// ----------------------------------------------------------- //
function submitPurchaseCartForm()
{
    var clientName = $("#customerFullNameInPurchaseCartModal").val();
    var phoneNumber = $("#telephoneInPurchaseCartModal").val();
    var addressText = $("#addressInPurchaseCartModal").val();
    $.ajax({
        method: "POST",
        url: baseURL + "/Home/purchaseCart",
        dataType: "JSON",
        data: $("#purchaseCartForm").serialize(),
        async: false,
        beforeSend:function(){
            $(".loader").fadeIn(500);
        },
        success: function (data) { 
            var flag = data[0];
            var msg = data[1];
            if (flag == -1) {
                console.log(msg);
                $("#purchaseCartButtonInModal").css("display", "block");
                $("#purchaseCartModal").modal("hide");
                showError("Purchase failed try again.");
            } else {
                $("#purchaseCartModal").modal("hide");
                showError("Thank you, your order was purchased successfully and will be delivered within 3 working days.");
               
            }
        },
        error: function () {
            console.log("Error occured. Please try again later.");
        },
        complete: function(){
            drawCartInHome();
            $(".loader").fadeOut(100);
        }
    });
}




// ----------------------------------------------------------- //
function showError(errorMessage) 
{
	$("#errorModal .modal-body").html(errorMessage);
	$("#errorModal").modal();
}



function getCartsData() {
    selectValues = $("#selectToSortLocalCarts").val();
    fromDate = $("#dateFrom").val();
    toDate = $("#dateTo").val();
  
    $.ajax({
        url: baseURL + "/Rebelle/getCartsData",
        method: "POST",
        dataType: "json",
        data: "selectValues=" + selectValues + "&fromDate=" + fromDate + "&toDate=" + toDate,
        beforeSend:function(){
            $(".loader").fadeIn(500);
        },
        success: function (data) {
            $("#cartsInLogin").html(data); 
            var cartsTable = $('#cartsTable').DataTable({
                "dom": 'lBfrtip',
                "buttons": [
                    {
                        "footer": true ,
                        "extend": 'excel', 
                        "exportOptions": {
                        "columns": ':gt(0)' 
                        }
                    }
                ],
                "lengthMenu": [[-1, 50, 100, 200 ],["All", 50, 100, 200]],
                "stateSave": true,
                "iDisplayLength": -1,
                "language" : {
                    "sLengthMenu": "Show _MENU_"
                },
                // "stateSave": true,
                "columnDefs": [ {
                    "targets": 0,
                    "orderable": false
                } ],
                'order': [[1, 'asc']]
            }); 

            if($("#cartsTable_filter label input").val()==""){
                $("#cartsTable_filter label").append('<i class="fas fa-search" style="color:#A9A9A9; margin-left:5px; margin-right:5px; cursor:pointer; font-size:15px;" id="cartsTableSearch"></i> <i class="fas fa-times" style="color:red; display:none; margin-left:5px; margin-right:5px; cursor:pointer; font-size:16px;" id="clearcartsTableSearch"></i>');
                $("#cartsTable_filter label input").removeAttr("type").attr("type","text");
                $("#clearcartsTableSearch").hide();
                $("#cartsTableSearch").show();
            }else{
                $("#cartsTable_filter label").append('<i class="fas fa-search" style="color:#A9A9A9; margin-left:5px; margin-right:5px; cursor:pointer; font-size:15px;  display:none;" id="cartsTableSearch"></i> <i class="fas fa-times" style="color:red; margin-left:5px; margin-right:5px; cursor:pointer; font-size:16px;" id="clearcartsTableSearch"></i>');
                $("#cartsTable_filter label input").removeAttr("type").attr("type","text");
                $("#clearcartsTableSearch").show();
                $("#cartsTableSearch").hide();
            }

            $("#clearcartsTableSearch").click(function(){
                cartsTable.search("").draw();
                $("#clearcartsTableSearch").hide();
                $("#cartsTableSearch").show();
            })
            $("#cartsTable_filter label input").on("keyup change",function(){
                searchInput = $("#cartsTable_filter label input").val();
                if (cartsTable.search() != ""){
                    $("#clearcartsTableSearch").show();
                    $("#cartsTableSearch").hide();
                }else{
                    $("#clearcartsTableSearch").hide();
                    $("#cartsTableSearch").show();
                }
            })
        },
        error: function (error) {
            console.log("Network Error Please Refresh The Page.");
        },
        complete: function(){
            $(".loader").fadeOut();
            $("#cartsTable_filter input").keyup();
        }
    });   
}