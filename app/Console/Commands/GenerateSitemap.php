<?php
// Модуль: artisan-команда генерации XML-карты сайта
// Назначение: Автоматическое формирование sitemap.xml для поисковых роботов
// Функционал: Обход всех статических и динамических страниц,
// установка приоритета индексации и частоты обновления
namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\Service;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate'; // Имя команды для запуска
    protected $description = 'Генерация XML-карты сайта sitemap.xml';

    public function handle()
    {
        $baseUrl = 'https://четыре-с-хвостиком.рф'; // Базовый URL сайта
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

        // Статические страницы с приоритетами
        $staticPages = [
            ['/', '1.0', 'daily'],             // Главная — максимальный приоритет
            ['/all-services', '0.9', 'weekly'], // Каталог услуг
            ['/products', '0.9', 'weekly'],     // Каталог товаров
        ];
        foreach ($staticPages as $page) {
            $xml .= $this->buildUrl($baseUrl . $page[0], $page[1], $page[2]);
        }

        // Динамические страницы услуг
        foreach (Service::all() as $service) {
            $xml .= $this->buildUrl($baseUrl . '/service/' . $service->id, '0.8', 'weekly');
        }

        // Динамические страницы товаров
        foreach (Product::all() as $product) {
            $xml .= $this->buildUrl($baseUrl . '/product/' . $product->id, '0.7', 'weekly');
        }

        $xml .= '</urlset>';
        file_put_contents(public_path('sitemap.xml'), $xml); // Сохранение файла
        $this->info('Карта сайта успешно сгенерирована');
    }

    private function buildUrl($loc, $priority, $changefreq)
    {
        return "  <url>\n    <loc>{$loc}</loc>\n    <priority>{$priority}</priority>\n    <changefreq>{$changefreq}</changefreq>\n  </url>\n";
    }
}