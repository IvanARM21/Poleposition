const menuShowBtn = document.getElementById("menuBtn");
const menuCloseBtn = document.getElementById("btnClose");
const menu = document.getElementById("menu-mobile");
const menuBg = document.getElementById("bgMenu");

export const LoadMenuBtn = () => {
    if(menuShowBtn) {
        menuShowBtn.addEventListener("click", () => {
            menu.classList.remove("menu-inactivo");
            menu.classList.add("menu-activo");
            menuBg.classList.remove("bg-black-inactivo");
            menuBg.classList.add("bg-black-activo");
        });
        menuCloseBtn.addEventListener("click", menuClose);

        menuBg.addEventListener("click", menuClose);
    }
}

const menuClose = () => {
    menu.classList.remove("menu-activo");
    menu.classList.add("menu-inactivo");
    menuBg.classList.remove("bg-black-activo");
    menuBg.classList.add("bg-black-inactivo");
}