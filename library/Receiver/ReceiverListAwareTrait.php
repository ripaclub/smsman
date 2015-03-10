<?php
namespace SmsMan\Receiver;

/**
 * Trait ReceiverListAwareTrait
 */
trait ReceiverListAwareTrait
{
    /**
     * @var ReceiverListInterface|null
     */
    protected $receiverList;

    /**
     * @return ReceiverInterface|null
     */
    public function getReceiverList()
    {
        return $this->receiverList;
    }

    /**
     * @param ReceiverListInterface $receiverList
     * @return $this
     */
    public function setReceiverList(ReceiverListInterface $receiverList)
    {
        $this->receiverList = $receiverList;
        return $this;
    }
}
