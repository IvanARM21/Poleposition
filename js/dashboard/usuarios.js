import { PAGE_URL } from "../constants.js";

const selectInputs = Array.from(document.getElementsByName("selectRol"));

export const loadUser = () => {
    selectInputs?.map(selectInput => {
        selectInput.addEventListener("change", async e => {
            const res = await fetch(`${PAGE_URL}/dashboard/usuarios/editar/${e.currentTarget.id}`).then(res => res.text());
            console.log(res);
        });
    });
}