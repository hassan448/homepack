<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    public const STATUSES = ['new', 'review', 'quoted', 'confirmed'];

    protected $fillable = [
        'customer_name',
        'email',
        'phone',
        'dimensions',
        'quantity',
        'cardboard_type',
        'printing_type',
        'notes',
        'status',
        'tracking_code',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Order $order): void {
            if (empty($order->tracking_code)) {
                $order->tracking_code = static::generateTrackingCode();
            }

            if (empty($order->status)) {
                $order->status = 'new';
            }
        });
    }

    public static function generateTrackingCode(): string
    {
        do {
            $code = 'HP-'.strtoupper(Str::random(8));
        } while (static::query()->where('tracking_code', $code)->exists());

        return $code;
    }

    public static function statusLabel(string $status): string
    {
        return match ($status) {
            'new' => 'جديد',
            'review' => 'قيد المراجعة',
            'quoted' => 'عرض سعر مُرسل',
            'confirmed' => 'مؤكد',
            'cancelled' => 'ملغي',
            default => $status,
        };
    }

    public static function statusDescription(string $status): string
    {
        return match ($status) {
            'new' => 'تم استلام طلبك وسيتم مراجعته قريباً.',
            'review' => 'فريق الهندسة يراجع مواصفات الطلب.',
            'quoted' => 'تم إرسال عرض السعر إلى بريدك الإلكتروني.',
            'confirmed' => 'تم تأكيد الطلب وجاري التحضير للتصنيع.',
            'cancelled' => 'تم إلغاء هذا الطلب.',
            default => '',
        };
    }

    public static function statusIcon(string $status): string
    {
        return match ($status) {
            'new' => 'inbox',
            'review' => 'engineering',
            'quoted' => 'request_quote',
            'confirmed' => 'check_circle',
            'cancelled' => 'cancel',
            default => 'help',
        };
    }

    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    /**
     * @return array<int, array{key: string, label: string, description: string, icon: string, state: string}>
     */
    public function timeline(): array
    {
        if ($this->isCancelled()) {
            return [
                [
                    'key' => 'cancelled',
                    'label' => self::statusLabel('cancelled'),
                    'description' => self::statusDescription('cancelled'),
                    'icon' => self::statusIcon('cancelled'),
                    'state' => 'cancelled',
                ],
            ];
        }

        $currentIndex = array_search($this->status, self::STATUSES, true);
        $currentIndex = $currentIndex === false ? 0 : $currentIndex;

        return collect(self::STATUSES)->map(function (string $status, int $index) use ($currentIndex) {
            $state = match (true) {
                $index < $currentIndex => 'completed',
                $index === $currentIndex => 'current',
                default => 'upcoming',
            };

            return [
                'key' => $status,
                'label' => self::statusLabel($status),
                'description' => self::statusDescription($status),
                'icon' => self::statusIcon($status),
                'state' => $state,
            ];
        })->all();
    }

    public function cardboardTypeLabel(): ?string
    {
        return match ($this->cardboard_type) {
            'single' => 'طبقة واحدة',
            'double' => 'طبقتان (BC Flute)',
            'triple' => 'ثلاث طبقات',
            default => $this->cardboard_type,
        };
    }

    public function printingTypeLabel(): ?string
    {
        return match ($this->printing_type) {
            'none' => 'بدون طباعة',
            'flexo' => 'فليكسو',
            'offset' => 'أوفست',
            'digital' => 'رقمية',
            default => $this->printing_type,
        };
    }
}

