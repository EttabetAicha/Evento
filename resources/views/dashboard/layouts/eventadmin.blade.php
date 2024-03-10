@extends('dashboard.index')

@section('content')

    <style>
         #addbtn {
            position: fixed;
            right: 4em;
            bottom: 4em;
            z-index: 2;
        }

        .status-badge {
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .bg-image {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
        }

        .bg-image img {
            transition: transform 0.5s ease;
        }

        .bg-image:hover img {
            transform: scale(1.05);
        }


        #addbtn img {
            width: 5em;
            height: 5em;
            border-radius: 20%;
            box-shadow: 0px 0px 5px 2px rgb(214, 213, 213);
            transition: 0.3s;
            opacity: 0.7;
            cursor: pointer;

        }

        #addbtn img:hover {
            opacity: 1;
            transform: scale(1.1);
        }

        #event1 {
            background-color: rgb(255, 255, 255);
            box-shadow: 2px 2px 5px .3px rgb(194, 193, 193);

            transition: 0.3s;
        }



        #msgtop {
            font-size: 15px;
            text-align: center;
            color: white;
            width: 30%;
            margin-left: 42em;

            border-radius: 5px 5px 0px 0px;
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

            <section>

                <div class="container py-5">

                    @forelse ($events as $event)
                        <div class="row justify-content-center mb-3">
                            <div class="col-md-12 col-xl-10">
                                @if ($event->status == 0)
                                    <div id="msgtop" class="status-badge" style="background-color: rgb(186, 19, 219);">
                                        Pending</div>
                                @elseif($event->status == 1 || $event->status == 4)
                                    <div id="msgtop" class="status-badge" style="background-color: rgb(190, 144, 16);">
                                        Archived</div>
                                @elseif($event->status == 2)
                                    <div id="msgtop" class="status-badge" style="background-color: rgb(74, 175, 15);">
                                        Active</div>
                                @elseif($event->status == 3)
                                    <div id="msgtop" class="status-badge" style="background-color: rgb(233, 34, 34);">
                                        Rejected</div>
                                @endif
                                <div class="card shadow-0 border rounded-3" id="event1">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                                                <div class="bg-image hover-zoom ripple rounded ripple-surface">
                                                    <img src="assets/images/{{ $event->image }}" class="w-100"
                                                        alt="Event Image" />
                                                    <a href="#!">
                                                        <div class="hover-overlay">
                                                            <div class="mask"
                                                                style="background-color: rgba(253, 253, 253, 0.15);"></div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xl-6">
                                                <h5>{{ $event->title }}</h5>
                                                <div class="d-flex flex-row align-items-center mb-2">
                                                    <div class="text-danger me-2">
                                                        @for ($i = 0; $i < 4; $i++)
                                                            <i class="fa fa-star"></i>
                                                        @endfor
                                                    </div>
                                                </div>
                                                <p class="text-truncate mb-4 mb-md-0"
                                                    style="font-size: 1.2em; color: black;">
                                                    {{ Str::limit($event->description, 120, '...') }}
                                                </p>
                                                <div class="mt-1 text-muted small">
                                                    <span>Location: {{ $event->location }}</span><br>
                                                    <span>Date: {{ $event->date }}</span><br>
                                                    <span>Time: {{ date('H:i', strtotime($event->time)) }}</span><br>
                                                    <span>Duration: {{ $event->duration }} min</span><br>
                                                    <span>Total places: {{ $event->total_places }}</span><br>
                                                    <span>Total reservations: {{ $event->total_reservations }}</span><br>
                                                    <span>Total Places Available:
                                                        {{ $event->total_places - $event->total_reservations }}</span><br>
                                                    @if ($event->acceptation == 1)
                                                        <span>Acceptation: validation manuelle</span><br>
                                                    @else
                                                        <span>Acceptation: automatique des réservations</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                                                <div class="d-flex flex-row align-items-center mb-2">
                                                    @if ($event->price == 0)
                                                        <h4 class="text-secondary me-1">Free</h4>
                                                    @else
                                                        <h4 class="text-danger me-1">{{ $event->price }} DH</h4>
                                                    @endif
                                                </div>
                                                <div class="d-flex flex-column mt-4">
                                                    <button class="btn btn-outline-primary btn-sm mb-2" type="button"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#detailEmail{{ $event->id }}">Details</button>
                                                    <button class="btn btn-success btn-sm mb-2" type="button"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#EditEmail{{ $event->id }}">Edit</button>
                                                    @if ($event->status != 1 && $event->status != 3 && $event->status != 4)
                                                        <button class="btn btn-warning btn-sm mb-2" type="button"
                                                            data-bs-toggle="modal" data-bs-target="#DeleteEmail"
                                                            data-category-id="{{ $event->id }}"
                                                            data-category-name="{{ $event->title }}">Archive</button>
                                                    @elseif($event->status != 3 && $event->status != 4)
                                                        <a href="/unarchiveorg/{{ $event->id }}"
                                                            class="btn btn-success btn-sm mb-2">Unarchive</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="modal fade" id="detailEmail{{ $event->id }}" tabindex="-1"
                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Event Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    @if ($event->image)
                                        <div class="modal-body" style="border-radius: 2px;">
                                            <div class="mb-3 text-center">
                                                <img src="{{ asset('assets/images/' . $event->image) }}" alt="Event Image"
                                                    class="img-fluid rounded">
                                            </div>
                                        </div>
                                    @endif
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <strong>Title:</strong> {{ $event->title }}
                                        </div>
                                        <div class="mb-3">
                                            <strong>Description:</strong> <br>{{ $event->description }}
                                        </div>
                                        <div class="mb-3">
                                            <strong>Location:</strong> {{ $event->location }}
                                        </div>
                                        <div class="mb-3">
                                            <strong>Date:</strong> {{ $event->date }}
                                        </div>
                                        <div class="mb-3">

                                            <strong>Time:</strong> {{ date('H:i', strtotime($event->time)) }}
                                        </div>
                                        <div class="mb-3">
                                            <strong>Duration (min):</strong> {{ $event->duration }}
                                        </div>
                                        <div class="mb-3">
                                            @if ($event->price == 0)
                                                <strong>Price:</strong> Free
                                            @else
                                                <strong>Price:</strong> {{ $event->price }} DH
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <strong>Total Places Available:</strong>
                                            {{ $event->total_places - $event->total_reservations }}
                                        </div>
                                        <div class="mb-3">
                                            <strong>Category:</strong> {{ $event->category_name }}
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>







                        <div class="modal fade" id="EditEmail{{ $event->id }}" tabindex="-1"
                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Event</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/EditEvent" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" value="{{ $event->id }}" name="id">

                                            <div class="mb-3">
                                                <label for="title" class="form-label">Title</label>
                                                <input type="text" class="form-control" name="title" id="title"
                                                    value="{{ $event->title }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea class="form-control" name="description" id="description" rows="3"
                                                    value="{{ $event->description }}">{{ $event->description }}</textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label for="location" class="form-label">Location</label>
                                                <input type="text" class="form-control" name="location"
                                                    id="location" value="{{ $event->location }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="date" class="form-label">Date</label>
                                                <input type="date" class="form-control" name="date" id="date"
                                                    value="{{ $event->date }}">
                                            </div>
                                            <div class="mb-3">

                                                <label for="event_time">Time:</label>
                                                <input type="time" id="event_time" name="time"
                                                    class="form-control" value="{{ $event->time }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="duration" class="form-label">Duration 'min'</label>
                                                <input type="number" class="form-control" name="duration"
                                                    id="duration" value="{{ $event->duration }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="price" class="form-label">Price</label>
                                                <input type="number" class="form-control" name="price" id="price"
                                                    value="{{ $event->price }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="total_places" class="form-label">Total Places</label>
                                                <input type="number" class="form-control" name="total_places"
                                                    id="total_places" value="{{ $event->total_places }}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="image" class="form-label">Category</label>
                                                <select class="form-control" name="category" id="">

                                                    <option disabled selected>Categorhy...</option>
                                                    @foreach ($categories as $category)
                                                        @if ($category->id == $event->category_idd)
                                                            <option value="{{ $category->id }}" selected>
                                                                {{ $category->name }}</option>
                                                        @else
                                                            <option value="{{ $category->id }}">{{ $category->name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="mb-3">
                                                <label for="image" class="form-label">aceeptation</label>
                                                <select class="form-control" name="acceptation" id="">
                                                    <option disabled selected>Accept...</option>
                                                    @if ($event->acceptation == 0)
                                                        <option value="0" selected>automatique des réservations
                                                        </option>
                                                        <option value="1">validation manuelle</option>
                                                    @else
                                                        <option value="0">automatique des réservations</option>
                                                        <option value="1" selected>validation manuelle</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="image" class="form-label">Image</label>
                                                <input type="file" class="form-control" name="image" id="image"
                                                    accept="image/*" value="{{ $event->image }}">
                                            </div>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    @empty
                        <div
                            style="display: flex; justify-content: center; align-items: center; flex-direction: column; width: 100%; padding:3em ; opacity:0.4">
                            <img src="assets/img/empty.png" alt="" style="width: 20%;" srcset="">
                            <h3 style="margin-top: 2em">Event List is empty</h3>
                        </div>
                    @endforelse
                </div>
            </section>

            <div style="padding: 20px ; ">{{ $events->links('pagination::bootstrap-5') }}</div>
        </div>
    </div>
    </div>
    </div>



    <div class="modal fade" id="DeleteEmail" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Archive Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Display the received data -->
                    <div class="mb-3">
                        <h3 class="text-danger" style="text-align: center">Are You Sure?</h3>
                        <p style="text-align: center">Archive: <span id="categoryName"></span></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="#" id="deleteCategoryLink" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->
    <div class="modal fade" id="AddEvent" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/addevent" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" id="title"
                                placeholder="Event Title...">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="3"
                                placeholder="Event Description..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" name="location" id="location"
                                placeholder="Event Location...">
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" class="form-control" name="date" id="date">
                        </div>

                        <div class="mb-3">

                            <label for="event_time">Time:</label>
                            <input type="time" id="event_time" name="time" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="duration" class="form-label">Duration 'min'</label>
                            <input type="number" class="form-control" name="duration" id="duration"
                                placeholder="Event Duration...">
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" name="price" id="price"
                                placeholder="Event Price...">
                        </div>
                        <div class="mb-3">
                            <label for="total_places" class="form-label">Total Places</label>
                            <input type="number" class="form-control" name="total_places" id="total_places"
                                placeholder="Total Places...">
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Category</label>
                            <select class="form-control" name="category" id="">

                                <option disabled selected>Categorhy...</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">aceeptation</label>
                            <select class="form-control" name="acceptation" id="">
                                <option disabled selected>Accept...</option>
                                <option value="1">automatique des réservations</option>
                                <option value="0">validation manuelle</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" name="image" id="image" accept="image/*">
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modal = document.getElementById('DeleteEmail');
            modal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var categoryId = button.getAttribute('data-category-id');
                var categoryName = button.getAttribute('data-category-name');
                var deleteLink = '/ArchivEvent/' + categoryId;

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
