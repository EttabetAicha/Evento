@foreach ($events as $event)
    <div class="col-12 col-sm-6 col-md-4">
        <div class="next-event-wrap">
            <figure>
                <a href="/soloevent?id={{$event->id}}"><img src="assets/images/{{ $event->image }}" alt="1"></a>
                @if($event->price == 0)
                    <div class="event-rating">Free</div>
                @else 
                    <div class="event-rating">{{$event->price}} DH</div>
                @endif
            </figure>

            <header class="entry-header">
                <h3 class="entry-title">{{$event->title}}</h3>
                <div class="posted-date">{{ \Carbon\Carbon::parse($event->date)->format('l') }} <span>{{$event->date}}</span></div>
            </header>

            <div class="entry-content">
                <p>{{$event->description}}.</p>
            </div>

          
        </div>
    </div>
@endforeach
