<?php
declare(strict_types = 1);

namespace Product\Infrastructure\Repository\DAO;

use Illuminate\Database\Eloquent\Model;

/**
 * @author Bogusław Trojański
 */
class ProductDAO extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id_product';
    public $timestamps = false;
    protected $fillable = ['name','price','currency'];
}