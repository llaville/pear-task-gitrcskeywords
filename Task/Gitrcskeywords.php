<?php
/**
 * <tasks:gitrcskeywords>
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

require_once 'PEAR/Task/Common.php';

/**
 * Implements the git RCS keywords task.
 *
 * Credits to https://github.com/TheFrozenFire/git-rcs-keywords
 * for the basic concept.
 *
 * @category Pear
 * @package  PEAR
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD
 * @version  Release: @package_version@
 * @link     http://pear.php.net/package/PEAR
 * @since    Class available since Release 1.0.0
 */
class PEAR_Task_Gitrcskeywords extends PEAR_Task_Common
{
    var $type  = 'simple';
    var $phase = PEAR_TASK_PACKAGE;
    var $path;
    var $revision;
    static $pkgDir;

    /**
     * Validate the raw xml at parsing-time.
     *
     * @param PEAR_PackageFile_v2 $pkg     Current package file
     * @param array               $xml     Raw, parsed xml
     * @param PEAR_Config         $config  Current PEAR configuration
     * @param array               $fileXml File attributes
     *
     * @static
     * @return array on validation failure, boolean true otherwise
     */
    function validateXml($pkg, $xml, $config, $fileXml)
    {
        self::$pkgDir = dirname($pkg->getPackageFile());

        if ($xml != '') {
            return array(PEAR_TASK_ERROR_INVALID, 'no attributes allowed');
        }
        return true;
    }

    /**
     * Initialize a task instance with the parameters
     *
     * @param array $xml     Raw, parsed xml
     * @param array $attribs File attributes
     *
     * @return void
     */
    function init($xml, $attribs)
    {
        $currentDir = getcwd();
        chdir(self::$pkgDir);

        $this->path = $attribs['name'];
        if (file_exists($this->path)) {
            $log = shell_exec("git log -1 -- {$this->path}");
            $this->revision = explode("\n", $log);
        }

        chdir($currentDir);
    }

    /**
     * Replace all RCS keywords with values from the local git repository
     *
     * @param PEAR_PackageFile_v2 $pkg      Current package file
     * @param string              $contents File contents
     * @param string              $dest     Eventual final file location
     *
     * @return mixed false to skip this file, PEAR_Error to fail
     *         (use $this->throwError), otherwise return the new contents
     */
    function startSession($pkg, $contents, $dest)
    {
        if (!is_array($this->revision)) {
            return false;
        }

        $filename = pathinfo($this->path, PATHINFO_BASENAME);

        preg_match("/^Author:\s*(.*)\s*$/m", $this->revision[1], $author);
        $author = $author[1];
        preg_match("/\s*(.*)\s*<.*/", $author, $name);
        $name = trim($name[1]);
        preg_match("/^Date:\s*(.*)\s*$/m", $this->revision[2], $date);
        $date = $date[1];
        preg_match("/^commit (.*)$/m", $this->revision[0], $ident);
        $ident = $ident[1];
        $rev   = substr($ident, 0, 10);

        $search = array(
            '/\$Date[^$]*\$/',
            '/\$Author[^$]*\$/',
            '/\$Id[^$]*\$/',
            '/\$File[^$]*\$/',
            '/\$Source[^$]*\$/',
            '/\$Revision[^$]*\$/'
        );
        $replace = array(
            "\$Date: {$date} \$",
            "\$Author: {$author} \$",
            "\$Id: {$filename} | {$rev} | {$date} | {$name} \$",
            "\$File: {$filename} \$",
            "\$Source: {$this->path} \$",
            "\$Revision: {$ident} \$"
        );

        $contents = preg_replace($search, $replace, $contents, -1, $subst);

        $this->logger->log(
            3, "doing " . $subst . " git RCS keywords substitution(s) for $dest"
        );

        return $contents;
    }
}
?>