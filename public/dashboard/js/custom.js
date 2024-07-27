function preview_image() {
    $("#upload-text").remove();
    $(".fileDiv").remove();
    var total_file = document.getElementById("upload_file").files.length;
    for (var i = 0; i < total_file; i++) {
        $("#image_preview").append(
            '<div class="fileDiv col-4 col-sm-2 pt-2"><div class="card text-center"><div class="overflow-hidden position-relative border-radius-lg bg-cover p-3" style="height:140px; background-image: url(' +
                URL.createObjectURL(event.target.files[i]) +
                '); background-position: center center;"></div></div></div>'
        );
    }
}
