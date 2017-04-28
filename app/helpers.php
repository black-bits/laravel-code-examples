<?php

function getTimestampedDemoData()
{
    return [
        "timestamp"   => \Carbon\Carbon::now()->toDateTimeString(),
        "testObjects" => \App\TestObject::all(),
    ];
}

function notifyAdminsOfThisErrorOrLogIt()
{
    //
}

function getTimestampedDemoDataViaWriteConnection($id)
{

    return [
        "timestamp"   => \Carbon\Carbon::now()->toDateTimeString(),
        "testObjects" => \App\TestObject::on('mysql_force_write')->find($id),
    ];

    // alternative version
    $testObjects = new \App\TestObject();
    $testObjects->setConnection("mysql_force_write");
    return [
        "timestamp"   => \Carbon\Carbon::now()->toDateTimeString(),
        "testObjects" => $testObjects->all(),
    ];
}