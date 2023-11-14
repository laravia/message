<?php

namespace Laravia\Message\App\Orchid\Screens;

use Illuminate\Http\Request;
use Laravia\Heart\App\Laravia;
use Laravia\Message\App\Models\Message as ModelsMessage;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class MessageEditScreen extends Screen
{
    public $message;

    public function query(ModelsMessage $message): array
    {
        return [
            'message' => $message
        ];
    }

    public function name(): ?string
    {
        return $this->message->exists ? 'Edit message' : 'Creating a new message';
    }

    public function description(): ?string
    {
        return "Messages";
    }

    public function commandBar(): array
    {
        return [
            Button::make('Create message')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->message->exists),

            Button::make('Update')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee($this->message->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->message->exists),
        ];
    }

    public function layout(): array
    {
        return [
                Layout::rows([
                    Input::make('message.from')
                        ->title('From')
                        ->placeholder('From')
                        ->required(),
                ]),
                Layout::rows([
                    TextArea::make('message.body')
                        ->title('Body')
                        ->rows(10)
                        ->placeholder('Body')
                        ->required(),
                ]),
                Layout::columns([
                    Layout::rows([
                        Input::make('message.url')
                            ->title('Url')
                            ->placeholder('Url')
                    ]),
                    Layout::rows([
                        Select::make('message.project')
                            ->title('Project')
                            ->placeholder('Project')
                            ->options(Laravia::getArrayWithDistinctFieldDataFromClassByKey(ModelsMessage::class, 'project'))
                            ->allowAdd()
                    ])->canSee(count(Laravia::getDataFromConfigByKey('projects'))),

                ]),

        ];
    }

    public function createOrUpdate(Request $request)
    {
        $this->message->fill($request->get('message'))->save();

        Alert::info('You have successfully created a message.');

        return redirect()->route('laravia.message.list');
    }

    public function remove()
    {
        $this->message->delete();

        Alert::info('You have successfully deleted the message.');

        return redirect()->route('laravia.message.list');
    }
}
