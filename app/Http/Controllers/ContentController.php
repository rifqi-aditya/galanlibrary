<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    public function userPictures(string $path)
    {
        $path = User::PICTURE_PATH . '/' . $path;
        if (!Storage::exists($path)) {
            abort('404');
        }
        $content = Storage::get($path);
        $type = Storage::mimeType($path);
        $response = Response::make($content, 200, ['Content-Type' => $type]);
        return $response;
    }

    public function bookCovers(string $path)
    {
        $path = Book::COVER_PATH . '/' . $path;
        if (!Storage::exists($path)) {
            abort('404');
        }
        $content = Storage::get($path);
        $type = Storage::mimeType($path);
        $response = Response::make($content, 200, ['Content-Type' => $type]);
        return $response;
    }
}
