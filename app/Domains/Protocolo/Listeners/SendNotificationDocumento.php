<?php

namespace App\Domains\Protocolo\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Domains\Protocolo\Events\DocumentoCadastrado;
use Joli\JoliNotif\Notification;
use Joli\JoliNotif\NotifierFactory;

class SendNotificationDocumento implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(DocumentoCadastrado $event)
    {
        $notifier = NotifierFactory::create();

        if (auth()->user()->id_departamento == $event->documento->id_departamento){
            $notification =
                (new Notification())
                    ->setTitle('Novo Documento Cadastrado!')
                    ->setBody('Foi cadastrado o documento Nº' . $event->documento->numero)
                    ->setIcon(public_path('/backend/images/logo.png'));

            $notifier->send($notification);
        }
    }
}
