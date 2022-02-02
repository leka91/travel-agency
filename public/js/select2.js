$(function () {
    "use strict";

    // Multi select
    $("#requirements").select2({
        allowClear: true,
        placeholder: "Select tour requirements",
        tags: true,
        minimumInputLength: 2,
        ajax: {
            url: "/admin/requirements-search",
            dataType: "json",
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.name,
                            id: item.id,
                        };
                    }),
                };
            },
            cache: true,
        },
    });

    $("#tags").select2({
        allowClear: true,
        placeholder: "Select tour tags",
        tags: true,
        minimumInputLength: 2,
        ajax: {
            url: "/admin/tags-search",
            dataType: "json",
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.name,
                            id: item.id,
                        };
                    }),
                };
            },
            cache: true,
        },
    });

    $("#videos").select2({
        allowClear: true,
        placeholder: "Select tour videos",
        tags: true,
        // minimumInputLength: 2,
    });
});
