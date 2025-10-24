<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Candidate;
use Illuminate\Support\Facades\Storage;


class TelegramController extends Controller
{
    public function webhook(Request $r)
    {
        $data = $r->all();

        if (!isset($data['message'])) {
            return response('ok');
        }

        $msg = $data['message'];
        $chat_id = $msg['chat']['id'];
        $text = $msg['text'] ?? '';

        // Этап 1 — старт
        if ($text == '/start') {
            $this->send($chat_id, "Assalomu alaykum! Ishga ariza topshirish uchun ismingizni kiriting:");
            cache(["step_$chat_id" => 'first_name'], 600);
            return response('ok');
        }

        // Получаем текущий шаг
        $step = cache("step_$chat_id");

        // Сценарий по шагам
        switch ($step) {
            case 'first_name':
                cache(["first_name_$chat_id" => $text]);
                cache(["step_$chat_id" => 'last_name']);
                $this->send($chat_id, "Familiyangizni kiriting:");
                break;

            case 'last_name':
                cache(["last_name_$chat_id" => $text]);
                cache(["step_$chat_id" => 'phone']);
                $this->send($chat_id, "Telefon raqamingizni kiriting:");
                break;

            case 'phone':
                cache(["phone_$chat_id" => $text]);
                cache(["step_$chat_id" => 'position']);
                $this->send($chat_id, "Qaysi lavozimga ariza bermoqchisiz?");
                break;

            case 'position':
                cache(["position_$chat_id" => $text]);
                cache(["step_$chat_id" => 'resume']);
                $this->send($chat_id, "Iltimos, rezyumeni fayl sifatida yuboring (PDF, DOC).");
                break;

            case 'resume':
                if (isset($msg['document'])) {
                    $file_id = $msg['document']['file_id'];
                    $file = Http::get("https://api.telegram.org/bot".config('services.telegram.bot_token')."/getFile", ['file_id'=>$file_id])->json();
                    $file_path = $file['result']['file_path'] ?? null;
                    if ($file_path) {
                        $contents = Http::get("https://api.telegram.org/file/bot".config('services.telegram.bot_token')."/".$file_path)->body();
                        $filename = 'resumes/'.$chat_id.'_'.basename($file_path);
                        Storage::disk('public')->put($filename, $contents);
                    }
                    $candidate = Candidate::create([
                        'first_name'=>cache("first_name_$chat_id"),
                        'last_name'=>cache("last_name_$chat_id"),
                        'phone'=>cache("phone_$chat_id"),
                        'position'=>cache("position_$chat_id"),
                        'resume_path'=>$filename ?? null,
                    ]);
                    $this->send($chat_id, "Rahmat! Sizning arizangiz qabul qilindi ✅");
                    cache()->forget("step_$chat_id");
                } else {
                    $this->send($chat_id, "Iltimos, fayl yuboring.");
                }
                break;

            default:
                $this->send($chat_id, "Boshlash uchun /start buyrug‘ini yuboring.");
        }

        return response('ok');
    }

    private function send($chat_id, $text)
    {
        Http::post("https://api.telegram.org/bot".config('services.telegram.bot_token')."/sendMessage", [
            'chat_id'=>$chat_id,
            'text'=>$text
        ]);
    }
}
