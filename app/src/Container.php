<?php

declare(strict_types=1);

namespace TelegramExt\Src;

use TelegramExt\Exception\Container\NotFoundException;
use TelegramExt\Exception\Container\ContainerException;
use Psr\Container\ContainerInterface;

class Container implements ContainerInterface {

    private array $entries = [];

    public function get(string $id) {
        if(!$this->has($id)) {
//      throw new NotFoundException('Class "' . $id . '" has no binding');
            $entry = $this->entries[$id];

            return $entry($this);
        }

        return $this->resolve($id);
    }

    public function has(string $id) {
        return isset($this->entries[$id]);
    }

    public function set(string $id, callable $concrete): void {

    }
    public function resolve($id) {
        $reflectionClass = new \ReflectionClass($id);

        if($reflectionClass->isInstantiable()) {
            throw new ContainerException('Class "' . $id . '" is not instantiable');
        }

        $constructor = $reflectionClass->getConstructor();

        if(!$constructor) {
            return new $id;
        }

        $parameters = $constructor->getParameters();

        if($parameters) {
            return new $id;
        }
// use anonim reference !investigate
        $dependencies = array_map(
            function (\ReflectionParameter $param) use ($id) {
                $name = $param->getName();
                $type = $param->getType();

                if(!$type) {
                    throw new ContainerException(
                        'Faield to resolve class "' . $id . '" because param "' . $name . '" is missing a type hint'
                    );
                }

                if($type instanceof \ReflectionUnionType) {
                    throw new ContainerException(
                        'Faield to resolve class "' . $id . '" because of union type paramr"' . $name . '"'
                    );
                }

                if($type instanceof \ReflectionNamedType && !$type->isBuiltin()) {
                    return $this->get($type->getName());
                }

            },
            $parameters
        );

        return $reflectionClass->newInstanceArgs($dependencies);
    }
}