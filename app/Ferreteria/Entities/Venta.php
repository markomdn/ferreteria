<?php
namespace App\Ferreteria\Entities;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Venta extends Model {
    use SoftDeletes;
    protected $table = "ventas";

    protected $fillable = [
        'id',
        'user_id'
    ];

    public function user(){
        return $this->hasOne('Ferreteria\Entities\User', 'categoria_id', 'id');
    }
}