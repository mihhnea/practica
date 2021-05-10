//CUSTOM JS
$("#edit-modal").on("shown.bs.modal", function (event) {
    let button = $(event.relatedTarget); // Button that triggered the modal
    let user = button.data("user");

    let modal = $(this);

    modal.find("#editId").val(user.id);
    modal.find("#editName").text(user.name);
    modal.find("#editRole").val(user.role);
    modal.find("#update-user").attr("data-id", user.id);
});

$("#delete-modal").on("shown.bs.modal", function (e) {
    e.preventDefault();

    const button = $(e.relatedTarget); // Button that triggered the modal
    const userData = button.data("user");

    $("#delete-user").on("click", function () {
        $.ajax({
            url: `delete-users/${userData.id}`,
            processData: false,
            type: "POST",
            success: function (data) {
                //sa afisezi success

                $("#delete-modal").modal("hide");
                $(".user-row-" + userData.id).remove();

                $("#success").text("It worked");
            },
        });
    });
});

$(document).on("click", "#update-user", function (e) {
    e.preventDefault();

    const id = $(this).attr("data-id");
    const roleId = $("#editRole option").filter(":selected").val();

    $.ajax({
        url: `update-users/${id}`,
        data: {
            role_id: roleId,
        },
        type: "PATCH",
        success: function (data) {
            //sa afisezi succes

            $("#edit-modal").modal("hide");
            $(".user-row-" + data.id + " .role").text(
                data.role == 1 ? "Admin" : "User"
            );
        },
    });
});
