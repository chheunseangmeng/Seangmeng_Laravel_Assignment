<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // fake data of the users--------------
    public $users = [
        [
            'id' => 'user_01',
            'name' => 'Luca Moretti',
            'email' => 'luca.moretti@gmail.com',
            'membershipDate' => '2024-10-15'
        ],
        [
            'id' => 'user_02',
            'name' => 'Sophie Dubois',
            'email' => 'sophie.dubois@gmail.com',
            'membershipDate' => '2023-09-22'
        ],
        [
            'id' => 'user_03',
            'name' => 'Jakub Nowak',
            'email' => 'jakub.nowak@gmail.com',
            'membershipDate' => '2022-07-01'
        ],
        [
            'id' => 'user_04',
            'name' => 'Anna Müller',
            'email' => 'anna.mueller@gmail.com',
            'membershipDate' => '2025-01-30'
        ]

    ];

    // show all users --------------
    public function index()
    {
        if (!empty($this->users)) {
            return response()->json([
                'message' => 'Here are all users...',
                'data' => $this->users
            ], 200);
        }

        return response()->json([
            'message' => 'cannot found user..'
        ], 404);
    }

    // create users function--------------------
    public function createUser(Request $request)
    {
        $newUser = [
            'id' => $request->input('id'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'membershipDate' => $request->input('membershipDate'),
        ];

        $this->users[] = $newUser;

        return response()->json([
            'message' => 'User created successfully',
            'data' => $newUser
        ], 201);
    }

    // show user by id
    public function showUser(string $id)
    {
        foreach ($this->users as $user) {
            if ($user['id'] == $id) {
                return response()->json([
                    'message' => 'this is user...',
                    'data' => $user
                ], 200);
            }
        }
       
        return response()->json([
            'message' => 'Cannot find user...',
        ], 404);
    }

    // eidt specific user ---------------------
    public function editUser(Request $request, string $id)
    {
        foreach ($this->users as $index => $user) {
            if ($user['id'] == $id) {
                // Update only provided fields
                $this->users[$index]['name'] = $request->input('name', $user['name']);
                $this->users[$index]['email'] = $request->input('email', $user['email']);
                $this->users[$index]['membershipDate'] = $request->input('membershipDate', $user['membershipDate']);

                return response()->json([
                    'message' => 'User updated successfully',
                    'data' => $this->users[$index]
                ], 200);
            }
        }

        return response()->json([
            'message' => 'Cannot find user to update'
        ], 404);
    }

    // delete specific user ----------------
    public function deleteUser(string $id)
    {
        foreach ($this->users as $index => $user) {
            if ($user['id'] == $id) {
                // Remove user from array
                array_splice($this->users, $index, 1);

                return response()->json([
                    'message' => 'User deleted successfully'
                ], 200);
            }
        }

        return response()->json([
            'message' => 'Cannot find user to delete'
        ], 404);
    }
}
