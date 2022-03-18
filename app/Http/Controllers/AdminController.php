<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\podcast;
use App\Models\podcastAuthor;

class AdminController extends Controller
{
    public function podcastForm($id=null)
    {
        if(isset($id)){
            $podcast=podcast::with('podcastAuthor')->find($id);
            // dd($podcast->podcastAuthor);
            return view('admin.dishboard.podcastForm',compact('podcast'));
        }
        return view('admin.dishboard.podcastForm');
    }
}
