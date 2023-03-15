<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeetingController extends Controller
{
    public function index(){
        $meetings = Meeting::paginate(10);
        return view('meeting.meetingsdata',compact('meetings'));
    }

    public function addAndupdate(Request $request){
        if($request->updateId){
            $meeting = Meeting::find($request->updateId);
            $meeting->subject = $request->subject;
            $meeting->date_time = $request->date_time;
            $meeting->organizer_id = Auth::user()->id;
            $meeting->update();
            return response()->json(['code'=>1,'msg' => 'New Meeting has been saved successfull']);
        }else{
            Meeting::insert([
                'subject' => $request->subject,
                'date_time' => $request->date_time,
                'organizer_id' => Auth::user()->id,
    
            ]);
            return response()->json(['code'=>2,'msg' => 'New Meeting has been saved successfull']);
        }
        
    }

    public function fetchMeetings(){
        $meetings = Meeting::paginate(10);
        $meetings = view('meeting.meetingsdata',compact('meetings'))->render();
        return response()->json(['code','result'=>$meetings]);
    }

    public function DeleteMeeting(Request $request){
        $meeting = Meeting::find($request->meetingId);
        $meeting->delete();
        return response()->json(['code'=>1,'msg'=>'Meeting has been deleted successfully']);
    }

    public function getMeetingEdit(Request $request){
        $meeting = Meeting::find($request->meetingId);
        return response()->json(['code'=>1,'result'=>$meeting]);
    }

    public function MeetingUpdate(Request $request){
        $meeting = Meeting::find($request->updateId);
        $meeting->subject = $request->subject;
        $meeting->date_time = $request->date_time;
        $meeting->organizer_id = Auth::user()->id;
        $meeting->update();
        return response()->json(['code'=>1,'msg'=>'Meeting has been Updated successfully']);
    }
}
