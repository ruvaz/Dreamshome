<?php

namespace App\Http\Controllers;

//use App\Http\Requests;
use Illuminate\Http\Request;
use App\Repositories\AdRepository;
use App\Http\Requests\AdRequest;
use App\Ad;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AdController extends Controller
{
    protected $ads;  //repository

    public function __construct(AdRepository $ads)
    {
        $this->ads = $ads;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$ads=Ad::where('user_id',$request->user()->id)->get();
        //$ads=Ad::all();//pada todos sin repos
        //return view('ads.index',compact('ads'));  //sin repos
        $ads = $this->ads->forUser($request->user());  //usando Repository

        return view('ads.index', ['ads' => $ads]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ads.create');
    }


    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdRequest $request)
    {
        $request->user()->ads()->create([
            'title' => $request->title,
            'body' => $request->body
        ]);

        return redirect()->route('ads.show', $request->id)->with('success', "Anuncio guardado");
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ad = Ad::findOrFail($id);

//        if (Auth::user()->can('update',$ad)){
//            return "puede actualizar";
//        }else{
//            return "no puede actualizar";
//        }
        $this->authorize('owner', $ad); //permitir o no ver el request

        return $ad;

    }

    /**
     * Editar AD
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id) //metodo viejo  ID
    {
        $ad = Ad::findOrFail($id);  //old method

        $this->authorize('owner', $ad);  //policy para validar si es el propietario del anuncio a editar

        return view('ads.edit', ['ad' => $ad]);

    }

    /**
     * ACtualizar AD
     * @param AdRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function update(AdRequest $request, $id)
    {

        $ad = Ad::findOrFail($id);

        $this->authorize('owner', $ad); //valido con politicas si esta autorizado a modificar este ad

        $ad->update($request->all());
        $ad->save();
        return redirect('/ads')->with('success', 'Anuncio Actualizado correctamete');
    }

    /**
     * Remove the specified resource from storage.
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ad = Ad::findOrFail($id);

        $this->authorize('owner', $ad);

        $ad->delete();
        return redirect('/ads')->with('success', 'Eliminado correctamente');
    }
}
