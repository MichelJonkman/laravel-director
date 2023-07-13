<?php

use MichelJonkman\DbalSchema\Database\DeclarativeSchema;
use MichelJonkman\DbalSchema\Database\Table;

return new class extends DeclarativeSchema {
    function declare(): Table
    {
        $table = new Table('test');

        $table->addId();

        $table->addColumn('name', 'string');
        $table->addColumn('content', 'string');

        $table->addTimestamps();

        return $table;
    }
};
