import { handleDragLeave, LoadHandleImages, LoadModalBtn, handleDragEnter } from "./modal.js";
import { loadModalDeleteBtn } from "./modalDelete.js";
import { loadModalDeleteUserBtn } from "./modalUserDelete.js";
import { loadSidebar } from "./sidebar.js";
import { loadUser } from "./usuarios.js";

addEventListener("DOMContentLoaded", () => {
    LoadModalBtn();
    LoadHandleImages();
    loadModalDeleteBtn();
    loadUser();
    loadModalDeleteUserBtn();

    loadSidebar();
});

window.handleDragEnter = handleDragEnter;
window.handleDragLeave = handleDragLeave;