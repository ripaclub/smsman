<?php
namespace SmsMan;

/**
 * Interface AliasInterface
 */
interface AliasInterface
{
    /**
     * @return string
     */
    public function getAlias();

    /**
     * @param $alias
     * @return $this
     */
    public function setAlias($alias);
}
