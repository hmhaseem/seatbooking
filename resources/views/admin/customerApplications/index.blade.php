@extends('layouts.admin')
@section('content')
    @can('loan_application_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.customer-applications.create') }}">
                    {{ trans('global.add') }} Customer Applications
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.loanApplication.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-LoanApplication">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.loanApplication.fields.id') }}
                            </th>
                            <th>
                                Name
                            </th>
                            <th>
                                Nic
                            </th>

                        

                            <th>
                             Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customerApplications as $key => $loanApplication)
                            <tr data-entry-id="{{ $loanApplication->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $loanApplication->id ?? '' }}
                                </td>
                                <td>
                                    {{ $loanApplication->name ?? '' }}
                                </td>
                                <td>
                                    {{ $loanApplication->nic ?? '' }}
                                </td>


                                <td>
                                    @can('customer_application_show')
                                        <a class="btn btn-xs btn-primary"
                                            href="{{ route('admin.customer-applications.show', $loanApplication->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @if (Gate::allows('customer_application_edit'))
                                        <a class="btn btn-xs btn-info"
                                            href="{{ route('admin.customer-applications.edit', $loanApplication->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endif

                                    @can('customer_application_delete')
                                        <form action="{{ route('admin.loan-applications.destroy', $loanApplication->id) }}"
                                            method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                            style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger"
                                                value="{{ trans('global.delete') }}">
                                        </form>
                                    @endcan

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


    </div>
@endsection
@section('scripts')
    <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
    @parent

    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('loan_application_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.loan-applications.massDestroy') }}",
                    className: 'btn-danger',
                    action: function(e, dt, node, config) {
                        var ids = $.map(dt.rows({
                            selected: true
                        }).nodes(), function(entry) {
                            return $(entry).data('entry-id')
                        });

                        if (ids.length === 0) {
                            alert('{{ trans('global.datatables.zero_selected') }}')

                            return
                        }

                        if (confirm('{{ trans('global.areYouSure') }}')) {
                            $.ajax({
                                    headers: {
                                        'x-csrf-token': _token
                                    },
                                    method: 'POST',
                                    url: config.url,
                                    data: {
                                        ids: ids,
                                        _method: 'DELETE'
                                    }
                                })
                                .done(function() {
                                    location.reload()
                                })
                        }
                    }
                }
                dtButtons.push(deleteButton)
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 100,
            });
            let table = $('.datatable-LoanApplication:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
