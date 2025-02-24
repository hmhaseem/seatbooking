<?php

namespace App\Http\Controllers\Admin;

use App\Bank;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLoanApplicationRequest;
use App\Http\Requests\StoreLoanApplicationRequest;
use App\Http\Requests\UpdateLoanApplicationRequest;
use App\CustomerApplication;
use App\Http\Requests\StoreCustomerApplicationRequest;
use App\Role;
use App\Services\AuditLogService;
use App\Status;
use App\InterestType;
use Bugsnag\DateTime\Date;
use Gate;
use App\IncomeType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerApplicationsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('customer_application_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customerApplications = CustomerApplication::with('status', 'analyst', 'cfo')->get();
        $defaultStatus    = Status::find(1);
        $user             = auth()->user();

        return view('admin.customerApplications.index', compact('customerApplications', 'defaultStatus', 'user'));
    }

    public function create()
    {
        abort_if(Gate::denies('customer_application_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $loanTypes = InterestType::all();
        $incomeTypes = IncomeType::all();
        $loarnTerms = [];
        for ($i = 1; $i <= 48; $i++) {
            $loarnTerms[$i] = $i;
        }

        return view('admin.customerApplications.create', compact('loarnTerms', 'loanTypes', 'incomeTypes'));
    }

    public function store(StoreCustomerApplicationRequest $request)
    {
        $date = Carbon::now();
        $requestData = $request->all();
        if ($request->hasFile('nic_photo')) {
            $randomize = rand(111111, 999999);
            $extension = $request->file('nic_photo')->getClientOriginalExtension();
            $filenameFront = $randomize . '.' . $extension;
            $request->nic_photo->move('uploads/', $filenameFront);
            $requestData['nic_photo'] = $filenameFront;
        }

        if ($request->hasFile('nic_back')) {
            $randomize = rand(111111, 999999);
            $extension = $request->file('nic_back')->getClientOriginalExtension();
            $filenameBackEnd = $randomize . '.' . $extension;
            $request->nic_back->move('uploads/', $filenameBackEnd);
            $requestData['nic_back'] = $filenameBackEnd;
        }

        $bank = new Bank;
        $bank->name = $requestData['bank_name'];
        $bank->account_no = $requestData['account_no'];
        $bank->branch = $requestData['branch'];
        $bank->remarks = $requestData['remarks'];
        $bank->created_at = $date->toDateTimeString();;
        $bank->updated_at = $date->toDateTimeString();;
        $bank->save();
        $requestData['bank_id'] = $bank->id;
        $loanApplication = CustomerApplication::create($requestData);

        return redirect()->route('admin.customer-applications.index');
    }

    public function edit(CustomerApplication $customerApplication)
    {
        abort_if(
            Gate::denies('loan_application_edit'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $loanTypes = InterestType::all();
        $incomeTypes = IncomeType::all();
        $loarnTerms = [];
        for ($i = 1; $i <= 48; $i++) {
            $loarnTerms[$i] = $i;
        }
        $statuses = Status::whereIn('id', [1, 8, 9])->pluck('name', 'id');

        $customerApplication->load('status');

        return view('admin.customerApplications.edit', compact('statuses', 'customerApplication', 'loanTypes', 'incomeTypes', 'loarnTerms'));
    }

    public function update(UpdateLoanApplicationRequest $request, CustomerApplication $customerApplication)
    {
        $customerApplication->update($request->only('loan_amount', 'description', 'status_id'));

        return redirect()->route('admin.loan-applications.index');
    }

    public function show(CustomerApplication $customerApplication)
    {
        abort_if(Gate::denies('loan_application_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customerApplication->load('status', 'analyst', 'cfo', 'created_by', 'logs.user', 'comments');
        $defaultStatus = Status::find(1);
        $user          = auth()->user();
        //  $logs          = AuditLogService::generateLogs($customerApplication);

        return view('admin.loanApplications.show', compact('loanApplication', 'defaultStatus', 'user', 'logs'));
    }

    public function destroy(CustomerApplication $loanApplication)
    {
        abort_if(Gate::denies('loan_application_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $loanApplication->delete();

        return back();
    }

    public function massDestroy(MassDestroyLoanApplicationRequest $request)
    {
        CustomerApplication::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function showSend(CustomerApplication $loanApplication)
    {
        abort_if(!auth()->user()->is_admin, Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($loanApplication->status_id == 1) {
            $role = 'Operation Manager';
            $users = Role::find(7)->users->pluck('name', 'id');
        } else if (in_array($loanApplication->status_id, [3, 4])) {
            $role = 'CFO';
            $users = Role::find(5)->users->pluck('name', 'id');
        } else {
            abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        return view('admin.customer.send', compact('loanApplication', 'role', 'users'));
    }

    public function send(Request $request, CustomerApplication $loanApplication)
    {
        abort_if(!auth()->user()->is_admin, Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($loanApplication->status_id == 1) {
            $column = 'analyst_id';
            $users  = Role::find(7)->users->pluck('id');
            $status = 2;
        } else if (in_array($loanApplication->status_id, [3, 4])) {
            $column = 'cfo_id';
            $users  = Role::find(5)->users->pluck('id');
            $status = 5;
        } else {
            abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $request->validate([
            'user_id' => 'required|in:' . $users->implode(',')
        ]);

        $loanApplication->update([
            $column => $request->user_id,
            'status_id' => $status
        ]);

        return redirect()->route('admin.customer-applications.index')->with('message', 'Loan application has been sent for Operation Manager');
    }

    public function showAnalyze(CustomerApplication $loanApplication)
    {
        $user = auth()->user();

        abort_if(
            (!$user->is_analyst || $loanApplication->status_id != 2) && (!$user->is_cfo || $loanApplication->status_id != 5),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        return view('admin.customerApplications.analyze', compact('loanApplication'));
    }

    public function analyze(Request $request, CustomerApplication $loanApplication)
    {
        $user = auth()->user();

        if ($user->is_analyst && $loanApplication->status_id == 2) {
            $status = $request->has('approve') ? 3 : 4;
        } else if ($user->is_cfo && $loanApplication->status_id == 5) {
            $status = $request->has('approve') ? 6 : 7;
        } else {
            abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $request->validate([
            'comment_text' => 'required'
        ]);

        $loanApplication->comments()->create([
            'comment_text' => $request->comment_text,
            'user_id'      => $user->id
        ]);

        $loanApplication->update([
            'status_id' => $status
        ]);

        return redirect()->route('admin.customer-applications.index')->with('message', 'Analysis has been submitted');
    }
}
