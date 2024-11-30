// if (
//     localStorage.theme === "dark" ||
//     (!("theme" in localStorage) &&
//         window.matchMedia("(prefers-color-scheme: dark)").matches)
// ) {
//     console.log('Setting theme mode to "dark"');
//     localStorage.theme = "dark";
//     document.documentElement.classList.add("dark");
// } else {
//     console.log('Setting theme mode to "light"');
//     localStorage.theme = "light";
//     document.documentElement.classList.remove("dark");
// }

Alpine.data("themeMode", () => ({
    changeThemeMode() {
        switch (localStorage.theme) {
            case "light":
                console.log('Switching theme mode to "dark".');
                document.documentElement.classList.add("dark");
                localStorage.theme = "dark";
                break;
            case "dark":
                console.log('Switching theme mode to "light".');
                document.documentElement.classList.remove("dark");
                localStorage.theme = "light";
                break;
        }
    },
}));
