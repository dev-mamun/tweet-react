<?php

namespace App\Http\Controllers;

use App\Http\Requests\TweetRequest;
use App\Models\Tweet;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Tweet/Index', [
            'tweets' => Tweet::with('user:id,name')->latest()->get(),
        ]);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(TweetRequest $request)
    {
        $validated = $request->validated();
        $request->user()->tweets()->create($validated);
        return redirect(route('tweet.index'));  
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Tweet $tweet
     * @return \Illuminate\Http\Response
     */
    public function show(Tweet $tweet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Tweet $tweet
     * @return \Illuminate\Http\Response
     */
    public function edit(Tweet $tweet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Tweet $tweet
     * @return \Illuminate\Http\Response
     */
    public function update(TweetRequest $request, Tweet $tweet)
    {
        $this->authorize('update', $tweet);
        $validated = $request->validated();
        $tweet->update($validated);
        return redirect(route('tweet.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Tweet $tweet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tweet $tweet)
    {
        $this->authorize('delete', $tweet);
        $tweet->delete();
        return redirect(route('tweet.index'));
    }
}
