@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} Customer Application
        </div>


        <div class="col-12 mb-4">

            <div class="bs-stepper wizard-vertical vertical   mt-2" id="wizard-validation">
                <div class="bs-stepper-header">
                    <div class="step" data-target="#account-details-validation">
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
                    <div class="step" data-target="#personal-info-validation">
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
                    <div class="step" data-target="#social-links-validation">
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
                    <form method="POST" action="{{ route('admin.loan-applications.update', [$customerApplication->id]) }}"
                        enctype="multipart/form-data" id="wizard-validation-form" onSubmit="return false" novalidate>
                        @method('PUT')
                        @csrf
                        <!-- Account Details -->
                        <div id="account-details-validation" class="content">
                            <div class="content-header mb-3">
                                <h6 class="mb-0">Basic Details</h6>
                                <small>Enter Basic Details.</small>
                            </div>
                            <div class="row g-3">
                                <div class="col-sm-6">

                                    <label class="required form-label" for="name">Name</label>
                                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                        type="text" name="name" id="name"
                                        value="{{ old('loan_amount', $customerApplication->name) }}">
                                    @if ($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    <label class="required form-label" for="gender">Gender </label>
                                    <select name="gender" class="form-control select2" id="gender">
                                        <option value="0">Select Gender </option>
                                        <option value="male">Male </option>
                                        <option value="female">Female </option>
                                    </select>
                                    @if ($errors->has('gender'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('gender') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    <label for="status_id "
                                        class="required form-label">{{ trans('cruds.loanApplication.fields.status') }}</label>
                                    <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}"
                                        name="status_id" id="status_id">
                                        @foreach ($statuses as $id => $status)
                                            <option value="{{ $id }}"
                                                {{ old('status_id') == $id ? 'selected' : '' }}>{{ $status }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('status'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('status') }}
                                        </div>
                                    @endif
                                    <span
                                        class="help-block">{{ trans('cruds.loanApplication.fields.status_helper') }}</span>
                                </div>
                                <div class="col-sm-6">
                                    <label class="required form-label" for="nic">Nic</label>
                                    <input class="form-control {{ $errors->has('nic') ? 'is-invalid' : '' }}"
                                        type="text" name="nic" id="nic" value="{{ old('nic', $customerApplication->nic) }}" required>
                                    @if ($errors->has('nic'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('nic') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="col-sm-6">
                                    <label class="required form-label" for="name">Address</label>
                                    <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                        type="text" name="address" id="address" value="{{ old('address', $customerApplication->address) }}"
                                        required>

                                    @if ($errors->has('address'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('address') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="col-sm-6">
                                    <label for="address2 " class="form-label">Address 2 (Optional)</label>
                                    <input class="form-control {{ $errors->has('address2') ? 'is-invalid' : '' }}"
                                        type="text" name="address2" id="address2" value="{{ old('address2', $customerApplication->address) }}">

                                    @if ($errors->has('address2'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('address2') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="col-sm-6">
                                    <label class="required form-label" for="city">City</label>
                                    <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}"
                                        type="text" name="city" id="city" value="{{ old('city', $customerApplication->city) }}"
                                        required>

                                    @if ($errors->has('city'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('city') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="col-sm-6">
                                    <label class="required form-label" for="phone">Phone</label>
                                    <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                        type="text" name="phone" id="phone" value="{{ old('phone', $customerApplication->phone) }}"
                                        required maxlength="10">
                                    @if ($errors->has('phone'))
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
                                    @if ($errors->has('married_status'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('married_status') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="col-sm-6">
                                    <label for="name" class=" form-label">Email</label>
                                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                        type="email" name="email" id="email" value="{{ old('email', $customerApplication->email) }}">
                                    @if ($errors->has('email'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="col-sm-6">
                                    <label class="required form-label" for="nic_photo">Nic / Driving licence
                                        (Front)</label>
                                    <input type="file" class="form-control" name="nic_photo" id="nic_photo" />
                                </div>

                                <div class="col-sm-6">
                                    <label class="required form-label" for="nic_back">Nic / Driving licence (Back)</label>
                                    <input type="file" class="form-control" name="nic_back" id="nic_back" />
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
                        <div id="personal-info-validation" class="content">
                            <div class="content-header mb-3">
                                <h6 class="mb-0">Bank Details</h6>
                                <small>Enter Bank Details.</small>
                            </div>
                            <div class="row g-3">
                                <div class="col-sm-6">

                                    <label class="required form-label" for="bank_name">Bank Name</label>
                                    <input class="form-control {{ $errors->has('bank_name') ? 'is-invalid' : '' }}"
                                        type="text" name="bank_name" id="bank_name"
                                        value="{{ old('bank_name', '') }}" required>
                                    @if ($errors->has('bank_name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('bank_name') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    <label class="required form-label" for="branch">Branch Name</label>
                                    <input class="form-control {{ $errors->has('branch') ? 'is-invalid' : '' }}"
                                        type="text" name="branch" id="branch" value="{{ old('branch', '') }}"
                                        required>
                                    @if ($errors->has('branch'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('branch') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    <label class="required form-label" for="branch">Account </label>
                                    <input class="form-control {{ $errors->has('account_no') ? 'is-invalid' : '' }}"
                                        type="text" name="account_no" id="account_no"
                                        value="{{ old('account_no', '') }}" required maxlength="20">
                                    @if ($errors->has('account_no'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('account_no') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    <label class="required form-label" for="remarks">remarks </label>
                                    <input class="form-control {{ $errors->has('remarks') ? 'is-invalid' : '' }}"
                                        type="text" name="remarks" id="remarks" value="{{ old('remarks', '') }}"
                                        required>
                                    @if ($errors->has('remarks'))
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
                        <div id="social-links-validation" class="content">
                            <div class="content-header mb-3">
                                <h6 class="mb-0">Family Income</h6>
                                <small>Enter family income.</small>
                            </div>
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label class="required" for="income_type">Income type</label>
                                    <select name="income_type" class="form-control select2" id="term_type">
                                        <option value="0">Select Type </option>
                                        @foreach ($incomeTypes as $incomeType)
                                            <option value="{{ $incomeType->id }}">{{ $incomeType->name }} </option>
                                        @endforeach

                                    </select>
                                    @if ($errors->has('income_type'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('income_type') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    <label class="required" for="income">Income </label>
                                    <input class="form-control {{ $errors->has('income_amount') ? 'is-invalid' : '' }}"
                                        type="text" name="income_amount" id="income_amount"
                                        value="{{ old('income_amount', '') }}" required maxlength="20">
                                    @if ($errors->has('income_amount'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('income_amount') }}
                                        </div>
                                    @endif

                                </div>
                                <div class="col-sm-6">
                                    <label class="required" for="expenses">Expenses </label>
                                    <input class="form-control {{ $errors->has('expenses') ? 'is-invalid' : '' }}"
                                        type="text" name="expenses" id="expenses" value="{{ old('expenses', '') }}"
                                        required maxlength="20">
                                    @if ($errors->has('expenses'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('expenses') }}
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
        const select2 = $('.select2'),
            selectPicker = $('.selectpicker');

        const wizardValidation = document.querySelector('#wizard-validation');

        if (typeof wizardValidation !== undefined && wizardValidation !== null) {
            // Wizard form
            const wizardValidationForm = wizardValidation.querySelector('#wizard-validation-form');
            // Wizard steps
            const wizardValidationFormStep1 = wizardValidationForm.querySelector('#account-details-validation');
            const wizardValidationFormStep2 = wizardValidationForm.querySelector('#personal-info-validation');
            const wizardValidationFormStep3 = wizardValidationForm.querySelector('#social-links-validation');
            // Wizard next prev button
            const wizardValidationNext = [].slice.call(wizardValidationForm.querySelectorAll('.btn-next'));
            const wizardValidationPrev = [].slice.call(wizardValidationForm.querySelectorAll('.btn-prev'));

            let validationStepper = new Stepper(wizardValidation, {
                linear: true
            });

            // Account details
            const FormValidation1 = FormValidation.formValidation(wizardValidationFormStep1, {
                fields: {
                    name: {
                        validators: {
                            notEmpty: {
                                message: 'The name is required'
                            },


                        }
                    },

                    nic: {
                        validators: {
                            notEmpty: {
                                message: 'The nic is required'
                            },
                            regexp: {
                                regexp: /^([0-9]{9}[x|X|v|V]|[0-9]{12})$/,
                                message: 'Make sure nic is valid'
                            }
                        },

                    },
                    address: {
                        validators: {
                            notEmpty: {
                                message: 'The address is required'
                            }
                        },

                    },
                    phone: {
                        validators: {
                            notEmpty: {
                                message: 'The phone no is required'
                            },
                            regexp: {
                                regexp: /^(?:7|0|(?:\+94))[0-9]{9,10}$/,
                                message: 'Make sure phone number is valid'
                            }
                        },

                    },

                    city: {
                        validators: {
                            notEmpty: {
                                message: 'The address is required'
                            }
                        },

                    },
                    nic_photo: {
                        validators: {
                            file: {
                                extension: 'jpeg,gif,png',
                                type: 'image/jpeg,image/gif,image/png',
                                message: 'Please choose a jpeg/png/gif file format',
                            },
                            notEmpty: {
                                message: 'The nic front image is required'
                            }
                        },

                    },
                    nic_back: {
                        validators: {
                            file: {
                                extension: 'jpeg,gif,png',
                                type: 'image/jpeg,image/gif,image/png',
                                message: 'Please choose a jpeg/png/gif file format',
                            },
                            notEmpty: {
                                message: 'The nic back image is required'
                            }
                        },

                    },
                    gender: {
                        validators: {
                            notEmpty: {
                                message: 'The gender is required'
                            }
                        },

                    },


                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap5: new FormValidation.plugins.Bootstrap5({
                        // Use this for enabling/changing valid/invalid class
                        // eleInvalidClass: '',
                        eleValidClass: ''
                    }),
                    autoFocus: new FormValidation.plugins.AutoFocus(),
                    submitButton: new FormValidation.plugins.SubmitButton()
                },
                init: instance => {
                    instance.on('plugins.message.placed', function(e) {
                        //* Move the error message out of the `input-group` element
                        if (e.element.parentElement.classList.contains('input-group')) {
                            e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
                        }
                    });
                }
            }).on('core.form.valid', function() {
                // Jump to the next step when all fields in the current step are valid
                validationStepper.next();
            });

            // Personal info
            const FormValidation2 = FormValidation.formValidation(wizardValidationFormStep2, {
                fields: {
                    bank_name: {
                        validators: {
                            notEmpty: {
                                message: 'The bank name is required'
                            }
                        }
                    },
                    branch: {
                        validators: {
                            notEmpty: {
                                message: 'The branch is required'
                            }
                        }
                    },
                    account_no: {
                        validators: {
                            notEmpty: {
                                message: 'The account no is required'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap5: new FormValidation.plugins.Bootstrap5({
                        // Use this for enabling/changing valid/invalid class
                        // eleInvalidClass: '',
                        eleValidClass: ''
                    }),
                    autoFocus: new FormValidation.plugins.AutoFocus(),
                    submitButton: new FormValidation.plugins.SubmitButton()
                }
            }).on('core.form.valid', function() {
                // Jump to the next step when all fields in the current step are valid
                validationStepper.next();
            });

            // Bootstrap Select (i.e Language select)
            if (selectPicker.length) {
                selectPicker.each(function() {
                    var $this = $(this);
                    $this.selectpicker().on('change', function() {
                        FormValidation2.revalidateField('formValidationLanguage');
                    });
                });
            }

            // Select 2 (i.e Country select)
            if (select2.length) {
                select2
                    .select2({
                        placeholder: 'Select an country'
                    })
                    .on('change.select2', function() {
                        // Revalidate the color field when an option is chosen
                        FormValidation2.revalidateField('formValidationCountry');
                    });
            }

            // Social links
            const FormValidation3 = FormValidation.formValidation(wizardValidationFormStep3, {
                fields: {
                    income_type: {
                        validators: {
                            notEmpty: {
                                message: 'The income type is required'
                            },

                        }
                    },
                    income_amount: {
                        validators: {
                            notEmpty: {
                                message: 'The income amount is required'
                            },
                            regexp: {
                                regexp: /[+-]?([0-9]*[.])?[0-9]+/,
                                message: 'Make sure amount is valid'
                            }

                        }
                    },
                    expenses: {
                        validators: {
                            notEmpty: {
                                message: 'The expenses is required'
                            }
                        }
                    }

                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap5: new FormValidation.plugins.Bootstrap5({
                        // Use this for enabling/changing valid/invalid class
                        // eleInvalidClass: '',
                        eleValidClass: ''
                    }),
                    autoFocus: new FormValidation.plugins.AutoFocus(),
                    submitButton: new FormValidation.plugins.SubmitButton()
                }
            }).on('core.form.valid', function() {
                // You can submit the form
                wizardValidationForm.submit()
                // or send the form data to server via an Ajax request
                // To make the demo simple, I just placed an alert
                alert('Submitted..!!');
            });

            wizardValidationNext.forEach(item => {
                item.addEventListener('click', event => {
                    // When click the Next button, we will validate the current step
                    switch (validationStepper._currentIndex) {
                        case 0:
                            FormValidation1.validate();
                            break;

                        case 1:
                            FormValidation2.validate();
                            break;

                        case 2:
                            FormValidation3.validate();
                            break;

                        default:
                            break;
                    }
                });
            });

            wizardValidationPrev.forEach(item => {
                item.addEventListener('click', event => {
                    switch (validationStepper._currentIndex) {
                        case 2:
                            validationStepper.previous();
                            break;

                        case 1:
                            validationStepper.previous();
                            break;

                        case 0:

                        default:
                            break;
                    }
                });
            });
        }
    </script>
@endsection
