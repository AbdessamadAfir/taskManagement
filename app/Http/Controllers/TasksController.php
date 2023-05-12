<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\Request;
use Validator;

class TasksController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $tasks = Tasks::sortable()->paginate(5);
        return response()->json(["Tasks" => $tasks], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'task_name' => 'required|string|between:2,100',
            'id_project' => 'required|string',
            'dateStart' => 'required|date',
            'dateEnd' => 'required|date',
            'status' => 'required|string',
            'description' => 'required|string',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $task = Tasks::create(
            $validator->validated(),
        );
        return response()->json([
            'message' => 'Task successfully registered',
            'project' => $task
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function show(Tasks $tasks, $id)
    {
        //
        $task = Tasks::find($id);
        return response()->json(["Task" => $task], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function edit(Tasks $tasks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tasks $tasks, $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'task_name' => 'required|string|between:2,100',
            'id_project' => 'required|string',
            'dateStart' => 'required|date',
            'dateEnd' => 'required|date',
            'status' => 'required|string',
            'description' => 'required|string',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $task = Tasks::whereId($id)->update(
            $validator->validated(),
        );
        return response()->json([
            'message' => 'Task successfully updated',
            'project' => $task
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tasks $tasks, $id)
    {
        //
        $task = Tasks::destroy($id);
        return response()->json([
            "message" => "Task has been deleted successfully",
        ],201);
    }

    public function project_filtring(Request $request)
    {
        //
        $filter = $request->query('filter');
        if(!empty($filter)){
            $tasks = Tasks::sortable()->where('task_name','like', '%'.$filter.'%')->paginate(5);
        }else{
            $tasks = Tasks::sortable()->paginate(5);
        }
        return response()->json(["Tasks" => $tasks], 200);
    }
}
