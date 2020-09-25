<?php

namespace Binlog\Collector\Sdk\Model;

use Binlog\Collector\Sdk\Common\BinlogHistoryModel;

class BinlogHistoryTimeMonitorModel extends BinlogHistoryModel
{
    /**
     * @param string $type @see BinlogHistoryTimeMonitorConst
     *
     * @return string|null
     */
    public function getLastTimeMonitor(string $type)
    {
        $where = ['type' => $type];

        return $this->db->sqlData('SELECT MAX(reg_date) FROM platform_time_monitor WHERE ?', sqlWhere($where));
    }
}
