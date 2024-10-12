const modalShowBtn = document.getElementById("menuBtn") ?? null;
const modalCloseBtn = document.getElementById("btnClose") ?? null;
const modalCancelBtn = document.getElementById("btnCancel") ?? null;
const modalBg = document.getElementById("modalBg") ?? null;

let imagenes = [];
let imagenesCargadas = [];

const form = document.getElementById("vehiculoForm") ?? null;

export const LoadModalBtn = () => {
    const modalShowBtn = document.getElementById("menuBtn") ?? null;
    const modalCloseBtn = document.getElementById("btnClose") ?? null;
    const modalCancelBtn = document.getElementById("btnCancel") ?? null;
    const modalBg = document.getElementById("modalBg") ?? null;
    const form = document.getElementById("vehiculoForm") ?? null;

    const menuClose = () => {
        modalBg.classList.add("hidden");
        modalBg.classList.remove("flex");
    };

    if (modalShowBtn && modalCloseBtn && modalCancelBtn && form) {
        // Mostrar modal
        modalShowBtn.addEventListener("click", () => {
            modalBg.classList.add("flex");
            modalBg.classList.remove("hidden");
        });

        // Cerrar modal
        modalCloseBtn.addEventListener("click", menuClose);
        modalCancelBtn.addEventListener("click", menuClose);

        form.addEventListener("submit", async function (e) {
            e.preventDefault();
        
            const fileInput = document.getElementById("imagenes"); 
            const files = fileInput.files;
            const allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        
            // Validar que todos los archivos sean imágenes
            for (let i = 0; i < files.length; i++) {
                if (!allowedExtensions.exec(files[i].name)) {
                    alert("Solo se permiten archivos con formato de imagen (.jpg, .jpeg, .png, .gif).");
                    return;
                }
            }
        
            const vehicleData = {
                marca: document.getElementById("marca").value,
                modelo: document.getElementById("modelo").value,
                color: document.getElementById("color").value,
                precio: +document.getElementById("precio").value,
                kilometraje: +document.getElementById("kilometraje").value,
                descripcion: document.getElementById("descripcion").value,
                images: imagenesCargadas // Aquí tienes que asegurarte de que solo se pasen archivos de imagen
            };

            try {
                const response = await fetch("http://localhost:3000/productos/crear", {
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
            const img = document.createElement("IMG");
            img.src = imagen;
            img.alt = "Image Preview";
            img.classList.add("w-full", "h-[108px]", "object-cover", "rounded-lg", "shadow");
            dragChange.appendChild(img);
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



// const showImage = () => {

// }

// const menuOpen = () => {
//     modalBg.classList.add("flex");
//     modalBg.classList.remove("hidden");
// }

const menuClose = () => {
    modalBg.classList.add("hidden");
    modalBg.classList.remove("flex");
}
