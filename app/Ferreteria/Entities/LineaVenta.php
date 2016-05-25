<?php
namespace App\Ferreteria\Entities;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class LineaVenta extends Model {
    use SoftDeletes;
    protected $table = "lineas_ventas";

    protected $fillable = [
        'id',
        'cantidad',
        'precio',
        'producto_id',
        'venta_id'
    ];

    public function venta(){
        return $this->hasOne('Ferreteria\Entities\Venta', 'id', 'venta_id');
    }

    public function producto(){
            return $this->hasOne('Ferreteria\Entities\Producto', 'id', 'producto_id');
        }
    }