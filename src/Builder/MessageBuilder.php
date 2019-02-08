<?php

/*
 * (c) Thomas Boileau <t-boileau@email.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TBoileau\Bundle\EmailBundle\Builder;

/**
 * Class MessageBuilder
 *
 * A builder to set message options like body, subject...
 *
 * @package TBoileau\Bundle\EmailBundle\Builder
 * @author Thomas Boileau <t-boileau@email.com>
 * @method MessageBuilderInterface addPart(string|\Swift_OutputByteStream $body, ?string $contentType = null, ?string $charset = null)
 * @method MessageBuilderInterface attachSigner(\Swift_Signer $signer)
 * @method MessageBuilderInterface detachSigner(\Swift_Signer $signer)
 * @method MessageBuilderInterface clearSigners()
 * @method MessageBuilderInterface setSubject(string $subject)
 * @method string getSubject()
 * @method MessageBuilderInterface setDate(\DateTimeInterface $dateTime)
 * @method getDate()\DateTimeInterface
 * @method MessageBuilderInterface setReturnPath(string $address)
 * @method string getReturnPath()
 * @method MessageBuilderInterface setSender(string $address, ?string $name = null)
 * @method string getSender()
 * @method MessageBuilderInterface addFrom(string $address, ?string $name = null)
 * @method MessageBuilderInterface setFrom(array|string $addresses, ?string $name = null)
 * @method mixed getFrom()
 * @method MessageBuilderInterface addReplyTo(string $address, ?string $name = null)
 * @method MessageBuilderInterface setReplyTo(array|string $addresses, ?string $name = null)
 * @method string getReplyTo()
 * @method MessageBuilderInterface addTo(string $address, ?string $name = null)
 * @method MessageBuilderInterface setTo(array|string $addresses, ?string $name = null)
 * @method array getTo()
 * @method MessageBuilderInterface addCc(string $address, ?string $name = null)
 * @method MessageBuilderInterface setCc(array|string $addresses, ?string $name = null)
 * @method array getCc()
 * @method MessageBuilderInterface addBcc(string $address, ?string $name = null)
 * @method MessageBuilderInterface setBcc(array|string $addresses, ?string $name = null)
 * @method array getBcc()
 * @method MessageBuilderInterface setPriority(int $priority)
 * @method int getPriority()
 * @method MessageBuilderInterface setReadReceiptTo(array $addresses)
 * @method string getReadReceiptTo()
 * @method MessageBuilderInterface attach(\Swift_Mime_SimpleMimeEntity $entity)
 * @method MessageBuilderInterface detach(\Swift_Mime_SimpleMimeEntity $entity)
 * @method MessageBuilderInterface embed(\Swift_Mime_SimpleMimeEntity $entity)
 * @method string toString()
 * @method toByteStream(\Swift_InputByteStream $is)
 * @method string getIdField()
 * @method MessageBuilderInterface setBody(mixed $body, ?string $contentType = null, ?string $charset = null)
 * @method string getCharset()
 * @method MessageBuilderInterface setCharset(string $charset)
 * @method string getFormat()
 * @method MessageBuilderInterface setFormat(string $format)
 * @method bool getDelSp()
 * @method MessageBuilderInterface setDelSp(?bool $delsp = true)
 * @method int getNestingLevel()
 * @method charsetChanged(string $charset)
 * @method fixHeaders()
 * @method setNestingLevel(int $level)
 * @method string convertString(string $string)
 * @method string generateId()
 * @method getHeaders()\Swift_Mime_SimpleHeaderSet
 * @method int getContentType()
 * @method string getBodyContentType()
 * @method MessageBuilderInterface setContentType(string $type)
 * @method string getId()
 * @method MessageBuilderInterface setId(string $id)
 * @method string getDescription()
 * @method MessageBuilderInterface setDescription(string $description)
 * @method int getMaxLineLength()
 * @method MessageBuilderInterface setMaxLineLength(int $length)
 * @method getChildren()\Swift_Mime_SimpleMimeEntity[]
 * @method MessageBuilderInterface setChildren(array $children, ?int $compoundLevel = null)
 * @method string getBody()
 * @method getEncoder()\Swift_Mime_ContentEncoder
 * @method MessageBuilderInterface setEncoder(\Swift_Mime_ContentEncoder $encoder)
 * @method string getBoundary()
 * @method MessageBuilderInterface setBoundary(string $boundary)
 * @method MessageBuilderInterface encoderChanged(\Swift_Mime_ContentEncoder $encoder)
 * @method string bodyToString()
 * @method bodyToByteStream(\Swift_InputByteStream $is)
 * @method mixed getHeaderFieldModel($field)
 * @method bool setHeaderFieldModel($field, $model)
 * @method getHeaderParameter($field, $parameter)\Swift_Mime_Header
 * @method MessageBuilderInterface setHeaderParameter($field, $parameter, $value)
 * @method getCache()\Swift_KeyCache
 * @method getIdGenerator()\Swift_IdGenerator
 * @method clearCache()
 * @method string readStream(\Swift_OutputByteStream $os)
 * @method setEncoding($encoding)
 * @method assertValidBoundary(string $boundary)
 * @method setContentTypeInHeaders($type)
 * @method int getCompoundLevel($children)
 * @method mixed getNeededChildLevel($child, $compoundLevel)
 * @method MessageBuilderInterface createChild()
 * @method notifyEncoderChanged(\Swift_Mime_ContentEncoder $encoder)
 * @method notifyCharsetChanged(string $charset)
 * @method sortChildren()
 */
class MessageBuilder implements MessageBuilderInterface
{
    /**
     * @var \Swift_Message
     */
    private $message;

    /**
     * MessageBuilder constructor.
     */
    public function __construct()
    {
        $this->message = new \Swift_Message();
    }

    /**
     * @inheritdoc
     */
    public function __call(string $name, $arguments)
    {
        if (method_exists($this->message, $name)) {
            return call_user_func_array([$this->message, $name], $arguments);
        }

        throw new \BadMethodCallException(sprintf("The method '%s' not found.", $name));
    }

    /**
     * @inheritdoc
     */
    public function getMessage(): \Swift_Message
    {
        return $this->message;
    }
}
