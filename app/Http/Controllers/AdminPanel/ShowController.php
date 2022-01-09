<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\Show;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Show::query();

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

        $data['shows'] = $query->withCount('episodes', 'followers')->latest()->paginate($request->pagination??5);
        return view('adminPanel.shows.index' , $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminPanel.shows.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->validate([
            'type'          => 'required',
            'title'         => 'required',
            'description'   => 'required',
            'price'         => 'required',
            'status'        => 'required',
        ]);
        Show::create($inputs);

        return redirect()->route('adminPanel.shows.index')->with(['successMessage' => 'Created Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['show'] = Show::find($id);
        if(empty($data['show'])){return back()->with(['errorMessage' => 'This show not found']);}
        return view('adminPanel.shows.show' , $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['show'] = Show::find($id);
        if(empty($data['show'])){return back()->with(['errorMessage' => 'This show not found']);}
        return view('adminPanel.shows.edit' , $data);
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
            'type'          => 'required',
            'title'         => 'required',
            'description'   => 'required',
            'price'         => 'required',
            'status'        => 'required',
        ]);

        $show = Show::find($id);
        if(empty($show)){return back()->with(['errorMessage' => 'This show not found']);}
        $show->update($inputs);
        return redirect()->route('adminPanel.shows.index')->with(['successMessage' => 'Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $show = Show::find($id);
        if(empty($show)){return back()->with(['errorMessage' => 'This show not found']);}
        $show->delete();
        return redirect()->route('adminPanel.shows.index')->with(['successMessage' => 'Deleted Successfully']);
    }
}
