<?php

use App\Http\Controllers\AuthController;

use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\ClassStudentsController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\GradeController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\SectionCardController;
use App\Http\Controllers\Admin\SectionController as AdminSectionController;
use App\Http\Controllers\Admin\SectionStuedentsController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admission\PdfController;
use App\Http\Controllers\Admission\ApplicationController as AdmissionApplicationController;
use App\Http\Controllers\Admission\CardController;
use App\Http\Controllers\Admission\DashboardController;
use App\Http\Controllers\Admission\FeeController as AdmissionFeeController;
use App\Http\Controllers\Admission\GroupApplicationController;
use App\Http\Controllers\Admission\GroupController as AdmissionGroupController;
use App\Http\Controllers\Admission\HighAchieverController;
use App\Http\Controllers\Admission\ImportStudentsController;
use App\Http\Controllers\Admission\ObjectionController as AdmissionObjectionController;
use App\Http\Controllers\Admission\SectionController;
use App\Http\Controllers\Admission\SectionImportController;
use App\Http\Controllers\Admission\SectionStudentsController;
use App\Http\Controllers\Library\BookController;
use App\Http\Controllers\Library\BookIssuanceController;
use App\Http\Controllers\Library\RackController;
use App\Http\Controllers\Library\BookReturnController;
use App\Http\Controllers\Library\DashboardController as LibraryDashboardController;
use App\Http\Controllers\Library\DomainBooksController;
use App\Http\Controllers\Library\DomainController;
use App\Http\Controllers\Library\LibraryRuleController;
use App\Http\Controllers\Library\PrintController;
use App\Http\Controllers\Library\RackBooksController;
use App\Http\Controllers\Library\TeacherController as LibraryTeacherController;
use App\Http\Controllers\OnlineApplicationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {
        return redirect(session('role'));
    } else {
        return view('index');
    }
});


Route::view('about', 'about');
Route::view('contact', 'contact');
Route::view('gallary', 'gallary');

Route::resource('applications', AdmissionApplicationController::class);

Route::view('login', 'login');

Route::post('login', [AuthController::class, 'login']);
Route::view('login/admin', 'login.admin');
Route::view('login/admission-portal', 'login.admission-portal');
Route::view('login/library', 'login.library');



Route::get('apply', [OnlineApplicationController::class, 'create']);
Route::post('apply', [OnlineApplicationController::class, 'store']);
// Route::resource('online-applications', OnlineApplicationController::class);
Route::get('applied/{application}', [OnlineApplicationController::class, 'applied'])->name('applied');

Route::post('login/as', [AuthController::class, 'loginAs'])->name('login.as');
Route::get('signout', [AuthController::class, 'signout'])->name('signout');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['role:admin']], function () {
    Route::get('/', [AdminDashboardController::class, 'index']);
    Route::resource('grades', GradeController::class)->only('index');
    Route::resource('sections', AdminSectionController::class);
    Route::post('sections/{section}/clean', [AdminSectionController::class, 'clean'])->name('sections.clean');
    Route::resource('section.students', SectionStuedentsController::class);
    Route::resource('section.cards', SectionCardController::class);
    Route::get('section/student-cards/print', [SectionCardController::class, 'print'])->name('section.cards.print');

    Route::get('students/import/{section}', [SectionStuedentsController::class, 'import']);
    Route::post('students/import', [SectionStuedentsController::class, 'postImport']);

    Route::resource('teachers', TeacherController::class);
    Route::get('more/teachers/import', [TeacherController::class, 'import'])->name('teachers.import');
    Route::post('more/teachers/import', [TeacherController::class, 'postImport'])->name('teachers.import.post');

    Route::view('change/password', 'admin.change_password');
    Route::post('change/password', [AuthController::class, 'changePassword'])->name('change.password');

    Route::resource('groups', GroupController::class);
    Route::resource('users', UserController::class);
});

Route::group(['prefix' => 'admission', 'as' => 'admission.', 'middleware' => ['role:admission']], function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::resource('applications', AdmissionApplicationController::class);
    Route::resource('groups', AdmissionGroupController::class);
    Route::resource('fee', AdmissionFeeController::class);
    Route::resource('objections', AdmissionObjectionController::class);
    Route::resource('high-achievers', HighAchieverController::class);
    Route::resource('sections', SectionController::class);
    Route::resource('section.students', SectionStudentsController::class);

    Route::post('sections/{section}/clean', [SectionController::class, 'clean'])->name('sections.clean');
    Route::post('sections/{section}/refresh-srno', [SectionController::class, 'refreshSrNo'])->name('sections.refresh.srno');
    Route::get('sections/{section}/refresh-rollno', [SectionController::class, 'refreshRollNo'])->name('sections.refresh.rollno');

    Route::resource('cards', CardController::class);
    Route::get('print/cards', [CardController::class, 'print'])->name('cards.print');

    Route::get('sections/{section}/print/students-list', [PdfController::class, 'printListOfStudents'])->name('sections.print.listOfStudents');
    Route::get('sections/{section}/print/attendance-list', [PdfController::class, 'printAttendanceList'])->name('sections.print.attendanceList');
    Route::get('sections/{section}/print/serial-list', [PdfController::class, 'printListOfSrNo'])->name('sections.print.listOfSrNo');

    Route::get('print/fee', [PdfController::class, 'printFee'])->name('print.fee');
    Route::get('print/objections', [PdfController::class, 'printObjections'])->name('print.objections');
});

Route::group(
    ['prefix' => 'library', 'as' => 'library.', 'middleware' => ['role:library']],
    function () {
        Route::get('/', [LibraryDashboardController::class, 'index']);
        Route::resource('books', BookController::class);
        Route::resource('domains', DomainController::class);
        Route::resource('domain.books', DomainBooksController::class);
        Route::resource('racks', RackController::class);
        Route::resource('rack.books', RackBooksController::class);
        Route::resource('library-rules', LibraryRuleController::class);
        Route::resource('teachers', LibraryTeacherController::class);

        Route::get('print', [PrintController::class, 'index']);

        Route::get('print/teachers/list', [PrintController::class, 'printTeachersList'])->name('print.teachers.list');
        Route::get('print/rack-books/{rack}/list', [PrintController::class, 'printRackBooksList'])->name('print.rack-books.list');

        Route::get('print/teachers/qr', [PrintController::class, 'printTeachersQr'])->name('print.teachers.qr');
        Route::get('print/rack-books/{rack}/qr', [PrintController::class, 'printRackBooksQr'])->name('print.rack-books.qr');
        Route::get('print/specific-qr', [PrintController::class, 'printSpecificQr'])->name('print.specific-qr');

        Route::get('book-issuance/scan', [BookIssuanceController::class, 'scan'])->name('book-issuance.scan');
        Route::post('book-issuance/scan', [BookIssuanceController::class, 'postScan'])->name('book-issuance.scan.post');
        Route::get('book-issuance/confirm', [BookIssuanceController::class, 'confirm'])->name('book-issuance.confirm');
        Route::post('book-issuance/confirm', [BookIssuanceController::class, 'postConfirm'])->name('book-issuance.confirm.post');
        Route::get('book-issuance/issued', [BookIssuanceController::class, 'issued'])->name('book-issuance.issued');
        Route::get('book-issuance/delayed', [BookIssuanceController::class, 'delayed'])->name('book-issuance.delayed');
        Route::get('book-issuance/default', [BookIssuanceController::class, 'default'])->name('book-issuance.default');

        Route::get('book-return/scan', [BookReturnController::class, 'scan'])->name('book-return.scan');
        Route::post('book-return/scan', [BookReturnController::class, 'postScan'])->name('book-return.scan.post');
        Route::get('book-return/confirm', [BookReturnController::class, 'confirm'])->name('book-return.confirm');
        Route::patch('book-return/confirm/{book_issuance}', [BookReturnController::class, 'postConfirm'])->name('book-return.confirm.post');
    }
);
