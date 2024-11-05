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
        3
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
    
        const pass = {
            pass: document.getElementById('actual-pass').value, // contraseña actual
            contraseña: document.getElementById('new-pass').value, // nueva contraseña
            repetirContraseña: document.getElementById('repeat-pass').value // repetir nueva contraseña
        };
    
        const user = decodeURIComponent(document?.cookie) ? JSON.parse(decodeURIComponent(document?.cookie)?.split("=")[1]) : null;

        if (user) {
            try {
                const res = await fetch(`${PAGE_URL}/cuentas/editar/${user.id}`, {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify(pass) 
                });
    
                const text = await res.text(); // Obtener la respuesta como texto
    
                // Intentar analizar el texto como JSON
                const json = JSON.parse(text);
    
                if (!json.ok && alertCambiarPass) { 
                    showAlert(alertCambiarPass, true, json.message);
                } else {
                    showAlert(alertCambiarPass, false, json.message);
                    setTimeout(() => {
                        modalCambiar.classList.add('hidden'); // cierra el modal
                        window.location.href = "/logout";
                    }, 2000);
                }
            } catch (error) {
                console.error("Error al manejar la respuesta:", error);
                // Manejar el caso en que la respuesta no es un JSON válido
                console.log("Respuesta del servidor:", text); // Imprimir la respuesta completa para depuración
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
