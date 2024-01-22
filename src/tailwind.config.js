/** @type {import('tailwindcss').Config} */

const colors = require("tailwindcss/colors");

export default {
    darkMode: "class",
    content: [
        "./resources/views/**/*.blade.php",
        "./app/View/Components/**/*.php",
    ],
    theme: {
        extend: {
            colors: {
                gray: colors.slate,
                primary: {
                    DEFAULT: colors.blue[600],
                    light: colors.blue[500],
                    lighter: colors.blue[300],

                    hover: colors.blue[700],
                    active: colors.blue[800],
                },
                muted: {
                    darkest: colors.slate[800],
                    darker: colors.slate[700],
                    dark: colors.slate[500],
                    DEFAULT: colors.slate[400],
                    light: colors.slate[300],
                    lighter: colors.slate[200],
                    lightest: colors.slate[100],

                    hover: colors.slate[500],
                    active: colors.slate[600],
                },
            },
            screens: {
                phone: "480px", // => @media (min-width: 480px) { ... }
                "tablet-sm": "640px", // => @media (min-width: 640px) { ... }
                tablet: "768px", // => @media (min-width: 640px) { ... }
                laptop: "1024px", // => @media (min-width: 1024px) { ... }
                desktop: "1280px", // => @media (min-width: 1280px) { ... }
            },
            fontFamily: {
                inter: ["Inter", "sans-serif"],
            },
            fontWeight: {
                thin: "100",
                extralight: "200",
                light: "300",
                normal: "400",
                medium: "500",
                semibold: "600",
                bold: "700",
                extrabold: "800",
                black: "900",
            },
        },
        aspectRatio: {
            auto: "auto",
            square: "1 / 1",
            video: "16 / 9",
            1: "1",
            2: "2",
            3: "3",
            4: "4",
            5: "5",
            6: "6",
            7: "7",
            8: "8",
            9: "9",
            10: "10",
            11: "11",
            12: "12",
            13: "13",
            14: "14",
            15: "15",
            16: "16",
        },
    },
    corePlugins: {
        // aspectRatio: false,
    },
    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
        require("tailwindcss-animate"),
        require("@tailwindcss/aspect-ratio"),
    ],
};
