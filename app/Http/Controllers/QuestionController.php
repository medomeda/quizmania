<?php

namespace App\Http\Controllers;
use App\Models\Question;
use App\Models\Categorie;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::with('reponses');
        return View('questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $quizs = Quiz::all(['libelle','id']);
        $categories = Categorie::all(['libelle','id']);
        return view('questions.create',compact('categories','quizs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);

        $request->validate([
            'intitule'=>'required',
            'reponse'=>'required',
            'quiz_id'=>'required',
            'categorie_id'=>'required',
            'points'=>'required',
        ]);

        $question = new Question();
       
        $question->intitule = $request->get('intitule');
        $question->reponse = $request->get('reponse');
        $question->quiz_id = $request->get('quiz_id');
        $question->categorie_id = $request->get('categorie_id');
        $question->points = $request->get('points');
        $question->media = $request->get('media');
        $question->save();

        // Go through all qty (that are related to the details, and create them)
        foreach ($postValues['qty'] as $qty) {
            $question->reponses()->create([ 
                'question_id' => $order->id,
                'quiz_id' => $question->quiz_id,
                'libelle' => $qty,
                'correcte' => $qty,
            ]);
        }
   
        return redirect()->route('questions.index')->with('success', 'Stock has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Categorie::find($id);
        return view('questions.edit', compact('question'));
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
        $request->validate([
            'intitule'=>'required',
            'reponse'=>'required',
            'quiz_id'=>'required',
            'categorie_id'=>'required',
            'points'=>'required',
        ]);

        $question = Question::find($id);
        $question->intitule = $request->get('intitule');
        $question->reponse = $request->get('reponse');
        $question->quiz_id = $request->get('quiz_id');
        $question->categorie_id = $request->get('categorie_id');
        $question->points = $request->get('points');
        $question->media = $request->get('media');
        $question->save();

        return redirect()->route('questions.index')->with('success', 'Stock has been updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
