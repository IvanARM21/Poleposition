import { } from './swiper.js';
import { PAGE_URL } from './constants.js';
import { loadPerfilButtons } from './perfil.js';
import { LoadMenuBtn } from './menu.js';
import { validacionLogin } from './validacion.js';
import { loadVehicles } from './catalogo.js';

addEventListener("DOMContentLoaded", () => {
    loadPerfilButtons();
    LoadMenuBtn();
    validacionLogin();
    loadVehicles();
});
