<?php
namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.index', compact('users'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        try {
            DB::beginTransaction();

            User::truncate();

            Excel::import(new UsersImport, $request->file('file'));

            DB::commit();

            return redirect()->back()->with('success', 'Data Imported Successfully');
        } catch (\Exception $e) {
            DB::rollBack(); 
            return redirect()->back()->with('error', 'Error Importing Data: ' . $e->getMessage());
        }
    }
    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
