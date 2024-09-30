const login = { usuario: "", contraseña: "" };
const isBlur = { usuario: false, contraseña: false };
const messages = {
    usuario: "El nombre del usuario es obligatorio",
    contraseña: "La contraseña del usuario es obligatoria"
}

export const validacionLogin = () => {
    const inputUser = document.getElementById("usuario");
    const inputPass = document.getElementById("contraseña");

    if(inputUser && inputPass) {
        inputUser.addEventListener("input", onInput);
        inputPass.addEventListener("input", onInput);
    
        inputUser.addEventListener("blur", onBlur);
        inputPass.addEventListener("blur", onBlur);
    }

}
const onInput = (e) => {
    login[e.target.id] = e.target.value;
    if(login[e.target.id] === "" && isBlur[e.target.id]) {
        showAlert(messages[e.target.id], "error", e.target)
    }
    console.log(login)

}
const onBlur = (e) => {
    isBlur[e.target.id] = true;
    if(login[e.target.id] === "" && isBlur[e.target.id]) {
        showAlert(messages[e.target.id], "error", e.target)
    }
}
const showAlert = (message, type, input) => {
    const existingAlert = input.nextElementSibling;
    existingAlert && existingAlert.remove();
        
    const alert = document.createElement("P");
    alert.classList.add("alerta", type);
    alert.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="icono">
        <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
        </svg>
        ${message}</span>
    `;

    input.insertAdjacentElement('afterend', alert);
}

