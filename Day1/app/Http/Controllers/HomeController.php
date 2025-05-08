<?php

namespace App\Http\Controllers;

use App\Contracts\TranslatorInterface;
use App\Services\MessageService;

class HomeController extends Controller
{
    // protected $messageService;

    // // Laravel sẽ tự inject MessageService vào đây
    // public function __construct(MessageService $messageService)
    // {
    //     $this->messageService = $messageService;
    // }

    // public function index()
    // {
    //     return $this->messageService->getMessage();
    // }

    protected TranslatorInterface $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function index()
    {
        return $this->translator->hello();
    }
}
