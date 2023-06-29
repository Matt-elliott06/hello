<?php
namespace App\Http\Controllers\Api\Products;

use http\Env\Response;
use Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Redirect;
use App\Models\Products\products;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;



class ProductsController extends Controller
{
    public function index()
    {

        $products = products::all();
        return response()->json($products, 200);
    }


    public function get($id = null)
    {
        $product = products::find($id);
        return response()->json($product, 200);

    }

    public function add()
    {



        $v = Validator::make(Request::all(), [
            'title'=>'required',
            'description'=>'required',
            'price'=>'required|numeric',

        ]);

        if ($v->fails())
        {
            return response()->json($v->errors(),422);
        }

        $product=new products();
        $product->fill(Request::all());

        if (Request::hasFile('image')) {
            $dir= storage_path("app/public/images/products/");

            if(!is_dir($dir)) { mkdir($dir); }

            $filename= date('Ymdhis').".webp";
            Image::make(Request::file('image'))->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($dir . $filename);

            $product->image=$filename;


        }





        $product->save();
        return response()->json($product,200);





    }

    public function edit($id = null)
    {
        $v = validator::make(Request::all(), [
            'title' => 'required',
            'description' => 'required',
            'price'=>'required|numeric',

        ]);
        if($v->fails())
        {
            return response()->json($v->errors(),422);
        }
        $product = products::find(Request::get('id'));
        $product->fill(Request::all());

        if (Request::hasFile('image')) {
            $dir= storage_path("app/public/images/products/");

            if(!is_dir($dir)) { mkdir($dir); }

            $filename= date('Ymdhis').".webp";
            Image::make(Request::file('image'))->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($dir . $filename);

            $product->image=$filename;


        }

        $product->save();
        return response()->json($product,200);
    }

    public function delete($id = null)
    {
        $product = products::find($id);
        $product->delete();
        return response()->json(['message'=> 'product deleted successfully'],200);
    }
}
