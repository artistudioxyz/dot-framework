<?php

namespace Dot\WordPress;

!defined('WPINC ') or die();

/**
 * Abstract class for WordPress model
 *
 * @package    Dot
 * @subpackage Dot\Includes\WordPress
 */

class Email
{
	/**
	 * @access   protected
	 * @var      string|array    $to    Array or comma-separated list of email addresses to send message
	 */
	protected $to;

	/**
	 * @access   protected
	 * @var      string         $subject    Email subject
	 */
	protected $subject;

	/**
	 * @access   protected
	 * @var      string    $message    Message contents
	 */
	protected $message;

	/**
	 * @access   protected
	 * @var      string|array    $headers    Additional headers
	 */
	protected $headers;

	/**
	 * @access   protected
	 * @var      string|array    $attarchments    Files to attach
	 */
	protected $attachments;

	/**
	 * Page constructor
	 * @return void
	 */
	public function __construct()
	{
		$this->headers = ['Content-Type: text/html; charset=UTF-8'];
		$this->attachments = '';
	}

	/**
	 * Send email
	 * @return bool     Whether the email contents were sent successfully.
	 */
	public function send()
	{
		return wp_mail(
			$this->to,
			$this->subject,
			$this->message,
			$this->headers,
			$this->attachments
		);
	}

	/**
	 * @return array|string
	 */
	public function getTo()
	{
		return $this->to;
	}

	/**
	 * @param array|string $to
	 */
	public function setTo($to)
	{
		$this->to = $to;
	}

	/**
	 * @return string
	 */
	public function getSubject()
	{
		return $this->subject;
	}

	/**
	 * @param string $subject
	 */
	public function setSubject($subject)
	{
		$this->subject = $subject;
	}

	/**
	 * @return string
	 */
	public function getMessage()
	{
		return $this->message;
	}

	/**
	 * @param string $message
	 */
	public function setMessage($message)
	{
		$this->message = $message;
	}

	/**
	 * @return array|string
	 */
	public function getHeaders()
	{
		return $this->headers;
	}

	/**
	 * @param array|string $headers
	 */
	public function setHeaders($headers)
	{
		$this->headers = $headers;
	}

	/**
	 * @return array|string
	 */
	public function getAttachments()
	{
		return $this->attachments;
	}

	/**
	 * @param array|string $attachments
	 */
	public function setAttachments($attachments)
	{
		$this->attachments = $attachments;
	}
}
