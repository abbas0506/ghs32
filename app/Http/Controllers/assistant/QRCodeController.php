<?php

namespace App\Http\Controllers\assistant;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\rack;
use App\Models\Clas;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class QRCodeController extends Controller
{

    public function index()
    {
        $racks = Rack::has('books')->get();
        $classes = Clas::all();
        $teachers = Teacher::all();
        return view('assistant.qrcodes.index', compact('racks', 'classes', 'teachers'));
    }
    /**
     * Display a listing of the resource.
     */
    public function previewBooksQr(string $id)
    {
        //
        $rack = Rack::find($id);
        $pdf = PDF::loadView('assistant.qrcodes.books.preview', compact('rack'))->setPaper('a4', 'portrait');
        $pdf->set_option("isPhpEnabled", true);

        $file = "QRCode.pdf";
        return $pdf->stream($file);
    }
    public function previewTeachersQr()
    {
        //
        $teachers = Teacher::all();
        $pdf = PDF::loadView('assistant.qrcodes.teachers.preview', compact('teachers'))->setPaper('a4', 'portrait');
        $pdf->set_option("isPhpEnabled", true);

        $file = "QRCode.pdf";
        return $pdf->stream($file);
    }
    public function previewStudentsQr(string $id)
    {
        //
        $clas = Clas::find($id);
        $pdf = PDF::loadView('assistant.qrcodes.students.preview', compact('clas'))->setPaper('a4', 'portrait');
        $pdf->set_option("isPhpEnabled", true);

        $file = "QRCode.pdf";
        return $pdf->stream($file);
    }
}
