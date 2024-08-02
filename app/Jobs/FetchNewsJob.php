<?php

namespace App\Jobs;

use App\Models\News;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Goutte\Client;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpClient\HttpClient;

class FetchNewsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $client = new Client(HttpClient::create(['verify_peer' => false, 'verify_host' => false]));
            $crawler = $client->request('GET', 'https://banker.az');
            // News::truncate();

            foreach ([1, 4, 8, 10] as $index) {
                $thumbnail = $crawler->filter('#tdi_106 > div:nth-child(' . $index . ') > div > div.td-image-container > div > a > span')->attr('data-bg');
                $title = $crawler->filter('#tdi_106 > div:nth-child(' . $index . ') > div > div.td-module-meta-info > h3 > a')->text();
                $url = $crawler->filter('#tdi_106 > div:nth-child(' . $index . ') > div > div.td-module-meta-info > h3 > a')->attr('href');

                // $client = new Client(HttpClient::create(['timeout' => 3000]));
                $crawlers = $client->request('GET', $url);
                $text = $crawlers->filter('#tdi_77 > div > div.vc_column.tdi_80.wpb_column.vc_column_container.tdc-column.td-pb-span8 > div > div.td_block_wrap.tdb_single_content.tdi_88.td-pb-border-top.td_block_template_1.td-post-content.tagdiv-type > div')->html();

                News::create([
                    'title' => $title,
                    'thumbnail' => $thumbnail,
                    'url' => $url,
                    'text' => $text
                ]);
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
