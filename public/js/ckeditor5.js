$(function () {
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
});
