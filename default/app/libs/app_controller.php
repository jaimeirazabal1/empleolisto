<?php
/**
 * @see Controller nuevo controller
 */
require_once CORE_PATH . 'kumbia/controller.php';

/**
 * Controlador principal que heredan los controladores
 *
 * Todas las controladores heredan de esta clase en un nivel superior
 * por lo tanto los metodos aqui definidos estan disponibles para
 * cualquier controlador.
 *
 * @category Kumbia
 * @package Controller
 */
class AppController extends Controller
{

    final protected function initialize()
    {
    	$ruta_actual = Router::get("controller")."/".Router::get("action");
    	$rutas_publicas = array("RS/index","RS/logout");
    	if (!Auth::is_valid() and !in_array($ruta_actual, $rutas_publicas)) {
    		Flash::error("Acceso Denegado");
    		Router::redirect("RS/");
    	}
    }

    final protected function finalize()
    {
        
    }

}
