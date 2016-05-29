<?php
/**
 * Created by PhpStorm.
 * User: n
 * Date: 29/05/2016
 * Time: 04:07 PM
 */

namespace App\Ferreteria\Repositories;


use App\Ferreteria\Entities\LineaVenta;
use App\Ferreteria\Entities\Venta;

class LineasVentasRepo{

    public function createLineaVenta($cantidad, $precio, $producto_id, $venta_id){
        return LineaVenta::create([
            'cantidad'      => $cantidad,
            'precio'        => $precio,
            'producto_id'   => $producto_id,
            'venta_id'      => $venta_id
        ]);
    }

}