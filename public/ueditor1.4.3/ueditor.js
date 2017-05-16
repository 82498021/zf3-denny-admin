var ue = UE.getEditor('content', {
    autoHeight: false,
    initialFrameHeight:200,

    toolbars: [
        [
            'fullscreen',
            'insertcode', //代码语言
            'fontfamily', //字体
            'fontsize', //字号
            'paragraph', //段落格式
            'undo', //撤销
            'redo', //重做

        ],

        [
            'bold', //加粗
            'italic', //斜体
            'underline', //下划线
            'strikethrough', //删除线
            'subscript', //下标
            'fontborder', //字符边框
            'superscript', //上标
            'formatmatch', //格式刷
            'pasteplain', //纯文本粘贴模式
            'horizontal', //分隔线
            'autotypeset', 'blockquote',
            'removeformat', //清除格式
            'time', //时间
            'date', //日期
            'unlink', //取消链接
            'inserttitle', //插入标题
            'pasteplain', '|','backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc',

        ],
    /**
     [
     'insertrow', //前插入行
     'insertcol', //前插入列
     'mergeright', //右合并单元格
     'mergedown', //下合并单元格
     'deleterow', //删除行
     'deletecol', //删除列
     'splittorows', //拆分成行
     'splittocols', //拆分成列
     'splittocells', //完全拆分单元格
     'deletecaption', //删除表格标题

     'mergecells', //合并多个单元格
     'deletetable', //删除表格
     'cleardoc', //清空文档
     'insertparagraphbeforetable', //"表格前插入行"
     'edittable', //表格属性]
     ],
     **/
    ]
});