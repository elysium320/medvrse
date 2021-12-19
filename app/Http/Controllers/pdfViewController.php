<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pdfViewController extends Controller
{
    //
    public function index($id){
    	try{
    		if(file_exists('./uploads/'.$id.'.pdf')){
				return response()->file('./uploads/'.$id.'.pdf');
    		}
    		else{
    			abort(404);
    		}
    	}
    	catch(Throwable $e){
    		abort(404);
    	}
    }
}
