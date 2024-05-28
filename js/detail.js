src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"
$(document).ready(function(){
  $(".btn_detail").click(function(e){
    e.preventDefault();
    $.ajax({
      url: "detail.php",
      type: "get",
      success: function(response) {
        // Add the response to the body of the page
        $("body").append(response);
        // Show the modal
        $("#detailModal").modal("show");
      }
    });
  });
});
