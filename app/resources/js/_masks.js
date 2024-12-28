/**
 * This mask is to validate a url slug
 *
 * @param {string} text - the text to mask
 * @returns
 */
function slugify(text) {
    return text
        .toString()
        .toLowerCase()
        .replace(/\s+/g, "-") // Replace spaces with dashes
        .replace(/[^\w\-]+/g, "") // Remove non-word characters
        .replace(/\-\-+/g, "-") // Replace multiple dashes with a single dash
        .replace(/^-+/, ""); // Remove leading dashes
    // .replace(/-+$/, ''); // Remove trailing dashes
}

window.slugify = slugify;

import IMask from "imask";

function formatPostalCode(element) {
    IMask(element, {
        mask: "00000",
    });
}
document.querySelectorAll(".mask-zip > input").forEach((element) => {
    formatPostalCode(element);
});

/**
 * Formatters / Masks
 * Cleave - https://github.com/nosir/cleave.js
 */
// import Cleave from "cleave.js";
// function formatPhone(element) {
//     new Cleave(element, {
//         phone: true,
//         delimiter: " ",
//         phoneRegionCode: "US",
//     });
// }
// function formatDate(element) {
//     new Cleave(element, {
//         date: true,
//         delimiter: "/",
//         datePattern: ["m", "d", "Y"],
//     });
// }
// function formatZipCode(element) {
//     new Cleave(element, {
//         numericOnly: true,
//         blocks: [5],
//         rawValueTrimPrefix: true,
//     });
// }
// function formatMoney(element) {
//     new Cleave(element, {
//         numeral: true,
//         numeralPositiveOnly: true,
//         numeralDecimalMark: ".",
//         delimiter: ",",
//         numeralDecimalScale: 2,
//         rawValueTrimPrefix: true,
//     });
// }
// document.querySelectorAll(".phone").forEach((element) => {
//     formatPhone(element);
// });
// document.querySelectorAll(".date").forEach((element) => {
//     formatDate(element);
// });
// document.querySelectorAll(".money").forEach((element) => {
//     formatMoney(element);
// });
// document.querySelectorAll(".zip-code").forEach((element) => {
//     formatZipCode(element);
// });
// window.addEventListener("maskAllElements", (event) => {
//     document.querySelectorAll(".phone").forEach((element) => {
//         formatPhone(element);
//     });
//     document.querySelectorAll(".date").forEach((element) => {
//         formatDate(element);
//     });
//     document.querySelectorAll(".money").forEach((element) => {
//         formatMoney(element);
//     });
//     document.querySelectorAll(".zip-code").forEach((element) => {
//         formatZipCode(element);
//     });
// });
