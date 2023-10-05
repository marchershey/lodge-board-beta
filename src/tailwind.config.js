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
                primary: {
                    DEFAULT: colors.blue[600],
                    light: colors.blue[500],

                    hover: colors.blue[700],
                    active: colors.blue[800],
                },
                muted: {
                    dark: colors.gray[500],
                    DEFAULT: colors.gray[400],
                    light: colors.gray[200],
                    lighter: colors.gray[100],

                    hover: colors.gray[500],
                    active: colors.gray[600],
                },
                gray: colors.gray,
            },
            screens: {
                phone: "480px", // => @media (min-width: 480px) { ... }
                tablet: "640px", // => @media (min-width: 640px) { ... }
                "tablet-lg": "768px", // => @media (min-width: 640px) { ... }
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
    },
    corePlugins: {
        // aspectRatio: false,
    },
    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
        require("tailwindcss-animate"),
        // require("@tailwindcss/aspect-ratio"),
    ],
};
