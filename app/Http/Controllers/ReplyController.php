<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReplyRequest;
use App\Http\Resources\ReplyResource;
use App\Models\Question;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReplyController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Question $question)
    {
        $replies = $question->replies()->get();
        if(empty($replies)){
            return $this->errorResponse('The question dose not reply');
        }
        return $this->successResponse(ReplyResource::collection($replies));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReplyRequest $request)
    {
        $inputs = $request->all();
        $inputs['user_id'] = 1;
        $reply = Reply::create($inputs);
        return $this->successResponse(new ReplyResource($reply));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reply = Reply::find($id);
        if(empty($reply)){
            return $this->errorResponse('The reply not found');
        }
        return $this->successResponse(new ReplyResource($reply));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReplyRequest $request, $id)
    {
        $reply = Reply::find($id);
        if(empty($reply)){
            return $this->errorResponse('The reqply not found');
        }
        $inputs = $request->all();
        $reply->update($inputs);
        return $this->successResponse(new ReplyResource($reply));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, $id)
    {
        $reply = Reply::find($id);
        if(empty($reply)){
            return $this->errorResponse('The reqply not found');
        }
        $reply->delete();
        return $this->successResponse($reply, 'The reply deleted');
    }
}
