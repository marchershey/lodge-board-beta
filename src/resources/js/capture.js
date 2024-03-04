var L = function (C, $, g) {
    if (C.indexOf($) === -1) return g;
    const x = C[C.indexOf($) + 1];
    if (!x) return g;
    if ($ === "duration") {
        let R = x.match(/([0-9]+)ms/);
        if (R) return R[1];
    }
    if ($ === "min") {
        let R = x.match(/([0-9]+)px/);
        if (R) return R[1];
    }
    return x;
};
function J(C) {
    C.directive("collapse", $),
        ($.inline = (g, { modifiers: x }) => {
            let R = x.includes("overflow") ? !0 : !1;
            if (!x.includes("min")) return;
            if (((g._x_doShow = () => {}), (g._x_doHide = () => {}), R))
                g.style.overflow = "clip";
        });
    function $(g, { modifiers: x }) {
        let R = L(x, "duration", 250) / 1000,
            q = L(x, "min", 0),
            E = !x.includes("min"),
            z = x.includes("horizontal") ? "horizontal" : "vertical",
            M = x.includes("overflow") ? !0 : !1;
        if (!g._x_isShown) g.style.height = `${q}px`;
        if (!g._x_isShown) g.style.width = `${q}px`;
        if (!g._x_isShown && E) g.hidden = !0;
        if (!g._x_isShown) g.style.overflow = "clip";
        let N = (I, G) => {
                let B = C.setStyles(I, G);
                if (z === "vertical") return G.height ? () => {} : B;
                else return G.width ? () => {} : B;
            },
            K = {
                transitionProperty: "width, height",
                transitionDuration: `${R}s`,
                transitionTimingFunction: "cubic-bezier(0.4, 0.0, 0.2, 1)",
            };
        g._x_transition = {
            in(I = () => {}, G = () => {}) {
                if (E) g.hidden = !1;
                if (E) g.style.display = null;
                let B, D;
                if (z === "vertical")
                    (B = g.getBoundingClientRect().height),
                        (g.style.height = "auto"),
                        (D = g.getBoundingClientRect().height);
                else
                    (B = g.getBoundingClientRect().width),
                        (g.style.width = "auto"),
                        (D = g.getBoundingClientRect().width);
                if (B === D) B = q;
                C.transition(
                    g,
                    C.setStyles,
                    {
                        during: K,
                        start:
                            z === "vertical"
                                ? { height: B + "px" }
                                : { width: B + "px" },
                        end:
                            z === "vertical"
                                ? { height: D + "px" }
                                : { width: D + "px" },
                    },
                    () => (g._x_isShown = !0),
                    () => {
                        if (
                            Math.round(g.getBoundingClientRect().height) ==
                                Math.round(D) ||
                            Math.round(g.getBoundingClientRect().width) ==
                                Math.round(D)
                        ) {
                            if (!M) g.style.overflow = null;
                        }
                    },
                );
            },
            out(I = () => {}, G = () => {}) {
                let B =
                    z === "vertical"
                        ? g.getBoundingClientRect().height
                        : g.getBoundingClientRect().width;
                C.transition(
                    g,
                    N,
                    {
                        during: K,
                        start:
                            z === "vertical"
                                ? { height: B + "px" }
                                : { width: B + "px" },
                        end:
                            z === "vertical"
                                ? { height: q + "px" }
                                : { width: q + "px" },
                    },
                    () => (g.style.overflow = "clip"),
                    () => {
                        if (
                            ((g._x_isShown = !1),
                            (g.style.height == `${q}px` && E) ||
                                (g.style.width == `${q}px` && E))
                        )
                            (g.style.display = "none"), (g.hidden = !0);
                    },
                );
            },
        };
    }
}
document.addEventListener("alpine:init", () => {
    window.Alpine.plugin(J);
});
