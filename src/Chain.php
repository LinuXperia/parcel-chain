<?php

namespace Parcel\Chain;

/**
 * Class Chain
 *
 * @author Chris Butcher
 * @package Parcel\Chain
 * @version 0.1.0
 */
class Chain implements ChainInterface {

	/**
	 * List of all the nodes that are attached to this chain.
	 *
	 * @var NodeInterface[]
	 */
	protected $_Nodes = array();

	/**
	 * Traverses the nodes in the chain.
	 *
	 * @param DispatchInterface $Dispatch
	 */
	public function Execute(DispatchInterface $Dispatch) {
		for ($i = 0; $i < count($this->_Nodes); $i++) {

			$this->_Nodes[$i]->Execute($Dispatch);

			$Dispatch->PersistState();

			if (!$Dispatch->IsPropagating()) {
				break;
			}
		}
	}

	/**
	 * Returns all of the nodes for this chain.
	 *
	 * @return NodeInterface[]
	 */
	public function GetNodes() {
		return $this->_Nodes;
	}

	/**
	 * Link a new node to the end of the chain.
	 *
	 * @param NodeInterface $Node
	 *
	 * @return $this
	 */
	public function LinkNode(NodeInterface $Node) {
		$this->_Nodes[] = $Node;

		return $this;
	}
}
