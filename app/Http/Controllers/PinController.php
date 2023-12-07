<?php

namespace App\Http\Controllers;

use App\Models\Pin;
use App\Models\PinMeta;
use App\Models\Tag;
use Illuminate\Http\Request;

class PinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pins.create',[
            'tags' => \Spatie\Tags\Tag::all(),
            'categories' => \App\Models\Category::where('parent_category_id', null)->with('subcategories')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'file.*' => 'required|image',
            'description' => 'required',
            'category' => 'required',
        ]);

        $pin = Pin::create([
            'title' => $request->title,
            'description' => $request->description,
            'short_description' => $request->description,
            'user_id' => auth()->user()->id,
            'slug' => \Str::slug($request->title),
        ]);

        $pinMeta = PinMeta::create([
            'pin_id' => $pin->id,
            'school_name' => $request->school_name,
            'school_location' => $request->school_location,
            'datum_gebruikname' => $request->datum_gebruikname,
            'reden_bijzonderheid' => $request->reden_bijzonderheid,
            'meningen' => $request->meningen,
            'primair_doel' => $request->primair_doel,
            'bijzonderheden' => $request->bijzonderheden,
            'betrokkenen' => $request->betrokkenen,
        ]);

        $pin->categories()->attach($request->category);
        $pin->attachTags($this->stripTags($request->tags));

        foreach($request->file as $file) {
            $pin->addMedia($file)->toMediaCollection('images');
        }

        return response()->json(
            [
                'message' => 'Pin created successfully',
                'id' => $pin->id
            ], 200
        );
    }

    public function removeImage(Pin $pin, Request $request) {

        $pin->deleteMedia($request->media_id);
        return back();
    }

    public function stripTags(string $tags) {
        $tags = explode(',', $tags);
        $tags = array_map('trim', $tags);
        $tags = array_map(function($val){
            return ltrim($val, '#');
        }, $tags);
        $tags = array_map('strtolower', $tags);
        $tags = array_unique($tags);
        return $tags;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pin  $pin
     * @return \Illuminate\Http\Response
     */
    public function show(Pin $pin)
    {
        return view('pins.show', [
            'pin' => $pin
        ]);
    }

    public function favorites() {
        return view('favorites', [
            'pins' => auth()->user()->favorites
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pin  $pin
     * @return \Illuminate\Http\Response
     */
    public function edit(Pin $pin)
    {
        if(\Auth::user()->id == $pin->user_id || \Auth::user()->role == 'admin') {
            $pin = Pin::with('categories')->where('id', $pin->id)->first();
            return view('pins.edit', [
                'pin' => $pin,
                'tags' => \Spatie\Tags\Tag::all(),
                'categories' => \App\Models\Category::where('parent_category_id', null)->with('subcategories')->get(),
            ]);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pin  $pin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pin $pin)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category' => 'required',
        ]);

        $pin->update([
            'title' => $request->title,
            'description' => $request->description,
            'short_description' => $request->description,
            'slug' => \Str::slug($request->title),
        ]);

        $pin->pinMeta()->update([
            'school_name' => $request->school_name,
            'school_location' => $request->school_location,
            'datum_gebruikname' => $request->datum_gebruikname,
            'reden_bijzonderheid' => $request->reden_bijzonderheid,
            'meningen' => $request->meningen,
            'primair_doel' => $request->primair_doel,
            'bijzonderheden' => $request->bijzonderheden,
            'betrokkenen' => $request->betrokkenen,
        ]);

        $pin->categories()->sync($request->category);
        $pin->syncTags($this->stripTags($request->tags));

        if($request->file) {
            foreach ($request->file as $file) {
                $pin->addMedia($file)->toMediaCollection('images');
            }

        }

        return response()->json([
            'message' => 'Pin updated successfully',
            'pin' => $pin->id
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pin  $pin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pin $pin)
    {
        $pin->delete();
        return redirect()->route('welcome');
    }
}
