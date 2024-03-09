@extends('dashboard.index')

@section('content')

<div class="container">
      
    <div class="col-lg-12">
      <div class="row">
   
        <div class="col-lg-4">
          <!-- All Users -->
          <div class="card">
              <div class="card-body">
                  <div class="row align-items-start">
                      <div class="col-8">
                          <h5 class="card-title mb-3 fw-semibold">All Reservations</h5>
                          <h4 class="fw-semibold mb-3">{{$res}}</h4>
                      </div>
                      <div class="col-4 text-end">
                          <i class="bi bi-people-fill" style="font-size: 2rem;"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      
      <div class="col-lg-4">
          <!-- All Events -->
          <div class="card">
              <div class="card-body">
                  <div class="row align-items-start">
                      <div class="col-8">
                          <h5 class="card-title mb-3 fw-semibold">All Events</h5>
                          <h4 class="fw-semibold mb-3">{{$event}}</h4>
                      </div>
                      <div class="col-4 text-end">
                          <i class="bi bi-calendar3" style="font-size: 2rem;"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      
     
      </div>
    </div>
  </div>

  @endsection