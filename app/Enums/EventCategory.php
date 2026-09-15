<?php

namespace App\Enums;

enum EventCategory: string
{
    case PUBLIC = 'public';
    case MAHASISWA = 'mahasiswa';

    public function label(): string
    {
        return match ($this) {
            self::PUBLIC => 'Umum (Public)',
            self::MAHASISWA => 'Khusus Mahasiswa',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
