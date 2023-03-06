<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function subscribe(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'tagId' => 'required|integer',
            'name' => 'required'
        ]);

        try {
            Subscriber::create([
                'tag_id' => $request->tagId,
                'email' => $request->email,
                'name' => $request->name,
            ]);
            session()->flash('success', 'Вы успешно подписались на вакансии по этому тегу!');
            /*Mail::send('email.test', [], function ($message) {
            $message->from('a.andreev@job-barnaul.ru', 'Работа.Барнаул');
            $message->to('fobos.2035@gmail.com', 'Receiver')->subject('Тестовое письмо с HTML');
            });*/
            return redirect()->back();
        }
        catch (\Throwable $e) {
            session()->flash('error', 'Ошибка подписки! Возможно, вы уже подписаны.');
            /*return response()->json(['error'=>$e]);*/
            return redirect()->back();
        }
    }

    public function unsubscribe() {

    }
}
