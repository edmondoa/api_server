<?php

namespace App\Http\Controllers;

use Auth;
use App\Todo;
use App\Model\Auth\ClientAccessible;
use App\Model\Auth\Log;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class TodoController extends Controller
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = Auth::user()->todos;

        return view('todos.index', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(['item' => 'required|between:2,50']);

        Auth::user()->todos()->save(new Todo($data));

        return redirect()->route('todos.index')->withStatus('Todo saved!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        $data = $request->validate(['done' => 'required|boolean']);

        $todo->done = $data['done'];
        $todo->completed_on = $data['done'] == true ? Carbon::now() : null;

        return response(['status' => $todo->save() ? 'success' : 'error']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        return response(['status' => $todo->delete() ? 'success' : 'error']);
    }


    public function testapi(Request $request)
    {
        $access = ClientAccessible::check('Todos') ;
        if (!$access) {
            return $this->sendError('No Access to Todos Service');
        }
        $data = ['user_id'=>Auth::user()->id,'model'=>'Todo'];
       
        Log::log($data);
        return $this->sendResponse($request->user()->todos,'Success');
    }
}
