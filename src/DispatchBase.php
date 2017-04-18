<?php

namespace Parcel\Chain;

/**
 * Class DispatchBase
 *
 * @author  Chris Butcher
 * @package Parcel\Chain
 * @version 0.1.0
 */
abstract class DispatchBase implements DispatchInterface {

	/**
	 * The object that started to execute the chain of nodes.
	 *
	 * @var object
	 */
	protected $_Sender = null;

	/**
	 * Tells whether the dispatch should hold on to the data that
	 * is being set, or whether to discard it.
	 *
	 * @var boolean
	 */
	protected $_IsStateful = false;

	/**
	 * Tells whether the dispatch should stop traversing nodes.
	 *
	 * @var boolean
	 */
	protected $_IsPropagating = true;

	/**
	 * Data that has been recently added, but not persisted.
	 *
	 * @var mixed[]
	 */
	protected $_RecentData = array();

	/**
	 * Data that has been persisted across previous nodes.
	 *
	 * @var mixed[]
	 */
	protected $_PersistedData = array();

	/**
	 * DispatchBase constructor.
	 *
	 * @param object|null $Sender
	 */
	public function __construct($Sender = null) {
		$this->_Sender = $Sender;
	}

	/**
	 * Initialize and configure the dispatcher before it traverses the chain.
	 *
	 * @param array $Input
	 *
	 * @return void
	 */
	abstract public function Initialize(array $Input = []);

	/**
	 * Tells whether this dispatch will retain all the data across the chain,
	 * or whether to discard it after each use.
	 *
	 * @return mixed
	 */
	public function IsStateful() {
		return $this->_IsStateful;
	}

	/**
	 * Makes the dispatch so that it retains data across the entire chain.
	 *
	 * @param bool $IsStateful
	 *
	 * @return $this
	 */
	public function SetStateful($IsStateful = false) {
		$this->_IsStateful = boolval($IsStateful);

		return $this;
	}

	/**
	 * Tells whether the chain should continue traversing.
	 *
	 * @return boolean
	 */
	public function IsPropagating() {
		return $this->_IsPropagating;
	}

	/**
	 * Stop the dispatch from traversing the chain.
	 *
	 * @return $this
	 */
	public function StopPropagation() {
		$this->_IsPropagating = false;

		return $this;
	}

	/**
	 * Returns the object that started the execution of the chain.
	 *
	 * @return null|object
	 */
	public function GetSender() {
		return $this->_Sender;
	}

	/**
	 * Looks for a specific index in the array and returns that value.
	 * If the index cannot be found, then it returns the default value.
	 *
	 * @param string|integer $Name
	 * @param mixed          $Default
	 *
	 * @return mixed
	 */
	public function Get($Name, $Default = null) {
		if (isset($this->_RecentData[$Name])) {
			return $this->_RecentData[$Name];
		}

		if (isset($this->_PersistedData[$Name])) {
			return $this->_PersistedData[$Name];
		}

		return $Default;
	}

	/**
	 * Sets a new value, or overwrites an existing value, in the array.
	 *
	 * @param string|integer $Name
	 * @param mixed          $Value
	 *
	 * @return $this
	 */
	public function Set($Name, $Value) {
		$this->_RecentData[$Name] = $Value;

		return $this;
	}

	/**
	 * Check to see whether an array index exists.
	 *
	 * @param string|integer $Name
	 *
	 * @return bool
	 */
	public function Has($Name) {
		if (!isset($this->_RecentData[$Name]) && !isset($this->_PersistedData[$Name])) {
			return false;
		}

		return true;
	}

	/**
	 * Persists data across multiple nodes.
	 *
	 * If the dispatch is stateful then the data will persist across all nodes,
	 * Otherwise it will only hold on to the data from the previous node.
	 *
	 * @return void
	 */
	public function PersistState() {
		if ($this->IsStateful()) {
			$this->_PersistedData = array_merge($this->_PersistedData, $this->_RecentData);
		} else {
			$this->_PersistedData = $this->_RecentData;
		}

		$this->_RecentData = array();
	}
}
