<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\User;


class HomeController extends Controller
{
    public function index()
    {
        $user = User::find(auth()->user()->id);

        if ($user->hasRole(['administrator', 'staff'])) {
            $categories = Category::with(['books'])->paginate(10);

            $categoryChartData = $categories->map(function ($category) {
                return [$category->name, $category->books->sum('stock')];
            })->toArray();

            array_unshift($categoryChartData, ['Kategori', 'Jumlah Buku']);

            $bookBorrowingChartData = $categories->map(function ($category) {
                $category->books->load('borrowings');
                return [
                    $category->name,
                    array_sum($category->books->map(function ($book) {
                        return $book->borrowings->sum('number_of_books');
                    })->toArray()),
                ];
            })->toArray();

            if ($bookBorrowingChartData == []) {
                array_push($bookBorrowingChartData, ['', 0]);
            }

            array_unshift($bookBorrowingChartData, ['Kategori', 'Buku Dipinjam']);
            $activeBorrowings = Borrowing::with('book')->where('return_date', '=', null)->get();
            $returnedBorrowings = Borrowing::with('book')->where('return_date', '!=', null)->get();
            $activeBorrowingCount = $activeBorrowings->sum('number_of_books');
            $returnedBorrowingCount = $returnedBorrowings->sum('number_of_books');

            $borrowingCountChartData = [
                ['Status', 'Jumlah Buku'],
                ['Belum Dikembalikan', $activeBorrowingCount],
                ['Sudah Dikembalikan', $returnedBorrowingCount],
            ];

            return view('home.index', [
                'categoryChartData' => json_encode($categoryChartData),
                'bookBorrowingChartData' => json_encode($bookBorrowingChartData),
                'borrowingCountChartData' => json_encode($borrowingCountChartData)
            ]);
        }

        $books = Book::with(['category', 'publisher']);

        if ($search = request('search')) {
            $books
                ->where('title', 'LIKE', "%{$search}%")
                ->orWhere('author', 'LIKE', "%{$search}%");
        }

        if ($category = request('category')) {
            $books->whereHas('category', function ($query) use ($category) {
                $query->where('name', 'LIKE', "%{$category}%");
            });
        }

        if ($publisher = request('publisher')) {
            $books->whereHas('publisher', function ($query) use ($publisher) {
                $query->where('name', 'LIKE', "%{$publisher}%");
            });
        }

        $publishers = Publisher::all();
        $categories = Category::all();
        return view('home.home-member', [
            'user' => $user,
            'books' => $books->paginate(30),
            'categories' => $categories,
            'publishers' => $publishers,
        ]);
    }


    public function bookDetail(Book $book)
    {
        $isAddedToWishlist = $book->wishlists()->where('user_id', auth('web')->id())->exists();

        return view('home.book-detail', [
            'book' => $book,
            'isAddedToWishlist' => $isAddedToWishlist,
        ]);
    }
}
