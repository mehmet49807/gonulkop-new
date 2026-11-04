<?php

namespace App;

enum Gender: string
{
    case Male = 'male';
    case Female = 'female';

    /**
     * Get the gender that must not be visible to the current user.
     */
    public function opposite(): self
    {
        return match ($this) {
            self::Male => self::Female,
            self::Female => self::Male,
        };
    }
}
