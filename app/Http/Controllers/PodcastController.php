<?php

namespace App\Http\Controllers;

use App\Models\podcast;
use App\Models\podcastAuthor;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Auth;
use File;

class PodcastController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $podcasts=podcast::get();
        // dd($podcast->podcastAuthor);
        return view('admin.index',compact('podcasts'));
    }

    public function createPodcast(Request $request)
    {        
        // dd($request->all());
        $validator = Validator::make($request->all(),[
            'titel' => 'required',
            'desc' => 'required',
            'img' => 'required|dimensions:max_width=100,max_height=200|mimes:jpg,jpeg,png,|max:512000',
            'audio' => 'required|mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav|max:25000000'
           
        ]);
        if($validator->fails()){
                return redirect()->back()->withErrors( $validator->errors()->Messages());
        }
        $podcast=new podcast();
      
        $podcast->titel=$request->titel; 
         $podcast->desc=$request->desc;
         $podcast->save();
        if($request->hasFile('img')){
            $name=str_replace(" ","",$request->file('img')->getClientOriginalName());
          $path = $request->file('img')->storeAs('/podcasts/',$name,'public');
          $podcast->imgUrl= $path;
          $podcast->save();
        }
        if($request->hasFile('audio')){
          $name=str_replace(" ","",$request->file('audio')->getClientOriginalName());
            $path = $request->file('audio')->storeAs('/podcasts/',$name,'public');
            $podcast->audioUrl= $path;
            $podcast->save();
            // dd($podcast);
            podcastAuthor::create([
                'user_id'=>Auth::user()->id,
                'podcast_id'=>$podcast->id,
                'comment'=>"create"
            ]);
            // Auth::user()->ownPodcast()->save($podcast);
          }

          return redirect()->route('podcast.form.view',$podcast->id)->withSuccess( 'podcast created successfully');

    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\podcast  $podcast
     * @return \Illuminate\Http\Response
     */
    public function updatePodcast(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "podcast_id" =>"required|integer|exists:podcasts,id",
            'titel' => 'required',
            'desc' => 'required',
            'img' => 'nullable|dimensions:max_width=100,max_height=200|mimes:jpg,jpeg,png|max:512000',
            'audio' => 'nullable|mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav|max:25000000'
           
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors( $validator->errors()->Messages());
       }
       $podcast=podcast::find($request->podcast_id);
       $podcast->titel=$request->titel; 
       $podcast->desc=$request->desc;
       $podcast->save();

       if($request->hasFile('img')){
        $this->deletFile($podcast->imgUrl);
        $name=str_replace(" ","",$request->file('img')->getClientOriginalName());
      $path = $request->file('img')->storeAs('/podcasts/'.$podcast->id,$name,'public');
      $podcast->imgUrl= $path;
      $podcast->save();
    }
       if($request->hasFile('audio')){
        $this->deletFile($podcast->audioUrl);
        $name=str_replace(" ","",$request->file('audio')->getClientOriginalName());
          $path = $request->file('audio')->storeAs('/podcasts/'.$podcast->id,$name,'public');
          $podcast->audioUrl= $path;
          $podcast->save();
          // dd($podcast);
      
    }  
      podcastAuthor::create([
              'user_id'=>Auth::user()->id,
              'podcast_id'=>$podcast->id,
              'comment'=>"update"
          ]);
    return redirect()->back()->withSuccess( 'podcast updated successfully');
}
public function deletePodcast($id){
    //
    $podcast=podcast::findOrFail($id);
     $this->deletFile($podcast->audioUrl);$this->deletFile($podcast->imgUrl); 
    $podcast->delete();
   
    return redirect()->back()->withSuccess( 'podcast Delete successfully');

}
    public function deletFile($path)
    {
        $publicImagePath = storage_path('app/public/'.$path);  // Value is not URL but directory file path
        if(File::exists($publicImagePath)) {
            File::delete($publicImagePath);
            return true;
        }
        return false;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\podcast  $podcast
     * @return \Illuminate\Http\Response
     */
    public function show(podcast $podcast)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\podcast  $podcast
     * @return \Illuminate\Http\Response
     */
    public function edit(podcast $podcast)
    {
        //
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\podcast  $podcast
     * @return \Illuminate\Http\Response
     */
    public function destroy(podcast $podcast)
    {
        //
    }
}
