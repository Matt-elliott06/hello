<?php
namespace App\Models\Basket;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{

    protected $table = 'basket';
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];
    protected $guarded = [
        'created_at',
    ];

    public function product()
    {
        return $this->hasOne('App\Models\Products\products', 'id', 'product_id');
    }

}

?>
