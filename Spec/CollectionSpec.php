<?php

namespace Spec\Moltin\Collection;

use Moltin\Collection\Collection;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CollectionSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beAnInstanceOf('Spec\Moltin\Collection\DummyCollection');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Spec\Moltin\Collection\DummyCollection');
    }
}


class DummyCollection extends Collection {}