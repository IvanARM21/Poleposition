export function loadPerfilButtons() {
    const perfilBtn = document.getElementById('perfilBtn');
    const seguridadBtn = document.getElementById('seguridadBtn');
    const perfilForm = document.getElementById('perfilForm');
    const seguridadForm = document.getElementById('seguridadForm');

    const cambiarContraseñaBtn = document.getElementById('cambiar-contraseña');

    if(perfilBtn && seguridadBtn) {
        perfilBtn.addEventListener('click', function() {
            perfilForm.classList.remove('hidden');
            seguridadForm.classList.add('hidden');
        });
        seguridadBtn.addEventListener('click', function() {
            perfilForm.classList.add('hidden');
            seguridadForm.classList.remove('hidden');
        });
    }
    
    if(cambiarContraseñaBtn) {
        cambiarContraseñaBtn.addEventListener('click', () => {
            console.log("Cambiar COntraseña btn")
        });
    }
    
}
