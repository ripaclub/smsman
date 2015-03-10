<?php
namespace SmsMan\Adapter;

/**
 * Class AdapterAwareTrait
 *
 *
 * @package SmsMan\Adapter
 */
trait AdapterAwareTrait
{
    /**
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * @return AdapterInterface|null
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * @param AdapterInterface $adapter
     * @return $this
     */
    public function setAdapter(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
        return $this;
    }
} 