//  src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"

// $(document).ready(function(){
//   $(".btn_detail").click(function(e){
//     e.preventDefault();
//     var productId = $(this).data("id");
//     // console.log(url);
//     var url = "products/detail.php?id=" + productId;
//    // In URL ra console để kiểm tra
//     $.ajax({
//       url: url,
//       type: "get",
//       success: function(response) {
//         // Thêm phản hồi vào body của trang
//         $("body").append(response);
//         // Hiển thị modal
//         $("#detailModal").modal("show");
//       }
//     });
//   });
// });

// // function showProductDetail(productId) {
// //   $.ajax({
// //     url: 'detail.php', // File PHP to fetch product details
// //     type: 'GET',
// //     data: {
// //       product_id: productId
// //     },
// //     success: function(response) {
// //       $('#detailModal .modal-body').html(response);
// //       $('#detailModal').modal('show');
// //     }
// //   });
// // }
