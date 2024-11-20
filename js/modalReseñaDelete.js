import { PAGE_URL } from './constants.js';

const modalShowDeleteBtns = document.getElementsByName("testimonialBtn") ?? null;
const modalCloseBtn = document.getElementById("btnCloseDelete") ?? null;
const modalCancelBtn = document.getElementById("btnCancelDelete") ?? null; 
const modalReview = document.getElementById("modalReseñaDelete") ?? null; 

const deleteBtn = document.getElementsByName("deleteReviewBtn"); 

const reseñaDelete = document.getElementById("reseñaDelete") ?? null;

let reviewId = ""; 

export const loadModalDeleteReseñaBtn = () => {
    modalShowDeleteBtns.forEach(btn => {
        btn.addEventListener("click", () => {
        });
    });
    deleteBtn.forEach(btn => {
        btn?.addEventListener("click", (e) => { 
            modalReview.classList.add("flex");
            modalReview.classList.remove("hidden");
            reviewId = e.currentTarget.id;
        });
    })
    reseñaDelete?.addEventListener("click", deleteReview);
    modalCloseBtn?.addEventListener("click", menuClose);
    modalCancelBtn?.addEventListener("click", menuClose);
}

const menuClose = () => {
    modalReview.classList.add("hidden");
    modalReview.classList.remove("flex");
}

const deleteReview = async () => {

    const resp = await fetch(`${PAGE_URL}/review/eliminar/${reviewId}`).then(resp => resp);

    menuClose();

    if (resp.ok) {
        Swal.fire({
            title: '¡Éxito!',
            text: 'La reseña fue eliminada',
            icon: 'success',
            confirmButtonText: 'Ok',
        }).then(() => {
            location.reload();
        });
    } else {
        Swal.fire({
            title: 'Error',
            text: resp.message || 'Ha ocurrido un error',
            icon: 'error',
            confirmButtonText: 'Ok'
        });
    }
};
