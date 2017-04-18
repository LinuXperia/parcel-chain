<?php

namespace Parcel\Chain;

/**
 * Interface DispatchInterface
 *
 * @author Chris Butcher
 * @package Parcel\Chain
 * @version 0.1.0
 */
interface DispatchInterface {

	/**
	 * DispatchInterface constructor.
	 *
	 * @param object|null $Sender
	 */
	public function __construct($Sender = null);

	/**
	 * Initialize and configure the dispatcher before it traverses the chain.
	 *
	 * @param array $Input
	 *
	 * @return void
	 */
	public function Initialize(array $Input = []);

	/**
	 * Returns the object that started the chains execution.
	 *
	 * @return object|null
	 */
	public function GetSender();

	/**
	 * Tells whether this dispatch will retain all the data across the chain,
	 * or whether to discard it after each use.
	 *
	 * @return mixed
	 */
	public function IsStateful();

	/**
	 * Makes the dispatch so that it retains data across the entire chain.
	 *
	 * @param bool $IsStateful
	 */
	public function SetStateful($IsStateful = false);

	/**
	 * Stop the dispatch from traversing the chain.
	 *
	 * @return $this
	 */
	public function StopPropagation();

	/**
	 * Tells whether the chain should continue traversing.
	 *
	 * @return boolean
	 */
	public function IsPropagating();

	/**
	 * Persists data across multiple nodes.
	 *
	 * If the dispatch is stateful then the data will persist across all nodes,
	 * Otherwise it will only hold on to the data from the previous node.
	 *
	 * @return void
	 */
	public function PersistState();

	/**
	 * Check to see whether an array index exists.
	 *
	 * @param string|integer $Name
	 *
	 * @return bool
	 */
	public function Has($Name);

	/**
	 * Looks for a specific index in the array and returns that value.
	 * If the index cannot be found, then it returns the default value.
	 *
	 * @param string|integer $Name
	 * @param mixed          $Default
	 *
	 * @return mixed
	 */
	public function Get($Name, $Default);

	/**
	 * Sets a new value, or overwrites an existing value, in the array.
	 *
	 * @param string|integer $Name
	 * @param mixed          $Value
	 *
	 * @return mixed
	 */
	public function Set($Name, $Value);
}
