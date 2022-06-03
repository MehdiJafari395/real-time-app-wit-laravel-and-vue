<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like(Reply $reply)
    {
        $reply->like()->create([
            'reply_id' => $reply->id,
            'user_id' => 1,
        ]);
    }

    public function unlike(Reply $reply)
    {
        $reply->like()->where('reply_id', $reply->id)->where('user_id', 1)->delete();
    }
}
