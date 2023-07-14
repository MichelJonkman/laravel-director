<?php

use MichelJonkman\DbalSchema\Database\DeclarativeSchema;
use MichelJonkman\DbalSchema\Database\Table;

return new class extends DeclarativeSchema {
    function declare(): Table
    {
        $table = new Table('settings');

        $table->addId();

        $table->addColumn('name', 'string');
        $table->addColumn('value', 'string', [
            'length' => 4294967295
        ]);

        $table->addTimestamps();

        return $table;
    }
};
