<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
use Barryvdh\DomPDF\Facade as PDF;
use DB;

class PdfController extends Controller
{
    public function index()
    {
        $post = Posts::all();
        return view('posts', ['post' => $post]);
    }

    public function cetak_pdf()
    {
        $post = Posts::all();

        $pdf = PDF::loadview('pdf.post', ['post' => $post]);
        return $pdf->download('laporan.pdf');
    }
}
