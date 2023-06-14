<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
        
        </main>
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
