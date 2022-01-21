$(function () {
    "use strict";

    // Filepond for gallery
    const gallery = document.querySelector('input[id="gallery"]');
    const galleryOptions = {
        server: {
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            process: {
                url: "/admin/upload",
                onerror: (response) => response,
            },
            revert: {
                url: "/admin/upload-remove",
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
                url: "/admin/upload-heroimage",
                onerror: (response) => response,
            },
            revert: {
                url: "/admin/upload-remove",
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
