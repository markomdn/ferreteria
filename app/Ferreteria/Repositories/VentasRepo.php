<?php
/**
 * Created by PhpStorm.
 * User: n
 * Date: 29/05/2016
 * Time: 03:23 PM
 */
namespace App\Ferreteria\Repositories;
use App\Ferreteria\Entities\Venta;

class VentasRepo {

    public function getVentas(){
        return Venta::with('lineas')->get();
    }
    
    public function createVenta($user_id){
        return Venta::create([
            'user_id'            => $user_id
        ]);
    }

    public function getVentaByIdWithLineasAndProductos($id){
        return Venta::with(array('lineas' => function($q){
                        $q->with('producto');
                    }))
                    ->where('id','=',$id)
                    ->get();
    }
}