import { vehicles } from "./catalogo.js";

const inputSearch = document.getElementById("search");

export const loadInput = () => {
    inputSearch?.addEventListener("input", e => {
        const value = e.currentTarget.value;

        if(value.length >= 3) {
            vehicles.includes(value)
        }
    })
}