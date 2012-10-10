PEAR_Task_Gitrcskeywords
========================

**PEAR_Task_Gitrcskeywords** is a supplement PEAR_Task that
search and replace all git RCS keywords by their corresponding values

Installation
------------

PEAR_Task_Gitrcskeywords should be installed using the [PEAR Installer](http://pear.php.net/).
This installer is the backbone of PEAR, which provides a distribution system for PHP packages,
and is shipped with every release of PHP since version 4.3.0.

The PEAR channel (`bartlett.laurent-laville.org`) that is used to distribute PEAR_Task_Gitrcskeywords
needs to be registered with the local PEAR environment.

    $ pear channel-discover bartlett.laurent-laville.org
    Adding Channel "bartlett.laurent-laville.org" succeeded
    Discovery of channel "bartlett.laurent-laville.org" succeeded

This has to be done only once. Now the PEAR Installer can be used to install packages from the Bartlett channel.

    $ pear install bartlett/PEAR_Task_Gitrcskeywords
    downloading PEAR_Task_Gitrcskeywords-1.0.0.tgz ...
    Starting to download PEAR_Task_Gitrcskeywords-1.0.0.tgz (4,118 bytes)
    .........................done: 4,118 bytes
    install ok: channel://bartlett.laurent-laville.org/PEAR_Task_Gitrcskeywords-1.0.0

After the installation you can find the PEAR_Task_Gitrcskeywords source files inside your local PEAR directory.

You must have the binary git in your system path.

Windows users:

    set Path=%Path%;C:\Program Files\Git\bin

Check that your git command is known, by running:

    git --version

You must have result something like that (depending of your OS):

    git version 1.7.11.msysgit.0
