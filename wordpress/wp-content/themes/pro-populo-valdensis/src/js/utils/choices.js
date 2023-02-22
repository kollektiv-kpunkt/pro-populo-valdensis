import Choices from "choices.js";
import "choices.js/public/assets/styles/choices.min.css";

let selects = document.querySelectorAll(".ppv-choices-js");

selects.forEach((select) => {
    new Choices(select, {
        itemSelectText: select.dataset.itemSelectText || "",
        searchEnabled: select.dataset.searchEnabled || false,
        noChoicesText: select.dataset.noChoicesText || "",
        noResultsText: select.dataset.noResultsText || "",
    });
});