<?php
namespace SmsMan\Receiver;

use SmsMan\AbstractInterface;

/**
 * Interface ReceiverListInterface
 */
interface ReceiverListInterface extends AbstractInterface
{
    /**
     * @param ReceiverInterface $receiver
     * @return $this
     */
    public function add(ReceiverInterface $receiver);

    /**
     * @param ReceiverInterface $receiver
     * @return $this
     */
    public function remove(ReceiverInterface $receiver);

    /**
     * @param ReceiverInterface $receiver
     * @return bool
     */
    public function has(ReceiverInterface $receiver);
}
