<?php

namespace Laravia\Message\App\Orchid\Screens;

use Illuminate\Http\Request;
use Laravia\Message\App\Models\Message as ModelsMessage;
use Laravia\Message\App\Orchid\Layouts\MessageListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class MessageScreen extends Screen
{

    public function query(): iterable
    {
        return [
            'messages' => ModelsMessage::orderByDesc('id')->paginate(),
        ];
    }

    public function name(): ?string
    {
        return 'Message Screen';
    }

    public function description(): ?string
    {
        return 'Messages of Laravia';
    }

    public function commandBar(): iterable
    {
        return [
            Link::make('Create new message')
                ->icon('pencil')
                ->route('laravia.message.edit')
        ];
    }

    public function layout(): iterable
    {
        return [
            MessageListLayout::class
        ];
    }

    public function remove(Request $request): void
    {
        ModelsMessage::findOrFail($request->get('id'))->delete();

        Alert::info('You have successfully deleted the message.');
    }
}
