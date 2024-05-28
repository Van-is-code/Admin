<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
        <h4 class="modal-title" id="myModalLabel">Detail product</h4>
      </div>
      <div class="modal-body">
        <!-- Your modal content here -->
        Hi detail products to your
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="closeModal()">Close</button>


       
      </div>
    </div>
  </div>
</div>

<script>
    // closeModal
function closeModal() {
            // Add your close logic here
            
            // Close the modal
            $("#detailModal").modal("hide");
        }
    // Show Modal    
$(document).ready(function(){
  $("#detail").click(function(){
    // Show the modal
    $("#detailModal").modal("show");
  });
});
</script>