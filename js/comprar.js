import { PAGE_URL, TAX } from "./constants.js";
import { priceFormatted } from "./helpers.js";

const compraForm = document.getElementById("compraForm")

const btnBuy = document.getElementsByName("comprar")[0];
const btnRent = document.getElementsByName("alquilar")[0];

const confirmBtn = document.getElementById("confirmBtn");

const imgElement = document.getElementById('imagen');
const titleElement = document.getElementById('titulo');
const yearElement = document.getElementById('año');
const kmElement = document.getElementById('km');
const typeElement = document.getElementById('tipo');
const priceElement = document.getElementById('precio');
const subtotalElement = document.getElementById('subtotal');
const taxElement = document.getElementById('tax');
const totalElement = document.getElementById('total');

export const loadBuy = () => {
    btnBuy?.addEventListener("click", loadVehicle);
    btnRent?.addEventListener("click", loadVehicle);
    compraForm.addEventListener("submit", validateInput);
}

const loadVehicle = async (e) => {
    const id = e.target.id;

    const { vehicle } = await fetch(`${PAGE_URL}/productos/${id}`).then(res => res.json());

    const vehicleData = vehicle[0];

    if(vehicle[0]) {
        const { precio } = vehicleData;

        const calcData = e.target.name === "comprar" ? saveBuyData(+precio) : saveRentData(+precio);

        localStorage.setItem("vehicle", JSON.stringify({...vehicleData, ...calcData}));
        window.location.href = "/comprar";
    }
}

const saveBuyData = (precio) => {
    const data = {};
    const subtotal = precio;
    data.subtotal = subtotal;
    data.tipo = "compra";
    const tax = precio * TAX;
    data.tax = tax
    data.total = (precio + tax).toFixed(2);
    return data;
}

const saveRentData = (precio) => {
    const data = {};
    const subtotal = (precio / 2000) + 25;

    data.tipo = "alquiler";
    data.subtotal = subtotal;
    const tax = subtotal * TAX;
    data.tax = tax
    data.total = (subtotal + tax).toFixed(2);
    return data;
}

export const loadCheckout = () => {
    const vehicle = JSON.parse(localStorage.getItem('vehicle'));
    if(vehicle) {
        loadVehicleInfo(vehicle);
    } else {
        // window.location.href = "/catalogo";
    }
    
}
const loadVehicleInfo = (vehicle) => {
    const { imagenes, marca, modelo, año, kilometraje, tipo, precio, subtotal, tax, total } = vehicle;
    
    // Verificamos si todos los elementos existen antes de continuar
    if (imgElement && titleElement && yearElement && kmElement && typeElement && priceElement && subtotalElement && taxElement && totalElement && confirmBtn) {
        imgElement.src = `../../img/uploads/${imagenes.split(",")[0]}`;  
        titleElement.textContent = `${marca} ${modelo}`;  
        yearElement.textContent = año;
        kmElement.textContent = `${kilometraje} km`;
        typeElement.textContent = tipo;
        
        // Añadimos clases de acuerdo al tipo (compra o alquiler)
        if (tipo === "compra") {
            typeElement.classList.add("bg-green-50", "text-green-600");
        } else {
            typeElement.classList.add("bg-blue-50", "text-blue-600");
        }

        priceElement.textContent = priceFormatted(precio); 
        subtotalElement.textContent = priceFormatted(subtotal); 

        taxElement.textContent = priceFormatted(tax);
        totalElement.textContent = priceFormatted(total);

        // Cambiamos el texto del botón de confirmación según el tipo
        confirmBtn.textContent = tipo === "compra" ? "Confirmar compra" : "Confirmar alquiler";
    } 
};


const validateInput = (event) => {
    event.preventDefault(); // Evitar el envío del formulario

    // Limpiamos mensajes de error previos
    document.querySelectorAll(".error-message").forEach(el => el.remove());

    // Función para crear mensajes de error
    function showError(input, message) {
        if (!input || !message) return
        const error = document.createElement("div");
        error.classList.add("error-message", "text-red-600", "text-xs", "flex", "gap-1", "items-center");
        error.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="min-h-4 min-w-4 size-4">
<path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
</svg> <p>${message}</p>`
            ;
        input.classList.add("outline-none", "ring-2", "ring-red-400")
        input.insertAdjacentElement("afterend", error);
    }

    let isValid = true;

    // Campos para realizar la validación
    const inputs = {
        nombre: {
            value: document.getElementById("nombre").value.trim(),
            required: true,
            message: "El nombre es obligatorio."
        },
        apellido: {
            value: document.getElementById("apellido").value.trim(),
            required: true,
            message: "El apellido es obligatorio."
        },
        email: {
            value: document.getElementById("email").value.trim(),
            required: true,
            pattern: /^[^\s@]+@[^\s@]+\.[^\s@]+$/, // Patrón de validación de emails
            message: "Formato de email inválido."
        },
        direccion: {
            value: document.getElementById("direccion").value.trim(),
            required: true,
            message: "La dirección es obligatoria."
        },
        ciudad: {
            value: document.getElementById("ciudad").value.trim(),
            required: true,
            message: "La ciudad es obligatoria."
        },
        codigo: {
            value: document.getElementById("codigo").value.trim(),
            required: true,
            pattern: /^[0-9]{5}$/, // Patrón de valicación para el postal
            message: "El código postal debe tener 5 dígitos."
        },
        pais: {
            value: document.getElementById("pais").value.trim(),
            required: true,
            message: "El país es obligatorio."
        },
        telefono: {
            value: document.getElementById("telefono").value.trim(),
            required: true,
            pattern: /^[0-9]{9}$/,
            message: "El teléfono debe tener 9 dígitos."
        },
        tarjeta: {
            value: document.getElementById("tarjeta").value.trim(),
            required: true,
            pattern: /^[0-9]{16}$/,
            message: "El número de tarjeta debe tener 16 dígitos."
        },
        nombreTarjeta: {
            value: document.getElementById("nombreTarjeta").value.trim(),
            required: true,
            message: "El nombre en la tarjeta es obligatorio."
        },
        caducidad: {
            value: document.getElementById("caducidad").value.trim(),
            required: true,
            pattern: /^(0[1-9]|1[0-2])\/?([0-9]{2})$/, // Formato de gvalidación para la caducidad de la tarjeta
            message: "Formato de caducidad inválido (MM/AA)."
        },
        cvc: {
            value: document.getElementById("cvc").value.trim(),
            required: true,
            pattern: /^[0-9]{3,5}$/, // Validacion para CVC
            message: "El CVC debe tener entre 3 y 5 dígitos."
        }
    };

    // Esté código iterará sobre cada input  para saber si mostrar alerta o no
    for (const [key, { value, required, pattern, message }] of Object.entries(inputs)) {
        const inputEl = document.getElementById(key);

        if (required && !value) {
            showError(inputEl, message);
            isValid = false;
        } else if (pattern && !pattern.test(value)) {
            showError(inputEl, message);
            isValid = false;
        }
    }

    // Validación de fecha de caducidad
    const caducidadInput = document.getElementById("caducidad");
    const [mes, anio] = inputs.caducidad.value.split('/');
    const caducidad = new Date(`20${anio}`, mes, 0); // Último día del mes de caducidad

    if (caducidad < new Date()) {
        showError(caducidadInput, "La fecha de caducidad está vencida.");
        isValid = false;
    }

    if (isValid) {

        // Obtener datos de localstorage

        // Llamar api de php con todos los datos, habrá otra validación desde php



    }
}