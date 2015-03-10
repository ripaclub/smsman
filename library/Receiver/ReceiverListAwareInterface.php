<?php
namespace SmsMan\Receiver;

/**
 * Interface ReceiverListAwareTrait
 */
interface ReceiverListAwareInterface
{
    /**
     * @return ReceiverListInterface|null
     */
    public function getReceiverList();

    /**
     * @param ReceiverListInterface $receiverList
     * @return $this
     */
    public function setReceiverList(ReceiverListInterface $receiverList);
}
