@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Settings
    </div>

    <div class="card-body">
        <form name="add_name" id="add_name">


            <div class="alert alert-danger print-error-msg" style="display:none">
                <ul></ul>
            </div>


            <div class="alert alert-success print-success-msg" style="display:none">
                <ul></ul>
            </div>


            <div class="table-responsive">
                <button type="button" name="add" id="add" class="btn btn-success mb-10">Add More</button>
                <table class="table table-bordered" id="dynamic_field">
                    <?php $id = 0; ?>
                    @foreach($rows as $row)
                    <? $id++; ?>
                    <tr id="row{{$row->id}}">
                        <td><input type="text" name="row[{{$row->id}}][name]" placeholder="Product Name" class="form-control name_list" value="{{$row->name}}" /></td>
                        <td><button type="button" name="remove" id="{{$row->id}}" class="btn btn-danger btn_remove">X</button></td>
                    </tr>
                    @endforeach
                </table>
                <input type="button" name="submit" id="submit" class="btn btn-info mt-10" value="Submit" />
            </div>


        </form>
    </div>
</div>



@endsection
@section('scripts')

<script type="text/javascript">
    $(document).ready(function() {
        var postURL = "<?php echo url('admin/settings-income-type'); ?>";
        var i = <?= $id + 1; ?>;
        $('#add').click(function() {
            ++i;
            $('#dynamic_field').append('<tr id="row' + i + '" class="dynamic-added"><td><input type="text" name="row[' + i + '][name]" placeholder=" Name" class="form-control name_list" /></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
        });

        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('#submit').click(function() {
            $.ajax({
                url: postURL,
                method: "POST",
                data: $('#add_name').serialize(),
                type: 'json',
                success: function(data) {
                    if (data.error) {
                        printErrorMsg(data.error);
                    } else {
                        i = 1;
                        $('.dynamic-added').remove();
                        $('#add_name')[0].reset();
                        $(".print-success-msg").find("ul").html('');
                        $(".print-success-msg").css('display', 'block');
                        $(".print-error-msg").css('display', 'none');
                        $(".print-success-msg").find("ul").append('<li>Record Inserted Successfully.</li>');
                        setInterval(function() {
                            window.location.reload();
                        }, 1000);
                    }
                }
            });
        });


        function printErrorMsg(msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display', 'block');
            $(".print-success-msg").css('display', 'none');
            $.each(msg, function(key, value) {
                $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
            });
        }
    });
</script>
@endsection