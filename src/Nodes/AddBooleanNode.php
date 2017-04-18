<?php

namespace Parcel\Chain\Nodes;

use Parcel\Chain\DispatchInterface;
use Parcel\Chain\NodeBase;

/**
 * Class AddBooleanNode
 *
 * @author Chris Butcher
 * @package Parcel\Chain\Nodes
 * @version 0.1.0
 */
class AddBooleanNode extends NodeBase {

	/**
	 * This is the key under which the value will be placed within the dispatcher.
	 *
	 * @var string
	 */
	protected $Key;

	/**
	 * The boolean that will be placed within the dispatcher.
	 *
	 * @var integer
	 */
	protected $Value;

	/**
	 * AddBooleanNode constructor.
	 *
	 * @param array $Input
	 */
	public function __construct(array $Input = []) {

		if (!isset($Input['Key'])) {
			$Input['Key'] = 'Boolean';
		}

		if (!isset($Input['Value'])) {
			$Input['Value'] = false;
		}

		$this->Key = $Input['Key'];
		$this->Value = (bool) $Input['Value'];
	}

	/**
	 * Places the boolean into the dispatcher.
	 *
	 * @param DispatchInterface $Dispatch
	 *
	 * @return void
	 */
	public  function Execute(DispatchInterface &$Dispatch) {
		$Dispatch->Set($this->Key, $this->Value);
	}
}
