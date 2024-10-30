import { PAGE_URL } from "./constants.js";
import { showAlert } from "./helpers.js";

const formCambiarPass = document.getElementById('formCambiarPass');
const btnCambiarPass = document.getElementById('cambiar-contraseña');
const modalCambiar = document.getElementById('modal-cambiar');
const cancelarCambiar = document.getElementById('cancelar-pass');

const formDeleteAccount = document.getElementById("formDeleteAccount");
const userPass = document.getElementById("delete-pass");

const btnEliminarCuenta = document.getElementById('eliminar-cuenta');
const modalEliminar = document.getElementById('modal-eliminar');
const cancelarEliminar = document.getElementById('cancelar-eliminar');

const alertDelete = document.getElementById("alert");
const alertCambiarPass = document.getElementById("alertCambiarPass");

export const loadPerfilEvents = () => {
    formDeleteAccount?.addEventListener("submit", async (e) => {
        e.preventDefault();

        const pass = { pass: userPass?.value };

        const user = JSON.parse(decodeURIComponent(document.cookie).split("=")[1]);

        if (user) {
            const res = await fetch(`${PAGE_URL}/cuentas/eliminar/${user.id}`, {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(pass)
            }).then(res => res.json());

            if (!res.ok && alertDelete) {
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
    
    formCambiarPass?.addEventListener("submit", async (e) => {
        e.preventDefault();
    
        // Obtener los valores del formulario
        const pass = document.getElementById('actual-pass').value; // Asegúrate de tener este input en el formulario
        const contraseña = document.getElementById('new-pass').value; // Input para la nueva contraseña
        const repetirContraseña = document.getElementById('repeat-pass').value; // Input para repetir la nueva contraseña
    
        const user = JSON.parse(decodeURIComponent(document.cookie).split("=")[1]);
    
        if (user) {
            const res = await fetch(`${PAGE_URL}/cuentas/editar/${user.id}`, {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ 
                    pass: pass, 
                    contraseña: contraseña, 
                    repetirContraseña: repetirContraseña 
                })
            }).then(res => res.json());
    
            if (!res.ok && alertCambiarPass) { // Cambia a alertCambiarPass
                showAlert(alertCambiarPass, true, res.message);
            } else {
                showAlert(alertCambiarPass, false, res.message);
                setTimeout(() => {
                    modalCambiar.classList.add('hidden'); // Cierra el modal después del cambio exitoso
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
