<?php

namespace App\Policies;

use App\Models\User;
use Spatie\Csp\Directive;
use Spatie\Csp\Keyword;
use Spatie\Csp\Policies\Basic;

class CSPCustomPolicy extends Basic
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        parent::configure();
        $this->addDirective(Directive::SCRIPT, Keyword::UNSAFE_INLINE);
    }
}
