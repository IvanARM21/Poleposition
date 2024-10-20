const btnCambiarPass = document.getElementById('cambiar-contraseña');
const modalCambiar = document.getElementById('modal-cambiar');
const cancelarCambiar = document.getElementById('cancelar-pass');

btnCambiarPass?.addEventListener('click', () => {
    modalCambiar?.classList.remove('hidden');
});

cancelarCambiar?.addEventListener('click', () => {
    modalCambiar?.classList.add('hidden');
});

const btnEliminarCuenta = document.getElementById('eliminar-cuenta');
const modalEliminar = document.getElementById('modal-eliminar');
const cancelarEliminar = document.getElementById('cancelar-eliminar');

btnEliminarCuenta?.addEventListener('click', () => {
    modalEliminar?.classList.remove('hidden');
});

cancelarEliminar?.addEventListener('click', () => {
    modalEliminar?.classList.add('hidden');
});
