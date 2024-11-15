export function loadPerfilButtons() {
    const perfilBtn = document?.getElementById('perfilBtn');
    const seguridadBtn = document?.getElementById('seguridadBtn');
    const historialBtn = document?.getElementById('historialBtn');
    const testimonialBtn = document?.getElementById('testimonialBtn'); 

    const perfilForm = document?.getElementById('perfilForm');
    const seguridadForm = document?.getElementById('seguridadForm');
    const historialForm = document?.getElementById('historialForm'); 
    const testiomoniales = document.getElementById('');

    const cambiarContraseñaBtn = document?.getElementById('cambiar-contraseña');

    if(perfilBtn && seguridadBtn && historialBtn && testimonialBtn) {
        perfilBtn.addEventListener('click', function() {
            perfilForm.classList.remove('hidden');
            seguridadForm.classList.add('hidden');
            historialForm.classList.add('hidden');
            testiomoniales.classList.add('hidden');
        });
        seguridadBtn.addEventListener('click', function() {
            perfilForm.classList.add('hidden');
            seguridadForm.classList.remove('hidden');
            historialForm.classList.add('hidden'); 
            testiomoniales.classList.add('hidden');
        });
        historialBtn.addEventListener('click', function() {
            perfilForm.classList.add('hidden');
            seguridadForm.classList.add('hidden');
            historialForm.classList.remove('hidden'); 
            testiomoniales.classList.add('hidden');
        });
        testimonialBtn.addEventListener('click', function() {
            perfilForm.classList.add('hidden');
            seguridadForm.classList.add('hidden');
            historialForm.classList.add('hidden'); 
            testiomoniales.classList.remove('hidden');
        });
    }

    if(cambiarContraseñaBtn) {
        cambiarContraseñaBtn.addEventListener('click', () => {
            console.log("Cambiar Contraseña btn");
        });
    }
}
