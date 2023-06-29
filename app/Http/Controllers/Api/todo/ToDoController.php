<?php
namespace App\Http\Controllers\Api\todo;

use http\Env\Response;
use Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Redirect;
use App\Models\todo\todo;
use App\Http\Controllers\Controller;





class ToDoController extends Controller
{
    public function index()
    {
$todos=todo::all();
return response()->json($todos,200);
    }

    public function get($id = null)
    {
        $todo = todo::find($id);
        return response()->json($todo,200);

    }

    public function add()
    {
        $v = Validator::make(Request::all(), [
            'title'=>'required',
            'description'=>'required',
        ]);

        if ($v->fails())
        {
            return response()->json($v->errors(),422);
        }

        $todo=new todo();
        $todo->fill(Request::all());
        $todo->save();
        return response()->json($todo,200);

    }

    public function edit($id = null)
    {
        $v = validator::make(Request::all(), [
            'title' => 'required',
            'description' => 'required',
        ]);


        if ($v->fails()) {
            return response()->json($v->errors(), 422);
        }
        $todo = todo::find(Request::get('id'));
        $todo->fill(Request::all());
        $todo->save();
        return response()->json($todo, 200);
    }


    public function delete($id = null)
    {
$todo = todo::find($id);
$todo->delete();
return response()->json(['message'=>'todo deleted successfully'],200);
    }

}

    ?>
