<?php
namespace SmsMan\Receiver;

use SmsMan\AbstractList;
use SmsMan\Exception\InvalidArgumentException;

/**
 * Class ReceiverList
 */
class ReceiverList extends AbstractList implements ReceiverListInterface
{
    function __construct(array $list = [])
    {
        foreach ($list as $item) {
            if ($item instanceof ReceiverInterface) {
                $this->add($item);
            } else {
                throw new InvalidArgumentException(
                    sprintf(
                        'Item in the list must be a instance of %s given %',
                        'SmsMan\Receiver\ReceiverInterface',
                        is_object($item) ? get_class($item) : gettype($item)
                    )
                );
            }
        }
    }

    /**
     * @param ReceiverInterface $receiver
     * @return $this
     */
    public function add(ReceiverInterface $receiver)
    {
        if ($this->has($receiver)) {
            throw new InvalidArgumentException('Item already exist' );
        }
        $this->list[$receiver->getCellPhone()] = $receiver;
        return $this;
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
        if ($this->checkReceiver($receiver) && array_key_exists($receiver->getCellPhone(), $this->list)) {
            return true;
        }
        return false;
    }

    protected function checkReceiver(ReceiverInterface $receiver)
    {
        if (!$receiver->getCellPhone()) {
            throw new InvalidArgumentException('Receiver cellNumber must be set' );
        }
        return true;
    }
}
