import { handleDragLeave, LoadHandleImages, LoadModalBtn, handleDragEnter } from "./modal.js";
import { loadModalDeleteBtn } from "./modalDelete.js";

addEventListener("DOMContentLoaded", () => {
    LoadModalBtn();
    LoadHandleImages();
    loadModalDeleteBtn();
});

window.handleDragEnter = handleDragEnter;
window.handleDragLeave = handleDragLeave;