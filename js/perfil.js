export function loadPerfilButtons() {
    const perfilBtn = document?.getElementById('perfilBtn');
    const seguridadBtn = document?.getElementById('seguridadBtn');
    const historialBtn = document?.getElementById('historialBtn'); 

    const perfilForm = document?.getElementById('perfilForm');
    const seguridadForm = document?.getElementById('seguridadForm');
    const historialForm = document?.getElementById('historialForm'); 

    const cambiarContraseñaBtn = document?.getElementById('cambiar-contraseña');

    if(perfilBtn && seguridadBtn && historialBtn) {
        perfilBtn.addEventListener('click', function() {
            perfilForm.classList.remove('hidden');
            seguridadForm.classList.add('hidden');
            historialForm.classList.add('hidden');
        });
        seguridadBtn.addEventListener('click', function() {
            perfilForm.classList.add('hidden');
            seguridadForm.classList.remove('hidden');
            historialForm.classList.add('hidden'); 
        });
        historialBtn.addEventListener('click', function() {
            perfilForm.classList.add('hidden');
            seguridadForm.classList.add('hidden');
            historialForm.classList.remove('hidden'); 
        });
    }

    if(cambiarContraseñaBtn) {
        cambiarContraseñaBtn.addEventListener('click', () => {
            console.log("Cambiar Contraseña btn");
        });
    }
}
