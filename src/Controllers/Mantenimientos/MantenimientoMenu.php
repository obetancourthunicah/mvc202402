<?php

namespace Controllers\Mantenimientos;

use Controllers\PrivateController;
use Views\Renderer;

class MantenimientoMenu extends PrivateController
{
    public function run(): void
    {
        Renderer::render('mantenimientos/menu', []);
    }
}
