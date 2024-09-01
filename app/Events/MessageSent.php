<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\message;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
   
    /**
     * Create a new event instance.
     */

    public $recever; 
    public $message; 



    public function __construct($recever,$message)
    {   
        
        $userId = Auth::id();
              // $this->message =$userId ."/".$id;
         $authdata=User::find($userId);        
        $this->message=['auth'=>$authdata,'recever'=>$recever,'sender'=>$userId,'message'=>$message];
      
    }
  
    public function broadcastOn()
    {
        return ['my-channel'];
    }
  
    public function broadcastAs()
    {
        return 'my-event';
    }


}
