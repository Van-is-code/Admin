src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"

$(document).ready(function(){
  $(".btn_edit").click(function(e){
    e.preventDefault();
    $.ajax({
      url: "edit.php",
      type: "get",
      success: function(response) {
        // Add the response to the body of the page
        $("body").append(response);
        // Show the modal
        $("#editModal").modal("show");
      }
    });
  });
});
