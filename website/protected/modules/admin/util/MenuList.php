<?php
$MenuList = Array(
    Array('name' => '系统设置','url'=>'systemconfig', 'child' => Array(
        Array('name' => '基本设置', 'url' => 'index.php?r=admin/config/basic',
            'actions'=>Array(
                Array('name'=>'保存','url'=>'index.php?r=admin/config/basicedit')
            )
        ),
        Array('name' => '支付宝设置', 'url' => 'index.php?r=admin/config/alipay',
            'actions'=>Array(
                Array('name'=>'保存','url'=>'index.php?r=admin/config/alipayedit')
            )
        ),
        Array('name' => '系统邮箱设置', 'url' => 'index.php?r=admin/config/email',
            'actions'=>Array(
                Array('name'=>'保存','url'=>'index.php?r=admin/config/editemail')
            )
        ),
        Array('name' => '上传文件管理', 'url' => 'index.php?r=admin/upload/index'),
        Array('name' => '底部信息', 'url' => 'index.php?r=admin/config/foot',
            'actions'=>Array(
                Array('name'=>'保存','url'=>'index.php?r=admin/config/editfoot')
            ))
    )),
    Array('name' => '界面设置','url'=>'pageconfig', 'child' => Array(
        Array('name' => 'FLASH设置', 'url' => 'index.php?r=admin/flash/index',
            'actions'=>Array(
                Array('name'=>'FLASH设置编辑','url'=>'index.php?r=admin/flash/showedit'),
                Array('name'=>'FLASH图片添加','url'=>'index.php?r=admin/flash/add'),
                Array('name'=>'FLASH图片编辑','url'=>'index.php?r=admin/flash/edit'),
                Array('name'=>'FLASH图片删除','url'=>'index.php?r=admin/flash/del')
            )
        ),
        Array('name' => '在线交流', 'url' => 'index.php?r=admin/online/index',
            'actions'=>Array(
                Array('name'=>'添加','url'=>''),
                Array('name'=>'修改','url'=>''),
                Array('name'=>'删除','url'=>'')
            )
        ),
        Array('name' => '模板设置', 'url' => 'index.php?r=admin/template/index',
            'actions'=>Array(
                Array('name'=>'设为默认','url'=>'index.php?r=admin/template/setDefault'),
                Array('name'=>'修改','url'=>'index.php?r=admin/template/showedit'),
                Array('name'=>'修改保存','url'=>'index.php?r=admin/flash/add'),
                Array('name'=>'删除','url'=>'index.php?r=admin/template/delTemplate'),
            )
        )
    )),
    Array('name' => '栏目设置','url'=>'moduleconfig','child' => Array(
        Array('name' => '栏目管理', 'url' => 'index.php?r=admin/module/index',
            'actions'=>Array(
                Array('name'=>'栏目保存','url'=>'index.php?r=admin/module/Ajax_ModuleEdit'),
                Array('name'=>'栏目删除','url'=>'index.php?r=admin/module/del'),
                Array('name'=>'栏目编辑','url'=>'index.php?r=admin/module/showedit'),
                Array('name'=>'栏目编辑保存','url'=>'index.php?r=admin/module/edit'),
            )
        )
    )),
    Array('name' => '信息管理','url'=>'infoconfig','child' => Array(
        Array('name' => '内容管理', 'url' => 'index.php?r=admin/content/index',
            'actions'=>Array(
                Array('name'=>'文章新建','url'=>'index.php?r=admin/article/add'),
                Array('name'=>'文章编辑','url'=>'index.php?r=admin/article/showedit'),
                Array('name'=>'文章保存','url'=>'index.php?r=admin/article/edit'),
                Array('name'=>'文章删除','url'=>'index.php?r=admin/article/del'),
                Array('name'=>'下载新建','url'=>'index.php?r=admin/download/add'),
                Array('name'=>'下载编辑','url'=>'index.php?r=admin/download/showedit'),
                Array('name'=>'下载保存','url'=>'index.php?r=admin/download/edit'),
                Array('name'=>'下载删除','url'=>'index.php?r=admin/download/del'),
                Array('name'=>'招聘新建','url'=>'index.php?r=admin/job/add'),
                Array('name'=>'招聘编辑','url'=>'index.php?r=admin/job/showedit'),
                Array('name'=>'招聘保存','url'=>'index.php?r=admin/job/edit'),
                Array('name'=>'招聘删除','url'=>'index.php?r=admin/job/del'),
                Array('name'=>'图片新建','url'=>'index.php?r=admin/image/add'),
                Array('name'=>'图片编辑','url'=>'index.php?r=admin/image/showedit'),
                Array('name'=>'图片保存','url'=>'index.php?r=admin/image/edit'),
                Array('name'=>'图片删除','url'=>'index.php?r=admin/image/del'),
                Array('name'=>'产品新建','url'=>'index.php?r=admin/product/add'),
                Array('name'=>'产品编辑','url'=>'index.php?r=admin/product/showedit'),
                Array('name'=>'产品保存','url'=>'index.php?r=admin/product/edit'),
                Array('name'=>'产品删除','url'=>'index.php?r=admin/product/del'),
            )
        ),
        Array('name'=>"订单管理",url=>'index.php?r=admin/order/index',
            'actions'=>Array(
                Array('name'=>'确认发货','url'=>'index.php?admin/order/goodsconfirm')
            )
        ),
        Array('name' => '片段管理', 'url' => 'index.php?r=admin/fragment/index',
            'actions'=>Array(
                Array('name'=>'新建','url'=>'index.php?r=admin/fragment/add'),
                Array('name'=>'编辑','url'=>'index.php?r=admin/fragment/showedit'),
                Array('name'=>'保存','url'=>'index.php?r=admin/fragment/edit'),
                Array('name'=>'删除','url'=>'index.php?r=admin/fragment/del'),
            )
        ),
        Array('name' => '查看留言', 'url' => 'index.php?r=admin/message/index',
            'actions'=>Array(
                Array('name'=>'编辑','url'=>'index.php?r=admin/message/showedit'),
                Array('name'=>'删除','url'=>'index.php?r=admin/message/del')
            )
        ),
        Array('name' => '查看反馈', 'url' => 'index.php?r=admin/feedback/index',
            'actions'=>Array(
                Array('name'=>'查看','url'=>'index.php?r=admin/feedback/view'),
                Array('name'=>'删除','url'=>'index.php?r=admin/feedback/del')
            )
        ),

    )),
    Array('name' => '语言管理','url'=>'languageconfig' ,'child' => Array(
        Array('name' => '语言列表', 'url' => 'index.php?r=admin/language/index',
            'actions'=>Array(
                Array('name'=>'编辑','url'=>'index.php?r=admin/language/showedit'),
                Array('name'=>'保存','url'=>'index.php?r=admin/language/edit')
            )
        )
    )),
    Array('name' => '优化推广','url'=>'seoconfig', 'child' => Array(
        Array('name' => '伪静态', 'url' => 'index.php?r=admin/rewrite/index',
            'actions'=>Array(
                Array('name'=>'保存','url'=>'index.php?r=admin/rewrite/edit')
            )
        ),
        Array('name' => '友情链接', 'url' => 'index.php?r=admin/friendlink/index',
            'actions'=>Array(
                Array('name'=>'编辑','url'=>'index.php?r=admin/friendlink/showedit'),
                Array('name'=>'保存','url'=>'index.php?r=admin/friendlink/edit'),
                Array('name'=>'删除','url'=>'index.php?r=admin/friendlink/del')
            )
        ),
        Array('name' => '缓存管理', 'url' => 'index.php?r=admin/cache/index',
            'actions'=>Array(
                Array('name'=>'缓存清空','url'=>'index.php?r=admin/cache/clearCache')
            )
        )
    )),
    Array('name' => '用户管理','url'=>'userconfig' ,'child' => Array(
        Array('name' => '用户列表', 'url' => 'index.php?r=admin/user/index',
            'actions'=>Array(
                Array('name'=>'新建','url'=>'index.php?r=admin/user/add'),
                Array('name'=>'编辑','url'=>'index.php?r=admin/user/showedit'),
                Array('name'=>'保存','url'=>'index.php?r=admin/user/edit')
            )
        ),
        Array('name' => '用户组管理', 'url' => 'index.php?r=admin/group/index',
            'actions'=>Array(
                Array('name'=>'新建','url'=>'index.php?r=admin/group/add'),
                Array('name'=>'编辑','url'=>'index.php?r=admin/group/showedit'),
                Array('name'=>'保存','url'=>'index.php?r=admin/group/edit')
            )
        ),
        Array('name' => '管理组管理', 'url' => 'index.php?r=admin/role/index',
            'actions'=>Array(
                Array('name'=>'新建','url'=>'index.php?r=admin/role/add'),
                Array('name'=>'编辑','url'=>'index.php?r=admin/role/showedit'),
                Array('name'=>'保存','url'=>'index.php?r=admin/role/edit')
            )
        )
    ))
);