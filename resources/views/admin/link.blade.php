@extends('layouts.admin')
<style>
    #links {
        background-color: gray;
    }
</style>
@section('content')
    <span class="badge bg-secondary fs-4 mb-3 mt-2">Links</span>
    <!-- Button trigger modal -->
    <nav class="nav nav-tabs mb-2" id="nav-tab" role="tablist">
        <a class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Links</a>
        <a class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Category</a> 
    </nav>
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <table class="table table-bordered data-table nowrap py-2" id="linkTable" style="width: 100%;">
                <thead >
                    <tr class="table-primary text-uppercase">
                        <td class="text-center">No.</td>
                        <td class="text-center">Category</td>
                        <td class="text-center">Title</td>
                        <td class="text-center">Link</td>
                        <td class="text-center">Description</td>
                        <td class="text-center">Action</td>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <table class="table table-bordered data-table nowrap py-2" style="width: 100%;" id="categoryTable">
                <thead >
                    <tr class="table-primary text-uppercase">
                        <td class="text-center">No.</td>
                        <td class="text-center">Title</td>
                        <td class="text-center">Action</td>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="nav-disabled" role="tabpanel" aria-labelledby="nav-disabled-tab">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laudantium minima repellat incidunt facilis obcaecati blanditiis corrupti ad officia doloribus ullam sapiente ipsum, nemo a, excepturi voluptatem voluptatibus velit eum dignissimos ut, nam tempora? Reiciendis illo itaque veritatis eligendi fuga, mollitia ratione totam veniam esse in.</div>
      </div>


{{-- add link modal --}}
  <div class="modal fade" id="addLinkModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{route('admin.link.store')}}" type="POST" name="linkForm" id="linkForm" enctype="multipart/form-data">

            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">New Link</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                    {{-- hidden id --}}
                    <input type="hidden" name="id" id="id">
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-select" aria-label="Default select example" name="category_id" id="category_id">
                          <option selected>Select Category</option>
                          @foreach ($link_category as $category)
                              <option value="{{$category->id}}">{{$category->category}}</option>
                          @endforeach
                        </select>
                    </div>
                  <div class="mb-3">
                      <label for="title" class="form-label">Title</label>
                      <input type="text" class="form-control text-capitalize" name="title" id="title" placeholder="">
                  </div>
                  <div class="mb-3">
                    <label for="link" class="form-label">Link</label>
                    <input type="text" class="form-control" name="link" id="link" placeholder="https://www.youtube.com/watch?v=qmlFD2zdp8I&t=43">
                </div>
                  <div class="mb-3">
                    <label for="description" class="form-label">Description <span class="text-muted" style="font-size: 12px;">(optional)</span></label>
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
{{-- add category modal --}}
  <div class="modal fade" id="addCategoryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{route('admin.category.store')}}" type="POST" name="linkCategoryForm" id="linkCategoryForm" enctype="multipart/form-data">

            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">New Link</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                    {{-- hidden id --}}
                    <input type="hidden" name="id" id="id">
                  <div class="mb-3">
                      <label for="category" class="form-label">Title</label>
                      <input type="text" class="form-control text-capitalize" name="category" id="category" placeholder="">
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

        //load links table
        let linkTable = $('#linkTable').DataTable({
            processing: true,
            serverSide: true,
            select: true,
            responsive: true,
            ajax: "{{ route('admin.link') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'category', name: 'category'},
                {data: 'title', name: 'title'},
                {data: 'link', name: 'link'},
                {data: 'description', name: 'description'},
                {data: 'action', name: 'action', orderable: false, searchable: false, class:'text-center'},
            ],
            dom: 'Bfrtlip',
            buttons: [
                {
                    text: 'Add Link',
                    action: function(e, dt, node, config){
                        // show modal
                        $('#id').val('');
                        $('#linkForm').trigger("reset");
                        $('#addLinkModal').modal('show');
                        $('#savedata').html('Save');
                    },
                }
            ],
        });
        // load category table
        let categoryTable = $('#categoryTable').DataTable({
            processing: true,
            serverSide: true,
            select: true,
            responsive: true,
            ajax: "{{ route('admin.link.category') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'category', name: 'category'},
                {data: 'action', name: 'action', orderable: false, searchable: false, class:'text-center'},
            ],
            dom: 'Bfrtlip',
            buttons: [
                {
                    text: 'Add Category',
                    action: function(e, dt, node, config){
                        // show modal
                        $('#id').val('');
                        $('#categoryForm').trigger("reset");
                        $('#addCategoryModal').modal('show');
                        $('#savedata').html('Save');
                    },
                }
            ],
        });

        //add links function
        $('#linkForm').submit(function(e){
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.link.store') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    if(response){
                        this.reset();
                        linkTable.draw();
                    }
                },
                error: function(response){
                    $('#image-input-error').text(response.responseJSON.message);
                }
            });
        });

         //add links function
         $('#linkCategoryForm').submit(function(e){
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.category.store') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    if(response){
                        this.reset();
                        categoryTable.draw();
                        linkTable.draw();
                    }
                },
                error: function(response){
                    $('#image-input-error').text(response.responseJSON.message);
                }
            });
        });

        // DELETE 
        $('body').on('click', '.deleteLink', function () {
        var id = $(this).data("id");
            if (confirm("Are You sure want to delete this link?") === true) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ url('admin/link/destroy') }}",
                    data:{
                    id:id
                    },
                    success: function (data) {
                        linkTable.draw();
                    // toastr.success('Expense deleted successfully','Success');
                    },
                    error: function (data) {
                    // toastr.error(data['responseJSON']['message'],'Error has occured');
                    }
                });
            }
        });


        $('body').on('click', '.deleteLinkCategory', function () {
        var id = $(this).data("id");
            if (confirm("Are You sure want to delete this category?") === true) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ url('admin/category/destroy') }}",
                    data:{
                    id:id
                    },
                    success: function (data) {
                        categoryTable.draw();
                        linkTable.draw();
                        
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
