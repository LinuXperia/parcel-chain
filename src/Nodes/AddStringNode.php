<?php

namespace Parcel\Chain\Nodes;

use Parcel\Chain\DispatchInterface;
use Parcel\Chain\NodeBase;

/**
 * Class AddStringNode
 *
 * @author Chris Butcher
 * @package Parcel\Chain\Nodes
 * @version 0.1.0
 */
class AddStringNode extends NodeBase {

	/**
	 * This is the key under which the value will be placed within the dispatcher.
	 *
	 * @var string
	 */
	protected $Key;

	/**
	 * The string that will be placed within the dispatcher.
	 *
	 * @var string
	 */
	protected $Value;

	/**
	 * AddStringNode constructor.
	 *
	 * @param array $Input
	 */
	public function __construct(array $Input = []) {

		if (!isset($Input['Key'])) {
			$Input['Key'] = 'String';
		}

		if (!isset($Input['Value'])) {
			$Input['Value'] = '';
		}

		$this->Key = $Input['Key'];

		if (is_string($Input['Value'])) {
			$this->Value = $Input['Value'];

		} else if (is_object($Input['Value']) && method_exists($Input['Value'], '__toString')) {
			$this->Value = (string) $Input['Value'];

		} else {
			$this->Value = '';
		}
	}

	/**
	 * Places the string into the dispatcher.
	 *
	 * @param DispatchInterface $Dispatch
	 *
	 * @return void
	 */
	public  function Execute(DispatchInterface &$Dispatch) {
		$Dispatch->Set($this->Key, $this->Value);
	}
}
