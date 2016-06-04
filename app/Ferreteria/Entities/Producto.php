<?php
namespace App\Ferreteria\Entities;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Producto extends Model {
    use SoftDeletes;
    protected $table = "productos";

    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'categoria_id'
    ];

    public function categoria(){
        return $this->hasOne('Ferreteria\Entities\Categoria', 'id', 'categoria_id');
    }

    public function lineas_productos(){
        return $this->hasMany('Ferreteria\Entities\LineaVenta','producto_id','id');
    }
}