<?php
declare(strict_types=1);

namespace kaz29\AzureADB2C\Entity;

abstract class BaseEntity implements \ArrayAccess, \JsonSerializable
{
    protected $data = [];
    protected $config = [];

    public function __construct(array $data)
    {
        if (array_key_exists('map', $this->config)) {
            foreach($this->config['map'] as $src => $dist) {
                if (array_key_exists($src, $data)) {
                    $this->data[$dist] = $data[$src];
                } else {
                    $this->data[$dist] = null;
                }
            }
        } else {
            $this->data = $data;
        }
    }

    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->data);
    }

    public function offsetGet($offset)
    {
        if (!$this->offsetExists($offset)) {
            return null;
        }

        return $this->data[$offset];
    }

    public function offsetSet($offset , $value)
    {
        if (is_null($offset)) {
            throw new \Exception('Invalid offset');
        }

        $this->data[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }



    public function __get($name)
    {
        return $this->offsetGet($name);
    }

    public function __set($name, $value)
    {
        throw new \Exception("Could not update '{$name}'");
    }

    public function jsonSerialize(): mixed
    {
        return json_encode($this->data);
    }
}
