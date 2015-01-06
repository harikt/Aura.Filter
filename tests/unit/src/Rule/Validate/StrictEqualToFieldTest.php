<?php
namespace Aura\Filter\Rule\Validate;

class StrictEqualToFieldTest extends AbstractValidateTest
{
    protected $other_field = 'other';

    protected $other_value = '1';

    protected function getObject($value)
    {
        $object = parent::getObject($value);
        $object->{$this->other_field} = $this->other_value;
        return $object;
    }

    protected function getArgs()
    {
        $args = parent::getArgs();
        $args[] = 'other';
        return $args;
    }

    public function providerIs()
    {
        return array(
            array('1'),
        );
    }

    public function providerIsNot()
    {
        return array(
            array(1),
            array(true),
            array(1.00),
        );
    }

    public function testIs_fieldNotSet()
    {
        $object = (object) array('foo' => '1');
        $rule = new StrictEqualToField();
        $this->assertFalse($rule->__invoke($object, 'foo', 'no_such_field'));
    }
}