$(document).ready(function () {
    const sidebarMenu = $("#sidebar-menu a");
    let currentUrl = location.href.split("?")[0];

    sidebarMenu.each(function () {
        let sidebarUrl = $(this).attr("href");
        if (sidebarUrl === currentUrl) {
            $(this).parent().closest(".sidebar-item").addClass("active");
        }
    });
});
