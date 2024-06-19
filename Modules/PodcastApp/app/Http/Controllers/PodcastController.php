<?php

namespace Modules\PodcastApp\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Modules\PodcastApp\Models\Podcast;

class PodcastController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('podcastapp::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('podcastapp::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $cover_file = $request->file('cover');

        $podcast_cover_path = Storage::put('public/covers', $cover_file);

      return Podcast::query()
            ->create([
                'title' => $request->title,
                'user_id' => $user->id,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'cover' => $podcast_cover_path,
                "allow_share" => $request->allow_share,
                "allow_comment" => $request->allow_comment,
                "financial_status" => $request->financial_status,
            ]);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('podcastapp::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('podcastapp::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
