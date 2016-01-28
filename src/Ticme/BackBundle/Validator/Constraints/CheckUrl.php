<?php

namespace Ticme\BackBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class CheckUrl extends Constraint {

    public $message = 'Le champs contient des liens nons valides';

    public function validatedBy()
    {
        return 'validatorCheckUrl';
    }


}