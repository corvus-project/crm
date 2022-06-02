<?php
namespace App\Models;

enum OrderStatus: int{
    case DRAFT = 2;
    case PENDING = 0;
    case APPROVED = 1;


    public function label(): string {
        return static::getLabel($this);
    }

    public static function getLabel(self $value): string {
        return match ($value) {
            OrderStatus::DRAFT => 'DRAFT',
            OrderStatus::PENDING => 'PENDING',
            OrderStatus::APPROVED => 'PAPPROVED',
        };
    }
}