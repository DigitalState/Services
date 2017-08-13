<?php

namespace Ds\Component\Bpm\Model;

use stdClass;

/**
 * Class Variable
 */
class Variable implements Model
{
    use Attribute\Name;
    use Attribute\Value;
    use Attribute\Type;
    use Attribute\Meta;

    /**
     * @const string
     */
    const TYPE_STRING = 'string';
    const TYPE_JSON = 'json';

    /**
     * Constructor
     *
     * @param string $name
     * @param mixed $value
     * @param string $type
     * @param \stdClass $meta
     */
    public function __construct($name, $value, $type = self::TYPE_STRING, stdClass $meta = null)
    {
        $this
            ->setName($name)
            ->setValue($value)
            ->setType($type)
            ->setMeta($meta);
    }

    /**
     * Cast to object
     *
     * @param boolean $minimal
     * @return \stdClass
     */
    public function toObject($minimal = false)
    {
        $object = new stdClass;

        if (!$minimal) {
            $object->name = $this->getName();
        }

        $object->value = $this->getValue();
        $object->type = $this->getType();
        $object->meta = $this->getMeta();

        return $object;
    }
}
