$(function () {
    "use strict";

    // Multi select
    $("#requirements").select2({
        allowClear: true,
        placeholder: "Select tour requirements",
        tags: true,
        // minimumInputLength: 2,
    });

    $("#tags").select2({
        allowClear: true,
        placeholder: "Select tour tags",
        tags: true,
        // minimumInputLength: 2,
    });

    $("#videos").select2({
        allowClear: true,
        placeholder: "Select tour videos",
        tags: true,
        // minimumInputLength: 2,
    });
});
