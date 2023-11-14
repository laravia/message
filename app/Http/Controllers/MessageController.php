<?php

namespace Laravia\Message\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravia\Heart\App\Laravia;
use Laravia\Message\App\Models\Message;

class MessageController extends Controller
{
    public function sendEmailToAdmin(object $message)
    {
        $body = __('laravia.message::common.from') . ": " . $message->from . " <br /><br />";
        $body .= __('laravia.message::common.body') . ":<br /> " . $message->body . " <br /><br />";
        $body .= __('laravia.message::common.url') . ": " . $message->url . " <br />";
        $body .= __('laravia.message::common.createdAt') . ": " . $message->created_at;

        Laravia::sendEmail(__('laravia.message::common.subject', [
            'project' => Laravia::getProjectNameFromDomain()
        ]), $body);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'from' => 'required',
            'body' => 'required',
            'honeypot' => 'prohibited'
        ]);

        $request->merge([
            'url' => url()->previous(),
            'project' => Laravia::getProjectNameFromDomain()
        ]);

        $message = Message::create($request->all());
        $this->sendEmailToAdmin($message);
        return back()->with('message', __('laravia.message::common.storeSuccess'));
    }
}
