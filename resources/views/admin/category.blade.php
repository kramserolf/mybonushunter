@extends('layouts.admin')
<style>
    #links {
        background-color: gray;
    }
</style>
@section('content')
    <span class="badge bg-secondary fs-4 mb-3 mt-2">Categories</span>
    <!-- Button trigger modal -->
    <nav class="nav nav-tabs mb-2" id="nav-tab" role="tablist">
        <a class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Links</a>
        <a class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Category</a> 
      </nav>
    <table class="table table-bordered data-table nowrap py-2" style="width: 100%;">
        <thead >
            <tr class="table-primary text-uppercase">
                <td class="text-center">No.</td>
                <td class="text-center">Title</td>
                <td class="text-center">Action</td>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

{{-- add modal --}}
  <div class="modal fade" id="addCategoryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{route('admin.link.category.store')}}" type="POST" name="linkCategoryForm" id="linkCategoryForm" enctype="multipart/form-data">

            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">New Link</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                    {{-- hidden id --}}
                    <input type="hidden" name="id" id="id">
                  <div class="mb-3">
                      <label for="title" class="form-label">Title</label>
                      <input type="text" class="form-control text-capitalize" name="title" id="title" placeholder="">
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

        //load table
        let table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            select: true,
            responsive: true,
            ajax: "{{ route('admin.link.category') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'title', name: 'title'},
                {data: 'action', name: 'action', orderable: false, searchable: false, class:'text-center'},
            ],
            dom: 'Bfrtlip',
            buttons: [
                {
                    text: 'Add Link',
                    action: function(e, dt, node, config){
                        // show modal
                        $('#id').val('');
                        $('#linkCategoryForm').trigger("reset");
                        $('#addCategoryModal').modal('show');
                        $('#savedata').html('Save');
                    },
                }
            ],
        });

        //add function
        $('#linkCategoryForm').submit(function(e){
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.link.category.store') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    if(response){
                        this.reset();
                        table.draw();
                    }
                },
                error: function(response){
                    $('#image-input-error').text(response.responseJSON.message);
                }
            });
        });

        // DELETE 
        $('body').on('click', '.deleteLinkCategory', function () {
        var id = $(this).data("id");
            if (confirm("Are You sure want to delete this?") === true) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ url('admin/link/category/destroy') }}",
                    data:{
                    id:id
                    },
                    success: function (data) {
                    table.draw();
                    // toastr.success('Expense deleted successfully','Success');
                    },
                    error: function (data) {
                    // toastr.error(data['responseJSON']['message'],'Error has occured');
                    }
                });
            }
        });

    }); //end of script


</script>

@endsection
