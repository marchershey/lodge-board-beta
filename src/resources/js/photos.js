/**
 * This handles the photos uploading progress
 */
Alpine.data("photosuploader", () => ({
    isuploading: false,
    progress: "0",
}));

window.addEventListener("init-sortable", (event) => {
    // initSortablePhotos();
    setTimeout(function () {
        //your code to be executed after 1 second
        initSortablePhotos();
    }, 150);
});

/**
 * Draggable - v1.1.3
 * https://github.com/Shopify/draggable
 */
// import { Sortable, Plugins } from "@shopify/draggable";
// window.Sortable = Sortable;
// window.Plugins = Plugins;

import { Sortable } from "@shopify/draggable";

window.sort = false;

function initSortablePhotos() {
    const sortableContainer = ".sortable";
    const containers = document.querySelectorAll(sortableContainer);

    if (containers.length === 0) {
        return false;
    }

    if (sort) {
        sort.destroy();
    }

    sort = new Sortable(containers, {
        draggable: ".sortable--item",
        mirror: {
            appendTo: sortableContainer,
            constrainDimensions: true,
            cursorOffsetX: 50,
            cursorOffsetY: 50,
        },

        classes: {
            mirror: ["mirror", "drop-shadow-xl", "shadow-lg", "rounded-lg"],
            "draggable:over": ["opacity-0"], // Classes added on draggable element you are dragging over
            "source:dragging": ["opacity-20"], // Classes added on the draggable element that has been picked up

            "source:original": ["opacity-0"], // Classes added on the original source element, which is hidden on drag
        },
    });

    // Do not allow users the sort the header photo
    sort.on("drag:start", (event) => {
        const { source } = event;
        const firstDiv = containers[0].children[0];

        if (source == firstDiv) {
            event.cancel();
        }
    });

    return sort;
}

function reinitSortablePhotos() {
    //
}
