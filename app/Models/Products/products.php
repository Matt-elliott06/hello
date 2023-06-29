<?php
namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{

    protected $table = 'products';
    protected $fillable = [
        'title', 'description', 'price', 'image'
    ];
    protected $guarded = [
        'created_at',
    ];


    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        if (!empty($this->image) && file_exists(storage_path('app/public/images/products/'.$this->image))) {

        return '/storage/images/products/'.$this->image;
    }
    else{
     return '/storage/images/products/Image_not_available.png';

    }}
}

?>
