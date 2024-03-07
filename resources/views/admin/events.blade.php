@extends('admin.layout')

@section('content')
    <style>
        .card {
            margin-bottom: 20px;
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 0.25rem;
        }

        .card-img {
            width: 100%;
            height: auto;
        }

        .card-title {
            font-size: 1.25rem;
            margin-bottom: 0.75rem;
        }

        .card-text {
            margin-bottom: 1rem;
        }

        .card-body {
            padding: 1.25rem;
        }

        .card-body p {
            margin-bottom: 0.5rem;
        }

        .btn {
            margin-right: 5px;
        }
    </style>
    <div class="container" style="padding: 48px">
        <div class="row justify-content-center p-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header row"><b>Events</b></div>

                    <div class="card-body">
                        <!-- Button to trigger modal -->
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addEventModal">
                            Add Events
                        </button>
                    </div>

                    <div class="card-body row">
                        <div class="col-md-6">
                            <label for="category">Filter by Category:</label>
                            <select class="form-control" id="category">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="search">Search by Events Name:</label>
                            <input type="text" class="form-control" id="search" placeholder="Enter events name">
                        </div>
                    </div>
                </div>

                @foreach ($events as $event)
                    <div class="card mb-3">
                        <img src="{{ asset('images/' . $event->images) }}" class="card-img-top mx-auto d-block w-40"
                            alt="events Image">
                            <div class="card-body">
                                <h5 class="card-title">{{ $event->title }}</h5>
                                <p class="card-text">{!! $event->description !!}</p>
                                <p><b>Date:</b> {{ $event->date }}</p>
                                <p><b>Location:</b> {{ $event->location }}</p>
                                <p><b>Category:</b> {{ $event->category->name }}</p>
                                <p><b>Available Seats:</b> {{ $event->available_seats }}</p>
                            </div>
                            <div class="card-body d-flex justify-content-end">
                                <button type="button" class="btn btn-info" data-toggle="modal"
                                    data-target="#editEventModal{{ $event->id }}">Edit</button>
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#confirmDeleteModal{{ $event->id }}">Delete</button>
                            </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>

    <!-- Modals -->
    @foreach ($events as $event)
        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="confirmDeleteModal{{ $event->id }}" tabindex="-1" role="dialog"
            aria-labelledby="confirmDeleteModalLabel{{ $event->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteModalLabel{{ $event->id }}">Confirm Delete</h5>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this event?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <!-- Form to submit delete request -->
                        <form action="{{ route('event.destroy', $event->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Event Modal -->
        <div class="modal fade" id="editEventModal{{ $event->id }}" tabindex="-1" role="dialog"
            aria-labelledby="editEventModalLabel{{ $event->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editEventModalLabel{{ $event->id }}">Edit Event</h5>
                    </div>
                    <form action="{{ route('event.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="editTitle">Title</label>
                                <input type="text" class="form-control" id="editTitle" name="title"
                                    value="{{ $event->title }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="editor" name="description" rows="3">{{ $event->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="editCategory">Category</label>
                                <select class="form-control" id="editCategory" name="category_id">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $category->id == $event->category_id ? 'selected' : '' }}>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="editImages">Images</label>
                                <input type="file" class="form-control-file" id="editImages" name="images">
                            </div>
                            <div class="form-group">
                                <label for="editDate">Date</label>
                                <input type="date" class="form-control" id="editDate" name="date"
                                    value="{{ $event->date }}">
                            </div>
                            <div class="form-group">
                                <label for="editLocation">Location</label>
                                <input type="text" class="form-control" id="editLocation" name="location"
                                    value="{{ $event->location }}">
                            </div>
                            <div class="form-group">
                                <label for="editAvailableSeats">Available Seats</label>
                                <input type="number" class="form-control" id="editAvailableSeats"
                                    name="available_seats" value="{{ $event->available_seats }}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Add Event Modal -->
    <div class="modal fade" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="addEventModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEventModalLabel">Add Event</h5>
                </div>
                <form action="{{ route('event.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="addTitle">Title</label>
                            <input type="text" class="form-control" id="addTitle" name="title"
                                placeholder="Enter title">
                        </div>
                        <div class="form-group">
                            <label for="addDescription">Description</label>
                            <textarea class="form-control" id="addDescription" name="description" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="addCategory">Category</label>
                            <select class="form-control" id="addCategory" name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="addImages">Images</label>
                            <input type="file" class="form-control-file" id="addImages" name="images">
                        </div>
                        <div class="form-group">
                            <label for="addDate">Date</label>
                            <input type="date" class="form-control" id="addDate" name="date">
                        </div>
                        <div class="form-group">
                            <label for="addLocation">Location</label>
                            <input type="text" class="form-control" id="addLocation" name="location">
                        </div>
                        <div class="form-group">
                            <label for="addSeats">Available Seats</label>
                            <input type="number" class="form-control" id="addSeats" name="available_seats">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Event</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- CKEditor script -->
    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#addDescription'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>

    <!-- Bootstrap and jQuery scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
