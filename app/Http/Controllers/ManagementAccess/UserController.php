<?php

namespace App\Http\Controllers\ManagementAccess;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\WorkUnit\Company;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ManagementAccess\StoreUserRequest;
use App\Http\Requests\ManagementAccess\UpdateUserRequest;
use App\Models\ManagementAccess\JobPosition;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::query()
            ->when(! blank($request->search), function ($query) use ($request) {
                return $query
                    ->where('name', 'like', '%'.$request->search.'%')
                    ->orWhere('email', 'like', '%'.$request->search.'%');
            })->with('jobPosition')
            ->with('roles', function ($query) {
                return $query->select('name');
            })
            ->latest()->get();
        $roles = Role::orderBy('name')->get();
        $jobPositions = JobPosition::orderBy('name')->get();
        // $companies = Company::orderBy('name')->get();

        return view('management-access.user.index', compact('users', 'roles', 'jobPositions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        // dd($request->all());

        if ($request->hasFile('icon')) {
            $files = $request->file('icon');
            $file = $files->getClientOriginalName();
            $basename = pathinfo($file, PATHINFO_FILENAME).' - '.Str::random(3);
            $extension = $files->getClientOriginalExtension();
            $fullname = $basename.'.'.$extension;
            $icon = $request->file('icon')->storeAs('assets/user-icon', $fullname);
        }

        User::create(array_merge(
            $request->all(),
            array(
                'icon' => $icon ?? '',
                'password' => Hash::make('password'),
                'email_verified_at' => ! blank($request->verified) ? now() : null,
            )
        ))?->assignRole(! blank($request->role) ? $request->role : array());


        //  alert()->success('Sukses', 'Data berhasil ditambahkan');
        // return redirect()->route('backsite.type_user.index')

        alert()->success('success', 'User has been created successfully!');
        return back();

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        // cari old photo
        $path_file = $user['icon'];

        // Upload process here
        if ($request->hasFile('icon')) {
            $files = $request->file('icon');
            $file = $files->getClientOriginalName();
            $basename = pathinfo($file, PATHINFO_FILENAME).' - '.Str::random(3);
            $extension = $files->getClientOriginalExtension();
            $fullname = $basename.'.'.$extension;

            // Store new file
            $icon = $request->file('icon')->storeAs('assets/user-icon', $fullname);

            // Delete old file if it exists
            if (! empty($path_file) && Storage::exists($path_file)) {
                Storage::delete($path_file);
            }
        } else {
            $request['icon'] = $path_file;
        }


        $user->syncRoles($request->role);

        $emailExists = User::firstWhere('email', $request->email) !== null;
        $isSameEmail = $request->email === $user->email;

        $email = $isSameEmail || ! $emailExists ? $request->email : null;
        if ($email) {
            $user->update([
                'email' => $email,
                'icon' => $icon ?? '',
                'email_verified_at' => $request->verified ? now() : null,
            ] + $request->except('email'));
        }

        alert()->success('success', 'User has been updated successfully!');
        return back();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // cari old photo
        $path_file = $user['icon'];

        // hapus file
        if ($path_file != null || $path_file != '') {
            Storage::delete($path_file);
        }
        $user->delete();

        alert()->success('success', 'User has been deleted successfully!');
        return back();
    }
}
