<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Influencer;
use App\Models\Channel;


class InfluencersController extends Controller
{
    //
    	public function __construct()
    {
        $this->middleware('auth');
      
    }

    public function add_influencers()
    {
      
        return view('admin.influencers.create');
    }
     public function store(Request $request)
    {
    	$this->validate($request, [
		    'title'=>'required',
            'channel'=>'required',
				
			]);
           //$slug=preg_replace('/[^A-Za-z0-9-]+/', '-', trim($request->title));
    	 $influencer= new Influencer;
    	$influencer->title =  $request->title;
    	$influencer->description =  $request->description;
    	$influencer->logo =  $request->logo;
        $influencer->description_image =  $request->description_image;
    	$influencer->site_url =  $request->site_url;
    	$influencer->youtube_channel_url =  $request->youtube_channel_url;
       $influencer->channels_id =  implode(',', $request->channel);
        $influencer->slug = $this->createSlug($request->title);
    	$influencer->subscription_custom_url =  $request->subscription_custom_url;
    	$influencer->save();
    	return redirect()->route('admin.influencers.add')
            ->with('success','Influencers is added successfully.');
    }

      public function index(Request $request)
    {
    	 $influencer = Influencer::orderBy('id', 'desc')->Paginate(40);
        return view('admin.influencers.index')->with('influencer', $influencer); 
    
    }  

public function destroy($id)
    {
    $influencer = Influencer::find($id);
        $delete = Influencer::destroy($id);
       //  DB::delete('delete videos_captions where vid_id = ?',[$id]);
    
    if($delete){
      
      return redirect()->route('admin.influencers')
            ->with('success','Influencer is delete successfully.');
    }else{
      return redirect()->route('admin.influencers')
            ->with('success','Influencer is not delete please try again !!!.');
    }
    }
  public function show($id)
    {  
	     
        $influencer = Influencer::findOrFail($id);
		
        return view('admin.influencers.show',compact('influencer')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	
       $influencer = Influencer::findOrFail($id);
	  
	   
       return view('admin.influencers.edit',compact('influencer')); 
    }


     public function update(Request $request, $id)
    {
		$this->validate($request, [
		   'title'=>'required',
            'channel'=>'required',				
			]);
		
        $influencer = Influencer::findOrFail($id);
		$influencer->title =  $request->title;
    	$influencer->description =  $request->description;
    	$influencer->logo =  $request->logo;
        $influencer->description_image =  $request->description_image;
    	$influencer->site_url =  $request->site_url;
    	$influencer->youtube_channel_url =  $request->youtube_channel_url;
        $influencer->channels_id =  implode(',', $request->channel);
    	$influencer->subscription_custom_url =  $request->subscription_custom_url;
    	$influencer->save();
		
		
		return redirect()->route('admin.influencers')
						->with('success','User update successfully');
    }

    public function channel_find(Request $request){


    	$term = trim($request->q);

        if (empty($term)) {
            return \Response::json([]);
        }

        $channels = Channel::select("id","channel_name")
            		->where('channel_name','LIKE',"%$term%")->limit(5)->get();

        $formatted_channels = [];

        foreach ($channels as $channel) {
            $formatted_channels[] = ['id' => $channel->id, 'text' => $channel->channel_name];
        }

        return \Response::json($formatted_channels);

    }



       //For Generating Unique Slug Our Custom function
    public function createSlug($title, $id = 0)
    {
        // Normalize the title
        $slug = str_slug($title);
        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        // If we haven't used it before then we are all good.
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }
        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }
        throw new \Exception('Can not create a unique slug');
    }

    protected function getRelatedSlugs($slug, $id = 0)
    {
        return Influencer::select('slug')->where('slug', 'like', $slug.'%')
        ->where('id', '<>', $id)
        ->get();
    }


}
