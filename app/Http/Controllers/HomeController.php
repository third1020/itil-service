<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // ทำให้คนที่เข้าใช้เปนadmin อัตโนมัติ
        // auth()->user()->assignRole('admin');
        // ลบบทบาทadminที่เข้าใช้่
        // auth()->user()->removeRole('admin');
        // สามารถกำหนดบทบาทมากกว่า1บทบาท
        // ลบบทบาทได้หลายบทบาท
        // auth()->user()-removeRole(['writer']);
        // auth()->user()->syncRoles(['reader','writer']);
        // $user=auth()->user();
        // บทบาทนี้ดูได้เเค่อันเดียวคือreadpost
        // $user->givePermissionTo('readpost');
        // บทบาทนี้ดูได้หลายอัน
        // $user->syncPermissions(['addpost','editpost','deletepost','readpost']);
        // 
        if(auth()->user()->hasRole("admin")){
            $user=auth()->user();
            // $user->syncPermissions(['manageuser','addpost','editpost','deletepost','readpost']);
            // ทำให้ไม่สามารถไปeditpostได้
            // $user->revokePermissionTo('editpost');
            // ดูว่ามีสิทธิในการeditpostไหม
            // dd($user->hasPermissionTo('editpost'));
            // ดูว่ามีสิทธิในarrayไหม
            // dd($user->hasAllPermissions(['manageuser','addpost','deletepost']));
            return view('admin');
        }
        else{
            $user=auth()->user();
            $user->syncPermissions(['addpost','editpost','deletepost','readpost']);
            return view('home');
        }
    }
}
