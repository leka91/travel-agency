jQuery(document).ready(function ($) {
    "use strict";

    // Remove gallery image
    $(".gallery-image-btn").on("click", function (e) {
        e.preventDefault();
        let btn = $(this);

        const galleryId = btn.attr("data-galleryId");

        $.ajax({
            method: "POST",
            url: "/galleries/remove-gallery-image",
            data: {
                galleryId: galleryId,
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
        })
            .done(function (response) {
                const message = response.message;

                $("#gallery-info-box")
                    .attr({
                        class: "alert alert-success",
                        role: "alert",
                    })
                    .html(`<strong>Success! </strong>${message}`)
                    .fadeIn()
                    .delay(1000)
                    .fadeOut();

                btn.parent().remove();
            })
            .fail(function (error) {
                const message = error.responseJSON.message;

                $("#gallery-info-box")
                    .attr({
                        class: "alert alert-danger alert-dismissible",
                        role: "alert",
                    })
                    .html(
                        `<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Warning! </strong>${message}`
                    );
            });
    });

    // CK Editor
    ClassicEditor.create(document.querySelector("#description") || {}, {
        toolbar: [
            "heading",
            "|",
            "bold",
            "italic",
            "link",
            "bulletedList",
            "numberedList",
            "|",
            "outdent",
            "indent",
            "|",
            "blockQuote",
            "|",
            "undo",
            "redo",
        ],
    }).catch((error) => {
        console.error(error);
    });

    // Multi select
    $("#requirements").select2({
        allowClear: true,
        placeholder: "Select tour requirements",
        tags: true,
    });

    // Filepond for gallery
    const gallery = document.querySelector('input[id="gallery"]');
    const galleryOptions = {
        server: {
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            process: {
                url: "/upload",
                onerror: (response) => response,
            },
            revert: {
                url: "/upload-remove",
            },
        },
        multiple: true,
        maxFiles: 5,
        labelFileProcessingError: (error) => {
            let err = error.body;
            let errorMessage = err.slice(1, -1);

            return errorMessage;
        },
    };
    FilePond.create(gallery, galleryOptions);

    // Filepond for hero image
    const heroimage = document.querySelector('input[id="heroimage"]');
    const heroimageOptions = {
        server: {
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            process: {
                url: "/upload",
                onerror: (response) => response,
            },
            revert: {
                url: "/upload-remove",
            },
        },
        labelFileProcessingError: (error) => {
            let err = error.body;
            let errorMessage = err.slice(1, -1);

            return errorMessage;
        },
    };
    FilePond.create(heroimage, heroimageOptions);
});
