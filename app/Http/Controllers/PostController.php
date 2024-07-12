<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SubscribeMailJob;
use Validator;
use App\Models\Post;
use App\Models\Subscribers;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $allPost = Post::join('websites','posts.website_id','=','websites.id')->get();
        return response()->json($allPost,201);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $Validator = Validator::make($request->all(),[
            'title'=>'required|string',
            'website_id'=>'required|exists:websites,id',
            'body'=>'required|string'
        ]);

        if($Validator->fails()){
            return response()->json(['errors'=>$Validator->errors()],422);
        }
       
        $postCreated = Post::create($request->all());

        $allsubscribers = Subscribers::join('websites','subscribers.website_id','=','websites.id')->where('subscribers.website_id',$request->website_id)->get();
       
        SubscribeMailJob::dispatch($allsubscribers,$postCreated);

        return response()->json($postCreated,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
