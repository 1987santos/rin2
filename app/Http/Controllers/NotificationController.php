<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CustomNotification;
use App\Models\Notification as NotificationModel;

class NotificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * This function show the list of notifications
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $status = $request->input('status');
        $notificationType = $request->input('notification_type');
        $name = $request->input('name');

        $query = NotificationModel::whereHasMorph('notifiable', [User::class], function($query) use($name) {

            $query->where('notification', true);

            if( !empty($name))
            { 
                $query->where('name', 'like', '%'.$name.'%');
            }
        });

        if( !empty($status))
        {
            $status == 'read' ? $query->whereNotNull('read_at') : $query->whereNull('read_at');
        }

        if( !empty($notificationType))
        {
            $query->where('type', $notificationType);
        }

        $notifications = $query->paginate(10);
        
        return view('notification/index', compact('notifications'));
    }
  
    /**
     * This function show the form to send the notifications
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        $users = User::where('notification', true)->get();
        
        return view('notification/create', compact('users'));
    }
    
    /**
     * This function send the notifications
     *
     * @return void
     */
    public function send(Request $request) {

        $request->validate([
            'notification_type' => 'required',
            'message' => 'required',
            'expiry_date' => ['required','date_format:Y-m-d'],
            'notify_to' => 'required',
        ]);
        
        $users = User::whereIn('id',$request->notify_to)->get();        
        
        $data = [
            'message' => $request->message,
            'expiry_date' => $request->expiry_date,
            'notification_type' => $request->notification_type,
        ];

        Notification::send($users, new CustomNotification($data));

        return redirect()->route('notification_dashboard')->with('success','Notification sent successfully!');
    }
    
    /**
     * Mark the notification as read
    *
     * @return string
     */
    public function markAsRead(Request $request)
    {
        $notification = NotificationModel::find($request->id)->update(['read_at'=> now()]);

        return 'success';
    }
}
