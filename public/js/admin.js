$(function () {
    "use strict";

    // Delete tour
    $("#deleteModal").on("show.bs.modal", function (e) {
        let modal = $(this);
        let button = $(e.relatedTarget);
        let tourId = button.data("tourid");

        modal.find(".modal-body #tour_id").val(tourId);
    });

    // Remove tour
    $("#removeModal").on("show.bs.modal", function (e) {
        let modal = $(this);
        let button = $(e.relatedTarget);
        let tourId = button.data("tourid");

        modal.find(".modal-body #tour_id").val(tourId);
    });

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
});
