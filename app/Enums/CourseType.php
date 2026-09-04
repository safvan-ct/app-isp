<?php
namespace App\Enums;

enum CourseType: string {
    case BEGINNER     = 'beginner';
    case INTERMEDIATE = 'intermediate';
    case ADVANCED     = 'advanced';
    case OTHER        = 'other';

    public function label(): string
    {
        return match ($this) {
            self::BEGINNER     => 'Beginner',
            self::INTERMEDIATE => 'Intermediate',
            self::ADVANCED     => 'Advanced',
            self::OTHER        => 'Other',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
