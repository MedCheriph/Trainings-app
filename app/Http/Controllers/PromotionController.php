<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Promotion;
use App\Formation;
use Redirect;
use Auth;
use DB;



class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()['type'] == 'admin') {
            $promotions = DB::table('formations')
                ->join('promotions', 'formations.id', '=', 'promotions.id_formation')
                ->get();
            return view('promotion.index', compact('promotions'));
        } else {
            $formations = Formation::all();
            return view('formation.index', compact('formations'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()['type'] == 'admin') {
            $formations = Formation::all();
            return view('promotion.create', compact('formations'));
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
            'id_formation'      => 'required',
            'date_lancement'    => 'required|date|after:yesterday'
        ]);

        //récupérer le prix standard de la formation
        $id = $request->get('id_formation');
        
        $formation = Formation::find($id);
        $prix = $formation->prix_formation;

        $pourcentage = (int)$request->get('pourcentage');
        $prix_c = $prix-($prix*$pourcentage)/100;

        $promotion = new Promotion([
            'id_formation'      => $request->get('id_formation'),
            'date_lancement'    => $request->get('date_lancement'),
            'date_debut'        => $request->get('date_debut'),
            'date_fin'          => $request->get('date_fin'),
            'pourcentage'       => $request->get('pourcentage'),
            'prix_c'            => $prix_c
        ]);

        try 
        { 
            $promotion->save();
            return redirect()->route('promotion.index')->with('success', 'Session ajoutée!');
        } catch(QueryException $ex){ 
            return Redirect::back()->withErrors(['Cette promotion existe déja pour la même formation']);
        }
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
        if (Auth::user()['type'] == 'admin') {
            $promotion = DB::table('promotions')
                ->join('formations', 'formations.id', '=', 'promotions.id_formation')
                ->select('formations.intitule_formation', 'promotions.*')
                ->where('promotions.id','=',$id)
                ->get()
                ->toArray();
            return view('promotion.edit', compact('promotion','id'));
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
            'date_lancement'    => 'required|date|after:yesterday'
        ]);

        $id_formation = $request->get('id_formation');
        $formation = Formation::find($id_formation);
        $prix = $formation['prix_formation'];
        $pourcentage = (int)$request->get('pourcentage');
        $prix_c = $prix-($prix*$pourcentage)/100;

        $promotion = Promotion::find($id);
        $promotion->date_lancement = $request->get('date_lancement');
        $promotion->date_debut = $request->get('date_debut');
        $promotion->date_fin = $request->get('date_fin');
        $promotion->pourcentage = $pourcentage;
        $promotion->prix_c = $prix_c;

        $promotion->save();
        return redirect()->route('promotion.index')->with('success', 'Session Modifiée!');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $promotion = Promotion::find($id);
        $promotion->delete();
        return redirect()->route('promotion.index')->with('success', 'Promotion Supprimée!');    }
}
