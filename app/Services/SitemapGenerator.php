<?php

namespace App\Services;

use App\Models\DatingZone;
use App\Models\LiveZone;
use App\Models\MallProduct;
use App\Models\MiniApp;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Response;
use File;

class SitemapGenerator
{
    public function __construct()
    {
        $this->MiniApp  = new  MiniApp;
        $this->DatingZone  = new  DatingZone;
        $this->LiveZone  = new  LiveZone;
        $this->MallProduct  = new  MallProduct;
    }
    /**
     * Generate simple sitemap.xml for MiniApp / frontend SPA / API + some static pages
     */
    public function generate()
    {
        $now = Carbon::now()->toAtomString();
        $urls = $this->getUrls();
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">' . "\n";
        foreach ($urls as $item) {
            $xml .= "  <url>\n";
            $xml .= "    <loc>" . htmlspecialchars($item['loc'], ENT_QUOTES, 'UTF-8') . "</loc>\n";
            $xml .= "    <lastmod>" . ($item['lastmod'] ?? $now) . "</lastmod>\n";
            $xml .= "    <changefreq>" . ($item['changefreq'] ?? 'weekly') . "</changefreq>\n";
            $xml .= "    <priority>" . ($item['priority'] ?? '0.6') . "</priority>\n";
            $xml .= "  </url>\n";
        }
        $xml .= '</urlset>';
        $path = public_path('sitemap.xml');
        try {
            File::put($path, $xml);
            chmod($path, 0644);
        } catch (\Exception $e) {
            \Log::error("Failed to write sitemap.xml: " . $e->getMessage());
        }
    }

    /**
     * You should customize this method according to your MiniApp
     */
    private function getUrls(): array
    {
        $base = URL::to('/');

        return [
            [
                'loc' => $base . '/',
                'changefreq' => 'daily',
                'priority' => '1.0',
            ],
            ...$this->getSiteMap($this->MiniApp, $base),
            ...$this->getSiteMap($this->DatingZone, $base),
            ...$this->getSiteMap($this->LiveZone, $base),
            ...$this->getSiteMap($this->MallProduct, $base),

        ];
    }

    private function getSiteMap($model, $base): array
    {
        $items = [];

        $model::query()
            ->orderBy('updated_at', 'desc')
            ->limit(8000)
            ->get(['slug', 'updated_at'])
            ->each(function ($item) use (&$items, $base) {
                $items[] = [
                    'loc'      => $base . '/吴萌萌/' . $item->slug,
                    'lastmod'  => Carbon::parse($item->updated_at)->format('Y-m-d'),
                    'priority' => '0.8',
                ];
            })->toArray();

        return $items;
    }
}
