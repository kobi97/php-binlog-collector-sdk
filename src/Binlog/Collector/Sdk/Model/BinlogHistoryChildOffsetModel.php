<?php

namespace Binlog\Collector\Sdk\Model;

use Binlog\Collector\Sdk\Common\BinlogHistoryModel;
use Binlog\Collector\Sdk\Dto\OnlyGtidOffsetRangeDto;

/**
 * Class BinlogHistoryChildOffsetModel
 * @package Binlog\Collector\Sdk\Model
 */
class BinlogHistoryChildOffsetModel extends BinlogHistoryModel
{
    /**
     * @return OnlyGtidOffsetRangeDto[]
     */
    public function getChildGtidOffsetRanges(): array
    {
        $dicts = $this->db->sqlDicts(
            'SELECT * from platform_universal_history_child_offset order by child_index'
        );

        $dtos = [];
        foreach ($dicts as $dict) {
            $dtos[] = OnlyGtidOffsetRangeDto::importFromDict($dict);
        }

        return $dtos;
    }

    public function getChildGtidOffsetRangeCount(): int
    {
        return $this->db->sqlData('SELECT count(*) from platform_universal_history_child_offset');
    }

    /**
     * @return string|null
     */
    public function getMinCurrentBinlogPositionDate()
    {
        return $this->db->sqlData('SELECT MIN(current_bin_log_position_date) FROM platform_universal_history_child_offset');
    }
}
