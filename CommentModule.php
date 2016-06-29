<?php
/**
 * CommentModule class file.
 * @copyright (c) 2014, bariew
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

namespace bariew\commentAbstractModule;

/**
 * Module class for comments.
 * @author Pavel Bariev <bariew@yandex.ru>
 */
class CommentModule extends \yii\base\Module
{
    public $params = [
        'menu'  => [
            'label'    => 'Comments',
            'url' => ['/comment/comment/index']
        ]
    ];
}
