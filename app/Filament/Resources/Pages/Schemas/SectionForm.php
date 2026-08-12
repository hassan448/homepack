<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SectionForm
{
    /** @return array<int, \Filament\Schemas\Components\Component> */
    public static function fields(): array
    {
        return [
            Section::make('معلومات القسم')
                    ->schema([
                        TextInput::make('admin_label')
                            ->label('اسم القسم في الدashboard')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('key')
                            ->label('المعرّف (key)')
                            ->required()
                            ->maxLength(100)
                            ->helperText('مثال: hero, stats, cta — لا تغيّره إلا إذا كنت تعرف ما تفعل'),
                        TextInput::make('badge')
                            ->label('شارة صغيرة')
                            ->maxLength(255),
                        TextInput::make('title')
                            ->label('العنوان')
                            ->maxLength(255)
                            ->columnSpanFull(),
                        TextInput::make('subtitle')
                            ->label('العنوان الفرعي')
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Textarea::make('body')
                            ->label('النص / الوصف')
                            ->rows(4)
                            ->columnSpanFull(),
                        TextInput::make('quote')
                            ->label('اقتباس')
                            ->maxLength(500)
                            ->columnSpanFull(),
                        FileUpload::make('image')
                            ->label('صورة الغلاف (Poster)')
                            ->image()
                            ->disk('public')
                            ->directory('sections')
                            ->visibility('public')
                            ->helperText('تُعرض قبل تحميل الفيديو أو كخلفية ثابتة')
                            ->columnSpanFull(),
                        TextInput::make('icon')
                            ->label('أيقونة Material')
                            ->maxLength(100)
                            ->helperText('مثال: verified, local_shipping'),
                    ])
                    ->columns(2),
                Section::make('فيديو Hero')
                    ->schema([
                        FileUpload::make('extra.video')
                            ->label('فيديو الخلفية')
                            ->acceptedFileTypes(['video/mp4', 'video/webm'])
                            ->disk('public')
                            ->directory('sections/videos')
                            ->visibility('public')
                            ->maxSize(51200)
                            ->helperText('MP4 أو WebM — يُستخدم في قسم Hero بالصفحة الرئيسية. اتركه فارغاً لاستخدام الفيديو الافتراضي.'),
                    ])
                    ->collapsed(),
                Section::make('الأزرار')
                    ->schema([
                        TextInput::make('button_text')
                            ->label('نص الزر الأول')
                            ->maxLength(255),
                        TextInput::make('button_url')
                            ->label('رابط الزر الأول')
                            ->maxLength(255)
                            ->helperText('مثال: /contact أو /products'),
                        TextInput::make('button_text_2')
                            ->label('نص الزر الثاني')
                            ->maxLength(255),
                        TextInput::make('button_url_2')
                            ->label('رابط الزر الثاني')
                            ->maxLength(255),
                    ])
                    ->columns(2)
                    ->collapsed(),
                Section::make('عناصر القائمة (بطاقات / إحصائيات / نقاط)')
                    ->schema([
                        Repeater::make('extra.items')
                            ->label('العناصر')
                            ->schema([
                                TextInput::make('value')
                                    ->label('قيمة / رقم'),
                                TextInput::make('label')
                                    ->label('تسمية'),
                                TextInput::make('title')
                                    ->label('عنوان'),
                                Textarea::make('body')
                                    ->label('نص')
                                    ->rows(2),
                                TextInput::make('icon')
                                    ->label('أيقونة'),
                                TextInput::make('footer')
                                    ->label('تذييل البطاقة'),
                            ])
                            ->columns(2)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? $state['label'] ?? $state['value'] ?? 'عنصر'),
                    ])
                    ->collapsed(),
                Section::make('إعدادات')
                    ->schema([
                        TextInput::make('sort_order')
                            ->label('الترتيب')
                            ->numeric()
                            ->default(0),
                        Toggle::make('is_active')
                            ->label('نشط')
                            ->default(true)
                            ->helperText('عند التعطيل: القسم يختفي من الصفحة'),
                    ])
                    ->columns(2),
            ];
    }

    public static function configure(Schema $schema): Schema
    {
        return $schema->components(self::fields());
    }
}
