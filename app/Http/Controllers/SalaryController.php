<?php

namespace App\Http\Controllers;

use App\Salary;
use Illuminate\Http\Request;
use DB;

class SalaryController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'Hackathon-API-v1-stable'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'salary_amount' => 'required',
            'payday_date' => 'required'
        ]);

        $salary_amount = $request->salary_amount;
        $payday_date = $request->payday_date;
        $status = true;

        $query = DB::table('users_hack')->insert([
            'name' => 'Mohd Rakuten', 
            'payday_date' => $payday_date,
            'salary_amount' => $salary_amount
        ]);
        
        return response()->json([
            'message' => 'Success!',
            'status' => $status,
            'salary_amount' => $salary_amount,
            'payday_date' => $payday_date
        ]);
    }

    public function statement(Request $request)
    {
        $users = DB::table('users_hack')->orderBy('id', 'desc')->get()->take(1);
        $users_cc = DB::table('users_cc')->get();

        return response()->json([
            'users' => $users,
            'users_cc' => $users_cc
        ]);
    }
}
