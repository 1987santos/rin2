<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Service\Twilio\PhoneNumberLookupService;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PhoneNumberLookupService $service)
    {
        $this->service = $service;
        $this->middleware('auth');
    }

    /**
     * Show the user list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function list(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $notification = $request->input('notification');

        $query = User::with(['unreadNotifications' => function($query) {
            $query->where('expiry_date', '>', NOW());
        }]);

        if( !empty($name))
        {
            $query->where('name', 'like', '%'.$name.'%');
        }

        if( !empty($email))
        {
            $query->where('email', 'like', '%'.$email.'%');
        }

        if( !empty($notification))
        {
            $query->where('notification', $notification);
        }

        $users = $query->paginate(10);
        
        return view('user/list', compact('users'));
    }

    /**
     * Show the form to update the user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Request $request, $id) 
    {
        $user = User::where('id', $id)->first();

        return view('user/edit', compact('user'));
     }

     /**
     * Update the user.
     *
     * @return void
     */
    public function update(Request $request, $id) 
    {
        $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:App\Models\User,email,' . $id],
            'phone_number' => ['required', 'string', function ($attribute, $value, $fail) {
                if (! $this->service->validate($value)) {
                    $fail(sprintf('The value provided (%s) is not a valid phone number.', $value));
                }
            }],
        ]);
        
        $user = User::findOrFail($id);

        $input = $request->all();

        $user->fill($input)->save();

        return redirect()->route('user_list')->with('success','User updated successfully!');        
     }

    /**
     * Impersonate the given user.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function impersonate(Request $request, $id)
    {
        if ($id !== Auth::user()->id) {
            if(empty(session()->has('originalUserId'))) {
                session()->put('originalUserId', Auth::user()->id);
            }

            Auth::loginUsingId($id);
        }

        return redirect('/home');
    }

    /**
     * Revert to the original user.
     *
     * @return \Illuminate\Http\Response
     */
    public function revertImpersonate()
    {
        Auth::loginUsingId(session()->get('originalUserId'));

        session()->forget('originalUserId');

        return redirect('/home');
    }
    
}
