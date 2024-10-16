import { PAGE_URL } from '../constants.js';

const modalShowBtn = document.getElementById("menuBtn") ?? null;
const modalShowEditBtn = document.getElementsByName("editBtn")
const modalCloseBtn = document.getElementById("btnClose") ?? null;
const modalCancelBtn = document.getElementById("btnCancel") ?? null;
const modalBg = document.getElementById("modalBg") ?? null;
const form = document.getElementById("vehiculoForm") ?? null;

// Inputs 
const marca = document.getElementById("marca");
const modelo = document.getElementById("modelo");
const color = document.getElementById("color");
const precio = document.getElementById("precio");
const kilometraje = document.getElementById("kilometraje");
const descripcion = document.getElementById("descripcion");

const modalTitle = document.getElementById("loadTitle");

let isEdit = false;

let imagenes = [];
let imagenesCargadas = [];

export const LoadModalBtn = () => {
    resetData();
    if (modalShowBtn && modalCloseBtn && modalCancelBtn && form) {
        // Mostrar modal
        modalShowBtn.addEventListener("click", () => {
            modalBg.classList.add("flex");
            modalBg.classList.remove("hidden");

            isEdit = false;
            setTitle();
        });

        modalShowEditBtn.forEach(btn => {
            btn.addEventListener("click", (e) => {
                modalBg.classList.add("flex");
                modalBg.classList.remove("hidden");
    
                isEdit = true;
                getVehicleById(e.currentTarget.id);
                setTitle();
            });
        });

        // Cerrar modal
        modalCloseBtn.addEventListener("click", menuClose);
        modalCancelBtn.addEventListener("click", menuClose);

        form.addEventListener("submit", async function (e) {
            e.preventDefault();
        
            const fileInput = document.getElementById("imagenes"); 
            const files = fileInput.files;
            const allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif|\.jfif)$/i;
        
            // validar las extensiones
            for (let i = 0; i < files.length; i++) {
                if (!allowedExtensions.exec(files[i].name)) {
                    alert("Solo se permiten archivos con formato de imagen (.jpg, .jpeg, .png, .gif, .jfif).");
                    return;
                }
            }
        
            const vehicleData = {
                marca: marca?.value,
                modelo: modelo?.value,
                color: color?.value,
                precio: +precio?.value,
                kilometraje: +kilometraje?.value,
                descripcion: descripcion?.value,
                images: imagenesCargadas // Aquí tienes que asegurarte de que solo se pasen archivos de imagen
            };

            try {
                const response = await fetch(`${PAGE_URL}/productos/crear`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(vehicleData)
                });

                const result = await response.text();

                if (response.ok) {
                    localStorage.setItem("vehiculoAgregado", "true");

                    menuClose();

                    window.location.reload();
                } else {
                    const errorMessage = document.getElementById("errorMessage");
                    if (errorMessage) {
                        errorMessage.classList.remove("hidden");
                    }
                }
            } catch (error) {
                console.error(error);
                const errorMessage = document.getElementById("errorMessage");
                if (errorMessage) {
                    errorMessage.classList.remove("hidden");
                }
            }
        });
    }
};

// Imagenes
export const LoadHandleImages = () => {
    const dropImage = document.getElementById("files") ?? null;
    const inputImage = document.getElementById("imagenes") ?? null;
    if(dropImage) {
        dropImage.addEventListener("drop", handleDrop);
        inputImage.addEventListener("change", handleImage);
    }
}

const dragChange = document.getElementById("dragChange") ?? null;

export const handleDragEnter = () => {
    if(dragChange) {
        dragChange.classList.remove("border-gray-300");
        dragChange.classList.add("border-red-600");
    }
}

export const handleDragLeave = () => {
    if(dragChange) {
        dragChange.classList.remove("border-red-600");
        dragChange.classList.add("border-gray-300");
    }
}

export const handleDrop = (e) => {
    e.preventDefault();
    const files = e.dataTransfer.files;
    loadImagesAndShow(files);
}

export const handleImage = (e) => {
    e.preventDefault();
    const files = e.target.files;
    loadImagesAndShow(files);
}

const loadImagesAndShow = async (files) => {
    const errorMsg = document.getElementById("errorMsg");
    errorMsg.classList.add("hidden");  
    errorMsg.innerHTML = '';

    const allowedExtensions = ['PNG', 'JPEG', 'Webp', 'Avif', 'Jfif'];

    imagenes = [...imagenes, ...files];

    for (const file of files) {
        if (file.type.startsWith('image/')) {
            const imagenLoaded = await loadImage(file);
            imagenesCargadas.push(imagenLoaded);
        } else {
            console.log('Archivo no permitido:', file.name);

            errorMsg.innerHTML = 'Solo se permiten archivos de las siguientes extensiones: ' +
                allowedExtensions.map(ext => `<span class="text-red-600">${ext}</span>`).join(', ');

            errorMsg.classList.remove("hidden"); 
        }
    }

    handleDragLeave();
    clearImages();
    showImages();
}


const showImages = () => {
    dragChange.classList.remove("flex-col", "flex", "justify-center", "items-center");
    dragChange.classList.add("grid", "grid-cols-3", "gap-2", "p-2", "relative")
    imagenesCargadas.map((imagen, i) => {
        if(i < 6) {
            // Container para img y button con relative, crear la modificación de imagenes para eliminar.
            const container = document.createElement("DIV");

            const img = document.createElement("IMG");
            img.src = imagen;
            img.alt = "Image Preview";
            img.classList.add("w-full", "h-[108px]", "object-cover", "rounded-lg", "shadow");
            dragChange.appendChild(img);

            const button = document.createElement("BUTTON");
            button.type = "button";
            button.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" class="text-red-600 size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
            </svg> `;
dragChange.appendChild(button);
        }
    });

    const othersImages = imagenesCargadas.length - 6;
    if(othersImages > 0) {
        const paragraph = document.createElement("P");
        paragraph.textContent = "+" + othersImages;
        paragraph.classList.add("absolute", "-top-2", "-right-2", "text-white", "bg-gray-800", "px-2", "rounded-xl");
        dragChange.appendChild(paragraph);
    }
}

const clearImages = () => {
    while(dragChange.children.length > 0) {
        dragChange.removeChild(dragChange.firstChild);
    }
}

const loadImage = async (imagen) => {
    return new Promise((resolve, reject) => {
        const fileReader = new FileReader();
        fileReader.onload = () => {
            resolve(fileReader.result);
        };

        fileReader.onerror = () => {
            reject(new Error("Error al leer la imagen"));
        };

        fileReader.readAsDataURL(imagen);
    });
};

const menuClose = () => {
    modalBg.classList.add("hidden");
    modalBg.classList.remove("flex");
    resetData();
}

const setTitle = () => {
    modalTitle.textContent = `${isEdit ? "Editar vehiculo" : "Agregar vehiculo"}`;
}

const getVehicleById = async (id) => {
    const { vehicle: data } = await fetch(`${PAGE_URL}/productos/${id}`).then(res => res.json());

    const vehicule = data[0];

    if(vehicule) {
        marca.value = vehicule.marca;
        modelo.value = vehicule.modelo;
        kilometraje.value = vehicule.kilometraje;
        precio.value = +vehicule.precio;
        color.value = vehicule.color;
        descripcion.value =  vehicule.descripcion;
        imagenesCargadas = data[0].imagenes.split(",").map(img => `../../img/uploads/${img}`)
    }

    clearImages();
    showImages();
}

const resetData = () => {
    if(marca) {
        marca.value = "";
        modelo.value = "";
        kilometraje.value = 0;
        precio.value = 0;
        color.value = "";
        descripcion.value = "";
    }
}