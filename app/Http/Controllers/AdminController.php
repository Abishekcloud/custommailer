<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.index',compact('users'));
    }

    public function userList(){
        $clients = User::all();
        return view('admin.userlist',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {        
        return view('admin.addUser');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);

        try {
            $validator = Validator::make($request->all(), [
                'username' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'role' => 'required',
            ]);


            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $input = $request->all();

            User::create($input);

            return redirect()->route('admin.userList')
                ->with('success', 'Client created successfully.');
        } catch (\Throwable $th) {
            // Return an error response if any exception occurs
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


    public function profileShow(User $user)
    {
        return view('admin.profile',compact('user'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id); // Fetch the user by ID or show a 404 error if not found
        // dd($user);
        return view('admin.editUser', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        try {
            $request->validate([
                'username' => 'required',
                'email' => 'required',
                'password' => 'required',
                'role' => 'sometimes',
            ]);

            $input = $request->all();
            $user->update($input);
            // dd($user);
            // $user ->save();
            // dd($input);

            return redirect()->route('admin.userList')
                ->with('success', 'User Updated Successfully');
        } catch (\Throwable $th) {
            $params = ['status' => false, 'message' => $th->getMessage()];
            return response()->json(['params' => $params]);
        }
    }   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('admin.userList')->with('success', 'User deleted successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to delete user');
        }
    }
}
