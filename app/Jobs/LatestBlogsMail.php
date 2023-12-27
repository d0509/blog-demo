<?php

namespace App\Jobs;

use App\Console\Commands\SendLatestBlogs;
use App\Mail\SendLatestBlogs as MailSendLatestBlogs;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class LatestBlogsMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $blogs;
    public $pdfPath;
    /**
     * Create a new job instance.
     */
    public function __construct($blogs,$pdfPath)
    {
        $this->blogs = $blogs;
        $this->pdfPath = $pdfPath;    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to("admin@gmail.com")->send(new MailSendLatestBlogs($this->blogs, $this->pdfPath));
    }
}
