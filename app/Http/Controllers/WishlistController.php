<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index(Request $request)
    {
        $user = User::find($request->user('web')->id);

        $wishlists = Wishlist::query()
            ->with(['book'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate();

        return view('wishlist.index', [
            'wishlists' => $wishlists,
        ]);
    }

    public function addOrRemove(Book $book, Request $request)
    {
        $user = User::find($request->user('web')->id);

        $wishList = Wishlist::query()->where('user_id', $user->id)->where('book_id', $book->id)->first();

        if ($wishList) {
            $wishList->delete();
            return back()->with('success', 'Buku dihapus dari wishlist');
        } else {
            $wishList = new Wishlist;
            $wishList->user_id = $user->id;
            $wishList->book_id = $book->id;
            $wishList->save();

            return back()->with('success', 'Buku ditambahkan ke wishlist');
        }
    }
}
