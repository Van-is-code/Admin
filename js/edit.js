src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"

$(document).ready(function(){
  $(".btn_edit").click(function(e){
    e.preventDefault();
    var productId = $(this).data("id");
    // console.log(url);
    var url = "products/edit.php?id=" + productId;
   // In URL ra console để kiểm tra
    $.ajax({
      url: url,
      type: "get",
      success: function(response) {
        // Thêm phản hồi vào body của trang
        $("body").append(response);
        // Hiển thị modal
        $("#editModal").modal("show");
      }
    });
  });
});

// function showProductedit(productId) {
//   $.ajax({
//     url: 'edit.php', // File PHP to fetch product edits
//     type: 'GET',
//     data: {
//       product_id: productId
//     },
//     success: function(response) {
//       $('#editModal .modal-body').html(response);
//       $('#editModal').modal('show');
//     }
//   });
// }
