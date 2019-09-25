<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Models\Banner;

class AdminBannersController extends Controller
{
    /**
	 * Display a listing of the banners.
	 *
	 * @return Response
	*/
	public function index()
	{
		$banners = Banner::orderBy('id','DESC')->paginate(20);

		return \View::make('admin.banner.index', ['banners' => $banners]);
	}
	
	/**
	 * Show the form for creating a new banners.
	 *
	 * @return Response
	*/
	public function create()
	{
		return \View::make('admin.banner.create');
	}
	
	/**
	 * Store a newly created Banner in storage.
	 *
	 * @return Response
	*/
	public function store(Request $request)
	{
			$this->validate($request, [
		    'banner_title'=>'required',
		    'banner_image'=>'required',
		  	
			]); 
			$banner = new Banner;
			$banner->banner_title   = $request->banner_title;
			$banner->banner_url =  $request->banner_image;
			$banner->page_type =  implode(',',$request->page_type);
			
			$save = $banner->save();
			
			
			
			if($save){
				 return redirect()->route('admin.banners.index')
						->with('success','Banner created Successfully');
			}else{
				
				 return redirect()->route('admin.banners.create')
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
		$banner = Banner::find($id);
	//	print_r($banner);exit;
		//$url = config('medias.url');

		return \View::make('admin.banner.edit', [ 'banner' => $banner ]);
	}
	
	/**
	 * Update the specified banner in storage.
	 *
	 * @param  int  $id
	 * @return Response
	*/
	public function update(Request $request,$id)
	{
			$this->validate($request, [
		    'banner_title'=>'required',
		    'banner_image'=>'required',
		  	
			]); 
			
			$banner = Banner::find($id);
			$banner->banner_title   = $request->banner_title;
			$banner->banner_url =  $request->banner_image;
			$banner->page_type =  implode(',',$request->page_type);
			$save = $banner->save();

		if($save){
			 return redirect()->route('admin.banners.index')
						->with('success','Banner Updated Successfully');
				
			}else{
				return redirect()->route('admin.banners.index')
						->with('error','Something went wrong');
			}
	}
	
	/**
	 * Remove the specified banner from storage.
	 *
	 * @param  int  $id
	 * @return Response
	*/
	public function destroy($id)
	{
		
		$banner = Banner::destroy($id);
		return Redirect::to('/admin/banners/list');
	}

}
