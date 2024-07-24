<?php


namespace Controllers\Mantenimientos\Productos;

use \Dao\Productos\Productos as DaoProductos;

const SESSION_PRODUCTOS_SEARCH = "productos_search_data";

const PRODUCTS_NEW = "mnt_products_new";
const PRODUCTS_UPD = "mnt_products_upt";
const PRODUCTS_DEL = "mnt_products_del";

class Productos extends \Controllers\PrivateController
{
    public function run(): void
    {
        $viewData = array();
        $viewData["search"] = $this->getSessionSearchData();
        if ($this->isPostBack()) {
            $viewData["search"] = $this->getSearchData();
            $this->setSessionSearchData($viewData["search"]);
        }
        $viewData["productos"] = DaoProductos::readAllProductos($viewData["search"]);
        $viewData["total"] = count($viewData["productos"]);

        $viewData[PRODUCTS_NEW] = $this->isFeatureAutorized(PRODUCTS_NEW);
        $viewData[PRODUCTS_UPD] = $this->isFeatureAutorized(PRODUCTS_UPD);
        $viewData[PRODUCTS_DEL] = $this->isFeatureAutorized(PRODUCTS_DEL);

        \Views\Renderer::render("mantenimientos/productos/lista", $viewData);
    }

    private function getSearchData()
    {
        if (isset($_POST["search"])) {
            return $_POST["search"];
        }
        return "";
    }

    private function getSessionSearchData()
    {
        if (isset($_SESSION[SESSION_PRODUCTOS_SEARCH])) {
            return $_SESSION[SESSION_PRODUCTOS_SEARCH];
        }
        return "";
    }

    private function setSessionSearchData($search)
    {
        $_SESSION[SESSION_PRODUCTOS_SEARCH] = $search;
    }
}
