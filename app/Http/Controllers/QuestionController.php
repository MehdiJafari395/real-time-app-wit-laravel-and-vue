<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use Illuminate\Support\Str;

class QuestionController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::all();
        return $this->successResponse(QuestionResource::collection($questions));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request)
    {
        $inputs = $request->all();
        $inputs['slug'] = Str::slug($inputs['title']);

        $question = Question::create($inputs);
        return $this->successResponse(new QuestionResource($question), 'The new question created', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::find($id);

        if(empty($question)){
            return $this->errorResponse('The question not found', 404);
        }

        return $this->successResponse(new QuestionResource($question));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionRequest $request, $slug)
    {
        $question = Question::where('slug', $slug)->first();
        if(empty($question)){
            return $this->errorResponse('The question not found', 404);
        }

        $inputs = $request->all();
        if($request->title){
            $inputs['slug'] = Str::slug($inputs['title']);
        }
        $question->update($inputs);
        return $this->successResponse(new QuestionResource($question), 'The question updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $question = Question::where('slug', $slug)->first();
        if(empty($question)){
            return $this->errorResponse('The question not found', 404);
        }

        $question->delete();
        return $this->successResponse([], 'The question deleted');
    }
}
