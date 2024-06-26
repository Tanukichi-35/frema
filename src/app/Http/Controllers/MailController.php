<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\InformationMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class MailController extends Controller
{
  // メール送信画面の表示
  public function mail(){
    $users = User::All();

    return view('admin.mail', compact('users'));
  }

  // メール送信処理
  public function send(Request $request){
    // dd($request->all());

    $text = $request->text;

    if($request->to == 0){
      $users = User::All();
      foreach ($users as $user) {
          $mail = new InformationMail();
          $name = $user->name;
          $mail->to($user->email, $name.'様')
                ->subject($request->subject)
                ->view('emails.information', compact('name', 'text'))
                ->text('emails.information_plain', compact('name', 'text'));

          Mail::send($mail);
      }
    }
    else{
      $user = User::find($request->to);
      $mail = new InformationMail();
      $name = $user->name;
      $mail->to($user->email, $name.'様')
            ->subject($request->subject)
            ->view('emails.information', compact('name', 'text'))
            ->text('emails.information_plain', compact('name', 'text'));

      Mail::send($mail);
    }

    if (count(Mail::failures()) > 0) {
        $error = 'メール送信に失敗しました';

        return back()->withInput()->with(compact('error'));
    }
    // else if(!$request->toUsers && !$request->toManagers){
    //     $error = '送信先が設定されていません';

    //     return back()->withInput()->with(compact('error'));
    // }
    else{
        $message = 'メールを送信しました';

        return redirect()->route('admin.mail')->with(compact('message'));
    }
  }
}
