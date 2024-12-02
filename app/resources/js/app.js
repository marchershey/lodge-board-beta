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
Alpine.plugin(AlpineUI);
Alpine.plugin(AlpineFocus);
Alpine.plugin(AlpineCollapse);
Alpine.plugin(mask)
// Alpine.plugin(AlpinePersist);
Alpine.plugin(ToastComponent);

// Dev bar
import "./_devbar";

// Theme Mode
import "./_themeMode";

// Photos
import "./_photos";

// Start Livewire
Livewire.start();

window.addEventListener("console", (event) => {
    console.log(event.detail);
});

import "./_formatter";

window.addEventListener(
    "popstate",
    (event) => {
        // The popstate event is fired each time when the current history entry changes.
        location.reload();
    },
    false,
);
