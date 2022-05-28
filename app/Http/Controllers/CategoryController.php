<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return $this->successResponse(CategoryResource::collection($categories));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|string'
        ])->validate();
        $category = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        return $this->successResponse(new CategoryResource($category));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->first();
        if(empty($category)){
            return $this->errorResponse('The category not found', 404);
        }
        return $this->successResponse(new CategoryResource($category));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|string'
        ])->validate();

        $category = Category::find($id);
        if(empty($category)){
            return $this->errorResponse('The category not found', 404);
        }
        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        return $this->successResponse(new CategoryResource($category));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if(empty($category)){
            return $this->errorResponse('The category not found', 404);
        }

        $category->delete();
        return $this->successResponse([], 'The category deleted');
    }
}
