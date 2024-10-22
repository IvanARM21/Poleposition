// Brand
import { brands, vehicles, showVehicles, year_min, price_max, price_min, year_max, km_min, km_max, states, colors } from "./catalogo.js"


export const filter = () => {
    let vehiclesFiltered = [];

    vehiclesFiltered = filterByBrand(vehicles);
    vehiclesFiltered = filterByYear(vehiclesFiltered);
    vehiclesFiltered = filterByPrice(vehiclesFiltered);
    vehiclesFiltered = filterByColor(vehiclesFiltered);
    vehiclesFiltered = filterByKm(vehiclesFiltered);
    vehiclesFiltered = filterByState(vehiclesFiltered);

    showVehicles(vehiclesFiltered, `No hay vehiculos disponibles con esos filtros`);
}

const filterByBrand = (vehicles) => {
    let vehiclesFiltered = [];
    const brandsSelected = brands.map(brand => {
        if(brand.checked) {
            return brand;
        }
        return null
    }).filter(brand => brand !== null);

    if(brandsSelected.length) {
        const brandName = brandsSelected.map(brand => brand.value.toUpperCase());
    
        vehiclesFiltered = vehicles.filter(vehicle => brandName.includes(vehicle.marca.toUpperCase()));
    } else {
        vehiclesFiltered = vehicles;
    }

    return vehiclesFiltered;
}

const filterByColor = (vehicles) => {
    let vehiclesFiltered = [];
    const colorSelected = colors.map(color => {
        if(color.checked) {
            return color;
        }
        return null
    }).filter(color => color !== null);

    if(colorSelected.length) {
        const color = colorSelected.map(color => color.value.toUpperCase());
    
        vehiclesFiltered = vehicles.filter(vehicle => color.includes(vehicle.color.toUpperCase()));
    } else {
        vehiclesFiltered = vehicles;
    }

    return vehiclesFiltered;
}

const filterByYear = (vehicles) => {
    const year_min_value = year_min.value ? parseInt(year_min.value) : null;
    const year_max_value = year_max.value ? parseInt(year_max.value) : null;

    if (year_min_value !== null && year_max_value !== null) {
        return vehicles.filter(vehicle => {
            const vehicleYear = parseInt(vehicle.año); 
            return vehicleYear >= year_min_value && vehicleYear <= year_max_value; 
        });
    }

    return vehicles; 
}

const filterByPrice = (vehicles) => {
    const price_min_value = price_min.value ? parseInt(price_min.value) : null;
    const price_max_value = price_max.value ? parseInt(price_max.value) : null;

    if(price_min_value !== null && price_max_value !== null) {
        return vehicles.filter(vehicle => {
            const vehiclePrice = parseInt(vehicle.precio);
            return vehiclePrice >= price_min_value && vehiclePrice <= price_max_value;
        });
    }

    return vehicles;
}

const filterByKm = (vehicles) => {
    const km_min_value = km_min.value ? parseInt(km_min.value) : null;
    const km_max_value = km_max.value ? parseInt(km_max.value) : null;

    if(km_min_value !== null && km_max_value !== null) {
        return vehicles.filter(vehicle => {
            const vehicleKm = parseInt(vehicle.kilometraje);
            return vehicleKm >= km_min_value && vehicleKm <= km_max_value;
        });
    }

    return vehicles;
}

const filterByState = (vehicles) => {

    const stateChecked = states.find(state => state.checked) ?? null;

    if(stateChecked) {
        if(stateChecked.value === "nuevo") {
            return vehicles.filter(vehicle => {
                const vehicleKm = parseInt(vehicle.kilometraje);
                return vehicleKm === 0;
            });
        }
        if(stateChecked.value === "usado") {
            return vehicles.filter(vehicle => {
                const vehicleKm = parseInt(vehicle.kilometraje);
                return vehicleKm > 0;
            });
        }
    }
    return vehicles;
}

