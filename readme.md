# Parcel - Chain
The chain component allows users to build a chain reaction using modular nodes.

## Simple Explanation of Flow Based Programming
Imagine a package delivery service, like UPS or FedEx. The delivery driver (dispatcher)
travels to different facilities (nodes), dropping off and picking up packages (variables).
What the nodes do when they get those packages, is completely up to them.

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

Nodes are mean to be re-usable and stateless black boxes that have a single
responsibility, such as sending an email, writing text to a file, or connecting
to a database. For our example, we are going to create a simple node that lets
us send an email.

When adding a node to the chain, it needs to have the proper interface to work
correctly. So you'll need to make sure your node extends `Parcel\Chain\NodeBase`,
which has an abstract `Execute` method that we'll put our nodes logic will go into.

```$php

<?php
 
namespace Parcel\Chain\Nodes;
 
use Parcel\Chain\NodeBase;
use Parcel\Chain\DispatchInterface;
 
class SendEmailNode extends NodeBase {
 
    /**
     * Execute the node by looking up the emails required values
     * and then sending an email using the mail() command.
     */
    public  function Execute(DispatchInterface &$Dispatch) {
    
        $To = $Dispatch->Get('To');
        $From = $Dispatch->Get('From');
        $ReplyTo = $Dispatch->Get('ReplyTo');
        $Subject = $Dispatch->Get('Subject');
        $Body = $Dispatch->Get('Body');
        
        $Headers = [
            "To: {$To}",
            "From: {$From}",
            "Reply-To: {$ReplyTo}",
            "MIME-Version: 1.0",
            "Content-type: text/html"
        ];
        
        if (!mail($To, $Subject, $Body, $Headers) ) {
            throw new \Exception("Unable to send the email.");
        }
    }
}

```

The first thing you'll notice in our `Execute` method, is that we are retrieving
our email configuration variables from our dispatcher. Those variables will have
either been added by other nodes, or the dispatcher would have been initialized
with them.
 
After we compile our mail headers, in an attempt to make sure that we get past
any spam filters, we attempt to send the email which upon failure will throw
an exception.
 
Yepp, that's really all there is to it. You just need to create a single method
that serves a single purpose.