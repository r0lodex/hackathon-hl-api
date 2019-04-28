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
        $users = DB::table('users_hack')->orderBy('id', 'desc')->first();
        $users_cc = DB::table('users_cc')->get();

        return response()->json([
            'users' => $users,
            'users_cc' => $users_cc
        ]);
    }

    public function sync(Request $request)
    {
        $payday_date = DB::table('users_hack')->orderBy('id', 'desc')->value('payday_date');
        $ids =  \App\UsersCreditCard::pluck('id');

        $sync = DB::table('users_cc')->whereIn('id', $ids)->update(['due_date' => $payday_date]);
        $users_cc = DB::table('users_cc')->get();

        return response()->json([
            'users_cc' => $users_cc
        ]);
    }

    public function commit(Request $request)
    {
        $request->validate([
            'monthly_deduction_amount' => 'required'
        ]);

        $monthly_deduction_amount = $request->monthly_deduction_amount;

        $balance = 2000;

        $deduct = DB::table('virtual_account')->insert([
            'balance' => $balance, 
            'monthly_deduction_amount' => $monthly_deduction_amount
        ]);
        
        return response()->json([
            'message' => 'Success!',
            'balance' => $balance,
            'monthly_deduction_amount' => $monthly_deduction_amount
        ]);
    }

    public function summary(Request $request)
    {
        $salary = DB::table('users_hack')->select('salary_amount')->orderBy('id', 'desc')->first();
        $card_summary = DB::table('users_cc')->get();
        $monthly_min_payment = DB::table('users_cc')->select(DB::raw('SUM(min_payment_amount) AS total'))->value('total');
        $virtual_account = DB::table('virtual_account')->get();

        return response()->json([
            'salary' => $salary,
            'card_summary' => $card_summary,
            'monthly_min_payment' => $monthly_min_payment,
            'virtual_account' => $virtual_account,
        ]);
    }
}
