<?php

namespace App\Http\Controllers\student_services;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Grade;
use App\Models\Question;
use App\Models\Subject;
use App\Models\Test;
use Exception;
use Illuminate\Http\Request;

class SelfTestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $grades = Grade::where('id', '>', 8)->get();
        return view('student_services.selftest.index', compact('grades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $subjectId = session('subject_id');
        $subject = Subject::find($subjectId);

        $chapterIds = session('chapterIds');
        $chapters = Chapter::whereIn('id', $chapterIds)->get();
        $questions = Question::where('question_type', 'mcq')
            ->whereIn('chapter_no', $chapterIds)
            ->get()
            ->random(20);
        // $questions = collect();
        // foreach ($chapters as $chapter) {
        //     $questionsFromThisChapter = Question::where('question_type', 'mcq')
        //         ->where('chapter_id', $chapter->id)
        //         ->get()
        //         ->random(round(20 / sizeOf($chapterIds), 0));

        //     foreach ($questionsFromThisChapter as $question)
        //         $questions->add($question);
        // }
        // echo $questions;
        return view('student_services.selftest.show', compact('subject', 'questions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'subject_id' => 'required|numeric',
            'chapter_id_array' => 'required',
        ]);


        try {
            // $test = Test::create($request->all());
            $chapterIds = array();
            $chapterIds = $request->chapter_id_array;
            session([
                'subject_id' => $request->subject_id,
                'chapterIds' => $chapterIds,

            ]);
            return redirect()->route('selftest.create');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function subjects($gradeId)
    {
        $grade = Grade::find($gradeId);
        $subjects = Subject::where('grade_id', $gradeId)
            ->whereHas('chapters')
            ->get();
        return view('student_services.selftest.subjects', compact('subjects', 'grade'));
    }
    public function chapters($subjectId)
    {
        $subject = Subject::find($subjectId);
        $chapters = Chapter::where('subject_id', $subjectId)
            ->whereHas('questions')
            ->get();
        return view('student_services.selftest.chapters', compact('chapters', 'subject'));
    }
};
