<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCandidateRequest;
use App\Models\Candidate;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('candidates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCandidateRequest $request)
    {
        // Lưu file avatar
        $avatarPath = $request->hasFile('avatar')
            ? $request->file('avatar')->store('candidates', 'public')
            : null;

        // Lưu file CV
        $cvPath = $request->hasFile('cv')
        ? $request->file('cv')->store('candidates', 'public')
        : null;

        // Tạo mới
        Candidate::create([
            'name' => $request->name,
            'email' => $request->email,
            'birthday' => $request->birthday,
            'avatar_path' => $avatarPath,
            'cv_path' => $cvPath,
            'bio' => $request->bio,
        ]);

        return redirect()->back()->with('success', 'Hồ sơ đã được gửi thành công!');
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
}
