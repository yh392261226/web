<?php
/**
 * 工种接口
 */
namespace App\Controller;

class Bouns extends \CLASSES\WebBase
{
    public function __construct($swoole)
    {
        parent::__construct($swoole);
        $this->bouns_dao = new \WDAO\Bouns();
        $this->bouns_type_dao = new \WDAO\Bouns_type();
        $this->bouns_data_dao = new \WDAO\Bouns_data();
    }

    public function index()
    {
        $action = (isset($_REQUEST['action']) && '' != trim($_REQUEST['action'])) ? trim($_REQUEST['action']) : 'list';
        if ('' != trim($action))
        {
            $this->$action();
        }
    }

    //列表及搜索
    private function list()
    {
        $list = $data = array();
        if (isset($_REQUEST['b_id'])) $data['b_id'] = array('type' => 'in', 'value' => $_REQUEST['b_id']);
        if (isset($_REQUEST['bt_id'])) $data['bt_id'] = intval($_REQUEST['bt_id']);
        if (isset($_REQUEST['b_status'])) $data['b_status'] = intval($_REQUEST['b_status']);
        if (isset($_REQUEST['b_type'])) $data['b_type'] = intval($_REQUEST['b_type']);
        if (isset($_REQUEST['b_author'])) $data['b_author'] = intval($_REQUEST['b_author']);
        //区间值
        if (isset($_REQUEST['b_start_time'])) $data['b_start_time'] = array('type' => 'ge', 'ge_value' => strtotime($_REQUEST['b_start_time']));
        if (isset($_REQUEST['b_end_time'])) $data['b_end_time'] = array('type' => 'le', 'le_value' => strtotime($_REQUEST['b_end_time']));
        if (isset($_REQUEST['b_amount'])) $data['b_amount'] = floatval($_REQUEST['b_amount']);
        if (isset($_REQUEST['b_total'])) $data['b_total'] = intval($_REQUEST['b_total']);
        if (isset($_REQUEST['b_offset'])) $data['b_offset'] = intval($_REQUEST['b_offset']);
        $data['pager'] = 0;
        $data['order'] = 'b_id desc';
        $list = $this->bouns_dao->listData($data);
        if (!empty($list))
        {
            $this->exportData($list['data']);
        }
        else
        {
            $this->exportData();
        }
    }

    //详情
    private function info()
    {
        $info = array();
        if (isset($_REQUEST['b_id']) || isset($_REQUEST['key']))
        {
            if (isset($_REQUEST['b_id']))
            {
                $info = $this->bouns_dao->infoData(intval($_REQUEST['b_id']));
            }
            elseif (isset($_REQUEST['key']))
            {
                $info = $this->bouns_dao->infoData(array('key' => trim($_REQUEST['key']), 'val' =>  $_REQUEST['val']));
            }
        }

        if (!empty($info))
        {
            $this->exportData($info);
        }
        else
        {
            $this->exportData();
        }
    }

    //列表及搜索
    private function listData()
    {
        $list = $data = array();
        if (isset($_REQUEST['bd_id'])) $data['bd_id'] = array('type' => 'in', 'value' => $_REQUEST['bd_id']);
        if (isset($_REQUEST['b_id'])) $data['b_id'] = intval($_REQUEST['b_id']);
        if (isset($_REQUEST['bt_id'])) $data['bt_id'] = intval($_REQUEST['bt_id']);
        if (isset($_REQUEST['bd_serial'])) $data['bd_serial'] = trim($_REQUEST['bd_serial']);
        if (isset($_REQUEST['bd_author'])) $data['bd_author'] = intval($_REQUEST['bd_author']);
        if (isset($_REQUEST['b_author'])) $data['b_author'] = intval($_REQUEST['b_author']);
        //区间值
        $data['pager'] = 0;
        $data['order'] = 'bd_id desc';
        $list = $this->bouns_data_dao->listData($data);
        if (!empty($list))
        {
            $this->exportData($list['data']);
        }
        else
        {
            $this->exportData();
        }
    }

    //详情
    private function infoData()
    {
        $info = array();
        if (isset($_REQUEST['bd_id']) || isset($_REQUEST['key']))
        {
            if (isset($_REQUEST['bd_id']))
            {
                $info = $this->bouns_data_dao->infoData(intval($_REQUEST['bd_id']));
            }
            elseif (isset($_REQUEST['key']))
            {
                $info = $this->bouns_data_dao->infoData(array('key' => trim($_REQUEST['key']), 'val' =>  $_REQUEST['val']));
            }
        }

        if (!empty($info))
        {
            $this->exportData($info);
        }
        else
        {
            $this->exportData();
        }
    }

    //列表及搜索
    private function listType()
    {
        $list = $data = array();
        if (isset($_REQUEST['bt_id'])) $data['bt_id'] = array('type' => 'in', 'value' => $_REQUEST['bt_id']);
        if (isset($_REQUEST['bt_name'])) $data['bt_name'] = array('type'=>'like', 'value' => trim($_REQUEST['bt_name']));
        if (isset($_REQUEST['bt_author'])) $data['bt_author'] = intval($_REQUEST['bt_author']);
        if (isset($_REQUEST['bt_status'])) $data['bt_status'] = intval($_REQUEST['bt_status']);
        if (isset($_REQUEST['bt_withdraw'])) $data['bt_withdraw'] = intval($_REQUEST['bt_withdraw']);
        if (isset($_REQUEST['bt_start_time'])) $data['bt_start_time'] = array('type' => 'ge', 'ge_value' => strtotime($_REQUEST['bt_start_time']));
        if (isset($_REQUEST['bt_end_time'])) $data['bt_end_time'] = array('type' => 'le', 'le_value' => strtotime($_REQUEST['bt_end_time']));
        //区间值
        $data['pager'] = 0;
        $data['order'] = 'bt_id desc';
        $list = $this->bouns_type_dao->listData($data);
        if (!empty($list))
        {
            $this->exportData($list['data']);
        }
        else
        {
            $this->exportData();
        }
    }

    //详情
    private function infoType()
    {
        $info = array();
        if (isset($_REQUEST['bt_id']) || isset($_REQUEST['key']))
        {
            if (isset($_REQUEST['bt_id']))
            {
                $info = $this->bouns_type_dao->infoData(intval($_REQUEST['bt_id']));
            }
            elseif (isset($_REQUEST['key']))
            {
                $info = $this->bouns_type_dao->infoData(array('key' => trim($_REQUEST['key']), 'val' =>  $_REQUEST['val']));
            }
        }

        if (!empty($info))
        {
            $this->exportData($info);
        }
        else
        {
            $this->exportData();
        }
    }
}