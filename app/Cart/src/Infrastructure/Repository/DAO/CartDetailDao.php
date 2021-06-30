<?php
declare(strict_types = 1);

namespace App\Cart\src\Infrastructure\Repository\DAO;

use Illuminate\Database\Eloquent\Model;

/**
 * @author Bogusław Trojański
 */
class CartDetailDao extends Model
{
    protected $table = 'carts_details';
    protected $primaryKey = 'id_cart_detail';
    public $timestamps = false;
    protected $fillable = ['name','netto','currency', 'quantity', 'vat_rates'];

    public function idCartDetail()
    {
        return $this->belongsTo('Cart\Infrastructure\Repository\DAO\CartDao', 'id_cart_detail');
    }

    public function idProduct()
    {
        return $this->belongsTo('Product\Infrastructure\Repository\DAO\ProductDAO', 'id_product');
    }
}
