<?php

namespace Parcel\Chain;

/**
 * Class NodeBase
 *
 * @author  Chris Butcher
 * @package Parcel\Chain
 * @version 0.1.0
 */
abstract class NodeBase implements NodeInterface {

	/**
	 * The identification key for this node.
	 *
	 * @var string|null
	 */
	protected $_Key = null;

	/**
	 * NodeBase constructor.
	 *
	 * @param array $Input
	 */
	public function __construct(array $Input = []) {

	}

	/**
	 * Executes this nodes process.
	 *
	 * @param DispatchInterface $Dispatch
	 *
	 * @return mixed
	 */
	public abstract function Execute(DispatchInterface &$Dispatch);

	/**
	 * Returns an identification string for this node.
	 *
	 * @return string
	 */
	public function GetKey() {
		if (is_null($this->_Key) || !is_string($this->_Key)) {
			$this->_Key = get_class($this);
		}

		return $this->_Key;
	}
}
