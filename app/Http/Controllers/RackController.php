<?php

namespace App\Http\Controllers;

use App\Models\Rack;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('rack.index', [
            'racks' => Rack::with('categories')->orderBy('created_at', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rack.create', [
            'categories' => Category::with('books')->orderBy('created_at', 'DESC')->get()
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
        $input = $request->all();

        Validator::make($input, [
            'code' => ['required', Rule::unique(Rack::class), 'min:3', 'max:10'],
            'description' => ['required', 'min:3', 'max:120']
        ])->validate();

        $rack = Rack::create([
            'code' => $input['code'],
            'description' => $input['description']
        ]);

        if (isset($input['category_ids'])) {
            $rack->categories()->sync($input['category_ids']);
        } else {
            $rack->categories()->sync([]);
        }

        return to_route('rack.index')->with('success', 'Rak buku berhasil ditambahkan');
    }

    public function edit(Rack $rack)
    {
        return view('rack.edit', [
            'rack' => $rack,
            'categories' => Category::with('books')->orderBy('created_at', 'DESC')->get()
        ]);
    }

    public function update(Request $request, Rack $rack)
    {
        $input = $request->all();

        Validator::make($input, [
            'code' => ['required', Rule::unique(Rack::class)->ignore($rack->id), 'min:3', 'max:10'],
            'description' => ['required', 'min:3', 'max:120']
        ])->validate();

        $rack->forceFill([
            'code' => $input['code'],
            'description' => $input['description']
        ])->save();

        if (isset($input['category_ids'])) {
            $rack->categories()->sync($input['category_ids']);
        } else {
            $rack->categories()->sync([]);
        }

        return to_route('rack.index')->with('success', 'Rak buku berhasil diperbarui');
    }

    public function destroy(Rack $rack)
    {
        $rack->load('categories');

        if ($count = count($rack->categories) > 0) {
            return to_route('rack.index')->with('warning', 'Tidak dapat menghapus! Rak <strong>' . $rack->code . '</strong> masih terkait dengan ' . $count . ' kategori.');
        }
        Rack::destroy($rack->id);
        return to_route('rack.index')->with('success', 'Rak buku berhasil dihapus');
    }
}
