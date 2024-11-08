import { PAGE_URL } from '../constants.js';

const modalShowDeleteBtns = document.getElementsByName("deleteBtn") ?? null;
const modalCloseBtn = document.getElementById("btnCloseDelete") ?? null;
const modalCancelBtn = document.getElementById("btnCancelDelete") ?? null;
const modalUser = document.getElementById("modalUserDelete") ?? null;

const deleteBtn = document.getElementById("delete");

let vehicleId = "";

export const loadModalDeleteUserBtn = () => {

    // Open Modal
    modalShowDeleteBtns.forEach(btn => {
        btn.addEventListener("click", (e) => {
            modalUser.classList.add("flex");
            modalUser.classList.remove("hidden");

            vehicleId = e.currentTarget.id;
        });
    });


    deleteBtn?.addEventListener("click", deleteVehicle);
    modalCloseBtn?.addEventListener("click", menuClose);
    modalCancelBtn?.addEventListener("click", menuClose);
}

const menuClose = () => {
    modalUser.classList.add("hidden");
    modalUser.classList.remove("flex");
}

const deleteVehicle = async () => {
    const resp = await fetch(`${PAGE_URL}/usuarios/eliminar/${vehicleId}`).then(resp => resp.json());

    menuClose();

    if (resp.ok) {
        Swal.fire({
            title: 'Éxito!',
            text: 'La cuenta fue eliminada',
            icon: 'success',
            confirmButtonText: 'Ok',
            
        }).then(() => {
            location.reload(); 
        });
    } else {
        Swal.fire({
            title: 'Error!',
            text: resp.message || 'Ha ocurrido un error',
            icon: 'error',
            confirmButtonText: 'Ok'
        });
    }
};

