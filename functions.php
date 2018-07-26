<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * 主题功能函数
 * @author benzBrake<github-benzBrake@woai.ru>
 **/
define('__POSTS_TYPE__', array('' => '主题 (默认)','plugin'=>'插件 (plugin)','readme'=>'说明文档 (readme)','notes'=>'说明文档 (日志)'));
define('__PAGE_SIZE__', 12);

function themeConfig($form) {
	echo "<style>code {background: #222;padding: 2px;color: #fff;margin: 0 5px;}.typecho-page-main .col-tb-8{background:#fff;padding:20px 40px}.typecho-option .typecho-label{font-weight:400!important;font-size:1.25rem;padding: 5px;}.oneline label, .oneline input, .oneline select {display: inline-block !important;}</style>";

	$logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点 LOGO 地址'), _t('在这里填入一个图片 URL 地址, 以在网站标题前加上一个 LOGO, Logo 高度为<code>24px</code>'));
	$form->addInput($logoUrl);

	$edit = new Typecho_Widget_Helper_Form_Element_Text('zdgg', NULL, _t('承接一切烂主题制作'), _t('站点公告'), _t('在这里填入站点公告'));
	$form->addInput($edit);

	$categories = Typecho_Widget::widget('Widget_Metas_Category_List')->to($categories);
	$categories_arr = array();
	while($categories->next()) {
		$categories_arr[$categories->mid] = $categories->name;
	}
	$categories_arr['all'] = "全部显示";
	$edit = new Typecho_Widget_Helper_Form_Element_Select('index_category', $categories_arr, 'all', _t('首页显示文章分类'), NULL);
	$edit->setAttribute('class', 'typecho-option oneline');
	$form->addInput($edit);
        array_pop($categories_arr);
	$edit = new Typecho_Widget_Helper_Form_Element_Checkbox('showTumbCat', $categories_arr, NULL, _t('分类页显示缩略图分类'), NULL);
	$form->addInput($edit);

	$edit = new Typecho_Widget_Helper_Form_Element_Text('viewthemes', NULL, _t("VIEW THEMES"), _t('VIEW THEMES 提示文本修改'), _t('默认为 VIEW THEMES'));
	$form->addInput($edit);

	$edit = new Typecho_Widget_Helper_Form_Element_Textarea('author', NULL, _t("请到后台修改作者简介\n- TeHot"), _t('作者简介'), _t('在这里填入作者简介'));
	$form->addInput($edit);

	$edit = new Typecho_Widget_Helper_Form_Element_Text('copyright', NULL, _t('本站仅做资源收集，模板有部分是笔者所做，有些是收集自互联网，如果有使用中有问题，请在下面留言我会挑我会的回复您。'), _t('文章版权说明'), _t('在这里填入版权说明'));
	$form->addInput($edit);

	$default_thumb = new Typecho_Widget_Helper_Form_Element_Text('default_thumb', NULL, '', _t('默认缩略图'),_t('文章没有图片时的默认缩略图，留空则无，一般为<code>http://www.yourblog.com/image.png</code>'));
	$form->addInput($default_thumb->addRule('xssCheck', _t('请不要在链接中使用特殊字符')));

	$edit = new Typecho_Widget_Helper_Form_Element_Text('qr_api', NULL, _t("http://qr.liantu.com/api.php?w=300&text={{content}}"), _t('二维码api'),_t('<code>{{content}}</code>代表二维码内容'));
	$form->addInput($edit);

	$edit = new Typecho_Widget_Helper_Form_Element_Textarea('widgets', NULL, _t("theme-info\r\nlatest-posts\r\ntags"), _t('边栏模块'), _t('一行一个，可选<code>author|latest-posts|category|theme-info|latest-comments|search|tags|other</code>'));
	$form->addInput($edit);

    $edit = new Typecho_Widget_Helper_Form_Element_Text('powerby', NULL, _t('© {{year}} {{site}} &amp; All Rights Reserved .'), _t('页脚文本'), _t('<code>{{year}}</code>代表当前年份，<code>{{site}}</code>代表站点'));
    $form->addInput($edit);
	
}


function themeFields($form)
{
	$edit = new Typecho_Widget_Helper_Form_Element_Text('thumb', NULL, '', '自定义缩略图', 'URL格式，不裁剪');
	$form->addItem($edit);
	$edit = new Typecho_Widget_Helper_Form_Element_Text('theme_demo', NULL, '', '主题演示链接', '主题文章使用');
	$form->addItem($edit);
	$edit = new Typecho_Widget_Helper_Form_Element_Text('theme_download', NULL, '', '主题下载链接', '主题文章使用');
	$form->addItem($edit);
}

function themeInit($archive){
	if ($archive->is('archive')) {
		$archive->parameter->pageSize = __PAGE_SIZE__;
	}
	if ($archive instanceof Widget_Archive) {
		$thumb =  getThumb($archive, false, null, true);
		if (!empty($thumb))
			$archive->content .= '<div class="inline-block theme-thumbnail"><h6 class="text-uppercase">Thumbnail</h6><img src="' . $thumb . '" title="' . $archive->title .'" /></div>';
	}
	return $archive;
}

/**
 * 显示菜单，依赖 TeMenu 插件
 *
 * @access public
 * @param String $slug
 * @return void
 **/
function showMenu(String $slug) {
	$navigation = json_decode(Typecho_Widget::widget('Widget_Options')->plugin('TeMenu')->navigation, true);
	if(!array_key_exists($slug, $navigation)){
		return;
	}
	$menu = $navigation[$slug]['menu'];
	$html = parseMenu($menu);
	_e($html);
}
/**
 * 生成菜单，依赖 TeMenu 插件
 *
 * @access public
 * @param String $menu
 * @return SString
 **/
function parseMenu($menu) {
	$html = '';
	$archive = Typecho_Widget::widget('Widget_Archive');
	foreach($menu as $k=>$v){
		if($v['type']=='category'){
			$category = Typecho_Widget::widget('Widget_Metas_Category_List')->getCategory($v['id']);
			$v['url'] = $category['permalink'];
			$v['slug'] = $category['slug'];
			$v['current'] = $archive->is('category',$category['slug']);
		}elseif($v['type']=='page'){
			$page = Typecho_Widget::widget('Widget_Page_Query')->getPage($v['id']);
			$v['url'] = $page['permalink'];
			$v['slug'] = $page['slug'];
			$v['current'] = $archive->is('page',$page['slug']);
		}else{
			$url = $archive->request->getRequestUrl();
			$v['url'] = $v['id'];
			$v['current'] = $url === $v['url'];
		}
		if(isset($v['children'])){
			$v['caret'] = '<i class="fa fa-caret-down"></i>';
		}else{
			$v['caret'] = '';
		}
		$v['target'] = isset($v['target']) && $v['target'] ? 'target="_blank"' : '';
		$v['icon'] = isset($v['icon']) ? '<i class="'.$v['icon'].'"></i>' : '';
		$v['current'] && $v['current'] = 'class="current"';
		$html .=  '<li' . (isset($v['children']) ? ' class="-hasSubmenu"' : '') . '>';
		$html .= str_replace(array('{url}','{name}','{current}','{icon}','{caret}','{target}'),
				array($v['url'],$v['name'],$v['current'],$v['icon'],$v['caret'],$v['target']),'<a {current} href="{url}" {target}>{icon} {name} {caret}</a>');
		if(isset($v['children'])){
			$html .= '<ul>';
			$html .= parseMenu($v['children']);
			$html .= '</ul>';
		}
		$html .= '</li>';
	}
	return $html;
}
/**
 * 取缩略图
 *
 * @access public
 * @param Widget_Archie $widget
 * @param mixed $size
 * @param mixed $link
 * @return String
 **/
function getThumb($widget, $random = false, $size = null, $link = false){
	$thumb = '';
	preg_match_all( "/<[img|IMG].*?src=[\'|\"](.*?)[\'|\"].*?[\/]?>/", $widget->content, $matches );
	$options = Typecho_Widget::widget('Widget_Options');
	$attach = $widget->attachments(1)->attachment;
	if (isset($attach->isImage) && $attach->isImage == 1){
		$thumb = $attach->url;
	}elseif(isset($matches[1][0])){
		$thumb = $matches[1][0];
	}
	if(array_key_exists('thumb',unserialize($widget->fields))){
		$thumb = $widget->fields->thumb;
	}
	$thumb = empty($thumb) ? $options->default_thumb : $thumb;
	$thumb = (empty($thumb) &&  $random) ? $options->themeUrl . '/assets/img/thumbs/'.mt_rand(0,9).'.jpg' : $thumb;
	if(empty($thumb))
		return '';
	if(!empty($options->src_add) && !empty($options->cdn_add))
		$thumb = str_ireplace($options->src_add,$options->cdn_add,$thumb);
	if($link){
		return $thumb;
	} else {
		return '<img src="' . $thumb .'" />';
	}
}

//获取边栏模块
function tehotGetWidget($part) {
	$DIR_SEP = DIRECTORY_SEPARATOR;
	$part = ($part == "") ? "-none" : "-".$part;
	$template = file_exists( dirname(__FILE__).$DIR_SEP.'widgets'.$DIR_SEP.'widget'.$part.".php") ? "widgets".$DIR_SEP."widget".$part.".php" : "widgets".$DIR_SEP."widget-none.php";
	 return $template;
}
/*
 * 获取文章浏览次数(改进版)
 *
 * @access public
 * @param Widget_Archie $widget
 * @param String $format
 * @return String
 */
function getPostViews($widget, $format = "{views}") {
	$fields = unserialize($widget->fields);
	if (array_key_exists('views', $fields))
		$views = (!empty($fields['views'])) ? intval($fields['views']) : 0;
	else
		$views = 0;
	
	//增加浏览次数
	if ($widget->is('single')) {
		$vieweds = Typecho_Cookie::get('contents_viewed');
		if (empty($vieweds))
			$vieweds = array();
		else
			$vieweds = explode(',', $vieweds);
		if (!in_array($widget->cid, $vieweds)) {
			$views = $views + 1;
			$widget->setField('views', 'str', strval($views), $widget->cid);
			$vieweds[] = $widget->cid;
			$vieweds = implode(',', $vieweds);
			Typecho_Cookie::set("contents_viewed",$vieweds);
		}
	}
	_e(str_replace("{views}", $views, $format));
}
/*上一篇文章*/
function theNext($widget, $default = NULL){
	$db = Typecho_Db::get();
	$sql = $db->select()->from('table.contents')
		->where('table.contents.created > ?', $widget->created)
		->where('table.contents.status = ?', 'publish')
		->where('table.contents.type = ?', $widget->type)
		->where('table.contents.password IS NULL')
		->order('table.contents.created', Typecho_Db::SORT_ASC)
		->limit(1);
	$content = $db->fetchRow($sql);
	if ($content) {
		$content = $widget->filter($content);
		$link = '<a href="' . $content['permalink'] . '" title="' . $content['title'] . '">←</a>';
		echo $link;
	} else {
		echo $default;
	}
}
/*下一篇文章*/
function thePrev($widget, $default = NULL){
	$db = Typecho_Db::get();
	$sql = $db->select()->from('table.contents')
		->where('table.contents.created < ?', $widget->created)
		->where('table.contents.status = ?', 'publish')
		->where('table.contents.type = ?', $widget->type)
		->where('table.contents.password IS NULL')
		->order('table.contents.created', Typecho_Db::SORT_DESC)
		->limit(1);
	$content = $db->fetchRow($sql);
	if ($content) {
		$content = $widget->filter($content);
		$link = '<a href="' . $content['permalink'] . '" title="' . $content['title'] . '">→</a>';
		echo $link;
	} else {
		echo $default;
	}
}
/**
 * 返回指定目录的 Widget_Archive 对象
 *
 * @access public
 * @param mixed $mid
 * @param int $page_size
 * @return Widget_Archive
 **/
function listPostsByMid($mid, $pageSize = __PAGE_SIZE__) {
	return Typecho_Widget::widget('Widget_Archive@index-' . $mid, 'pageSize=' . $pageSize .'&type=category', 'mid=' . $mid);
}
/**
 * 判断目录是否存在
 *
 * @access public
 * @param mixed $mid
 * @return bool
 **/
function categoryExists($mid) {
	$bool = Typecho_Widget::widget('Widget_Metas_Category_List')->getCategory($mid) !==NULL ? TRUE : FALSE;
	return $bool;
}
/**
 * 获取文章自定义字段
 *
 * @access public
 * @param mixed $field
 * @param array $fields
 * @param mixed $default
 * @return mixed
 **/
function getFieldNotEmpty($field, $fields, $default = NULL) {
	$fields = unserialize($fields);
	if (array_key_exists($field, $fields) && !empty($fields[$field]))
		return $fields[$field];
	return $default;
}
function fieldsToLinks($fields, $fields_name, $options = '') {
	if (!is_array($fields))
		$fields = unserialize($fields);
	if ($fields === NULL || count($fields) === 0) return;
	if ($fields_name === NULL || count($fields_name) === 0) return;
	$options = new Typecho_Config($options);
	$options->setDefault(array(
		'wrapTag'=>'ul',
		'wrapClass'=>'',
		'itemTag'=>'li',
		'itemClass'=>'',
		'item'=>'<a href="{url}" {target}>{icon} {name} {caret}</a>',
		'icon' => '',
		'caret'=>'',
		'target'=> 'target="_blank"'
	));
	$html = '';
	foreach($fields_name as  $key=>$value) {
		if (array_key_exists($key, $fields)) {
			if (!empty($fields[$key])) {
				$item = str_replace(array('{url}','{name}','{icon}','{caret}','{target}'), array($fields[$key], $value, $options->icon, $options->caret, $options->target), $options->item);
				if($options->itemTag){
					$item = '<' . $options->itemTag . (empty($options->itemClass)
							? '' : ' class="' . $options->itemClass . '"') . '>' . $item;
				}
				if($options->itemTag){
					$item .= '</' . $options->itemTag . '>';
				}
				$html .= $item;
			}
		}

	}
	if ($html == '')
		return '';
	if($options->wrapTag){
		$html = '<' . $options->wrapTag . (empty($options->wrapClass)
				? '' : ' class="' . $options->wrapClass . '"') . '>' . $html;
	}
	if($options->wrapTag){
		$html .= '</' . $options->wrapTag . '>';
	}
	return $html;
}
/* 调试辅助，控制台输出 */
function console_log($data)  
{  
	if (is_array($data) || is_object($data))  
	{  
		echo("<script>console.log('".json_encode($data)."');</script>");  
	}  
	else  
	{  
		echo("<script>console.log('".$data."');</script>");  
	}  
}  