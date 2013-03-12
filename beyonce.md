#Translation Problems#

The first three issues are all symptoms of the same misconfiguration. At some
point, each content type had its Multilingual Support disabled. In addition to
Multilingual Support being disabled, each content type's Multilanguage options
had been modified. The correct settings for each of these options are:

* Multilingual Support:
    * Enabled, with translation

* Multilanguage options:
    * Set current language as default for new content. (TRUE)  
    * Require language (Do not allow Language Neutral). (TRUE)  
    * Lock language (Cannot be changed). (TRUE)  

Resetting these options to their proper value addresses and fixes the first
three issues.

###Moving the correct configuration between environments###

These options are stored in the variables table and are spread out over four
rows per content type. We can use the strongarm module in conjunction with the
features module to store these rows as configuration files. Once stored in
files, we can place the configurations under version control and move them from
server to server.

###How did this happen?###

It's hard to tell. The site has changed environments several times. It's
possible that during one of the moves, the content type definitions were
exported as flat files and re-imported without their associated variables. It's
also possible that someone with the admin account manually made these changes
without realizing the implications.

###How can we prevent it in the future?###

We can't guarantee that an administrator won't go in and manually modify those
values. But storing the configuration as flat files via Strongarm and Features
will allow us to quickly see if any manual changes have been made and revert to
the previous state if necessary.

#Menu Problems#

We didn't find an obvious culprit here. We did find that the path in the Views
module (used to generate this page) had an unnecessary argument in it. This
could have confused the menu system into thinking that the path entered via the
menu module was invalid and it hiding the link. We have updated the path in the
Views module and added that change to the Feature definition of the view.

#Current Status#

The changes outlined above have been pushed to dev. Let us know if you have any
questions and when you would like us to push it to prod. The push to prod will
not require any down-time or other interruption.

#Additional Tweaks#

* We identified an unneeded module that was sending unnecessary request on
  initial load of the /admin page and have disabled it.

* There were several other modules that were identified as enabled but were no
  longer being used. Those have been disabled as well.
