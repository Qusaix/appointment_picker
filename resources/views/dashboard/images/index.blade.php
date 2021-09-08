@extends('dashboard.layout.nav2')
@section('content')
    <div class="pag-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 mb-2 order-last">
                    <h3>Images</h3>
                    <p class="text-subtitle text-muted">Show your best work </p>
                    <div class="input-group mb-3">
                       
                        <input id="imageLink" type="text" class="form-control" placeholder="at the end of the image link should have .png or any other type"
                            aria-label="Example text with button addon"
                            aria-describedby="button-addon1">
                            <button onclick="addImage()" class="btn btn-primary" type="button"
                            id="button-addon1">Add</button>
                    </div>
                    </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Images</li>
                        </ol>
                    </nav>
                </div>

            </div>
        </div>
    </div>
    <section>
        <div class="section">
            <div style="padding:2%;" class="card">            
                <!-- Gallery -->
                <div class="row">
                    @foreach ($images as $image)
                    <div class="col-lg-4 col-md-12 mb-4 mt-4 mb-lg-0">  
                        <img
                            src="{{$image->link}}"
                            class="w-100 shadow-1-strong rounded mb-4"
                            alt="{{$image->link}}"
                            style="height:462px;width:275px;"
                            onerror="if (this.src != 'error.jpg') this.src = 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/1024px-No_image_available.svg.png';"
                        />
                        <input  id='{{$image->id}}' value="{{$image->link}}" type="hidden">
                        <input  id='Image{{$image->id}}' value="{{$image->id}}" type="hidden">
                        <button onclick="showEditModal({!! json_encode($image->id) !!})" class="btn btn-primary">
                            Edit
                        </button>
                        <button onclick="showDeleteModal({!! json_encode($image->id) !!})" data-toggle="modal" data-target="#exampleModal" class="btn btn-secondary">
                            Delete
                        </button>
                        
                        </div>
    
                    @endforeach                
                </div>
                
                </div>
            </div>
            <div class="modal fade" id="DeleteingModal" tabindex="-1" role="dialog" aria-labelledby="DeleteingModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="DeleteingModalLabel">Deleteing Image</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Are you sure you want to delete this image
                    </div>
                    <div class="modal-footer">
                      <button onclick="hideDeleteModal()" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button onclick="deleteImage()" type="button" class="btn btn-danger">Delete</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="EditModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="EditModalLabel">Edit Image</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <input id='updatedLink' value="" class="form-control" type="text">
                    </div>
                    <div class="modal-footer">
                      <button onclick="hideEditModal()" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button onclick="editImage()" type="button" class="btn btn-primary">Save changes</button>
                    </div>
                  </div>
                </div>
              </div>
              
    </section>

    <script>
        let imageID;
        function addImage()
        {
            let imageLink = {
                link: document.getElementById('imageLink').value
            };
            if(imageLink.link == ''||imageLink.link == null)
            {
               return;
            }
            else
            {
                $.ajax({
                url: "{{route('dashboard.images.store')}}",
                type: 'POST',
                data: imageLink,
                dataType: 'JSON',
                success:function(res){
                    var url = '{{ route("dashboard.images.index") }}';
                    // url = url.replace(':id', value);
                    window.location.href = url;

                },
                error:function(res){}
                })
            }
        }
        function showDeleteModal(id){
            imageID = id;
            $('#DeleteingModal').modal('show')
        }
        function hideDeleteModal(){
            $('#DeleteingModal').modal('hide')
        }
        function deleteImage(){
            console.log('image id: ',imageID);
            let delete_image_id = imageID
            let sending_request = '{{ route("dashboard.images.delete",":id") }}';
            sending_request = sending_request.replace(':id',delete_image_id);
            $.ajax({
                url: sending_request,
                type: 'GET',
                dataType: 'JSON',
                success:function(res){

                },
                error:function(res){}
                
            });
            location.reload();                    

        }
        function showEditModal(imageId){
            document.getElementById('updatedLink').value = document.getElementById(imageId).value;
            let getImage = 'Image'+imageId
            imageID = document.getElementById(getImage).value
            console.log('value: ',imageID)
            $('#EditModal').modal('show')
        }
        function hideEditModal(){
            $('#EditModal').modal('hide')
        }
        function editImage()
        {
            let imageLink = {
                link: document.getElementById('updatedLink').value
            };
            if(imageLink.link == ''||imageLink.link == null)
            {
               return;
            }
            else
            {
                let edit_image_id = imageID
                let sending_request = '{{ route("dashboard.images.edit",":id") }}';
                sending_request = sending_request.replace(':id',edit_image_id);

                $.ajax({
                url: "{{route('dashboard.images.store')}}",
                type: 'POST',
                data: imageLink,
                dataType: 'JSON',
                success:function(res){
                    var url = '{{ route("dashboard.images.index") }}';
                    // url = url.replace(':id', value);
                    window.location.href = url;

                },
                error:function(res){}
                })

                location.reload();                    

            }

        }
    </script>
    
    <!-- Page Heading -->
  <!-- Gallery -->      
      

@endsection