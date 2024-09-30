const menuShowBtn = document.getElementById("menuBtn");
const menuCloseBtn = document.getElementById("btnClose");
const menu = document.getElementById("menu-mobile");
const menuBg = document.getElementById("bgMenu");

export const LoadMenuBtn = () => {
    if(menuShowBtn) {
        menuShowBtn.addEventListener("click", () => {
            menu.classList.remove("hidden");
            menu.classList.add("show");
            menuBg.classList.remove("bg-hidden");
            menuBg.classList.add("bg-black");
        });
        menuCloseBtn.addEventListener("click", menuClose);

        menuBg.addEventListener("click", menuClose);
    }
}

const menuClose = () => {
    menu.classList.remove("show");
    menu.classList.add("hidden");
    menuBg.classList.remove("bg-black");
    menuBg.classList.add("bg-hidden");
}