import { } from './swiper.js';
import { loadPerfilButtons } from './perfil.js';
import { LoadMenuBtn } from './menu.js';
import { validacionLogin } from './validacion.js';
import { loadVehicles } from './catalogo.js';
import { loadBuy } from './comprar.js';

addEventListener("DOMContentLoaded", () => {
    loadPerfilButtons();
    LoadMenuBtn();
    validacionLogin();
    loadVehicles();

    loadBuy();
});
