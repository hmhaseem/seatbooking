@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.loanApplication.title_singular') }}
    </div>
    <!-- 
    <div class="card-body">
        <form method="POST" action="{{ route("admin.loan-applications.update", [$loanApplication->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="loan_amount">{{ trans('cruds.loanApplication.fields.loan_amount') }}</label>
                <input class="form-control {{ $errors->has('loan_amount') ? 'is-invalid' : '' }}" type="number" name="loan_amount" id="loan_amount" value="{{ old('loan_amount', $loanApplication->loan_amount) }}" step="0.01" required>
                @if($errors->has('loan_amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('loan_amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.loanApplication.fields.loan_amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.loanApplication.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $loanApplication->description) }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.loanApplication.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status_id">{{ trans('cruds.loanApplication.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id">
                    @foreach($statuses as $id => $status)
                        <option value="{{ $id }}" {{ old('status_id') == $id ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.loanApplication.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div> -->

    <div class="col-12 mb-4">

        <div class="bs-stepper wizard-vertical vertical wizard-vertical-icons-example mt-2">
            <div class="bs-stepper-header">
                <div class="step" data-target="#account-details-vertical">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-circle">
                            <i class="bx bx-detail"></i>
                        </span>
                        <span class="bs-stepper-label mt-1">
                            <span class="bs-stepper-title">Basic Information</span>
                            <span class="bs-stepper-subtitle">Setup Basic Information</span>
                        </span>
                    </button>
                </div>
                <div class="line"></div>
                <div class="step" data-target="#personal-info-vertical">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-circle">
                            <i class="bx bx-user"></i>
                        </span>
                        <span class="bs-stepper-label mt-1">
                            <span class="bs-stepper-title">Bank Details</span>
                            <span class="bs-stepper-subtitle">Add bank details</span>
                        </span>
                    </button>
                </div>
                <div class="line"></div>
                <div class="step" data-target="#social-links-vertical">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-circle">
                            <i class="bx bxl-instagram"></i>
                        </span>
                        <span class="bs-stepper-label mt-1">
                            <span class="bs-stepper-title">Family Income </span>
                            <span class="bs-stepper-subtitle">Add family income</span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="bs-stepper-content">
                <form method="POST" action="{{ route("admin.loan-applications.update", [$loanApplication->id]) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <!-- Account Details -->
                    <div id="account-details-vertical" class="content">
                        <div class="content-header mb-3">
                            <h6 class="mb-0">Basic Details</h6>
                            <small>Enter Basic Details.</small>
                        </div>
                        <div class="row g-3">
                            <div class="col-sm-6">

                                <label class="required form-label" for="name">Name</label>
                                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('loan_amount', $loanApplication->name) }}" required>
                                @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <label class="required form-label" for="gender">Gender </label>
                                <select name="gender" class="form-control" id="gender">
                                    <option value="0">Select Gender </option>
                                    <option value="male">Male </option>
                                    <option value="female">Female </option>
                                </select>
                                @if($errors->has('gender'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('gender') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <label for="status_id " class="required form-label">{{ trans('cruds.loanApplication.fields.status') }}</label>
                                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id">
                                    @foreach($statuses as $id => $status)
                                    <option value="{{ $id }}" {{ old('status_id') == $id ? 'selected' : '' }}>{{ $status }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.loanApplication.fields.status_helper') }}</span>
                            </div>
                            <div class="col-sm-6">
                                <label class="required form-label" for="name">Nic</label>
                                <input class="form-control {{ $errors->has('nic') ? 'is-invalid' : '' }}" type="text" name="nic" id="nic" value="{{ old('nic', '') }}" required>
                                @if($errors->has('nic'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nic') }}
                                </div>
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <label class="required form-label" for="name">Address</label>
                                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', '') }}" required>

                                @if($errors->has('address'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('address') }}
                                </div>
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <label for="address2 " class="form-label">Address 2 (Optional)</label>
                                <input class="form-control {{ $errors->has('address2') ? 'is-invalid' : '' }}" type="text" name="address2" id="address2" value="{{ old('address', '') }}">

                                @if($errors->has('address2'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('address2') }}
                                </div>
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <label class="required form-label" for="city">City</label>
                                <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('address', '') }}" required>

                                @if($errors->has('city'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('city') }}
                                </div>
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <label class="required form-label" for="name">Phone</label>
                                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}" required maxlength="10">
                                @if($errors->has('phone'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('phone') }}
                                </div>
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <label class="required form-label" for="married_status">Married Status</label>
                                <select name="married_status" class="form-control select2">
                                    <option value="single"> Single </option>
                                    <option value="married">
                                        Married
                                    </option>
                                    <option value="divorced">
                                        Divorced
                                    </option>
                                </select>
                                @if($errors->has('married_status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('married_status') }}
                                </div>
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <label for="name" class=" form-label">Email</label>
                                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', '') }}">
                                @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <label class="required form-label" for="nic_photo">Nic / Driving licence (Front)</label>
                                <input type="file" class="form-control" name="nic_photo" id="nic_photo" />
                            </div>

                            <div class="col-sm-6">
                                <label class="required form-label" for="nic_back">Nic / Driving licence (Back)</label>
                                <input type="file" class="form-control" name="nic_back" id="nic_back" />
                            </div>

                            <div class="col-sm-6">
                                <label class="required form-label" for="loan_amount">{{ trans('cruds.loanApplication.fields.loan_amount') }}</label>
                                <input class="form-control {{ $errors->has('loan_amount') ? 'is-invalid' : '' }}" type="number" name="loan_amount" id="loan_amount" value="{{ old('loan_amount', $loanApplication->loan_amount) }}" step="0.01" required maxlength="20">
                                @if($errors->has('loan_amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('loan_amount') }}
                                </div>
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <label class="required form-label" for="term_type">Term type</label>
                                <select name="term_type" class="form-control select2" id="term_type">
                                    <option value="0">Select Type </option>
                                    @foreach($loanTypes as $loanTypes)
                                    <option value="{{$loanTypes->id}}" data-interest="{{$loanTypes->interest_rate}}">{{$loanTypes->product_name}} </option>
                                    @endforeach
                                </select>
                                @if($errors->has('term_type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('term_type') }}
                                </div>
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <label class="required form-label" for="loan_term">Loan Term </label>
                                <select name="loan_term" class="form-control select2" id="loan_term">
                                    <option value="0">Select Term </option>
                                    @foreach($loarnTerms as $term)
                                    <option value="{{$term}}">{{$term}} </option>
                                    @endforeach
                                </select>
                                @if($errors->has('loan_term'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('loan_term') }}
                                </div>
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <label class="required form-label" for="interest">Interest</label>
                                <input class="form-control {{ $errors->has('interest') ? 'is-invalid' : '' }}" readonly type="number" name="interest" id="interest" value="{{ old('interest', '') }}" step="0.01" required>
                                @if($errors->has('interest'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('interest') }}
                                </div>
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <label class="required form-label" for="total_amount">Total Amount With Intrest</label>
                                <input class="form-control {{ $errors->has('total_amount') ? 'is-invalid' : '' }}" readonly type="number" name="total_amount" id="total_amount" value="{{ old('total_amount', '') }}" step="0.01" required>
                                @if($errors->has('total_amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('total_amount') }}
                                </div>
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <label class="required form-label" for="weekly_pay">Weekly Pay</label>
                                <input class="form-control {{ $errors->has('weekly_pay') ? 'is-invalid' : '' }}" readonly type="number" name="weekly_pay" id="weekly_pay" value="{{ old('weekly_pay', '') }}" step="0.01" required>
                                @if($errors->has('weekly_pay'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('weekly_pay') }}
                                </div>
                                @endif
                            </div>



                            <div class="col-12 d-flex justify-content-between">
                                <button class="btn btn-label-secondary btn-prev" disabled>
                                    <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                </button>
                                <button class="btn btn-primary btn-next">
                                    <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                    <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Personal Info -->
                    <div id="personal-info-vertical" class="content">
                        <div class="content-header mb-3">
                            <h6 class="mb-0">Bank Details</h6>
                            <small>Enter Bank Details.</small>
                        </div>
                        <div class="row g-3">
                            <div class="col-sm-6">

                                <label class="required form-label" for="bank_name">Bank Name</label>
                                <input class="form-control {{ $errors->has('bank_name') ? 'is-invalid' : '' }}" type="text" name="bank_name" id="bank_name" value="{{ old('bank_name', '') }}" required>
                                @if($errors->has('bank_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('bank_name') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <label class="required form-label" for="branch">Branch Name</label>
                                <input class="form-control {{ $errors->has('branch') ? 'is-invalid' : '' }}" type="text" name="branch" id="branch" value="{{ old('branch', '') }}" required>
                                @if($errors->has('branch'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('branch') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <label class="required form-label" for="branch">Account </label>
                                <input class="form-control {{ $errors->has('account_no') ? 'is-invalid' : '' }}" type="text" name="account_no" id="account_no" value="{{ old('account_no', '') }}" required maxlength="20">
                                @if($errors->has('account_no'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('account_no') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <label class="required form-label" for="remarks">remarks </label>
                                <input class="form-control {{ $errors->has('remarks') ? 'is-invalid' : '' }}" type="text" name="remarks" id="remarks" value="{{ old('remarks', '') }}" required>
                                @if($errors->has('remarks'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('remarks') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-12 d-flex justify-content-between">
                                <button class="btn btn-primary btn-prev">
                                    <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                </button>
                                <button class="btn btn-primary btn-next">
                                    <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                    <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Social Links -->
                    <div id="social-links-vertical" class="content">
                        <div class="content-header mb-3">
                            <h6 class="mb-0">Family Income</h6>
                            <small>Enter family income.</small>
                        </div>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label class="required" for="income_type">Income type</label>
                                <select name="income_type" class="form-control select2" id="term_type">
                                    <option value="0">Select Type </option>
                                    @foreach($incomeTypes as $incomeType)
                                    <option value="{{$loanTypes->id}}">{{$incomeType->name}} </option>
                                    @endforeach

                                </select>
                                @if($errors->has('income_type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('income_type') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <label class="required" for="income">Income </label>
                                <input class="form-control {{ $errors->has('income_amount') ? 'is-invalid' : '' }}" type="text" name="income_amount" id="income_amount" value="{{ old('income_amount', '') }}" required maxlength="20">
                                @if($errors->has('income_amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('income_amount') }}
                                </div>
                                @endif

                            </div>
                            <div class="col-sm-6">
                                <label class="required" for="expenses">Expenses </label>
                                <input class="form-control {{ $errors->has('expenses') ? 'is-invalid' : '' }}" type="text" name="expenses" id="expenses" value="{{ old('expenses', '') }}" required maxlength="20">
                                @if($errors->has('expenses'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('expenses') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <label class="required" for="branch">Loan purpose </label>
                                <input class="form-control {{ $errors->has('loan_purpose') ? 'is-invalid' : '' }}" type="text" name="loan_purpose" id="loan_purpose" value="{{ old('loan_purpose', '') }}" required maxlength="20">
                                @if($errors->has('loan_purpose'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('loan_purpose') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-12 d-flex justify-content-between">
                                <button class="btn btn-primary btn-prev">
                                    <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                </button>
                                <button class="btn btn-success btn-submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>



@endsection

@section('scripts')

<script>
    $(document).ready(function() {

        let loanAmount = 0;
        let intrestRate = 0;
        let totalAmount = 0;
        let weeklyPay = 0;

        $("#loan_amount").keyup(function(event) {
            loanAmount = $('#loan_amount').val();
            getCalculate();
        });


        $('#term_type').on('change', function() {
            getCalculate();
        });

        $('#loan_term').on('change', function() {
            getCalculate();
        });

        function getCalculate() {
            let interest = $('#term_type').find('option').filter(':selected').data('interest');
            let term = $('#loan_term').find('option').filter(':selected').text();
            let intrestRate = loanAmount * (interest / 100) * term;
            let totalAmount = (+loanAmount + +intrestRate);
            let weeklyPay = totalAmount / term;
            $("#interest").val(intrestRate.toFixed(2));
            $('#total_amount').val(totalAmount.toFixed(2));
            $('#weekly_pay').val(weeklyPay.toFixed(2));

        }






    })
</script>
@endsection