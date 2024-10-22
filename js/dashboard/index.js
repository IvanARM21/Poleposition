import { handleDragLeave, LoadHandleImages, LoadModalBtn, handleDragEnter } from "./modal.js";
import { loadModalDeleteBtn } from "./modalDelete.js";
import { loadUser } from "./usuarios.js";

addEventListener("DOMContentLoaded", () => {
    LoadModalBtn();
    LoadHandleImages();
    loadModalDeleteBtn();
    loadUser();
});

window.handleDragEnter = handleDragEnter;
window.handleDragLeave = handleDragLeave;