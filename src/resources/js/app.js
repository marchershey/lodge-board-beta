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

// Tall Toasts
import ToastComponent from "../../vendor/usernotnull/tall-toasts/resources/js/tall-toasts";

Alpine.plugin(AlpineUI);
Alpine.plugin(AlpineFocus);
Alpine.plugin(AlpineCollapse);
Alpine.plugin(ToastComponent);

// Theme Mode
import "./themeMode";

// Photos Uploader
import "./photouploader";

/**
 * Draggable - v1.1.3
 * https://github.com/Shopify/draggable
 */
import { Sortable, Plugins } from "@shopify/draggable";
window.Sortable = Sortable;
window.Plugins = Plugins;

// Start Livewire
Livewire.start();
