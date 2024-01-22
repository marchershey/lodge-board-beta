import "./bootstrap";

// Alpine & Livewire
import {
    Alpine,
    Livewire,
} from "../../vendor/livewire/livewire/dist/livewire.esm";

// Alpine Plugins
import AlpineUI from "@alpinejs/ui";
import AlpineFocus from "@alpinejs/focus";

// Tall Toasts
import ToastComponent from "../../vendor/usernotnull/tall-toasts/resources/js/tall-toasts";

Alpine.plugin(AlpineUI);
Alpine.plugin(AlpineFocus);
Alpine.plugin(ToastComponent);

// Theme Mode
import "./themeMode";

// Start Livewire
Livewire.start();
