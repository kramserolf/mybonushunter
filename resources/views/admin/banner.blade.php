@extends('layouts.admin')
<style>
    #banners {
        background-color: gray;
    }
</style>
@section('content')
    <div class="m-3">
        <h2><i class="bi-flag-fill"></i> Banners</h2>
    </div>

    <table class="table table-bordered data-table nowrap py-2" style="width: 100%;">
        <thead>
            <tr class="table-primary text-uppercase">
                <td class="text-center">No.</td>
                <td class="text-center">Title</td>
                <td class="text-center">Image</td>
                <td class="text-center">Description</td>
                <td class="text-center">Action</td>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

{{-- add modal --}}
  <div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{route('admin.banner.store')}}" type="POST" name="bannerForm" id="bannerForm" enctype="multipart/form-data">

            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">New Banner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                    {{-- hidden id --}}
                    <input type="hidden" name="id" id="id">
                  <div class="mb-3">
                      <label for="title" class="form-label">Title</label>
                      <input type="text" class="form-control text-capitalize" name="title" id="title" placeholder="">
                  </div>
                  <div class="mb-3">
                      <label for="image" class="form-label">Image</label>
                      <input type="file" class="form-control" name="image" id="inputImage">
                      <span class="text-danger" id="image-input-error"></span>
                  </div>
                  <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" name="description" id="description" placeholder="">
                </div>
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-outline-primary" name="savedata" id="savedata" >Save</button>
                  <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
              </div>
        </form>
      </div>
    </div>
  </div>


<script>
    
    $(document).ready(function(){

        //ajax setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // TOASTR OPTIONS
        // toastr.options = {
        //         "debug": false,
        //         "newestOnTop": true,
        //         "positionClass": "toast-top-right",
        //         "preventDuplicates": true,
        //         "showDuration": "300",
        //         "hideDuration": "500",
        //         "timeOut": "3000",
        //         "showEasing": "swing",
        //         "hideEasing": "linear",
        //         "showMethod": "fadeIn",
        //         "hideMethod": "fadeOut"
        // }
        //load table
        let table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            select: true,
            responsive: true,
            ajax: "{{ route('admin.banner') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'title', name: 'title'},
                {data: 'image', name: 'image'},
                {data: 'description', name: 'description'},
                {data: 'action', name: 'action', orderable: false, searchable: false, class:'text-center'},
            ],
            dom: 'Bfrtlip',
            buttons: [
                {
                    text: '<i class="bi-plus-circle"></i> Add',
                    className: 'badge bg-success fs-5',
                    action: function(e, dt, node, config){
                        // show modal
                        $('#id').val('');
                        $('#bannerForm').trigger("reset");
                        $('#addModal').modal('show');
                        $('#savedata').html('Save');
                    },
                }
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
        $('#bannerForm').submit(function(e){
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.banner.store') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    if(response){
                        this.reset();
                        toastr.success('Banner saved successfully','Success');
                        table.draw();
                    }
                },
                error: function(response){
                    toastr.error(response['responseJSON']['message'],'Error has occured');
                }
            });
        });

        // DELETE 
        $('body').on('click', '.deleteBanner', function () {
        var id = $(this).data("id");
            if (confirm("Are You sure want to delete this banner?") === true) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ url('admin/banner/destroy') }}",
                    data:{
                    id:id
                    },
                    success: function (data) {
                    table.draw();
                    toastr.success('Banner deleted successfully','Success');
                    },
                    error: function (data) {
                    toastr.error(data['responseJSON']['message'],'Error has occured');
                    }
                });
            }
        });

    }); //end of script


</script>

@endsection
