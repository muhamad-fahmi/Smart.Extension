$(document).ready(() => {
    var sidebar_menu = $("#sidebar-wrapper .dropdown-toggle");

    sidebar_menu.on("click", function () {
        var id_submenu = $(this).attr("href").replace("#", "");

        var sub_menu = $(`#${id_submenu}`);

        if (!sub_menu.hasClass("show")) {
            $(this).addClass("fw-bold");
        } else {
            $(this).removeClass("fw-bold");
        }
    });

    sidebar_menu.each(function () {
        var id_submenu = $(this).attr("href").replace("#", "");
        var sub_menu = $(`#${id_submenu}`);

        if (sub_menu.hasClass("show")) {
            $(this).addClass("fw-bold");
        } else {
            $(this).removeClass("fw-bold");
        }
    });
});
