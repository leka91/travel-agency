jQuery(document).ready(function ($) {
    "use strict";

    $("#tour_requirements").select2({
        allowClear: true,
        placeholder: "Select tour requirements",
        tags: true,
    });

    // $("#locationBtn").on("click", function () {
    //     let lastElement = $(this).prev()[0];
    //     let locationId = $(lastElement).find("span")[0];
    //     let a = Number($(locationId).text());
    //     console.log(a);
    // });
});
