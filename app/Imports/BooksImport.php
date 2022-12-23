<?php

namespace App\Imports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BooksImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if ($row->hasFile('cover')) {
            $extension = $row->file('cover')->extension();
            $filename = 'cover_buku_'.time().'.'.$extension;
            $row->file('cover')->storeAs('public/cover/',$filename);

            Storage::delete('public/cover/'.$request->get('old-cover'));
            $book->cover = $filename;
        }
        return new Book([
            'judul' => $row['judul'],
            'penulis' => $row['penulis'],
            'tahun' => $row['tahun'],
            'penerbit' => $row['penerbit'],
            'cover' => $filename
        ]);
    }
}
