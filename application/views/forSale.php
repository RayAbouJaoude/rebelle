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
?>


<div class="image-container">
    <img class="w-100"  style="transform: translateZ(0); image-rendering: -webkit-optimize-contrast; height: 170px;" src="<?php echo base_url(); ?>assets/images/wide.jpg" >

    <div class="after" style="background: #00000026 !important;">
        <div class="container">
            <div class="row">
                <div class="col-xl-12" style="text-align:center;">
                    <h2 style="color:white; margin-top:11px;">Search homes & apartments for Sale</h2>
                </div>
            </div>
            <div class="row coolBorderBackground" style="margin-top:15px;">
                <div class="col-xl-2">
                    <select class=" form-control form-control-sm " style="margin-right: 20px; height: 43px; font-size:1rem; color: #353434 !important !important;   border-radius: 4px !important;"
                        data-live-search="true" name="choosePropertyType" id="choosePropertyType">
                        <option value="home">Home</option>
                        <option value="commercial">Commercial</option>
                        <option value="land">Land</option>
                    </select> 

                </div>
                <div class="col-xl-2">
                    <select class=" form-control form-control-sm " style="margin-right: 20px; height: 43px; font-size:1rem; color: #353434 !important !important; border-radius: 4px !important;"
                        data-live-search="true" id="priceminInHeader" name="priceminInHeader">
                        <option value="">Minimum Price</option>
                        <option value="5000">5 000</option><option value="10000">10 000</option>
                        <option value="15000">15 000</option><option value="20000">20 000</option><option value="25000">25 000</option>
                        <option value="30000">30 000</option><option value="35000">35 000</option><option value="40000">40 000</option>
                        <option value="45000">45 000</option><option value="50000">50 000</option><option value="55000">55 000</option><option value="60000">60 000</option>
                        <option value="65000">65 000</option><option value="70000">70 000</option><option value="75000">75 000</option><option value="80000">80 000</option>
                        <option value="85000">85 000</option><option value="90000">90 000</option><option value="95000">95 000</option><option value="100000">100 000</option>
                        <option value="105000">105 000</option><option value="110000">110 000</option><option value="115000">115 000</option><option value="120000">120 000</option>
                        <option value="125000">125 000</option><option value="130000">130 000</option><option value="135000">135 000</option><option value="140000">140 000</option>
                        <option value="145000">145 000</option><option value="150000">150 000</option><option value="155000">155 000</option><option value="160000">160 000</option>
                        <option value="165000">165 000</option><option value="170000">170 000</option><option value="175000">175 000</option><option value="180000">180 000</option>
                        <option value="185000">185 000</option><option value="190000">190 000</option><option value="195000">195 000</option><option value="200000">200 000</option>
                        <option value="205000">205 000</option><option value="210000">210 000</option><option value="215000">215 000</option><option value="220000">220 000</option>
                        <option value="225000">225 000</option><option value="230000">230 000</option><option value="235000">235 000</option><option value="240000">240 000</option>
                        <option value="245000">245 000</option><option value="250000">250 000</option><option value="255000">255 000</option><option value="260000">260 000</option>
                        <option value="265000">265 000</option><option value="270000">270 000</option><option value="275000">275 000</option><option value="280000">280 000</option>
                        <option value="285000">285 000</option><option value="290000">290 000</option><option value="295000">295 000</option><option value="300000">300 000</option>
                        <option value="305000">305 000</option><option value="310000">310 000</option><option value="315000">315 000</option><option value="320000">320 000</option>
                        <option value="325000">325 000</option><option value="330000">330 000</option><option value="335000">335 000</option><option value="340000">340 000</option>
                        <option value="345000">345 000</option><option value="350000">350 000</option><option value="355000">355 000</option><option value="360000">360 000</option>
                        <option value="365000">365 000</option><option value="370000">370 000</option><option value="375000">375 000</option><option value="380000">380 000</option>
                        <option value="385000">385 000</option><option value="390000">390 000</option><option value="395000">395 000</option><option value="400000">400 000</option>
                        <option value="450000">450 000</option><option value="500000">500 000</option><option value="550000">550 000</option><option value="600000">600 000</option>
                        <option value="650000">650 000</option><option value="700000">700 000</option><option value="750000">750 000</option><option value="800000">800 000</option>
                        <option value="850000">850 000</option><option value="900000">900 000</option><option value="950000">950 000</option><option value="1000000">1 Mil</option>
                        <option value="1100000">1.1 Mil</option><option value="1200000">1.2 Mil</option><option value="1300000">1.3 Mil</option><option value="1400000">1.4 Mil</option>
                        <option value="1500000">1.5 Mil</option><option value="1600000">1.6 Mil</option><option value="1700000">1.7 Mil</option><option value="1800000">1.8 Mil</option>
                        <option value="1900000">1.9 Mil</option><option value="2000000">2.0 Mil</option><option value="2200000">2.2 Mil</option><option value="2400000">2.4 Mil</option>
                        <option value="2600000">2.6 Mil</option><option value="2800000">2.8 Mil</option><option value="3000000">3.0 Mil</option><option value="3200000">3.2 Mil</option>
                        <option value="3400000">3.4 Mil</option><option value="3600000">3.6 Mil</option><option value="3800000">3.8 Mil</option><option value="4000000">4.0 Mil</option>
                    </select>
                </div>
                <div class="col-xl-2">
                    <select class=" form-control form-control-sm " style="margin-right: 20px; height: 43px; font-size:1rem; color: #353434 !important !important;  border-radius: 4px !important;"
                        data-live-search="true" name="pricemaxInHeader" id="pricemaxInHeader">
                        <option value="">Maximum Price</option>
                        <option value="5000">5 000</option><option value="10000">10 000</option>
                        <option value="15000">15 000</option><option value="20000">20 000</option><option value="25000">25 000</option>
                        <option value="30000">30 000</option><option value="35000">35 000</option><option value="40000">40 000</option>
                        <option value="45000">45 000</option><option value="50000">50 000</option><option value="55000">55 000</option><option value="60000">60 000</option>
                        <option value="65000">65 000</option><option value="70000">70 000</option><option value="75000">75 000</option><option value="80000">80 000</option>
                        <option value="85000">85 000</option><option value="90000">90 000</option><option value="95000">95 000</option><option value="100000">100 000</option>
                        <option value="105000">105 000</option><option value="110000">110 000</option><option value="115000">115 000</option><option value="120000">120 000</option>
                        <option value="125000">125 000</option><option value="130000">130 000</option><option value="135000">135 000</option><option value="140000">140 000</option>
                        <option value="145000">145 000</option><option value="150000">150 000</option><option value="155000">155 000</option><option value="160000">160 000</option>
                        <option value="165000">165 000</option><option value="170000">170 000</option><option value="175000">175 000</option><option value="180000">180 000</option>
                        <option value="185000">185 000</option><option value="190000">190 000</option><option value="195000">195 000</option><option value="200000">200 000</option>
                        <option value="205000">205 000</option><option value="210000">210 000</option><option value="215000">215 000</option><option value="220000">220 000</option>
                        <option value="225000">225 000</option><option value="230000">230 000</option><option value="235000">235 000</option><option value="240000">240 000</option>
                        <option value="245000">245 000</option><option value="250000">250 000</option><option value="255000">255 000</option><option value="260000">260 000</option>
                        <option value="265000">265 000</option><option value="270000">270 000</option><option value="275000">275 000</option><option value="280000">280 000</option>
                        <option value="285000">285 000</option><option value="290000">290 000</option><option value="295000">295 000</option><option value="300000">300 000</option>
                        <option value="305000">305 000</option><option value="310000">310 000</option><option value="315000">315 000</option><option value="320000">320 000</option>
                        <option value="325000">325 000</option><option value="330000">330 000</option><option value="335000">335 000</option><option value="340000">340 000</option>
                        <option value="345000">345 000</option><option value="350000">350 000</option><option value="355000">355 000</option><option value="360000">360 000</option>
                        <option value="365000">365 000</option><option value="370000">370 000</option><option value="375000">375 000</option><option value="380000">380 000</option>
                        <option value="385000">385 000</option><option value="390000">390 000</option><option value="395000">395 000</option><option value="400000">400 000</option>
                        <option value="450000">450 000</option><option value="500000">500 000</option><option value="550000">550 000</option><option value="600000">600 000</option>
                        <option value="650000">650 000</option><option value="700000">700 000</option><option value="750000">750 000</option><option value="800000">800 000</option>
                        <option value="850000">850 000</option><option value="900000">900 000</option><option value="950000">950 000</option><option value="1000000">1 Mil</option>
                        <option value="1100000">1.1 Mil</option><option value="1200000">1.2 Mil</option><option value="1300000">1.3 Mil</option><option value="1400000">1.4 Mil</option>
                        <option value="1500000">1.5 Mil</option><option value="1600000">1.6 Mil</option><option value="1700000">1.7 Mil</option><option value="1800000">1.8 Mil</option>
                        <option value="1900000">1.9 Mil</option><option value="2000000">2.0 Mil</option><option value="2200000">2.2 Mil</option><option value="2400000">2.4 Mil</option>
                        <option value="2600000">2.6 Mil</option><option value="2800000">2.8 Mil</option><option value="3000000">3.0 Mil</option><option value="3200000">3.2 Mil</option>
                        <option value="3400000">3.4 Mil</option><option value="3600000">3.6 Mil</option><option value="3800000">3.8 Mil</option><option value="4000000">4.0 Mil</option>
                    </select> 
                </div>
                <div class="col-xl-2">
                    <select class=" form-control form-control-sm " style="margin-right: 20px; height: 43px; font-size:1rem; color: #353434 !important !important;   border-radius: 4px !important;"
                        data-live-search="true" name="numberOfRoom" id="numberOfRoom">
                        <option value="">Number Of Rooms</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                    </select> 
                </div>
                <div class="col-xl-2" style="text-align:center;">
                    <a class="nav-link" id="searchButtonInSale" name="searchButtonInSale" role="button" style="min-width:115px !important; padding-top: 9px; padding-bottom: 9px; margin-left:15px; font-size: 16px; background: #055E20; color: white; border-radius: 4px !important;" >
                        Search
                    </a>
                </div>
                <div class="col-xl-2" style="text-align:center;">
                    <a class="nav-link" id="openMapViewButton" name="openMapViewButton" role="button" style="min-width:115px !important; padding-top: 9px; padding-bottom: 9px; margin-left:15px; font-size: 16px; background: #055E20; color: white; border-radius: 4px !important;" >
                        Map View
                    </a>
                </div>
            </div>
        </div>
        

    </div>
</div>


<div class="container" style=""> 
    <!-- end map setting  -->
    <div id="propertyForSaleContainer">
    </div>
<!-- end container  -->
</div>



 <!-- map view  -->
<div id="mapview" class="displayNone mt-1">
    <div class="row ml-0 mr-0">
        <div class="col-xl-4 col-6 pl-0">
            <div id="propertyForSaleInMapViewContainer" style="margin-right:-23px;">
            </div>
        </div>
        <div class="col-xl-8 col-12 pr-0 pl-0">
            <div id='map'  style='min-height: 600px;'>
            </div>
        </div>
    </div>
</div>
<!-- end map view  -->

