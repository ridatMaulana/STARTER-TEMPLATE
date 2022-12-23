<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Book;

class BookController extends Controller
{
    public function books()
    {
        try {
            $books = Book::all();

            return response()->json([
                'message' => "Success",
                'books' => $books,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => "Request Failed",
            ], 401);
        }
    }

    public function create(Request $request)
    {
        $validate = $request->validate([
            'judul' => 'required|max:255',
            'penulis' => 'required',
            'tahun' => 'required',
            'penerbit' => 'required',
            'image' => 'image|file|max:2048'
        ]);

        if ($request->hasFile('cover')) {
            $extension = $request->file('cover')->extension();
            $filename = 'cover_buku_'.time().'.'.$extension;
            $request->file('cover')->storeAs('public/cover/',$filename);

            $validate['cover'] = $filename;
        }

        Book::create($validate);

        return response()->json([
            'message' => "Data berhasil ditambahkan",
            'books' => $validate,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'judul' => 'required|max:255',
            'penulis' => 'required',
            'tahun' => 'required',
            'penerbit' => 'required',
            'cover' => 'image|file'
        ]);

        if ($request->hasFile('cover')) {
            $extension = $request->file('cover')->extension();
            $filename = 'cover_buku_'.time().'.'.$extension;
            $request->file('cover')->storeAs('public/cover/',$filename);

            $validate['cover'] = $filename;
        }

        $book = Book::findOrFail($id);
        Storage::delete('public/cover/'.$book->cover);

        $book->update($validate);
        return response()->json([
            'message' => "Data berhasil diubah",
            'books' => $validate,
        ], 200);
    }

    public function delete($id)
    {
        $book = Book::findOrFail($id);

        Storage::delete('public/cover/'.$book->cover);
        $book->delete();

        return response()->json([
            'message' => "Data berhasil dihapus"
        ], 200);
    }
}
