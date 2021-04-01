<?php
/**
 * 给你的Typecho换用Parsedown+ParsedownExtra解析器。
 *
 * @package ParsedownParser
 * @author Jimmy Ho
 * @version 0.2
 * @link https://blog.jimmyho.net/
 */

class ParsedownParser_Plugin implements Typecho_Plugin_Interface
{
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     */
    public static function activate()
    {
        Typecho_Plugin::factory('Widget_Abstract_Contents')
                      ->markdown = array('ParsedownParser_Plugin', 'parser');
        Typecho_Plugin::factory('Widget_Abstract_Comments')
                      ->markdown = array('ParsedownParser_Plugin', 'parser');
    }
    
    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     */
    public static function deactivate(){}
    
    /**
     * 获取插件配置面板
     */
    public static function config(Typecho_Widget_Helper_Form $form){}
    
    /**
     * 个人用户的配置面板
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form){}
    
    /**
     * 插件实现方法
     */
    public static function parser($text)
    {
        require_once dirname(__FILE__) . '/Parsedown.php';
        require_once dirname(__FILE__) . '/ParsedownExtra.php';
        return ParsedownExtra::instance()
             ->setBreaksEnabled(true)
             ->text($text);
    }
}
