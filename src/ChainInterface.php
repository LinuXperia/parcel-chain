<?php

namespace Parcel\Chain;

/**
 * Interface ChainInterface
 *
 * @author Chris Butcher
 * @package Parcel\Chain
 * @version 0.1.0
 */
interface ChainInterface {

	/**
	 * Starts the chains execution, passing the dispatcher from node to node.
	 *
	 * @param DispatchInterface $Dispatch The dispatcher that will traverse down the chain of nodes.
	 *
	 * @return void
	 */
	public function Execute(DispatchInterface $Dispatch);

	/**
	 * Returns a list of all the nodes that belong to the chain.
	 *
	 * @return NodeInterface[]
	 */
	public function GetNodes();

	/**
	 * Adds a node to the end of the chain.
	 *
	 * @param NodeInterface $Node The node that will appended to the chain.
	 *
	 * @return mixed
	 */
	public function LinkNode(NodeInterface $Node);
}