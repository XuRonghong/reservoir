<?php

namespace App\Http\Controllers;

use App\LogLogin;
use App\ModOrder;
use App\ModProductCategory;
use App\SysCategory;
use App\SysFiles;
use Illuminate\Support\Facades\Request;

class FuncController
{
    /*
     *
     */
    static function _isValidEmail ( $email )
    {
        return filter_var( $email, FILTER_VALIDATE_EMAIL ) !== false;
    }

    /*
     * PHP正則表達式-使用preg_match()過濾字串
     */
    function _isValid ( $type = 'number' , $input_text = '' )
    {
        switch ( $type ){
            //A. 檢查是不是數字
            case 'number':
                if (preg_match( "/^([0-9]+)$/", $input_text ) || strlen( $input_text ) > 99) {
                    return true;
                }
                break;
            //B. 檢查是不是小寫英文
            case 'small_english':
                if (preg_match( "/^([a-z]+)$/", $input_text ) || strlen( $input_text ) > 99) {
                    return true;
                }
                break;
            //C. 檢查是不是大寫英文
            case 'big_english':
                if (preg_match( "/^([A-Z]+)$/", $input_text ) || strlen( $input_text ) > 99) {
                    return true;
                }
                break;
            //D. 檢查是不是全為英文字串
            case 'english':
                if (preg_match( "/^([A-Za-z]+)$/", $input_text ) || strlen( $input_text ) > 99) {
                    return true;
                }
                break;
            //E. 檢查是不是英數混和字串
            case 'number+english':
                if (preg_match( "/^([0-9A-Za-z]+)$/", $input_text ) || strlen( $input_text ) > 99) {
                    return true;
                }
                break;
            //F. 檢查是不是中文
            case 'chinese':
                if (preg_match( "/^([\x7f-\xff]+)$/", $input_text ) || strlen( $input_text ) > 99) {
                    return true;
                }
                break;
        }
        return false;
    }

    /*
     *
     */
    function _isValidIDNum ( $id )
    {
        //建立字母分數陣列
        $head = [ 'A' => 1, 'I' => 39, 'O' => 48, 'B' => 10, 'C' => 19, 'D' => 28,
            'E' => 37, 'F' => 46, 'G' => 55, 'H' => 64, 'J' => 73, 'K' => 82,
            'L' => 2, 'M' => 11, 'N' => 20, 'P' => 29, 'Q' => 38, 'R' => 47,
            'S' => 56, 'T' => 65, 'U' => 74, 'V' => 83, 'W' => 21, 'X' => 3,
            'Y' => 12, 'Z' => 30 ];
        //建立加權基數陣列
        $multiply = [ 8, 7, 6, 5, 4, 3, 2, 1 ];
        //檢查身份字格式是否正確
        if (preg_match( "/^[a-zA-Z][1-2][0-9]+$/", $id ) && strlen( $id ) == 10) {
            //切開字串
            $len = strlen( $id );
            for ($i = 0 ; $i < $len ; $i++) {
                $stringArray[$i] = substr( $id, $i, 1 );
            }
            //取得字母分數
            $total = $head[array_shift( $stringArray )];
            //取得比對碼
            $point = array_pop( $stringArray );
            //取得數字分數
            $len = count( $stringArray );
            for ($j = 0 ; $j < $len ; $j++) {
                $total += $stringArray[$j] * $multiply[$j];
            }
            //檢查比對碼
            if (( $total % 10 == 0 ) ? 0 : 10 - $total % 10 != $point) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    /*
     *
     */

    static function _checkOrderDisable ()
    {
        ModOrder::where( 'iPayStatus', 0 )->where( 'iCreateTime', '<', time() - config( '_config.order_limit_time' ) )->update( [ 'iStatus' => 2 ] );
    }

    /*
     *
     */
    static function _getFilePathById ( $file_id, $folder_name = "" )
    {
        $map['iStatus'] = 1;
        $map['bDel'] = 0;
        $Dao = SysFiles::where( $map )->find( $file_id );
        if ($Dao) {
            return $Dao->vFileServer . $Dao->vFilePath . $Dao->vFileName;
        } else {
            return asset( '/images/empty.jpg' );
        }
    }

    /*
     *
     */
    static function _getMuseumNameById ( $museum_id )
    {
        $map['iCategoryType'] = config( '_config.sys_category.museum.type' );
        $map['iParentId'] = config( '_config.sys_category.museum.pid' );
        $map['vCategoryValue'] = $museum_id;

        return SysCategory::where( $map )->value( 'vCategoryName' );
    }

    /*
     *
     */
    static function _get_https_url ()
    {
        $https = !empty ( $_SERVER ['HTTPS'] ) && strcasecmp( $_SERVER ['HTTPS'], 'on' ) === 0 || !empty ( $_SERVER ['HTTP_X_FORWARDED_PROTO'] ) && strcasecmp( $_SERVER ['HTTP_X_FORWARDED_PROTO'], 'https' ) === 0;

        return ( $https ? 'https://' : 'http://' );
    }

    /*
     *
     */
    static function _get_full_url ()
    {
        $https = !empty ( $_SERVER ['HTTPS'] ) && strcasecmp( $_SERVER ['HTTPS'], 'on' ) === 0 || !empty ( $_SERVER ['HTTP_X_FORWARDED_PROTO'] ) && strcasecmp( $_SERVER ['HTTP_X_FORWARDED_PROTO'], 'https' ) === 0;

        return ( $https ? 'https://' : 'http://' ) . ( !empty ( $_SERVER ['REMOTE_USER'] ) ? $_SERVER ['REMOTE_USER'] . '@' : '' ) . ( isset ( $_SERVER ['HTTP_HOST'] ) ? $_SERVER ['HTTP_HOST'] : ( $_SERVER ['SERVER_NAME'] . ( $https && $_SERVER ['SERVER_PORT'] === 443 || $_SERVER ['SERVER_PORT'] === 80 ? '' : ':' . $_SERVER ['SERVER_PORT'] ) ) ) . substr( $_SERVER ['SCRIPT_NAME'], 0, strrpos( $_SERVER ['SCRIPT_NAME'], '/' ) );
    }

    /*
     * CategoryNum
     * iCategoryId
     */
    static function _getCategoryNum ( $iCategoryId )
    {
        $vCategoryNum = "";
        $Dao = ModProductCategory::select(
            'iParentId',
            'vCategoryValue as category_num_2' )->find( $iCategoryId );
        $DaoCategory = ModProductCategory::join( 'sys_category', function( $join ) {
            $join->on( 'sys_category.iId', '=', 'mod_product_category.iCategoryType' );
        } )->select(
            'sys_category.vCategoryValue as category_num',
            'mod_product_category.vCategoryValue as category_num_1'
        )->find( $Dao->iParentId );
        $vCategoryNum = $DaoCategory->category_num . $DaoCategory->category_num_1 . $Dao->category_num_2;

        return $vCategoryNum;
    }

    /*
     *
     */
    static function _addLog ( $action )
    {
        $Dao = new LogLogin();
        $Dao->iStoreId = session( 'store.iId', 0 );
        $Dao->iMemberId = session( 'member.iId', 0 );
        $Dao->vAction = $action;
        $Dao->iDateTime = time();
        $Dao->vIP = Request::ip();
        $Dao->save();
    }

    /**
     * @param $url 请求网址
     * @param bool $params 请求参数
     * @param int $ispost 请求方式
     * @param int $https https协议
     * @return bool|mixed
     */
    static function curl ( $url, $https = 1, $ispost = 0, $params = false )
    {
        $httpInfo = [];
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1 );
        curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 30 );
        curl_setopt( $ch, CURLOPT_TIMEOUT, 30 );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        if ($https) {
            curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false ); // 对认证证书来源的检查
            curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false ); // 从证书中检查SSL加密算法是否存在
        }
        if ($ispost) {
            curl_setopt( $ch, CURLOPT_POST, true );
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $params );
            curl_setopt( $ch, CURLOPT_URL, $url );
        } else {
            if ($params) {
                if (is_array( $params )) {
                    $params = http_build_query( $params );
                }
                curl_setopt( $ch, CURLOPT_URL, $url . '?' . $params );
            } else {
                curl_setopt( $ch, CURLOPT_URL, $url );
            }
        }

        $response = curl_exec( $ch );

        if ($response === false) {
            //echo "cURL Error: " . curl_error($ch);
            return false;
        }
        $httpCode = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
        $httpInfo = array_merge( $httpInfo, curl_getinfo( $ch ) );
        curl_close( $ch );

        return $response;
    }
}
