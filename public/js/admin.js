jQuery(document).ready(function ($) {
    "use strict";

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
            "decreaseIndent",
            "increaseIndent",
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
