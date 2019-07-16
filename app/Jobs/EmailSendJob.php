<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class EmailSendJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $word;

    /**
     * Create a new job instance.
     *
     * @param string $word
     */
    public function __construct(string $word)
    {
        $this->word = $word;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        dump("слово: {$this->word}");
    }
}
