<?php

namespace NOUserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class NOUserBundle extends Bundle
{
	public function getParent(){
		return 'FOSUserBundle';
	}
}
