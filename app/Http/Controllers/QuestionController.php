<?php

namespace App\Http\Controllers;
use App\Models\Question;
use App\Models\Categorie;
use App\Models\Quiz;
use App\Models\Reponse;
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
        $questions = Question::with('reponses')->get();
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
        //dd($request);

        $request->validate([
            'intitule'=>'required',
            'reponse'=>'required',
            'quiz_id'=>'required',
            'categorie_id'=>'required'
        ]);

        $question = new Question();
        $question->intitule = $request->get('intitule');
        $question->reponse = $request->get('reponse');
        $question->quiz_id = $request->get('quiz_id');
        $question->categorie_id = $request->get('categorie_id');
        $question->points = $request->get('points');
        $question->media = $request->get('media');
        $question->save();
        
        //$question_id = DB::getPdo()->lastInsertId();
        $count = count($request->get('reponse_id'));    
        for($i = 0; $i < $count; ++$i){
            $reponse = new Reponse();
            $reponse->question_id = $question->id;
            $reponse->libelle = $request->libelle[$i];
            $reponse->correcte = $request->correcte[$i];
            $reponse->save();
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
        $question = Question::with('reponses')->find($id);
        $quizs = Quiz::all(['libelle','id']);
        $categories = Categorie::all(['libelle','id']);
        return view('questions.edit', compact('question','categories','quizs'));
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
            'categorie_id'=>'required'
        ]);

        $question = Question::find($id);
        $question->intitule = $request->get('intitule');
        $question->reponse = $request->get('reponse');
        $question->quiz_id = $request->get('quiz_id');
        $question->categorie_id = $request->get('categorie_id');
        $question->points = $request->get('points');
        $question->media = $request->get('media');
        $question->save();

        $count = count($request->get('reponse_id'));    
        
        $question->reponses()->delete();

        for($i = 0; $i < $count; ++$i){
            $reponse = new Reponse();
            $reponse->quiz_id = $question->quiz_id;
            $reponse->question_id = $question->id;
            $reponse->libelle = $request->libelle[$i];
            $reponse->correcte = $request->correcte[$i];
            $reponse->save();
        }

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
