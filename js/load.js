$(function () {
    var content = $(".main");
    var template = "home.php";
    var defaults = content.html();

    content.load(template);

    $("body").on("click", ".nav-link", function (e) {
        e.preventDefault();
        
        /* if ($(this).hasClass("active")) {
            return;
        } else {
            $(".j_load").removeClass("active");
            $(this).addClass("active");
        } */

        var load_file = $(this).attr("href");

        content.html(defaults).delay(500).fadeOut(100, function () {
            var url = load_file + ".php" + " #" + load_file;
            content.load(url , function (response, status, jqXHR) {
            }).fadeIn();
        });
    });
});