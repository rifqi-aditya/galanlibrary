<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('category.index', [
            'categories' => Category::with('books')->orderBy('created_at', 'DESC')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
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
            'description' => ['required', 'string', 'max:500'],
        ])->validate();

        Category::create([
            'name' => $input['name'],
            'description' => $input['description'],
        ]);

        return to_route('category.index')->with('success', 'Kategori buku berhasil disimpan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('category.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $input = $request->all();

        Validator::make($input, [
            'name' => ['required', 'string', 'min:3', 'max:120'],
            'description' => ['required', 'string', 'max:500'],
        ])->validate();

        $category->forceFill([
            'name' => $input['name'],
            'description' => $input['description'],
        ])->save();

        return to_route('category.index')->with('success', 'Kategori buku berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->load(['books', 'racks']);

        if (count($category->books) > 0) {
            return to_route('category.index')->with('warning', 'Tidak dapat menghapus! Kategori buku <strong>' . $category->name . '</strong> masih terkait dengan ' . count($category->books) . ' data buku.');
        }

        if (count($category->racks) > 0) {
            return to_route('category.index')->with('warning', 'Tidak dapat menghapus! Kategori buku <strong>' . $category->name . '</strong> masih terkait dengan ' . count($category->racks) . ' data rak buku.');
        }

        Category::destroy($category->id);
        return to_route('category.index')->with('success', 'Kategori buku <strong>' . $category->name . '</strong> berhasil dihapus');
    }
}
