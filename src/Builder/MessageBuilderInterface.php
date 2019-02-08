<?php

/*
 * (c) Thomas Boileau <t-boileau@email.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TBoileau\Bundle\EmailBundle\Builder;

/**
 * Interface MessageBuilderInterface
 *
 * @package TBoileau\Bundle\EmailBundle\Builder
 * @author Thomas Boileau <t-boileau@email.com>
 * @method \Swift_Message addPart(string|\Swift_OutputByteStream $body, ?string $contentType = null, ?string $charset = null)
 * @method \Swift_Message attachSigner(\Swift_Signer $signer)
 * @method \Swift_Message detachSigner(\Swift_Signer $signer)
 * @method \Swift_Message clearSigners()
 * @method \Swift_Message setSubject(string $subject)
 * @method string getSubject()
 * @method \Swift_Message setDate(\DateTimeInterface $dateTime)
 * @method getDate()\DateTimeInterface
 * @method \Swift_Message setReturnPath(string $address)
 * @method string getReturnPath()
 * @method \Swift_Message setSender(string $address, ?string $name = null)
 * @method string getSender()
 * @method \Swift_Message addFrom(string $address, ?string $name = null)
 * @method \Swift_Message setFrom(array|string $addresses, ?string $name = null)
 * @method mixed getFrom()
 * @method \Swift_Message addReplyTo(string $address, ?string $name = null)
 * @method \Swift_Message setReplyTo(array|string $addresses, ?string $name = null)
 * @method string getReplyTo()
 * @method \Swift_Message addTo(string $address, ?string $name = null)
 * @method \Swift_Message setTo(array|string $addresses, ?string $name = null)
 * @method array getTo()
 * @method \Swift_Message addCc(string $address, ?string $name = null)
 * @method \Swift_Message setCc(array|string $addresses, ?string $name = null)
 * @method array getCc()
 * @method \Swift_Message addBcc(string $address, ?string $name = null)
 * @method \Swift_Message setBcc(array|string $addresses, ?string $name = null)
 * @method array getBcc()
 * @method \Swift_Message setPriority(int $priority)
 * @method int getPriority()
 * @method \Swift_Message setReadReceiptTo(array $addresses)
 * @method string getReadReceiptTo()
 * @method \Swift_Message attach(\Swift_Mime_SimpleMimeEntity $entity)
 * @method \Swift_Message detach(\Swift_Mime_SimpleMimeEntity $entity)
 * @method \Swift_Message embed(\Swift_Mime_SimpleMimeEntity $entity)
 * @method string toString()
 * @method toByteStream(\Swift_InputByteStream $is)
 * @method string getIdField()
 * @method \Swift_Message setBody(mixed $body, ?string $contentType = null, ?string $charset = null)
 * @method string getCharset()
 * @method \Swift_Message setCharset(string $charset)
 * @method string getFormat()
 * @method \Swift_Message setFormat(string $format)
 * @method bool getDelSp()
 * @method \Swift_Message setDelSp(?bool $delsp = true)
 * @method int getNestingLevel()
 * @method charsetChanged(string $charset)
 * @method fixHeaders()
 * @method setNestingLevel(int $level)
 * @method string convertString(string $string)
 * @method string generateId()
 * @method getHeaders()\Swift_Mime_SimpleHeaderSet
 * @method int getContentType()
 * @method string getBodyContentType()
 * @method \Swift_Message setContentType(string $type)
 * @method string getId()
 * @method \Swift_Message setId(string $id)
 * @method string getDescription()
 * @method \Swift_Message setDescription(string $description)
 * @method int getMaxLineLength()
 * @method \Swift_Message setMaxLineLength(int $length)
 * @method getChildren()\Swift_Mime_SimpleMimeEntity[]
 * @method \Swift_Message setChildren(array $children, ?int $compoundLevel = null)
 * @method string getBody()
 * @method getEncoder()\Swift_Mime_ContentEncoder
 * @method \Swift_Message setEncoder(\Swift_Mime_ContentEncoder $encoder)
 * @method string getBoundary()
 * @method \Swift_Message setBoundary(string $boundary)
 * @method \Swift_Message encoderChanged(\Swift_Mime_ContentEncoder $encoder)
 * @method string bodyToString()
 * @method bodyToByteStream(\Swift_InputByteStream $is)
 * @method mixed getHeaderFieldModel($field)
 * @method bool setHeaderFieldModel($field, $model)
 * @method getHeaderParameter($field, $parameter)\Swift_Mime_Header
 * @method \Swift_Message setHeaderParameter($field, $parameter, $value)
 * @method getCache()\Swift_KeyCache
 * @method getIdGenerator()\Swift_IdGenerator
 * @method clearCache()
 * @method string readStream(\Swift_OutputByteStream $os)
 * @method setEncoding($encoding)
 * @method assertValidBoundary(string $boundary)
 * @method setContentTypeInHeaders($type)
 * @method int getCompoundLevel($children)
 * @method mixed getNeededChildLevel($child, $compoundLevel)
 * @method \Swift_Message createChild()
 * @method notifyEncoderChanged(\Swift_Mime_ContentEncoder $encoder)
 * @method notifyCharsetChanged(string $charset)
 * @method sortChildren()
 */
interface MessageBuilderInterface
{
    /**
     * @param string $name
     * @param array $arguments
     */
    public function __call(string $name, $arguments);

    /**
     * Retrieve SwiftMessage
     *
     * @return \Swift_Message
     */
    public function getMessage(): \Swift_Message;
}
