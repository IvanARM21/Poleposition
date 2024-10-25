import { PAGE_URL } from "./constants.js";

const btnCambiarPass = document.getElementById('cambiar-contraseña');
const modalCambiar = document.getElementById('modal-cambiar');
const cancelarCambiar = document.getElementById('cancelar-pass');

const formDeleteAccount = document.getElementById("formDeleteAccount");

const btnEliminarCuenta = document.getElementById('eliminar-cuenta');
const modalEliminar = document.getElementById('modal-eliminar');
const cancelarEliminar = document.getElementById('cancelar-eliminar');



export const loadPerfilEvents = () => {
    formDeleteAccount?.addEventListener("submit", async () => {
        const user = JSON.parse(decodeURIComponent(document.cookie).split("=")[1]);

        if (user) {
            const res = await fetch(`${PAGE_URL}/cuentas/eliminar/${user.id}`).then(res => res.text());
            console.log(res);
        } else {
            console.error('No se pudo obtener la información del usuario desde la cookie.');
        }
    });
    
    btnCambiarPass?.addEventListener('click', () => {
        modalCambiar?.classList.remove('hidden');
    });
    
    cancelarCambiar?.addEventListener('click', () => {
        modalCambiar?.classList.add('hidden');
    });
    
    btnEliminarCuenta?.addEventListener('click', () => {
        modalEliminar?.classList.remove('hidden');
    });
    
    cancelarEliminar?.addEventListener('click', () => {
        modalEliminar?.classList.add('hidden');
    });
};
