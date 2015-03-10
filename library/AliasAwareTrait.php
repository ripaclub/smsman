<?php
namespace SmsMan;

/**
 * Trait AliasAwareTrait
 */
trait AliasAwareTrait
{
    /**
     * @var string
     */
    protected $alias;

    /**
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param string $alias
     * @return $this
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
        return $this;
    }
} 