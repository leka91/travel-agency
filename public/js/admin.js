jQuery(document).ready(function ($) {
    "use strict";

    $("#tour_requirements").select2({
        allowClear: true,
        placeholder: "Select tour requirements",
        tags: true,
    });

    FilePond.create(document.querySelector('input[id="hero_image"]'));
});
