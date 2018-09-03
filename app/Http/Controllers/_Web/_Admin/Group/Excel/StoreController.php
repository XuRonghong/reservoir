<?php

namespace App\Http\Controllers\_Web\_Admin\Group\Excel;

use App\SysGroup;
use App\SysGroupInfo;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class StoreController extends _ExcelController
{
    const DATA_SYNCED = 'SYNCED';
    const DATA_NEW = 'NEW';
    const DATA_EDIT = 'EDIT';

    public $module = [ 'admin', 'group', 'excel', 'store' ];
    protected $store_name = 'group_store';
    protected $store_type = 'xls';
    protected $primaryKey = 'vGroupName';
    protected $query;
    protected $exportData =
        [
            'iId' => 'ID',
            'vGroupName' => '名稱',
            'vGroupCode' => '群組代號',
            'vGroupTitle' => '簡稱',
            'vGroupID' => '統一編號',
            'vGroupEmail' => '服務信箱',
            'vGroupEmailDomain' => '群組信箱domain',
            'vGroupContact' => '電話',
            'vGroupTax' => '傳真',
            'vGroupZipCode' => '郵遞區號',
            'vGroupAddress' => '地址',
            'vGroupWebsite' => '網址',
            'vGroupNote' => '附註',
            'iCreateTime' => '建立時間',
            'iUpdateTime' => '修改時間',
        ];
    public $iGroupType = 4;
    public $iAcType = 41;

    public function index ( Request $request )
    {
        $this->breadcrumb = [
            $this->module[0] . '.' . $this->module[1] => "#",
            implode( '.', $this->module ) => url( 'web/' . implode( '/', $this->module ) )
        ];
        $this->func = "web." . implode( '.', $this->module );
        $this->__initial();

        $this->view->with( 'export', $this->exportData );

        return $this->view;
    }

    public function getList ( Request $request )
    {
        //匯入資料讀取
        try {
            $data = Excel::load( $this->store_full_path )->get();
        } catch (\Exception $exception) {
            return Datatables::of( collect( [] ) )->make( true );
        }
        if (!empty( $data ) && $data->count()) {
            //資料處理
            foreach ($data as $row_idx => $row) {
                $row = $this->getListDataMap( $row );

            }

            return Datatables::of( $data )->make( true );
        }
        return Datatables::of( collect( [] ) )->make( true );
    }

    public function updateFileIntoDB ( Request $request )
    {
        try {
            $data = Excel::load( $this->store_full_path )->get();
        } catch (\Exception $exception) {
            return redirect()->back()->with( 'message', 'File not found.' );
        }

        if (!empty( $data ) && $data->count()) {
            //資料處理
            foreach ($data as $row_idx => $row) {
                //$DaoGroup
                $mapMember[$this->primaryKey] = strtolower( trim( $row[$this->primaryKey] ) );
                $mapGroup['iGroupType'] = $this->iGroupType;
                if (!empty( $row['iId'] )) {
                    $DaoGroup = SysGroup::where( $mapGroup )->find( $row['iId'] );
                } else {
                    $DaoGroup = SysGroup::where( $mapGroup )->first();
                }

                if (!$DaoGroup) {
                    $DaoGroup = new SysGroup();
                    $DaoGroup->iMemberId = session( 'member.iId' );
                    $DaoGroup->iManagerId = session( 'member.iId' );
                    $DaoGroup->iGroupType = $this->iGroupType;
                    $DaoGroup->iCreateTime = time();
                    $DaoGroup->iLimitCount = 0;
                }
                //$DaoGroup vGroupCode
                if (!empty( $row['vGroupCode'] ) && !SysGroup::where( "vGroupCode", $row['vGroupCode'] )->first()) {
                    $DaoGroup->vGroupCode = $row['vGroupCode'];
                } else {
                    $DaoGroup->vGroupCode = uniqid();
                }
                $DaoGroup->vGroupName = $row['vGroupName'];
                $DaoGroup->iUpdateTime = time();

                //$DaoGroup save
                if($DaoGroup->save()) {
                    //Logs
                    $this->_saveLogAction( $DaoGroup->getTable(), $DaoGroup->iId, 'add', json_encode( $DaoGroup ) );

                    //DaoGroupInfo
                    $DaoGroupInfo = SysGroupInfo::find( $DaoGroup->iId );
                    if(!$DaoGroupInfo) {
                        $DaoGroupInfo = new SysGroupInfo();
                        $DaoGroupInfo->iGroupId = $DaoGroup->iId;
                    }
                    $DaoGroupInfo->vGroupImage = isset( $row['vGroupImage'] ) ? (string)$row['vGroupImage'] : "";
                    $DaoGroupInfo->vGroupTitle = isset( $row['vGroupTitle'] ) ? (string)$row['vGroupTitle'] : "";
                    $DaoGroupInfo->vGroupID = isset( $row['vGroupID'] ) ? (string)$row['vGroupID'] : "";
                    $DaoGroupInfo->iGroupBirthday = isset( $row['iGroupBirthday'] ) ? (int)$row['iGroupBirthday'] : 0;
                    $DaoGroupInfo->vGroupEmail = isset( $row['vGroupEmail'] ) ? (string)$row['vGroupEmail'] : "";
                    $DaoGroupInfo->vGroupEmailDomain = isset( $row['vGroupEmailDomain'] ) ? (string)$row['vGroupEmailDomain'] : "";
                    $DaoGroupInfo->vGroupContact = isset( $row['vGroupContact'] ) ? (string)$row['vGroupContact'] : "";
                    $DaoGroupInfo->vGroupTax = isset( $row['vGroupTax'] ) ? (string)$row['vGroupTax'] : "";
                    $DaoGroupInfo->vGroupZipCode = isset( $row['vGroupZipCode'] ) ? (string)$row['vGroupZipCode'] : "";
                    $DaoGroupInfo->vGroupAddress = isset( $row['vGroupAddress'] ) ? (string)$row['vGroupAddress'] : "";
                    $DaoGroupInfo->vGroupWebsite = isset( $row['vGroupWebsite'] ) ? (string)$row['vGroupWebsite'] : "";
                    $DaoGroupInfo->vGroupNote = isset( $row['vGroupNote'] ) ? (string)$row['vGroupNote'] : "";

                    if($DaoGroupInfo->save()) {
                        //Logs
                        $this->_saveLogAction( $DaoGroupInfo->getTable(), $DaoGroupInfo->iGroupId, 'add', json_encode( $DaoGroupInfo ) );
                    }

                    $this->rtndata ['status'] = 1;
                    $this->rtndata ['message'] = trans( '_web_message.register.success' );
                    $this->rtndata ['rtnurl'] = url( 'web/' . implode( '/', $this->module ) );

                    unset( $data[$row_idx] );
                } else {
                    $this->rtndata ['status'] = 0;
                    $this->rtndata ['message'] = trans( '_web_message.register.fail' );
                }
            }

            //儲存檔案於伺服器
            $this->saveExcelFile( $data->toArray() );
            return redirect()->back()->with( 'message', 'Insert database successfully.' );
        }

        return redirect()->back()->with( 'message', 'Insert database successfully.' );
    }

    public function getListDataMap ( $row ): array
    {
        //資料庫資料
        $DaoSysGroup = SysGroup::join('sys_group_info', 'sys_group_info.iGroupId', '=', 'sys_group.iId')
            ->select( 'sys_group.*', 'sys_group_info.*' )->get();

        //iId 資料比對
        if (!empty( $row['iId'] )) {
            $DaoSysGroupMatched = $DaoSysGroup->find( (int) $row['iId'] );
            foreach ($row as $array_key => $array_value) {
                if (isset( $DaoSysGroupMatched->$array_key )) {
                    if ($DaoSysGroupMatched->$array_key == $array_value) {
                        $row[$array_key . '_flag'] = self::DATA_SYNCED;
                    } else {
                        $row[$array_key . '_flag'] = self::DATA_EDIT;
                    }
                } else {
                    $row[$array_key . '_flag'] = self::DATA_NEW;
                }
            }
        } else {
            foreach ($row as $array_key => $array_value) {
                $row[$array_key . '_flag'] = self::DATA_NEW;
            }
        }

        //iCreateTime
        $row['iCreateTime'] = date('Y/m/d H:i:s', $row->iCreateTime);

        //iUpdateTime
        $row['iUpdateTime'] = date('Y/m/d H:i:s', $row->iUpdateTime);

        //iUserBirthday
        $row['iUserBirthday'] = date('Y/m/d', $row->iUserBirthday);

        return $row->toArray();
    }

    public function importDataMap ( $row ): array
    {
        //變數Mapping
        foreach ($this->exportData as $key => $value) {
            $$key = $value;
        }

        //主鍵不存在則移除資料列
        $primaryKey = $this->primaryKey;
        if (!isset( $row->$$primaryKey ) || empty( $row->$$primaryKey )) {
            return null;
        }

        //$DaoSysMember
        $mapSysGroup[$primaryKey] = strtolower( trim( $row->$$primaryKey ) );
        $mapSysGroup['iGroupType'] = $this->iGroupType;
        if (!empty( $row->$iId )) {
            $DaoSysGroup = SysGroup::where( $mapSysGroup )->find( $row->$iId );
        } else {
            $DaoSysGroup = SysGroup::where( $mapSysGroup )->first();
        }

        //iCreateTime
        $row->$iCreateTime = strtotime( $row->$iCreateTime );

        //iUpdateTime
        $row->$iUpdateTime = strtotime( $row->$iUpdateTime );

        if($DaoSysGroup) {
            $row->$iId = $DaoSysGroup->iId;
        }

        return parent::importDataMap( $row );
    }

    public function exportDataMap ( $row ): array
    {
        //iCreateTime
        $row->iCreateTime = date('Y/m/d H:i:s', $row->iCreateTime);

        //iUpdateTime
        $row->iUpdateTime = date('Y/m/d H:i:s', $row->iUpdateTime);


        return parent::exportDataMap( $row );
    }
}