<?php

namespace App\Http\Controllers\_Web\_Admin\Member\Excel;

use App\SysGroup;
use App\SysGroupMember;
use App\SysMember;
use App\SysMemberInfo;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class StoreController extends _ExcelController
{
    const DATA_SYNCED = 'SYNCED';
    const DATA_NEW = 'NEW';
    const DATA_EDIT = 'EDIT';

    public $module = [ 'admin', 'member', 'excel', 'store' ];
    protected $store_name = 'member_store';
    protected $store_type = 'xls';
    protected $primaryKey = 'vAccount';
    protected $query;
    protected $exportData =
        [
            'iId' => 'ID',
            'iUserId' => '會員編號',
            'iGroupId' => '群組編號',
            'vAccount' => '帳號ID',
            'iCreateTime' => '建立時間',
            'iUpdateTime' => '修改時間',
            'vUserName' => '中文姓名',
            'vUserNameE' => '英文姓名',
            'vUserTitle' => '稱呼',
            'vUserID' => '身分證字號',
            'iUserBirthday' => '生日',
            'vUserEmail' => '通訊Email',
            'vUserContact' => '行動電話',
            'vUserZipCode' => '郵遞區號',
            'vUserCity' => '縣市',
            'vUserArea' => '鄉鎮市區',
            'vUserAddress' => '地址',
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
                //$DaoMember
                $mapMember[$this->primaryKey] = strtolower( trim( $row[$this->primaryKey] ) );
                $mapMember['vAgentCode'] = config( '_config.agent_code' );
                if (!empty( $row['iId'] )) {
                    $DaoMember = SysMember::where( $mapMember )->find( $row['iId'] );
                } else {
                    $DaoMember = SysMember::where( $mapMember )->first();
                }

                //$DaoMember userid
                if (!empty( $row['iUserId'] ) && !SysMember::where( "iUserId", $row['iUserId'] )->first()) {
                    $userid = $row['iUserId'];
                } else {
                    switch ($this->iAcType) {
                        case 31:
                            do {
                                $userid = rand( 30001, 39999 );
                                $check = SysMember::where( "iUserId", $userid )->first();
                            } while ($check);
                            break;
                        case 41:
                            do {
                                $userid = rand( config( '_config.store_userid' )[0],
                                    config( '_config.store_userid' )[1] );
                                $check = SysMember::where( "iUserId", $userid )->first();
                            } while ($check);
                            break;
                        case 61:
                            do {
                                $userid = rand( 60001, 69999 );
                                $check = SysMember::where( "iUserId", $userid )->first();
                            } while ($check);
                            break;
                        default:
                            do {
                                $userid = rand( 1000000001, 1099999999 );
                                $check = SysMember::where( "iUserId", $userid )->first();
                            } while ($check);
                    }
                }

                if(!$DaoMember) {
                    $str = md5( uniqid( mt_rand(), true ) );
                    $uuid = substr( $str, 0, 8 ) . '-';
                    $uuid .= substr( $str, 8, 4 ) . '-';
                    $uuid .= substr( $str, 12, 4 ) . '-';
                    $uuid .= substr( $str, 16, 4 ) . '-';
                    $uuid .= substr( $str, 20, 12 );
                    $DaoMember = new SysMember ();
                    $DaoMember->iUserId = $userid;
                    $DaoMember->vUserCode = $uuid;
                    $DaoMember->vAgentCode = config( '_config.agent_code' );
                    $DaoMember->iAcType = $this->iAcType;
                    $DaoMember->vPassword = hash( 'sha256', $DaoMember->vAgentCode . $row['vAccount'] . $DaoMember->vUserCode );
                    $DaoMember->iCreateTime = time();
                    $DaoMember->vCreateIP = $request->ip();
                    $DaoMember->bActive = 1;
                    $DaoMember->iStatus = 1;
                }
                $DaoMember->iUserId = $userid;
                $DaoMember->vAccount = $row['vAccount'];
                $DaoMember->iUpdateTime = time();

                //$DaoMember save
                if ($DaoMember->save()) {
                    //Logs
                    $this->_saveLogAction( $DaoMember->getTable(), $DaoMember->iId, 'add', json_encode( $DaoMember ) );

                    //DaoMemberInfo
                    $DaoMemberInfo = SysMemberInfo::find( $DaoMember->iId );
                    if(!$DaoMemberInfo) {
                        $DaoMemberInfo = new SysMemberInfo();
                        $DaoMemberInfo->iMemberId = $DaoMember->iId;
                    }
                    $DaoMemberInfo->vUserImage = "/images/empty.jpg";
                    $DaoMemberInfo->vUserName = isset($row['vUserName']) ? (string) $row['vUserName'] : "";
                    $DaoMemberInfo->vUserNameE = isset($row['vUserNameE']) ? (string) $row['vUserNameE'] : "";
                    $DaoMemberInfo->vUserTitle = isset($row['vUserTitle']) ? (string) $row['vUserTitle'] : "";
                    $DaoMemberInfo->vUserID = isset($row['vUserID']) ? (string) $row['vUserID'] : "";
                    $DaoMemberInfo->iUserBirthday = isset($row['iUserBirthday']) ? (int) $row['iUserBirthday'] : 0;
                    $DaoMemberInfo->vUserEmail = isset($row['vUserEmail']) ? (string) $row['vUserEmail'] : "";
                    $DaoMemberInfo->vUserContact = isset($row['vUserContact']) ? (string) $row['vUserContact'] : "";
                    $DaoMemberInfo->vUserZipCode = isset($row['vUserZipCode']) ? (string) $row['vUserZipCode'] : "";
                    $DaoMemberInfo->vUserCity = isset($row['vUserCity']) ? (string) $row['vUserCity'] : "";
                    $DaoMemberInfo->vUserArea = isset($row['vUserArea']) ? (string) $row['vUserArea'] : "";
                    $DaoMemberInfo->vUserAddress = isset($row['vUserAddress']) ? (string) $row['vUserAddress'] : "";

                    if($DaoMemberInfo->save()) {
                        //Logs
                        $this->_saveLogAction( $DaoMemberInfo->getTable(), $DaoMemberInfo->iMemberId, 'add', json_encode( $DaoMemberInfo ) );
                    }

                    $iGroupId = isset($row['iGroupId']) && (int) $row['iGroupId'] > 0 ? (int) $row['iGroupId'] : 0;
                    $mapGroup['iGroupType'] = $this->iGroupType;
                    $DaoGroup = SysGroup::where( $mapGroup )->find($iGroupId);
                    //DaoGroupMember
                    $DaoGroupMember = SysGroupMember::find( $DaoMember->iId );
                    if(!$DaoGroupMember) {
                        $DaoGroupMember = new SysGroupMember();
                        $DaoGroupMember->iMemberId = $DaoMember->iId;
                        $DaoGroupMember->iCreateTime = time();
                    }
                    $DaoGroupMember->iGroupId = $DaoGroup ? $iGroupId : 0;
                    $DaoGroupMember->iUpdateTime = time();
                    $DaoGroupMember->iStatus = 1;
                    if($DaoGroupMember->save()) {
                        //Logs
                        $this->_saveLogAction( $DaoGroupMember->getTable(), $DaoGroupMember->iMemberId, 'add', json_encode( $DaoGroupMember ) );
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
        $DaoSysMember = SysMember::join('sys_member_info', 'sys_member_info.iMemberId', '=', 'sys_member.iId')
            ->leftjoin( 'sys_group_member', 'sys_group_member.iMemberId', '=', 'sys_member.iId' )
            ->select( 'sys_member.*', 'sys_member_info.*', 'sys_group_member.iGroupId' )->get();

        //iId 資料比對
        if (!empty( $row['iId'] )) {
            $DaoSysMemberMatched = $DaoSysMember->find( (int) $row['iId'] );
            foreach ($row as $array_key => $array_value) {
                if (isset( $DaoSysMemberMatched->$array_key )) {
                    if ($DaoSysMemberMatched->$array_key == $array_value) {
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
        $mapSysMember[$primaryKey] = strtolower( trim( $row->$$primaryKey ) );
        if (!empty( $row->$iId )) {
            $DaoSysMember = SysMember::where( $mapSysMember )->find( $row->$iId );
        } else {
            $DaoSysMember = SysMember::where( $mapSysMember )->first();
        }

        //clean not unique
        if ($DaoSysMember) {
            if ($DaoSysMember->vAgentCode !== config( '_config.agent_code' )) {
                return null;
            }
        }

        //iCreateTime
        $row->$iCreateTime = strtotime( $row->$iCreateTime );

        //iUpdateTime
        $row->$iUpdateTime = strtotime( $row->$iUpdateTime );

        //iUserBirthday
        $row->$iUserBirthday = strtotime( $row->$iUserBirthday );

        if($DaoSysMember) {
            $row->$iId = $DaoSysMember->iId;
        }

        return parent::importDataMap( $row );
    }

    public function exportDataMap ( $row ): array
    {
        //iCreateTime
        $row->iCreateTime = date('Y/m/d H:i:s', $row->iCreateTime);

        //iUpdateTime
        $row->iUpdateTime = date('Y/m/d H:i:s', $row->iUpdateTime);

        //iUserBirthday
        $row->iUserBirthday = date('Y/m/d', $row->iUserBirthday);


        return parent::exportDataMap( $row );
    }
}