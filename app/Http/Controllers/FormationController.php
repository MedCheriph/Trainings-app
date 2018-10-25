<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Formation;
use App\Promotion;
use Auth;

class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formations = Formation::all();
        return view('formation.index', compact('formations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()['type'] == 'admin') {
            return view('formation.create');
        } else {
            $formations = Formation::all();
            return view('formation.index', compact('formations'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'code_formation'     => 'required',
            'intitule_formation' => 'required',
            'duree_formation'    => 'required',
            'prix_formation'     => 'required'
        ]);
        $formation = new Formation([
            'code_formation'     => $request->get('code_formation'),
            'intitule_formation' => $request->get('intitule_formation'),
            'duree_formation'    => $request->get('duree_formation'),
            'objectif'           => $request->get('objectif'),
            'prerequis'          => $request->get('prerequis'),
            'deb_pro'            => $request->get('deb_pro'),
            'prix_formation'     => $request->get('prix_formation')
        ]);
        
        $formation->save();
        return redirect()->route('formation.index')->with('success', 'Formation ajoutée!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {  
        $today = date("Y-m-d");
        $formation = Formation::find($id);
        $sessions = Promotion::where('id_formation', '=', $id)
                             ->where('date_lancement', '>', $today)
                             ->get();
        $promotions = Promotion::where('id_formation', '=', $id)
                               ->where('date_fin', '>', $today)
                               ->get();
        return view('formation.show', compact('formation', 'sessions', 'promotions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()['type'] == 'admin') {
            $formation = Formation::find($id);
            return view('formation.edit', compact('formation', 'id'));
        } else {
            $formations = Formation::all();
            return view('formation.index', compact('formations'));
        }
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
        $this->validate($request, [
            'code_formation'     => 'required',
            'intitule_formation' => 'required',
            'prix_formation'     => 'required',
            'duree_formation'    => 'required',
            'objectif',
            'prerequis',
            'deb_pro', 
        ]);

        $formation = Formation::find($id);
        $formation->code_formation = $request->get('code_formation');
        $formation->intitule_formation = $request->get('intitule_formation');
        $formation->prix_formation = $request->get('prix_formation');
        $formation->duree_formation = $request->get('duree_formation');
        
        $formation->objectif = $request->get('objectif');
        $formation->prerequis = $request->get('prerequis');
        $formation->deb_pro = $request->get('deb_pro');

        $formation->save();
        return redirect()->route('formation.index')->with('success', 'Formation Modifiée!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $formation = Formation::find($id);
        $formation->delete();
        return redirect()->route('formation.index')->with('success', 'Formation Supprimée!');
    }
}
