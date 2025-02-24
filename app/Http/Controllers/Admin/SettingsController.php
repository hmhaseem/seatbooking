<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Role;
use App\User;
use Gate;
use App\InterestType;
use App\IncomeType;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use \DB;
use Validator;

class SettingsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('settings_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $rows = InterestType::all();
        return view('admin.settings.settings', compact('rows'));
    }

    public function store(Request $request)
    {

        abort_if(Gate::denies('settings_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'row.*.product_name' => 'required',
            'row.*.interest_rate' => 'required'
        ]);





        DB::statement("truncate interest_type");

        foreach ($request->row as $row) {
            InterestType::create($row);
        }

        return back()->with('success', 'Intrest rate has been added.');
    }

    //IncomeType

    public function income()
    {
        abort_if(Gate::denies('settings_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $rows = IncomeType::all();
        return view('admin.settings.settings-income-type', compact('rows'));
    }

    public function incomeStore(Request $request)
    {

        abort_if(Gate::denies('settings_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'row.*.name' => 'required',

        ]);

        DB::statement("truncate income_type");

        foreach ($request->row as $row) {
            IncomeType::create($row);
        }

        return back()->with('success', 'Income has been added.');
    }
}
