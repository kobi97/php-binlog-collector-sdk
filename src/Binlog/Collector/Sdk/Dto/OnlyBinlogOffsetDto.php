<?php

namespace Binlog\Collector\Sdk\Dto;

/**
 * Class OnlyBinlogOffsetDto
 * @package Binlog\Collector\Sdk\Dto
 */
class OnlyBinlogOffsetDto
{
    /** @var string */
    public $file_name;
    /** @var int */
    public $position;
    /** @var string */
    public $date;

    public static function importOnlyBinlogOffset(
        string $file_name = null,
        int $position = null,
        string $date = null
    ): self {
        $dto = new self();
        $dto->file_name = $file_name;
        $dto->position = $position;
        $dto->date = $date;

        return $dto;
    }

    public function __toString(): string
    {
        if ($this->date === null) {
            return "[{$this->file_name}/{$this->position}]";
        } else {
            return "[{$this->date}/{$this->file_name}/{$this->position}]";
        }
    }

    public function getBinlogKey(): string
    {
        return $this->file_name . '|' . $this->position;
    }
}
