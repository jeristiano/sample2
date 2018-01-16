<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');//登录验证权限
    }
    public function store(Request $request){
            $this->validate($request,[
               'content'=>'required|max:140'
            ]);
        Auth::user()->statuses()->create([
            'content'=>$request->get('content')
        ]);
        return redirect()->back();
    }

    public function destroy(Status $status){
        $this->authorize('destroy', $status);
        $status->delete();
        session()->flash('success', '微博已被成功删除！');
        return redirect()->back();
    }


}
