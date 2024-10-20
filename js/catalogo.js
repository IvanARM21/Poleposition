import { PAGE_URL } from "./constants.js";
import { filter } from "./filtros.js";

export let vehicles = [];


const catalogo = document.getElementById("vehiculos") ?? null;
const div = document.getElementById("empty") ?? null;


export const loadVehicles = async () => {

    const currentPath = window.location.href;
    if(currentPath.includes("/catalogo")) {
        vehicles = await fetch(`${PAGE_URL}/productos`).then(res => res.json())?? [];

        showVehicles(vehicles);
    }
}

export const showVehicles = (vehicles, message = "Por el momento no tenemos vehiculos disponibles") => {
    clear(catalogo);
    if(vehicles.length) {
        catalogo.classList.remove("hidden");
        vehicles.forEach(vehicle => {
            const vehicleElement = createVehicle(vehicle);
            catalogo.appendChild(vehicleElement);
        });
        return
    } 
    vehiclesEmpty(message);
}



export const createVehicle = (vehicle) => {
    const imagenes = vehicle.imagenes.split(',');
    const imagenPrincipal = `../../img/uploads/${imagenes[0]}`;
    const imagenSecundaria = imagenes[1] ? `../../img/uploads/${imagenes[1]}` : imagenPrincipal;

    if(div) {
        div.classList.add("hidden");
        div.classList.remove("block");
    }

    // Crear el elemento <li>
    const li = document.createElement('li');
    li.className = "flex flex-col gap-2 rounded-xl";

    // Crear el elemento <a>
    const a = document.createElement('a');
    a.className = "rounded-lg overflow-hidden w-full";
    a.href = `/producto/${vehicle.id}`;

    // Crear la imagen
    const img = document.createElement('img');
    img.src = imagenPrincipal;
    img.alt = `Imagen de ${vehicle.marca} ${vehicle.modelo}`;
    img.className = "w-full aspect-video object-cover transition-all duration-300 hover:scale-105 cursor-pointer";
    img.onmouseover = () => { img.src = imagenSecundaria; };
    img.onmouseout = () => { img.src = imagenPrincipal; };

    // Añadir la imagen al enlace
    a.appendChild(img);
    li.appendChild(a);

    // Crear el contenedor para el texto
    const divText = document.createElement('div');
    divText.className = "px-1";

    // Crear el título
    const h2 = document.createElement('h2');
    h2.className = "sm:text-xl font-semibold text-gray-800 hover:text-red-600 transition-colors duration-300 cursor-pointer";
    h2.textContent = `${vehicle.marca} ${vehicle.modelo}`;
    divText.appendChild(h2);

    // Crear la fila de precio y detalles
    const divDetails = document.createElement('div');
    divDetails.className = "flex flex-col sm:flex-row justify-between sm:items-center";

    // Crear el párrafo para el precio
    const pPrecio = document.createElement('p');
    pPrecio.className = "text-gray-500 text-sm sm:text-lg font-medium";
    pPrecio.textContent = `$${vehicle.precio.toLocaleString()} USD`;
    divDetails.appendChild(pPrecio);

    // Crear la sección de año y kilometraje
    const divInfo = document.createElement('div');
    divInfo.className = "flex gap-2";

    const pAnio = document.createElement('p');
    pAnio.className = "text-gray-500 text-sm lg:text-base font-medium italic";
    pAnio.textContent = `${vehicle.año}`;
    divInfo.appendChild(pAnio);

    const spanGuion = document.createElement('span');
    spanGuion.className = "text-gray-500";
    spanGuion.textContent = "-";
    divInfo.appendChild(spanGuion);

    const pKilometraje = document.createElement('p');
    pKilometraje.className = "text-gray-500 text-sm lg:text-base font-medium italic";
    pKilometraje.textContent = `${vehicle.kilometraje.toLocaleString()} KM`;
    divInfo.appendChild(pKilometraje);

    divDetails.appendChild(divInfo);
    divText.appendChild(divDetails);
    li.appendChild(divText);

    return li;
}

const vehiclesEmpty = (message) => {
    const paragraph = document.createElement("P");
    paragraph.textContent = message;
    paragraph.classList.add("text-gray-500", "text-xl", "font-normal", "xl:ml-5", "lg:text-left", "text-center");

    catalogo.classList.add("hidden");

    const div = document.getElementById("empty");

    clear(div);



    if(div) {
        div.classList.add("block");
        div.classList.remove("hidden");
        div.appendChild(paragraph);
    }
}



// Filtros
export const brands = Array.from(document.getElementsByName("brands[]"));

// Year
export const year_min = document.getElementById("year_min");
export const year_max = document.getElementById("year_max");

// Price
export const price_min = document.getElementById("price_min");
export const price_max = document.getElementById("price_max");

// Km
export const km_min = document.getElementById("km_min");
export const km_max = document.getElementById("km_max");

// State
export const states = Array.from(document.getElementsByName("state"));

document?.getElementById("resetFilters")?.addEventListener("click", () => {
    const form = document.getElementById("formFilters")
    form.reset();
    showVehicles(vehicles);
});


// Filters by Brands
year_min.addEventListener("change", filter);
year_max.addEventListener("change", filter);

price_min.addEventListener("change", filter);
price_max.addEventListener("change", filter);

km_min.addEventListener("change", filter);
km_max.addEventListener("change", filter);

brands.forEach(brand => brand.addEventListener("click", filter));

states.forEach(state => state.addEventListener("change", filter));


export const clear = (parent) => {
    while(parent.children.length > 0) {
        parent.removeChild(parent.firstChild);
    }
}


// Filter button
const bgFilter = document.getElementById("bgFilter") ?? null;
const closeFilter = document.getElementById("closeFilter") ?? null;

const filtersContainer = document.getElementById("filtersContainer");
document?.getElementById("filterButton")?.addEventListener("click", () => {
    const viewportWidth = window.innerWidth;
    if(viewportWidth >= 1024) {
        if(filtersContainer.classList.contains("lg:max-w-80")) {
            filtersContainer.classList.remove("lg:max-w-80", "opacity-100", "lg:mr-5");
            filtersContainer.classList.add("lg:max-w-0", "opacity-0");
        } else {
            filtersContainer.classList.add("lg:max-w-80", "opacity-100", "lg:mr-5");
            filtersContainer.classList.remove("lg:max-w-0", "opacity-0");
        }
    } else{ 
        bgFilter?.classList?.remove("hidden");
        bgFilter?.classList?.add("block");
        filtersContainer.classList.remove("-translate-x-full");
        filtersContainer.classList.add("translate-x-0");
        closeFilter?.classList?.remove("hidden");
        closeFilter?.classList?.add("block");
    }
});

const closeFilters = () => {
    bgFilter?.classList?.add("hidden");
    bgFilter?.classList?.remove("block");
    filtersContainer.classList.add("-translate-x-full");
    filtersContainer.classList.remove("translate-x-0");
    closeFilter?.classList?.add("hidden");
    closeFilter?.classList?.remove("block");
}

bgFilter.addEventListener("click", closeFilters);
closeFilter.addEventListener("click", closeFilters);

