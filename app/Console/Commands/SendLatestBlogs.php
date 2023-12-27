<?php

namespace App\Console\Commands;

use App\Jobs\LatestBlogsMail;
use App\Models\Post;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

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

        $blogs = Post::with('media')->latest()->take(2)->get();

        if($blogs->count() > 0)
        { 
            $pdf = PDF::loadView('pdf.latest-blog-pdf', compact('blogs'));
            $pdfName = 'blog_' . now()->timestamp . '.pdf';
            
            $pdf->save(public_path() . '\storage\posts' . $pdfName);
            $pdfPath = public_path() . '\storage\posts' . $pdfName;
            
            try {
                LatestBlogsMail::dispatch($blogs, $pdfPath);
            } catch (\Exception $e) {
                Log::error('PDF generation error: ' . $e->getMessage());
            }

            $this->info('Success');
        }
    }
}
