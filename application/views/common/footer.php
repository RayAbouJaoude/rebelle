<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
        
        </main>

        <div class="modal fade" id="itemModal" tabindex="-1" style="" role="dialog" aria-hidden="true">
            <div class="modal-dialog  modal-md  modal-dialog-s"  role="document">
                <div class="modal-content " style="">
                   
                </div>  
            </div>
        </div>

        
        <!-- Error Modal -->
        <div class="modal fade modalStyle" id="errorModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ErrorModalTitle">
                            <i class="fas fa-exclamation-triangle" style="color:#055E20;"></i>
                            Attention
                        </h5>
                        <button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <div class="modal-body"></div>

                    <div class="modal-footer">
                        <button type="button" class="btn redButtonsCssModal" data-dismiss="modal">
                            <i class="fas fa-times mr-2"></i>
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                <div class="modal-content "  >
                    <div class="modal-header">
                        <h5 style="font-size:14px;"><i class="fas fa-exclamation-triangle" style="margin-right:10px; font-size:16px; color:rgb(38, 140, 228) ;"></i>Attention</h5>
                        <button type="button" class="close closeModal" data-dismiss="modal" id="closeModal" title="Close">×</button>
                    </div>
                    <div class="modal-body"  style="height:56px;" >
                        <p style="font-size:14px;">Are you sure you want to delete this record? </p>
                    </div>  
                    <div class="modal-footer" style="height:52px;">
                        <button class="btn btn-sm  redButtonsCssModal"  data-dismiss="modal" id="yesDeleteModalToChange" style="float:right;">YES</button>
                        <button class="btn btn-sm blueButtonsCssModal "  data-dismiss="modal" style="float:right;"> NO</button>
                    </div>  

                </div>  
            </div>
        </div>




        <div class="modal fade" id="purchaseCartModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content " style="margin-top: -10px;">
                    <div class="modal-header" style="height:50px;">
                        <h5 style="font-size:16px; text-align:center;" class=""><i class="fas fa-cart-plus" style="margin-right:10px; color:#1a4345;"></i>Please Fill Bellow</h5>
                        <button type="button" style="margin-top: -21px;" class="close closeModal" data-dismiss="modal" id="closeModal" title="Close">&times;</button> 

                    </div>
                    <div class="modal-body" style="overflow-y: auto !important;height: 550px; padding-bottom:100px;">
                    <form name="purchaseCartForm" id="purchaseCartForm" autocomplete="off">
                            <input type="hidden" name="purchaseCartTotal" id="purchaseCartTotal" value="" />
                            <div class="row"> 
                                <div class="col-xl-4">
                                    <div class="form-group">
                                        <label for="telephoneInPurchaseCartModal">Phone Number: *</label>
                                        <input id="telephoneInPurchaseCartModal" name="telephoneInPurchaseCartModal" class="form-control form-control-sm" type="text">
                                    </div>
                                </div>    

                                <div class="col-xl-4">
                                    <div class="form-group">
                                        <label for="customerFullNameInPurchaseCartModal">Full Name: *</label>
                                        <input id="customerFullNameInPurchaseCartModal" name="customerFullNameInPurchaseCartModal" class="form-control form-control-sm" type="text">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-xl-12">
                                    <!-- <div class="form-group">
                                        <label for="purchaseCartCountry">Country: *</label>
                                        <select name="purchaseCartCountry" id="purchaseCartCountry" class="form-control form-control-sm">
                                            <option value="-1">-- Select Country --</option>
                                            <option value="DZ">Algeria</option>
                                            <option value="US">Argentina</option>
                                            <option value="AU">Australia</option>
                                            <option value="AT">Austria</option>
                                            <option value="BH">Bahrain</option>
                                            <option value="BY">Belarus</option>
                                            <option value="BE">Belgium</option>
                                            <option value="US">Brazil</option>
                                            <option value="CM">Cameroon</option>
                                            <option value="CA">Canada</option>
                                            <option value="CN">China (People's Rep.)</option>
                                            <option value="CY">Cyprus</option>
                                            <option value="CZ">Czech Rep.</option>
                                            <option value="DK">Denmark</option>
                                            <option value="EG">Egypt</option>
                                            <option value="ET">Ethiopia</option>
                                            <option value="FR">France</option>
                                            <option value="DE">Germany</option>
                                            <option value="GB">Great Britain</option>
                                            <option value="GR">Greece</option>
                                            <option value="HK">Hong Kong, China</option>
                                            <option value="IN">India</option>
                                            <option value="ID">Indonesia</option>
                                            <option value="IR">Iran (Islamic Rep.)</option>
                                            <option value="IE">Ireland</option>
                                            <option value="IT">Italy</option>
                                            <option value="JP">Japan</option>
                                            <option value="JO">Jordan</option>
                                            <option value="KR">Korea (Rep.)</option>
                                            <option value="LV">Latvia (Lettonia)</option>
                                            <option value="LB">Lebanon</option>
                                            <option value="LU">Luxembourg</option>
                                            <option value="MY">Malaysia</option>
                                            <option value="MT">Malta</option>
                                            <option value="MX">Mexico</option>
                                            <option value="MD">Moldova</option>
                                            <option value="MA">Morocco</option>
                                            <option value="NL">Netherlands</option>
                                            <option value="NZ">New Zeeland</option>
                                            <option value="NG">Nigeria</option>
                                            <option value="NO">Norway</option>
                                            <option value="OM">Oman</option>
                                            <option value="PH">Philippines</option>
                                            <option value="PL">Poland</option>
                                            <option value="PT">Portugal</option>
                                            <option value="QA">Qatar</option>
                                            <option value="RO">Romania</option>
                                            <option value="RU">Russian Federation</option>
                                            <option value="SA">Saudi Arabia</option>
                                            <option value="SN">Senegal</option>
                                            <option value="RS">Serbia</option>
                                            <option value="SG">Singapore</option>
                                            <option value="ZA">South Africa</option>
                                            <option value="ES">Spain</option>
                                            <option value="LK">SriLanka</option>
                                            <option value="SD">Sudan</option>
                                            <option value="SE">Sweden</option>
                                            <option value="CH">Switzerland</option>
                                            <option value="TH">Thailand</option>
                                            <option value="TN">Tunisia</option>
                                            <option value="TR">Turkey</option>
                                            <option value="UA">Ukraine</option>
                                            <option value="AE">United Arab Emirates</option>
                                            <option value="US">United States of America</option>
                                        </select>
                                    </div> -->
                                </div>
                            </div>

                            <div class="row displayNone" id="puchaseCardInfoContainer">
                                <div class="col-xl-4">
                                    <div class="form-group">
                                        <label for="purchaseCardNumber">Card Number: *</label>
                                        <input id="purchaseCardNumber" name="purchaseCardNumber" class="form-control form-control-sm" type="text" maxlength="25">
                                    </div>
                                </div>

                                <div class="col-xl-4">
                                    <div class="form-group">
                                        <label for="purchaseCardCVV">CVV: *</label>
                                        <input id="purchaseCardCVV" name="purchaseCardCVV" class="form-control form-control-sm" type="text" maxlength="3">
                                    </div>
                                </div>

                                <div class="col-xl-4">
                                    <div class="form-group">
                                        <label class="display-block" for="purchaseCardExpMonth">Expiry Date: *</label>

                                        <select name="purchaseCardExpMonth" id="purchaseCardExpMonth" class="form-control form-control-sm">
                                            <option value="01">01</option>
                                            <option value="02">02</option>
                                            <option value="03">03</option>
                                            <option value="04">04</option>
                                            <option value="05">05</option>
                                            <option value="06">06</option>
                                            <option value="07">07</option>
                                            <option value="08">08</option>
                                            <option value="09">09</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                        </select>

                                        <select name="purchaseCardExpYear" id="purchaseCardExpYear" class="form-control form-control-sm">
<?php
    $year_now = date("Y",time()); 
    $year_next = $year_now + 10;

    for($i = $year_now; $i <= $year_next; $i++){
?>
                                <option value="<?= $i; ?>"><?= $i; ?></option>
<?php
    }
?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row displayNone" id="purchaseCartAddressContainer">
                                <div class="col-xl-4">
                                    <div class="form-group">
                                        <label for="purchaseCartState">State: *</label>
                                        <input id="purchaseCartState" name="purchaseCartState" class="form-control form-control-sm" type="text">
                                    </div>
                                </div>

                                <div class="col-xl-4">
                                    <div class="form-group">
                                        <label for="purchaseCartCity">City: *</label>
                                        <input id="purchaseCartCity" name="purchaseCartCity" class="form-control form-control-sm" type="text">
                                    </div>
                                </div>

                                <div class="col-xl-4">
                                    <div class="form-group">
                                        <label class="display-block" for="purchaseCartZipCode">Zip Code: *</label>
                                        <input id="purchaseCartZipCode" name="purchaseCartZipCode" class="form-control form-control-sm" type="text">
                                    </div>
                                </div>
                            </div>

                            <div class="row " id="purchaseCartAddressText">
                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <label for="addressInPurchaseCartModal">Address: *</label>
                                        <textarea name="addressInPurchaseCartModal" id="addressInPurchaseCartModal" class="form-control form-control-sm" rows="5"></textarea>
                                    </div>
                                </div>
                                <!-- <div class="col-xl-3">
                                    <div class="form-group">
                                        <label for="promoCode">Promo Code:</label>
                                        <input name="promoCode" id="promoCode"  type="text" class="form-control form-control-sm" />
                                    </div>
                                </div> -->
                                
                                <div class="col-xl-9">
                                    <!-- <div class="form-group" style="text-align:center;">
                                        <label for="" id="cartUsdOrLbpLabel">You are now paying In L.L. click to pay In USD</label>
                                        <input name="cartUsdOrLbp" id="cartUsdOrLbp" checkedOrNot="1"  type="checkbox" class="form-control form-control-sm" />
                                    </div> -->
                                </div>
                                
                            </div>

                            <div class="row">
                                <div class="col-xl-12 cashOnDeliveryText displayNone">
                                    Cash on Delivery!
                                </div>

                                <div class="col-xl-12" style="text-align:center;">
                                    Are You Sure You Want To Purchase This Cart?
                                    <br>
                                    Shipping: <span id="shippingInModalValue">TBD </span>
                                </div>
                                <div class="col-xl-12" id="totalInPurchaseCartModal" style="text-align:center;">
                                    Total: <span id="fullAmountWithShipInModal">TBD</span>
                                </div>                        
                            </div>

                            <div class="row">
                                <div class="col-xl-9 col-8" >
                                </div>
                                <div class="col-xl-3 col-4" >
                                    <button class="greenButtonsCss btn-md btn " id="purchaseCartButtonInModal" data-dismiss="modal" style="margin-top:15px;">Purchase</button>
                                </div>
                            </div> 
                        </form>
                    </div>
                </div>  
            </div>
        </div>




        <!-- Error Modal -->
        <div class="modal fade modalStyle" id="errorModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ErrorModalTitle">
                            <i class="fas fa-exclamation-triangle scocareModalTriangle"></i>
                            Attention
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <div class="modal-body">
                    </div>

                </div>
            </div>
        </div>

        <script>var baseURL = '<?php echo base_url(); ?>';</script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.js" type="text/javascript" ></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>
        <script src="https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.js"></script>

        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js "></script>
        
        <script  src="<?php echo base_url(); ?>assets/js/common.js?ran='. rand(1, 1000000) . '"></script>

    <?php
        if(isset($scripts)){
            echo $scripts;
        } 
    ?>
    </body>
</html>
