<?php

namespace App;

class Validator
{
    protected $schema;

    public function __construct($schema)
    {
        $this->schema = json_decode($schema);
    }

    public function validate($payload): bool
    {
        try {
            $payload = json_decode($payload);
            $this->validateRequired($payload);
            foreach ($payload as $key => $value) {
                if (!property_exists($this->schema->properties, $key)) throw new \Exception("validation failed -> $key<br />");

                $this->validateProperty($this->schema->properties, $key, $value);
            }
            return true;
        } catch (\Exception $error) {
            echo "Exception ", $error->getMessage(), "\n";
            return false;
        }
    }

    private function validateRequired($payload)
    {
        foreach ($this->schema->required as $value) {
            if (!property_exists($payload, $value)) throw new \Exception("validation failed -> $value required<br />");
        }
    }

    private function validateProperty($properties, $key, $value)
    {
        if ($properties->$key->type !== gettype($value)) {
            throw new \Exception("validation failed -> type<br />");
        }

        if (property_exists($properties->$key, 'enum')) {
            if (!in_array($value, $properties->$key->enum)) throw new \Exception("validation failed -> $value not in enum<br />");
        }

        if (property_exists($properties->$key, 'minimum')) {
            if ($value < $properties->$key->minimum) throw new \Exception("validation failed -> $value smaller minimum<br />");
        }

        if (property_exists($properties->$key, 'minItems')) {
            if (count($value) < $properties->$key->minItems) throw new \Exception("validation failed -> " . count($value) . " smaller minItems<br />");
        }

        if (property_exists($properties->$key, 'minLength')) {
            if (strlen($value) < $properties->$key->minLength) throw new \Exception("validation failed -> " . strlen($value) . " smaller minLength<br />");
        }

        if (property_exists($properties->$key, 'items')) {
            if ($properties->$key->items === 'string') {
                foreach ($value as $val) {
                    $this->validateProperty($properties->$key, 'items', $val);
                }
            }
        }
    }
}