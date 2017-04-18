<?php

namespace Parcel\Chain\Nodes;

use Parcel\Chain\DispatchInterface;
use Parcel\Chain\NodeBase;

/**
 * Class StopPropagationNode
 *
 * @author Chris Butcher
 * @package Parcel\Chain\Nodes
 * @version 0.1.0
 */
class StopPropagationNode extends NodeBase {

	/**
	 * StopPropagationNode constructor.
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
