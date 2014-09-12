<?php

namespace Book\View\Helper;

use Zend\View\Helper\AbstractHelper;

class DisplayCurrentDate extends AbstractHelper {

    public function __invoke() {
        return date('d.m.Y');
    }

}