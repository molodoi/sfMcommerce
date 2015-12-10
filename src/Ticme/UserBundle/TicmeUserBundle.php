<?php

namespace Ticme\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class TicmeUserBundle extends Bundle
{
    public function getParent(){
        return 'FOSUserBundle';
    }

}
