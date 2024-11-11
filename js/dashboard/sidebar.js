const btnOpenSidebar = document.getElementById("btnSidebar");
const sidebar = document.getElementById("sidebar");
const bgSidebar = document.getElementById("bgSidebar");
const btnCloseSidebar = document.getElementById("closeSidebar");

export const loadSidebar = () => {
    btnOpenSidebar.addEventListener("click", () => {
        sidebar.classList.remove("translate-x-full");
        sidebar.classList.add("translate-x-0");
        bgSidebar.classList.add("block");
        bgSidebar.classList.remove("hidden");

        btnCloseSidebar.classList.remove("hidden");
    });
    btnCloseSidebar.addEventListener("click", () => {
        sidebar.classList.add("-translate-x-full");
        sidebar.classList.remove("translate-x-0");
        bgSidebar.classList.add("hidden");
        bgSidebar.classList.remove("block");

        btnCloseSidebar.classList.add("hidden");

    });
}