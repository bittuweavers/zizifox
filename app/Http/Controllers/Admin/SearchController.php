<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SearchResult;

class SearchController extends Controller
{

	public function index(Request $request)
    {
   		           if(isset($_GET['status'])){

                $status = $_GET['status'];
                if($status =='0' || $status=='1'){
                  $search_result = SearchResult::orderBy('search_date', 'desc')->orWhere('search_found_status',$status)->Paginate(40);
                  $search_result->appends(['status' => $status]);
                 
                }else{
                   $search_result = SearchResult::orderBy('search_date', 'desc')->Paginate(40);
                }
              }else{

                 $search_result = SearchResult::orderBy('search_date', 'desc')->Paginate(40);
              }
         
        return view('admin.search.index')->with('search_result', $search_result); 
    }

    public function destroy($id)
    {
    $search_result = SearchResult::find($id);
        $delete = SearchResult::destroy($id);
    
    if($delete){
      
      return redirect()->route('admin.search')
            ->with('success','Search Log is delete successfully.');
    }else{
      return redirect()->route('admin.search')
            ->with('success','Search Log is not delete please try again !!!.');
    }
    }
}
