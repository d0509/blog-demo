<?php

namespace App\Console\Commands;

use App\Mail\SendLatestBlogs as MailSendLatestBlogs;
use App\Models\Post;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Adapter\PDFLib;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendLatestBlogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:send-latest-blogs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $blogs = Post::with(['media' => function ($query) {
            $query->latest()->first();
        }])->latest()->take(2)->get();
        
        $email = "admin@gmail.com";
        
        // $pdf = Pdf::loadView('pdf.latest-blog-pdf');
        // return $pdf;  

        if($blogs->count() > 0)
        { 
            Mail::to($email)->send(new MailSendLatestBlogs($blogs));   
            $this->info('Success');
        }
        // info('hello world');
    }
}
