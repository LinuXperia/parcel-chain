<?php

namespace Parcel\Chain\Tests;

use Parcel\Chain\Chain;
use Parcel\Chain\Dispatch\Dispatch;
use Parcel\Chain\Nodes\AddStringNode;
use Parcel\Chain\Nodes\StopPropagatingNode;
use PHPUnit\Framework\TestCase;

class DispatchTest extends TestCase
{
	/**
	 * Tests whether the chain traverses the nodes.
	 */
	public function testNodeExecution() {
		$Dispatch = new Dispatch();

		$Chain = new Chain();
		$Chain->LinkNode(new AddStringNode([
			'Key'   => 'Name',
			'Value' => 'Chris'
		]));

		$Chain->Execute($Dispatch);

		$this->assertCount(1, $Chain->GetNodes());
		$this->assertEquals($Dispatch->Get('Name'), 'Chris');
	}

	/**
	 * Test whether data can be persisted across multiple nodes.
	 * This happens when the dispatch has set as stateful
	 */
	public function testPersistData() {

		$Dispatch = new Dispatch();
		$Dispatch->SetStateful(true);

		$Chain = new Chain();
		$Chain->LinkNode(new AddStringNode([
			'Key'   => 'Cat',
			'Value' => 'Ein'
		]))->LinkNode(new AddStringNode([
			'Key'   => 'Dog',
			'Value' => 'Steins'
		]))->LinkNode(new AddStringNode([
			'Key'   => 'Theory',
			'Value' => 'Relativity'
		]));

		$Chain->Execute($Dispatch);

		$this->assertEquals($Dispatch->Get('Cat'), 'Ein');
		$this->assertEquals($Dispatch->Get('Dog'), 'Steins');
		$this->assertEquals($Dispatch->Get('Theory'), 'Relativity');
	}

	/**
	 * Test whether the data has been cleared after being used by the next node.
	 * This happens when the dispatch is not stateful.
	 */
	public function testNonPersistData() {

		$Dispatch = new Dispatch();

		$Chain = new Chain();
		$Chain->LinkNode(new AddStringNode([
			'Key'   => 'Party',
			'Value' => 'Animal'
		]))->LinkNode(new AddStringNode([
			'Key'   => 'Animal',
			'Value' => 'Party'
		]));

		$Chain->Execute($Dispatch);

		$this->assertNull($Dispatch->Get('Party'));
	}

	/**
	 * Tests whether the chain can stop traversing the nodes when the dispatch
	 * has been been set to stop propagation.
	 */
	public function testStopPropagation() {

		$Dispatch = new Dispatch();

		$Chain = new Chain();
		$Chain->LinkNode(new StopPropagatingNode())
			 ->LinkNode(new AddStringNode([
				'Key'   => 'Artist',
				'Value' => 'Jason Aldean'
		]));

		$Chain->Execute($Dispatch);

		$this->assertNull($Dispatch->Get('Artist'));
	}

	/**
	 * Tests whether we can set and get the dispatches sender.
	 */
	public function testSenderIsSet() {

		$Chain = new Chain();
		$Chain->LinkNode(new AddStringNode());

		$Dispatch = new Dispatch($Chain);

		$Chain->Execute($Dispatch);

		$this->assertTrue(is_object($Dispatch->GetSender()));
		$this->assertEquals(get_class($Dispatch->GetSender()), 'Parcel\Chain\Chain');
	}
}
