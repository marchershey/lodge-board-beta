/**
 * Formatters / Masks
 * Cleave - https://github.com/nosir/cleave.js
 */
import Cleave from "cleave.js";
function formatPhone(element) {
    new Cleave(element, {
        phone: true,
        delimiter: " ",
        phoneRegionCode: "US",
    });
}
function formatDate(element) {
    new Cleave(element, {
        date: true,
        delimiter: "/",
        datePattern: ["m", "d", "Y"],
    });
}
function formatZipCode(element) {
    new Cleave(element, {
        numericOnly: true,
        blocks: [5],
        rawValueTrimPrefix: true,
    });
}
function formatMoney(element) {
    new Cleave(element, {
        numeral: true,
        numeralPositiveOnly: true,
        numeralDecimalMark: ".",
        delimiter: ",",
        numeralDecimalScale: 2,
        rawValueTrimPrefix: true,
    });
}
document.querySelectorAll(".phone").forEach((element) => {
    formatPhone(element);
});
document.querySelectorAll(".date").forEach((element) => {
    formatDate(element);
});
document.querySelectorAll(".money").forEach((element) => {
    formatMoney(element);
});
document.querySelectorAll(".zip-code").forEach((element) => {
    formatZipCode(element);
});
window.addEventListener("maskAllElements", (event) => {
    document.querySelectorAll(".phone").forEach((element) => {
        formatPhone(element);
    });
    document.querySelectorAll(".date").forEach((element) => {
        formatDate(element);
    });
    document.querySelectorAll(".money").forEach((element) => {
        formatMoney(element);
    });
    document.querySelectorAll(".zip-code").forEach((element) => {
        formatZipCode(element);
    });
});
