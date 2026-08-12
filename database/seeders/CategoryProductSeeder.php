<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CategoryProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'صناديق الشحن', 'slug' => 'shipping', 'sort_order' => 1],
            ['name' => 'تغليف مخصص', 'slug' => 'custom', 'sort_order' => 2],
            ['name' => 'غذائي', 'slug' => 'food', 'sort_order' => 3],
            ['name' => 'حماية وعزل', 'slug' => 'protection', 'sort_order' => 4],
            ['name' => 'عرض وتسويق', 'slug' => 'display', 'sort_order' => 5],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['slug' => $category['slug']], $category);
        }

        $shipping = Category::where('slug', 'shipping')->first();
        $custom = Category::where('slug', 'custom')->first();
        $food = Category::where('slug', 'food')->first();
        $protection = Category::where('slug', 'protection')->first();
        $display = Category::where('slug', 'display')->first();

        $products = [
            [
                'category_id' => $shipping->id,
                'name' => 'صناديق شحن صناعية',
                'slug' => 'industrial-shipping-boxes',
                'description' => 'كرتون مضلع ثلاثي الجدران بقوة انفجار تصل إلى 1,200 كيلوجرام/م². مصمم للشحن الدولي والأحمال الثقيلة.',
                'spec_label' => 'BC Flute · 1200 كجم/م²',
                'badge_text' => 'الأكثر طلباً',
                'image' => 'images/img_5b4e8e14137c6151ce525a73f25fea94.jpg',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'category_id' => $custom->id,
                'name' => 'تغليف مخصص',
                'slug' => 'custom-packaging',
                'description' => 'تصاميم مصممة خصيصاً مع طباعة الشعار والألوان.',
                'spec_label' => 'فليكسو / أوفست',
                'badge_text' => 'مخصص',
                'image' => 'images/img_0e874d1cdf994aad6eb9042249970d63.jpg',
                'sort_order' => 2,
            ],
            [
                'category_id' => $food->id,
                'name' => 'صناديق البيتزا',
                'slug' => 'pizza-boxes',
                'description' => 'كرتون غذائي مقاوم للدهون والحرارة حتى 200°م.',
                'spec_label' => 'FDA معتمد',
                'badge_text' => 'غذائي',
                'image' => 'images/img_8bc9cd25580dfff220339c9ed3f1e791.jpg',
                'sort_order' => 3,
            ],
            [
                'category_id' => $protection->id,
                'name' => 'أكمام واقية',
                'slug' => 'protective-sleeves',
                'description' => 'حماية للإلكترونيات والمنتجات الهشة أثناء الشحن.',
                'spec_label' => 'E Flute',
                'image' => 'images/img_a441432d5aa08b1009196386839e10dc.jpg',
                'sort_order' => 4,
            ],
            [
                'category_id' => $shipping->id,
                'name' => 'صناديق RSC',
                'slug' => 'rsc-boxes',
                'description' => 'صندوق Regular Slotted Container — الأكثر شيوعاً في اللوجستيات.',
                'spec_label' => 'BC / C Flute',
                'image' => 'images/img_5b4e8e14137c6151ce525a73f25fea94.jpg',
                'sort_order' => 5,
            ],
            [
                'category_id' => $shipping->id,
                'name' => 'صناديق FOL',
                'slug' => 'fol-boxes',
                'description' => 'Full Overlap — تغطية كاملة للأغطية لحماية إضافية.',
                'spec_label' => 'ثقيل التحمل',
                'icon' => 'inventory_2',
                'sort_order' => 6,
            ],
            [
                'category_id' => $food->id,
                'name' => 'حاملات المشروبات',
                'slug' => 'beverage-carriers',
                'description' => 'حاملات 2-4 أكواب بتصميم مخصص للمقاهي والمطاعم.',
                'spec_label' => 'E Flute',
                'badge_text' => 'غذائي',
                'icon' => 'local_cafe',
                'sort_order' => 7,
            ],
            [
                'category_id' => $display->id,
                'name' => 'صناديق عرض',
                'slug' => 'display-boxes',
                'description' => 'تغليف عرض للبيع بالتجزئة مع نافذة شفافة اختيارية.',
                'spec_label' => 'طباعة UV',
                'image' => 'images/img_b73b517e1c7804eefc5e4d0d9b735a96.jpg',
                'sort_order' => 8,
            ],
            [
                'category_id' => $protection->id,
                'name' => 'فواصل داخلية',
                'slug' => 'internal-dividers',
                'description' => 'حواجز وقواطع داخلية لتثبيت المنتجات المتعددة.',
                'spec_label' => 'مخصص CNC',
                'icon' => 'layers',
                'sort_order' => 9,
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(['slug' => $product['slug']], $product);
        }
    }
}
