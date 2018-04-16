$(document).ready(function() {
  $("#business-select").change(function() {
    var business_id = $(this).val();
    if(business_id != "") {
      $.ajax({
        url:"get-employees.php",
        data:{b_id:business_id},
        type:'POST',
        success:function(response) {
          var resp = $.trim(response);
          $("#employee-select").html(resp);
        }
      });
    } else {
      $("#employee-select").html("<option value=''>------- Select --------</option>");
    }
  });
});
