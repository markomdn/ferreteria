<?php
namespace App\Ferreteria\Entities;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Model {
    use SoftDeletes;
    protected $table = "users";

    protected $fillable = [
        'id',
        'name',
        'email',
        'password'
    ];

    public function ventas(){
        return $this->hasMany('Ferreteria\Entities\Ventas', 'user_id', 'id');
    }
}