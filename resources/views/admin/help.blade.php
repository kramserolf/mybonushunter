@extends('layouts.admin')
<style>
    #help {
        background-color: gray;
    }
</style>
@section('content')
    <span class="badge bg-secondary fs-4 mb-3 mt-2">Help</span>
    <!-- Button trigger modal -->
    <div class="d-flex flex-row-reverse bd-highlight">
        <!-- Button trigger modal -->
        <a href="javascript:void(0)" class="btn btn-outline-primary btn-sm mb-2" btn-sm id="addHelp">
            <i class="bi-plus-square ">  </i> 
            Add Help Image
        </a>
    </div>
    <table class="table table-bordered data-table nowrap" style="width: 100%;">
        <thead>
            <tr class="table-primary text-uppercase">
                <td class="text-center">No.</td>
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
        <form action="{{route('admin.banner.store')}}" type="POST" name="helpForm" id="helpForm" enctype="multipart/form-data">

            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">New Help Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                    {{-- hidden id --}}
                    <input type="hidden" name="id" id="id">
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

        //load table
        let table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            select: true,
            responsive: true,
            ajax: "{{ route('admin.help') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'image', name: 'image'},
                {data: 'description', name: 'description'},
                {data: 'action', name: 'action', orderable: false, searchable: false, class:'text-center'},
            ],
        });

        //show modal
            // SHOW ADD MODAL
        $('#addHelp').click(function () {
            $('#id').val('');
            $('#helpForm').trigger("reset");
            $('#addModal').modal('show');
            $('#savedata').html('Save');
        });


        //add function
        $('#helpForm').submit(function(e){
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.help.store') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    if(response){
                        this.reset();
                        toastr.success('Help saved successfully','Success');
                        table.draw();
                    }
                },
                error: function(response){
                    toastr.error(response['responseJSON']['message'],'Error has occured');
                }
            });
        });

        // DELETE 
        $('body').on('click', '.deleteHelp', function () {
        var id = $(this).data("id");
            if (confirm("Are You sure want to delete this?") === true) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ url('admin/help/destroy') }}",
                    data:{
                    id:id
                    },
                    success: function (data) {
                    table.draw();
                    toastr.success('Help deleted successfully','Success');
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
