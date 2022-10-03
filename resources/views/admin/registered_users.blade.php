@extends('layouts.admin')
<style>
    #users {
        background-color: gray;
    }
</style>
@section('content')
    <div class="m-3">
        <h2><i class="bi-flag-fill"></i> Users</h2>
    </div>

    <table class="table table-bordered data-table nowrap py-2" style="width: 100%;">
        <thead>
            <tr class="table-primary text-uppercase">
                <td class="text-center">No.</td>
                <td class="text-center">Email</td>
                <td class="text-center">Name</td>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

<script>
    
    $(document).ready(function(){

        //ajax setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //load table
        let table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            select: true,
            responsive: true,
            ajax: "{{ route('admin.users') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'email', name: 'email'},
                {data: 'name', name: 'name'},
                // {data: 'action', name: 'action', orderable: false, searchable: false, class:'text-center'},
            ],
        });

        //show modal
            // SHOW ADD MODAL
        $('#addBanner').click(function () {
            $('#id').val('');
            $('#bannerForm').trigger("reset");
            $('#addModal').modal('show');
            $('#savedata').html('Save');
        });


        //add function
        // $('#bannerForm').submit(function(e){
        //     e.preventDefault();
        //     let formData = new FormData(this);
        //     $.ajax({
        //         type: 'POST',
        //         url: "{{ route('admin.banner.store') }}",
        //         data: formData,
        //         contentType: false,
        //         processData: false,
        //         success: (response) => {
        //             if(response){
        //                 this.reset();
        //                 table.draw();
        //             }
        //         },
        //         error: function(response){
        //             $('#image-input-error').text(response.responseJSON.message);
        //         }
        //     });
        // });

        // // DELETE 
        // $('body').on('click', '.deleteBanner', function () {
        // var id = $(this).data("id");
        //     if (confirm("Are You sure want to delete this banner?") === true) {
        //         $.ajax({
        //             type: "DELETE",
        //             url: "{{ url('admin/banner/destroy') }}",
        //             data:{
        //             id:id
        //             },
        //             success: function (data) {
        //             table.draw();
        //             // toastr.success('Expense deleted successfully','Success');
        //             },
        //             error: function (data) {
        //             // toastr.error(data['responseJSON']['message'],'Error has occured');
        //             }
        //         });
        //     }
        // });

    }); //end of script


</script>

@endsection
