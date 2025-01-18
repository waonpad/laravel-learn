<?php

declare(strict_types=1);

namespace App\OpenApi\Attributes;

use OpenApi\Attributes as OAA;
use OpenApi\Generator;

class CustomSchema extends OAA\Schema
{
    public function __construct(
        // schema
        null|object|string $ref = null,
        ?string $schema = null,
        ?string $title = null,
        ?string $description = null,
        ?int $maxProperties = null,
        ?int $minProperties = null,
        ?array $required = null,
        ?array $properties = null,
        null|array|string $type = null,
        ?string $format = null,
        ?OAA\Items $items = null,
        ?string $collectionFormat = null,
        mixed $default = Generator::UNDEFINED,
        $maximum = null,
        null|bool|float|int $exclusiveMaximum = null,
        $minimum = null,
        null|bool|float|int $exclusiveMinimum = null,
        ?int $maxLength = null,
        ?int $minLength = null,
        ?int $maxItems = null,
        ?int $minItems = null,
        ?bool $uniqueItems = null,
        ?string $pattern = null,
        null|array|string $enum = null,
        ?OAA\Discriminator $discriminator = null,
        ?bool $readOnly = null,
        ?bool $writeOnly = null,
        ?OAA\Xml $xml = null,
        ?OAA\ExternalDocumentation $externalDocs = null,
        mixed $example = Generator::UNDEFINED,
        ?array $examples = null,
        ?bool $nullable = null,
        ?bool $deprecated = null,
        ?array $allOf = null,
        ?array $anyOf = null,
        ?array $oneOf = null,
        null|bool|OAA\AdditionalProperties $additionalProperties = null,
        mixed $const = Generator::UNDEFINED,
        // annotation
        ?array $x = null,
        ?array $attachables = null
    ) {
        parent::__construct(
            ref: $ref,
            schema: $schema,
            title: $title,
            description: $description,
            maxProperties: $maxProperties,
            minProperties: $minProperties,
            required: $required,
            properties: $properties,
            type: $type,
            format: $format,
            items: $items,
            collectionFormat: $collectionFormat,
            default: $default,
            maximum: $maximum,
            exclusiveMaximum: $exclusiveMaximum,
            minimum: $minimum,
            exclusiveMinimum: $exclusiveMinimum,
            maxLength: $maxLength,
            minLength: $minLength,
            maxItems: $maxItems,
            minItems: $minItems,
            uniqueItems: $uniqueItems,
            pattern: $pattern,
            enum: $enum,
            discriminator: $discriminator,
            readOnly: $readOnly,
            writeOnly: $writeOnly,
            xml: $xml,
            externalDocs: $externalDocs,
            example: $example,
            examples: $examples,
            nullable: $nullable,
            deprecated: $deprecated,
            allOf: $allOf,
            anyOf: $anyOf,
            oneOf: $oneOf,
            additionalProperties: $additionalProperties,
            const: $const,
            x: $x,
            attachables: $attachables,
        );
    }
}
