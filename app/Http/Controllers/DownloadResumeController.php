<?php

namespace App\Http\Controllers;

use App\Mail\ResumeDownloaded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DownloadResumeController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ], [
            'email.required' => 'To be fair, you could enter any valid email and you would still be able to download my resume. <br>So if you really want it that badly then here, use <code>gimme@example.com</code>',
            'email.email' => 'To be fair, you could enter any valid email and you would still be able to download my resume. <br>So if you really want it that badly then here, use <code>gimme@example.com</code>',
        ]);

        Mail::to(config('mail.from.address'))
            ->send(new ResumeDownloaded($request->input('email')));

        return response()->download(storage_path('app/resume.pdf'), 'Tonning, Kristoffer - Resume');
    }
}
