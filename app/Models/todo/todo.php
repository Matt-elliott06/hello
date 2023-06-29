<?php
namespace App\Models\todo;

use Illuminate\Database\Eloquent\Model;

class todo extends Model
{

    protected $table = 'todolist';
    protected $fillable = [
        'title', 'description', 'is_done'
    ];
    protected $guarded = [
        'created_at',
    ];

}

    ?>
