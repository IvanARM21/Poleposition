import { PAGE_URL } from "./constants.js";

const starsByName = document.getElementsByName("calificacion");
const calificacionTexto = document.getElementById("calificacionTexto");
const modalReseña = document.getElementById("modalReseña");
const openModal = document.getElementById("openModal");
const closeModalBtns = Array.from(document.getElementsByName("closeModal"));
const btnDownload = document.getElementById("btnDownload");
const reviewForm = document.getElementById("reviewForm");
const inputs = Array.from([...document.getElementsByTagName("input"), ...document.getElementsByTagName("textarea")]);

const stars = {
    1: document.getElementById("1"),
    2: document.getElementById("2"),
    3: document.getElementById("3"),
    4: document.getElementById("4"),
    5: document.getElementById("5")
}

const review = {
    titulo: "",
    mensaje: "",
    calificacion: 1,
};

const isBlur = {
    titulo: false,
    mensaje: false,
};

const mensajes = {
    titulo: "El título de la reseña es obligatorio",
    mensaje: "El mensaje de la reseña es obligatorio",
};

export const loadReviewModal = () => {
    const idVehiculo = JSON.parse(localStorage.getItem("vehicle"))?.id;
    const compra = JSON.parse(localStorage.getItem("compra"));

    const user = decodeURIComponent(document?.cookie) ? JSON.parse(decodeURIComponent(document?.cookie)?.split("=")[1]) : null;

    if(window.location.href.includes("/compra-confirmada") && (!idVehiculo || !compra || !user.id )) {
        window.location.href = "/";
    }

    starsByName.forEach(star => {
        star.addEventListener("mouseenter", (e) => {
            noMouseEnter(e.target.id);
        });
        star.addEventListener("mouseleave", () => {
            onMouseLeave();
            updateStars();
        });
        star.addEventListener("click", (e) => {
            onClick(e.currentTarget.id);
        });
    });

    openModal?.addEventListener("click", () => {
        modalReseña.classList.add("flex");
        modalReseña.classList.remove("hidden");
    });

    closeModalBtns?.forEach(btn => btn.addEventListener("click", () => {
        modalReseña.classList.add("hidden");
        modalReseña.classList.remove("flex");
    }));

    inputs?.forEach(input => input.addEventListener("input", (e) => {
        review[e.currentTarget.id] = e.currentTarget.value; 
        validateInput(e.currentTarget);
    }));

    inputs?.forEach(input => input.addEventListener("blur", (e) => {
        isBlur[e.currentTarget.id] = true; // Marcamos como desenfocado
        validateInput(e.currentTarget);
    }));

    reviewForm?.addEventListener("submit", async e => {
        e.preventDefault();

        const idVehiculo = JSON.parse(localStorage.getItem("vehicle"))?.id;
        const compra = JSON.parse(localStorage.getItem("compra"));
        const { nombreCompleto, id } = JSON.parse(decodeURIComponent(document.cookie).split("=")[1]);

        if(!compra || !nombreCompleto || !id) {
            Swal.fire({
                title: 'Error!',
                text: resp.message || 'Ha ocurrido un error al intentar subir el testimomio',
                icon: 'success',
                confirmButtonText: 'Ok'
            });
        } 

        if(!compra) {
            Swal.fire({
                title: 'Error!',
                text: resp.message || 'No puedes dejar otro testiomonio',
                icon: 'error',
                confirmButtonText: 'Ok'
            });
            return
        }
        const formData = {
            ...review,
            autor: nombreCompleto,
            idVehiculo: +idVehiculo,
            idCliente: +id
        }

        const resp = await fetch(`${PAGE_URL}/review/crear`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(formData)
        }).then(resp => resp.json());

        if (resp.error) {
            Swal.fire({
                title: 'Error!',
                text: resp.message || 'Ha ocurrido un error',
                icon: 'error',
                confirmButtonText: 'Ok'
            });
        } else {
            modalReseña.classList.add("hidden");
            modalReseña.classList.remove("flex");
            Swal.fire({
                title: 'Éxito!',
                text: resp.message || 'Se ha creado correctamente su reseña',
                icon: 'success',
                confirmButtonText: 'Ok',
            }).then(() => {
                const compra = JSON.parse(localStorage.getItem("compra"));
                localStorage.setItem("compra", JSON.stringify({
                    ...compra,
                    isPurchase: false
                }));
            });
        }
    });


    // Btn Download
    btnDownload?.addEventListener("click", redirectToDownloadPDF)
};

// const publishReview = async () => {
//     const idVehicle = localStorage.getItem("idVehicle");
//     const idClient = localStorage.getItem("idClient");

//     const formData = {
//         idVehiculo: idVehicle,
//         idCliente: idClient,
//         calificacion: review.qualification,
//         mensaje: review.message,
//         titulo: review.title
//     }

//     const resp = await fetch(`${PAGE_URL}/review/crear`, {
//         method: "POST",
//         body: JSON.stringify(formData)
//     }).then(res => res.text());
// }

const validateInput = (input) => {
    const valueLength = input.value.length;
    const inputId = input.id;

    if (isBlur[inputId] && valueLength <= 3) {
        showAlertReview(input);
    } else {
        const prevmensajes = input.parentElement.querySelectorAll('.error-mensaje');
        if (prevmensajes.length > 0) {
            prevmensajes.forEach(msg => msg.remove());
        }
    }
};

const showAlertReview = (input) => {
    if(!mensajes[input.id]) return
    const prevmensajes = input.parentElement.querySelectorAll('.error-mensaje');
    if (prevmensajes.length > 0) return

    const paragraph = document.createElement("DIV");
    paragraph.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
            <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" />
        </svg>
        <p>${mensajes[input.id]}</p>
    `;
    paragraph.classList.add("error-mensaje", "text-red-600", "text-xs", "flex", "gap-1", "items-center");
    input.parentElement.appendChild(paragraph);
};

const noMouseEnter = (starId) => {
    clearStars();
    Array.from({length: starId}, (_, index) => {
        stars[index+1].classList.remove("text-gray-300");
        stars[index+1].classList.add("text-yellow-500");
    });
    calificacionTexto.textContent = (+starId).toFixed(1);
}
const clearStars = () => {
    starsByName.forEach((star) => {
        star.classList.remove("text-yellow-500");
        star.classList.add("text-gray-300");
    });
}

const onMouseLeave = () => {
    starsByName.forEach((star) => {
        star.classList.remove("text-yellow-500");
        star.classList.add("text-gray-300");
    });
}

const onClick = (starId) => {
    review.calificacion = +starId;
    updateStars();
}

const updateStars = () => {
    starsByName.forEach((star, indexStar) => {
        if(indexStar <= +review.calificacion-1) {
            star.classList.remove("text-gray-300");
            star.classList.add("text-yellow-500");
        }
    });
    const calificacionFormatted = (+review.calificacion).toFixed(1);
    calificacionTexto.textContent = calificacionFormatted;
}

const redirectToDownloadPDF = () => {
    const compra = JSON.parse(localStorage.getItem("compra"));
    const { idCompra, type } = compra;
    
    // Abre la página de descarga en una nueva pestaña según el tipo de compra o alquiler
    const url = type === "compra" 
        ? `/generar-factura/editar/${idCompra}` 
        : `/generar-factura-alquiler/editar/${idCompra}`;
    
    window.open(url, '_blank');  // '_blank' indica abrir en una nueva pestaña
};
