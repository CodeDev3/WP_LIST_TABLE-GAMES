jQuery(document).ready(function ($) {
  console.log("custom js added");
  $(".alert").hide();
  $("#PlayerData").on("submit", function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    formData.append("action", "add_player");
    console.log(formData);
    $.ajax({
      url: "admin-ajax.php",
      method: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function (res) {
        if (res.success) {
          $(".alert")
            .show()
            .removeClass("alert-danger")
            .addClass("alert-success")
            .empty()
            .text(res.data.message);
          console.log("success");
          $("#PlayerData")[0].reset();
          setTimeout(function () {
            window.location.href =
              "http://localhost/project/wp-admin/admin.php?page=all-player";
          }, 2000);
        } else {
          $(".alert")
            .show()
            .removeClass("alert-success")
            .addClass("alert-danger")
            .empty()
            .text(res.data.message);
          console.log("error");

          setTimeout(function () {
            $(".alert").hide();
          }, 2000);
        }
      },
      error: function (xhr, status, error) {
        console.log("Ajax Error : " + error);
      },
    });
  });
});
