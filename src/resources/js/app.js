import "./bootstrap";

// Alpine & Livewire
import {
    Alpine,
    Livewire,
} from "../../vendor/livewire/livewire/dist/livewire.esm";

// Tall Toasts
import ToastComponent from "../../vendor/usernotnull/tall-toasts/resources/js/tall-toasts";
Alpine.plugin(ToastComponent);

// Theme Mode
import "./themeMode";

// Start Livewire
Livewire.start();
