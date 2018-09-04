<?php
// php artisan db:seed
// php artisan db:seed --class SysMenuTableSeeder

use Illuminate\Database\Seeder;
use App\SysMenu;

class SysMenuTableSeeder extends Seeder
{
	protected $table = 'sys_menu';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data_arr = [
            // admin
            [
                //管理員功能
                "iId" => 1,
                "vName" => "admin",
                "vUrl" => "",
                "vCss" => "fa-power-off",
                "bSubMenu" => 1,
                "iParentId" => 0,
                "vAccess" => "1,2",
                "bOpen" => 1,
                "child" =>
                    [
                        [
                            //帳號管理
                            "iId" => 11,
                            "vName" => "admin.member",
                            "vUrl" => "",
                            "vCss" => "",
                            "bSubMenu" => 1,
                            "iParentId" => 1,
                            "vAccess" => "1,2",
                            "bOpen" => 1,
                            "child" =>
                                [
                                    [
                                        //一般會員管理
                                        "iId" => 111,
                                        "vName" => "admin.member.customer",
                                        "vUrl" => "web/admin/member/customer",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 11,
                                        "vAccess" => "1,2",
                                        "bOpen" => 1,
                                    ],
                                    [
                                        //部門成員管理
                                        "iId" => 112,
                                        "vName" => "admin.member.employee",
                                        "vUrl" => "web/admin/member/employee",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 11,
                                        "vAccess" => "1,2",
                                        "bOpen" => 1,
                                    ],
                                    [
                                        //店家會員管理
                                        "iId" => 113,
                                        "vName" => "admin.member.store",
                                        "vUrl" => "web/admin/member/store",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 11,
                                        "vAccess" => "1,2",
                                        "bOpen" => 1,
                                    ],
                                    [
                                        //部落客會員管理
                                        "iId" => 114,
                                        "vName" => "admin.member.blogger",
                                        "vUrl" => "web/admin/member/blogger",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 11,
                                        "vAccess" => "1,2",
                                        "bOpen" => 1,
                                    ],
                                    [
                                        //供應商會員管理
                                        "iId" => 115,
                                        "vName" => "admin.member.supplier",
                                        "vUrl" => "web/admin/member/supplier",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 11,
                                        "vAccess" => "1,2",
                                        "bOpen" => 1,
                                    ],
                                ]
                        ],
                        [
                            //群組管理
                            "iId" => 12,
                            "vName" => "admin.group",
                            "vUrl" => "",
                            "vCss" => "",
                            "bSubMenu" => 1,
                            "iParentId" => 1,
                            "vAccess" => "1,2",
                            "bOpen" => 1,
                            "child" =>
                                [
                                    [
                                        //一般會員管理
                                        "iId" => 121,
                                        "vName" => "admin.group.customer",
                                        "vUrl" => "web/admin/group/customer",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 12,
                                        "vAccess" => "1,2",
                                        "bOpen" => 1,
                                    ],
                                    [
                                        //部門成員管理
                                        "iId" => 122,
                                        "vName" => "admin.group.employee",
                                        "vUrl" => "web/admin/group/employee",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 12,
                                        "vAccess" => "1,2",
                                        "bOpen" => 1,
                                    ],
                                    [
                                        //店家會員管理
                                        "iId" => 123,
                                        "vName" => "admin.group.store",
                                        "vUrl" => "web/admin/group/store",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 12,
                                        "vAccess" => "1,2",
                                        "bOpen" => 1,
                                    ],
                                    [
                                        //部落客會員管理
                                        "iId" => 124,
                                        "vName" => "admin.group.blogger",
                                        "vUrl" => "web/admin/group/blogger",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 12,
                                        "vAccess" => "1,2",
                                        "bOpen" => 1,
                                    ],
                                    [
                                        //供應商會員管理
                                        "iId" => 125,
                                        "vName" => "admin.group.supplier",
                                        "vUrl" => "web/admin/group/supplier",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 12,
                                        "vAccess" => "1,2",
                                        "bOpen" => 1,
                                    ],
                                ]
                        ],
                        [
                            //匯率管理
                            "iId" => 13,
                            "vName" => "admin.exchange_rate",
                            "vUrl" => "",
                            "vCss" => "",
                            "bSubMenu" => 1,
                            "iParentId" => 1,
                            "vAccess" => "1,2",
                            "bOpen" => 0,
                            "child" =>
                                [
                                    [
                                        //匯率設定
                                        "iId" => 131,
                                        "vName" => "admin.exchange_rate.index",
                                        "vUrl" => "web/admin/exchange_rate/index",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 13,
                                        "vAccess" => "1,2",
                                        "bOpen" => 1,
                                    ],
                                    [
                                        //歷史匯率
                                        "iId" => 132,
                                        "vName" => "admin.exchange_rate.log",
                                        "vUrl" => "web/admin/exchange_rate/log",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 13,
                                        "vAccess" => "1,2",
                                        "bOpen" => 1,
                                    ],
                                ]
                        ],
                        [
                            //系統類別設置
                            "iId" => 14,
                            "vName" => "admin.category",
                            "vUrl" => "web/admin/category",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 1,
                            "vAccess" => "1,2",
                            "bOpen" => 1,
                        ],
                        [
                            //系統參數設置
                            "iId" => 17,
                            "vName" => "admin.config",
                            "vUrl" => "web/admin/config",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 1,
                            "vAccess" => "1,2",
                            "bOpen" => 1,
                        ],
                    ],
            ],
            //
            [
                //分會分館館理
                "iId" => 2,
                "vName" => "museum",
                "vUrl" => "",
                "vCss" => "fa-cubes",
                "bSubMenu" => 1,
                "iParentId" => 0,
                "vAccess" => "1,2",
                "bOpen" => 0,
                "child" =>
                    [
                        [
                            //A01
                            "iId" => 201,
                            "vName" => "museum.a01",
                            "vUrl" => "web/museum/a01",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 2,
                            "vAccess" => "1,2",
                            "bOpen" => 1,
                        ],
                        [
                            //A02
                            "iId" => 202,
                            "vName" => "museum.a02",
                            "vUrl" => "web/museum/a02",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 2,
                            "vAccess" => "1,2",
                            "bOpen" => 1,
                        ],
                        [
                            //A03
                            "iId" => 203,
                            "vName" => "museum.a03",
                            "vUrl" => "web/museum/a03",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 2,
                            "vAccess" => "1,2",
                            "bOpen" => 1,
                        ],
                        [
                            //A04
                            "iId" => 204,
                            "vName" => "museum.a04",
                            "vUrl" => "web/museum/a04",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 2,
                            "vAccess" => "1,2",
                            "bOpen" => 1,
                        ],
                        [
                            //A05
                            "iId" => 205,
                            "vName" => "museum.a05",
                            "vUrl" => "web/museum/a05",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 2,
                            "vAccess" => "1,2",
                            "bOpen" => 1,
                        ],
                        [
                            //A06
                            "iId" => 206,
                            "vName" => "museum.a06",
                            "vUrl" => "web/museum/a06",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 2,
                            "vAccess" => "1,2",
                            "bOpen" => 1,
                        ],
                        [
                            //A07
                            "iId" => 207,
                            "vName" => "museum.a07",
                            "vUrl" => "web/museum/a07",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 2,
                            "vAccess" => "1,2",
                            "bOpen" => 1,
                        ],
                        [
                            //A08
                            "iId" => 208,
                            "vName" => "museum.a08",
                            "vUrl" => "web/museum/a08",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 2,
                            "vAccess" => "1,2",
                            "bOpen" => 1,
                        ],
                        [
                            //A09
                            "iId" => 209,
                            "vName" => "museum.a09",
                            "vUrl" => "web/museum/a09",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 2,
                            "vAccess" => "1,2",
                            "bOpen" => 1,
                        ],
                        [
                            //A10
                            "iId" => 210,
                            "vName" => "museum.a10",
                            "vUrl" => "web/museum/a10",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 2,
                            "vAccess" => "1,2",
                            "bOpen" => 1,
                        ],
                        [
                            //A11
                            "iId" => 211,
                            "vName" => "museum.a11",
                            "vUrl" => "web/museum/a11",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 2,
                            "vAccess" => "1,2",
                            "bOpen" => 1,
                        ],
                        [
                            //A12
                            "iId" => 212,
                            "vName" => "museum.a12",
                            "vUrl" => "web/museum/a12",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 2,
                            "vAccess" => "1,2",
                            "bOpen" => 1,
                        ],
                    ]
            ],
            //
            [
                //組織章程
                "iId" => 3,
                "vName" => "organization",
                "vUrl" => "",
                "vCss" => "fa-cubes",
                "bSubMenu" => 1,
                "iParentId" => 0,
                "vAccess" => "1,2",
                "bOpen" => 0,
                "child" =>
                    [
                        [
                            //
                            "iId" => 301,
                            "vName" => "organization.index",
                            "vUrl" => "web/organization/index",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 3,
                            "vAccess" => "1,2",
                            "bOpen" => 1,
                        ],
                    ]
            ],
            //
            [
                //素材管理
                "iId" => 4,
                "vName" => "material",
                "vUrl" => "",
                "vCss" => "fa-cubes",
                "bSubMenu" => 1,
                "iParentId" => 0,
                "vAccess" => "1,2",
                "bOpen" => 0,
                "child" =>
                    [
                        [
                            //
                            "iId" => 401,
                            "vName" => "material.images",
                            "vUrl" => "web/material/images",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 4,
                            "vAccess" => "1,2",
                            "bOpen" => 1,
                        ],
                    ]
            ],
            //
            [
                //廣告管理
                "iId" => 5,
                "vName" => "advertising",
                "vUrl" => "",
                "vCss" => "fa-cubes",
                "bSubMenu" => 1,
                "iParentId" => 0,
                "vAccess" => "1,2",
                "bOpen" => 0,
                "child" =>
                    [
                        [
                            //平台推薦商品管理
                            "iId" => 501,
                            "vName" => "advertising.recommend",
                            "vUrl" => "web/advertising/recommend",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 5,
                            "vAccess" => "1,2",
                            "bOpen" => 1,
                        ],
                        [
                            //Keyword
                            "iId" => 502,
                            "vName" => "advertising.keyword",
                            "vUrl" => "",
                            "vCss" => "",
                            "bSubMenu" => 1,
                            "iParentId" => 5,
                            "vAccess" => "1,2",
                            "bOpen" => 1,
                            "child" =>
                                [
                                    [
                                        //Keyword
                                        "iId" => 50201,
                                        "vName" => "advertising.keyword.index",
                                        "vUrl" => "web/advertising/keyword/index",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 502,
                                        "vAccess" => "1,2",
                                        "bOpen" => 1,
                                    ],
                                    [
                                        //Keyword
                                        "iId" => 50202,
                                        "vName" => "advertising.keyword.log",
                                        "vUrl" => "web/advertising/keyword/log",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 502,
                                        "vAccess" => "1,2",
                                        "bOpen" => 1,
                                    ],
                                ]
                        ],
                        [
                            //promotions
                            "iId" => 503,
                            "vName" => "advertising.promotions",
                            "vUrl" => "",
                            "vCss" => "",
                            "bSubMenu" => 1,
                            "iParentId" => 5,
                            "vAccess" => "1,2",
                            "bOpen" => 0,
                            "child" =>
                                [
                                    [
                                        //滿額折扣
                                        "iId" => 50301,
                                        "vName" => "advertising.promotions.full_amount_m01",
                                        "vUrl" => "web/advertising/promotions/full_amount_m01",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 503,
                                        "vAccess" => "1,2",
                                        "bOpen" => 1,
                                    ],
                                    [
                                        //滿額贈品
                                        "iId" => 50302,
                                        "vName" => "advertising.promotions.full_amount_m02",
                                        "vUrl" => "web/advertising/promotions/full_amount_m02",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 503,
                                        "vAccess" => "1,2",
                                        "bOpen" => 1,
                                    ],
                                    [
                                        //滿件折扣
                                        "iId" => 50303,
                                        "vName" => "advertising.promotions.full_amount_m03",
                                        "vUrl" => "web/advertising/promotions/full_amount_m03",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 503,
                                        "vAccess" => "1,2",
                                        "bOpen" => 1,
                                    ],
                                    [
                                        //任選活動
                                        "iId" => 50304,
                                        "vName" => "advertising.promotions.choose",
                                        "vUrl" => "web/advertising/promotions/choose",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 503,
                                        "vAccess" => "1,2",
                                        "bOpen" => 1,
                                    ],
                                    [
                                        //天天特價
                                        "iId" => 50305,
                                        "vName" => "advertising.promotions.day_by_day",
                                        "vUrl" => "web/advertising/promotions/day_by_day",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 503,
                                        "vAccess" => "1,2",
                                        "bOpen" => 1,
                                    ],
                                ],
                        ],
                        [
                            //紅配綠
                            "iId" => 504,
                            "vName" => "advertising.red_with_green",
                            "vUrl" => "",
                            "vCss" => "",
                            "bSubMenu" => 1,
                            "iParentId" => 5,
                            "vAccess" => "1,2",
                            "bOpen" => 0,
                            "child" =>
                                [
                                    [
                                        //紅標商品
                                        "iId" => 50401,
                                        "vName" => "advertising.red_with_green.promo_p01",
                                        "vUrl" => "web/advertising/red_with_green/promo_p01",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 504,
                                        "vAccess" => "1,2",
                                        "bOpen" => 1,
                                    ],
                                    [
                                        //綠標商品
                                        "iId" => 50402,
                                        "vName" => "advertising.red_with_green.promo_p02",
                                        "vUrl" => "web/advertising/red_with_green/promo_p02",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 504,
                                        "vAccess" => "1,2",
                                        "bOpen" => 1,
                                    ],
                                ]
                        ],
                        [
                            //電子禮券
                            "iId" => 505,
                            "vName" => "advertising.e_gift",
                            "vUrl" => "",
                            "vCss" => "",
                            "bSubMenu" => 1,
                            "iParentId" => 5,
                            "vAccess" => "1,2",
                            "bOpen" => 0,
                            "child" =>
                                [
                                    [
                                        //電子禮券
                                        "iId" => 50501,
                                        "vName" => "advertising.e_gift.index",
                                        "vUrl" => "web/advertising/e_gift/index",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 505,
                                        "vAccess" => "1,2",
                                        "bOpen" => 1,
                                    ],
                                    [
                                        //領取人名單
                                        "iId" => 50502,
                                        "vName" => "advertising.e_gift.member",
                                        "vUrl" => "web/advertising/e_gift/member",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 505,
                                        "vAccess" => "1,2",
                                        "bOpen" => 1,
                                    ],
                                ]
                        ],
                        [
                            //實體禮券
                            "iId" => 506,
                            "vName" => "advertising.gift",
                            "vUrl" => "",
                            "vCss" => "",
                            "bSubMenu" => 1,
                            "iParentId" => 5,
                            "vAccess" => "1,2",
                            "bOpen" => 0,
                            "child" =>
                                [
                                    [
                                        //電子禮券
                                        "iId" => 50601,
                                        "vName" => "advertising.gift.index",
                                        "vUrl" => "web/advertising/gift/index",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 506,
                                        "vAccess" => "1,2",
                                        "bOpen" => 1,
                                    ],
                                    [
                                        //領取人名單
                                        "iId" => 50602,
                                        "vName" => "advertising.gift.member",
                                        "vUrl" => "web/advertising/gift/member",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 506,
                                        "vAccess" => "1,2",
                                        "bOpen" => 1,
                                    ],
                                ]
                        ],
                        [
                            //e-paper
                            "iId" => 507,
                            "vName" => "advertising.e_paper",
                            "vUrl" => "",
                            "vCss" => "",
                            "bSubMenu" => 1,
                            "iParentId" => 5,
                            "vAccess" => "1,2",
                            "bOpen" => 0,
                            "child" =>
                                [
                                    [
                                        //電子報管理
                                        "iId" => 50701,
                                        "vName" => "advertising.e_paper.index",
                                        "vUrl" => "web/advertising/e_paper/index",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 507,
                                        "vAccess" => "1,2",
                                        "bOpen" => 1,
                                    ],
                                    [
                                        //收件人管理
                                        "iId" => 50702,
                                        "vName" => "advertising.e_paper.member",
                                        "vUrl" => "web/advertising/e_paper/member",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 507,
                                        "vAccess" => "1,2",
                                        "bOpen" => 1,
                                    ],
                                ]
                        ],
                    ]
            ],
            //
            [
                //介面管理
                "iId" => 6,
                "vName" => "scenes",
                "vUrl" => "",
                "vCss" => "fa-cubes",
                "bSubMenu" => 1,
                "iParentId" => 0,
                "vAccess" => "1,2",
                "bOpen" => 1,
                "child" =>
                    [
                        [
                            //登入畫面
                            "iId" => 601,
                            "vName" => "scenes.login",
                            "vUrl" => "",
                            "vCss" => "",
                            "bSubMenu" => 1,
                            "iParentId" => 6,
                            "vAccess" => "1,2",
                            "bOpen" => 1,
                            "child" =>
                                [
                                    [
                                        //背景圖
                                        "iId" => 60101,
                                        "vName" => "scenes.login.background",
                                        "vUrl" => "web/scenes/login/background",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 601,
                                        "vAccess" => "1,2",
                                        "bOpen" => 1,
                                    ],
                                ]
                        ],
                        [
                            //首頁畫面
                            "iId" => 602,
                            "vName" => "scenes.home",
                            "vUrl" => "",
                            "vCss" => "",
                            "bSubMenu" => 1,
                            "iParentId" => 6,
                            "vAccess" => "1,2",
                            "bOpen" => 1,
                            "child" =>
                                [
                                    [
                                        //滑動圖
                                        "iId" => 60201,
                                        "vName" => "scenes.home.slider",
                                        "vUrl" => "web/scenes/home/slider",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 602,
                                        "vAccess" => "1,2",
                                        "bOpen" => 1,
                                    ],
                                ]
                        ],
                        [
                            //header畫面
                            "iId" => 603,
                            "vName" => "scenes.header",
                            "vUrl" => "",
                            "vCss" => "",
                            "bSubMenu" => 1,
                            "iParentId" => 6,
                            "vAccess" => "1,2",
                            "bOpen" => 1,
                            "child" =>
                                [
                                    [
                                        //連結編輯
                                        "iId" => 60301,
                                        "vName" => "scenes.header.url",
                                        "vUrl" => "web/scenes/header/url",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 603,
                                        "vAccess" => "1,2",
                                        "bOpen" => 1,
                                    ],
                                ]
                        ],
                        [
                            //footer畫面
                            "iId" => 604,
                            "vName" => "scenes.footer",
                            "vUrl" => "",
                            "vCss" => "",
                            "bSubMenu" => 1,
                            "iParentId" => 6,
                            "vAccess" => "1,2",
                            "bOpen" => 1,
                            "child" =>
                                [
                                    [
                                        //連結編輯
                                        "iId" => 60401,
                                        "vName" => "scenes.footer.url",
                                        "vUrl" => "web/scenes/footer/url",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 604,
                                        "vAccess" => "1,2",
                                        "bOpen" => 1,
                                    ],
                                ]
                        ],
                        [
                            //類別畫面
                            "iId" => 605,
                            "vName" => "scenes.category",
                            "vUrl" => "",
                            "vCss" => "",
                            "bSubMenu" => 1,
                            "iParentId" => 6,
                            "vAccess" => "1,2",
                            "bOpen" => 1,
                            "child" =>
                                [
                                    [
                                        //圖片編輯
                                        "iId" => 60501,
                                        "vName" => "scenes.category.banner",
                                        "vUrl" => "web/scenes/category/banner",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 605,
                                        "vAccess" => "1,2",
                                        "bOpen" => 1,
                                    ],
                                ]
                        ],
                        [
                            //商品畫面
                            "iId" => 606,
                            "vName" => "scenes.product",
                            "vUrl" => "",
                            "vCss" => "",
                            "bSubMenu" => 1,
                            "iParentId" => 6,
                            "vAccess" => "1,2",
                            "bOpen" => 1,
                            "child" =>
                                [
                                    [
                                        //圖片編輯
                                        "iId" => 60601,
                                        "vName" => "scenes.product.banner",
                                        "vUrl" => "web/scenes/product/banner",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 606,
                                        "vAccess" => "1,2",
                                        "bOpen" => 1,
                                    ],
                                ]
                        ],
                        [
                            //購物車畫面
                            "iId" => 607,
                            "vName" => "scenes.cart",
                            "vUrl" => "",
                            "vCss" => "",
                            "bSubMenu" => 1,
                            "iParentId" => 6,
                            "vAccess" => "1,2",
                            "bOpen" => 1,
                            "child" =>
                                [
                                    [
                                        //圖片編輯
                                        "iId" => 60701,
                                        "vName" => "scenes.cart.banner",
                                        "vUrl" => "web/scenes/cart/banner",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 607,
                                        "vAccess" => "1,2",
                                        "bOpen" => 1,
                                    ],
                                ]
                        ],
                        [
                            //訂單畫面
                            "iId" => 608,
                            "vName" => "scenes.order",
                            "vUrl" => "",
                            "vCss" => "",
                            "bSubMenu" => 1,
                            "iParentId" => 6,
                            "vAccess" => "1,2",
                            "bOpen" => 1,
                            "child" =>
                                [
                                    [
                                        //圖片編輯
                                        "iId" => 60801,
                                        "vName" => "scenes.order.banner",
                                        "vUrl" => "web/scenes/order/banner",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 608,
                                        "vAccess" => "1,2",
                                        "bOpen" => 1,
                                    ],
                                ]
                        ],
                        [
                            //消息畫面
                            "iId" => 609,
                            "vName" => "scenes.reservoir",
                            "vUrl" => "",
                            "vCss" => "",
                            "bSubMenu" => 1,
                            "iParentId" => 6,
                            "vAccess" => "1,2",
                            "bOpen" => 1,
                            "child" =>
                                [
                                    [
                                        //圖片編輯
                                        "iId" => 60901,
                                        "vName" => "scenes.reservoir.banner",
                                        "vUrl" => "web/scenes/reservoir/banner",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 609,
                                        "vAccess" => "1,2",
                                        "bOpen" => 1,
                                    ],
                                ]
                        ],
                        [
                            //會員畫面
                            "iId" => 610,
                            "vName" => "scenes.member_center",
                            "vUrl" => "",
                            "vCss" => "",
                            "bSubMenu" => 1,
                            "iParentId" => 6,
                            "vAccess" => "1,2",
                            "bOpen" => 1,
                            "child" =>
                                [
                                    [
                                        //圖片編輯
                                        "iId" => 61001,
                                        "vName" => "scenes.member_center.banner",
                                        "vUrl" => "web/scenes/member_center/banner",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 610,
                                        "vAccess" => "1,2",
                                        "bOpen" => 1,
                                    ],
                                ]
                        ],
                    ]
            ],
            //
            [
                //功能保留區
                "iId" => 7,
                "vName" => "admin",
                "vUrl" => "web/admin",
                "vCss" => "",
                "bSubMenu" => 0,
                "iParentId" => 0,
                "vAccess" => "1,2",
                "bOpen" => 0,
            ],
            //
            [
                //功能保留區
                "iId" => 8,
                "vName" => "admin",
                "vUrl" => "web/admin",
                "vCss" => "",
                "bSubMenu" => 0,
                "iParentId" => 0,
                "vAccess" => "1,2",
                "bOpen" => 0,
            ],
            //
            [
                //功能保留區
                "iId" => 9,
                "vName" => "admin",
                "vUrl" => "web/admin",
                "vCss" => "",
                "bSubMenu" => 0,
                "iParentId" => 0,
                "vAccess" => "1,2",
                "bOpen" => 0,
            ],
            // product
            [
                //商品管理
                "iId" => 1001,
                "vName" => "product",
                "vUrl" => "",
                "vCss" => "fa-cubes",
                "bSubMenu" => 1,
                "iParentId" => 0,
                "vAccess" => "1,2,11,12",
                "bOpen" => 1,
                "child" =>
                    [
                        [
                            //商品類別設置
                            "iId" => 10011,
                            "vName" => "product.category",
                            "vUrl" => "web/product/category",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 1001,
                            "vAccess" => "1,2,11,12",
                            "bOpen" => 1,
                            "iRank" => 1
                        ],
                        [
                            //商品管理
                            "iId" => 10012,
                            "vName" => "product.manage",
                            "vUrl" => "",
                            "vCss" => "",
                            "bSubMenu" => 1,
                            "iParentId" => 1001,
                            "vAccess" => "1,2,11,12",
                            "bOpen" => 1,
                            "iRank" => 2,
                            "child" =>
                                [
                                    [
                                        //
                                        "iId" => 1001201,
                                        "vName" => "product.manage.museum_a01",
                                        "vUrl" => "web/product/manage/museum_a01",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 10012,
                                        "vAccess" => "1,2",
                                        "bOpen" => 1,
                                    ],
                                    [
                                        //
                                        "iId" => 1001202,
                                        "vName" => "product.manage.museum_a02",
                                        "vUrl" => "web/product/manage/museum_a02",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 10012,
                                        "vAccess" => "1,2",
                                        "bOpen" => 0,
                                    ],
                                    [
                                        //
                                        "iId" => 1001203,
                                        "vName" => "product.manage.museum_a03",
                                        "vUrl" => "web/product/manage/museum_a03",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 10012,
                                        "vAccess" => "1,2",
                                        "bOpen" => 0,
                                    ],
                                    [
                                        //
                                        "iId" => 1001204,
                                        "vName" => "product.manage.museum_a04",
                                        "vUrl" => "web/product/manage/museum_a04",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 10012,
                                        "vAccess" => "1,2",
                                        "bOpen" => 0,
                                    ],
                                    [
                                        //
                                        "iId" => 1001205,
                                        "vName" => "product.manage.museum_a05",
                                        "vUrl" => "web/product/manage/museum_a05",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 10012,
                                        "vAccess" => "1,2",
                                        "bOpen" => 0,
                                    ],
                                    [
                                        //
                                        "iId" => 1001206,
                                        "vName" => "product.manage.museum_a06",
                                        "vUrl" => "web/product/manage/museum_a06",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 10012,
                                        "vAccess" => "1,2",
                                        "bOpen" => 0,
                                    ],
                                    [
                                        //
                                        "iId" => 1001207,
                                        "vName" => "product.manage.museum_a07",
                                        "vUrl" => "web/product/manage/museum_a07",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 10012,
                                        "vAccess" => "1,2",
                                        "bOpen" => 0,
                                    ],
                                    [
                                        //
                                        "iId" => 1001208,
                                        "vName" => "product.manage.museum_a08",
                                        "vUrl" => "web/product/manage/museum_a08",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 10012,
                                        "vAccess" => "1,2",
                                        "bOpen" => 0,
                                    ],
                                    [
                                        //
                                        "iId" => 1001209,
                                        "vName" => "product.manage.museum_a09",
                                        "vUrl" => "web/product/manage/museum_a09",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 10012,
                                        "vAccess" => "1,2",
                                        "bOpen" => 0,
                                    ],
                                    [
                                        //
                                        "iId" => 1001210,
                                        "vName" => "product.manage.museum_a10",
                                        "vUrl" => "web/product/manage/museum_a10",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 10012,
                                        "vAccess" => "1,2",
                                        "bOpen" => 0,
                                    ],
                                    [
                                        //
                                        "iId" => 1001211,
                                        "vName" => "product.manage.museum_a11",
                                        "vUrl" => "web/product/manage/museum_a11",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 10012,
                                        "vAccess" => "1,2",
                                        "bOpen" => 0,
                                    ],
                                    [
                                        //
                                        "iId" => 1001212,
                                        "vName" => "product.manage.museum_a12",
                                        "vUrl" => "web/product/manage/museum_a12",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 10012,
                                        "vAccess" => "1,2",
                                        "bOpen" => 0,
                                    ],
                                ]
                        ],
                        [
                            //運費管理
                            "iId" => 10013,
                            "vName" => "product.shipping",
                            "vUrl" => "web/product/shipping",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 1001,
                            "vAccess" => "1,2,11,12",
                            "bOpen" => 1,
                            "iRank" => 3
                        ],
                        [
                            //付款方式
                            "iId" => 10014,
                            "vName" => "product.pay",
                            "vUrl" => "web/product/pay",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 1001,
                            "vAccess" => "1,2,11,12",
                            "bOpen" => 1,
                            "iRank" => 4
                        ],
                        [
                            //商品修改記錄
                            "iId" => 10019,
                            "vName" => "product.log",
                            "vUrl" => "web/product/log",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 1001,
                            "vAccess" => "1,2",
                            "bOpen" => 1,
                            "iRank" => 9
                        ],
                    ],
            ],
            // order
            [
                //訂單管理
                "iId" => 2001,
                "vName" => "order",
                "vUrl" => "",
                "vCss" => "fa-list",
                "bSubMenu" => 1,
                "iParentId" => 0,
                "vAccess" => "1,2,11,12",
                "bOpen" => 1,
                "child" =>
                    [
                        [
                            //商品訂單
                            "iId" => 20011,
                            "vName" => "order.product",
                            "vUrl" => "web/order/product",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 2001,
                            "vAccess" => "1,2,11,12",
                            "bOpen" => 1,
                        ],
                    ]
            ],
            // activity
            [
                //活動管理
                "iId" => 3001,
                "vName" => "activity",
                "vUrl" => "",
                "vCss" => "fa-list",
                "bSubMenu" => 1,
                "iParentId" => 0,
                "vAccess" => "1,2,11,12",
                "bOpen" => 1,
                "child" =>
                    [
                        [
                            //優惠券
                            "iId" => 30011,
                            "vName" => "activity.coupon",
                            "vUrl" => "",
                            "vCss" => "",
                            "bSubMenu" => 1,
                            "iParentId" => 3001,
                            "vAccess" => "1,2,11,12",
                            "bOpen" => 0,
                            "child" =>
                                [
                                    [
                                        //優惠券
                                        "iId" => 300111,
                                        "vName" => "activity.coupon.ticket",
                                        "vUrl" => "web/activity/coupon/ticket",
                                        "vCss" => "",
                                        "bSubMenu" => 1,
                                        "iParentId" => 30011,
                                        "vAccess" => "1,2,11,12",
                                        "bOpen" => 0,
                                    ],
                                    [
                                        //優惠代碼
                                        "iId" => 300112,
                                        "vName" => "activity.coupon.promotion_code",
                                        "vUrl" => "web/activity/coupon/promotion_code",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 30011,
                                        "vAccess" => "1,2,11,12",
                                        "bOpen" => 1,
                                    ],
                                    [
                                        //優惠券牆
                                        "iId" => 300113,
                                        "vName" => "activity.coupon.gallery",
                                        "vUrl" => "web/activity/coupon/gallery",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 30011,
                                        "vAccess" => "1,2,11,12",
                                        "bOpen" => 0,
                                    ],
                                ]
                        ],
                        [
                            //點數
                            "iId" => 30012,
                            "vName" => "activity.coin",
                            "vUrl" => "",
                            "vCss" => "",
                            "bSubMenu" => 1,
                            "iParentId" => 3001,
                            "vAccess" => "1,2,11,12",
                            "bOpen" => 0,
                            "child" =>
                                [
                                    [
                                        //點數活動
                                        "iId" => 300121,
                                        "vName" => "activity.coin.index",
                                        "vUrl" => "web/activity/coin/index",
                                        "vCss" => "",
                                        "bSubMenu" => 1,
                                        "iParentId" => 30012,
                                        "vAccess" => "1,2,11,12",
                                        "bOpen" => 1,
                                    ],
                                    [
                                        //點數管理
                                        "iId" => 300122,
                                        "vName" => "activity.coin.manage",
                                        "vUrl" => "web/activity/coin/manage",
                                        "vCss" => "",
                                        "bSubMenu" => 0,
                                        "iParentId" => 30012,
                                        "vAccess" => "1,2,11,12",
                                        "bOpen" => 1,
                                    ],
                                ]
                        ],
                        [
                            //活動訊息
                            "iId" => 30013,
                            "vName" => "activity.reservoir",
                            "vUrl" => "",
                            "vCss" => "",
                            "bSubMenu" => 1,
                            "iParentId" => 3001,
                            "vAccess" => "1,2,11,12",
                            "bOpen" => 0,
                            "child" =>
                                [
                                    [
                                        //活動訊息
                                        "iId" => 300131,
                                        "vName" => "activity.reservoir.index",
                                        "vUrl" => "web/activity/reservoir/index",
                                        "vCss" => "",
                                        "bSubMenu" => 1,
                                        "iParentId" => 30013,
                                        "vAccess" => "1,2,11,12",
                                        "bOpen" => 1,
                                    ],
                                ]
                        ],
                        [
                            //活動報名
                            "iId" => 30014,
                            "vName" => "activity.sign_up",
                            "vUrl" => "",
                            "vCss" => "",
                            "bSubMenu" => 1,
                            "iParentId" => 3001,
                            "vAccess" => "1,2,11,12",
                            "bOpen" => 0,
                            "child" =>
                                [
                                    [
                                        //活動報名
                                        "iId" => 300141,
                                        "vName" => "activity.sign_up.index",
                                        "vUrl" => "web/activity/sign_up/index",
                                        "vCss" => "",
                                        "bSubMenu" => 1,
                                        "iParentId" => 30014,
                                        "vAccess" => "1,2,11,12",
                                        "bOpen" => 1,
                                    ],
                                ]
                        ],
                        [
                            //活動檔期
                            "iId" => 30015,
                            "vName" => "activity.schedule",
                            "vUrl" => "web/activity/schedule",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 3001,
                            "vAccess" => "1,2,11,12",
                            "bOpen" => 1,
//                            "child" =>
//                                [
//                                    [
//                                        //活動檔期
//                                        "iId" => 300151,
//                                        "vName" => "activity.schedule.index",
//                                        "vUrl" => "web/activity/schedule/index",
//                                        "vCss" => "",
//                                        "bSubMenu" => 0,
//                                        "iParentId" => 30015,
//                                        "vAccess" => "1,2,11,12",
//                                        "bOpen" => 1,
//                                    ],
//                                ]
                        ],
                    ],
            ],
            [
                //訊息公告
                "iId" => 4001,
                "vName" => "reservoir",
                "vUrl" => "",
                "vCss" => "fa-list",
                "bSubMenu" => 1,
                "iParentId" => 0,
                "vAccess" => "1,2,11,12",
                "bOpen" => 1,
                "child" =>
                    [
                        [
                            //公告訊息
                            "iId" => 40011,
                            "vName" => "reservoir.index",
                            "vUrl" => "web/reservoir/index",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 4001,
                            "vAccess" => "1,2,11,12",
                            "bOpen" => 1,
                        ],
                    ]
            ],
            [
                //客服專區
                "iId" => 5001,
                "vName" => "service",
                "vUrl" => "",
                "vCss" => "fa-list",
                "bSubMenu" => 1,
                "iParentId" => 0,
                "vAccess" => "1,2,11,12",
                "bOpen" => 0,
                "child" =>
                    [
                        [
                            //公告訊息
                            "iId" => 50011,
                            "vName" => "service.message",
                            "vUrl" => "web/service/message",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 5001,
                            "vAccess" => "1,2,11,12",
                            "bOpen" => 0,
                        ],
                    ]
            ],
            [
                //商家管理
                "iId" => 9001,
                "vName" => "store",
                "vUrl" => "",
                "vCss" => "fa-list",
                "bSubMenu" => 1,
                "iParentId" => 0,
                "vAccess" => "1,2,11,12,41",
                "bOpen" => 0,
                "child" =>
                    [
                        [
                            //商家資料
                            "iId" => 90011,
                            "vName" => "store.index",
                            "vUrl" => "web/store/index",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 9001,
                            "vAccess" => "1,2,11,12,41",
                            "bOpen" => 1,
                        ],
                        [
                            //商家資料
                            "iId" => 90012,
                            "vName" => "store.attr",
                            "vUrl" => "web/store/attr",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 9001,
                            "vAccess" => "1,2,11,12,41",
                            "bOpen" => 1,
                        ],
                        [
                            //商家資料
                            "iId" => 90013,
                            "vName" => "store.slider",
                            "vUrl" => "web/store/slider",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 9001,
                            "vAccess" => "1,2,11,12,41",
                            "bOpen" => 1,
                        ],
                        [
                            //智付通申請
                            "iId" => 90019,
                            "vName" => "store.pay_service",
                            "vUrl" => "web/store/pay_service",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 9001,
                            "vAccess" => "1,2,11,12,41",
                            "bOpen" => 1,
                        ],
                        [
                            //元大支付設定
                            "iId" => 900111,
                            "vName" => "store.ytbank",
                            "vUrl" => "web/store/ytbank",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 9001,
                            "vAccess" => "1,2,11,12,41",
                            "bOpen" => 1,
                        ],
                        [
                            //新光支付設定
                            "iId" => 900112,
                            "vName" => "store.skbank",
                            "vUrl" => "web/store/skbank",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 9001,
                            "vAccess" => "1,2,11,12,41",
                            "bOpen" => 1,
                        ],
                    ]
            ],
            [
                //
                "iId" => 99001,
                "vName" => "log",
                "vUrl" => "",
                "vCss" => "fa-list",
                "bSubMenu" => 1,
                "iParentId" => 0,
                "vAccess" => "1,2,11,12",
                "bOpen" => 0,
                "child" =>
                    [
                        [
                            //
                            "iId" => 9900101,
                            "vName" => "log.log01",
                            "vUrl" => "web/log/log01",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 99001,
                            "vAccess" => "1,2,11,12",
                            "bOpen" => 1,
                        ],
                    ]
            ],
            [
                //
                "iId" => 999001,
                "vName" => "other_sys",
                "vUrl" => "",
                "vCss" => "fa-list",
                "bSubMenu" => 1,
                "iParentId" => 0,
                "vAccess" => "1,2,11,12",
                "bOpen" => 0,
                "child" =>
                    [
                        [
                            //
                            "iId" => 99900101,
                            "vName" => "other_sys.b01",
                            "vUrl" => "web/other_sys/b01",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 999001,
                            "vAccess" => "1,2,11,12",
                            "bOpen" => 1,
                        ],
                        [
                            //
                            "iId" => 99900102,
                            "vName" => "other_sys.b02",
                            "vUrl" => "web/other_sys/b02",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 999001,
                            "vAccess" => "1,2,11,12",
                            "bOpen" => 1,
                        ],
                        [
                            //
                            "iId" => 99900103,
                            "vName" => "other_sys.b03",
                            "vUrl" => "web/other_sys/b03",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 999001,
                            "vAccess" => "1,2,11,12",
                            "bOpen" => 1,
                        ],
                        [
                            //
                            "iId" => 99900104,
                            "vName" => "other_sys.b04",
                            "vUrl" => "web/other_sys/b04",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 999001,
                            "vAccess" => "1,2,11,12",
                            "bOpen" => 1,
                        ],
                        [
                            //
                            "iId" => 100015,
                            "vName" => "other_sys.b05",
                            "vUrl" => "web/other_sys/b05",
                            "vCss" => "",
                            "bSubMenu" => 0,
                            "iParentId" => 10001,
                            "vAccess" => "1,2,11,12",
                            "bOpen" => 1,
                        ],
                    ]
            ],
        ];

        DB::table($this->table)->delete();

        $maxRank = 0;
        foreach ($data_arr as $key => $var) {
            $Dao = new SysMenu();
            $Dao->iId = $var ['iId'];
            $Dao->iType = isset( $var ['iType'] ) ? $var ['iType'] : 0;
            $Dao->vName = $var ['vName'];
            $Dao->vUrl = $var ['vUrl'];
            $Dao->vCss = $var ['vCss'];
            $Dao->bSubMenu = $var ['bSubMenu'];
            $Dao->iParentId = $var ['iParentId'];
            $Dao->vAccess = $var ['vAccess'];
            $Dao->bOpen = $var ['bOpen'];
            $Dao->iRank = ( isset( $var ['iRank'] ) ) ? $var ['iRank'] : $maxRank + 1;
            $maxRank++;
            $Dao->save();
            if ($Dao->bSubMenu) {
                $maxRank_child = 0;
                foreach ($var['child'] as $key_child => $var_child) {
                    $DaoChild = new SysMenu();
                    $DaoChild->iId = $var_child ['iId'];
                    $DaoChild->iType = isset( $var_child ['iType'] ) ? $var_child ['iType'] : 0;
                    $DaoChild->vName = $var_child ['vName'];
                    $DaoChild->vUrl = $var_child ['vUrl'];
                    $DaoChild->vCss = $var_child ['vCss'];
                    $DaoChild->bSubMenu = $var_child ['bSubMenu'];
                    $DaoChild->iParentId = $var_child ['iParentId'];
                    $DaoChild->vAccess = $var_child ['vAccess'];
                    $DaoChild->bOpen = $var_child ['bOpen'];
                    $DaoChild->iRank = ( isset( $var_child ['iRank'] ) ) ? $var_child ['iRank'] : $maxRank_child + 1;
                    $DaoChild->save();
                    $maxRank_child++;
                    if ($DaoChild->bSubMenu) {
                        $maxRank_child2 = 0;
                        foreach ($var_child['child'] as $key_child2 => $var_child2) {
                            $DaoChild2 = new SysMenu ();
                            $DaoChild2->iId = $var_child2 ['iId'];
                            $DaoChild2->iType = isset( $var_child2 ['iType'] ) ? $var_child2 ['iType'] : 0;
                            $DaoChild2->vName = $var_child2 ['vName'];
                            $DaoChild2->vUrl = $var_child2 ['vUrl'];
                            $DaoChild2->vCss = $var_child2 ['vCss'];
                            $DaoChild2->bSubMenu = $var_child2 ['bSubMenu'];
                            $DaoChild2->iParentId = $var_child2 ['iParentId'];
                            $DaoChild2->vAccess = $var_child2 ['vAccess'];
                            $DaoChild2->bOpen = $var_child2 ['bOpen'];
                            $DaoChild2->iRank = ( isset( $var_child2 ['iRank'] ) ) ? $var_child2 ['iRank'] : $maxRank_child2 + 1;
                            $DaoChild2->save();
                            $maxRank_child2++;
                        }
                    }
                }
            }
        }
    }
}
