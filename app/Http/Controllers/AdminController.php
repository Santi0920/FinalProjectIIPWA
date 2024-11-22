<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use User;

class AdminController extends Controller
{
    public function list(){
        $employees = DB::select('SELECT * FROM users WHERE deleted = 0');


        return view('admin/index', ['employees' => $employees]);
    }


    public function create(Request $request){
        $queryEmail = DB::select('SELECT * FROM users WHERE email = ?', [$request->addEmail]);
        if(!empty($queryEmail)){
            return redirect()->to('/adminindex')->with('incorrecto', 'Email '.$request->addEmail.' already exists on Database.');
        }


        $encrypt = bcrypt($request->addPassword);
        $idinsertado = DB::table('users')->insertGetId([
            'name' => $request->addName,
            'email' => $request->addEmail,
            'password' => $encrypt,
            'role' => $request->addRole,
            'salary' => $request->addSalary,
            'nationality' => $request->addNationality,
        ]);

        return redirect()->to('/adminindex')->with('correcto', 'The employee '.$request->addName .' with ID '.$idinsertado .'  was successfully created!');
    }


    public function update(Request $request,$id){

        DB::table('users')
        ->where('id', $id)
        ->update([
            'name' => $request->editName,
            'email' => $request->editEmail,
            'role' => $request->editRole,
            'salary' => $request->editSalary,
            'bonus' => $request->editBonus,
            'hoursworked' => $request->editHoursWorked,
            'performance' => $request->editPerformance,
        ]);

        return redirect()->to('/adminindex')->with('correcto', 'The employee '.$request->editName .'  was successfully updated!');
    }

    public function delete(Request $request,$id, $name){
        $id = $id;

        DB::table('users')
        ->where('id', $id)
        ->update([
            'deleted' => 1,
        ]);;



        return redirect()->to('/adminindex')->with('correcto', 'The employee with ID '.$id .' and name '.$name.' was successfully deleted!');
    }


    public function employeemonth(Request $request,$id, $name){
        $id = $id;

        DB::table('users')
        ->update([
            'employmonth' => 0,
            'month' => null
        ]);

        DB::table('users')
        ->where('id', $id)
        ->update([
            'employmonth' => 1,
            'month' => now()->format('F')
        ]);





        return redirect()->to('/adminindex')->with('correcto', 'The employee of the month('.now()->format('F').') is '.$name.' with ID '.$id .'.');
    }
}
