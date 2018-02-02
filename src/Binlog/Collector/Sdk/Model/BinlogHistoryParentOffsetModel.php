<?php

namespace Binlog\Collector\Sdk\Model;

use Binlog\Collector\Sdk\Common\BinlogHistoryModel;
use Binlog\Collector\Sdk\Dto\OnlyBinlogOffsetDto;

/**
 * Class BinlogHistoryParentOffsetModel
 * @package Binlog\Collector\Sdk\Model
 */
class BinlogHistoryParentOffsetModel extends BinlogHistoryModel
{
    const CURRENT_OFFSET = 0;

    /**
     * @return string|null
     */
    public function getParentBinlogDate()
    {
        return $this->db->sqlData(
            'SELECT end_bin_log_date FROM platform_universal_history_offset WHERE ?',
            sqlWhere(['offset_type' => self::CURRENT_OFFSET])
        );
    }

    public function getParentBinlogOffset(): OnlyBinlogOffsetDto
    {
        $dict = $this->db->sqlDict(
            'SELECT * FROM platform_universal_history_offset WHERE ?',
            sqlWhere(['offset_type' => self::CURRENT_OFFSET])
        );

        return OnlyBinlogOffsetDto::importOnlyBinlogOffset(
            $dict['end_bin_log_file_name'],
            $dict['end_bin_log_position'],
            $dict['end_bin_log_date']
        );
    }
}
