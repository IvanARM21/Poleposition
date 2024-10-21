import { PAGE_URL, TAX } from "./constants.js";
import { priceFormatted } from "./helpers.js";



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
        kmElement.textContent = `${kilometraje}km`;
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
