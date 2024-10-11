const menuShowBtn = document.getElementById("menuBtn") ?? null;
const menuCloseBtn = document.getElementById("btnClose") ?? null;
const menu = document.getElementById("menu-mobile") ?? null;
const menuBg = document.getElementById("bgMenu") ?? null;

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