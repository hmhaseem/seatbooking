@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.loanApplication.title_singular') }}
        </div>


        <div class="col-12 mb-4">



            <div class="container">

                <!-- Account Details -->
                <div id="account-details-vertical" class="content">

                    <div class="row g-3 mb-10">
                        <div class="col-sm-4">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                                <input type="text" class="form-control" placeholder="Search by nic..." id="nic"
                                    aria-label="Search..." aria-describedby="basic-addon-search31">

                            </div>

                        </div>
                        <div class="col-sm-2">
                            <button class="btn btn-primary" onclick="getCustomerDetails()">
                                <span class="spinner-border" role="status" aria-hidden="true"></span>
                                <i class="bx bx-search search-icon"></i>

                            </button>
                        </div>

                    </div>
                    <div class="no-result">No data found</div>
                    <div class="row g-3" id="basicData">
                        <div class="col-sm-6">
                            <label class="required form-label" for="name">Name :</label>
                            <span id="name" class="value-field"></span>

                        </div>
                        <div class="col-sm-6">
                            <label class="required form-label" for="gender">Gender :</label>
                            <span id="gender" class="value-field"></span>
                        </div>
                        <div class="col-sm-6">
                            <label class="required form-label" for="name">Nic :</label>
                            <span id="nicNumber" class="value-field"></span>
                        </div>

                        <div class="col-sm-6">
                            <label class="required form-label" for="name">Address :</label>
                            <span id="address" class="value-field"></span>

                        </div>

                        <div class="col-sm-6">
                            <label for="address2" class=" form-label">Address 2 (Optional) :</label>
                            <span id="address2" class="value-field"></span>

                        </div>

                        <div class="col-sm-6">
                            <label class="required form-label" for="city">City :</label>
                            <span id="city" class="value-field"></span>

                        </div>

                        <div class="col-sm-6">
                            <label class="required form-label" for="name">Phone :</label>
                            <span id="phoneNo" class="value-field"></span>

                        </div>

                        <div class="col-sm-6">
                            <label class="required form-label" for="married_status">Married Status :</label>
                            <span id="married_status" class="value-field"></span>

                        </div>

                        <div class="col-sm-6">
                            <label for="name" class="form-label">Email : </label>
                            <span id="email" class="value-field"></span>

                        </div>

                        <div class="col-sm-6">

                            <label class="required form-label" for="bank_name">Bank Name :</label>
                            <span id="bank_name" class="value-field"></span>
                        </div>
                        <div class="col-sm-6">
                            <label class="required form-label" for="branch">Branch Name :</label>
                            <span id="branch" class="value-field"></span>
                        </div>
                        <div class="col-sm-6">
                            <label class="required form-label" for="account">Account :</label>
                            <span id="account" class="value-field"></span>
                        </div>
                        <div class="col-sm-6">
                            <label class="required form-label" for="remarks">remarks :</label>
                            <span id="remarks" class="value-field"></span>
                        </div>

                        <div class="col-sm-6">
                            <label class="required form-label" for="income_type">Income type :</label>
                            <span id="income_type" class="value-field"></span>
                        </div>
                        <div class="col-sm-6">
                            <label class="required form-label" for="income">Income :</label>
                            <span id="income" class="value-field"></span>

                        </div>
                        <div class="col-sm-6">
                            <label class="required form-label" for="expenses">Expenses :</label>
                            <span id="expenses" class="value-field"></span>
                        </div>
                        <div class="col-sm-6">
                            <img src="" alt="front" id="nic_photo" width="100" />
                        </div>
                        <div class="col-sm-6">

                            <img src="" alt="back" id="nic_back" width="100" />
                        </div>





                    </div>

                </div>
                <hr class="hr-tag" />
                <!-- Social Links -->
                <div id="social-links-vertical" class="content">
                    <form method="POST" action="{{ route('admin.loan-applications.store') }}" >

                        @csrf
                        <div class="row g-3">


                            <div class="col-sm-6">
                                <label class="required form-label"
                                    for="loan_amount">{{ trans('cruds.loanApplication.fields.loan_amount') }}</label>
                                <input class="form-control {{ $errors->has('loan_amount') ? 'is-invalid' : '' }}"
                                    type="number" name="loan_amount" id="loan_amount"
                                    value="{{ old('loan_amount', '') }}" step="0.01" required maxlength="20">
                                @if ($errors->has('loan_amount'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('loan_amount') }}
                                    </div>
                                @endif


                                <input type="hidden" value="" name="customer_id" id="customer_id">
                            </div>

                            <div class="col-sm-6">
                                <label class="required form-label" for="term_type">Term type</label>
                                <select name="term_type" class="form-control select2" id="term_type">
                                    <option value="0">Select Type </option>
                                    @foreach ($loanTypes as $loanTypes)
                                        <option value="{{ $loanTypes->id }}"
                                            data-interest="{{ $loanTypes->interest_rate }}">
                                            {{ $loanTypes->product_name }} </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('term_type'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('term_type') }}
                                    </div>
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <label class="required form-label" for="loan_term">Loan Term </label>
                                <select name="loan_term" class="form-control select2" id="loan_term">
                                    <option value="0">Select Term </option>
                                    @foreach ($loarnTerms as $term)
                                        <option value="{{ $term }}">{{ $term }} </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('loan_term'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('loan_term') }}
                                    </div>
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <label class="required form-label" for="interest">Interest</label>
                                <input class="form-control {{ $errors->has('interest') ? 'is-invalid' : '' }}" readonly
                                    type="number" name="interest" id="interest" value="{{ old('interest', '') }}"
                                    step="0.01" required>
                                @if ($errors->has('interest'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('interest') }}
                                    </div>
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <label class="required form-label" for="total_amount">Total Amount With Intrest</label>
                                <input class="form-control {{ $errors->has('total_amount') ? 'is-invalid' : '' }}"
                                    readonly type="number" name="total_amount" id="total_amount"
                                    value="{{ old('total_amount', '') }}" step="0.01" required>
                                @if ($errors->has('total_amount'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('total_amount') }}
                                    </div>
                                @endif
                            </div>

                            <div class="col-sm-6">
                                <label class="required form-label" for="weekly_pay">Weekly Pay</label>
                                <input class="form-control {{ $errors->has('weekly_pay') ? 'is-invalid' : '' }}" readonly
                                    type="number" name="weekly_pay" id="weekly_pay"
                                    value="{{ old('weekly_pay', '') }}" step="0.01" required>
                                @if ($errors->has('weekly_pay'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('weekly_pay') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <label class="required" for="branch">Loan purpose </label>
                                <input class="form-control {{ $errors->has('loan_purpose') ? 'is-invalid' : '' }}"
                                    type="text" name="loan_purpose" id="loan_purpose"
                                    value="{{ old('loan_purpose', '') }}" required maxlength="20">
                                @if ($errors->has('loan_purpose'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('loan_purpose') }}
                                    </div>
                                @endif
                            </div>

                            <div class="col-12 d-flex justify-content-between">
                                  
                                <button class="btn btn-success btn-submit" type="submit">Submit</button>
                            </div>
                    </form>
                </div>
            </div>

        </div>
    </div>



    </div>
@endsection
@section('scripts')
    <script>
        $("#basicData").hide();
        $(".spinner-border").hide();

        $(".no-result").hide();

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

    <script>
        function getCustomerDetails() {
            $(".spinner-border").show();
            $(".search-icon").hide();


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let nic = $("#nic").val();
            var base_path = '{{ url('/admin/loan-applications-find') }}';
            console.log(base_path)
            $.ajax({
                url: base_path,
                type: "POST",
                data: {
                    nic: nic
                },
                //cache: true,
                encode: true,
                dataType: 'json',
                success: function(dataResult) {

                    $(".spinner-border").hide();
                    $(".search-icon").show();
                    console.log(dataResult);
                    if (dataResult.data != null) {
                        $("#basicData").fadeIn();
                        $(".no-result").hide();
                        let resultData = dataResult.data;

                        $("#name").text(resultData.name);
                        $("#gender").text(resultData.gender);
                        $("#email").text(resultData.email);
                        $("#phoneNo").text(resultData.phone);
                        $("#nicNumber").text(resultData.nic);
                        $("#address").text(resultData.address);
                        $("#address2").text(resultData.address2);
                        $("#married_status").text(resultData.married_status);
                        $("#nic_photo").attr('src', "{{ asset('uploads') }}" + '/' + resultData.nic_photo);
                        $("#nic_back").attr('src', "{{ asset('uploads') }}" + '/' + resultData.nic_back);
                        $("#bank_name").text(resultData.bank_name);
                        $("#branch").text(resultData.branch);
                        $("#account").text(resultData.bank_account_no);
                        $("#remarks").text(resultData.remarks);
                        $("#income_type").text(resultData.income_type);
                        $("#income").text(resultData.income_amount);
                        $("#expenses").text(resultData.expenses);
                        $("#customer_id").val(resultData.id);


                    } else {
                        $(".no-result").show();
                    }




                }
            });
        }
    </script>
@endsection
