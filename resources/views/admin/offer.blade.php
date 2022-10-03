@extends('layouts.admin')
<style>
    #offers {
        background-color: gray;
    }
</style>
@section('content')
<div class="m-3">
    <h2><i class="bi-cash"></i> Offers</h2>
</div>
    <table class="table table-bordered data-table nowrap" style="width: 100%;">
        <thead>
            <tr class="table-primary text-uppercase">
                <td class="text-center">No.</td>
                <td class="text-center">Title</td>
                <td class="text-center">Credit</td>
                <td class="text-center">Offer Type</td>
                <td class="text-center">Validity</td>

                <td class="text-center">Action</td>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

{{-- add modal --}}
  <div class="modal modal-md fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="" type="POST" name="offerForm" id="offerForm" enctype="multipart/form-data">

            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">New Offer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                {{-- hidden id --}}
                <input type="hidden" name="id" id="id">
                <div class="row form-row mb-3">
                    <div class="form-group col-md-8">
                        <label for="title">Title</label>
                        <input type="text" class="form-control text-capitalize" name="title" id="title" placeholder="2022 Spin Promo">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="credit">Credit</label>
                        <input type="text" class="form-control text-end" name="credit" id="credit" placeholder="$30">
                    </div>
                </div>
                <div class="row form-row mb-3">
                    <div class="form-group col-md-12">
                        <label for="offer_type" class="form-label">Offer type</label>
                        <select class="form-select" aria-label="Default select example" name="offer_type" id="offer_type">
                            <option selected>Select offer type</option>
                            <option value="Signup">Signup</option>
                            <option value="Deposit">Deposit</option>
                        </select>
                    </div>
                </div>
                <div class="row form-row mb-3">
                    <div class="form-group">
                            <label for="offer_image" class="form-label">Offer Image</label>
                        <input type="file" class="form-control" name="offer_image" id="offer_image">
                        <span class="text-danger" id="image-input-error"></span>
                    </div>
                </div>

                  <div class="mb-3">
                    <label for="banner_image" class="form-label">Banner Image</label>
                    <input type="file" class="form-control" name="banner_image" id="banner_image">
                    <span class="text-danger" id="image-input-error2"></span>
                </div>
                  <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" name="description" id="description" placeholder="This promo is for existing customers">
                </div>
                <div class="form-group row mb-3">
                    <div class="form-group col-md-8">
                        <label for="validity">Validity</label>
                        <input type="date" class="form-control" name="validity" id="validity" placeholder="2022 Spin Promo">
                    </div>
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
            ajax: "",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'title', name: 'title'},
                {data: 'credit', name: 'credit'},
                {data: 'offer_type', name: 'offer_type'},
                
                {data: 'validity', name: 'validity'},
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
                        $('#offerForm').trigger("reset");
                        $('#addModal').modal('show');
                        $('#savedata').html('Save');
                    },
                }
            ],
            
        });

        //show modal
            // SHOW ADD MODAL
        $('#addOffer').click(function () {
            $('#id').val('');
            $('#offerForm').trigger("reset");
            $('#addModal').modal('show');
            $('#savedata').html('Save');
        });


        //add function
        $('#offerForm').submit(function(e){
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{route('admin.offer.store')}}",
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    if(response){
                        this.reset();
                        toastr.success('Offer saved successfully','Success');
                        table.draw();
                    }
                },
                error: function(response){
                    toastr.error(response['responseJSON']['message'],'Error has occured');
                }
            });
        });

        // DELETE 
        $('body').on('click', '.deleteOffer', function () {
        var id = $(this).data("id");
            if (confirm("Are You sure want to delete this offer") === true) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ url('admin/offer/destroy') }}",
                    data:{
                    id:id
                    },
                    success: function (data) {
                    table.draw();
                    toastr.success('Offer deleted successfully','Success');
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
