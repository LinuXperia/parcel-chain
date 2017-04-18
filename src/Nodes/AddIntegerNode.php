<?php

namespace Parcel\Chain\Nodes;

use Parcel\Chain\DispatchInterface;
use Parcel\Chain\NodeBase;

/**
 * Class AddIntegerNode
 *
 * @author Chris Butcher
 * @package Parcel\Chain\Nodes
 * @version 0.1.0
 */
class AddIntegerNode extends NodeBase {

	/**
	 * This is the key under which the value will be placed within the dispatcher.
	 *
	 * @var string
	 */
	protected $Key;

	/**
	 * The integer that will be placed within the dispatcher.
	 *
	 * @var integer
	 */
	protected $Value;

	/**
	 * AddIntegerNode constructor.
	 *
	 * @param array $Input
	 */
	public function __construct(array $Input = []) {

		if (!isset($Input['Key'])) {
			$Input['Key'] = 'Integer';
		}

		if (!isset($Input['Value'])) {
			$Input['Value'] = 0;
		}

		$this->Key = $Input['Key'];

		if (is_integer($Input['Value']) || is_bool($Input['Value'])) {
			$this->Value = intval($Input['Value']);

		} else {
			$this->Value = 0;
		}
	}

	/**
	 * Places the integer into the dispatcher.
	 *
	 * @param DispatchInterface $Dispatch
	 *
	 * @return void
	 */
	public  function Execute(DispatchInterface &$Dispatch) {
		$Dispatch->Set($this->Key, $this->Value);
	}
}
