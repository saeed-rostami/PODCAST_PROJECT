<?php

namespace Modules\PodcastApp\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Modules\PodcastApp\Models\Episode;
use Modules\PodcastApp\Models\EpisodeFile;
use wapmorgan\Mp3Info\Mp3Info;

class EpisodeController extends Controller
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
    public function store(Request $request)
    {
        $user = Auth::user();

        $cover_file = $request->file('cover');
        $episode_file = $request->file('episode_file');



        $episode_cover_path = Storage::put('public/covers', $cover_file);

        DB::beginTransaction();
        try {

            $episode = Episode::query()
                ->create([
                    'title' => $request->title,
                    'description' => $request->description,
                    'season_id' => 1,
                    'cover' => $episode_cover_path,
                    "allow_share" => $request->allow_share,
                    "allow_comment" => $request->allow_comment,
                    "publish_at" => $request->publish_at ?? Carbon::now(),
                    "published_at" => $request->publish_at ?? null,
                ]);

            $episode_file_path = Storage::put('public/episodes', $episode_file);

            $audio = new Mp3Info($episode_file);

            EpisodeFile::query()
                ->create([
                    'episode_id' => $episode->id,
                    'file' => $episode_file_path,
                    'metas' => ['size' => $audio->_fileSize, 'duration' => floor($audio->duration)]
                ]);

            DB::commit();

            return $episode;

        } catch (\Throwable $throwable) {
            DB::rollBack();
            return $throwable->getMessage();
        }
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
    public function update(Request $request, $id)
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
