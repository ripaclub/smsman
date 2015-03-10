<?php
namespace SmsMan\Sender;

/**
 * Trait SenderAwareTrait
 */
trait SenderAwareTrait
{
    /**
     * @var SenderInterface|null
     */
    protected $sender;

    /**
     * @return SenderInterface|null
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @param SenderInterface $sender
     */
    public function setSender(SenderInterface $sender)
    {
        $this->sender = $sender;
    }
} 