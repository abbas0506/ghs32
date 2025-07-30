<?php

use App\Http\Controllers\Admin\AllocationController;
use App\Http\Controllers\Admin\AlumniController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\Admin\CollectiveTestController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\GradeController;
use App\Http\Controllers\Admin\GradeSectionController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\InchargeController;
use App\Http\Controllers\Admin\SectionCardController;
use App\Http\Controllers\Admin\SectionController as AdminSectionController;
use App\Http\Controllers\Admin\SectionResultCardController;
use App\Http\Controllers\Admin\SectionResultController;
use App\Http\Controllers\Admin\SectionStuedentsController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\TestAllocationController as AdminTestAllocationController;
use App\Http\Controllers\Admin\TestSectionController as AdminTestSectionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admission\PdfController;
use App\Http\Controllers\Admission\ApplicationController as AdmissionApplicationController;
use App\Http\Controllers\Admission\CardController;
use App\Http\Controllers\Admission\DashboardController;
use App\Http\Controllers\Admission\FeeController as AdmissionFeeController;
use App\Http\Controllers\Admission\GroupController as AdmissionGroupController;
use App\Http\Controllers\Admission\HighAchieverController;
use App\Http\Controllers\Admission\ObjectionController as AdmissionObjectionController;
use App\Http\Controllers\Admission\RejectionController;
use App\Http\Controllers\Admission\SectionController;
use App\Http\Controllers\Admission\SectionStudentsController;
use App\Http\Controllers\AlumniController as ControllersAlumniController;
use App\Http\Controllers\EventController;
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
use App\Http\Controllers\RejectionController\Admission;
use App\Http\Controllers\ReportCardController;
use App\Http\Controllers\ResultDetailController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\SubjectResultController;
use App\Http\Controllers\Teacher\AllocationController as TeacherAllocationController;
use App\Http\Controllers\Teacher\CombinedTestController;
use App\Http\Controllers\Teacher\DashboardController as TeacherDashboardController;
use App\Http\Controllers\Teacher\ImportStudentController;
use App\Http\Controllers\Teacher\SectionResultController as TeacherSectionResultController;
use App\Http\Controllers\Teacher\TestAllocationController;
use App\Http\Controllers\Teacher\TestAllocationResultController;
use App\Http\Controllers\Teacher\TestController;
use App\Http\Controllers\Teacher\TestSectionController;
use App\Http\Controllers\Teacher\TestSectionStudentController;
use App\Http\Controllers\TestPositionController;
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
Route::get('switch/as/{role}', [UserController::class, 'switchAs']);

Route::resource('signup', SignupController::class);
Route::view('signup-success', 'signup-success');

Route::view('forgot', 'forgot');
Route::post('forgot', [AuthController::class, 'forgot']);

Route::post('login', [AuthController::class, 'login']);

Route::view('admission-25', 'admission.online-applications.instructions');
Route::get('apply', [OnlineApplicationController::class, 'create']);
Route::post('apply', [OnlineApplicationController::class, 'store']);
// Route::resource('online-applications', OnlineApplicationController::class);
Route::get('applied/{application}', [OnlineApplicationController::class, 'applied'])->name('applied');

Route::post('login/as', [AuthController::class, 'loginAs'])->name('login.as');
Route::get('signout', [AuthController::class, 'signout'])->name('signout');

Route::resource('alumni', ControllersAlumniController::class)->only('index', 'create', 'store');

Route::middleware(['auth'])->group(function () {

    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['role:admin']], function () {
        Route::get('/', [AdminDashboardController::class, 'index']);
        Route::resource('groups', GroupController::class);
        Route::resource('subjects', SubjectController::class);
        Route::resource('alumni', AlumniController::class);
        Route::resource('sections', AdminSectionController::class);
        Route::resource('events', EventController::class);
        Route::resource('grade.sections', GradeSectionController::class);
        Route::resource('section.lecture.allocations', AllocationController::class);

        Route::post('sections/{section}/clean', [AdminSectionController::class, 'clean'])->name('sections.clean');
        Route::resource('section.students', SectionStuedentsController::class);
        Route::resource('section.cards', SectionCardController::class);
        Route::get('section/student-cards/print', [SectionCardController::class, 'print'])->name('section.cards.print');

        Route::get('students/import/{section}', [SectionStuedentsController::class, 'import']);
        Route::post('students/import', [SectionStuedentsController::class, 'postImport']);

        Route::view('change/password', 'admin.change_password');
        Route::post('change/password', [AuthController::class, 'changePassword'])->name('change.password');

        Route::resource('users', UserController::class);
        Route::resource('incharges', InchargeController::class);
        Route::resource('tests', CollectiveTestController::class);
        Route::resource('test.sections', AdminTestSectionController::class);
        Route::resource('test.section.results', SectionResultController::class);
        Route::resource('test.allocations', AdminTestAllocationController::class);
        Route::patch('test-allocations/{id}/unlock', [TestAllocationResultController::class, 'unlock'])->name('test-allocations.unlock');

        Route::get('test-allocation/{id}/result/print', [SubjectResultController::class, 'print'])->name('test-allocation.result.print');
        Route::get('test/{t}/section/{s}/result/print', [ResultDetailController::class, 'print'])->name('test.section.result.print');
        Route::get('test/{t}/section/{s}/positions/print', [TestPositionController::class, 'print'])->name('test.section.positions.print');
        Route::get('test/{t}/section/{s}/report-cards/print', [ReportCardController::class, 'print'])->name('test.section.report-cards.print');
    });

    Route::group(['prefix' => 'admission', 'as' => 'admission.', 'middleware' => ['role:admission']], function () {
        Route::get('/', [DashboardController::class, 'index']);
        Route::resource('applications', AdmissionApplicationController::class);
        Route::patch('/applications/{application}/accept', [AdmissionApplicationController::class, 'accept'])->name('applications.accept');
        Route::patch('/applications/{application}/reject', [AdmissionApplicationController::class, 'reject'])->name('applications.reject');
        Route::patch('/applications/{application}/admit', [AdmissionApplicationController::class, 'admit'])->name('applications.admit');
        Route::resource('fee', AdmissionFeeController::class);
        Route::resource('objections', AdmissionObjectionController::class);

        Route::resource('rejections', RejectionController::class);
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

    Route::group(['prefix' => 'teacher', 'as' => 'teacher.', 'middleware' => ['role:teacher']], function () {
        Route::get('/', [TeacherDashboardController::class, 'index']);
        Route::resource('tests', TestController::class);
        Route::resource('test.test-allocations', TestAllocationController::class);
        Route::resource('test-allocation.results', TestAllocationResultController::class);
        Route::resource('test-allocation.import-students', ImportStudentController::class);

        Route::get('test-allocation/{id}/result/print', [SubjectResultController::class, 'print'])->name('test-allocation.result.print');
        Route::get('test/{t}/section/{s}/result/print', [ResultDetailController::class, 'print'])->name('test.section.result.print');
        Route::get('test/{t}/section/{s}/positions/print', [TestPositionController::class, 'print'])->name('test.section.positions.print');
        Route::get('test/{t}/section/{s}/report-cards/print', [ReportCardController::class, 'print'])->name('test.section.report-cards.print');
    });
});
