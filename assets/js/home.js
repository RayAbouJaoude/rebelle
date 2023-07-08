$(document).ready(function (){ 
    getItemsData();


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
    $('#datetimepicker, #datetimepicker1').datepicker({
        format: 'yyyy/mm/dd',
        autoclose: true,
        todayHighlight: true,
        clearBtn: true,
        forceParse: false
    }); 

    $("#manageItemsHeaderButton").click(function(){
        hideAll();
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

    $("#manageItemsHeaderButton").click();

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


    $("#submitPropertyButton").click(function(){
        postData = $("#managePropertyForm").serialize();
        longitude = $("#longitudeOfProperty").html();
        latitude = $("#latitudeOfProperty").html();
        
        $.ajax({
            url: baseURL + "/Rebelle/submitProperty",
            method: "POST",
            data: postData + "&longitude=" + longitude + "&latitude=" + latitude,
            dataType: "json",
            beforeSend:function(){
                $(".loader").fadeIn(300);
            },
            success: function (data) {
                if(data > 0){
                    $("#propertyIdHidden").val(data);
                    $("#propertyCounterAddOrEdit").val(2);
                }
            },
            error: function (error) {
                alert("Network Error Please Refresh The Page.");
            },
            complete: function(){
                getAllPropertiesInBackEnd();
                $(".loader").fadeOut();
            }
        });  
        return false;
    })


    $("body").on("click", ".statusIcon",function(){
        isChecked = $(this).attr("isChecked");
        dataId = $(this).attr("dataId");
        tochange = 0;
        $("[findTooltipStatus='" + dataId +"']").tooltip('hide')
       
        if($(this).children().attr("dataIsChecked") == 1){
            $(this).html('<img dataIsChecked="-1"  src="'+ baseURL +'assets/images/disabled2_small.png" />');
            $(this).attr("isChecked",-1);

        }else if ($(this).children().attr("dataIsChecked") == -1){
            $(this).html(' <img dataIsChecked="0"  src="'+ baseURL +'assets/images/nothing_small.png">');
            $(this).attr("isChecked",0);
        }else{
            $(this).html(' <img dataIsChecked="1"  src="'+ baseURL +'assets/images/enabled2_small.png">');
            $(this).attr("isChecked",1);
        }
        $.ajax({
            url: baseURL + "/Rebelle/statusIcon",
            data: "isChecked=" + isChecked + "&dataId=" + dataId,
            method: "POST",
            dataType: "json",
            async: false,
            beforeSend: function(){
                $("[findTooltipStatus='" + dataId +"']").tooltip('hide')

            },
            success: function (data) {  
                // getMainTable();
                $("[findTooltipStatus='" + dataId +"']").attr("data-original-title",data);

            },
            complete: function(){
                // $("[findTooltipStatus='" + dataId +"']").tooltip('show');
            },
            error: function (error) {
                alert("Network Error Please Refresh The Page.");
            }
        });
    })


    $("body").on("click", ".displayPropertyToEdit", function(){
        id = $(this).attr("dataId");
        $.ajax({
            url: baseURL + "/Rebelle/displayPropertyToEdit",
            method: "POST",
            data: "id=" + id,
            dataType: "json",
            beforeSend:function(){
                $(".loader").fadeIn(500);
            },
            success: function (data) {
                longitude = data["longitude"];
                latitude = data["latitude"];
                $("#longitudeOfProperty").val(longitude);
                $("#latitudeOfProperty").val(latitude);
                
                if(longitude == 0 || latitude == 0){
                    longitude = 35.7;
                    latitude = 33.9;
                }
                if ($("#map").length > 0 ){
                    mapboxgl.accessToken = 'pk.eyJ1Ijoic2NvcmF5IiwiYSI6ImNrdWNxcmJmNjBlb3kzMHBoMTBlanRncnAifQ.nUzt6aDopRt2STolFgt9FQ';
                    var map = new mapboxgl.Map({
                        container: 'map',
                        style: 'mapbox://styles/scoray/ckv6lh29a0h8215t54qb8g5au',
                        center: [  35.7 , 33.9], // starting position [lng, lat]
                        zoom: 9.5 // starting zoom
                    });
                    map.addControl(new mapboxgl.FullscreenControl());
             
                    // Add geolocate control to the map.
                    map.addControl(
                        new mapboxgl.GeolocateControl({
                            positionOptions: {
                            enableHighAccuracy: true
                            },
                            // When active the map will receive updates to the device's location as it changes.
                            trackUserLocation: true,
                            // Draw an arrow next to the location dot to indicate which direction the device is heading.
                            showUserHeading: true
                        })
                    );
                    map.on('idle',function(){
                        map.resize();
                    })
                    //------- Marker Draggable --------// 
                    const coordinates = document.getElementById('coordinates');
                    const marker = new mapboxgl.Marker({
                        draggable: true
                    });
                    marker.setLngLat([longitude , latitude]);
                    marker.addTo(map);
                        const lngLat = marker.getLngLat();
                        coordinates.style.display = 'block';
                        coordinates.innerHTML = `Longitude: <span id="longitudeOfProperty">${longitude} </span><br />Latitude: <span id="latitudeOfProperty">${latitude}</span>`; 
                    function onDragEnd() {
                        const lngLat = marker.getLngLat();
                        coordinates.style.display = 'block';
                        coordinates.innerHTML = `Longitude: <span id="longitudeOfProperty">${lngLat.lng} </span><br />Latitude: <span id="latitudeOfProperty">${lngLat.lat}</span>`;
                    }
                    marker.on('dragend', onDragEnd);
                }

                $("#propertyCounterAddOrEdit").val(2);
                $("#propertyIdHidden").val(data["id"]);
                $("#propertyTitle").val(data["title"]);
                $("#propertyDescription").val(data["description"]);
                $("#propertyPrice").val(data["price"]);
                $("#propertyLotSize").val(data["lotSize"]);
                $("#propertyNumberOfBedrooms").val(data["numberOfBedrooms"]);
                $("#propertyAddress").val(data["address"]);
                $("#propertyZipcode").val(data["zipCode"]);
                $("#propertyYearBuilt").val(data["yearBuilt"]);
                $("#propertySaleOrRent").val(data["saleOrRent"]);
                
                
            },
            error: function (error) {
                alert("Network Error Please Refresh The Page.");
            },
            complete: function(){
                $("#managePropertyForm").slideDown();
                $(".loader").fadeOut();
                $(".selectpicker").selectpicker("refresh");
                $("html").animate({
                    scrollTop:$(".container").offset().top 
                }, 500);
            }
        });  
        return false;
    })


    $("body").on("click", ".deletePropertyIcon",function(){
        $("#deleteModal").modal('show');
        $("#yesDeleteModalToChange").attr("id","yesDeletePropertyButton");
        idToDeletePropertyButton = $(this).attr("dataId");
    })
    
    $("body").on("click","#yesDeletePropertyButton",function(){
        $.ajax({
            method:"POST",
            data: "idToDelete=" + idToDeletePropertyButton ,
            url: baseURL + "Rebelle/deleteProperty",
            dataType:"JSON",
            success: function(data){
                getAllPropertiesInBackEnd();
            },
            error: function(){
                alert("Network Error Please Refresh The Page.");
            }
        })
    })


    $("body").on("click", ".deletePropertyIconForAdmin",function(){
        $("#deleteModal").modal('show');
        $("#yesDeleteModalToChange").attr("id","yesDeletePropertyButtonInAdmin");
        idToDeletePropertyButtonInAdmin = $(this).attr("dataId");
    })
    
    $("body").on("click","#yesDeletePropertyButtonInAdmin",function(){
        $.ajax({
            method:"POST",
            data: "idToDelete=" + idToDeletePropertyButtonInAdmin ,
            url: baseURL + "Rebelle/deletePropertyInAdmin",
            dataType:"JSON",
            success: function(data){
                getAllPropertiesForAdmin();
            },
            error: function(){
                alert("Network Error Please Refresh The Page.");
            }
        })
    })



    //..........ADD ITEM......./
    $("#submitAddItemButton").click(function () {
            var postData = $("#addItemsForm").serialize();
            quantityArr = [];
            sizeArr = [];
            colorArr = [];
            $(".itemQuantityToAddForNewItem").each( async function(){
                var quantity = $(this).val();
                var size = $(this).parent().next().children("input").val();
                var color = $(this).parent().next().next().children("input").val();
                if(quantity != ""  && size != "" && color !=""){
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
                            if($("#attachItemImage").val() ==""){
                                $("#attachItemImage").val("");
                                $("#addItemsForm").trigger('reset'); 
                                $("#labelForattachItemImage").html("Browse...");
                                $(".errorMessageChangeHtml").html('<i class="fas fa-check"  style="margin-right:10px; color:blue"></i>Item Added Successfully !');
                            }else{
                                // uploadItemImage();
                            }
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

        // }
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
                <input type="text" name="itemSizeToAddForNewItem" class="form-control sizeAndQuantityToAdd form-control-sm"  />

            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mt-2">
                <label for="colorToAddForNewItem">Color:</label>
                <input type="text" name="colorToAddForNewItem" class="form-control colorToAddForNewItem form-control-sm"  />

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
        fillColor();
        fillSize();
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
    // $("#managePropertyForm").hide();
    // $("#displayAdminSectionPropertyInfo").hide();
}


// ----------------------------------------------------------- //
function getAllPropertiesInBackEnd() {
    $.ajax({
        url: baseURL + "/Rebelle/getAllPropertiesInBackEnd",
        method: "POST",
        dataType: "json",
        beforeSend:function(){
            $(".loader").fadeIn(200);
        },
        success: function (data) {
            $("#propertyTableContainer").html(data); 
            var propertySectionTable = $('#propertySectionTable').DataTable({
                "order": [[ 1, "desc" ]],
                "lengthMenu": [[100, 200, -1],[100, 200, "All"]]
            }); 
            
            $(".dataTables_filter").prepend(`<div class='clearSearchContainer'><i class="fas fa-times"></i></div>`);
            $("#propertyTableContainer").on("click", ".clearSearchContainer", function () {
                $(this).siblings("label").children("input").val("").keyup();
                $(this).removeClass("moveClearSearchContainerLeft");
            });  
            $(".dataTables_filter input").attr('type', 'text');
            // $(".dataTables_filter input").val("");
            $("#propertyTableContainer").on("keyup", ".dataTables_filter input", function () {
                var thisValue = $(this).val();
                if (thisValue == "") {
                    $(".clearSearchContainer").removeClass("moveClearSearchContainerLeft");
                }else {
                    $(".clearSearchContainer").addClass("moveClearSearchContainerLeft");
                }
            });
            $("#propertySectionTable_length label").css("text-transform","capitalize");
            $(".dt-button span").html(`<i class="far fa-file-excel" style="font-size: 15px;margin-right: 5px;color: green; vertical-align: text-bottom;"></i> Excel`);
        },
        error: function (error) {
            alert("Network Error Please Refresh The Page.");
        },
        complete: function(){
            $(".loader").fadeOut();
        }
    });   
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