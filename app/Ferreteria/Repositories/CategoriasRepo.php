<?php
/**
 * Created by PhpStorm.
 * User: n
 * Date: 29/05/2016
 * Time: 03:23 PM
 */
namespace App\Ferreteria\Repositories;
use App\Ferreteria\Entities\Categoria;

class CategoriasRepo {

    public function getCategorias(){
        return Categoria::all();
    }

    public function getCategoriasWithProductos(){
        return Categoria::with('productos');
    }

    public function createCategoria($categoria){
        return Categoria::create([
            'categoria'            => $categoria
        ]);
    }

    public function getCategoriaById($id){
        return Categoria::find($id);
    }

    public function getCategoriaByIdWithProductos($id){
        return Categoria::with('productos')
                ->where('id','=',$id)
                ->first();
    }

}