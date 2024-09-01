<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\message;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;




class Autoverify extends Controller
{
    //
    public function register(Request $request){

        $output=array();
        $validator = Validator::make($request->all(), [
            'hs_name' => 'required',
            'phone_number' => 'required|max:10', // Adjust 'your_table_name' to your actual table name
            'password' => 'required',
            'hs_repet_password' => 'required|same:password',
        ]);
        
        if ($validator->fails()) {   
            $output['status']=400;
            $output['message']=$validator->errors();
            return response()->json($output, 200);
        }else{
             
            $message=new User; 
               if(!empty($request->hs_profile)){
                             $file=$request->hs_profile;
                            $destinationPath = 'user_image/';
                            $originalFile = $file->getClientOriginalName();
                            $file->move($destinationPath, $originalFile);
                            $message->image =$originalFile;
                      }else{
                          $message->image =$request->hs_name;
                      }
              

                 
                $message->name =$request->hs_name;
                $message->phone_number =$request->phone_number;
                // $message->image =$request->hs_name;
                $message->password=$request->password; 
                $result=$message->save(); 
                if(isset($result)){
                    // $output['status']=200;
                    // $output['message']="Data is Insterted";
                    // return response()->json($output, 200);
                    
                    $credentials = $request->only('phone_number', 'password');
                   
                  if (Auth::attempt($credentials)) {
                           // Authentication passed...
                        $output['status']="redirect";
                        $output['message']="data save";
                    }else {
                        $output['status']=400;
                        $output['message']=$validator->errors();
                       
                    }
                    return response()->json($output, 200);
                }
        }
    }

    //  Search value 
    public function search_value(Request $request){
        $output=array(); 
        if (empty($request->contact_search) || !ctype_digit($request->contact_search)) {
            $output['status'] = 400;
            $output['message'] = "Search Field is empty or not an integer";
            return response()->json($output, 200);
        } else {
            
            $data=User::where('phone_number',$request->contact_search)
            ->first(); 
            $output['status']=200;
            $output['message']=$data;
            return response()->json($output, 200);

        }

    }

    

    //Code for deshbord

    public function view_deshbord(){

        $userId = Auth::id();
        $user=User::where('id',$userId)->first();
        $data = User::where('id', '!=', $userId)->get();
        return view('display',
         ['user'=>$data,
          'Auth'=>$user
         ]);
    }
    

    // code for message
    public function messagess(Request $request){
        $output = array(); 
        $id = $request->user_id; 
        $userId = Auth::id();
       

      $sender=User::find($id); 
          $data = Message::where(function($query) use ($id, $userId) {
            $query->where('sender_id', $id)
                  ->where('recevier_id', $userId);
        })
        ->orWhere(function($query) use ($id, $userId) {
            $query->where('sender_id', $userId)
                  ->where('recevier_id', $id);
        })
        ->get();
        
        // $data = message::where('sender_id', $id)
        //     ->orWhere('recevier_id', $userId)
        //     ->get(); 
        if($data->isEmpty()){
            $output['status']=200;
            $output['message']="no message";
            $output['sender_data']=$sender;
            return response()->json($output,200);
            

        }else{
                    $output['status']=200;
                    $output['message']=$data;
                    $output['auth']=$userId;
                    $output['sender_data']=$sender;
                    return response()->json($output,200);
        }
        

    }




    public function login(Request $request){
        $output=array();
        $validator = Validator::make($request->all(), [
            'phone_number' => 'required|max:10', // Adjust 'your_table_name' to your actual table name
            'password' => 'required',
           ]);
        
        if ($validator->fails()) {         
            $output['status']=400;
            $output['message']=$validator->errors();
            return response()->json($output, 200);
        }else{
            $credentials = $request->only('phone_number', 'password');                 
            if (Auth::attempt($credentials)) {
                     // Authentication passed...
                  $output['status']="redirect";
                  $output['message']="data save";
              }else {
                  $output['status']=300;
                  $output['message']="Wrong user id and Password";
              }

              return response()->json($output, 200);

        }
    }

  public function send_message(Request $request){
    
               $output=array(); 
               $sender_id = Auth::id();
               $recever_id=$request->recevier_id; 
               $message=$request->message; 
               $save_message=new message(); 
               $save_message->sender_id=$sender_id;
               $save_message->recevier_id=$recever_id;
               $save_message->message=$message;
              $data=$save_message->save();
            //   $message = $request->input('message');
              event(new MessageSent($recever_id,$message));
            //   return response()->json(['status' => 'Message Sent!']);

              if($data){

                            $output['status']="200";
                            $output['message']='message send';
                            return response()->json($output, 200);

              }else{
                                $output['status']="400";
                                $output['message']='message is not send';
                                return response()->json($output, 200);
              }
  }

  public function send_puser(){

    event(new MessageSent('hello world','my-channel','my-event'));
  }




}