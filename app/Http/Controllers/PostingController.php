<?php

namespace App\Http\Controllers;

use App\Models\Posting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PostingController extends Controller
{
    function index($id) {
        $addSee = Posting::find($id);
        if($addSee->status == 0){
          return redirect()->route('beranda');
        }
        $addSee->see++;
        $addSee->save();
        $data = Posting::where('id',$id)->first();
        return view('posting.pages.posting',compact('data'));
    }

    function beranda() {
        $data = Posting::where('status', 1)
        ->orderBy('see','desc')
        ->get()
        ->map(function($item) {
            $item->content = Str::limit(strip_tags($item->content), 280);
            return $item;
        });
        return view('posting.pages.beranda', compact('data'));
    }

    function like($id) {
        try {
            $post = Posting::find($id);
            $post->like++;
            $post->save();
            return response()->json(['status' => 'Terima Kasih sudah Like']);
        } catch (\Throwable $th) {
            return response()->json(['status' => $th->getMessage()]);
        }
    }
}
