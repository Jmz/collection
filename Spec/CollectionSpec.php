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

    public function it_is_initializable()
    {
        $this->beConstructedWith('Spec\Moltin\Collection\Dummy');
        $this->shouldHaveType('Spec\Moltin\Collection\DummyCollection');
    }

    public function it_should_accept_an_interface_as_type()
    {
        $this->beConstructedWith('Spec\Moltin\Collection\DummyInterface');
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