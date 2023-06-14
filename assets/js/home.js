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
            url: `${baseURL}/Lb961/uploadFiles`,
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
    






    $("body").on("click", ".mainButtonInHeader",function(){
        $(".mainButtonInHeader2").addClass("mainButtonInHeader");
        $(".mainButtonInHeader2").removeClass("mainButtonInHeader2");
        $(this).removeClass("mainButtonInHeader");
        $(this).addClass("mainButtonInHeader2");
        if($(this).html() == "For Sale" ){
            $("#priceminInHeader").html(`
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
            `);
            $("#pricemaxInHeader").html(`
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
            `);
        }else{
            $("#priceminInHeader").html(`
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
            `);
            $("#pricemaxInHeader").html(`
                <option value="">Maximum Price</option><option value="100">100/m</option><option value="150">150/m</option><option value="200">200/m</option>
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
            `);
        }

    })
    
    $("body").on("click", ".mainButtonInHeader2",function(){
        $(".mainButtonInHeader").addClass("mainButtonInHeader2");
        $(".mainButtonInHeader").removeClass("mainButtonInHeader");
        $(this).addClass("mainButtonInHeader");
        $(this).removeClass("mainButtonInHeader2");
       

        if($(this).html() == "For Sale" ){
            $("#priceminInHeader, #pricemaxInHeader").html(`
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
            `);
            $("#pricemaxInHeader").html(`
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
            `);
        }else{
            $("#priceminInHeader").html(`
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
            `);
            $("#pricemaxInHeader").html(`
                <option value="">Maximum Price</option><option value="100">100/m</option><option value="150">150/m</option><option value="200">200/m</option>
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
            `);
        }
    })
    // if ($("#map").length > 0 ){
    //     mapboxgl.accessToken = 'pk.eyJ1Ijoic2NvcmF5IiwiYSI6ImNrdWNxcmJmNjBlb3kzMHBoMTBlanRncnAifQ.nUzt6aDopRt2STolFgt9FQ';
    //     var map = new mapboxgl.Map({
    //         container: 'map',
    //         style: 'mapbox://styles/scoray/ckv6lh29a0h8215t54qb8g5au',
    //         center: [  35.7 , 33.9], // starting position [lng, lat]
    //         zoom: 9.5 // starting zoom
    //     });
    //     // map.resize();
    //     map.addControl(new mapboxgl.FullscreenControl());

    //     // Add geolocate control to the map.
    //     map.addControl(
    //         new mapboxgl.GeolocateControl({
    //             positionOptions: {
    //             enableHighAccuracy: true
    //             },
    //             // When active the map will receive updates to the device's location as it changes.
    //             trackUserLocation: true,
    //             // Draw an arrow next to the location dot to indicate which direction the device is heading.
    //             showUserHeading: true
    //         })
    //     );
    //     map.on('idle',function(){
    //         map.resize();
    //     })
    //     //------- Marker Draggable --------// 
    //     const coordinates = document.getElementById('coordinates');
    //     const marker = new mapboxgl.Marker({
    //         draggable: true
    //     });
    //     marker.setLngLat([35.7 , 33.9]);
    //     marker.addTo(map);
            
    //     function onDragEnd() {
    //         const lngLat = marker.getLngLat();
    //         coordinates.style.display = 'block';
    //         coordinates.innerHTML = `Longitude: ${lngLat.lng}<br />Latitude: ${lngLat.lat}`;
    //     }
            
    //     marker.on('dragend', onDragEnd);
    // }

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


    $("#profileInfoHeaderButton").click(function(){
        hideAll();
        setTimeout(function(){
            $("#profileInfoHeaderButton").parent().addClass("greenBackground");
            $("#profileInfoHeaderButton").addClass("whiteColor");
            $("#profileInfoHeaderButton").children().addClass("whiteColor");
            $("#profileInfo").removeClass("displayNone");
        },20)
    })
    $("#managePropertiesHeaderButton").click(function(){
        hideAll();
        setTimeout(function(){
            getAllPropertiesInBackEnd();
            $("#managePropertiesHeaderButton").parent().addClass("greenBackground");
            $("#managePropertiesHeaderButton").addClass("whiteColor");
            $("#managePropertiesHeaderButton").children().addClass("whiteColor");
            $("#manageProperty").removeClass("displayNone");
        },20)
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
            url: baseURL + "/Lb961/submitProperty",
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
            url: baseURL + "/Lb961/statusIcon",
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
            url: baseURL + "/Lb961/displayPropertyToEdit",
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

                   



                // const geojson = {
                //     'type': 'FeatureCollection',
                //     'features': [
                //         {
                //             'type': 'Feature',
                //             'geometry': {
                //             'type': 'Point',
                //             'coordinates': [35.82841677706193, 33.92811062117468]
                //             },
                //             'properties': {
                //             'title': 'Mapbox 500',
                //             'description': 'Washington, D.C. 500'
                //             }
                            
                //         }
                //     ]
                // };
                // for (const feature of geojson.features) {
                //     // create a HTML element for each feature
                //     const el = document.createElement('div');
                //     el.className = 'marker';
                        
                //     // make a marker for each feature and add it to the map
                //     new mapboxgl.Marker(el)
                //     .setLngLat(feature.geometry.coordinates)
                //     .setPopup(
                //         new mapboxgl.Popup({ offset: 25 }) // add popups
                //         .setHTML(
                //             `<h3>${feature.properties.title}</h3><p>${feature.properties.description}</p>`
                //         )
                //     )
                    
                //     .addTo(map);
                // }


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
                // $("#propertyListingStatus").val(data["listingStatus"]);
                
                
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
            url: baseURL + "/Lb961/displayPropertyToEdit",
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
            url: baseURL + "Lb961/deleteProperty",
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
            url: baseURL + "Lb961/deletePropertyInAdmin",
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
    $("#profileInfoHeaderButton").parent().removeClass("greenBackground");
    $("#profileInfoHeaderButton").removeClass("whiteColor");
    $("#profileInfoHeaderButton").children().removeClass("whiteColor");
    
    $("#managePropertiesHeaderButton").parent().removeClass("greenBackground");
    $("#managePropertiesHeaderButton").removeClass("whiteColor");
    $("#managePropertiesHeaderButton").children().removeClass("whiteColor");

    $("#adminSectionHeaderButton").parent().removeClass("greenBackground");
    $("#adminSectionHeaderButton").removeClass("whiteColor");
    $("#adminSectionHeaderButton").children().removeClass("whiteColor");
    
    $("#profileInfo").addClass("displayNone");
    $("#manageProperty").addClass("displayNone");
    $("#adminSection").addClass("displayNone");
    $("#managePropertyForm").hide();
    $("#displayAdminSectionPropertyInfo").hide();
}


// ----------------------------------------------------------- //
function getAllPropertiesInBackEnd() {
    $.ajax({
        url: baseURL + "/Lb961/getAllPropertiesInBackEnd",
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
        url: baseURL + "/Lb961/getAllPropertiesForAdmin",
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


// ----------------------------------------------------------- //
// function getAllPropertiesForSale() {
//     $.ajax({
//         url: baseURL + "/ForSale/getAllPropertiesForSale",
//         method: "POST",
//         dataType: "json",
//         beforeSend:function(){
//             $(".loader").fadeIn(200);
//         },
//         success: function (data) {
//             $("#propertyForSaleContainer").html(data); 
           
//             $(function () {
//                 $('[data-toggle="tooltip"]').tooltip({
//                     delay: { "show": 700, "hide": 0 }
//                 });
//             })
//         },
//         error: function (error) {
//             alert("Network Error Please Refresh The Page.");
//         },
//         complete: function(){
//             $(".loader").fadeOut();
//         }
//     });   
// }


// //**************************** */
// function displayAllPins(){
//     $.ajax({
//         url: baseURL + "/Lb961/displayAllPins",
//         method: "POST",
//         dataType: "json",
//         beforeSend:function(){
//             $(".loader").fadeIn(500);
//         },
//         success: function (data) {
//             var arr = [];
//             for (let i = 0; i < data.length; i++) {
//                 longitude = data[i]["longitude"];
//                 latitude = data[i]["latitude"];
//                 price = data[i]["price"];
//                 description = data[i]["description"];
//                 msg = 
//                 { 
//                     'type': 'Feature',
//                     'geometry': {
//                         'type': 'Point',
//                         'coordinates': [
//                             longitude, latitude
//                         ]
//                     },
//                     'properties': {
//                         'description':
//                         '<strong>'+ description +' </strong><p>',
//                         'title': price
//                     }
//                 };
//                 arr.push(msg);
//             }

//             if ($("#map").length > 0 ){
//                 mapboxgl.accessToken = 'pk.eyJ1Ijoic2NvcmF5IiwiYSI6ImNrdWNxcmJmNjBlb3kzMHBoMTBlanRncnAifQ.nUzt6aDopRt2STolFgt9FQ';
//                 var map = new mapboxgl.Map({
//                     container: 'map',
//                     style: 'mapbox://styles/scoray/ckv6lh29a0h8215t54qb8g5au',
//                     center: [  35.7 , 33.9], // starting position [lng, lat]
//                     zoom: 9.5 // starting zoom
//                 });
//                 map.addControl(new mapboxgl.FullscreenControl());
            
//                 // Add geolocate control to the map.
//                 map.addControl(
//                     new mapboxgl.GeolocateControl({
//                         positionOptions: {
//                         enableHighAccuracy: true
//                         },
//                         // When active the map will receive updates to the device's location as it changes.
//                         trackUserLocation: true,
//                         // Draw an arrow next to the location dot to indicate which direction the device is heading.
//                         showUserHeading: true
//                     })
//                 );
//                 map.on('idle',function(){
//                     map.resize();
//                 })

//                 // *****************//
//                 map.on('load', () => {
//                     // Add an image to use as a custom marker
//                     map.loadImage(
//                         baseURL + 'assets/images/pin.png',
//                         (error, image) => {
//                             if (error) throw error;
//                             map.addImage('custom-marker', image);
//                             // Add a GeoJSON source with 2 points
                            
                            
//                             map.addSource('points', {
//                                     'type': 'geojson',
//                                     'data': {
//                                         'type': 'FeatureCollection',
//                                         //created above
//                                         'features': 
//                                             arr
                                        
//                                     }
//                             });    
                            
//                             // Add a symbol layer
//                             map.addLayer({
//                                 'id': 'points',
//                                 'type': 'symbol',
//                                 'source': 'points',
//                                 'layout': {
//                                     'icon-image': 'custom-marker',
//                                     // get the title name from the source's "title" property
//                                     'text-field': ['get', 'title'],
//                                     'text-font': [
//                                         'Open Sans Semibold',
//                                         'Arial Unicode MS Bold'
//                                     ],
//                                     'text-offset': [0, 1.25],
//                                     'text-anchor': 'top'
//                                 }
//                             });

//                             // When a click event occurs on a feature in the places layer, open a popup at the
//                             // location of the feature, with description HTML from its properties.
//                             map.on('click', 'points', (e) => {
//                                 // Copy coordinates array.
//                                 const coordinates = e.features[0].geometry.coordinates.slice();
//                                 const description = e.features[0].properties.description;
                                
//                                 // Ensure that if the map is zoomed out such that multiple
//                                 // copies of the feature are visible, the popup appears
//                                 // over the copy being pointed to.
//                                 while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
//                                 coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
//                                 }
                                
//                                 new mapboxgl.Popup()
//                                 .setLngLat(coordinates)
//                                 .setHTML(description)
//                                 .addTo(map);
//                                 });
                                
//                                 // Change the cursor to a pointer when the mouse is over the places layer.
//                                 map.on('mouseenter', 'places', () => {
//                                 map.getCanvas().style.cursor = 'pointer';
//                                 });
                                
//                                 // Change it back to a pointer when it leaves.
//                                 map.on('mouseleave', 'places', () => {
//                                 map.getCanvas().style.cursor = '';
//                                 });
//                         }
//                     );
//                 });
//                 // ***************** //
//             }
            
//         },
//         error: function (error) {
//             alert("Network Error Please Refresh The Page.");
//         },
//         complete: function(){
//             $(".loader").fadeOut();
//         }
//     });  
// }



