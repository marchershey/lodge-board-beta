import "./bootstrap";

// Alpine & Livewire
import {
    Alpine,
    Livewire,
} from "../../vendor/livewire/livewire/dist/livewire.esm";

// Alpine Plugins
import AlpineUI from "@alpinejs/ui";
import AlpineFocus from "@alpinejs/focus";
import AlpineCollapse from "@alpinejs/collapse";
import mask from '@alpinejs/mask'

// import AlpinePersist from "@alpinejs/persist";

// Tall Toasts
import ToastComponent from "../../vendor/usernotnull/tall-toasts/resources/js/tall-toasts";

// Init Alpine Plugins
// Alpine.plugin(AlpineUI);
// Alpine.plugin(AlpineFocus);
// Alpine.plugin(AlpineCollapse);
Alpine.plugin(mask)
// Alpine.plugin(AlpinePersist);
Alpine.plugin(ToastComponent);
// Start Livewire
Livewire.start();

// Dev bar
import "./_devbar";

// Theme Mode
import "./_themeMode";




// Photos
import "./_photos";
// Masks
import "./_masks";

// Custom dispatch event to write to browser console
window.addEventListener("console", (event) => {
    console.log(event.detail);
});


/**
 * https://github.com/marchershey/lodge-board-beta/issues/130
 */
window.addEventListener(
    "popstate",
    (event) => {
        // The popstate event is fired each time when the current history entry changes.
        location.reload();
    },
    false,
);
