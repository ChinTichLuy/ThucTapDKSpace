<?php

namespace App\Http\Controllers;

use App\Contracts\TranslatorInterface;
use App\Services\MessageService;

class HomeController extends Controller
{
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
