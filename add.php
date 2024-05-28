
<html>
    <head>
    <meta charset="utf-8"/>
    </head>
    <body>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
        <h4 class="modal-title" id="myModalLabel">Add product</h4>
      </div>
      <div class="modal-body">
        <!-- Your modal content here -->
        <form >
   <tr>
    Name Product:
    <input type="text" name="name" id="name" />
   </tr>
   <br>
   <br>
   <tr>
    Price:
    <input type="number" name="price" id="price"/>
   </tr>
   <br>
   <br>
   <tr>
    Description:
    <input type="text" name="description" id="descripton"/>
   </tr>
   <br>
   <br>
   <tr>
    Image:
    <input type="file" name="image" id="image"/>
   </tr>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="closeModal()">Close</button>
        <button type="submit" value="Create Product" class="btn btn-primary" onclick="saveChanges()">Save changes</button>

       
      </div>
    </div>
  </div>
</div>

<script>
    // closeModal
function closeModal() {
            // Add your close logic here
            
            // Close the modal
            $("#myModal").modal("hide");
        }
// SaveChanges
function saveChanges() {
            // Add your save logic here
            
            // Close the modal
            $("#myModal").modal("hide");
            
            // Reload the home page
            window.location.href = "/table.php";
        }
    // Show Modal    
$(document).ready(function(){
  $("#addButton").click(function(){
    // Show the modal
    $("#myModal").modal("show");
  });
});
</script>

</body>
</html>