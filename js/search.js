import { showVehicles, vehicles } from "./catalogo.js";

const inputSearch = document.getElementById("buscarInput");

const searchBtn = document.getElementById("search");

export const loadInput = () => {
    inputSearch?.addEventListener("input", e => {
        const value = e.currentTarget.value;

        if(value.length >= 3) {
            const vehiclesFound = vehicles.filter(vehicle => {
                const normalizedMarca = normalizeString(vehicle.marca);
                const normalizedColor = normalizeString(vehicle.color);
                const normalizedModelo = normalizeString(vehicle.modelo);
                const normalizedValue = normalizeString(value);
            
                if (normalizedMarca.includes(normalizedValue)) {
                    return vehicle;
                }
            
                if (normalizedColor.includes(normalizedValue)) {
                    return vehicle;
                }
            
                if (normalizedModelo.includes(normalizedValue)) {
                    return vehicle;
                }
            
                const title = normalizeString((vehicle.marca + vehicle.modelo).split(" ").join(""));
                if (title.includes(normalizedValue)) {
                    return vehicle;
                }
            });
            showVehicles(vehiclesFound, "No hemos encontrado vehiculos con esos términos");
        } else {
            showVehicles(vehicles);
        }
    });

    searchBtn?.addEventListener("click", () => {
        if(inputSearch.classList.contains("w-0")) {
            inputSearch.classList.remove("w-0", "px-0");
            inputSearch.classList.add("w-80", "px-6");
        } else {
            inputSearch.classList.remove("w-80", "px-6");
            inputSearch.classList.add("w-0", "px-0");
        }
    });
}

const normalizeString = (str) => 
    str
        .toLowerCase()
        .normalize("NFD")
        .replace(/[\u0300-\u036f]/g, "")
        .replace(/[^a-z0-9]/g, ""); 
