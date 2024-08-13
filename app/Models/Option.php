<?php

namespace App\Models;

use App\Enums\OptionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value', 'type'];

    protected function casts(): array
    {
        return [
            'type' => OptionType::class,
        ];
    }

    public function getValueAttribute($value)
    {
        return match ($this->type) {
            OptionType::INTEGER => (int) $value,
            OptionType::BOOLEAN => filter_var($value, FILTER_VALIDATE_BOOLEAN),
            OptionType::ARRAY => json_decode($value, true),
            default => $value,
        };
    }

    public function setValueAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['value'] = json_encode($value);
        } else {
            $this->attributes['value'] = $value;
        }
    }

    // options

    public static function supportNumber(): ?self
    {
        return self::where('key', 'support_number')->first();
    }

    public static function setSupportNumber(string $value)
    {
        $option = self::firstOrCreate(
            ['key' => 'support_number'],
            ['type' => OptionType::STRING]
        );
        $option->value = $value;
        $option->save();
    }

    public static function newsFlashes(): ?self
    {
        return self::where('key', 'news_flashs')->first();
    }

    public static function setNewsFlashes(array $value)
    {
        $option = self::firstOrCreate(
            ['key' => 'news_flashs'],
            ['type' => OptionType::ARRAY]
        );

        $option->value = $value;
        $option->save();
    }

    public static function addNewsFlash(string $message)
    {
        self::setnewsFlashes([
            ...(self::newsFlashes()?->value ?? []),
            $message,
        ]);
    }

    public static function heroSliders(): ?self
    {
        return self::where('key', 'hero_sliders')->first();
    }

    public static function setHeroSliders(array $value)
    {
        $option = self::firstOrCreate(
            ['key' => 'hero_sliders'],
            ['type' => OptionType::ARRAY]
        );

        $option->value = $value;
        $option->save();
    }

    public static function addHeroSlider(string $heading1, string $heading2, string $subheading, string $image)
    {
        self::setHeroSliders([
            ...(self::heroSliders()?->value ?? []),
            [
                'heading1' => $heading1,
                'heading2' => $heading2,
                'subheading' => $subheading,
                'image' => $image,
            ],
        ]);
    }
}
