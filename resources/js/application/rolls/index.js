$(document).ready(function () {
    $(".btn-print-qrcode").on("click", function () {
        const id = $(this).data("id");
        const qrcodeImage = $(this).data("qrcode-image");
        const name = $(this).data("name");
        const code = $(this).data("code");
        const qrcode = $(this).data("qrcode");

        $("#qrcode-image-modal").attr(
            "src",
            `storage/images/qrcode/${qrcodeImage}`
        );
        $("#roll-id-modal").val(id);
        $("#roll-name-modal").text(name);
        $("#roll-code-modal").text(code);
        $("#roll-qrcode-modal").text(qrcode);
        $("#roll-qrcode-filename-modal").text(qrcodeImage);
    });
});
