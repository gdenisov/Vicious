<?php
declare(encoding='UTF-8');

namespace vicious
{


class ViciousException extends \Exception {
	
// ===========================================================
// - Constructor
// ===========================================================
	function __construct($message='', $code=0) {
		parent::__construct($message, $code);
		
		# try to adjust exception info to focus on application errors
		if (dirname($this->file()) == dirname(__FILE__)) {
			$t = $this->trace();
			$this->file = array_key_exists("file", $t[0]) ? $t[0]['file'] : '';
			$this->line = array_key_exists("line", $t[0]) ? $t[0]['line'] : '';
		}
	}
	
	/**
	 * Create a ViciousException from another exception.
	 * Mostly used to convert exceptions thrown from other frameworks, etc.
	 */
	public static function fromException($e) {
		$v = new ViciousException($e->getMessage(), intval($e->getCode()));
		$v->file = $e->getFile();
		$v->line = $e->getLine();
		$v->trace = $e->getTrace();
		return $v;
	}

// ===========================================================
// - Accessors
// ===========================================================
	function message()					{ return $this->getMessage(); }
	function code()							{ return $this->getCode(); }
	function file()							{ return $this->getFile(); }
	function line()							{ return $this->getLine(); }
	function trace()	 					{ return $this->getTrace(); }
	function trace_as_string()	{ return $this->getTraceAsString(); }
}

class InvalidStatement extends ViciousException {}

}

?>