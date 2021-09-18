<?php


namespace App\Traits;


use App\User;
use Illuminate\Support\Facades\Mail;

trait Mails
{
    private $resource_name = 'Nestech';

    public function handleSendingEmail(int $user_id, string $page, string $subject, string $url = "https://nestech.org", string $resource = "Nestech")
    {
        // TODO : set "from" email, create blade pages make sure if the receiver is one person or group

        $this->resource_name = $resource;

        $developer = User::query()->find($user_id);
        $data = array(
            'email' => $developer['email'],
            'name' => $developer['name'],
            'url' => $url,
            'from' => $this->resource_name,
        );
        try {
            Mail::send('emails.' . $page, ['data' => $data], function ($message) use ($data, $subject) {
                $message->to($data['email'], $data['name'])->subject($subject);
                $message->from('zainaldeen@nestech.org', 'Zain Aldeen')->subject($subject);
            });
        } catch (\Exception $exception) {
            die($exception);
        }
        return true;

    }

}
