<?php
namespace SmsMan;

use SmsMan\Exception\InvalidArgumentException;
use Traversable;

/**
 * Class AbstractOptionsConstruct
 */
trait OptionsConstructTrait
{
    /**
     * @param array $options
     */
    public function __construct($options = array())
    {
        $this->setOptions($options);
    }

    /**
     * @param  array|Traversable $options
     * @throws Exception\InvalidArgumentException
     * @return $this
     */
    public function setOptions($options = array())
    {
        if (!is_array($options) && !$options instanceof Traversable) {
            throw new InvalidArgumentException(__METHOD__ . ' expects an array or Traversable');
        }

        foreach ($options as $name => $option) {
            $setterMethod = 'set' . ucfirst($name);
            $isMethod = 'is' . ucfirst($name);
            if (($name != 'setOptions') && method_exists($this, $name)) {
                $this->{$name}($option);
            } elseif (($setterMethod != 'setOptions') && method_exists($this, $setterMethod)) {
                $this->{$setterMethod}($option);
            } elseif (method_exists($this, $isMethod)) {
                $this->{$isMethod}($option);
            }
        }

        return $this;
    }

} 