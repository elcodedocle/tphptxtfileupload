tphptxtfileupload
=================

Tiny PHP .txt file upload framework / RESTful service

Created in response to http://stackoverflow.com/questions/26200894/incluide-a-user-txt-in-php/

You can test it on http://geovolutions.com/playground/fileattachment/form.html


###Usage

Usage is pretty straight forward:

Don't forget to set write permissions to your web server user on the destination
folder.

e.g. 

```
chown apache: /var/www/uploads && chmod 700 /var/www/uploadsCheck 
```

and `.htaccess` rules (or equivalent if you are not using apache) / non public 
destination folder, if you want to avoid the files being exposed to the public. 


Check the code and SO question/answer for more details.
