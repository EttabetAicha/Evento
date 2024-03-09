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
                                <th>First Name</th>
                                <th>First Name</th>
                                <th>Evenemmant</th>
                                <th>status</th>
                                <th>Actions</th>
                            </tr>
                        @endif
                    </thead>
                    <tbody>
                        @forelse ($reservations as $res)
                            <tr>

                                <td style="font-weight: bold">
                                    <div class="d-flex align-items-center">
                                        <div class="ms-3">
                                            <p class="text-muted mb-0">{{ $res->fname }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td style="font-weight: bold">
                                    <div class="d-flex align-items-center">
                                        <div class="ms-3">
                                            <p class="text-muted mb-0">{{ $res->lname }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td style="font-weight: bold">
                                    <div class="d-flex align-items-center">
                                        <div class="ms-3">
                                            <p class="text-muted mb-0" title="{{$res->title}}">{{ Str::limit($res->title, 20, '...') }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($res->status == 1 || $res->accepte == 0)
                                        <span class="badge bg-success  p-2 ">Complete</span>
                                    @elseif($res->status == 0)
                                        <span class="badge bg-warning p-2">Pending</span>
                                    @else 
                                        <span class="badge bg-danger p-2">Reject</span>
                                    @endif
                                </td>
                                
                                <td>
                                    @if($res->status != 1 && $res->status !=2 && $res->accepte != 0)
                                        <a href="/accept/{{$res->res_id}}" type="button" class="btn btn-success btn-sm" title="Accept">
                                            <i class="fas fa-check"></i> Accept
                                        </a>
                                        <a href="/reject/{{$res->res_id}}" type="button" class="btn btn-danger btn-sm" title="Reject">
                                            <i class="fas fa-times"></i> Reject
                                        </a>
                                    @endif
                                </td>                             

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
                {{-- <div style="padding: 20px ; ">{{ $reservations->links('pagination::bootstrap-5') }}</div> --}}
            </div>
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