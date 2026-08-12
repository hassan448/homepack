<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\PageSection;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class PageContentSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedSiteSettings();
        $this->seedPages();
    }

    private function seedSiteSettings(): void
    {
        $settings = [
            ['group' => 'general', 'key' => 'site_name', 'label' => 'اسم الموقع', 'value' => 'هوم باك', 'type' => 'text', 'sort_order' => 1],
            ['group' => 'footer', 'key' => 'footer_description', 'label' => 'وصف التذييل', 'value' => 'الشركة الرائدة في حلول الكرتون الهيكلية منذ عام 1984. هندسة للقوة، وتصميم للاستدامة.', 'type' => 'textarea', 'sort_order' => 2],
            ['group' => 'footer', 'key' => 'footer_address', 'label' => 'عنوان التذييل', 'value' => 'المقر: المنطقة الصناعية، بوابة 4<br/>شارع التصنيع', 'type' => 'textarea', 'sort_order' => 3],
            ['group' => 'contact', 'key' => 'contact_address', 'label' => 'العنوان', 'value' => 'المنطقة الصناعية المرحلة الثالثة، بلوك 42<br/>مركز اللوجستيات، العاصمة', 'type' => 'textarea', 'sort_order' => 10],
            ['group' => 'contact', 'key' => 'contact_phone', 'label' => 'الهاتف', 'value' => '+1 (800) 555-PACK', 'type' => 'text', 'sort_order' => 11],
            ['group' => 'contact', 'key' => 'contact_hours', 'label' => 'ساعات العمل', 'value' => 'الاثنين-الجمعة، 08:00 - 18:00', 'type' => 'text', 'sort_order' => 12],
            ['group' => 'contact', 'key' => 'contact_email_1', 'label' => 'البريد الأول', 'value' => 'logistics@homepack-manufacturing.com', 'type' => 'text', 'sort_order' => 13],
            ['group' => 'contact', 'key' => 'contact_email_2', 'label' => 'البريد الثاني', 'value' => 'quotes@homepack-manufacturing.com', 'type' => 'text', 'sort_order' => 14],
            ['group' => 'contact', 'key' => 'contact_map_image', 'label' => 'صورة الخريطة', 'value' => 'images/img_395e3911da0e2f4ca02f32cdb3289f07.jpg', 'type' => 'image', 'sort_order' => 15],
            ['group' => 'contact', 'key' => 'contact_map_label', 'label' => 'تسمية الخريطة', 'value' => 'المنشأة الرئيسية لهوم باك', 'type' => 'text', 'sort_order' => 16],
        ];

        foreach ($settings as $setting) {
            SiteSetting::query()->updateOrCreate(['key' => $setting['key']], $setting);
        }
    }

    private function seedPages(): void
    {
        $pages = [
            ['slug' => 'home', 'name' => 'الصفحة الرئيسية', 'title' => 'هوم باك | تصنيع صناعي', 'sort_order' => 1],
            ['slug' => 'about', 'name' => 'من نحن', 'title' => 'من نحن | شركة هوم باك للتصنيع', 'sort_order' => 2],
            ['slug' => 'contact', 'name' => 'اتصل بنا', 'title' => 'اتصل بنا | شركة هوم باك للتصنيع', 'sort_order' => 3],
            ['slug' => 'products', 'name' => 'المنتجات', 'title' => 'المنتجات | شركة هوم باك للتصنيع', 'sort_order' => 4],
            ['slug' => 'track', 'name' => 'تتبع الطلب', 'title' => 'تتبع الطلب | هوم باك', 'sort_order' => 5],
        ];

        foreach ($pages as $pageData) {
            Page::query()->updateOrCreate(['slug' => $pageData['slug']], $pageData);
        }

        $this->seedHomeSections();
        $this->seedAboutSections();
        $this->seedContactSections();
        $this->seedProductsSections();
        $this->seedTrackSections();
    }

    private function pageId(string $slug): int
    {
        return Page::query()->where('slug', $slug)->value('id');
    }

    private function seedHomeSections(): void
    {
        $pageId = $this->pageId('home');

        $sections = [
            [
                'key' => 'hero',
                'admin_label' => 'قسم البطل (Hero)',
                'title' => 'هوم باك: بيت صناعة الكرتون',
                'body' => 'حلول تغليف هندسية دقيقة للخدمات اللوجستية العالمية. نحن نجمع بين المتانة الهيكلية والتصنيع المستدام.',
                'image' => 'images/img_ad9cb2c626426a8cb26dc8df94888bd4.jpg',
                'extra' => ['video' => 'hero_video.mp4'],
                'button_text' => 'احصل على سعر',
                'button_url' => '/contact',
                'button_text_2' => 'منتجاتنا',
                'button_url_2' => '/products',
                'sort_order' => 1,
            ],
            [
                'key' => 'features',
                'admin_label' => 'المميزات (3 بطاقات)',
                'extra' => [
                    'items' => [
                        ['icon' => 'fitness_center', 'title' => 'المتانة', 'body' => 'مصمم بألياف كرتونية عالية الشد لتحمل أصعب ظروف الشحن والأحمال الصناعية الثقيلة.'],
                        ['icon' => 'eco', 'title' => 'صديق للبيئة', 'body' => 'مواد قابلة لإعادة التدوير بنسبة 100% مستمدة من غابات مدارة بشكل مستدام، مما يقلل من بصمتك الكربونية دون التضحية بالقوة.'],
                        ['icon' => 'local_shipping', 'title' => 'توصيل سريع', 'body' => 'شبكة لوجستية محسنة تضمن معالجة وتسليم طلبات التغليف المخصصة في أوقات قياسية.'],
                    ],
                ],
                'sort_order' => 2,
            ],
            [
                'key' => 'stats',
                'admin_label' => 'الإحصائيات (4 أرقام)',
                'extra' => [
                    'items' => [
                        ['value' => '25+', 'label' => 'سنة خبرة'],
                        ['value' => '500 ألف', 'label' => 'سعة إنتاج يومية'],
                        ['value' => '120+', 'label' => 'شريك لوجستي'],
                        ['value' => '100%', 'label' => 'قابل للتدوير'],
                    ],
                ],
                'sort_order' => 3,
            ],
            [
                'key' => 'products_preview',
                'admin_label' => 'معاينة المنتجات',
                'badge' => 'كتالوجنا',
                'title' => 'حلول تغليف دقيقة',
                'button_text' => 'عرض جميع المنتجات',
                'button_url' => '/products',
                'sort_order' => 4,
            ],
            [
                'key' => 'about_teaser',
                'admin_label' => 'تعريف مختصر بالشركة',
                'badge' => 'منذ 1984',
                'title' => 'قوة هندسية في كل طبقة',
                'body' => 'تعد هوم باك رائدة في تصنيع الكرتون المضلع عالي الأداء. نحن متخصصون في المتانة الهيكلية وحلول التغليف التي تمكن الصناعات من نقل العالم بثقة — من التصميم حتى التسليم.',
                'image' => 'images/img_b73b517e1c7804eefc5e4d0d9b735a96.jpg',
                'quote' => 'دقة في كل ليفة، متانة في كل صندوق.',
                'button_text' => 'قصة الشركة',
                'button_url' => '/about',
                'sort_order' => 5,
            ],
            [
                'key' => 'cta',
                'admin_label' => 'دعوة للإجراء (CTA)',
                'title' => 'جاهز لتحسين خدماتك اللوجستية؟',
                'body' => 'اتصل بفريقنا الهندسي اليوم للحصول على عرض سعر شامل للطلبات الكبيرة ومواصفات التصنيع المخصصة.',
                'button_text' => 'طلب اقتراح سعر',
                'button_url' => '/contact',
                'button_text_2' => 'اتصل بالمبيعات',
                'button_url_2' => '/contact',
                'sort_order' => 6,
            ],
        ];

        $this->upsertSections($pageId, $sections);
    }

    private function seedAboutSections(): void
    {
        $pageId = $this->pageId('about');

        $sections = [
            [
                'key' => 'intro',
                'admin_label' => 'المقدمة',
                'badge' => 'قيادة راسخة',
                'title' => 'قوة هندسية في كل طبقة.',
                'body' => 'تعد شركة هوم باك رائدة عالمية في تصنيع الكرتون المضلع عالي الأداء. نحن متخصصون في المتانة الهيكلية وحلول التغليف المعيارية التي تمكن الصناعات من نقل العالم بثقة.',
                'image' => 'images/img_b73b517e1c7804eefc5e4d0d9b735a96.jpg',
                'quote' => 'دقة في كل ليفة، متانة في كل صندوق.',
                'extra' => [
                    'items' => [
                        ['value' => '25+', 'label' => 'سنة خبرة'],
                        ['value' => '500 ألف', 'label' => 'سعة يومية'],
                    ],
                ],
                'sort_order' => 1,
            ],
            [
                'key' => 'quality',
                'admin_label' => 'معايير الجودة',
                'title' => 'معايير لا تهاون فيها',
                'extra' => [
                    'items' => [
                        ['icon' => 'verified', 'title' => 'شهادة الأيزو', 'body' => 'الالتزام بمعايير إدارة الجودة الدولية الصارمة (ISO 9001:2015) لضمان إنتاج ثابت وعالي الجودة لسلاسل التوريد العالمية.', 'footer' => 'تحقق عالمي'],
                        ['icon' => 'recycling', 'title' => 'قابلة لإعادة التدوير بنسبة 100%', 'body' => 'التزامنا بالاقتصاد الدائري يعني أن كل منتج مصمم من مصادر متجددة وقابل لإعادة التدوير بالكامل بعد دورة حياته.', 'footer' => 'هندسة بيئية'],
                        ['icon' => 'precision_manufacturing', 'title' => 'دقة هيكلية', 'body' => 'استخدام تكنولوجيا القطع بالليزر المتقدمة والتحكم في الرطوبة للحفاظ على أعلى مستويات سلامة الكرتون وقوة الانفجار في الصناعة.', 'footer' => 'ميزة تقنية'],
                    ],
                ],
                'sort_order' => 2,
            ],
            [
                'key' => 'vision',
                'admin_label' => 'الرؤية واللوجستيات',
                'title' => 'ربط الإنتاج المحلي بالخدمات اللوجستية العالمية.',
                'body' => 'تتمثل رؤيتنا فيما وراء أرضية التصنيع. لقد قمنا ببناء شبكة لوجستية تربط الحرفية المحلية بالطلب العالمي، مما يضمن حماية أصولك بواسطة هندسة هوم باك، سواء كنت تشحن عبر الشارع أو عبر المحيط.',
                'extra' => [
                    'items' => [
                        ['icon' => 'public', 'label' => 'توزيع عالمي'],
                        ['icon' => 'local_shipping', 'label' => 'شحن في اليوم التالي'],
                        ['icon' => 'inventory_2', 'label' => 'إدارة المخزون'],
                        ['icon' => 'hub', 'label' => 'سلسلة توريد متكاملة'],
                    ],
                    'images' => [
                        'images/img_b73b517e1c7804eefc5e4d0d9b735a96.jpg',
                        'images/img_54a3b3aa0d9070c7ac52b97a10d40f58.jpg',
                    ],
                ],
                'sort_order' => 3,
            ],
            [
                'key' => 'cta',
                'admin_label' => 'دعوة للإجراء',
                'title' => 'هل أنت جاهز لتقوية سلسلة التوريد الخاصة بك؟',
                'body' => 'استشر فريقنا الهندسي للحصول على تحليل هيكلي مخصص لاحتياجات التغليف الخاصة بك.',
                'button_text' => 'احجز استشارة',
                'button_url' => '/contact',
                'button_text_2' => 'عرض الكتالوج',
                'button_url_2' => '/products',
                'sort_order' => 4,
            ],
        ];

        $this->upsertSections($pageId, $sections);
    }

    private function seedContactSections(): void
    {
        $pageId = $this->pageId('contact');

        $sections = [
            [
                'key' => 'header',
                'admin_label' => 'عنوان الصفحة',
                'title' => 'تواصل مع قسم الهندسة',
                'body' => 'من تصميم النماذج الأولية المخصصة إلى التصنيع بكميات كبيرة، فرقنا اللوجستية والهندسية جاهزة لتأمين سلسلة التوريد الخاصة بك.',
                'sort_order' => 1,
            ],
            [
                'key' => 'form',
                'admin_label' => 'نموذج الاستفسار',
                'title' => 'نموذج استفسار عن طلب',
                'sort_order' => 2,
            ],
            [
                'key' => 'logistics',
                'admin_label' => 'قسم اللوجستيات',
                'title' => 'سعة اللوجستيات العالمية',
                'body' => 'من خلال استخدام شبكة مترابطة من مراكز التوزيع، نضمن السلامة الهيكلية من أرضنا إلى أبواب منشأتك، بغض النظر عن الوجهة العالمية.',
                'image' => 'images/img_b1dafdba32af254895df51ee440fd271.jpg',
                'extra' => [
                    'items' => [
                        ['value' => '48 ساعة', 'label' => 'وقت تنفيذ النموذج الأولي'],
                        ['value' => '120+', 'label' => 'شركاء عالميون'],
                    ],
                    'badge' => 'ISO 9001:2015<br/>معتمد',
                ],
                'sort_order' => 3,
            ],
        ];

        $this->upsertSections($pageId, $sections);
    }

    private function seedProductsSections(): void
    {
        $pageId = $this->pageId('products');

        $sections = [
            [
                'key' => 'hero',
                'admin_label' => 'رأس صفحة المنتجات',
                'title' => 'حلول تغليف هندسية دقيقة',
                'body' => 'كتالوج ديناميك — أي تعديل في لوحة الإدارة يظهر هنا فوراً.',
                'sort_order' => 1,
            ],
        ];

        $this->upsertSections($pageId, $sections);
    }

    private function seedTrackSections(): void
    {
        $pageId = $this->pageId('track');

        $sections = [
            [
                'key' => 'header',
                'admin_label' => 'عنوان صفحة التتبع',
                'badge' => 'تتبع الطلب',
                'title' => 'تابع حالة طلبك',
                'body' => 'أدخل رمز التتبع الذي استلمته بعد إرسال نموذج الاستفسار لمتابعة مراحل معالجة طلبك.',
                'sort_order' => 1,
            ],
            [
                'key' => 'help',
                'admin_label' => 'مساعدة التتبع',
                'title' => 'أين أجد رمز التتبع؟',
                'body' => 'يظهر الرمز مباشرة بعد إرسال نموذج الاستفسار في صفحة اتصل بنا. يبدأ الرمز بـ HP- متبوعاً بـ 8 أحرف.',
                'sort_order' => 2,
            ],
        ];

        $this->upsertSections($pageId, $sections);
    }

    /** @param array<int, array<string, mixed>> $sections */
    private function upsertSections(int $pageId, array $sections): void
    {
        foreach ($sections as $section) {
            PageSection::query()->updateOrCreate(
                ['page_id' => $pageId, 'key' => $section['key']],
                array_merge($section, ['page_id' => $pageId, 'is_active' => true]),
            );
        }
    }
}
