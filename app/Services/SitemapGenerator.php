<?php

namespace App\Services;

use App\Models\DatingZone;
use App\Models\LiveZone;
use App\Models\MallProduct;
use App\Models\MiniApp;
use Carbon\Carbon;
use File;
use Illuminate\Support\Facades\URL;

class SitemapGenerator
{
    public function __construct()
    {
        $this->MiniApp = new MiniApp;
        $this->DatingZone = new DatingZone;
        $this->LiveZone = new LiveZone;
        $this->MallProduct = new MallProduct;
    }

    public function generate()
    {
        $now = Carbon::now()->format('Y-m-d');
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
            \Log::error('Failed to write sitemap.xml: ' . $e->getMessage());
        }
    }

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
        $query = $model::query();

        if (method_exists($model, 'category')) {
            $query->with('category');
        }

        $query
            ->orderBy('updated_at', 'desc')
            ->limit(8000)
            ->get()
            ->each(function ($item) use (&$items, $base) {
                $path = '/' . $item->slug;

                if (method_exists($item, 'category') && $item->category && $item->category_active) {
                    $path = '/' . $item->category->slug . '/' . $item->slug;
                }

                $items[] = [
                    'loc' => $base . $path,
                    'lastmod' => Carbon::now()->format('Y-m-d'),
                    'priority' => '0.8',
                ];
            });

        return $items;
    }
}
