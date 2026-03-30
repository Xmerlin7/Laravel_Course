<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAllUsers();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'     => 'required|min:3|max:50',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $this->userService->createUser($validatedData);

        return redirect('/users')->with('success', 'User created successfully!');
    }
}
