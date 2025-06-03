<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Helpers\JsonHelper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;                   
use Illuminate\Support\Facades\Auth;     
use Illuminate\Validation\Rule;

class AlumniController extends Controller
{
    public function show($id)
    {
        $user = auth()->user();

        if ($user->role !== 'alumni' || $user->id != $id) {
            abort(403, 'Unauthorized');
        }

        $alumni = User::where('role', 'alumni')->findOrFail($id);

        return view('alumni.alumni', compact('alumni'));
    }


    public function showedit($id)
    {
        $user = auth()->user();

        if ($user->role !== 'alumni' || $user->id != $id) {
            abort(403, 'Unauthorized');
        }

        $alumni = User::where('role', 'alumni')->findOrFail($id);

            if ($alumni->work_place) {
                $split = explode(',', $alumni->work_place);
                $work = trim($split[0] ?? '');
                $city = trim($split[1] ?? '');
            } else {
                $work = '';
                $city = '';
            }

        return view('alumni.edit_profil', compact('alumni','work','city')); 
    }

    /**
     * Update data alumni yang sedang login
     */
    public function update(Request $request)
{
    try {
        $user = $request->user();

        if ($user->role !== 'alumni') {
            return response()->json(['status' => 'error', 'message' => 'Akses ditolak'], 403);
        }

        $validator = Validator::make($request->all(), [
            'name'             => 'required|string|max:255',
            'email'            => [
                'sometimes',
                'nullable',
                'email',
                Rule::unique('users', 'email')->ignore($user->id),
                function ($attribute, $value, $fail) {
                    if ($value && !str_ends_with(strtolower($value), '@gmail.com')) {
                        $fail('Email harus menggunakan @gmail.com.');
                    }
                },
            ],
            'nis'              => [
                'sometimes',
                'required',
                'string',
                'min:4',
                'max:4',
                Rule::unique('users', 'nis')->ignore($user->id),
            ],
            'birth_date'       => 'required|date',
            'insta'            => 'required|string|max:50',
            'university_name'  => 'required|string|max:255',
            'job_title'        => 'required|string|max:100',
            'work'             => 'required|string|max:100',
            'city'             => 'required|string|max:100',
            'major'            => 'required|nullable|string|max:100',
            'graduation_year'  => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'phone'            => 'required|string|max:20',
            'password'         => 'nullable|string|min:8',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

    

        // Handle password change
        if ($request->filled('password')) {
            if (!$request->filled('old_password') || !Hash::check($request->old_password, $user->getOriginal('password'))) {
                return back()->withErrors(['old_password' => 'Password lama salah atau tidak diisi']);
            }

            $user->password = Hash::make($request->password);
        }

        $work_place = null;
        if ($request->filled('work') && $request->filled('city')) {
            $work_place = $request->work . ', ' . $request->city;
        } elseif ($request->filled('work')) {
            $work_place = $request->work;
        } elseif ($request->filled('city')) {
            $work_place = $request->city;
        } else {
            $work_place = ', ';
        }

        $user->fill([
            'name'            => $request->name,
            'email'           => $request->email,
            'nis'             => $request->nis,
            'birth_date'      => $request->birth_date,
            'insta'           => $request->insta,
            'university_name' => $request->university_name,
            'job_title'       => $request->job_title,
            'work_place'      => $work_place,
            'major'           => $request->major,
            'graduation_year' => $request->graduation_year,
            'phone'           => $request->phone,
        ]);

        $user->save();

        JsonHelper::updateMajorsJson($request->major);
        JsonHelper::updateCitiesJson($request->city);
        JsonHelper::updateUnivJson($request->university_name);

        return redirect()->route('alumni', ['id' => $user->id])->with('success', 'Data berhasil diperbarui!');
        
    } catch (ModelNotFoundException $e) {
        return response()->json(['status' => 'error', 'message' => 'Alumni tidak ditemukan'], 404);
    }
}
}