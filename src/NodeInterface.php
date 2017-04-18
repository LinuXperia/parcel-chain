<?php

namespace Parcel\Chain;

/**
 * Interface NodeInterface
 *
 * @author Chris Butcher
 * @package Parcel\Chain
 * @version 0.1.0
 */
interface NodeInterface {

	/**
	 * NodeInterface constructor.
	 *
	 * @param array $Input
	 */
	public function __construct(array $Input = []);

	/**
	 * Executes this nodes process.
	 *
	 * @param DispatchInterface $Dispatch
	 *
	 * @return mixed
	 */
	public function Execute(DispatchInterface &$Dispatch);

	/**
	 * Returns an identification string for this node.
	 *
	 * @return string
	 */
	public function GetKey();
}
