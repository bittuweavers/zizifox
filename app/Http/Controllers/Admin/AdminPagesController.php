<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Models\Page;
use App\Helpers\MyPages;
use App\Services\Slug;
use Session;
use Auth;
class AdminPagesController extends Controller
{	

    /**
	 * Display a listing of the pages.
	 *
	 * @return Response
	*/
	public function index()
	{
		$pages = Page::orderBy('id','DESC')->paginate(20);

		return \View::make('admin.page.index', ['pages' => $pages]);
	}
	
	/**
	 * Show the form for creating a new pages.
	 *
	 * @return Response
	*/
	public function create()
	{
		return \View::make('admin.page.create');
	}
	
	/**
	 * Store a newly created Page in storage.
	 *
	 * @return Response
	*/
	public function store(Request $request)
	{
		
		$this->validate($request, [
		    'title'=>'required',
		    'page_slug'=>'required|unique:pages,page_slug',
		    'content'=>'required',		
			]); 
      
		$page = new Page;

			$page->page_title   = $request->page_title;
			$page->page_content = $request->page_content;
			$page->page_slug    = $request->page_slug;
			
			$save = $page->save();
			
			
			
			if($save){
				 return redirect()->route('admin.pages.index')
						->with('success','Page created Successfully');
			}else{
				
				 return redirect()->route('admin.pages.create')
						->with('error','Something went wrong');
			}

		
	}
	
	/**
	 * Show the form for editing the specified client.
	 *
	 * @param  int  $id
	 * @return Response
	*/
	public function edit($id)
	{
		$page = Page::find($id);
	//	print_r($page);exit;
		//$url = config('medias.url');

		return \View::make('admin.page.edit', [ 'page' => $page ]);
	}
	
	/**
	 * Update the specified page in storage.
	 *
	 * @param  int  $id
	 * @return Response
	*/
	public function update(Request $request,$id)
	{
		$this->validate($request, [
		    'title'=>'required',
		    'page_slug'=>'required',
		    'content'=>'required',		
			]); 
			
		$page = Page::find($id);

		$page->title   = $request->title;
		$page->content = $request->content;
		$page->banner_image = $request->banner_image;
		//$page->page_slug    = Slug::createSlug($request->page_slug,'page',$id);
		$save = $page->save();
		if($save){
			 return redirect()->route('admin.pages.index')
						->with('success','Page Updated Successfully');
				
			}else{
				return redirect()->route('admin.pages.index')
						->with('error','Something went wrong');
			}
	}
	
	/**
	 * Remove the specified page from storage.
	 *
	 * @param  int  $id
	 * @return Response
	*/
	public function destroy($id)
	{
		$page = Page::destroy($id);
		return Redirect::to('/admin/pages/list');
	}

}
