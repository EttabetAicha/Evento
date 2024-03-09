@extends('dashboard.index')

@section('content')

<style>
    #addbtn{
        position: fixed;
        right: 4em;
        bottom: 4em;
        
    }
    #addbtn img{
        width: 5em;
        height: 5em;
        border-radius: 50%;
        box-shadow: 0px 0px 5px 2px black;
        transition: 0.3s;
        opacity: 0.7;
        cursor: pointer;
    }

    #addbtn img:hover{
        opacity: 1;
        transform: scale(1.1);
    }

    
</style>
<div id="addbtn">
    <img src="assets/images/logos/plus.png" alt="" data-bs-toggle="modal"
    data-bs-target="#AddEmail">
</div>
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card">
                
            

            @if (session('msg'))
                <div class="alert alert-success" style="color: black">{{ session('msg') }}</div>
            @endif
            @if (session('delmsg'))
                <div class="alert alert-danger" style="color: black">{{ session('delmsg') }}</div>
            @endif

                <table class="table align-middle mb-0 bg-white" style="width:100%">
                    <thead class="bg-light">
                        @if ($count > 0)
                            <tr>
                                <th>Category Name</th>
                                <th></th>
                                <th>Date Create</th>
                                <th>Time Create</th>
                                <th>Actions</th>
                            </tr>
                        @endif
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>

                                <td style="font-weight: bold">
                                    <div class="d-flex align-items-center">
                                        <div class="ms-3">
                                            <p class="text-muted mb-0">{{ $category->name }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                </td>    

                                <td>
                                    @if ($category->created_at)
                                    <p class="text-muted mb-0">{{ $category->created_at->format('d/m/Y') }}</p>
                                @else
                                    <p class="text-muted mb-0">Date not available</p>
                                @endif
                                                                </td>
                                <td>
                                    @if ($category->created_at)
                                    <p class="text-muted mb-0">{{ $category->created_at->format('H:i') }}</p>
                                @else
                                    <p class="text-muted mb-0">Time not available</p>
                                @endif
                                                                </td>
                                
                                <td>
                                    <button type="button" class="btn btn-link btn-sm btn-rounded" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#DeleteEmail" 
                                            data-category-id="{{ $category->id }}"
                                            data-category-name="{{ $category->name }}">
                                        <i class="bi bi-trash fs-4 text-danger"></i>
                                    </button>
                                    <button type="button" class="btn btn-link btn-sm btn-rounded" data-bs-toggle="modal" data-bs-target="#EditEmail{{ $category->id }}" >
                                        <i class="bi bi-pencil fs-4"></i> 
                                    </button>
                                </td>
                                
                           


                            </tr>

                            <div class="modal fade" id="EditEmail{{ $category->id }}" tabindex="-1"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenterTitle">Edit Category
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/categoryedit" method="post">
                                                @csrf   
                                                <div class="mb-3">
                                                    <input type="hidden" value="{{ $category->id }}" name="id">
                                                    <label for="exampleTextInput" class="form-label">Category</label>
                                                    <br>
                                                    <input type="text" class="form-control" name="name"
                                                    id="exampleTextInput" value="{{ $category->name }}">                                                      
                                                </div>                                                    
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Edit</button>
                                        </div>
                    
                                        </form>
                                    </div>
                                </div>
                            </div>
                      

                        @empty


                            <div
                                style="display: flex; justify-content: center; align-items: center; flex-direction: column; width: 100%; padding:3em ; opacity:0.4">
                                <img src="https://static.vecteezy.com/system/resources/previews/021/745/881/original/sad-face-icon-sad-emotion-face-symbol-icon-unhappy-icon-vector.jpg"
                                    alt="" style="width: 20%;" srcset="">
                                <h3 style="margin-top: 2em">User List is empty</h3>
                            </div>
                        @endforelse
                    </tbody>
                </table>
                <div style="padding: 20px ; ">{{ $categories->links('pagination::bootstrap-5') }}</div>
            </div>
        </div>
        </div>
        </div>


        <!-- Button trigger modal -->
        <div class="modal fade" id="AddEmail" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Add Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">    
                        <form action="/addcategory" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleTextInput" class="form-label">Category</label>
                                <input type="text" class="form-control" name="name" id="exampleTextInput"
                                    placeholder="Category...">
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>

                    </form>
                </div>
            </div>
        </div>


        <div class="modal fade" id="DeleteEmail" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Delete Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Display the received data -->
                        <div class="mb-3">
                            <h3 class="text-danger" style="text-align: center">Are You Sure?</h3>
                            <p style="text-align: center">Delete: <span id="categoryName"></span></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <!-- Use JavaScript to dynamically set the delete link -->
                        <a href="#" id="deleteCategoryLink" class="btn btn-danger">Delete</a>
                    </div>
                </div>
            </div>
        </div>

      

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var modal = document.getElementById('DeleteEmail');
                modal.addEventListener('show.bs.modal', function (event) {
                    var button = event.relatedTarget;
                    var categoryId = button.getAttribute('data-category-id');
                    var categoryName = button.getAttribute('data-category-name');
                    var deleteLink = '/categorydelete/' + categoryId;
                    
                    modal.querySelector('#categoryName').innerText = categoryName;
                    modal.querySelector('#deleteCategoryLink').setAttribute('href', deleteLink);
                });
            });
        </script>
       

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
@endsection