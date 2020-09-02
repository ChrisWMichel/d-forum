<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {

        return QuestionResource::collection(Question::where('category_id', $request->id)->get());

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request)
    {
         //auth()->user()->questions()->create($request->all());
       $question = Question::create($request->all());
        return \response(new QuestionResource($question), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     */
    public function show(Question $question)
    {
        return new QuestionResource($question);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $question->update($request->all());
        return \response(new QuestionResource($question), Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
