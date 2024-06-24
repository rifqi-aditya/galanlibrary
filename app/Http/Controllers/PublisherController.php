<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('publisher.index', [
            'publishers' => Publisher::with('books')->orderBy('created_at', 'DESC')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('publisher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        Validator::make($input, [
            'name' => ['required', 'string', 'min:3', 'max:120'],
            'address' => ['required', 'string', 'min:3', 'max:200'],
            'website' => ['required', 'url']
        ])->validate();

        Publisher::create([
            'name' => $input['name'],
            'address' => $input['address'],
            'website' => $input['website'],
        ]);

        return to_route('publisher.index')->with('success', 'Penerbit berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function show(Publisher $publisher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function edit(Publisher $publisher)
    {
        return view('publisher.edit', [
            'publisher' => $publisher
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Publisher $publisher)
    {
        $input = $request->all();

        Validator::make($input, [
            'name' => ['required', 'string', 'min:3', 'max:120'],
            'address' => ['required', 'string', 'min:3', 'max:200'],
            'website' => ['required', 'url']
        ])->validate();

        $publisher->forceFill([
            'name' => $input['name'],
            'address' => $input['address'],
            'website' => $input['website'],
        ])->save();

        return to_route('publisher.index')->with('success', 'Penerbit berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publisher $publisher)
    {
        $publisher->load('books');

        if ($count = count($publisher->books) > 0) {
            return to_route('publisher.index')->with('warning', 'Tidak dapat menghapus! Penerbit <strong>' . $publisher->name . '</strong> masih terkait dengan ' . $count . ' data buku.');
        }
        Publisher::destroy($publisher->id);
        return to_route('publisher.index')->with('success', 'Penerbit <strong>' . $publisher->name . '</strong> berhasil dihapus');
    }
}
