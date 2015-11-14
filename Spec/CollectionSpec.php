<?php

namespace Spec\Moltin\Collection;

use Moltin\Collection\Collection;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CollectionSpec extends ObjectBehavior
{
    private $dummyClass = 'Spec\Moltin\Collection\Dummy';

    public function let()
    {
        $this->beAnInstanceOf('Spec\Moltin\Collection\DummyCollection');
    }

    public function it_is_initializable()
    {
        $this->beConstructedWith($this->dummyClass);
        $this->shouldHaveType('Spec\Moltin\Collection\DummyCollection');
    }

    public function it_throws_an_exception_if_class_type_does_not_exist()
    {
        $this->shouldThrow('\InvalidArgumentException')
            ->during('__construct', ['Invalid']);
    }

}


class DummyCollection extends Collection {}

class Dummy {}