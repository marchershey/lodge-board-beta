/**
 * This handles the photos uploading progress
 */
Alpine.data("photosuploader", () => ({
    uploading: false,
    progress: "0",
    photosCount: 0,
}));

// import "livewire-sortable";

import "@nextapps-be/livewire-sortablejs";

// Livewire.hook("drag:start", function () {
//     console.log("test");
// });

// window.addEventListener("init-sortable", (event) => {
//     // initSortablePhotos();
//     setTimeout(function () {
//         //your code to be executed after 1 second
//         initSortablePhotos();
//     }, 150);
// });

/**
 * Draggable - v1.1.3
 * https://github.com/Shopify/draggable
 */
// import { Sortable } from "@shopify/draggable";
// window.Sortable = Sortable;

// var sortable = false;

// function initSortablePhotos() {
//     const sortableContainer = ".sortable";
//     const containers = document.querySelectorAll(sortableContainer);

//     // If there isn't any photos to sort, don't sort.
//     if (containers.length === 0) {
//         return false;
//     }

//     // If there is an existing sortable instance, destroy it
//     if (sortable) {
//         sortable.destroy();
//     }

//     // Create the sortable instance
//     sortable = new Sortable(containers, {
//         draggable: ".sortable--item",
//         handle: ".sortable--handle",
//         mirror: {
//             appendTo: sortableContainer,
//             constrainDimensions: true,
//             cursorOffsetX: 50,
//             cursorOffsetY: 50,
//         },
//         classes: {
//             mirror: ["mirror", "drop-shadow-xl", "shadow-lg", "rounded-lg"],
//             "draggable:over": ["opacity-0"], // Classes added on draggable element you are dragging over
//             "source:dragging": ["opacity-20"], // Classes added on the draggable element that has been picked up
//             "source:original": ["opacity-0"], // Classes added on the original source element, which is hidden on drag
//         },
//     });

//     sortable.on("sortable:stop", () => {

//     });

//     // Do not allow users the sort the header photo
//     sortable.on("drag:start", (event) => {
//         const { sourceContainer } = event; // The sortable container
//         const { source } = event; // The element/photo that the user clicked to drag

//         /**
//          * Prevent the first photo from initiating a drag
//          */
//         const firstPhoto = sourceContainer.children[0];
//         if (source === firstPhoto) {
//             event.cancel();
//         }
//     });

//     return sortable;
// }
