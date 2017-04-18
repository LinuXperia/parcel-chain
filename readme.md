# Parcel - Chain
The chain component allows users to build a chain reaction using modular nodes.

## Simple Explanation of Flow Based Programming
For this example, we are going to imagine a package delivery service, like UPS or FedEx.
The delivery driver (dispatcher) travels to different facilities (nodes), dropping off
and picking up packages (variables).

What the nodes do with those packages, is completely up to them.

## Initialization and Basic Execution
```$php

// Create a new chain that will allow us to attach nodes to it.
$Chain = new \Parcel\Chain\Chain();
 
// Add a new node to the chain which will add a string to the dispatcher.
$Chain->LinkNode(new \Parcel\Chain\Nodes\AddStringNode([
    'Key' => 'Name',
    'Value' => 'Hello World'
]));
 
// Adds another node which will echo the previously created string.
$Chain->LinkNode(new \Parcel\Chain\Nodes\EchoStringNode([
    'Key' => 'Name'
]));
 
// Instantiate a new dispatcher which will be sent to every node.
$Dispatch = new \Parcel\Chain\Dispatch\Dispatch($Chain);
 
// We start the node execution, which sends the dispatcher to all the nodes.
// The end result will be the value 'Hello World' printed to the screen.
$Chain->Execute($Dispatch);

```

## Creating a Node
```$php

<?php
 
namespace Parcel\Chain\Nodes;
 
use Parcel\Chain\DispatchInterface;
use Parcel\Chain\NodeBase;
 
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
     * The constructor is where we initialize our node. This will include supplying
     * any data that our node needs to execute correctly.
     * 
     * In this example we are supplying the Key, which is the name of the variable that
     * we will set in the dispathcer, and the Value, which is  the string that will
     * be stored in the dispatcher.
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
     * When the node is executed, this will place the value into the dispatcher
     * under the supplied key name.
     */
    public  function Execute(DispatchInterface &$Dispatch) {
        $Dispatch->Set($this->Key, $this->Value);
    }
}

```