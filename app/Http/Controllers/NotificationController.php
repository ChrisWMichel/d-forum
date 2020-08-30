<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class NotificationController extends Controller
{

    public function __construct(){
       // $this->middleware('auth:sanctum');
    }

    public function index(Request $request)
    {
        $user = User::find($request->id);
        return [
            'read' => NotificationResource::collection($user->readNotifications),
            'unread' => NotificationResource::collection($user->unReadNotifications)
        ];
    }
    public function markAsRead(Request $request)
    {
        $user = User::find($request->user['id']);
        $user->notifications->where('id', $request->noticeID)->markAsRead();
    }
    public function deleteNotifications(Request $request){

        //Notification::destroy($request->ids);
        DB::table('notifications')->whereIn('id', $request->ids)->delete();
    }
}
