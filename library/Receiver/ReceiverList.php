<?php
namespace SmsMan\Receiver;

use SmsMan\AbstractList;

/**
 * Class ReceiverList
 */
class ReceiverList extends AbstractList implements ReceiverListInterface
{
    /**
     * @param ReceiverInterface $receiver
     * @return $this
     */
    public function add(ReceiverInterface $receiver)
    {
        if ($this->has($receiver)) {
            // TODO exception
        }
        $this->list[$receiver->getCellPhone()] = $receiver;
    }

    /**
     * @param ReceiverInterface $receiver
     * @return $this
     */
    public function remove(ReceiverInterface $receiver)
    {
        if ($this->has($receiver)) {
            unset($this->list[$receiver->getCellPhone()]);
        }
        return $this;
    }

    /**
     * @param ReceiverInterface $receiver
     * @return bool
     */
    public function has(ReceiverInterface $receiver)
    {
        if (array_key_exists($receiver->getCellPhone(), $this->list)) {
            return true;
        }
        return false;
    }


}
