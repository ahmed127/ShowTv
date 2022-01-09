<?php

namespace App\Http\Controllers\AdminPanel;

use App\Models\Show;
use App\Models\Episode;
use App\Models\ShowTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Show $show)
    {
        $query = Episode::query();

        if(request()->filled('type')){
            $query->where('type', $request->type);
        }

        if(request()->filled('title')){
            $query->where('title', $request->title);
        }

        if(request()->filled('price')){
            $query->where('price', $request->price);
        }

        if(request()->filled('status')){
            $query->where('status', $request->status);
        }

        $data['episodes'] = $query->where('show_id', $show->id)
        ->latest()
        ->withCount('likes', 'dislikes')
        ->paginate($request->pagination??5);

        $data['show'] = $show;

        return view('adminPanel.episodes.index' , $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Show $show)
    {
        return view('adminPanel.episodes.create', compact('show'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Show $show)
    {
        $inputs = $request->validate([
            'title'         => 'required',
            'description'   => 'required',
            'day'           => 'required',
            'hour'          => 'required',
            'thumbnail'     => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'video'         => 'required|file|mimes:mp4|max:2048',
        ]);

        $getID3 = new \getID3;
        $file = $getID3->analyze($request->video);
        $inputs['duration'] = date('H:i:s', $file['playtime_seconds']);
        $inputs['show_id'] = $show->id;
        $episode = Episode::create($inputs);

        ShowTime::updateOrCreate([
            'show_id'   => $show->id,
            'day'       => $episode->day,
            'hour'      => $episode->hour
        ]);
        return redirect()->route('adminPanel.shows.episodes.index', $show->id)->with(['successMessage' => 'Created Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['episode'] = Episode::find($id);
        if(empty($data['episode'])){return back()->with(['errorMessage' => 'This episode not found']);}
        return view('adminPanel.episodes.show' , $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['episode'] = Episode::find($id);
        if(empty($data['episode'])){return back()->with(['errorMessage' => 'This episode not found']);}
        return view('adminPanel.episodes.edit' , $data);
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
         $inputs = $request->validate([
            'title'         => 'required',
            'description'   => 'required',
            'day'           => 'required',
            'hour'          => 'required',
            'thumbnail'     => 'image|mimes:jpeg,png,jpg|max:2048',
            'video'         => 'file|mimes:mp4|max:2048',
        ]);

        $episode = Episode::find($id);
        if(request()->filled('video')){
            $getID3 = new \getID3;
            $file = $getID3->analyze($request->video);
            $inputs['duration'] = date('H:i:s', $file['playtime_seconds']);
        }
        $inputs['show_id'] = $episode->show->id;

        if($episode->day != $request->day || $episode->hour != $request->hour){

            $showTime = ShowTime::where([
                'show_id'   => $episode->show_id,
                'day'       => $episode->day,
                'hour'      => $episode->hour
            ])->first();

            $showTime->update([
                'day'       => $request->day,
                'hour'      => $request->hour
            ]);
        }

        $episode->update($inputs);

        return redirect()->route('adminPanel.shows.episodes.index', $episode->show->id)->with(['successMessage' => 'Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $episode = Episode::find($id);
        if(empty($episode)){return back()->with(['errorMessage' => 'This episode not found']);}
        $episode->delete();

        return back()->with(['successMessage' => 'Deleted Successfully']);


    }
}
