<?php

namespace Parcel\Chain\Nodes;

use Parcel\Chain\DispatchInterface;
use Parcel\Chain\NodeBase;

/**
 * Class StopPropagatingNode
 *
 * @author Chris Butcher
 * @package Parcel\Chain\Nodes
 * @version 0.1.0
 */
class StopPropagatingNode extends NodeBase {

	/**
	 * StopPropagatingNode constructor.
	 *
	 * @param array $Input
	 */
	public function __construct(array $Input = []) { }

	/**
	 * Stops the chains execution.
	 *
	 * @param DispatchInterface $Dispatch
	 *
	 * @return void
	 */
	public  function Execute(DispatchInterface &$Dispatch) {
		$Dispatch->StopPropagation();
	}
}
