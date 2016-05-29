<?php
/**
 * Created by PhpStorm.
 * User: n
 * Date: 29/05/2016
 * Time: 03:48 PM
 */

namespace App\Ferreteria\Repositories;
use App\Ferreteria\Entities\Producto;

class ProductosRepo{

    public function getProductos(){
        return Producto::all();
    }

    public function createProducto($nombre, $desc, $precio,$stock, $categoria_id){
        return Producto::create([
            'nombre'        => $nombre,
            'descripcion'   => $desc,
            'precio'        => $precio,
            'stock'         => $stock,
            'categoria_id'  => $categoria_id
        ]);
    }

    public function getProductoById($id){
        return Producto::find($id);
    }

}