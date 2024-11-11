import { PAGE_URL, TAX } from "./constants.js";
import { priceFormatted } from "./helpers.js";

const compraForm = document.getElementById("compraForm")

const btnBuy = document.getElementsByName("compra")[0];
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

const fechaIncio = document.getElementById('fechaInicio');
const fechaFin = document.getElementById('fechaFin');
const parentFromParent = fechaIncio?.parentElement?.parentElement; // Para mostrar error y que se vea bien en el Fecha inciio - Fecha fin


const calculateDifferenceDays = (startDateFormatted, endDateFormatted) => {
    if (!startDateFormatted || !endDateFormatted) return 0;

    const startDate = new Date(startDateFormatted);
    const endDate = new Date(endDateFormatted);
    const today = new Date();
    
    // if (startDate.valueOf() < today.valueOf() || endDate.valueOf() < today.valueOf()) {
    //     showErrorDate(parentFromParent, "Las fechas seleccionadas no pueden ser anteriores a la fecha actual.");
    //     return 0;
    // }

    // if (endDate.valueOf() < startDate.valueOf()) {
    //     showErrorDate(parentFromParent, "La fecha de finalización no puede ser anterior a la fecha de inicio.");
    //     return 0;
    // }

    const diffMilliseconds = endDate - startDate;
    const diffDays = diffMilliseconds / (1000 * 60 * 60 * 24);
    return diffDays;
}
export const loadBuy = () => {
    btnBuy?.addEventListener("click", loadVehicle);
    btnRent?.addEventListener("click", loadVehicle);
    compraForm?.addEventListener("submit", validateInput);

    fechaIncio?.addEventListener("change", (e) => {
        const vehicle = JSON.parse(localStorage.getItem("vehicle"));

        const value = e.target.value;
        const difference = calculateDifferenceDays(value ,fechaFin.value );
        if(difference > 0) {
            loadPrices("alquiler", +vehicle.precio, difference);
            return
        }
        showErrorDate(parentFromParent, "Porfavor verifica las fechas")
    });
    fechaFin?.addEventListener("change", (e) => {
        const vehicle = JSON.parse(localStorage.getItem("vehicle"));

        const value = e.target.value;
        const difference = calculateDifferenceDays(fechaIncio.value ,value);
        if(difference > 0) {
            loadPrices("alquiler", +vehicle.precio, difference);
            return
        }
        showErrorDate(parentFromParent, "Porfavor verifica las fechas")
    });
}

const showErrorDate = (container, message) => {
    document.querySelectorAll(".error-message").forEach(el => el.remove());

    container.insertAdjacentHTML('beforeend', `<div class="error-message col-span-2 text-red-600 flex gap-2 items-center text-xs"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
  <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" />
</svg>
<p>${message}</p></div>`);
}

const loadVehicle = async (e) => {
    const id = e.target.id;
    const tipo = e.target.name;

    const { vehicle } = await fetch(`${PAGE_URL}/productos/${id}`).then(res => res.json());

    const vehicleData = vehicle[0];

    console.log(vehicleData);
    if(vehicle[0]) {
        const { precio } = vehicleData;

        localStorage.setItem("vehicle", JSON.stringify({...vehicleData, tipo}));
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

const loadPrices = (type, precio, dias) => {
    const { subtotal, tax, total } = type === "compra" ? saveBuyData(+precio) : saveRentData(+precio, +dias);

    priceElement.textContent = priceFormatted(precio); 
    subtotalElement.textContent = priceFormatted(subtotal); 
    taxElement.textContent = priceFormatted(tax);
    totalElement.textContent = priceFormatted(total);

    return { subtotal, tax, total };
}

const saveRentData = (precio, dias) => {
    console.log(precio)
    console.log(dias)

    const data = {};
    const subtotal = (precio / 2000 + 25) * dias; 

    data.tipo = "alquiler";
    data.subtotal = subtotal;
    const tax = subtotal * TAX;
    data.tax = tax;
    data.total = (subtotal + tax).toFixed(2); 
    data.dias = dias;
    console.log(data);
    return data;
};
export const loadCheckout = () => {
    const vehicle = localStorage.getItem('vehicle') ? JSON.parse(localStorage.getItem('vehicle')) : null;
    if(vehicle) {
        loadVehicleInfo(vehicle);
    } else {
        // window.location.href = "/catalogo";
    }
    
}
const loadVehicleInfo = (vehicle) => {
    const { imagenes, marca, modelo, año, kilometraje, tipo, precio } = vehicle;

    // Verificamos si todos los elementos existen antes de continuar
    if (imgElement && titleElement && yearElement && kmElement && typeElement && priceElement && subtotalElement && taxElement && totalElement && confirmBtn) {
        imgElement.src = `../../img/uploads/${imagenes.split(",")[0]}`;  
        titleElement.textContent = `${marca} ${modelo}`;  
        yearElement.textContent = año;
        kmElement.textContent = `${kilometraje} km`;
        typeElement.textContent = tipo;
        
        // Añadimos clases de acuerdo al tipo (compra o alquiler)
        if (tipo === "compra") {
            const containerFechaInicio = fechaIncio?.parentNode;
            const containerFechaFin = fechaFin?.parentNode;
            containerFechaInicio.classList.add("hidden");
            containerFechaFin.classList.add("hidden")
            typeElement.classList.add("bg-green-50", "text-green-600");
            loadPrices(tipo, precio, calculateDifferenceDays());

        } else {
            const date = new Date()
            const dateFormattedToday = `${date.getFullYear()}-${date.getMonth()+1}-${date.getDate() < 10 ? `0${date.getDate()}` : date.getDate()}`;
            const dateFormattedNextDay = `${date.getFullYear()}-${date.getMonth()+1}-${date.getDate()+1 < 10 ? `0${date.getDate()+1}` : date.getDate()+1}`;
            fechaIncio.value = dateFormattedToday;
            fechaFin.value = dateFormattedNextDay;

            loadPrices(tipo, precio, calculateDifferenceDays(dateFormattedToday, dateFormattedNextDay));
            typeElement.classList.add("bg-blue-50", "text-blue-600");
        }

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
        error.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
  <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" />
</svg>
 <p>${message}</p>`
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

    const user = JSON.parse(decodeURIComponent(document.cookie).split("=")[1]);
    if (isValid) {
        // Obtener datos de localstorage
        const vehicle = JSON.parse(localStorage.getItem("vehicle"));
        const { subtotal, tax, total } = loadPrices(vehicle.tipo, vehicle.precio, calculateDifferenceDays(fechaIncio?.value, fechaFin?.value));
        const datosCompra = {
            idCliente: user?.id,
            direccion: inputs.direccion.value,
            codigo: inputs.codigo.value,
            pais: inputs.pais.value,
            telefono: inputs.telefono.value,
            ciudad: inputs.ciudad.value,
            nombre: inputs.nombre.value,
            apellido: inputs.apellido.value,
            email: inputs.email.value,
            tipo: vehicle.tipo, 
            idVehiculo: vehicle.id,
            subtotal: subtotal,
            tax: tax,
            total: total,
            fechaCompra: new Date().toISOString().split('T')[0],
            fechaInicio: fechaIncio?.value,
            fechaFin: fechaFin?.value,
        };
        realizarCompra(datosCompra);
    }
}


const realizarCompra = async (datosCompra) => {
    const resp = await fetch(`${PAGE_URL}/comprar/crear`, {
        method: "POST",
        body: JSON.stringify(datosCompra)
    }).then(res => res.json());

    console.log(resp);

    if (resp.error) {
        Swal.fire({
            title: 'Error!',
            text: resp.message || 'Ha ocurrido un error',
            icon: 'error',
            confirmButtonText: 'Ok'
        });
    } else {
        Swal.fire({
            title: 'Éxito!',
            text: `${datosCompra.tipo === "compra" ? "La compra se realizo correctamente" : "El alquier se realizo correctamente"}`,
            icon: 'success',
            confirmButtonText: 'Ok',
        }).then(() => {
            localStorage.setItem("idVehicle", datosCompra.idVehiculo);
            localStorage.setItem("idClient", datosCompra.idCliente);
            localStorage.setItem("compra", JSON.stringify({
                type: resp.tipo,
                isPurchase: true,
                idCompra: resp.id
            }));
            window.location.href = "/compra-confirmada";
        });
    }
}

