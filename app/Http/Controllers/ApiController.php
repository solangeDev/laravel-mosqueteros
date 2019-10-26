<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        try {
            $objContact = new \App\Contact();
            $objContact->name = $request->name;
            $objContact->email = $request->email;
            $objContact->birthday = $request->birthday;
            $objContact->user_id = $request->user_id;
            if($objContact->save()){
                return response()->json( [ 'msg'=>"success", 'data' => $objContact ],200); 
            }
            
        } catch (\Throwable $ex) {
            \Log::error('Error al guardar el contacto LINE: '.$ex->getLine().' FILE: '.$ex->getFile().'Message: '.$ex->getMessage());
            return response()->json( [ 'msg' => $ex->getMessage()],500);   
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
       try {
        $objContact = new \App\Contact(); //instancia objeto
        $objContact = $objContact::find($id); //conslta
        return response()->json( [ 'msg'=>"success", 'data' => $objContact ],200); // renderiza el objeto en forma e json y tiene el codigo http de la respuesta 
       } catch (\Throwable $th) {
           //si ocurre un error mostrar el la excecion n formato jon on e codigo http de la operación
        return response()->json( [ 'msg'=>"error", 'data' => $th->getMessage() ],500);
       }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
