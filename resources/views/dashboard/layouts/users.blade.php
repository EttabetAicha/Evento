@extends('dashboard.index')

@section('content')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card">

            

            @if (session('msg'))
                <div class="alert alert-success" style="color: black">{{ session('msg') }}</div>
            @endif
            @if (session('delmsg'))
                <div class="alert alert-danger" style="color: black">{{ session('delmsg') }}</div>
            @endif

                <table class="table align-middle mb-0 bg-white">
                    <thead class="bg-light">
                        @if ($count > 0)
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Date Create</th>
                                <th>Time Create</th>
                                <th>Actions</th>
                            </tr>
                        @endif
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>

                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="ms-3">
                                            <p class="text-muted mb-0">{{ $user->name }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="ms-3">
                                            <p class="text-muted mb-0">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    @if($user->role->name === 'Admin')
                                        <div class="d-flex align-items-center justify-content-center bg-success text-white p-1 rounded" style="height: 100%;">
                                    @elseif($user->role->name === 'Organisateur')
                                        <div class="d-flex align-items-center justify-content-center bg-secondary text-white p-1 rounded" style="height: 100%;">
                                    @elseif($user->role->name === 'Utilisateur')
                                        <div class="d-flex align-items-center justify-content-center bg-warning text-white p-1 rounded" style="height: 100%;">
                                    @else
                                    <div>
                                    @endif
                                        <p class="mb-0">{{ $user->role->name }}</p>
                                    </div>
                                </td>
                                
                                
                                
                                <td>
                                    <p class="text-muted mb-0">{{ $user->created_at->format('d/m/Y') }}</p>
                                </td>
                                <td>
                                    <p class="text-muted mb-0">{{ $user->created_at->format('H:i') }}</p>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-link btn-sm btn-rounded text-danger" data-bs-toggle="modal" data-bs-target="#DeleteEmail{{ $user->id }}" data-mail-id="{{ $user->id }}">
                                        <i class="bi bi-trash fs-4"></i> 
                                    </button>
                                    <button type="button" class="btn btn-link btn-sm btn-rounded" data-bs-toggle="modal" data-bs-target="#EditEmail{{ $user->id }}">
                                        <i class="bi bi-pencil fs-4"></i> 
                                    </button>
                                </td>

                                <div class="modal fade" id="DeleteEmail{{ $user->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterTitle">Delete Mail
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/usersdelete" method="post">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <h3 class="text-danger" style="text-align: center">Are You Sure</h3>
                                                        <p style="text-align: center">Delete : {{ $user->name }}
                                                        </p>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <a href="/usersdelete/{{ $user->id }}" type="submit"
                                                    class="btn btn-danger">Delete</a>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="EditEmail{{ $user->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterTitle">Edit Mail
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/usersedit" method="post">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <input type="hidden" value="{{ $user->id }}" name="id">
                                                        <label for="exampleTextInput" class="form-label">{{ $user->name }}</label>
                                                        <br>
                                                        <label for="exampleTextInput" class="form-label">{{ $user->email }}</label>
                                                        <select class="form-select" name="role_id">
                                                            @foreach ($roles as $role)
                                                            @if($role->id == $user->role->id)
                                                               <option value="{{$role->id}}" selected>{{ $role->name }}</option>
                                                               @else
                                                               <option value="{{$role->id}}">{{ $role->name }}</option>
                                                            @endif
                                                            @endforeach
                                                        </select>
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


                            </tr>

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
                <div style="padding: 20px ; ">{{ $users->links('pagination::bootstrap-5') }}</div>
            </div>
        </div>
        </div>
        </div>


        <!-- Button trigger modal -->
        <div class="modal fade" id="AddEmail" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Add Mail</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">    
                        <form action="/AddEmail" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleTextInput" class="form-label">Mail</label>
                                <input type="text" class="form-control" name="email" id="exampleTextInput"
                                    placeholder="Email...">
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



    <div class="modal fade" id="ImportMail" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Mails</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/import" method="post" enctype="multipart/form-data" accept=".xlsx">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleTextInput" class="form-label">Mails</label>
                            <input type="file" class="form-control" name="file" id="exampleTextInput"
                                placeholder="Excel...">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>

                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="DeleteAllEmail" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Mails</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/import" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3" style="text-align: center">
                            <img src="https://www.shutterstock.com/image-vector/vector-attention-sign-exclamation-mark-600nw-1725119242.jpg"
                                alt="" style="width: 50%" srcset="">
                            <h1 class="text-danger">Are you sure all email data will be deleted?</h1>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="/deleteAll" type="submit" class="btn btn-danger">Delete ALL</a>
                </div>

                </form>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
@endsection