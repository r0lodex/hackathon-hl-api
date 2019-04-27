<?php

namespace App\Http\Controllers;

use App\Salary;
use Illuminate\Http\Request;
use DB;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'message' => 'Great success! New task created',
            'task' => '$task'
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
}
