<?php
namespace App\Http\Controllers\Api\Basket;

use http\Env\Response;
use Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use App\Models\Basket\Basket;
use Illuminate\Support\Facades\Redirect;
use App\Models\Products\products;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;

class BasketController extends Controller
{
    public function index()
    {
        $sess=session()->getId();

        $data= Basket::where('user_id','=',$sess)->with(['product'])->get();

        return response()->json($data, 200);

    }

    public function get($id = null)
    {


    }
    public function add()
    {

        $productid = REquest::get('product_id');
        $qty = Request::Get('qty');

        $sess=session()->getId();
        $data = Basket::where('user_id','=',$sess)->where('product_id','=',$productid)->first();
        if(isset($data->id)) {
            $data->quantity = $data->quantity + $qty;
            $data->save();
        } else {
            $data = new Basket();
            $data->user_id = $sess;
            $data->product_id = REquest::get('product_id');
            $data->quantity = REquest::get('qty');
            $data->save();
        }

        return response()->json($data, 200);


    }
    public function delete()
    {


    }


}
