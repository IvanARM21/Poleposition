const modalShowBtn = document.getElementById("menuBtn") ?? null;
const modalCloseBtn = document.getElementById("btnClose") ?? null;
const modalCancelBtn = document.getElementById("btnCancel") ?? null;
const modalBg = document.getElementById("modalBg") ?? null;

const form = document.getElementById("vehiculoForm") ?? null;


console.log(modalShowBtn);

export const LoadModalBtn = () => {
    if(modalShowBtn) {
        modalShowBtn.addEventListener("click", () => {
            modalBg.classList.add("flex");
            modalBg.classList.remove("hidden");
        });
        modalCloseBtn.addEventListener("click", menuClose);
        modalCancelBtn.addEventListener("click", menuClose);        
        form.addEventListener("submit", async function (e) {
            e.preventDefault();
    
            const vehicleData = {
                marca: document.getElementById("marca").value,
                modelo: document.getElementById("modelo").value,
                color: document.getElementById("color").value,
                precio: +document.getElementById("precio").value,
                kilometraje: document.getElementById("kilometraje").value,
                descripcion: document.getElementById("descripcion").value
            };
    
            if(Object.values(vehicleData).includes("")) {
                console.log("Campos Vacios")
                return
            } 

            try {
                const res = await fetch("http://localhost:3000/productos/crear", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(vehicleData)
                });

                console.log(res);
            } catch (error) {
                
            }
            menuClose();
        });
    }
}

const menuOpen = () => {
    modalBg.classList.add("flex");
    modalBg.classList.remove("hidden");
}

const menuClose = () => {
    modalBg.classList.add("hidden");
    modalBg.classList.remove("flex");
}
