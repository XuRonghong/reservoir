<?php
return [
    "web" =>
        [
            "index" =>
                [
                    "view" => "_template_web.index"
                ],
            "member" =>
                [
                    "userinfo" =>
                        [
                            "view" => "_template_web.member.userinfo"
                        ]
                ],
            /***********************
             *會員管理
             ***********************/
            "admin" =>
                [
                    "member" =>
                        [
                            "customer" =>
                                [
                                    "view" => "_template_web._admin.member.customer.index",
                                    "menu_access" => "111",
                                    "menu_parent" =>
                                        [
                                            "1",
                                            "11"
                                        ],
                                    "access" =>
                                        [
                                            "view" => "_template_web._admin.member.customer.access",
                                            "menu_access" => "111",
                                            "menu_parent" =>
                                                [
                                                    "1",
                                                    "11"
                                                ],
                                        ],
                                ],
                            "employee" =>
                                [
                                    "view" => "_template_web._admin.member.employee.index",
                                    "menu_access" => "112",
                                    "menu_parent" =>
                                        [
                                            "1",
                                            "11"
                                        ],
                                    "access" =>
                                        [
                                            "view" => "_template_web._admin.member.employee.access",
                                            "menu_access" => "112",
                                            "menu_parent" =>
                                                [
                                                    "1",
                                                    "11"
                                                ],
                                        ],
                                ],
                            "store" =>
                                [
                                    "view" => "_template_web._admin.member.store.index",
                                    "menu_access" => "113",
                                    "menu_parent" =>
                                        [
                                            "1",
                                            "11"
                                        ],
                                    "access" =>
                                        [
                                            "view" => "_template_web._admin.member.store.access",
                                            "menu_access" => "113",
                                            "menu_parent" =>
                                                [
                                                    "1",
                                                    "11"
                                                ],
                                        ],
                                ],
                            "blogger" =>
                                [
                                    "view" => "_template_web._admin.member.blogger.index",
                                    "menu_access" => "114",
                                    "menu_parent" =>
                                        [
                                            "1",
                                            "11"
                                        ],
                                    "access" =>
                                        [
                                            "view" => "_template_web._admin.member.blogger.access",
                                            "menu_access" => "114",
                                            "menu_parent" =>
                                                [
                                                    "1",
                                                    "11"
                                                ],
                                        ],
                                ],
                            "supplier" =>
                                [
                                    "view" => "_template_web._admin.member.supplier.index",
                                    "menu_access" => "115",
                                    "menu_parent" =>
                                        [
                                            "1",
                                            "11"
                                        ],
                                    "access" =>
                                        [
                                            "view" => "_template_web._admin.member.supplier.access",
                                            "menu_access" => "115",
                                            "menu_parent" =>
                                                [
                                                    "1",
                                                    "11"
                                                ],
                                        ],
                                ],
                            "excel" =>
                                [
                                    "customer" =>
                                        [
                                            "view" => "_template_web._admin.member.excel.customer",
                                            "menu_access" => "111",
                                            "menu_parent" =>
                                                [
                                                    "1",
                                                    "11"
                                                ],
                                        ],
                                    "employee" =>
                                        [
                                            "view" => "_template_web._admin.member.excel.employee",
                                            "menu_access" => "112",
                                            "menu_parent" =>
                                                [
                                                    "1",
                                                    "11"
                                                ],
                                        ],
                                    "store" =>
                                        [
                                            "view" => "_template_web._admin.member.excel.store",
                                            "menu_access" => "113",
                                            "menu_parent" =>
                                                [
                                                    "1",
                                                    "11"
                                                ],
                                        ],
                                    "blogger" =>
                                        [
                                            "view" => "_template_web._admin.member.excel.blogger",
                                            "menu_access" => "114",
                                            "menu_parent" =>
                                                [
                                                    "1",
                                                    "11"
                                                ],
                                        ],
                                    "supplier" =>
                                        [
                                            "view" => "_template_web._admin.member.excel.supplier",
                                            "menu_access" => "115",
                                            "menu_parent" =>
                                                [
                                                    "1",
                                                    "11"
                                                ],
                                        ],
                                ],
                        ],
                    "group" =>
                        [
                            "customer" =>
                                [
                                    "view" => "_template_web._admin.group.customer",
                                    "menu_access" => "121",
                                    "menu_parent" =>
                                        [
                                            "1",
                                            "12"
                                        ],
                                ],
                            "employee" =>
                                [
                                    "view" => "_template_web._admin.group.employee",
                                    "menu_access" => "122",
                                    "menu_parent" =>
                                        [
                                            "1",
                                            "12"
                                        ],
                                ],
                            "store" =>
                                [
                                    "view" => "_template_web._admin.group.store",
                                    "menu_access" => "123",
                                    "menu_parent" =>
                                        [
                                            "1",
                                            "12"
                                        ],
                                ],
                            "blogger" =>
                                [
                                    "view" => "_template_web._admin.group.blogger",
                                    "menu_access" => "124",
                                    "menu_parent" =>
                                        [
                                            "1",
                                            "12"
                                        ],
                                ],
                            "supplier" =>
                                [
                                    "view" => "_template_web._admin.group.supplier",
                                    "menu_access" => "125",
                                    "menu_parent" =>
                                        [
                                            "1",
                                            "12"
                                        ],
                                ],
                            "excel" =>
                                [
                                    "customer" =>
                                        [
                                            "view" => "_template_web._admin.group.excel.customer",
                                            "menu_access" => "121",
                                            "menu_parent" =>
                                                [
                                                    "1",
                                                    "12"
                                                ],
                                        ],
                                    "employee" =>
                                        [
                                            "view" => "_template_web._admin.group.excel.employee",
                                            "menu_access" => "122",
                                            "menu_parent" =>
                                                [
                                                    "1",
                                                    "12"
                                                ],
                                        ],
                                    "store" =>
                                        [
                                            "view" => "_template_web._admin.group.excel.store",
                                            "menu_access" => "123",
                                            "menu_parent" =>
                                                [
                                                    "1",
                                                    "12"
                                                ],
                                        ],
                                    "blogger" =>
                                        [
                                            "view" => "_template_web._admin.group.excel.blogger",
                                            "menu_access" => "124",
                                            "menu_parent" =>
                                                [
                                                    "1",
                                                    "12"
                                                ],
                                        ],
                                    "supplier" =>
                                        [
                                            "view" => "_template_web._admin.group.excel.supplier",
                                            "menu_access" => "125",
                                            "menu_parent" =>
                                                [
                                                    "1",
                                                    "12"
                                                ],
                                        ],
                                ],
                        ],
                    "exchange_rate" =>
                        [
                            "index" =>
                                [
                                    "view" => "_template_web._admin.exchange_rate.index",
                                    "menu_access" => "131",
                                    "menu_parent" =>
                                        [
                                            "1",
                                            "13"
                                        ],
                                ],
                            "log" =>
                                [
                                    "view" => "_template_web._admin.exchange_rate.log",
                                    "menu_access" => "132",
                                    "menu_parent" =>
                                        [
                                            "1",
                                            "13"
                                        ],
                                ],
                        ],
                    "category" =>
                        [
                            "view" => "_template_web._admin.category.index",
                            "menu_access" => "14",
                            "menu_parent" =>
                                [
                                    "1",
                                    "0"
                                ],
                            "sub" =>
                                [
                                    "view" => "_template_web._admin.category.sub",
                                    "menu_access" => "14",
                                    "menu_parent" =>
                                        [
                                            "1",
                                            "0"
                                        ],
                                ]
                        ],
                    "config" =>
                        [
                            "view" => "_template_web._admin.config.index",
                            "menu_access" => "17",
                            "menu_parent" =>
                                [
                                    "1",
                                    "0"
                                ],
                            "sub" =>
                                [
                                    "view" => "_template_web._admin.config.sub",
                                    "menu_access" => "17",
                                    "menu_parent" =>
                                        [
                                            "1",
                                            "0"
                                        ],
                                ]
                        ],
                ],
            /***********************
             *行銷管理
             ***********************/
            "advertising" =>
                [
                    "recommend" =>
                        [
                            "view" => "_template_web.advertising.recommend.index",
                            "menu_access" => "501",
                            "menu_parent" =>
                                [
                                    "5",
                                    "0"
                                ],
                            "sub" =>
                                [
                                    "view" => "_template_web.advertising.recommend.sub",
                                    "menu_access" => "501",
                                    "menu_parent" =>
                                        [
                                            "5",
                                            "0"
                                        ],
                                ]
                        ],
                    "keyword" =>
                        [
                            "index" =>
                                [
                                    "view" => "_template_web.advertising.keyword.index",
                                    "menu_access" => "50201",
                                    "menu_parent" =>
                                        [
                                            "5",
                                            "502"
                                        ],
                                ],
                            "log" =>
                                [
                                    "view" => "_template_web.advertising.keyword.log",
                                    "menu_access" => "50202",
                                    "menu_parent" =>
                                        [
                                            "5",
                                            "502"
                                        ],
                                ],
                        ],
                    "promotions" =>
                        [
                            "full_amount_m01" =>
                                [
                                    "view" => "_template_web.advertising.promotions.full_amount_m01.index",
                                    "menu_access" => "50301",
                                    "menu_parent" =>
                                        [
                                            "5",
                                            "503"
                                        ],
                                    "sub" =>
                                        [
                                            "view" => "_template_web.advertising.promotions.full_amount_m01.sub",
                                            "menu_access" => "50301",
                                            "menu_parent" =>
                                                [
                                                    "5",
                                                    "503"
                                                ],
                                        ],
                                ],
                            "full_amount_m02" =>
                                [
                                    "view" => "_template_web.advertising.promotions.full_amount_m02.index",
                                    "menu_access" => "50302",
                                    "menu_parent" =>
                                        [
                                            "5",
                                            "503"
                                        ],
                                    "sub" =>
                                        [
                                            "view" => "_template_web.advertising.promotions.full_amount_m02.sub",
                                            "menu_access" => "50302",
                                            "menu_parent" =>
                                                [
                                                    "5",
                                                    "503"
                                                ],
                                        ],
                                ],
                            "full_amount_m03" =>
                                [
                                    "view" => "_template_web.advertising.promotions.full_amount_m03.index",
                                    "menu_access" => "50303",
                                    "menu_parent" =>
                                        [
                                            "5",
                                            "503"
                                        ],
                                    "sub" =>
                                        [
                                            "view" => "_template_web.advertising.promotions.full_amount_m03.sub",
                                            "menu_access" => "50303",
                                            "menu_parent" =>
                                                [
                                                    "5",
                                                    "503"
                                                ],
                                        ],
                                ],
                            "choose" =>
                                [
                                    "view" => "_template_web.advertising.promotions.choose.index",
                                    "menu_access" => "50304",
                                    "menu_parent" =>
                                        [
                                            "5",
                                            "503"
                                        ],
                                    "sub" =>
                                        [
                                            "view" => "_template_web.advertising.promotions.choose.sub",
                                            "menu_access" => "50304",
                                            "menu_parent" =>
                                                [
                                                    "5",
                                                    "503"
                                                ],
                                        ],
                                ],
                            "day_by_day" =>
                                [
                                    "view" => "_template_web.advertising.promotions.day_by_day.index",
                                    "menu_access" => "50305",
                                    "menu_parent" =>
                                        [
                                            "5",
                                            "503"
                                        ],
                                    "sub" =>
                                        [
                                            "view" => "_template_web.advertising.promotions.day_by_day.sub",
                                            "menu_access" => "50305",
                                            "menu_parent" =>
                                                [
                                                    "5",
                                                    "503"
                                                ],
                                        ],
                                ],
                        ],
                    "red_with_green" =>
                        [
                            "promo_p01" =>
                                [
                                    "view" => "_template_web.advertising.red_with_green.promo_p01.index",
                                    "menu_access" => "50401",
                                    "menu_parent" =>
                                        [
                                            "5",
                                            "504"
                                        ],
                                    "sub" =>
                                        [
                                            "view" => "_template_web.advertising.red_with_green.promo_p01.sub",
                                            "menu_access" => "50401",
                                            "menu_parent" =>
                                                [
                                                    "5",
                                                    "504"
                                                ],
                                        ],
                                ],
                            "promo_p02" =>
                                [
                                    "view" => "_template_web.advertising.red_with_green.promo_p02.index",
                                    "menu_access" => "50402",
                                    "menu_parent" =>
                                        [
                                            "5",
                                            "504"
                                        ],
                                    "sub" =>
                                        [
                                            "view" => "_template_web.advertising.red_with_green.promo_p02.sub",
                                            "menu_access" => "50402",
                                            "menu_parent" =>
                                                [
                                                    "5",
                                                    "504"
                                                ],
                                        ],
                                ],
                        ],

                    "e_gift" =>
                        [
                            "index" =>
                                [
                                    "view" => "_template_web.advertising.e_gift.index.index",
                                    "menu_access" => "50501",
                                    "menu_parent" =>
                                        [
                                            "5",
                                            "505"
                                        ],
                                    "sub" =>
                                        [
                                            "view" => "_template_web.advertising.e_gift.index.sub",
                                            "menu_access" => "50401",
                                            "menu_parent" =>
                                                [
                                                    "5",
                                                    "505"
                                                ],
                                        ],
                                ],
                            "member" =>
                                [
                                    "view" => "_template_web.advertising.e_gift.member.index",
                                    "menu_access" => "50502",
                                    "menu_parent" =>
                                        [
                                            "5",
                                            "505"
                                        ],
                                ],
                        ],
                ],
            /***********************
             *介面管理
             ***********************/
            "scenes" =>
                [
                    "login" =>
                        [
                            "view" => "_template_web.scenes.login.index",
                            "menu_access" => "601",
                            "menu_parent" =>
                                [
                                    "6",
                                    "0"
                                ],
                            "background" =>
                                [
                                    "view" => "_template_web.scenes.login.background",
                                    "menu_access" => "60101",
                                    "menu_parent" =>
                                        [
                                            "6",
                                            "0"
                                        ],
                                ]
                        ],
                    "home" =>
                        [
                            "view" => "_template_web.scenes.home.index",
                            "menu_access" => "602",
                            "menu_parent" =>
                                [
                                    "6",
                                    "0"
                                ],
                            "slider" =>
                                [
                                    "view" => "_template_web.scenes.home.slider",
                                    "menu_access" => "60201",
                                    "menu_parent" =>
                                        [
                                            "6",
                                            "0"
                                        ],
                                ]
                        ],
                    "header" =>
                        [
                            "view" => "_template_web.scenes.header.index",
                            "menu_access" => "603",
                            "menu_parent" =>
                                [
                                    "6",
                                    "0"
                                ],
                            "url" =>
                                [
                                    "view" => "_template_web.scenes.header.url",
                                    "menu_access" => "60301",
                                    "menu_parent" =>
                                        [
                                            "6",
                                            "0"
                                        ],
                                ]
                        ],
                    "footer" =>
                        [
                            "view" => "_template_web.scenes.footer.index",
                            "menu_access" => "604",
                            "menu_parent" =>
                                [
                                    "6",
                                    "0"
                                ],
                            "url" =>
                                [
                                    "view" => "_template_web.scenes.footer.url",
                                    "menu_access" => "60401",
                                    "menu_parent" =>
                                        [
                                            "6",
                                            "0"
                                        ],
                                ]
                        ],
                    "category" =>
                        [
                            "view" => "_template_web.scenes.category.index",
                            "menu_access" => "605",
                            "menu_parent" =>
                                [
                                    "6",
                                    "0"
                                ],
                            "banner" =>
                                [
                                    "view" => "_template_web.scenes.category.banner",
                                    "menu_access" => "60501",
                                    "menu_parent" =>
                                        [
                                            "6",
                                            "0"
                                        ],
                                ]
                        ],
                    "product" =>
                        [
                            "view" => "_template_web.scenes.product.index",
                            "menu_access" => "606",
                            "menu_parent" =>
                                [
                                    "6",
                                    "0"
                                ],
                            "banner" =>
                                [
                                    "view" => "_template_web.scenes.product.banner",
                                    "menu_access" => "60601",
                                    "menu_parent" =>
                                        [
                                            "6",
                                            "0"
                                        ],
                                ]
                        ],
                    "cart" =>
                        [
                            "view" => "_template_web.scenes.cart.index",
                            "menu_access" => "607",
                            "menu_parent" =>
                                [
                                    "6",
                                    "0"
                                ],
                            "banner" =>
                                [
                                    "view" => "_template_web.scenes.cart.banner",
                                    "menu_access" => "60701",
                                    "menu_parent" =>
                                        [
                                            "6",
                                            "0"
                                        ],
                                ]
                        ],
                    "order" =>
                        [
                            "view" => "_template_web.scenes.order.index",
                            "menu_access" => "608",
                            "menu_parent" =>
                                [
                                    "6",
                                    "0"
                                ],
                            "banner" =>
                                [
                                    "view" => "_template_web.scenes.order.banner",
                                    "menu_access" => "60801",
                                    "menu_parent" =>
                                        [
                                            "6",
                                            "0"
                                        ],
                                ]
                        ],
                    "news" =>
                        [
                            "view" => "_template_web.scenes.news.index",
                            "menu_access" => "609",
                            "menu_parent" =>
                                [
                                    "6",
                                    "0"
                                ],
                            "banner" =>
                                [
                                    "view" => "_template_web.scenes.news.banner",
                                    "menu_access" => "60901",
                                    "menu_parent" =>
                                        [
                                            "6",
                                            "0"
                                        ],
                                ]
                        ],
                    "member_center" =>
                        [
                            "view" => "_template_web.scenes.member_center.index",
                            "menu_access" => "610",
                            "menu_parent" =>
                                [
                                    "6",
                                    "0"
                                ],
                            "banner" =>
                                [
                                    "view" => "_template_web.scenes.member_center.banner",
                                    "menu_access" => "61001",
                                    "menu_parent" =>
                                        [
                                            "6",
                                            "0"
                                        ],
                                ]
                        ],
                ],
            /***********************
             *商品管理
             ***********************/
            "product" =>
                [
                    "category" =>
                        [
                            "view" => "_template_web.product.category.index",
                            "menu_access" => "10011",
                            "menu_parent" =>
                                [
                                    "1001",
                                    "0"
                                ],
                            "sub" =>
                                [
                                    "view" => "_template_web.product.category.sub",
                                    "menu_access" => "10011",
                                    "menu_parent" =>
                                        [
                                            "1001",
                                            "0"
                                        ],
                                ]
                        ],
                    "manage" =>
                        [
                            "museum_a01" =>
                                [
                                    "view" => "_template_web.product.manage.museum_a01.index",
                                    "menu_access" => "1001201",
                                    "menu_parent" =>
                                        [
                                            "1001",
                                            "10012"
                                        ],
                                    "add" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a01.add",
                                            "menu_access" => "1001201",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ],
                                    "edit" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a01.edit",
                                            "menu_access" => "1001201",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ],
                                    "attributes" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a01.attributes",
                                            "menu_access" => "1001201",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ],
                                    "specification" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a01.specification.index",
                                            "menu_access" => "1001201",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ],
                                    "purchase" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a01.purchase.index",
                                            "menu_access" => "1001201",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ],
                                    "recommend" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a01.recommend.index",
                                            "menu_access" => "1001201",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ],
                                    "gifts" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a01.gifts.index",
                                            "menu_access" => "1001201",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ],
                                    "appraise" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a01.appraise.index",
                                            "menu_access" => "1001201",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ]
                                ],
                            "museum_a02" =>
                                [
                                    "view" => "_template_web.product.manage.museum_a02.index",
                                    "menu_access" => "1001202",
                                    "menu_parent" =>
                                        [
                                            "1001",
                                            "10012"
                                        ],
                                    "add" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a02.add",
                                            "menu_access" => "1001202",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ],
                                    "edit" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a02.edit",
                                            "menu_access" => "1001202",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ],
                                    "attributes" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a02.attributes",
                                            "menu_access" => "1001202",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ],
                                    "specification" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a02.specification..index",
                                            "menu_access" => "1001202",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ]
                                ],
                            "museum_a03" =>
                                [
                                    "view" => "_template_web.product.manage.museum_a03.index",
                                    "menu_access" => "1001203",
                                    "menu_parent" =>
                                        [
                                            "1001",
                                            "10012"
                                        ],
                                    "add" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a03.add",
                                            "menu_access" => "1001203",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ],
                                    "edit" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a03.edit",
                                            "menu_access" => "1001203",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ],
                                    "attributes" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a03.attributes",
                                            "menu_access" => "1001203",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ],
                                    "specification" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a03.specification..index",
                                            "menu_access" => "1001203",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ]
                                ],
                            "museum_a04" =>
                                [
                                    "view" => "_template_web.product.manage.museum_a04.index",
                                    "menu_access" => "1001204",
                                    "menu_parent" =>
                                        [
                                            "1001",
                                            "10012"
                                        ],
                                    "add" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a04.add",
                                            "menu_access" => "1001204",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ],
                                    "edit" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a04.edit",
                                            "menu_access" => "1001204",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ],
                                    "attributes" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a04.attributes",
                                            "menu_access" => "1001204",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ],
                                    "specification" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a04.specification..index",
                                            "menu_access" => "1001204",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ]
                                ],
                            "museum_a05" =>
                                [
                                    "view" => "_template_web.product.manage.museum_a05.index",
                                    "menu_access" => "1001205",
                                    "menu_parent" =>
                                        [
                                            "1001",
                                            "10012"
                                        ],
                                    "add" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a05.add",
                                            "menu_access" => "1001205",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ],
                                    "edit" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a05.edit",
                                            "menu_access" => "1001205",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ],
                                    "attributes" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a05.attributes",
                                            "menu_access" => "1001205",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ],
                                    "specification" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a05.specification..index",
                                            "menu_access" => "1001205",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ]
                                ],
                            "museum_a06" =>
                                [
                                    "view" => "_template_web.product.manage.museum_a06.index",
                                    "menu_access" => "1001206",
                                    "menu_parent" =>
                                        [
                                            "1001",
                                            "10012"
                                        ],
                                    "add" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a06.add",
                                            "menu_access" => "1001206",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ],
                                    "edit" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a06.edit",
                                            "menu_access" => "1001206",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ],
                                    "attributes" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a06.attributes",
                                            "menu_access" => "1001206",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ],
                                    "specification" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a06.specification..index",
                                            "menu_access" => "1001206",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ]
                                ],
                            "museum_a07" =>
                                [
                                    "view" => "_template_web.product.manage.museum_a07.index",
                                    "menu_access" => "1001207",
                                    "menu_parent" =>
                                        [
                                            "1001",
                                            "10012"
                                        ],
                                    "add" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a07.add",
                                            "menu_access" => "1001207",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ],
                                    "edit" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a07.edit",
                                            "menu_access" => "1001207",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ],
                                    "attributes" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a07.attributes",
                                            "menu_access" => "1001207",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ],
                                    "specification" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a07.specification..index",
                                            "menu_access" => "1001207",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ]
                                ],
                            "museum_a08" =>
                                [
                                    "view" => "_template_web.product.manage.museum_a08.index",
                                    "menu_access" => "1001208",
                                    "menu_parent" =>
                                        [
                                            "1001",
                                            "10012"
                                        ],
                                    "add" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a08.add",
                                            "menu_access" => "1001208",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ],
                                    "edit" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a08.edit",
                                            "menu_access" => "1001208",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ],
                                    "attributes" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a08.attributes",
                                            "menu_access" => "1001208",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ],
                                    "specification" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a08.specification..index",
                                            "menu_access" => "1001208",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ]
                                ],
                            "museum_a09" =>
                                [
                                    "view" => "_template_web.product.manage.museum_a09.index",
                                    "menu_access" => "1001209",
                                    "menu_parent" =>
                                        [
                                            "1001",
                                            "10012"
                                        ],
                                    "add" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a09.add",
                                            "menu_access" => "1001209",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ],
                                    "edit" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a09.edit",
                                            "menu_access" => "1001209",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ],
                                    "attributes" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a09.attributes",
                                            "menu_access" => "1001209",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ],
                                    "specification" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a09.specification..index",
                                            "menu_access" => "1001209",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ]
                                ],
                            "museum_a10" =>
                                [
                                    "view" => "_template_web.product.manage.museum_a10.index",
                                    "menu_access" => "1001210",
                                    "menu_parent" =>
                                        [
                                            "1001",
                                            "10012"
                                        ],
                                    "add" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a10.add",
                                            "menu_access" => "1001210",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ],
                                    "edit" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a10.edit",
                                            "menu_access" => "1001210",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ],
                                    "attributes" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a10.attributes",
                                            "menu_access" => "1001210",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ],
                                    "specification" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a10.specification..index",
                                            "menu_access" => "1001210",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ]
                                ],
                            "museum_a11" =>
                                [
                                    "view" => "_template_web.product.manage.museum_a11.index",
                                    "menu_access" => "1001211",
                                    "menu_parent" =>
                                        [
                                            "1001",
                                            "10012"
                                        ],
                                    "add" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a11.add",
                                            "menu_access" => "1001211",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ],
                                    "edit" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a11.edit",
                                            "menu_access" => "1001211",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ],
                                    "attributes" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a11.attributes",
                                            "menu_access" => "1001211",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ],
                                    "specification" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a11.specification..index",
                                            "menu_access" => "1001211",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ]
                                ],
                            "museum_a12" =>
                                [
                                    "view" => "_template_web.product.manage.museum_a12.index",
                                    "menu_access" => "1001212",
                                    "menu_parent" =>
                                        [
                                            "1001",
                                            "10012"
                                        ],
                                    "add" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a12.add",
                                            "menu_access" => "1001212",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ],
                                    "edit" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a12.edit",
                                            "menu_access" => "1001212",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ],
                                    "attributes" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a12.attributes",
                                            "menu_access" => "1001212",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ],
                                    "specification" =>
                                        [
                                            "view" => "_template_web.product.manage.museum_a12.specification..index",
                                            "menu_access" => "1001212",
                                            "menu_parent" =>
                                                [
                                                    "1001",
                                                    "10012"
                                                ],
                                        ]
                                ],
                        ],
                    "shipping" =>
                        [
                            "view" => "_template_web.product.shipping.index",
                            "menu_access" => "10013",
                            "menu_parent" =>
                                [
                                    "1001",
                                    "0"
                                ],
                            "add" =>
                                [
                                    "view" => "_template_web.product.shipping.sub",
                                    "menu_access" => "10013",
                                    "menu_parent" =>
                                        [
                                            "1001",
                                            "0"
                                        ],
                                ]
                        ],
                    "pay" =>
                        [
                            "view" => "_template_web.product.pay.index",
                            "menu_access" => "10014",
                            "menu_parent" =>
                                [
                                    "1001",
                                    "0"
                                ],
                            "add" =>
                                [
                                    "view" => "_template_web.product.pay.sub",
                                    "menu_access" => "10014",
                                    "menu_parent" =>
                                        [
                                            "1001",
                                            "0"
                                        ],
                                ]
                        ],
                    "log" =>
                        [
                            "view" => "_template_web.product.log.index",
                            "menu_access" => "10019",
                            "menu_parent" =>
                                [
                                    "1001",
                                    "0"
                                ],
                        ],
                ],
            /***********************
             *訂單管理
             ***********************/
            "order" =>
                [
                    "product" =>
                        [
                            "view" => "_template_web.order.product.index",
                            "menu_access" => "20011",
                            "menu_parent" =>
                                [
                                    "2001",
                                    "0"
                                ],
                            "meta" =>
                                [
                                    "view" => "_template_web.order.product.meta",
                                    "menu_access" => "20011",
                                    "menu_parent" =>
                                        [
                                            "2001",
                                            "0"
                                        ],
                                ],
                        ],
                ],
            /***********************
             *活動管理
             ***********************/
            "activity" =>
                [
                    "coupon" =>
                        [
                            "ticket" =>
                                [
                                    "view" => "_template_web.activity.coupon.ticket.index",
                                    "menu_access" => "300111",
                                    "menu_parent" =>
                                        [
                                            "3001",
                                            "30011"
                                        ],
                                    "add" =>
                                        [
                                            "view" => "_template_web.activity.coupon.ticket.add",
                                            "menu_access" => "300111",
                                            "menu_parent" =>
                                                [
                                                    "3001",
                                                    "30011"
                                                ],
                                        ],
                                    "edit" =>
                                        [
                                            "view" => "_template_web.activity.coupon.ticket.edit",
                                            "menu_access" => "300111",
                                            "menu_parent" =>
                                                [
                                                    "3001",
                                                    "30011"
                                                ],
                                        ],
                                ],
                            "promotion_code" =>
                                [
                                    "view" => "_template_web.activity.coupon.promotion_code.index",
                                    "menu_access" => "300112",
                                    "menu_parent" =>
                                        [
                                            "3001",
                                            "30011"
                                        ],
                                    "add" =>
                                        [
                                            "view" => "_template_web.activity.coupon.promotion_code.add",
                                            "menu_access" => "300112",
                                            "menu_parent" =>
                                                [
                                                    "3001",
                                                    "30011"
                                                ],
                                        ],
                                    "edit" =>
                                        [
                                            "view" => "_template_web.activity.coupon.promotion_code.edit",
                                            "menu_access" => "300112",
                                            "menu_parent" =>
                                                [
                                                    "3001",
                                                    "30011"
                                                ],
                                        ],
                                ],
                            "gallery" =>
                                [
                                    "view" => "_template_web.activity.coupon.gallery.index",
                                    "menu_access" => "300113",
                                    "menu_parent" =>
                                        [
                                            "3001",
                                            "30011"
                                        ],
                                    "add" =>
                                        [
                                            "view" => "_template_web.activity.coupon.gallery.add",
                                            "menu_access" => "300113",
                                            "menu_parent" =>
                                                [
                                                    "3001",
                                                    "30011"
                                                ],
                                        ],
                                    "edit" =>
                                        [
                                            "view" => "_template_web.activity.coupon.gallery.edit",
                                            "menu_access" => "300113",
                                            "menu_parent" =>
                                                [
                                                    "3001",
                                                    "30011"
                                                ],
                                        ],
                                    "attributes" =>
                                        [
                                            "view" => "_template_web.activity.coupon.gallery.attributes",
                                            "menu_access" => "300113",
                                            "menu_parent" =>
                                                [
                                                    "3001",
                                                    "30011"
                                                ],
                                        ],
                                    "lang" =>
                                        [
                                            "view" => "_template_web.activity.coupon.gallery.lang",
                                            "menu_access" => "300113",
                                            "menu_parent" =>
                                                [
                                                    "3001",
                                                    "30011"
                                                ],
                                        ],
                                ],
                        ],
                    "coin" =>
                        [
                            "index" =>
                                [
                                    "view" => "_template_web.activity.coin.index.index",
                                    "menu_access" => "300121",
                                    "menu_parent" =>
                                        [
                                            "3001",
                                            "30012"
                                        ],
                                ],
                            "manage" =>
                                [
                                    "view" => "_template_web.activity.coin.manage.index",
                                    "menu_access" => "300122",
                                    "menu_parent" =>
                                        [
                                            "3001",
                                            "30012"
                                        ],
                                    "add" =>
                                        [
                                            "view" => "_template_web.activity.coin.manage.add",
                                            "menu_access" => "300122",
                                            "menu_parent" =>
                                                [
                                                    "3001",
                                                    "30012"
                                                ],
                                        ],
                                    "edit" =>
                                        [
                                            "view" => "_template_web.activity.coin.manage.edit",
                                            "menu_access" => "300122",
                                            "menu_parent" =>
                                                [
                                                    "3001",
                                                    "30012"
                                                ],
                                        ],
                                ],
                        ],
                    "news" =>
                        [
                            "index" =>
                                [
                                    "view" => "_template_web.activity.news.index.index",
                                    "menu_access" => "300131",
                                    "menu_parent" =>
                                        [
                                            "3001",
                                            "30013"
                                        ],
                                ],
                        ],
                    "schedule" =>
                        [
//                            "index" =>
//                                [
                                    "view" => "_template_web.activity.schedule.index",
                                    "menu_access" => "300151",
                                    "menu_parent" =>
                                        [
                                            "3001",
                                            "30015",
                                        ],
//                                ],
                            "recommend" =>
                                [
                                    "view" => "_template_web.activity.schedule.recommend",
                                    "menu_access" => "3001511",
                                    "menu_parent" =>
                                        [
//                                            "3001",
                                            "30015",
                                            "300151",
                                        ],
                                ],
                            "people" =>
                                [
                                    "view" => "_template_web.activity.schedule.people",
                                    "menu_access" => "3001512",
                                    "menu_parent" =>
                                        [
//                                            "3001",
                                            "30015",
                                            "300151",
                                        ],
                                ],
                        ],
                    "sign_up" =>
                        [
                            "index" =>
                                [
                                    "view" => "_template_web.activity.sign_up.index",
                                    "menu_access" => "300132",
                                    "menu_parent" =>
                                        [
                                            "3001",
                                            "30013"
                                        ],
                                ],
                        ],
                ],
            /******************************
             * 訊息公告
             ******************************/
            "news" =>
                [
                    "index" =>
                        [
                            "view" => "_template_web.news.index.index",
                            "menu_access" => "40011",
                            "menu_parent" =>
                                [
                                    "4001",
                                    "0"
                                ],
                        ],
                ],
            /******************************
             * Service
             ******************************/
            "service" =>
                [
                    "message" =>
                        [
                            "view" => "_template_web.service.message.index",
                            "menu_access" => "50011",
                            "menu_parent" =>
                                [
                                    "5001",
                                    "0"
                                ],
                        ],
                ],
            /******************************
             * LOG
             ******************************/
            "log" =>
                [
                    "log01" =>
                        [
                            "view" => "_template_web.log.log01.index",
                            "menu_access" => "9900101",
                            "menu_parent" =>
                                [
                                    "99001",
                                    "0"
                                ],
                        ],
                ],
            /******************************
             * Other System
             ******************************/
            "other_sys" =>
                [
                    "b01" =>
                        [
                            "view" => "_template_web.other_sys.b01.index",
                            "menu_access" => "99900101",
                            "menu_parent" =>
                                [
                                    "999001",
                                    "0"
                                ],
                        ],
                    "b02" =>
                        [
                            "view" => "_template_web.other_sys.b02.index",
                            "menu_access" => "99900102",
                            "menu_parent" =>
                                [
                                    "999001",
                                    "0"
                                ],
                        ],
                    "b03" =>
                        [
                            "view" => "_template_web.other_sys.b03.index",
                            "menu_access" => "99900103",
                            "menu_parent" =>
                                [
                                    "999001",
                                    "0"
                                ],
                        ],
                    "b04" =>
                        [
                            "view" => "_template_web.other_sys.b04.index",
                            "menu_access" => "99900104",
                            "menu_parent" =>
                                [
                                    "999001",
                                    "0"
                                ],
                        ],
                    "b05" =>
                        [
                            "view" => "_template_web.other_sys.b05.index",
                            "menu_access" => "99900105",
                            "menu_parent" =>
                                [
                                    "999001",
                                    "0"
                                ],
                        ],
                ],
        ]
];