<?php
declare(strict_types = 1);

namespace Cart\Infrastructure\Repository\DAO;

use Illuminate\Database\Eloquent\Model;

/**
 * @author Bogusław Trojański
 */
class CartDao extends Model
{
    protected $table = 'carts';
    protected $primaryKey = 'id_cart';
    public $timestamps = false;
    protected $dates = ['create_date', 'update_date'];
    protected $fillable = ['id_customer','netto','currency', 'average'];

    public function details()
    {
        return $this->hasMany('App\Cart\src\Infrastructure\Repository\DAO\CartDetailDao', 'id_cart');
    }
}
