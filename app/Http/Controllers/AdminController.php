<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        return view('home',compact('user'));
    }

    public function book()
    {
        $books = Book::index();
        $user = Auth::user();
        return view('book',compact('user', 'books'));
    }

    public function create(Request $request)
    {
        $validate = $request->validate([
            'judul' => 'required|max:255',
            'penulis' => 'required',
            'tahun' => 'required',
            'penerbit' => 'required',
        ]);
        $book = new Book;

        $book->judul = $request->get('judul');
        $book->penulis = $request->get('penulis');
        $book->tahun = $request->get('tahun');
        $book->penerbit = $request->get('penerbit');

        if ($request->hasFile('cover')) {
            $extension = $request->file('cover')->extension();
            $filename = 'cover_buku_'.time().'.'.$extension;
            $request->file('cover')->storeAs('public/cover/',$filename);

            $book->cover = $filename;
        }

        $book->save();

        $notification = array(
            'message' => 'Data berhasil ditambahkan',
            'alert-type' => 'success'
        );

         return redirect()->route('admin.book')->with($notification);
    }

    public function searchBook($id)
    {
        $buku = Book::findOrFail($id);

        return response()->json($buku);
    }

    public function update(Request $request)
    {
        $book = Book::findOrFail($request->get('id'));

        $validate = $request->validate([
            'judul' => 'required|max:255',
            'penulis' => 'required',
            'tahun' => 'required',
            'penerbit' => 'required',
        ]);

        $book->judul = $request->get('judul');
        $book->penulis = $request->get('penulis');
        $book->tahun = $request->get('tahun');
        $book->penerbit = $request->get('penerbit');

        if ($request->hasFile('cover')) {
            $extension = $request->file('cover')->extension();
            $filename = 'cover_buku_'.time().'.'.$extension;
            $request->file('cover')->storeAs('public/cover/',$filename);

            Storage::delete('public/cover/',$request->get('old_cover'));
            $book->cover = $filename;
        }

        $book->save();

        $notification = array(
            'message' => 'Data berhasil diubah',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.book')->with($notification);
    }

    public function destroy($id)
    {
        $buku = Book::findOrFail($id);
        Storage::delete('public/cover/',$buku->cover);
        $buku->delete();

        return response()->json([
            'success' => true,
            'message' => "Data berhasil dihapus",
        ]);
    }
}
