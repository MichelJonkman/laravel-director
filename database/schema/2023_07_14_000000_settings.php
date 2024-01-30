<?php


use MichelJonkman\DeclarativeSchema\Database\DeclarativeSchema;
use MichelJonkman\DeclarativeSchema\Database\Table;

return new class extends DeclarativeSchema {
    function declare(): Table
    {
        $table = new Table('settings');

        $table->id();

        $table->string('name');
        $table->string('value', 4294967295);

        $table->timestamps();

        return $table;
    }
};
