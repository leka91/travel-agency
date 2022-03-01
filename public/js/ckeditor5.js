$(function () {
    "use strict";

    // CK Editor
    ClassicEditor.create(document.querySelector("#description") || {}, {
        heading: {
            options: [
                {
                    model: "paragraph",
                    title: "Paragraph",
                    class: "ck-heading_paragraph",
                },
                {
                    model: "heading3",
                    view: "h3",
                    title: "Heading 3",
                    class: "ck-heading_heading3",
                },
            ],
        },
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
