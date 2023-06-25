$(document).ready(function (){ 

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
            $("#profileInfo").removeClass("displayNone");
        },20)
    })

    $("#manageCartsHeaderButton").click(function(){
        hideAll();
        $("#manageCartsHeaderButton").parent().addClass("greenBackground");
        $("#manageCartsHeaderButton").addClass("whiteColor");
        $("#manageCartsHeaderButton").children().addClass("whiteColor");
        $("#manageProperty").removeClass("displayNone");
    })

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

    $("#addPropertyButton").click(function(){
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
            marker.setLngLat([35.7 , 33.9]);
            marker.addTo(map);
                
            function onDragEnd() {
                const lngLat = marker.getLngLat();
                coordinates.style.display = 'block';
                coordinates.innerHTML = `Longitude: <span id="longitudeOfProperty">${lngLat.lng} </span><br />Latitude: <span id="latitudeOfProperty">${lngLat.lat}</span>`;
            }
                
            marker.on('dragend', onDragEnd);
        }
        $("#propertyCounterAddOrEdit").val(1);
        $("#managePropertyForm")[0].reset();
        $(".selectpicker").selectpicker("refresh");
        $("#managePropertyForm").slideDown();
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


    $("body").on("click", ".displayAdminPropertyInfoToEdit", function(){
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
                $("#propertyTitleInAdmin").val(data["title"]);
                $("#propertyDescriptionInAdmin").val(data["description"]);
                $("#propertyPriceInAdmin").val(data["price"]);
                $("#propertyLotSizeInAdmin").val(data["lotSize"]);
                $("#propertyNumberOfBedroomsInAdmin").val(data["numberOfBedrooms"]);
                $("#propertyAddressInAdmin").val(data["address"]);
                $("#propertyZipcodeInAdmin").val(data["zipCode"]);
                $("#propertyYearBuiltInAdmin").val(data["yearBuilt"]);
                $("#propertySaleOrRentInAdmin").val(data["saleOrRent"]);
                $("#displayAdminSectionPropertyInfo").slideDown();
            },
            error: function (error) {
                alert("Network Error Please Refresh The Page.");
            },
            complete: function(){
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
    
    
    $("#profileInfo").addClass("displayNone");
    $("#manageProperty").addClass("displayNone");
    $("#managePropertyForm").hide();
    $("#displayAdminSectionPropertyInfo").hide();
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

// ----------------------------------------------------------- //
function getAllPropertiesForAdmin() {
    $.ajax({
        url: baseURL + "/Rebelle/getAllPropertiesForAdmin",
        method: "POST",
        dataType: "json",
        beforeSend:function(){
            $(".loader").fadeIn(200);
        },
        success: function (data) {
            $("#propertyTableContainerForAdmin").html(data); 
            var propertySectionTableForAdmin = $('#propertySectionTableForAdmin').DataTable({
                "order": [[ 1, "desc" ]],
                "lengthMenu": [[100, 200, -1],[100, 200, "All"]]
            }); 
            
            $(".dataTables_filter").prepend(`<div class='clearSearchContainer'><i class="fas fa-times"></i></div>`);
            $("#propertyTableContainerForAdmin").on("click", ".clearSearchContainer", function () {
                $(this).siblings("label").children("input").val("").keyup();
                $(this).removeClass("moveClearSearchContainerLeft");
            });  
            $(".dataTables_filter input").attr('type', 'text');
            // $(".dataTables_filter input").val("");
            $("#propertyTableContainerForAdmin").on("keyup", ".dataTables_filter input", function () {
                var thisValue = $(this).val();
                if (thisValue == "") {
                    $(".clearSearchContainer").removeClass("moveClearSearchContainerLeft");
                }else {
                    $(".clearSearchContainer").addClass("moveClearSearchContainerLeft");
                }
            });
            $("#propertySectionTableForAdmin_length label").css("text-transform","capitalize");
            $(".dt-button span").html(`<i class="far fa-file-excel" style="font-size: 15px;margin-right: 5px;color: green; vertical-align: text-bottom;"></i> Excel`);
            $(function () {
                $('[data-toggle="tooltip"]').tooltip({
                    delay: { "show": 700, "hide": 0 }
                });
            })
        },
        error: function (error) {
            alert("Network Error Please Refresh The Page.");
        },
        complete: function(){
            $(".loader").fadeOut();
        }
    });   
}


