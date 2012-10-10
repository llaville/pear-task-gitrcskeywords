<?php
/**
 * <tasks:gitrcskeywords> - read/write version
 *
 * PHP version 5
 *
 * @category Pear
 * @package  PEAR
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD
 * @version  GIT: $Id:$
 * @link     http://pear.php.net/package/PEAR
 * @since    File available since Release 1.0.0
 */

require_once 'PEAR/Task/Gitrcskeywords.php';

/**
 * Abstracts the gitrcskeywords task xml.
 *
 * @category Pear
 * @package  PEAR
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD
 * @version  Release: @package_version@
 * @link     http://pear.php.net/package/PEAR
 * @since    Class available since Release 1.0.0
 */
class PEAR_Task_Gitrcskeywords_Rw extends PEAR_Task_Gitrcskeywords
{
    /**
     * Initializes Gitrcskeywords task write version
     *
     * @param PEAR_PackageFile_v2 &$pkg    Current package file
     * @param PEAR_Config         &$config Current PEAR configuration
     * @param mixed               &$logger Logger
     * @param array               $fileXml File attributes
     *
     * @return PEAR_Task_Gitrcskeywords_Rw
     */
    function PEAR_Task_Gitrcskeywords_Rw(&$pkg, &$config, &$logger, $fileXml)
    {
        parent::PEAR_Task_Common($config, $logger, PEAR_TASK_PACKAGE);

        $this->_contents = $fileXml;
        $this->_pkg      = &$pkg;
        $this->_params   = array();
    }

    /**
     * Validate the Gitrcskeywords task write version
     *
     * @return bool
     */
    function validate()
    {
        return true;
    }

    /**
     * Returns name of the task
     *
     * @return string
     */
    function getName()
    {
        return 'gitrcskeywords';
    }

    /**
     * Returns Xml attributes of the task
     *
     * @return mixed
     */
    function getXml()
    {
        return '';
    }
}
?>