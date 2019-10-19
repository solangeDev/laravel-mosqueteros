<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Mail;
use \App\Mail\mailContact;

//use Auth;

class ContactController extends Controller
{
    
    public function sendMail($objContact){
        
        Mail::to($objContact->email,$objContact->name)->send(new mailContact($objContact));
    }
    
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
        $data=(object) array(
            "route"=>"contact_save",
            "user"=>array()
        );
        return view("contact.form",["data"=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //ContactRequest $request
    public function store(ContactRequest $request)
    {
        
        try {
           
            $request->validate([
                "name"=>"required",
                "email"=>"required|email",
                "date" => "required"
           ]);
           //$request->session()->flush();
           //variables de session
           /*\Session::put("hola","mundo");
           $request->session()->put("hola","hola");*/
           $objContact = new Contact();
           $user_id = \Auth::user()->id; //id usuario session
           $objContact->name = $request->name;
           $objContact->email = $request->email;
           $objContact->birthday = $request->date;
           $objContact->user_id = $user_id;
           //Query Builder
           /*$objContact->insert([
            "name"=>$request->name,
            "email"=>$request->email,
            "birthday"=>$request->date,
            "user_id"=>$user_id
           ]);*/
           if($request->picture){
            $name_file = $this->saveFile($request->picture);
            if(!$name_file){
                \Session::flash("msj","Error cargando la imagen");
                \Session::flash("error","alert-danger");
                return redirect()->back();
            }else{
                $objContact->image = $name_file;
            }
           }
           if($objContact->save()){
            $this->sendMail($objContact);
            \Session::flash("msj","Guardado con exito");
            \Session::flash("error","alert-success");
            return redirect()->back();
           }
        } catch (\Throwable $th) {
            \Session::flash("msj",$th->getMessage());
            \Session::flash("error","alert-danger");
            return redirect()->back();
        }     

    }

    public function saveFile($file){
        $name_file=time().'_'.$file->getClientOriginalName(); 
        if(\Storage::disk('contacts')->put($name_file,file_get_contents($file->getRealPath()))){
            return $name_file;
        }else{
            return false;
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
        $objContact = new Contact();
        $contact = $objContact::where("id",$id)->get()->all();
        $data=(object) array(
            "route"=>"contact_update",
            "user"=>(!empty($contact))?$contact[0]:$contact
        );
        return view("contact.form",["data"=>$data]);
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
      try {
        $objContact = new Contact();
        $objContact = $objContact::findOrFail($id);
        $objContact->name = $request->name;
        $objContact->email = $request->email;
        $objContact->birthday = $request->date;
        if(!empty($request->picture)){
            if($objContact->image){
                try {
                    $this->deleteImg($objContact->image);
                } catch (\Throwable $th) {
                    \Session::flash("msj",$th->getMessage());
                    \Session::flash("error","alert-danger");
                    return redirect()->back();
                }
            }
            try {
                $name_file = $this->saveFile($request->picture);
                $objContact->image = $name_file;
            } catch (\Throwable $th) {
                \Session::flash("msj","Error cargando la imagen");
                \Session::flash("error","alert-danger");
                return redirect()->back();
            }
        }
        if($objContact->save()){
             \Session::flash("msj","Guardado con exito");
             \Session::flash("error","alert-success");
             return redirect()->back();
        }
      } catch (\Throwable $th) {
        \Session::flash("msj",$th->getMessage());
        \Session::flash("error","alert-danger");
        return redirect()->back();
      }
    }

    public function deleteImg($nombre_imagen){
        if(\Storage::disk('contacts')->delete($nombre_imagen)){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       try {
        $objContact = new Contact();
        $objContact = $objContact::find($id);
        if(!empty($objContact->image)){
         try {
             $this->deleteImg($objContact->image);
         } catch (\Throwable $th) {
             \Session::flash("msj",$th->getMessage());
             \Session::flash("error","alert-danger");
             return redirect()->back();
         }
        }
        if($objContact->delete()){
         \Session::flash("msj","Eliminado con exito");
         \Session::flash("error","alert-success");
         return redirect()->back();
        }
       } catch (\Throwable $th) {
        \Session::flash("msj",$th->getMessage());
        \Log::error("eliminar registro".' '.$th->getMessage());
        \Session::flash("error","alert-danger");
        return redirect()->back();
       }
       
    }
}
