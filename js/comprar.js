import { PAGE_URL } from "./constants.js";


const btnBuy = document.getElementsByName("comprar")[0];


export const loadBuy = () => {
    btnBuy?.addEventListener("click", loadVehicle)
}

const loadVehicle = async (e) => {
    const id = e.target.id;

    const { vehicle } = await fetch(`${PAGE_URL}/productos/${id}`).then(res => res.json());

    if(vehicle[0]) {
        localStorage.setItem("vehicle", JSON.stringify(vehicle));
        window.location.href = "/comprar";
    }
}
