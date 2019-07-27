<?php

namespace App\Jobs;

use App\Messages;
use App\Files;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class SendDataBd implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $messages;
    protected $id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('eeeee');
        $id = $this->id;
        $filename = Files::find($id)->file_name;
        //$message = Storage::get('files/' . $filename);
        //foreach (explode("\n", $message) as $key=>$line){
        //   $array[$key] = explode(',', $line);
        //}
        $path = storage_path('app/files/');
        $message=file($path.$filename);
        $file = Files::find($id);
        $file->availability="processing";
        $file->save();
        $re = '/^\d{1,2}\/\d{1,2}\/\d{1,2}\,\ \d{2}\:\d{2}/';
        $N=count($message);
        $message_data = new Messages();
        for ($i = 0; $i < $N-1; $i++) {
            $message_data = new Messages();
            if (preg_match($re, $message[$i])) {
                $text[0] = explode(", ", $message[$i], 2); //Дата
                $text[1] = explode(" - ", $text[0][1], 2); //Время
                $text[2] = explode(": ", $text[1][1], 2); //Имя и текст
                if (isset($text[2][1])) {
                    $current_message = $text[2][1];
                } else
                {
                    $current_message = "left";
                }
                do
                    if (!preg_match($re, $message[$i + 1])) {
                        $current_message = $current_message . " " . $message[$i + 1];
                        $i++;
                    }
                while (!preg_match($re, $message[$i + 1]));
            }
            $message_data->date=$text[0][0];
            $message_data->time=$text[1][0];
            if(substr_count($text[1][1], ': ')<1) {
                $message_data->user="System";
                $current_message = "System message";
            } else $message_data->user=$text[2][0];
            $message_data->message=$current_message;
            $message_data->file_id=$id;
            $message_data->save();
        }
        $file = Files::find($id);
        $file->availability="ready";
        $file->save();
    }
}
