<?php

namespace App\Http\Controllers\Forntend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Models\Page;

class ForntendPageController extends Controller
{
	

	public function page_show(Request $request)
	{
		$slug = request()->segment(1);
		$page =Page::where('page_slug', '=', $slug)->first();
		return \View::make('forntend.inner_page', [ 'page' => $page ]);
		
	}



}
