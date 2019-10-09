<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Language;


class AdminLanguageController extends Controller
{
    //
    	public function __construct()
    {
        $this->middleware('auth');
      
    }

    public function add_languages()
    {
      
        return view('admin.languages.create');
    }
     public function store(Request $request)
    {
    	$this->validate($request, [
		    'lang_name'=>'required|unique:languages',
            'lang_code'=>'required',
				
			]);
           //$slug=preg_replace('/[^A-Za-z0-9-]+/', '-', trim($request->title));
    	 $language= new Language;
    	$language->lang_name =  $request->lang_name;
        $language->lang_code =  $request->lang_code;
    	
    	$language->save();
    	return redirect()->route('admin.languages.add')
            ->with('success','Languages is added successfully.');
    }

      public function index(Request $request)
    {
    	 $language = Language::orderBy('id', 'Asc')->Paginate(40);
        return view('admin.languages.index')->with('language', $language); 
    
    }  

public function destroy($id)
    {
    $language = Language::find($id);
    $delete = Language::destroy($id);
     
    
    if($delete){
      
      return redirect()->route('admin.languages')
            ->with('success','Language is delete successfully.');
    }else{
      return redirect()->route('admin.languages')
            ->with('success','Language is not delete please try again !!!.');
    }
    }

    public function edit($id)
    {
	
       $language = Language::findOrFail($id);
	  
	   
       return view('admin.languages.edit',compact('language')); 
    }


     public function update(Request $request, $id)
    {
		$this->validate($request, [
		  'lang_name'=>'required',
          'lang_code'=>'required',			
			]);
		
        $language = Language::findOrFail($id);
		$language->lang_name =  $request->lang_name;
        $language->lang_code =  $request->lang_code; 
    	$language->save();
		
		
		return redirect()->route('admin.languages')
						->with('success','User update successfully');
    }

    public function changeStatus(Request $request){

      $id = $request->id;
      $languages = Language::findOrFail($id);
     $status = $languages->status ;
     if($status=='1'){
      $language_status =0;
      $text = "Enable";
     }else{
      $language_status =1;
      $text = "Disable";
     }

     $languages->status =  $language_status;
      $languages->save();
      echo $text;

    }
}
