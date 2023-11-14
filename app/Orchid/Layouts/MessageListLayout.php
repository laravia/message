<?php

namespace Laravia\Message\App\Orchid\Layouts;

use Laravia\Message\App\Models\Message;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\TD;
use Orchid\Screen\Layouts\Table;

class MessageListLayout extends Table
{
    public $target = 'messages';

    public function columns(): array
    {
        return [

            TD::make('from', 'From')->sort(),

            TD::make('body', 'Body')
                ->sort()
                ->render(function ($message) {
                    return substr($message->body,0, 50) . '...';
                }),

            TD::make('url', 'Url')
                ->sort()
                ->render(function ($message) {
                    return $message->url;
                }),

            TD::make('project', 'Project')->sort(),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (Message $message) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([

                        Link::make(__('Edit'))
                            ->route('laravia.message.edit', $message->id)
                            ->icon('bs.pencil'),

                        Button::make(__('Delete'))
                            ->icon('bs.trash3')
                            ->confirm(__('Once the message entry is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                            ->method('remove', [
                                'id' => $message->id,
                            ]),
                    ]))
        ];
    }
}
