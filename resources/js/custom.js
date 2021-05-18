const { pad } = require("lodash");

$(function () {
    //CUSTOM JS
    $("#userEditModal").on("shown.bs.modal", function (event) {
        let button = $(event.relatedTarget); // Button that triggered the modal
        let user = button.data("user");

        let modal = $(this);

        modal.find("#userEditId").val(user.id);
        modal.find("#userEditName").text(user.name);
        modal.find("#userEditRole").val(user.role);
    });

    $("#userEditModalAjax").on("shown.bs.modal", function (event) {
        let button = $(event.relatedTarget); // Button that triggered the modal
        let user = button.data("user");

        let modal = $(this);

        modal.find("#userEditIdAjax").val(user.id);
        modal.find("#userEditNameAjax").text(user.name);
        modal.find("#userEditRoleAjax").val(user.role);
    });

    $("#userDeleteModal").on("shown.bs.modal", function (event) {
        let button = $(event.relatedTarget); // Button that triggered the modal
        let user = button.data("user");

        let modal = $(this);

        modal.find("#userDeleteId").val(user.id);
        modal.find("#userDeleteName").text(user.name);
    });

    $("#boardDeleteModal").on("shown.bs.modal", function (event) {
        let button = $(event.relatedTarget); // Button that triggered the modal
        let board = button.data("board");

        let modal = $(this);

        modal.find("#boardDeleteId").val(board.id);
        modal.find("#boardDeleteName").text(board.name);
    });

    $("#taskEditModal").on("shown.bs.modal", function (event) {
        let button = $(event.relatedTarget); // Button that triggered the modal
        let task = button.data("task");

        let modal = $(this);

        modal.find("#taskEditId").val(task.id);
        modal.find("#taskEditName").val(task.name);
        modal.find("#taskEditDescription").val(task.description);
        modal.find("#taskEditStatus").val(task.status);
    });

    $("#taskDeleteModal").on("shown.bs.modal", function (event) {
        let button = $(event.relatedTarget); // Button that triggered the modal
        let task = button.data("task");

        let modal = $(this);

        modal.find("#taskDeleteId").val(task.id);
        modal.find("#taskDeleteName").text(task.name);
    });

    /**
     * Update user using ajax
     */

    $("#userEditButtonAjax").on("click", function () {
        $("#userEditAlert").addClass("hidden");

        let id = $("#userEditIdAjax").val();
        let role = $("#userEditRoleAjax").val();

        $.ajax({
            method: "POST",
            url: "/user-update/" + id,
            data: { role: role },
        }).done(function (response) {
            if (response.error !== "") {
                $("#userEditAlert").text(response.error).removeClass("hidden");
            } else {
                window.location.reload();
            }
        });
    });

    $("#userDeleteButton").on("click", function () {
        $("#userDeleteAlert").addClass("hidden");
        let id = $("#userDeleteId").val();

        $.ajax({
            method: "POST",
            url: "/user/delete/" + id,
        }).done(function (response) {
            if (response.error !== "") {
                $("#userDeleteAlert")
                    .text(response.error)
                    .removeClass("hidden");
            } else {
                window.location.reload();
            }
        });
    });

    $("#changeBoard").on("change", function () {
        let id = $(this).val();

        window.location.href = "/board/" + id;
    });



    $("#boardEditModal").on("shown.bs.modal", function (event) {
        let button = $(event.relatedTarget); // Button that triggered the modal
        let board = button.data("board");

        $(this).find("#boardEditIdAjax").val(board.id);

        $('#boardEditUserAjax').select2({ width: "300px" });

        const user_ids = board.board_users.map(({ user_id }) => (user_id));

        $('#boardEditUserAjax').val(user_ids).trigger("change");
    });

    $("#boardEditButton").on("click", function (event) {
        let user_ids = $("#boardEditUserAjax").val();
        let id = $("#boardEditIdAjax").val();

        $.ajax({
            method: "POST",
            url: "/board/update/" + id,
            data: {
                board_user_ids: user_ids,
            },
        }).done(function (response) {
            if (response.error !== "") {
                $("#boardEditAlert").text(response.error).removeClass("hidden");
            } else {
                window.location.reload();
            }
        });
    });


    $("#boardDeleteButton").on("click", function () {
        $("#boardDeleteAlert").addClass("hidden");
        let id = $("#boardDeleteId").val();

        $.ajax({
            method: "POST",
            url: "/board/delete/" + id,
        }).done(function (response) {
            if (response.error !== "") {
                $("#boardDeleteAlert")
                    .text(response.error)
                    .removeClass("hidden");
            } else {
                window.location.reload();
            }
        });
    });

    $("#taskEditButton").on("click", function () {
        $("#taskEditAlert").addClass("hidden");

        let id = $("#taskEditId").val();
        let status = $("#taskEditStatus").val();
        let name = $("#taskEditName").val();
        let description = $("#taskEditDescription").val();

        $.ajax({
            method: "POST",
            url: "/tasks/update/" + id,
            data: {
                status: status,
                name: name,
                description: description
            },
        }).done(function (response) {
            if (response.error !== "") {
                $("#taskEditAlert").text(response.error).removeClass("hidden");
            } else {
                window.location.reload();
            }
        });
    });

    $("#taskDeleteButton").on("click", function () {
        $("#taskDeleteAlert").addClass("hidden");
        let id = $("#taskDeleteId").val();

        $.ajax({
            method: "POST",
            url: "/tasks/delete/" + id,
        }).done(function (response) {
            if (!response.error.length) {
                $("#taskDeleteAlert")
                    .text(response.success)
                    .removeClass("hidden");
                window.location.reload();
            } else {
                $("#taskDeleteAlert")
                    .text(response.error)
                    .removeClass("hidden");
                window.location.reload();
            }
        });
    });
});
