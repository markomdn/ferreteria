<?php
/**
 * Created by PhpStorm.
 * User: n
 * Date: 29/05/2016
 * Time: 04:19 PM
 */

namespace App\Http\Controllers;

use App\Ferreteria\Repositories\CategoriasRepo;
use App\Ferreteria\Repositories\LineasVentasRepo;
use App\Ferreteria\Repositories\ProductosRepo;
use App\Ferreteria\Repositories\VentasRepo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class MainController{
    protected $categoriaRepo;
    protected $productoRepo;
    protected $ventaRepo;
    protected $lineaVentaRepo;

    public function __construct(CategoriasRepo $categoriasRepo, ProductosRepo $productosRepo,
                                VentasRepo $ventasRepo, LineasVentasRepo $lineasVentasRepo ){
        $this->categoriaRepo = $categoriasRepo;
        $this->productoRepo = $productosRepo;
        $this->ventaRepo = $ventasRepo;
        $this->lineaVentaRepo = $lineasVentasRepo;
    }

    public function createProducto(){
        $producto = $this->productoRepo->createProducto(
            Input::all()['nombreProducto'],
            Input::all()['descripcion'],
            Input::all()['precio'],
            Input::all()['stock'],
            Input::all()['categoria_id']);

        return $producto;
    }

    public function deleteProducto(){
        $producto = $this->productoRepo->getProductoById(Input::all()['idProducto']);

        if(isset($producto)){
            $producto->delete();
            return true;
        }

        return false;
    }

    public function editProducto(){
        $producto = $this->productoRepo->getProductoById(Input::all()['idProducto']);

        if(isset($producto)){
            $producto->nombre = Input::all()['nombreProducto'];
            $producto->precio = Input::all()['precio'];
            $producto->stock = Input::all()['stock'];
            $producto->save();
            return true;
        }

        return false;
    }

    public function getCategorias(){
        $categorias = $this->categoriaRepo->getCategorias();
        return $categorias;
    }

    public function getProductos(){
        $productos = $this->productoRepo->getProductos();
        return $productos;
    }
    
    public function login(){
        $user = DB::table('users')
            ->where('name','=',Input::all()['userName'])
            ->first();
        
        if(isset($user)){
            if($user->password == Input::all()['password']){
                return true;
            }

            return 'Password invalido';
        }

        return 'No existe usuario';
    }

}