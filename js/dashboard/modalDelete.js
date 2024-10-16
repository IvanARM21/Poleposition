import { PAGE_URL } from '../constants.js';

const modalShowDeleteBtns = document.getElementsByName("deleteBtn") ?? null;
const modalCloseBtn = document.getElementById("btnCloseDelete") ?? null;
const modalCancelBtn = document.getElementById("btnCancelDelete") ?? null;
const modalBg = document.getElementById("modalBgDelete") ?? null;

const deleteBtn = document.getElementById("delete");

let vehicleId = "";

export const loadModalDeleteBtn = () => {

    // Open Modal
    modalShowDeleteBtns.forEach(btn => {
        btn.addEventListener("click", (e) => {
            modalBg.classList.add("flex");
            modalBg.classList.remove("hidden");

            vehicleId = e.currentTarget.id;
        });
    });

    // Close modal
    modalCloseBtn.addEventListener("click", menuClose);
    modalCancelBtn.addEventListener("click", menuClose);

    deleteBtn.addEventListener("click", deleteVehicle);
}

const menuClose = () => {
    modalBg.classList.add("hidden");
    modalBg.classList.remove("flex");
}

const deleteVehicle = async () => {
    console.log("Eliminando", vehicleId);
    const resp = await fetch(`${PAGE_URL}/productos/eliminar/${vehicleId}`);

    // Resp leer respuesta de /products/eliminar/${id}

    const result = await resp.text();
    console.log(result);
}