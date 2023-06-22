<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="image-container">
    <img class="w-100"  style="transform: translateZ(0); image-rendering: -webkit-optimize-contrast; height: 520px;" src="<?php echo base_url(); ?>assets/images/greatestpic.png" >

    <div class="after">
        <p class="headerParagraphToEdit">Find your next property</p>

        <div class="container" style=" margin-top:30px; max-width:750px;">
            <div>
                <span class="mainButtonInHeader">For Sale</span>  
                <span class="mainButtonInHeader2">For Rent</span>
            </div>
            <div class="mainButtonInHeader3" style="display:flex;">
                <select class=" form-control form-control-sm " style="margin-right: 20px; height: 43px; font-size:1.2rem; color: #353434 !important !important;"
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
                <select class=" form-control form-control-sm " style="margin-right: 20px; height: 43px; font-size:1.2rem; color: #353434 !important !important;"
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
                <button type ="button" id="searchInMainPage" name="searchInMainPage" style="min-width:115px !important;" class =" whiteColor greenBackground btn btn-md">
                    Search
                </button>
                <!-- <a class="nav-link" href="<?php echo base_url(); ?>Mapview" id="openMapViewButton" name="openMapViewButton" role="button" style="min-width:115px !important; margin-left:15px; font-size: 16px; background: #055E20; color: white;" >
                    Map View
                </a> -->
                <!-- <select class=" form-control form-control-sm " style="margin-right: 20px;line-height: 46px;height: 38px;"
                    data-live-search="true" name="pricemaxInHeader" id="pricemaxInHeader">
                    <option value="">Minimum Price</option><option value="100">100/m</option><option value="150">150/m</option><option value="200">200/m</option>
                    <option value="250">250/m</option><option value="300">300/m</option><option value="350">350/m</option><option value="400">400/m</option>
                    <option value="450">450/m</option><option value="500">500/m</option><option value="550">550/m</option><option value="600">600/m</option>
                    <option value="650">650/m</option><option value="700">700/m</option><option value="750">750/m</option><option value="800">800/m</option>
                    <option value="850">850/m</option><option value="900">900/m</option><option value="950">950/m</option><option value="1000">1,000/m</option>
                    <option value="1050">1,050/m</option><option value="1100">1,100/m</option><option value="1150">1,150/m</option><option value="1200">1,200/m</option>
                    <option value="1250">1,250/m</option><option value="1300">1,300/m</option><option value="1350">1,350/m</option><option value="1400">1,400/m</option>
                    <option value="1450">1,450/m</option><option value="1500">1,500/m</option><option value="1550">1,550/m</option><option value="1600">1,600/m</option>
                    <option value="1650">1,650/m</option><option value="1700">1,700/m</option><option value="1750">1,750/m</option><option value="1800">1,800/m</option>
                    <option value="1850">1,850/m</option><option value="1900">1,900/m</option><option value="1950">1,950/m</option><option value="2000">2,000/m</option>
                    <option value="2050">2,050/m</option><option value="2100">2,100/m</option><option value="2150">2,150/m</option><option value="2200">2,200/m</option>
                    <option value="2250">2,250/m</option><option value="2300">2,300/m</option><option value="2350">2,350/m</option><option value="2400">2,400/m</option>
                    <option value="2450">2,450/m</option><option value="2500">2,500/m</option><option value="2550">2,550/m</option><option value="2600">2,600/m</option>
                    <option value="2650">2,650/m</option><option value="2700">2,700/m</option><option value="2750">2,750/m</option><option value="2800">2,800/m</option>
                    <option value="2850">2,850/m</option><option value="2900">2,900/m</option><option value="2950">2,950/m</option><option value="3000">3,000/m</option>
                    <option value="3500">3,500/m</option><option value="4000">4,000/m</option><option value="4500">4,500/m</option><option value="5000">5,000/m</option>
                    <option value="5500">5,500/m</option><option value="6000">6,000/m</option><option value="6500">6,500/m</option><option value="7000">7,000/m</option>
                    <option value="7500">7,500/m</option><option value="8000">8,000/m</option><option value="8500">8,500/m</option><option value="9000">9,000/m</option>
                    <option value="9500">9,500/m</option><option value="10000">9,999/m</option>
                </select>  -->
                
            </div>
        </div>
        

    </div>
</div>

<div class="container"> 
    
        <!-- <div id='map' style='width: 100%; height: 300px; margin-top:20px;'>
        </div>
    
        <pre id="coordinates" class="coordinates"></pre> -->

    <div class="row">
        <div class="col-xl-12" style="margin-top:30px;">
            <h5 style="line-height: 30px; text-transform: uppercase; color:#055E20;">Connecting Home Sellers, Buyers and Renters with REALTORS</h5>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-xl-6">
            <img class="w-100"  src="<?php echo base_url(); ?>assets/images/rectangleImageOne.png" >
        </div>
        <div class="col-xl-3">
            <img class="w-100"  src="<?php echo base_url(); ?>assets/images/squareImageOne.png" >
        </div>
        <div class="col-xl-3">
            <img class="w-100"  src="<?php echo base_url(); ?>assets/images/squareImageTwo.png" >
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-xl-3">
            <img class="w-100"  src="<?php echo base_url(); ?>assets/images/squareImageOne.png" >
        </div>
        <div class="col-xl-3">
            <img class="w-100"  src="<?php echo base_url(); ?>assets/images/squareImageTwo.png" >
        </div>
        <div class="col-xl-6">
            <img class="w-100"  src="<?php echo base_url(); ?>assets/images/rectangleImageOne.png" >
        </div>
    </div>
    <!-- <div class="row" style="margin-top:30px;">
        <div class="col-xl-12" >
            <h5 style="line-height: 30px; text-transform: uppercase; color:#055E20;">HOMES FOR SALE & RENT BY CITIES AND ZIPCODE ALL OVER LEBANON</h5>
        </div>
    </div> -->


<!-- end of container  -->
</div>


<!-- <div class=" " style="margin-top:20px;">
    <img class="w-100" style="max-height:400px;"  src="<?php echo base_url(); ?>assets/images/wide.jpg" >
</div> -->


<div class="container"> 
    <div class="row" style="margin-top:30px;">  
        <div class="col-xl-12" >
            <h5 style="line-height: 30px; text-transform: uppercase; color:#055E20;">OUR TOP AGENTS</h5>
        </div>
    </div>
    
    <div class="row">  
        <div class="col-xl-4" >
            <div class="cardMainContainer" style="float:left;">
                <div class="theCard">
                    <div class="theFront">
                        <div class="card cardStyle" style="width: 18rem;">
                            <img class="card-img-top" src="<?php echo base_url(); ?>assets/images/guythree.png" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">Ray</h5>
                                <p class="card-text">Best dealers, fastest responce, wide variety.</p>
                                <a href="#" class="card-button btn btn-sm ">Go somewhere</a>
                            </div> 
                        </div>
                    </div>
                    <div class="theBack">
                        <div class="card cardStyle" style="width: 18rem;">
                            <img class="card-img-top" src="<?php echo base_url(); ?>assets/images/guythree.png" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">Ray</h5>
                                <p class="card-text">
                                    <i class="fab fa-whatsapp" style="font-size:20px; color:#055E20;"></i> <span> +961 71 69 63 60 </span>
                                </p>
                                <a href="#" class="card-button btn btn-sm ">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4" style="justify-content: center; display: flex;" >
            <div class="cardMainContainer">
                <div class="theCard">
                    <div class="theFront">
                        <div class="card cardStyle" style="width: 18rem;">
                            <img class="card-img-top" src="<?php echo base_url(); ?>assets/images/guytwo.png" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">Ray</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut auctor metus sem, et sodales elit vestibulum eget.
                                </p>
                                <a href="#" class="card-button btn btn-sm ">Go somewhere</a>
                            </div> 
                        </div>
                    </div>
                    <div class="theBack">
                        <div class="card cardStyle" style="width: 18rem;">
                            <img class="card-img-top" src="<?php echo base_url(); ?>assets/images/guytwo.png" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">Ray</h5>
                                <p class="card-text">
                                    <i class="fab fa-whatsapp" style="font-size:20px; color:#055E20;"></i> <span> +961 71 86 86 86 </span>
                                </p>
                                <a href="#" class="card-button btn btn-sm ">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4"  >
            <div class="cardMainContainer" style="float:right;">
                <div class="theCard">
                    <div class="theFront">
                        <div class="card cardStyle" style="width: 18rem;">
                            <img class="card-img-top" src="<?php echo base_url(); ?>assets/images/guy.jpg" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">Ray</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis at neque id metus commodo volutpat a at dui.</p>
                                <a href="#" class="card-button btn btn-sm ">Go somewhere</a>
                            </div> 
                        </div>
                    </div>
                    <div class="theBack">
                        
                        <div class="card cardStyle" style="width: 18rem;">
                            <img class="card-img-top" src="<?php echo base_url(); ?>assets/images/guy.jpg" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">Ray</h5>
                                <p class="card-text">
                                    <i class="fab fa-whatsapp" style="font-size:20px; color:#055E20;"></i> <span> +961 71 21 23 24 </span>
                                </p>
                                <a href="#" class="card-button btn btn-sm ">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
    <div class="row" style="margin-top:30px;">  
        <div class="col-xl-12" >
            <h5 style="line-height: 30px; text-transform: uppercase; color:#055E20;">CONTACT / SOCIAL MEDIA</h5>
        </div>
    </div>
    <div class="row" style="margin-top:20px; margin-top: 20px; border: solid 1px #055E20; padding: 5px; margin-left:0px; margin-right:0px;">  
        <div class="col-xl-4" >
        </div>
        <div class="col-xl-1" >
            <i class="fab fa-facebook-f facebookIcon" style="color:#055E20;"></i>
        </div>
        
        <div class="col-xl-1" >
            <i class="fab fa-instagram instaIcon"></i>
        </div>
        <div class="col-xl-3">
            <i class="fab fa-whatsapp instaIcon"></i>
            <span style="vertical-align:super; margin-left:5px; color:#055E20; font-weight:700;">+961 71 80 80 80</span>
        </div>
    </div>
    

    <div class="row" style="margin-top:25px;">  
        <div class="col-xl-4" >
            <img class="" style="width:45px; margin-right:5px;" src="<?php echo base_url(); ?>assets/images/favicon.png" >   
            <span>
                <a href="/content/page/about">About Us | </a>  
                <a href="/content/page/contact">Contact Us | </a>
                <a href="/content/privacy">Privacy Policy</a>
            </span>
        </div>
        <div class="col-xl-4" >
            <p style="margin-top:8px; color: #757575;">Copyright© 2023, Re-Belle, INC. All Rights Reserved.</p>
        </div>
        <div class="col-xl-4" > 
            <p style="margin-top:8px; color: #757575;"><b>Disclaimer:</b> All information is subject to  <a href="/content/page/about">Terms of Use</a> and should be independently verified.</p>
        </div>
    </div>

</div>

<!-- <div style="height:50px;"></div> -->