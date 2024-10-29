import { PAGE_URL } from "./constants.js";
import { showAlert } from "./helpers.js";

const btnCambiarPass = document.getElementById('cambiar-contraseña');
const modalCambiar = document.getElementById('modal-cambiar');
const cancelarCambiar = document.getElementById('cancelar-pass');

const formDeleteAccount = document.getElementById("formDeleteAccount");
const userPass = document.getElementById("delete-pass");

const btnEliminarCuenta = document.getElementById('eliminar-cuenta');
const modalEliminar = document.getElementById('modal-eliminar');
const cancelarEliminar = document.getElementById('cancelar-eliminar');

const alertDelete = document.getElementById("alert");

export const loadPerfilEvents = () => {
    formDeleteAccount?.addEventListener("submit", async (e) => {
        e.preventDefault();

        const pass = { pass: userPass?.value };

        const user = JSON.parse(decodeURIComponent(document.cookie).split("=")[1]);

        if (user) {
            const res = await fetch(`${PAGE_URL}/cuentas/eliminar/${user.id}`, {
                method: "POST",
                body: JSON.stringify(pass)
            }).then(res => res.json());

            if(!res.ok && alertDelete) {
                showAlert(alertDelete, true, res.message);
            } else {
                showAlert(alertDelete, false, res.message);

                setTimeout(() => {
                    window.location.href = "/logout";
                }, 2000);
            }
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
