<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use Auth;
use PDF;

class PdfController extends Controller
{
    function downloadPdf(){
        $contacts=new Contact();
        $user= Auth::user();
        $data=$user->contacts()->get()->all();
        $pdf = PDF::loadView('contact.contactpdf',compact('data'));
        return $pdf->download('contacts.pdf');
    }
}
