<?php
$server = $_SERVER['SERVER_NAME'];
$json = file_get_contents('quickdoc.json');
$outline = json_decode($json, true);
processOutline($outline);
$parts = parse_url($_SERVER['REQUEST_URI']);
$pagePath = $parts['path'];
$outline['url'] = $pagePath;
$path = array_values(array_filter(explode('/',$_GET['view'])));

if (count($path) == 0)
{
    $viewList = $outline['contents'][0]['contents'][0]['view'] ?: [];
    $view = implode('/',$viewList);
    header("Location: $pagePath?view=/$view");
    die();
}

$elements = getPathElements($path, $outline);
$pageElement = $elements[$path[count($path)-1]];
$parentElement = $elements[$path[count($path)-2]] ?: $outline;
$childElements = $pageElement['contents'] ?: [];
$tab = $outline['tab'];
$mainTitle = $outline['title'];
$subTitle = $outline['subtitle'];
$parentTitle = $parentElement['title'];
$pageTitle = $pageElement['title'];
$previousPage = previousPage($pageElement);
$nextPage =   nextPage($pageElement);
$previousSection =   previousSection($pageElement);
$nextSection =  nextSection($pageElement);
$breadcrumbs = pageBreadcrumbs($pageElement);
$editLink = $pageElement['edit'];

function nextSection(&$element)
{
    global $outline;
    $sectionId = $element['sectionId'];
    $siblings = $outline['contents'];
    $max = count($siblings) - 1;
    if ($sectionId >= $max) return;
    $elm = &$outline['contents'][$sectionId + 1] ?: false;
    if ($elm) $elm['url'] = pageUrl($elm);
    return $elm;
}

function previousSection(&$element)
{
    global $outline;
    $sectionId = $element['sectionId'];
    if ( $sectionId == 0) return;
    $elm = &$outline['contents'][$sectionId - 1] ?: false;
    if ($elm) $elm['url'] = pageUrl($elm);
    return $elm;
}

function nextPage(&$element)
{
    global $outline;
    $sectionId = $element['sectionId'];
    $pageId = $element['pageId'];
    $siblings = $outline['contents'][$sectionId]['contents'];
    $max = count($siblings) - 1;
    if ($pageId >= $max) return;
    $elm = &$siblings[$pageId + 1] ?: false;
    if ($elm) $elm['url'] = pageUrl($elm);
    return $elm;
}

function previousPage(&$element)
{
    global $outline;
    $sectionId = $element['sectionId'];
    $pageId = $element['pageId'];
    if ( $pageId == 0) return;
    $elm = &$outline['contents'][$sectionId]['contents'][$pageId - 1] ?: false; 
    if ($elm) $elm['url'] = pageUrl($elm);
    return $elm;  
}

function logger($a,$b)
{
    echo "<p><b>$a</b></p><p>".json_encode($b)."</p>"  ;
}

function pageUrl($element)
{
    global $outline;
    if (!array_key_exists('link',$element))
    {
        $url = $outline['url'];
        if (count($element['view']) == 2) 
            $viewList = $element['view'];
        else 
            $viewList = $element['contents'][0]['view'] ?: [];
        $view = implode('/',$viewList);
        return "$url?view=/$view";
    }
    else if (array_key_exists('link',$element))
    {
        return $element['link'];
    }
    else return '';
}

function pageBreadcrumbs($element)
{
    $element['bc'][] = $element['title'];
    return implode(' > ',$element['bc']);
}

function processOutline(&$outline)
{
    $outline['view'] = [];
    $outline['bc'] = [];
    foreach ($outline['contents'] as $id=>&$section)
    {
        $section['sectionId'] = $id;
        $section['view']= [$section['page']];
        $section['bc'] = [$outline['title']];
        foreach($section['contents'] as $index=>&$page)
        {
            $page['sectionId'] = $id;
            $page['pageId'] = $index;
            $page['view'] = $section['view'];
            $page['view'][] = $page['page'];
            $page['bc'] = $section['bc'];
            $page['bc'][] = $section['title'];
        }
    }
}

function getBranch($contents, $value)
{
    if (!$value || !$contents || count($contents) == 0) return;
    foreach($contents as $branch)
    {
        if ($branch['page'] == $value) return $branch;
    }
    return;
}

function getPathElements($path, $outline)
{
    $elements = [];
    $contents = $outline['contents'];
    foreach($path as $value)
    {
        $branch = getBranch($contents, $value);
        if ($branch) 
        {
            $elements[$value] = $branch;
            $contents = $elements[$value]['contents'];
        }
    }
    return $elements;
}

function html_menu($path)
{
    global $outline;
    $html = "<menu class=\"menu\">";
    foreach ($outline['contents'] as $section)
    {
        $text = $section['title'];
        $url = pageUrl($section);
        $class = '';
        if ($path[0] == $section['page']) $class = ' selected';
        $html .= "<a class=\"section$class\" href=\"$url\">$text</a>";
        if ($path[0] == $section['page'])
        {
            foreach ($section['contents'] as $page)
            {
                $class = '';
                if ($path[1] == $page['page']) $class = ' selected';
                $text = $page['title'];
                $url = pageUrl($page);
                $tgt = "";
                if(array_key_exists('link',  $page)) $tgt = 'target="_blank"';
                $html .= "<a class=\"page $class\" href=\"$url\" $tgt>$text</a>";
            }
        }
    }
    $html .= "</menu>";
    return $html;
}
