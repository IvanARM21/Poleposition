const starsByName = document.getElementsByName("calificacion");
const calificacionTexto = document.getElementById("calificacionTexto");
const modalReseña = document.getElementById("modalReseña");
const openModal = document.getElementById("openModal");
const closeModalBtns = Array.from(document.getElementsByName("closeModal"));

const inputs = Array.from([...document.getElementsByTagName("input"), ...document.getElementsByTagName("textarea")]);

const stars = {
    1: document.getElementById("1"),
    2: document.getElementById("2"),
    3: document.getElementById("3"),
    4: document.getElementById("4"),
    5: document.getElementById("5")
}

const review = {
    title: "",
    message: "",
    qualification: 1,
};

const isBlur = {
    title: false,
    message: false,
};

const messages = {
    title: "El título de la reseña es obligatorio",
    message: "El mensaje de la reseña es obligatorio",
};

export const loadReviewModal = () => {
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
};

const validateInput = (input) => {
    const valueLength = input.value.length;
    const inputId = input.id;

    if (isBlur[inputId] && valueLength <= 3) {
        showAlertReview(input);
    } else {
        const prevMessages = input.parentElement.querySelectorAll('.error-message');
        if (prevMessages.length > 0) {
            prevMessages.forEach(msg => msg.remove());
        }
    }
};

const showAlertReview = (input) => {
    if(!messages[input.id]) return
    const prevMessages = input.parentElement.querySelectorAll('.error-message');
    if (prevMessages.length > 0) return

    const paragraph = document.createElement("DIV");
    paragraph.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
            <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" />
        </svg>
        <p>${messages[input.id]}</p>
    `;
    paragraph.classList.add("error-message", "text-red-600", "text-xs", "flex", "gap-1", "items-center");
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
    review.qualification = starId;
    updateStars();
}

const updateStars = () => {
    starsByName.forEach((star, indexStar) => {
        if(indexStar <= +review.qualification-1) {
            star.classList.remove("text-gray-300");
            star.classList.add("text-yellow-500");
        }
    });
    const qualificationFormatted = (+review.qualification).toFixed(1);
    calificacionTexto.textContent = qualificationFormatted;
}
