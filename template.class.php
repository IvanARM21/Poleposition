<?php

class Template {

    private $content;

    // Constructor que recibe el path de la vista y los datos a pasar
    // $path es la ubicación del archivo de vista, por ejemplo './views/index.php'
    // $data es un arreglo asociativo con datos a usar en la vista, por ejemplo ['product' => $product]
    // La función extract convierte el arreglo asociativo en variables locales, evitando tener que usar $data['product']
    // se puede acceder gracias a extract como $product
    public function __construct($path, $data = []) {
        extract($data);
        // Inicia el buffer de salida
        ob_start();
        // Incluye el archivo de vista en el buffer
        include($path);
        // Limpia el buffer y asigna el contenido a $this->content
        $this->content = ob_get_clean();
    }

    // Método mágico __toString que devuelve el contenido renderizado cuando se convierte el objeto a cadena
    public function __toString() {
        return $this->content;
    }
}
