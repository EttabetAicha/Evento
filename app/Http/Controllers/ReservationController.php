<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Reservation;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ReservationController extends Controller
{
    //
    protected $rese;
    protected $event;
    public function __construct()
    {
        $this->rese = new Reservation();
        $this->event = new Event();
       
        
    } 
    public function index(){
        $user_id = Session::get('user_id');
        $reservations = Reservation::select( 'events.id as id' , 'events.title as title'  , 'events.date as date' ,'events.acceptation as accepte', 'reservations.id as user_id' , 
         'reservations.status as status'  )
            ->join('events', 'reservations.event_id', '=', 'events.id')
            ->join('users', 'reservations.user_id', '=', 'users.id')
            ->where('users.id', $user_id)
            ->orderBy('reservations.updated_at', 'desc')
            ->get();
        // dd($reservations);
        return view('user.reservation' , compact('reservations'));
    }
    public function indexOrg(){
        $user_id = Session::get('user_id');
        $reservations = Reservation::select( 'events.id as id' ,'events.acceptation as accepte', 'events.title as title'  ,
         'events.date as date' , 'reservations.id as user_id' ,  'reservations.status as status'
         ,'reservations.fname as fname' ,  'reservations.lname as lname' , 'reservations.id as res_id')
            ->join('events', 'reservations.event_id', '=', 'events.id')
            ->join('users', 'events.user_id', '=', 'users.id')
            ->where('users.id', $user_id)
            ->orderBy('reservations.updated_at', 'desc')
            ->get();

        $count = $reservations->count();
        
        return view('dashboard.layouts.reservations' , compact('reservations' , 'count'));
    }




    public function create(Request $request)
    {

       
        $rules = [
            'fname' => 'required',
            'lname' => 'required',
        ];

        if ($request->email === 'new') {
            $rules['new_email'] = 'required|email';
        } else {
            $rules['email'] = 'required';
        }

        $this->validate($request, $rules);

        $rescheck = $this->rese->where('user_id', Session::get('user_id'))
          ->where('event_id', $request->event_id)
          ->first();

          if(empty($rescheck)) {
 

        $reservation = $this->rese;;
        $reservation->user_id =Session::get('user_id');
        $reservation->event_id = $request->event_id;
        
        $reservation->fname = $request->fname;
        $reservation->lname = $request->lname;

        $reservation->email = ($request->email === 'new') ? $request->new_email : $request->email;

        $reservation->save();

        if ($reservation) {
            $event = $this->event->find($request->event_id);
            $event->increment('total_reservations');
        }
        
        return redirect()->back()->with('success', 'Reservation successful.');
    }
    
    else {
        return redirect()->back()->with('error', 'You have already reserved this event.');
    }
}





public function generateTicket($id_event, $id_user)
{
    $event = Event::findOrFail($id_event);

    $reservator = Reservation::where('event_id', $id_event)
        ->where('id', $id_user)
        ->firstOrFail();

   

    $html = view('user.tickets.pdf',compact('event' , 'reservator'));

    $pdf = new Dompdf();

    $pdf->loadHtml($html);

    $pdf->setPaper('A4', 'portrait');

    $pdf->render();

    return $pdf->stream("event_ticket_{$id_event}.pdf");
}



public function accept($id){
    $reservation = $this->rese->find($id); 
    $reservation->status = 1;
    $reservation->save(); 
    return redirect()->back()->with('success', 'Reservation accepted successfully');
}

public function reject($id){
    $reservation = $this->rese->find($id); 
    $reservation->status = 2;
    $reservation->save(); 
    return redirect()->back()->with('success', 'Reservation rejected successfully');
}

}
