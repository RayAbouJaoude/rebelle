$(document).ready(function (){
    getAllPropertiesForSale();
    $("body").on("click", ".openPropertyFullInfo",function(){
        propertyId = $(this).attr("propertyId");
        window.open(`${baseURL}/PropertyInfo?propertyId=` +  encodeURIComponent(propertyId),"_self");    
    })

    $("#openMapViewButton").click(function(){
        $("#mapview").removeClass("displayNone");
        $("#propertyForSaleContainer").addClass("displayNone");
        getAllPropertiesForSaleInMapView();
        displayAllPins();
    })
})

// ----------------------------------------------------------- //
function getAllPropertiesForSale() {
    $.ajax({
        url: baseURL + "/ForSale/getAllPropertiesForSale",
        method: "POST",
        dataType: "json",
        beforeSend:function(){
            $(".loader").fadeIn(200);
        },
        success: function (data) {
            $("#propertyForSaleContainer").html(data); 
           
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

//**************************** */
function displayAllPins(){
    $.ajax({
        url: baseURL + "/ForSale/displayAllPins",
        method: "POST",
        dataType: "json",
        beforeSend:function(){
            $(".loader").fadeIn(500);
        },
        success: function (data) {
            var arr = [];
            for (let i = 0; i < data.length; i++) {
                longitude = data[i]["longitude"];
                latitude = data[i]["latitude"];
                price = data[i]["price"];
                description = data[i]["description"];
                title = data[i]["title"];
                id = data[i]["id"];
                price = data[i]["price"];
                price = price + "$";
                msg = 
                { 
                    'type': 'Feature',
                    'geometry': {
                        'type': 'Point',
                        'coordinates': [
                            longitude, latitude
                        ]
                    },
                    'properties': {
                        'description':
                        ' <img style="width:100%; border-top-left-radius: 12px !important; border-top-right-radius: 12px !important;" src="https://lb961.com/assets/images/squareImageOne.png"><strong><p style="text-align:center; margin-bottom:0px !important;">'+ title + '</p><p style="text-align:center; overflow-y: auto; height: 100px;">' +description +' </p> </strong>',
                        'title': title,
                        'message': id,
                        'price': price
                    }
                };
                arr.push(msg);
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

                // *****************//
                map.on('load', () => {
                    // Add an image to use as a custom marker
                    map.loadImage(
                        baseURL + 'assets/images/pin.png',
                        (error, image) => {
                            if (error) throw error;
                            map.addImage('custom-marker', image);
                            // Add a GeoJSON source with 2 points
                            
                            
                            map.addSource('points', {
                                    'type': 'geojson',

                                    'data': {
                                        'type': 'FeatureCollection',
                                        //created above
                                        'features': 
                                            arr
                                        
                                    }
                            });    
                            
                            // Add a symbol layer
                            map.addLayer({
                                'id': 'points',
                                'type': 'circle',
                                'source': 'points',
                                // 'layout': {
                                    // 'icon-image': 'custom-marker',
                                    // 'icon-size' : 0.8,
                                    // get the title name from the source's "title" property
                                    // 'text-field': ['get', 'title'],
                                    // 'text-font': [
                                    //     'Open Sans Semibold',
                                    //     'Arial Unicode MS Bold'
                                    // ],
                                    // 'text-size': 16,
                                    // 'text-offset': [0, 1.25],
                                    // 'text-anchor': 'top'
                                // },
                                
                                "paint": {
                                    "circle-radius": 22,
                                    "circle-color": "#055E20"
                                }
                            });

                            map.addLayer({
                                "id": "points-label",
                                "type": "symbol",
                                "source": "points",
                                "layout": {
                                  "text-field": ['get', 'price'],
                                  "text-font": [
                                    "DIN Offc Pro Medium",
                                    "Arial Unicode MS Bold"
                                  ],
                                  "text-size": 10,
                                  "text-letter-spacing": 0.05
                                  
                                },"paint": {
                                    "text-color": "#FFF"
                                }
                            });

                            // When a click event occurs on a feature in the places layer, open a popup at the
                            // location of the feature, with description HTML from its properties.
                            map.on('click', 'points', (e) => {
                                // Copy coordinates array.
                                const coordinates = e.features[0].geometry.coordinates.slice();
                                const description = e.features[0].properties.description;
                                $(".propertyOnHover").each(function(){
                                    $(this).removeClass('addClassHover');

                                })
                                $(".propertyOnHover[propertyid='" + e.features[0].properties.message + "']").addClass('addClassHover');
                                $("#propertyForSaleInMapViewContainer").animate({
                                    scrollTop:$(".propertyOnHover[propertyid='" + e.features[0].properties.message + "']").offset().top 
                                }, 500);
                                
                                var container = $('#propertyForSaleInMapViewContainer').children();
                                var scrollTo = $(".propertyOnHover[propertyid='" + e.features[0].properties.message + "']");
                    
                                // Calculating new position
                                // of scrollbar
                                var position = scrollTo.offset().top 
                                    - container.offset().top 
                                    + container.scrollTop();
                    
                                // Animating scrolling effect
                                container.animate({
                                    scrollTop: position
                                });
                                
                                // Ensure that if the map is zoomed out such that multiple
                                // copies of the feature are visible, the popup appears
                                // over the copy being pointed to.
                                while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
                                    coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
                                }
            
                                new mapboxgl.Popup()
                                .setLngLat(coordinates)
                                .setHTML(description)
                                .addTo(map);
                            });
                            map.on('click', (e) => {
                                if($(".mapboxgl-popup").html() == undefined){
                                    $(".propertyOnHover").each(function(){
                                        $(this).removeClass('addClassHover');
    
                                    })
                                }
                            });
                            // Change the cursor to a pointer when the mouse is over the places layer.
                            map.on('mouseenter', 'places', () => {
                            map.getCanvas().style.cursor = 'pointer';
                            });
                            
                            // Change it back to a pointer when it leaves.
                            map.on('mouseleave', 'places', () => {
                            map.getCanvas().style.cursor = '';
                            });
                        }
                    );
                });
                // ***************** //
            }
            
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
function getAllPropertiesForSaleInMapView() {
    $.ajax({
        url: baseURL + "/ForSale/getAllPropertiesForSaleInMapView",
        method: "POST",
        dataType: "json",
        beforeSend:function(){
            $(".loader").fadeIn(200);
        },
        success: function (data) {
            $("#propertyForSaleInMapViewContainer").html(data); 
           
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