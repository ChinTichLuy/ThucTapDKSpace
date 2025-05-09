<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NoProfanity implements ValidationRule
{
    protected array $badWords = ['fuck', 'fuk', 'shiet', 'shit', 'damn', 'nigga', 'nigger'];
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        foreach ($this->badWords as $word) {
            if (stripos($value, $word) !== false) {
            // Hàm stripos() tìm vị trí xuất hiện của từ $word trong chuỗi $value (không phân biệt hoa thường)
                $fail("Mô tả chứa từ ngữ không phù hợp: '{$word}'");
                // Gọi callback $fail để thông báo lỗi, và hiển thị từ bị phát hiện
                return;
            }
        }
    }
}
