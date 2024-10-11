import { handleDragLeave, LoadHandleImages, LoadModalBtn } from "./modal.js";
import { handleDragEnter } from "./modal.js";

addEventListener("DOMContentLoaded", () => {
    LoadModalBtn();
    LoadHandleImages();
});

window.handleDragEnter = handleDragEnter;
window.handleDragLeave = handleDragLeave;