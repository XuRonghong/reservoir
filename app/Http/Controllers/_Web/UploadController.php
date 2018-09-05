<?php

namespace App\Http\Controllers\_Web;

use App\Http\Controllers\Controller;
use App\SysFiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    /*
     *
     */
    public function __construct ()
    {
        parent::__construct();
    }

    /*
     *
     */
    public function doUploadImage ( Request $request )
    {
        switch (config( 'filesystems.default' )) {
            case 's3':
                $image = $request->file( 'files' );
                $storage = Storage::disk( 's3' );
                $filename = date( 'YmdHis' ) . uniqid() . '.jpg';
                $filePath = '/' . config()->get( '_config.file_path' ) . session()->get( 'member.vUserCode' );
                $storage->put( $filePath . '/' . $filename, file_get_contents( $image ) );
                //
                $Dao = new SysFiles ();
                $Dao->iMemberId = session()->get( 'member.iId' );
                $Dao->iType = 1;
                $Dao->vFileType = 'image/jpeg';
                $Dao->vFileServer = env( 'AWS_S3_SERVER' );
                $Dao->vFilePath = '/' . env( 'AWS_BUCKET' ) . $filePath . '/';
                $Dao->vFileName = $filename;
                $Dao->iFileSize = $image->getClientSize();
                $Dao->iCreateTime = $Dao->iUpdateTime = time();
                $Dao->iStatus = 1;
                $Dao->save();
                //
                $file['name'] = $filename;
                $file['url'] = $Dao->vFileServer . $Dao->vFilePath . $Dao->vFileName;
                $this->rtndata['files'][0] = $file;
                break;
            default:
                $image = $request->file( 'files' );
                $storage = Storage::disk( 'public' );
                $filename = date( 'YmdHis' ) . uniqid() . '.jpg';
                $filePath = session()->get( 'member.vUserCode' );
                $storage->put( $filePath . '/' . $filename, file_get_contents( $image ) );

                $Dao = new SysFiles ();
                $Dao->iMemberId = session()->get( 'member.iId' );
                $Dao->iType = 2;
                $Dao->vFileType = 'image/jpeg';
                $Dao->vFileServer = env( 'APP_URL' );
                $Dao->vFilePath = '/upload/userdata/' . $filePath . '/';
                $Dao->vFileName = $filename;
                $Dao->iFileSize = $image->getClientSize();
                $Dao->iCreateTime = $Dao->iUpdateTime = time();
                $Dao->iStatus = 1;
                $Dao->save();

                $file['name'] = $filename;
                $file['url'] = $Dao->vFileServer . $Dao->vFilePath . $Dao->vFileName;
                $this->rtndata['files'][0] = $file;
        }

        return response()->json( $this->rtndata );
    }

    /*
     *
     */
    public function doUploadImageBase64 ( Request $request )
    {
        if ( !$request->exists( 'image' )) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.upload.fail' );

            return response()->json( $this->rtndata );
        }

        $image = explode( ',', $request->input( 'image' ) );
        $data = base64_decode( $image [1] );

        switch (config( 'filesystems.default' )) {
            case 's3':
                $storage = Storage::disk( 's3' );
                $filename = date( 'YmdHis' ) . uniqid() . '.jpg';
                $filePath = '/' . config()->get( '_config.file_path' ) . session()->get( 'member.vUserCode' );
                $storage->put( $filePath . '/' . $filename, $data );
                //
                $Dao = new SysFiles ();
                $Dao->iMemberId = session()->get( 'member.iId' );
                $Dao->iType = 3;
                $Dao->vFileType = 'image/jpeg';
                $Dao->vFileServer = env( 'AWS_S3_SERVER' );
                $Dao->vFilePath = '/' . env( 'AWS_BUCKET' ) . $filePath . '/';
                $Dao->vFileName = $filename;
                $Dao->iFileSize = $storage->size( $filePath . '/' . $filename );
                $Dao->iCreateTime = $Dao->iUpdateTime = time();
                $Dao->save();
                $rtndata = [
                    'fileid' => $Dao->iId,
                    'path' => $Dao->vFileServer . $Dao->vFilePath . $Dao->vFileName
                ];
                break;
            default:
                $storage = Storage::disk( 'public' );
                $filename = date( 'YmdHis' ) . uniqid() . '.jpg';
                $filePath = session()->get( 'member.vUserCode' );
                $storage->put( $filePath . '/' . $filename, $data );
                //
                $Dao = new SysFiles ();
                $Dao->iMemberId = session()->get( 'member.iId' );
                $Dao->iType = 4;
                $Dao->vFileType = 'image/jpeg';
                $Dao->vFileServer = env( 'APP_URL' );
                $Dao->vFilePath = '/upload/userdata/' . $filePath . '/';
                $Dao->vFileName = $filename;
                $Dao->iFileSize = $storage->size( $filePath . '/' . $filename );
                $Dao->iCreateTime = $Dao->iUpdateTime = time();
                $Dao->save();
                $rtndata = [
                    'fileid' => $Dao->iId,
                    'path' => $Dao->vFileServer . $Dao->vFilePath . $Dao->vFileName
                ];
        }
        $this->rtndata ['status'] = 1;
        $this->rtndata ['meta'] = $rtndata;

        return response()->json( $this->rtndata );
    }

    /*
     *
     */
    public function _addFile ( $file_info )
    {
        $Dao = new SysFiles ();
        $Dao->iMemberId = session()->get( 'member.iId' );
        $Dao->iType = 2;
        $Dao->vFileType = $file_info->type;
        $tmp_arr = explode( config()->get( '_config.file_path' ), dirname( $file_info->url ), 2 );
        $Dao->vFileServer = $tmp_arr [0];
        $Dao->vFilePath = config()->get( '_config.file_path' ) . $tmp_arr [1];
        $Dao->vFileName = $file_info->name;
        $Dao->iFileSize = $file_info->size;
        $Dao->iCreateTime = $Dao->iUpdateTime = time();
        $Dao->save();

        return $Dao->iId;
    }
}
