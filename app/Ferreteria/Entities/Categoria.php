<?php
namespace App\Ferreteria\Entities;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Categoria extends Model {
    use SoftDeletes;
    protected $table = "categorias";

    protected $fillable = [
        'id',
        'categoria'
    ];

    public function productos(){
        return $this->hasMany('Ferreteria\Entities\Producto', 'categoria_id', 'id');
    }
}