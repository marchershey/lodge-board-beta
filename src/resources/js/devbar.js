Alpine.store("devbar", {
    init() {
        this.visible = true;
    },

    visible: true,

    toggle() {
        this.visible = !this.visible;
    },
});
