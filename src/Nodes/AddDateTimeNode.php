<?php

namespace Parcel\Chain\Nodes;

use Parcel\Chain\DispatchInterface;
use Parcel\Chain\NodeBase;
use DateTime;

/**
 * Class AddDateTimeNode
 *
 * @author Chris Butcher
 * @package Parcel\Chain\Nodes
 * @version 0.1.0
 */
class AddDateTimeNode extends NodeBase {

	/**
	 * This is the key under which the value will be placed within the dispatcher.
	 *
	 * @var string
	 */
	protected $Key;

	/**
	 * The DateTime object that will be placed within the dispatcher.
	 *
	 * @var DateTime
	 */
	protected $Date;

	/**
	 * AddDateTimeNode constructor.
	 *
	 * @param array $Input
	 */
	public function __construct(array $Input = []) {
		if (!isset($Input['Date'])) {
			$Input['Date'] = new DateTime();
		}

		if (!isset($Input['Key']) || (!is_string($Input['Key']) && !is_integer($Input['Key']))) {
			$Input['Key'] = 'Date';
		}

		$this->Key = $Input['Key'];

		if (is_integer($Input['Date']) && intval($Input['Date']) > 1) {
			$this->Date = new DateTime($Input['Date']);

		} else if (is_string($Input['Date'])) {
			$this->Date = new DateTime($Input['Date']);

		} else if (is_object($Input['Date']) && $Input['Date'] instanceof DateTime) {
			$this->Date = $Input['Date'];

		} else {
			$this->Date = new DateTime();
		}
	}

	/**
	 * Places the DateTime object into the dispatcher.
	 *
	 * @param DispatchInterface $Dispatch
	 *
	 * @return void
	 */
	public  function Execute(DispatchInterface &$Dispatch) {
		$Dispatch->Set($this->Key, $this->Date);
	}
}
