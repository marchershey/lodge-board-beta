Alpine.store("devbar", {
    open: false,

    toggle() {
        this.open = !this.open;
    },
});

// // Alpine.store("devbar", true);

// document.addEventListener("alpine:init", () => {
//     Alpine.store("devbar", {
//         open: Alpine.$persist(false).as("devbar"),
//     });
// });
// Alpine.store("devbar", {
//     open: Alpine.$persist(true).as("devbar_on"),
// });
