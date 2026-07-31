<?php

namespace App\Http\Controllers;

use App\Models\NotificationDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function getNotifications()
    {
        $notifications = NotificationDocument::where('person',Auth::user()->name)->take(10)->get();

        // ถ้าระบบยังไม่มีคอลัมน์ is_read ใน View ให้ใช้วิธีนับจำนวนทั้งหมดแทนชั่วคราว
        $unreadCount = $notifications->count(); 

        return response()->json([
            'notifications' => $notifications,
            'unreadCount' => $unreadCount
        ]);
    }
    // เพิ่มฟังก์ชันนี้สำหรับแสดงข้อมูลในพื้นที่กรอบสีแดง
    public function index()
    {
        $notifications = NotificationDocument::where('person',Auth::user()->name)->orderBy('id', 'desc')->paginate(15);
        return view('notifications.index', compact('notifications'), [
            'header' => 'รายการแจ้งเตือนเอกสารทั้งหมด' // เพิ่มบรรทัดนี้
        ]);
    }
}
