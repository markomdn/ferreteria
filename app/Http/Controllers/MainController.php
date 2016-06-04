<?php
/**
 * Created by PhpStorm.
 * User: n
 * Date: 29/05/2016
 * Time: 04:19 PM
 */

namespace App\Http\Controllers;
use App\Ferreteria\Entities\Categoria;
use App\Ferreteria\Entities\Producto;
use App\Ferreteria\Entities\Venta;
use Illuminate\Routing\Controller as BaseController;

use App\Ferreteria\Repositories\CategoriasRepo;
use App\Ferreteria\Repositories\LineasVentasRepo;
use App\Ferreteria\Repositories\ProductosRepo;
use App\Ferreteria\Repositories\VentasRepo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class MainController extends BaseController{
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
        dd(Input::all());
        $producto = $this->productoRepo->getProductoById(Input::all()['idProducto']);
        if(isset($producto)){
            $producto->delete();
            return $producto;
        }

        return $producto;
    }

    public function editProducto(){
        $producto = $this->productoRepo->getProductoById(Input::all()['idProducto']);

        if(isset($producto)){
            $producto->nombre = Input::all()['nombreProducto'];
            $producto->precio = Input::all()['precio'];
            $producto->stock = Input::all()['stock'];
            $producto->save();
            return $producto;
        }

        return false;
    }

    public function editProductoForSale(){
        $venta = $this->ventaRepo->createVenta(1);
        foreach (Input::all() as $producto) {
            $product = $this->productoRepo->getProductoById($producto['id']);
            if(isset($product)){
                $product->stock -= $producto['toDescount'];
                $product->save();

                $linea = $this->lineaVentaRepo->createLineaVenta(
                    $producto['toDescount'],
                    $product->precio,
                    $product->id,
                    $venta->id);
            }
        }
        return $venta;
    }

    public function getCategorias(){
        $categorias = Categoria::all();
        return $categorias;
    }

    public function getProducto($id){
        $producto = Producto::find($id);
        return $producto;
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

    public function getVenta(){
        $band = Input::all()['band'];
        $ventas = Venta::all();
        $idsVentas = [];
        if($band == 0){
            $mes = explode('/',Input::all()['fecha']);
            $mes = $mes[0];
            foreach($ventas as $venta){
                $fecha = explode('-', substr($venta->created_at, 0, 9));
                if($fecha[1] == $mes){
                    array_push($idsVentas,$venta->id);
                }
            }
        }else{
            $dia = explode('/',Input::all()['fecha']);
            foreach($ventas as $venta){
                $fecha = substr($venta->created_at, 0, 9);
                $fecha = explode('-', $fecha);
                $fechaNew = $fecha[0].'-'.$fecha[1].'-'.$fecha[2];
                $fecha = substr($venta->created_at, 0, 9);

                if($dia == $fechaNew){
                    array_push($idsVentas,$venta->id);
                }
            }
        }

        $ventasReporte = [];
        foreach($idsVentas as $id){
            $ventaLineas = DB::table('ventas')
                ->leftJoin('lineas_ventas','lineas_ventas.venta_id','=','ventas.id')
                ->where('ventas.id','=',$id)
                ->get();
            array_push($ventasReporte,$ventaLineas[0]);
        }

        return $ventasReporte;
    }

}