<?php

namespace Parcel\Chain\Nodes;

use Parcel\Chain\DispatchInterface;
use Parcel\Chain\NodeBase;

/**
 * Class AddArrayNode
 *
 * @author Chris Butcher
 * @package Parcel\Chain\Nodes
 * @version 0.1.0
 */
class AddArrayNode extends NodeBase {

	/**
	 * This is the key under which the value will be placed within the dispatcher.
	 *
	 * @var string
	 */
	protected $Key;

	/**
	 * The array that will be placed within the dispatcher.
	 *
	 * @var mixed[]
	 */
	protected $Value;

	/**
	 * AddArrayNode constructor.
	 *
	 * @param array $Input
	 */
	public function __construct(array $Input = []) {

		if (!isset($Input['Key'])) {
			$Input['Key'] = 'Array';
		}

		if (!isset($Input['Value'])) {
			$Input['Value'] = array();
		}

		$this->Key = $Input['Key'];

		if (is_array($Input['Value'])) {
			$this->Value = $Input['Value'];

		} else if (is_object($Input['Value'])) {
			$this->Value = get_object_vars($Input['Value']);

		} else {
			$this->Value = [$Input['Value']];
		}
	}

	/**
	 * Places the array into the dispatcher.
	 *
	 * @param DispatchInterface $Dispatch
	 *
	 * @return void
	 */
	public  function Execute(DispatchInterface &$Dispatch) {
		$Dispatch->Set($this->Key, $this->Value);
	}
}
