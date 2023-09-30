<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- <div class="image-container"> -->
    <!-- <img class="w-100"  style="margin-top:107px; transform: translateZ(0); image-rendering: -webkit-optimize-contrast; height: 600px;" src="<?php echo base_url(); ?>assets/images/backgroundOne.png" > -->
<!-- </div> -->
<div class="container"> 
    <div class="row">
        <div class="col-xl-12" style="margin-top:130px; margin-bottom:20px;">
            <!-- <h5 style="text-transform: uppercase; color:#333; text-align:center; ">Put on some red lipstick and live a little.</h5> -->
            <h1 style="text-transform: capitalize; font-size:14px; color:#333; text-align:center; line-height:22px;">
                Explore our shop for the “Endless Summer Vibes “ collection. <br>
                To place an order, simply reach out to us on WhatsApp or Instagram. <br> Happy shopping!</h5>
        </div>
    </div>
<!-- end of container  -->
</div>


<style>
.parallax {
  /* The image used */
  /* background-image: url("assets/images/mainImageWebsite.jpg"); */
  background-image: url("assets/images/mainImageRebelleTwo.jpg");
  

  /* Set a specific height */
  min-height: 500px;

  /* Create the parallax scrolling effect */
  /* background-attachment: fixed; */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
@supports not (-webkit-touch-callout: none) {
  /* CSS for other than iOS devices */ 
    .parallax {
        background-attachment: fixed;
    }
    .parallaxTwo {
        background-attachment: fixed;
    }

}
.parallaxTwo {
  /* The image used */
  /* background-image: url("assets/images/mainImageWebsite.jpg"); */
  background-image: url("assets/images/secondMainPageImage.jpg");
  

  /* Set a specific height */
  min-height: 500px;

  /* Create the parallax scrolling effect */
  /* background-attachment: fixed; */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
</style>

<!-- Container element -->
<div class="parallax"></div> 


<div class="container"> 
    <div class="row"  style="text-align:center;">
        <div class="col-12 col-xl-12 col-lg-12 col-md-12 mt-4 mb-4">
            <h5 style="border:solid 1px #1a4345; padding:10px;">Dresses <span style="color: #1a4345; font-size:16px; padding-left:10px; cursor:pointer;" class="clickSideBarCardigan"> View More... </span></h5>
        </div>
    </div>
    <div id="newCardiganContainer">
    </div>
</div>

<div class="parallaxTwo"></div> 

<?php if (!isset($_SESSION["userType"])) { ?>
<!-- account section start  -->
<div class="container"> 
    <div class="row"  style="text-align:center;">
        <div class="col-12 col-xl-12 col-lg-12 col-md-12 mt-4 mb-4">
            <h5 style="border:solid 1px #1a4345; padding:10px;">Create Account</h5>
        </div>
    </div>
    <div id="errorMessageInMainPage" style="text-align:center; margin-top:-10px; margin-bottom:5px;" > </div>
    <form method="POST" id="accountForm">
        <div class="row  mt-1" >
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                <label for="emailMainPage" class="" >Email</label>
                <input type ="text" value=""  class="form-control form-control-sm " name="emailMainPage" id="emailMainPage"  />
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                <label for="passwordMainPage" class=" ">Password</label>
                <input type ="password"  value="" class=" form-control form-control-sm " name="passwordMainPage" id="passwordMainPage"  />
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                <label for="passwordConfirmMainPage" class=" ">Confirm Password</label>
                <input type ="password"  value="" class=" form-control form-control-sm " name="passwordConfirmMainPage" id="passwordConfirmMainPage"  />
            </div>
        </div>
        <div class="row">
            <div class="mt-2 col-xl-12 col-12">
                <button type="submit" class="btn btn-sm greenButtonsCss" style="float:right;" id="createAccountButton">
                    <i class="fas fa-paper-plane" style="color:white; margin-right:4px;"></i> Create Account
                </button>
            </div>
        </div>
    </form>
</div>
<?php } ?>
  
<!-- account section end  -->



<!-- footer  -->
<div class="container"> 
    <div class="row" style="margin-top:30px;">  
        <div class="col-xl-12" >
            <h5 style="line-height: 30px; text-transform: uppercase; color:#333;">CONTACT / SOCIAL MEDIA</h5>
        </div>
    </div>
    <div class="row" style="margin-top:20px; margin-top: 20px; border: solid 1px #1a4345; padding: 5px; margin-left:0px; margin-right:0px;">  
        <div class="col-xl-4 col-12" >
        </div>
        <div class="col-xl-1 col-3" >
            <i class="fab fa-facebook-f facebookIcon" style="color:#333;"></i>
        </div>
        
        <div class="col-xl-1 col-3" >
            <i class="fab fa-instagram instaIcon"></i>
        </div>
        <div class="col-xl-3 col-6">
            <i class="fab fa-whatsapp instaIcon"></i>
            <span style="vertical-align:super; margin-left:5px; color:#333; font-weight:700;">+961 03 310 100</span>
        </div>
    </div>
    

    <div class="row" style="margin-top:25px;">  
        <div class="col-xl-4 " style="margin-top:9px;"  >
            <span>
                <a href="/content/page/about">About Us | </a>  
                <a href="/content/page/contact">Contact Us | </a>
                <a href="/content/privacy">Privacy Policy</a>
            </span>
        </div>
        <div class="col-xl-4" >
            <p style="margin-top:8px; color: #333;">Copyright© 2023, Re-Belle, INC. All Rights Reserved.</p>
        </div>
        <div class="col-xl-4" > 
            <p style="margin-top:8px; color: #333;"><b>Disclaimer:</b> All information is subject to  <a href="/content/page/about">Terms of Use</a> and should be independently verified.</p>
        </div>
    </div>

</div>

