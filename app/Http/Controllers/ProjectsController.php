<?php

namespace App\Http\Controllers;

use App\Models\projects;
use Illuminate\Http\Request;
use Validator;

class ProjectsController extends Controller
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
        $projects = Projects::sortable()->paginate(5);
        return response()->json(["Projects" => $projects], 200);
    
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
        // dd("project");
        $validator = Validator::make($request->all(), [
            'project_name' => 'required|string|between:2,100',
            'category' => 'required|string|between:2,100',
            'dateStart' => 'required|date',
            'dateEnd' => 'required|date',
            'project_manager' => 'required|string',
            'status' => 'required|string',
            'description' => 'required|string',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $project = Projects::create(
            $validator->validated(),
        );
        return response()->json([
            'message' => 'Project successfully registered',
            'project' => $project
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\projects  $projects
     * @return \Illuminate\Http\Response
     */
    public function show(projects $projects, $id)
    {
        //
        $project = Projects::find($id);
        // dd($project);
        return response()->json(["Project" => $project], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\projects  $projects
     * @return \Illuminate\Http\Response
     */
    public function edit(projects $projects)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\projects  $projects
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'project_name' => 'required|string|between:2,100',
            'category' => 'required|string|between:2,100',
            'dateStart' => 'required|date',
            'dateEnd' => 'required|date',
            'project_manager' => 'required|string',
            'status' => 'required|string',
            'description' => 'required|string',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $project = Projects::whereId($id)->update(
            $validator->validated(),
        );
        return response()->json([
            'message' => 'Project successfully updated',
            'project' => $project
        ], 201);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\projects  $projects
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $project = Projects::destroy($id);
        return response()->json([
            "message" => "Project has been deleted successfully",
        ],201);
    }

    /**
     * 
     * 
     * 
     */
    public function project_filtring(Request $request)
    {
        //
        $filter = $request->all();
        if (!empty($filter)) {
            $projects = Projects::sortable()->where('project_name','like', '%'.$filter.'%')->paginate(5);
            
        }else{

            $projects = Projects::sortable()->paginate(5);
        }
        return response()->json(["Projects" => $projects], 200);
    }
}
